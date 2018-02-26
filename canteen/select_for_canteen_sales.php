<?php 

include_once('../conn/conn.php');
if(isset($_POST["prodd_name"]))
{

$prod_nm = $_POST["prodd_name"];
	
$query_product = "SELECT canteen_product.product_ID, canteen_product.product_name, canteen_product.qty, canteen_product.stock_date, products_master.unit_sell_price 
FROM canteen_product, products_master
WHERE 
canteen_product.product_name = products_master.product_name AND
canteen_product.product_name = '".$prod_nm."' 
AND canteen_product.qty > 0
ORDER BY canteen_product.stock_date DESC";	
	
 //$query_product = "SELECT * FROM canteen_product WHERE product_name = '". $prod_nm."' AND qty > 0 ORDER BY stock_date DESC";
 $result_product = mysqli_query($cnn, $query_product);
 while($rrow = mysqli_fetch_array($result_product))
 {
  $data["product_ID"]			= $rrow["product_ID"];
  $data["product_name"] 		= $rrow["product_name"];
  $data["selling_price"]		= $rrow["unit_sell_price"];
  $data["qty"] 					= $rrow["qty"];
  
 }

 echo json_encode($data);
}
?>
