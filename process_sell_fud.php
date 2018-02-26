								<?php
								session_start();
								include_once('../conn/conn.php');
								include('mpdf/mpdf.php');
								
								$error = false;
								
								// clean user inputs to prevent sql injections
								$menu_name 		= trim($_POST['menu_name']);
								$menu_name 		= strip_tags($menu_name);
								$menu_name 		= htmlspecialchars($menu_name);
								$mmenu_name    = mysqli_real_escape_string($cnn, $menu_name);
								
								$menu_cost 	= trim($_POST['menu_cost']);
								$menu_cost 	= strip_tags($menu_cost);
								$menu_cost 	= htmlspecialchars($menu_cost);
								$mmenu_cost = mysqli_real_escape_string($cnn, $menu_cost);
								
								$qty	 = trim($_POST['qty']);
								$qty	 = strip_tags($qty);
								$qty	 = htmlspecialchars($qty);
								$qqty 	 = mysqli_real_escape_string($cnn, $qty);
															
								$student_ID 		= trim($_POST['student_id']);
								$student_ID 		= strip_tags($student_ID);
								$student_ID 		= htmlspecialchars($student_ID);
								$sstudent_ID    	= mysqli_real_escape_string($cnn, $student_ID);
								
																
								$student_name	 = trim($_POST['student_name']);
								$student_name	 = strip_tags($student_name);
								$student_name	 = htmlspecialchars($student_name);
								$sstudent_name 	 = mysqli_real_escape_string($cnn, $student_name);
								
								$total_cost		 = $_POST['total_cost'];
								
									
								// basic name validation
								if (empty($menu_name) || empty($menu_cost)){
									$error = true;
									$nameError = "Menu name and Cost cannot be empty.";
								} 
							 
							// if there's no error, continue to Register Supplier
								if( !$error ) {
									
					$sold_by = $_SESSION['email'];				
					$query = mysqli_query($cnn, "INSERT INTO sell_fud (buyer_ID, buyer_name, menu, menu_cost, qty, sold_by) 
					VALUES('".$sstudent_ID."', '".$sstudent_name."', '".$mmenu_name."', $mmenu_cost, $qqty, '".$sold_by."')");
					
					if ($query)
					{
						$newBal = mysqli_query($cnn, "UPDATE credit_student_account SET total_bal = total_bal - $total_cost");
					}
														
									
		$activity_details = "Sold  " .$mmenu_name;
		$qquery = mysqli_query($cnn, "INSERT INTO activity_log(activity)
		VALUES('".$activity_details."')");	
			
			if ($newBal) {
				$errTyp = "success";
				echo  "$mmenu_name Food sold sucessfully";
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