							<?php
							include_once('../conn/conn.php');
							$error = false;

								// clean user inputs to prevent sql injections
								$uom 	= trim($_POST['uom']);
								$uom 	= strip_tags($uom);
								$uom 	= htmlspecialchars($uom);
								$uuom 	= mysqli_real_escape_string($cnn, $uom);
								
															
								// check email exist or not
									$chk_uom = "SELECT uom FROM uom WHERE uom='$uuom'";
									$chk_uom_result = mysqli_query($cnn, $chk_uom);
									$chk_uom_count = mysqli_num_rows($chk_uom_result);
									if($chk_uom_count !=0){
										$error = true;
										$tax_Error = "$uuom is already registered.";
									}
									
						
				
		if( !$error ) {
									
									
														
		$query = mysqli_query($cnn, "INSERT INTO uom (uom) VALUES('".$uuom."')");
			
		//create activity log
		
		$activity_details = "Created UOM $uuom";
		$qquery = mysqli_query($cnn, "INSERT INTO activity_log(activity)
		VALUES('".$activity_details."')");	
		
		
			if ($query) {
				$errTyp = "success";
				echo  "$uuom Added Successfully";
				
				} 
			else {
				$errTyp = "danger";
				echo "Something went wrong, try again later...";	
			}
		}
		?>
		
		<?php 
		
							if ( isset($errMSG) ) 
							{
								
							 echo $errMSG; 
							}
							elseif (isset($tax_Error)) 
							{
							 echo $tax_Error; 
							}
		 
		?>