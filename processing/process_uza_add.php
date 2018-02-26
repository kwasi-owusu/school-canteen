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
								
								
								
								$uza_level = trim($_POST['sellnsell_uza_level']);
								$uza_level = strip_tags($uza_level);
								$uza_level = htmlspecialchars($uza_level);
								
								// basic name validation
								if (empty($fname) && empty($lname)) {
									$error = true;
									$nameError = "Enter Your Name.";
								} else if (!preg_match("/^[a-zA-Z ]+$/",$fname)) {
									$error = true;
									$nameError = "Name must contain alphabets and space.";
								}
									else if (!preg_match("/^[a-zA-Z ]+$/",$lname)) {
									$error = true;
									$nameError = "Name must contain alphabets and space.";
								}
							
							//basic email validation
								if ( !filter_var($Eemail,FILTER_VALIDATE_EMAIL) ) {
									$error = true;
									$emailError = "Please enter a valid email address.";
								} 
									elseif (empty($Eemail) && empty($Eemail1)) {
									$error = true;
									$emailError = "All Email Fields Must be filled.";

								} 
									
							
							else {
									// check email exist or not
									$chk_emailquery = "SELECT email FROM portal_uzas WHERE email ='$Eemail'";
									$chk_emailresult = mysqli_query($cnn, $chk_emailquery);
									$chk_emailcount = mysqli_num_rows($chk_emailresult);
									if($chk_emailcount !=0){
										$error = true;
										$emailError = "Provided Email is already registered.";
									}
							}
							
								
								if (empty($ppassWD)) {
									$error = true;
									$pwdError = "Password Cannot be empty.";
								}
							
								
								// if there's no error, continue to Register Farmer
								if( !$error ) {
									//Enable user after register
									
									//Assign a user level 
									$uza_status = 1;
									
									// Encrypt  Generated Farmer Code using SHA256();
									$harshpwd = hash('sha256', $ppassWD);
									
									
		$query = mysqli_query($cnn, "INSERT INTO portal_uzas(fname, lname, uza_phone, address1, address2, email, pwd, uza_status, sellnsell_uza_level)
		VALUES('".$FFName."', '".$LLName."', '".$pphone."', '".$aaddress."', '".$aaddress2."', '".$Eemail."', '".$harshpwd."', $uza_status, '".$uza_level."')");
			
			if ($query) {
				$errTyp = "success";
				echo  "User Registration is successfull";
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