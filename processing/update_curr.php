							<?php
							include_once('../conn/conn.php');
							$error = false;

								// clean user inputs to prevent sql injections
								$curr_name 	= trim($_POST['curr_name']);
								$curr_name 	= strip_tags($curr_name);
								$curr_name 	= htmlspecialchars($curr_name);
								$ccurr_name 	= mysqli_real_escape_string($cnn, $curr_name);
								
								
								// clean user inputs to prevent sql injections
								$curr_rate 	= trim($_POST['curr_rate']);
								$curr_rate 	= strip_tags($curr_rate);
								$curr_rate 	= htmlspecialchars($curr_rate);
								$ccurr_rate 	= mysqli_real_escape_string($cnn, $curr_rate);
								
								
				
		if( !$error ) {
							
		$query = mysqli_query($cnn, "UPDATE currency SET  curr_rate = '".$ccurr_rate."' WHERE currency_name= '".$ccurr_name."' ");									
		
		//create activity log
		
		$activity_details = "Updated $ccurr_name rate";
		$qquery = mysqli_query($cnn, "INSERT INTO activity_log(activity)
		VALUES('".$activity_details."')");	
		
		if ($query) {
				$errTyp = "success";
				echo  "$ccurr_name Updated Successfully";
				
				} 
			else {
				$errTyp = "danger";
				echo "Something went wrong, try again later...";	
			}
		}
		?>
		
		