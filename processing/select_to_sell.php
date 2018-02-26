<?php 

include_once('../conn/conn.php');
if(isset($_POST["prodd_name"]))
{


 $query_product = "SELECT * FROM products_storage WHERE product_name = '". $_POST["prodd_name"]."'  AND wh_stored = 10 AND expiry_dt > CURDATE()";
 $result_product = mysqli_query($cnn, $query_product);
 $rrow = mysqli_fetch_array($result_product);
 
  $data["product_name"]		= $rrow["product_name"];
  $data["batch_num"] 		= $rrow["batch_num"];
  $data["barcode"]			= $rrow["barcode"];
  $data["whse_qty"] 		= $rrow["whse_qty"];
  $data["wh_row_number"] 	= $rrow["wh_row_number"];
  $data["wh_shelve_num"]	= $rrow["wh_shelve_num"];
  $data["shelve_cage_num"]	= $rrow["shelve_cage_num"];
  $data["manu_dt"] 			= $rrow["manu_dt"];
  $data["expiry_dt"] 		= $rrow["expiry_dt"];
  
 
 $query_price = "SELECT unit_sell_price FROM products_master WHERE product_name = '". $_POST["prodd_name"]."' ";
 $result_price = mysqli_query($cnn, $query_price);
 $price = mysqli_fetch_array($result_price);
 
 $data["unit_sell_price"] 		= $price["unit_sell_price"];
  
 //echo json_encode($daata);

  echo json_encode($data);
}
?>
