<?php
session_start();
include_once('../conn/conn.php');
$error = false;


if(isset($_POST["pproduct_Name"]))
{
 $name 				= $_POST["pproduct_Name"];
 $barcode			= $_POST["bbarCode"];
 $batch_num		 	= $_POST["bbatch"];
 $sell_price		= $_POST['sell_price'];
 $prod_qty		 	= $_POST["pro_qty"];
 $sub_total		 	= $_POST["sub_total"]; 
 $sold_by 			= $_SESSION['email'];
 
 $query = '';
 for($count = 0; $count < count($name); $count++)
 {
  $name_clean 				= mysqli_real_escape_string($cnn, $name[$count]);
  //$barcode_clean 			= mysqli_real_escape_string($cnn, $barcode[$count]);
  $batch_clean 				= mysqli_real_escape_string($cnn, $batch_num[$count]);
  $ssell_price 				= mysqli_real_escape_string($cnn, $sell_price[$count]);
  $pprod_qty 				= mysqli_real_escape_string($cnn, $prod_qty[$count]);
  $ssub_total				= mysqli_real_escape_string($cnn, $sub_total[$count]);
  //$ssold_by					= mysqli_real_escape_string($cnn, $sold_by[$count]);
  
  if($name_clean != '' && $batch_clean != '' && $ssell_price != '' && $pprod_qty != ''  && $ssub_total != '')
  {
  
   $query .= '
   INSERT INTO pos(product_name, product_batch_num, unit_sell_price, qty_sold, sub_total, sold_by) 
   VALUES("'.$name_clean.'", "'.$batch_clean.'", "'.$ssell_price.'", "'.$pprod_qty.'", "'.$ssub_total.'", "'.$sold_by.'"); 
   ';
  }
 }
 if($query != '')
 {
  if(mysqli_multi_query($cnn, $query))
  {
  	
				//update the product storage and product master tables with the right product quantity in warehouse
	$product_query	 = mysqli_multi_query($cnn, "UPDATE products_storage SET  whse_qty = whse_qty - $pprod_qty WHERE batch_num= '".$batch_clean."' ");
	$qqquery = mysqli_multi_query($cnn, "UPDATE products_master SET  total_qty = total_qty - $pprod_qty WHERE product_name= '".$name_clean."' ");
  				
  				
				 //create activity log
				$activity_details = "$pprod_qty of $name_clean sold by  " . $sold_by;
				$qquery = mysqli_multi_query($cnn, "INSERT INTO activity_log(activity, created_by)
				VALUES('".$activity_details."', '".$sold_by."')");	
   				
   echo "Products Sold Successfully by $sold_by";
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