								<?php
								session_start();
								include_once('../conn/conn.php');
								
								$error = false;
								
								// clean user inputs to prevent sql injections
								$student_ID 		= trim($_POST['student_id']);
								$student_ID 		= strip_tags($student_ID);
								$student_ID 		= htmlspecialchars($student_ID);
								$sstudent_ID    	= mysqli_real_escape_string($cnn, $student_ID);
								
								$student_name	 = trim($_POST['student_name']);
								$student_name	 = strip_tags($student_name);
								$student_name	 = htmlspecialchars($student_name);
								$sstudent_name 	 = mysqli_real_escape_string($cnn, $student_name);
								
								$credit_amt		= trim($_POST['credit_amt']);
								$credit_amt 	= strip_tags($credit_amt);
								$credit_amt 	= htmlspecialchars($credit_amt);
								$ccredit_amt    = mysqli_real_escape_string($cnn, $credit_amt);
								
								
								// basic name validation
								if (empty($ccredit_amt)){
									$error = true;
									$nameError = "Amount to Credit cannot be empty.";
								} 
							 
							// if there's no error, continue to Register Supplier
								if( !$error ) {
									
					$sold_by = $_SESSION['email'];				
					$query = mysqli_query($cnn, "UPDATE credit_student_account SET  total_bal = total_bal + $ccredit_amt WHERE studentx_ID= '".$sstudent_ID."' ");
														
									
		$activity_details = "Crediting  " .$sstudent_ID;
		$qquery = mysqli_query($cnn, "INSERT INTO activity_log(activity)
		VALUES('".$activity_details."')");	
			
			if ($query) {
				$errTyp = "success";
				echo  "$sstudent_name Credited Sucessfully";
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