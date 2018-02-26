								<?php
								session_start();
								include_once('../conn/conn.php');
								$error = false;
								
								// clean user inputs to prevent sql injections
								$fname 	= trim($_POST['fname']);
								$fname 	= strip_tags($fname);
								$fname 	= htmlspecialchars($fname);
								$FFName = mysqli_real_escape_string($cnn, $fname);
								
								$lname 	= trim($_POST['lname']);
								$lname 	= strip_tags($lname);
								$lname 	= htmlspecialchars($lname);
								$LLName = mysqli_real_escape_string($cnn, $lname);
															
															
								$phone = trim($_POST['uza_phone']);
								$phone = strip_tags($phone);
								$phone = htmlspecialchars($phone);
								$pphone = mysqli_real_escape_string($cnn, $phone);
								
								$address = trim($_POST['address1']);
								$address = strip_tags($address);
								$address = htmlspecialchars($address);
								$aaddress = mysqli_real_escape_string($cnn, $address);
								
								$address2 = trim($_POST['address2']);
								$address2 = strip_tags($address2);
								$address2 = htmlspecialchars($address2);
								$aaddress2 = mysqli_real_escape_string($cnn, $address2);						
							
								$email = trim($_POST['email']);
								$email = strip_tags($email);
								$email = htmlspecialchars($email);
								$Eemail = mysqli_real_escape_string($cnn, $email);
							
								$passWD	= trim($_POST['pwd']);
								$passWD = strip_tags($passWD);
								$passWD	= htmlspecialchars($passWD);
								$ppassWD 	= mysqli_real_escape_string($cnn, $passWD);
								
								
								$userID			= $_POST['userID'];
								$uza_status		= $_POST['uza_status'];
								$uza_level 		= $_POST['sellnsell_uza_level'];
								
							//basic email validation
								if ( !filter_var($Eemail,FILTER_VALIDATE_EMAIL) ) {
									$error = true;
									$emailError = "Please enter a valid email address.";
								} 
									
								
								if (empty($ppassWD)) {
									$error = true;
									$pwdError = "Password Cannot be empty.";
								}
							
								
								// if there's no error, continue to Register Farmer
								if( !$error ) {
									
									// Encrypt  Generated Farmer Code using SHA256();
									$harshpwd = hash('sha256', $ppassWD);
									
									
		$query = mysqli_query($cnn, "UPDATE portal_uzas 
		 SET fname = '".$FFName."', lname = '".$LLName."', uza_phone = '".$pphone."', address1 = '".$aaddress."', address2 = '".$aaddress2."', email = '".$Eemail."', pwd = '".$harshpwd."',
		 uza_status = $uza_status, sellnsell_uza_level = '".$uza_level."' 
		 WHERE  user_ID = $userID
		 ");
		
			if ($query) {
				$errTyp = "success";
				echo  "User Update Successfull";
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
							elseif (isset($emailError))
							{
								echo $emailError;
							}
							elseif (isset($pwdError))
							{
								echo $pwdError;
							}
		 
		?>