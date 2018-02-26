							<?php
							include_once('../conn/conn.php');
							$error = false;

								// clean user inputs to prevent sql injections
								$term_name 		= trim($_POST['term_name']);
								$term_name 		= strip_tags($term_name);
								$term_name 		= htmlspecialchars($term_name);
								$tterm_name 	= mysqli_real_escape_string($cnn, $term_name);
								
								
								// check email exist or not
									$chk_term = "SELECT sch_term_name FROM sch_terms WHERE sch_term_name='$tterm_name'";
									$chk_term_result = mysqli_query($cnn, $chk_term);
									$chk_term_count = mysqli_num_rows($chk_term_result);
									if($chk_term_count !=0){
										$error = true;
										$term_Error = "$tterm_name is already registered.";
									}
									
						
				
		if( !$error ) {
									
									
														
		$query = mysqli_query($cnn, "INSERT INTO sch_terms (sch_term_name) VALUES('".$tterm_name."')");
		
		//create activity log
		
		$activity_details = "Created Tax $tterm_name";
		$qquery = mysqli_query($cnn, "INSERT INTO activity_log(activity)
		VALUES('".$activity_details."')");	
		
		if ($query) {
				$errTyp = "success";
				echo  "$tterm_name Added Successfully";
				
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
							elseif (isset($term_Error)) 
							{
							 echo $term_Error; 
							}
		 
		?>