								<?php
								session_start();
								include_once('../conn/conn.php');
								//include_once('../conn/pervasive_conn.php');
								$error = false;
								
								
								$supp_code 	= $_POST['sup_code'];
								$supp_desc 	= $_POST['sup_cat'];
								
								// clean user inputs to prevent sql injections
								$supp_name 	= trim($_POST['supp_name']);
								$supp_name 	= strip_tags($supp_name);
								$supp_name 	= htmlspecialchars($supp_name);
								$ssupp_name = mysqli_real_escape_string($cnn, $supp_name);
								
								$supp_phone = trim($_POST['supp_phone']);
								$supp_phone = strip_tags($supp_phone);
								$supp_phone = htmlspecialchars($supp_phone);
								$ssupp_phone = mysqli_real_escape_string($cnn, $supp_phone);
								
								$supp_email 	= trim($_POST['supp_email']);
								$supp_email 	= strip_tags($supp_email);
								$supp_email 	= htmlspecialchars($supp_email);
								$ssupp_email = mysqli_real_escape_string($cnn, $supp_email);
															
																
								$address = trim($_POST['address1']);
								$address = strip_tags($address);
								$address = htmlspecialchars($address);
								$aaddress = mysqli_real_escape_string($cnn, $address);
								
								$address2 = trim($_POST['address2']);
								$address2 = strip_tags($address2);
								$address2 = htmlspecialchars($address2);
								$aaddress2 = mysqli_real_escape_string($cnn, $address2);						
							
								$contact_per = trim($_POST['contact_person']);
								$contact_per = strip_tags($contact_per);
								$contact_per = htmlspecialchars($contact_per);
								$ccontact_per = mysqli_real_escape_string($cnn, $contact_per);
							
								$contact_per_phone 		= trim($_POST['contact_person_phone']);
								$contact_per_phone 		= strip_tags($contact_per_phone);
								$contact_per_phone		= htmlspecialchars($contact_per_phone);
								$ccontact_per_phone 	= mysqli_real_escape_string($cnn, $contact_per_phone);
								
								
								// basic name validation
								if (empty($ssupp_name)){
									$error = true;
									$nameError = "Enter Supplier Name.";
								} 
								/*else if (!preg_match("/^[a-zA-Z ]+$/",$ssupp_name)) {
									$error = true;
									$nameError = "Supplier name must contain alphabets and space.";
								}*/
									
							//basic email validation
								if ( !filter_var($ssupp_email,FILTER_VALIDATE_EMAIL) ) {
									$error = true;
									$emailError = "Please enter a valid email address.";
								} 
									elseif (empty($ssupp_email)) {
									$error = true;
									$emailError = "Email fields cannot be empty.";

								} 
									
							
							else {
									// check email exist or not
					$chk_supp = "SELECT supp_name, supp_email FROM sellnsell_suppliers WHERE supp_name ='$ssupp_name' AND supp_email = '$ssupp_email'";
									$chk_supp_result = mysqli_query($cnn, $chk_supp);
									$chk_supp_count = mysqli_num_rows($chk_supp_result);
									if($chk_supp_count !=0){
										$error = true;
										$suppError = "Provided supplier is already registered.";
									}
							}
							// if there's no error, continue to Register Supplier
								if( !$error ) {
									
		$added_by = $_SESSION['email'];							
		$query = mysqli_query($cnn, "INSERT INTO sellnsell_suppliers(SupplCode, SupplDesc, supp_name, supp_phone, supp_email, address1, address2, contact_person, contact_person_phone, addedd_by)
		VALUES('".$supp_code."', '".$supp_desc."', '".$ssupp_name."', '".$ssupp_phone."', '".$ssupp_email."', '".$aaddress."', '".$aaddress2."', '".$ccontact_per."', '".$ccontact_per_phone."', '".$added_by."')");
			
			if ($query) {
				
				// insert into prvasive
		/*$zql = "INSERT INTO SupplierMaster(SupName, SupplCode, SupplDesc, PostAddress01, PostAddress02, Contact, Cellphone, Telephone, Email) 
		VALUES('".$ssupp_name."', '".$supp_code."', '".$supp_desc."', '".$aaddress."', '".$aaddress2."', '".$ccontact_per."', '".$ccontact_per_phone."', '".$ssupp_phone."', '".$ssupp_email."')";
		//execute query
		$perv = odbc_exec($cnnct, $zql);
				}
			
				if ($perv) {*/
				$errTyp = "success";
				echo  "Supplier registered successfully";
				} 
			
					else {
				$errTyp = "danger";
				$errMSG = "Something went wrong, try again later...$ssupp_email";	
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
							elseif (isset($suppError))
							{
								echo $suppError;
							}
		 
		?>