<?php 

include_once('../conn/conn.php');
if(isset($_POST["prodd_name"]))
{
	//SELECT * FROM products_storage WHERE product_name = '". $_POST["prodd_name"]."'
	
$whs_location = $_POST["location"];
 $query_product = "SELECT * FROM products_storage WHERE wh_stored = '".$whs_location."' AND product_name = '". $_POST["prodd_name"]."' AND whse_qty >=0  AND expiry_dt > CURDATE() ORDER BY expiry_dt DESC";
 $result_product = mysqli_query($cnn, $query_product);
 while($rrow = mysqli_fetch_array($result_product))
 {
  $data["batch_num"] 		= $rrow["batch_num"];
  $data["product_name"]		= $rrow["product_name"];
  $data["whse_qty"] 		= $rrow["whse_qty"];
  $data["wh_stored"]		= $rrow["wh_stored"];
  $data["wh_row_number"]	= $rrow["wh_row_number"];
  $data["wh_shelve_num"]	= $rrow["wh_shelve_num"];
  $data["manu_dt"] 			= $rrow["manu_dt"];
  $data["expiry_dt"] 		= $rrow["expiry_dt"];
  $data["dt_moved"] 		= $rrow["dt_moved"];
  
  
  
  
 }

 echo json_encode($data);
}
?>
