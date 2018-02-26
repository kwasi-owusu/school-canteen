<?php
session_start();
include_once('../conn/conn.php');
$error = false;


if(isset($_POST["pproduct_Name"]))
{
 $name 			= $_POST["pproduct_Name"];
 $desc		 	= $_POST["prod_desc"];
 $supplier	 	= $_POST["supp"];
 $supplier_ref 	= $_POST["supp_ref"];
 $qty		 	= $_POST["qty"];
 
 $query = '';
 for($count = 0; $count < count($name); $count++)
 {
  $name_clean 				= mysqli_real_escape_string($cnn, $name[$count]);
  $desc_clean 				= mysqli_real_escape_string($cnn, $desc[$count]);
  $supplier_clean 			= mysqli_real_escape_string($cnn, $supplier[$count]);
  $supplier_ref_clean 		= mysqli_real_escape_string($cnn, $supplier_ref[$count]);
  $qty_clean 				= mysqli_real_escape_string($cnn, $qty[$count]);
  
  
  if($name_clean != '' && $desc_clean != '' && $supplier_clean != '' && $supplier_ref_clean != ''  && $qty_clean != '')
  {
  	$rfqCode = "100110";
	$createdby = $_SESSION['email'];
   $query .= '
   INSERT INTO rfq(rfq_code, product_name, prod_desc, supplier, supp_ref, qty, created_by) 
   VALUES("'.$rfqCode.'", "'.$name_clean.'", "'.$desc_clean.'", "'.$supplier_clean.'", "'.$supplier_ref_clean.'", "'.$qty_clean.'", "'.$createdby.'"); 
   ';
  }
 }
 if($query != '')
 {
  if(mysqli_multi_query($cnn, $query))
  {
   echo 'Request for Quotation Created';
  }
  else
  {
   echo $desc_clean;
  }
 }
 else
 {
  echo 'All Fields are Required';
 }
}
?>