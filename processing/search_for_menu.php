<?php

include_once('../conn/conn.php');

 
 $searchTerm = $_GET['term'];
//get matched data from skills table
$query = $cnn->query("SELECT DISTINCT menu_name FROM sch_menu WHERE menu_name LIKE '%".$searchTerm."%' ORDER BY menu_name ASC");
while ($row = $query->fetch_assoc()) {
    $data[] = $row['menu_name'];
	
}
//return json data
echo json_encode($data);
 
 ?>  