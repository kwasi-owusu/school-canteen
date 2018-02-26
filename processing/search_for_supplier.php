<?php

include_once('../conn/conn.php');

 
 $searchTerm = $_GET['term'];
//get matched data from skills table
$query = $cnn->query("SELECT DISTINCT supp_name FROM sellnsell_suppliers WHERE supp_name LIKE '%".$searchTerm."%' ORDER BY supp_name ASC");
while ($row = $query->fetch_assoc()) {
    $data[] = $row['supp_name'];
}
//return json data
echo json_encode($data);
 
 ?>  