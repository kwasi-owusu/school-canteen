<?php

include_once('../conn/conn.php');

 
 $searchTerm = $_GET['term'];
//get matched data from skills table
$query = $cnn->query("SELECT DISTINCT(product_name) FROM canteen_product WHERE product_name LIKE '%".$searchTerm."%' ORDER BY product_name ASC");
while ($row = $query->fetch_assoc()) {
    $data[] = $row['product_name'];
}
//return json data
echo json_encode($data);
 
 ?>  