							<?php
							include_once('../conn/conn.php');
							$error = false;

								// clean user inputs to prevent sql injections
								$pmt_tp 	= trim($_POST['pmt_name']);
								$pmt_tp 	= strip_tags($pmt_tp);
								$pmt_tp 	= htmlspecialchars($pmt_tp);
								$ppmt_tp 	= mysqli_real_escape_string($cnn, $pmt_tp);
								
															
								// check email exist or not
									$chk_pmt = "SELECT pmt_name FROM pmt_type WHERE pmt_name='$ppmt_tp'";
									$chk_pmt_type_result = mysqli_query($cnn, $chk_pmt);
									$chk_pmt_type_count = mysqli_num_rows($chk_pmt_type_result);
									if($chk_pmt_type_count !=0){
										$error = true;
										$pmt_type_Error = "$ppmt_tp is already registered.";
									}
									
						
				
		if( !$error ) {
									
									
														
		$query = mysqli_query($cnn, "INSERT INTO pmt_type (pmt_name) VALUES('".$ppmt_tp."')");
			if ($query) {
				$errTyp = "success";
				echo  "$ppmt_tp Added Successfully";
				
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
							elseif (isset($pmt_type_Error)) 
							{
							 echo $pmt_type_Error; 
							}
		 
		?>