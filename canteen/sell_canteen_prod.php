<?php
session_start();
include_once('../conn/conn.php');
$error = false;

if(isset($_POST["itemName"]))
{

 $itemNum		= 	$_POST['itNum'];
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
	$itNo	 	= mysqli_real_escape_string($cnn, $itemNum[$count]);
	$cost 		= mysqli_real_escape_string($cnn, $unitCost[$count]);
	$qqty 		= mysqli_real_escape_string($cnn, $qty[$count]);
	$subTotal	= mysqli_real_escape_string($cnn, $total[$count]);
	
	if($itNo != '' && $itName != ''  && $cost != '' && $qqty != '' && $subTotal != '')
  {
  $submitted_by = $_SESSION['email'];
   $query .= '
   INSERT INTO sell_canteen_prod(Itm_Num, product_name, selling_price, qty_sold, subTotal, sold_by) 
   VALUES("'.$itNo.'", "'.$itName.'", "'.$cost.'", "'.$qqty.'", "'.$subTotal.'", "'.$submitted_by.'"); 
   ';
  }
  
  }
 
  if($query != '')
 {
  if(mysqli_multi_query($cnn, $query))
  {
	  
	  //update the product storage and product master tables with the right product quantity in warehouse
	/*$product_query	 = mysqli_multi_query($cnn, "UPDATE canteen_product SET  qty = qty - $qqty WHERE batch_num= '".$batch_clean."' ");*/
	$qqquery = mysqli_multi_query($cnn, "UPDATE products_master SET  total_qty = total_qty - $qqty WHERE product_name= '".$itName."' ");
  	
  	 echo "Product Sold Successfully";
	  
  }
  
  else
  {
   echo "Something went wrong. Please try again... $submitted_by <br>";
  }
 }
	else
 {
  echo "All Fields are Required";
 }
	}
	
   			

?>
