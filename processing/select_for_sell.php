<?php 

include_once('../conn/conn.php');
if(isset($_POST["prodd_name"]))
{
 $query_product = "SELECT * FROM products_master WHERE product_name = '". $_POST["prodd_name"]."' ";
 $result_product = mysqli_query($cnn, $query_product);
 while($rrow = mysqli_fetch_array($result_product))
 {
  $data["product_code"]		= $rrow["product_code"];
  $data["pro_cat"] 			= $rrow["product_cat"];
  $data["product_name"]		= $rrow["product_name"];
  $data["qty"] 				= $rrow["total_qty"];
  $data["manu_name"] 		= $rrow["manu_name"];
  $data["supp_name"] 		= $rrow["supp_name"];
  $data["unit_buy_price"]	= $rrow["buy_price"];
  $data["unit_sell_price"] 	= $rrow["unit_sell_price"];
  $data["internal_ref"] 	= $rrow["Internal_ref"];
  $data["barcode"]			= $rrow["barcode"];
  $data["re_order_rule"]	= $rrow["re_order_rule"];
  
 }

 echo json_encode($data);
}
?>
