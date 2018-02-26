<?php

include_once('conn/conn.php');

$product = $_REQUEST['search_prod_name'];    
$product_sql = mysqli_query($cnn, "SELECT * FROM sellnsell_products WHERE product_cat  = '".$product."' ");
$product_row = mysqli_fetch_array($product_sql);

json_encode($product_row);die;