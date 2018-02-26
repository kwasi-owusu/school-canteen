<?php 

include_once('../conn/conn.php');
if(isset($_POST["student_ID"]))
{
	//SELECT `categories`.*, `links`.`link`, `links`.`visits` FROM `categories`, `links` WHERE `categories`.`id`=2 AND `links`.`visits`>13
 $query_product = "SELECT studentx.fname, studentx.lname, credit_student_account.total_bal FROM studentx, credit_student_account WHERE studentx.studentx_ID = '". $_POST["student_ID"]."' AND credit_student_account.studentx_ID = '". $_POST["student_ID"]."' ";
 $result_product = mysqli_query($cnn, $query_product);
 while($rrow = mysqli_fetch_array($result_product))
 {
  //$data["studentx_ID"] 		= $rrow["studentx_ID"];
  $data["fullname"]			= $rrow["fname"]. " ". $rrow["lname"];
  $data["lname"]			= $rrow["lname"];
  $data["bal"]				= $rrow["total_bal"];
  
 }

 echo json_encode($data);
}
?>
