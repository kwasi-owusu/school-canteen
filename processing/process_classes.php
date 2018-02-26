							<?php
							include_once('../conn/conn.php');
							$error = false;

								// clean user inputs to prevent sql injections
								$class_name 	= trim($_POST['class_name']);
								$class_name		= strip_tags($class_name);
								$class_name		= htmlspecialchars($class_name);
								$cclass_name 	= mysqli_real_escape_string($cnn, $class_name);
								
								
								// check email exist or not
									$chk_classes = "SELECT class_name FROM sch_classes WHERE class_name='$cclass_name'";
									$chk_class_result 	= mysqli_query($cnn, $chk_classes);
									$chk_class_count 	= mysqli_num_rows($chk_class_result);
									if($chk_class_count !=0){
										$error = true;
										$class_Error = "$cclass_name is already registered.";
									}
									
						
				
		if( !$error ) {
									
									
														
		$query = mysqli_query($cnn, "INSERT INTO sch_classes (class_name) VALUES('".$cclass_name."')");
		
		//create activity log
		
		$activity_details = "Created Class $cclass_name";
		$qquery = mysqli_query($cnn, "INSERT INTO activity_log(activity)
		VALUES('".$activity_details."')");	
		
		if ($query) {
				$errTyp = "success";
				echo  "$cclass_name Added Successfully";
				
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
							elseif (isset($class_Error)) 
							{
							 echo $class_Error; 
							}
		 
		?>