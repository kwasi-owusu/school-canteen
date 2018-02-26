								<?php
								session_start();
								include_once('conn/conn.php');

							//files for printing to thermal printer
							require __DIR__ . '/../../autoload.php';
							use Mike42\Escpos\Printer;
							use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;					

								
								$error = false;
								
								// clean user inputs to prevent sql injections
								$tckt_ID		= $_POST['ticket_id'];
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
								if( !$error ) 
								{
									
					$dt = date('Y-m-d H:i:s');;
					//echo $dt->format('Y-m-d H:i:s');
					$sold_by = $_SESSION['email'];				
					$query = mysqli_query($cnn, "INSERT INTO sell_fud (buyer_ID, sales_ticket_ID, buyer_name, menu, menu_cost, qty, sold_by) 
					VALUES('".$sstudent_ID."', '".$tckt_ID."', '".$sstudent_name."', '".$mmenu_name."', $mmenu_cost, $qqty, '".$sold_by."')");
					
					if ($query)
					{
						$newBal = mysqli_query($cnn, "UPDATE credit_student_account SET total_bal = total_bal - $total_cost");
					}
														
									
		$activity_details = "Sold  " .$mmenu_name;
		$qquery = mysqli_query($cnn, "INSERT INTO activity_log(activity)
		VALUES('".$activity_details."')");	
			
			if ($newBal) 
			{
					
					
			try 
			{
			// Enter the share name for your USB printer here
			//$connector = null;
			$connector = new WindowsPrintConnector("XP-80C");

			/* Print a "Hello world" receipt" */
			$printer = new Printer($connector);
			$printer -> text("Provident School LTD\n");
			$printer -> text("*********************\n");
			$printer -> text("Food Sales\n");
			$printer -> text("Ticket ID: $tckt_ID \n");
			$printer -> text("Student ID:  $sstudent_ID \n");
			$printer -> text("Student Name:  $sstudent_name \n");
			$printer -> text("Food Purchase:  $mmenu_name \n");
			$printer -> text("Quantity: 1 Plate \n");
			$printer -> text("Cost of food:  $mmenu_cost \n");
			$printer -> text("Total Cost GHS:  $total_cost \n");
			$printer -> text("Date Sold:  $dt \n");
			$printer -> cut();

			/*if ($printer)
			{
				echo "Printed successfully";
			}*/

			/* Close printer */
			$printer -> close();
			} catch (Exception $e) 
			{
			echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
			}
		
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