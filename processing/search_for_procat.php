<?php

include_once('../conn/conn.php');

 
 $searchTerm = $_GET['term'];
//get matched data from skills table
$query = $cnn->query("SELECT DISTINCT cat_name FROM prod_cat WHERE cat_name LIKE '%".$searchTerm."%' ORDER BY cat_name ASC");
while ($row = $query->fetch_assoc()) {
    $data[] = $row['cat_name'];
}
//return json data
echo json_encode($data);
 
 ?>  