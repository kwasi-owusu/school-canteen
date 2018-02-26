<?php 

include_once('../conn/conn.php');
if(isset($_POST["menu_name"]))
{
 $query_product = "SELECT * FROM sch_menu WHERE menu_name = '". $_POST["menu_name"]."' ";
 $result_product = mysqli_query($cnn, $query_product);
 while($rrow = mysqli_fetch_array($result_product))
 {
  $data["menu_name"] 		= $rrow["menu_name"];
  $data["menu_cost"]		= $rrow["menu_cost"];
  
  
 }

 echo json_encode($data);
}
?>
