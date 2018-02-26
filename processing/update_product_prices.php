								<?php
								session_start();
								include_once('../conn/conn.php');
								$error = false;
								
								// clean user inputs to prevent sql injections
								$name 	= trim($_POST['product_name']);
								$name 	= strip_tags($name);
								$name 	= htmlspecialchars($name);
								$nname  = mysqli_real_escape_string($cnn, $name);
								
								$prod_ID 	= trim($_POST['product_ID']);
								
															
								$cost = trim($_POST['buy_price']);
								$cost = strip_tags($cost);
								$cost = htmlspecialchars($cost);
								$ccost = mysqli_real_escape_string($cnn, $cost);


								$sell_rice = trim($_POST['sell_price']);
								$sell_rice = strip_tags($sell_rice);
								$sell_rice = htmlspecialchars($sell_rice);
								$ssell_rice = mysqli_real_escape_string($cnn, $sell_rice);
								
								
									
								
								if (empty($nname)) {
									$error = true;
									$nameError = "Product Name Cannot be empty.";
								}

								
							
								
								// if there's no error, continue to Register Farmer
								if( !$error ) {
									
									// Encrypt  Generated Farmer Code using SHA256();
			
		$query = mysqli_query($cnn, "UPDATE products_master 
		 SET buy_price = '".$ccost."', unit_sell_price = '".$ssell_rice."'
		 WHERE  product_ID = $prod_ID
		 ");
		
			if ($query) {
				$errTyp = "success";
				echo  "Product Update Successfull";
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