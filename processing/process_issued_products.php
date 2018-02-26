<?php
session_start();
include_once('../conn/conn.php');
$error = false;


if(isset($_POST["pproduct_Name"]))
{
 $name 				= $_POST["pproduct_Name"];
 $batch_num		 	= $_POST["bbatch"];
 $wh_qty			= $_POST['whse_qty'];
 $wh_stored		 	= $_POST["wh_stored"];
 $wwh_row_number 	= $_POST["wwh_row_number"];
 $wwh_shelve_num 	= $_POST["wwh_shelve_num"];
 $mmanu_dt		 	= $_POST["mmanu_dt"];
 $eexpiry_dt	 	= $_POST["eexpiry_dt"];
 $issued_qty	 	= $_POST["iissued_qty"];
 $issued_to		 	= $_POST["iissued_to"];
 $in_charge		 	= $_POST["iin_charge"];
 $issued_by 		= $_SESSION['email'];
 
 $query = '';
 for($count = 0; $count < count($name); $count++)
 {
  $name_clean 				= mysqli_real_escape_string($cnn, $name[$count]);
  $batch_clean 				= mysqli_real_escape_string($cnn, $batch_num[$count]);
  $qty_clean 				= mysqli_real_escape_string($cnn, $wh_qty[$count]);
  $wh_stored_clean 			= mysqli_real_escape_string($cnn, $wh_stored[$count]);
  $wwh_row_number_clean		= mysqli_real_escape_string($cnn, $wwh_row_number[$count]);
  $wwh_shelve_num_clean		= mysqli_real_escape_string($cnn, $wwh_shelve_num[$count]);
  $mannu_dt_clean 			= mysqli_real_escape_string($cnn, $mmanu_dt[$count]);
  $eexpiry_dt_clean 		= mysqli_real_escape_string($cnn, $eexpiry_dt[$count]);
  $issued_qty_clean 		= mysqli_real_escape_string($cnn, $issued_qty[$count]);
  $issued_to_clean 			= mysqli_real_escape_string($cnn, $issued_to[$count]);
  $in_charge_clean			= mysqli_real_escape_string($cnn, $in_charge[$count]);
  
  
  
  if($name_clean != '' && $batch_clean != '' && $qty_clean != '' && $issued_to_clean != ''  && $in_charge_clean != '')
  {
  
   $query .= '
   INSERT INTO issue_product(product_name, batch_number, issue_qty, from_wh, from_row, from_shelve, manu_dt, expiry_dt, issued_to, person_incharge, issued_by) 
   VALUES("'.$name_clean.'", "'.$batch_clean.'", "'.$issued_qty_clean.'", "'.$wh_stored_clean.'", "'.$wwh_row_number_clean.'", "'.$wwh_shelve_num_clean.'", "'.$mannu_dt_clean.'", "'.$eexpiry_dt_clean.'", "'.$issued_to_clean.'", "'.$in_charge_clean.'", "'.$issued_by.'"); 
   ';
  }
 }
 if($query != '')
 {
  if(mysqli_multi_query($cnn, $query))
  {
  	
				//update the product storage and product master tables with the right product quantity in warehouse
				$product_query	 = mysqli_multi_query($cnn, "UPDATE products_storage SET  whse_qty = whse_qty - $issued_qty_clean WHERE storage_ID= '".$batch_clean."' ");
				$qqquery = mysqli_multi_query($cnn, "UPDATE products_master SET  total_qty = total_qty - $issued_qty_clean WHERE product_name= '".$name_clean."' ");
  				
  				
				 //create activity log
				$activity_details = "$issued_qty_clean of $name_clean issued to ". $in_charge_clean. " by ". $issued_by;
				$qquery = mysqli_multi_query($cnn, "INSERT INTO activity_log(activity, created_by)
				VALUES('".$activity_details."', '".$issued_by."')");	
				
		//create activity log for product to be atraced 
		$product_activity = "Product Issued to $issued_to_clean ... incharge ... $in_charge_clean";
		$query = mysqli_query($cnn, "INSERT INTO trace_product(product_name, batch_num, qty, product_activity, activity_by)
		VALUES('".$name_clean."', '".$batch_clean."', '".$issued_qty_clean."', '".$product_activity."', '".$issued_by."')");	
   				
   echo "Products Issued Successfully";
  }
  else
  {
   echo "Something went wrong. Please try again";
  }
 }
 else
 {
  echo 'All Fields are Required';
 }
}
?>