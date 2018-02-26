<?php
$server   ="localhost";
$uname    ="sellnsell_uzas";
$pwd      ="sellnsell_uzas-H";
$bd       ="sellnsell";

$cnn = mysqli_connect ($server, $uname, $pwd, $bd);
if (!$cnn){

die("Unable to connect to database");
}
$mysql_db = mysqli_select_db($cnn,$bd);
if(!$mysql_db){

die("Unable to select database");

}


?>
