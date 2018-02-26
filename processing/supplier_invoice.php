<?php
session_start();
include_once('../conn/pervasive_conn.php');
include_once('../conn/conn.php');
$error = false;

if(isset($_POST["itemName"]))
{

 $supp_code		=	$_POST['suppCode'];
 $inv_No		=	$_POST['invoiceNo'];
 $inv_dt		=	$_POST['invoice_dt'];
 $itmNo			= 	$_POST['itemNo'];
 $itmName		=	$_POST['itemName'];
 $unitCost		=	$_POST['unit_cost'];
 $qty			=	$_POST['qty'];
 $total			=	$_POST['total'];
 
 /*foreach($_POST['itemNo_1'] AS $k=>$v)
 {*/
 
 $query = '';
 	
 	for($count = 0; $count < count($itmName); $count++)
 {
	
	$itName 	= mysqli_real_escape_string($cnn, $itmName[$count]);
	$itNo 		= mysqli_real_escape_string($cnn, $itmNo[$count]);
	$cost 		= mysqli_real_escape_string($cnn, $unitCost[$count]);
	$qqty 		= mysqli_real_escape_string($cnn, $qty[$count]);
	$ttotal	 	= mysqli_real_escape_string($cnn, $total[$count]);
	
	if($supp_code != '' && $inv_No != '' && $itNo != '' && $itName != ''  && $cost != '' && $qqty != '' && $total != '')
  {
  $submitted_by = $_SESSION['email'];
   $query .= '
   INSERT INTO supplier_invoice(inv_number, SupplCode, Item_No, product_name, qty, unitPrice, subtotal, created_by) 
   VALUES("'.$inv_No.'", "'.$supp_code.'", "'.$itNo.'", "'.$itName.'", "'.$qqty.'", "'.$cost.'", "'.$ttotal.'", "'.$submitted_by.'"); 
   ';
  }
  
  $docType = "108";
	$zql = "INSERT INTO HistoryLines(DocumentType, DocumentNumber, ItemCode, Description, Qty, UnitPrice) 
		VALUES('".$docType."', '".$inv_No."', '".$itNo."', '".$itName."', '".$qqty."', '".$cost."')";
		//execute query
		$perv = odbc_exec($cnnct, $zql);
  
  
  }
 
  if($query != '')
 {
  if(mysqli_multi_query($cnn, $query))
  {
  	
  	 echo "Supplier Invoice Successfully";
	  
  }
  
  else
  {
   echo "Something went wrong. Please try again... $ttotal <br>";
  }
 }
	else
 {
  echo "All Fields are Required";
 }
	}
	
   			

?>
