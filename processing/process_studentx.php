								<?php
								session_start();
								
								//connect to pervasive
								include_once('../conn/conn.php');
								
								$error = false;
								
								// clean user inputs to prevent sql injections
								$student_ID 	= trim($_POST['student_ID']);
								$student_ID 	= strip_tags($student_ID);
								$student_ID 	= htmlspecialchars($student_ID);
								$sstudent_ID    = mysqli_real_escape_string($cnn, $student_ID);
								
								$fname = trim($_POST['fname']);
								$fname = strip_tags($fname);
								$fname = htmlspecialchars($fname);
								$ffname = mysqli_real_escape_string($cnn, $fname);
								
								$lname = trim($_POST['lname']);
								$lname = strip_tags($lname);
								$lname = htmlspecialchars($lname);
								$lastname = mysqli_real_escape_string($cnn, $lname);
															
																
								$parent_guardian	 = trim($_POST['parent_guardian']);
								$parent_guardian	 = strip_tags($parent_guardian);
								$parent_guardian	 = htmlspecialchars($parent_guardian);
								$pparent_guardian 	 = mysqli_real_escape_string($cnn, $parent_guardian);
								
								$parent_guardian_numb  = trim($_POST['parent_guardian_numb']);
								$parent_guardian_numb  = strip_tags($parent_guardian_numb);
								$parent_guardian_numb  = htmlspecialchars($parent_guardian_numb);
								$pparent_guardian_numb = mysqli_real_escape_string($cnn, $parent_guardian_numb);						
							
								$address1 = trim($_POST['address1']);
								$address1 = strip_tags($address1);
								$address1 = htmlspecialchars($address1);
								$aaddress1 = mysqli_real_escape_string($cnn, $address1);
								
								$address2 = trim($_POST['address2']);
								$address2 = strip_tags($address2);
								$address2 = htmlspecialchars($address2);
								$aaddress2 = mysqli_real_escape_string($cnn, $address2);
							
								$current_class 			= trim($_POST['current_class']);
								$current_class 			= strip_tags($current_class);
								$current_class			= htmlspecialchars($current_class);
								$ccurrent_class 		= mysqli_real_escape_string($cnn, $current_class);
								
								$medical_condition 			= trim($_POST['medical_condition']);
								$medical_condition 			= strip_tags($medical_condition);
								$medical_condition			= htmlspecialchars($medical_condition);
								$mmedical_condition 		= mysqli_real_escape_string($cnn, $medical_condition);
								
								
								// basic name validation
								if (empty($fname) || empty($lname)){
									$error = true;
									$nameError = "Enter Student Name.";
								} else if (!preg_match("/^[a-zA-Z ]+$/",$ffname,$llname )) {
									$error = true;
									$nameError = "Student name must contain alphabets and space.";
								}
									
							
							else {
									// check email exist or not
					$chk_std = "SELECT studentx_ID FROM studentx WHERE studentx_ID ='$sstudent_ID'";
									$chk_std_result = mysqli_query($cnn, $chk_std);
									$chk_std_count = mysqli_num_rows($chk_std_result);
									if($chk_std_count !=0){
										$error = true;
										$stdError = "Provided Student ID is already registered.";
									}
							}
							// if there's no error, continue to Register Supplier
								if( !$error ) {
									
		$created_by = $_SESSION['email'];									
		$query = mysqli_query($cnn, "INSERT INTO studentx (studentx_ID, fname, lname, parent_guard, parent_guard_numb, address_ln1, address_ln2, current_class, medical_condition, created_by) 
		VALUES('".$sstudent_ID."', '".$ffname."', '".$lastname."', '".$pparent_guardian."', '".$pparent_guardian_numb."', '".$aaddress1."', '".$aaddress2."', '".$ccurrent_class."', '".$mmedical_condition."', '".$created_by."')");
		
									
		$activity_details = "Created Student " .$ffname." ". "With ID". $sstudent_ID;
		$qquery = mysqli_query($cnn, "INSERT INTO activity_log(activity)
		VALUES('".$activity_details."')");	
			
	//if student registration is successful, create an account for student
	if ($query) 
{
$qquery = mysqli_query($cnn, "INSERT INTO credit_student_account (studentx_ID, opening_bal, credit_amt, total_bal, credited_by) VALUES('".$sstudent_ID."', 0, 0, 0, '".$created_by."')");
												
				
				
				$errTyp = "success";
				echo  "Student  Enrolled successfully";
				} 
			
					else {
				$errTyp = "danger";
				$errMSG = "Something went wrong, try again later...";	
					}
					}
				
						?>
						
						
							<?php 
		
							if ( isset($errMSG) ) 
							{
								
							 echo $errMSG; 
							}
							elseif (isset($nameError)) 
							{
							 echo $nameError; 
							}
							
							elseif (isset($stdError))
							{
								echo $stdError;
							}
		 
		?>