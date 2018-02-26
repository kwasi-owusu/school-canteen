								<?php
								session_start();
								include_once('../conn/conn.php');
								$error = false;
								
								// clean user inputs to prevent sql injections
								$name 	= trim($_POST['menu_name']);
								$name 	= strip_tags($name);
								$name 	= htmlspecialchars($name);
								$nname  = mysqli_real_escape_string($cnn, $name);
								
								$menu_ID 	= trim($_POST['menu_ID']);
								
															
								$cost = trim($_POST['menu_cost']);
								$cost = strip_tags($cost);
								$cost = htmlspecialchars($cost);
								$ccost = mysqli_real_escape_string($cnn, $cost);
								
								
									
								
								if (empty($nname)) {
									$error = true;
									$nameError = "Menu Name Cannot be empty.";
								}

								elseif (empty($ccost)) {
									$error = true;
									$costError = "Menu Cost Cannot be empty.";
								}
							
								
								// if there's no error, continue to Register Farmer
								if( !$error ) {
									
									// Encrypt  Generated Farmer Code using SHA256();
			
		$query = mysqli_query($cnn, "UPDATE sch_menu 
		 SET menu_name = '".$nname."', menu_cost = '".$ccost."'
		 WHERE  sch_menu_ID = $menu_ID
		 ");
		
			if ($query) {
				$errTyp = "success";
				echo  "Menu Update Successfull";
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
							elseif (isset($costError))
							{
								echo $costError;
							}
							
		?>