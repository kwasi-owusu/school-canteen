								<?php
								session_start();
								include_once('../conn/conn.php');
								$error = false;
								
								$quarantine_ID = $_POST['quarantine_ID'];
								
								// clean user inputs to prevent sql injections
								$pproduct_name 	= $_POST['product_name'];
								
								$batch_number 	= trim($_POST['batch_number']);
								$batch_number 	= strip_tags($batch_number);
								$batch_number 	= htmlspecialchars($batch_number);
								$bbatch_number 	= mysqli_real_escape_string($cnn, $batch_number);
								
								$bbilled_qty 	= $_POST['billed_qty'];
																
								$received_qty 	= trim($_POST['received_qty']);
								$received_qty 	= strip_tags($received_qty);
								$received_qty 	= htmlspecialchars($received_qty);
								$rreceived_qty 	= mysqli_real_escape_string($cnn, $received_qty);
								
								$rrejected_qty 	= $_POST['rejected_qty'];
								
								$ssupp_name 	= $_POST['supp_name'];
								
								$ppo_Number 	= $_POST['po_Number'];
								
								$reject_reason 	= trim($_POST['reject_reason']);
								$reject_reason 	= strip_tags($reject_reason);
								$reject_reason	= htmlspecialchars($reject_reason);
								$rreject_reason	= mysqli_real_escape_string($cnn, $reject_reason);
								
								
								// basic name validation
								if (empty($rreceived_qty)){
									$error = true;
									$qtyError = "Received Quantity can not be empty";
								} 
							
							// shortage status value of 0 means there is was no shortage in supply
							// shortage status value of 1 means there was shortage in supply
							// shortage status value of 2 means the shortage has been replaced	
							
							$shortage_status = 0;
							if ($rreceived_qty < $rrejected_qty)
							{
								$shortage_status = 1;
							}
							else {
								$shortage_status = 0;
							}
							// if there's no error, continue to move goods to quarantine
								if( !$error ) {
									
		$createdby = $_SESSION['email'];					
		$insert_query = mysqli_query($cnn, "INSERT INTO quarantine(product_name, batch_num, billed_qty, received_qty, rejected_qty, supp_name, po_Number, rejected_reasons, quarantine_by, shortage_status)
		VALUES('".$pproduct_name."', '".$bbatch_number."', '".$bbilled_qty."', '".$rreceived_qty."', '".$rrejected_qty."', '".$ssupp_name."', '".$ppo_Number."', '".$rreject_reason."', '".$createdby."', $shortage_status)");
			
		
		
		
		
		//create activity log
		$activity_details = "Quarnatined Product with batch number: $bbatch_number";
		$qquery = mysqli_query($cnn, "INSERT INTO activity_log(activity, created_by)
		VALUES('".$activity_details."', '".$createdby."')");	
		
		if ($insert_query) {
				$errTyp = "success";
			//indicate product shortage is returned in quarantine
			// shortage status value of 0 means there is was no shortage in supply
			// shortage status value of 1 means there was shortage in supply
			// shortage status value of 2 means the shortage has been replaced	
		$query = mysqli_query($cnn, "UPDATE quarantine SET shortage_status = 2 WHERE quarantine_ID= '".$quarantine_ID."' ");
			echo  "Product Quarantined successfully";
			
			
				
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
							elseif (isset($qtyError)) 
							{
							 echo $qtyError; 
							}
							
		 
		?>