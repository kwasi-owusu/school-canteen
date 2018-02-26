							<?php
							session_start();
							include_once('../conn/conn.php');
							$error = false;

								// clean user inputs to prevent sql injections
								$prod_name 		= trim($_POST['product_name']);
								$prod_name 		= strip_tags($prod_name);
								$prod_name 		= htmlspecialchars($prod_name);
								$pprod_name 	= mysqli_real_escape_string($cnn, $prod_name);
								
								$qty	 		= trim($_POST['qty']);
								$qty	 		= strip_tags($qty);
								$qty	 		= htmlspecialchars($qty);
								$qqty	 		= mysqli_real_escape_string($cnn, $qty);
								
								// clean user inputs to prevent sql injections
								/*$selling_price 		= trim($_POST['selling_price']);
								$selling_price 		= strip_tags($selling_price);
								$selling_price	 	= htmlspecialchars($selling_price);
								$sselling_price 	= mysqli_real_escape_string($cnn, $selling_price);*/
								
								
				
		if( !$error ) {
		$stocked_by = $_SESSION['email'];
		$query = mysqli_query($cnn, "INSERT INTO canteen_product (product_name, qty, stocked_by) VALUES('".$pprod_name."', '".$qqty."', '".$stocked_by."')");
		
		
		if ($query) 
		
				{
					//adjust total quantity for specific product in the product master table
				$qquery_master = mysqli_query($cnn, "UPDATE products_master SET  total_qty = total_qty + $qqty WHERE product_name= '".$pprod_name."' ");
			
				$errTyp = "success";
				echo  "$pprod_name Stocked Successfully";
				
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
							elseif (isset($menu_Error)) 
							{
							 echo $menu_Error; 
							}
		 
		?>