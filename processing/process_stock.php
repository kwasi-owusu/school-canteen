								<?php
								session_start();
								include_once('../conn/conn.php');
								$error = false;
								
								// clean user inputs to prevent sql injections
								$pro_cat 	= trim($_POST['product_cat']);
								$pro_cat 	= strip_tags($pro_cat);
								$pro_cat 	= htmlspecialchars($pro_cat);
								$ppro_cat 	= mysqli_real_escape_string($cnn, $pro_cat);
								
								$pro_name 	= trim($_POST['product_name']);
								$pro_name 	= strip_tags($pro_name);
								$pro_name 	= htmlspecialchars($pro_name);
								$ppro_name 	= mysqli_real_escape_string($cnn, $pro_name);
								
								$manu_name 	= trim($_POST['manu_name']);
								$manu_name 	= strip_tags($manu_name);
								$manu_name 	= htmlspecialchars($manu_name);
								$mmanu_name = mysqli_real_escape_string($cnn, $manu_name);
								
								$supp_name = trim($_POST['supp_name']);
								$supp_name = strip_tags($supp_name);
								$supp_name = htmlspecialchars($supp_name);
								$ssupp_name = mysqli_real_escape_string($cnn, $supp_name);
								
								$buy_price 	= trim($_POST['buy_price']);
								$buy_price 	= strip_tags($buy_price);
								$buy_price 	= htmlspecialchars($buy_price);
								$bbuy_price = mysqli_real_escape_string($cnn, $buy_price);
															
																
								$unit_sell_price = trim($_POST['unit_sell_price']);
								$unit_sell_price = strip_tags($unit_sell_price);
								$unit_sell_price = htmlspecialchars($unit_sell_price);
								$uunit_sell_price = mysqli_real_escape_string($cnn, $unit_sell_price);
								
								$qty = trim($_POST['qty']);
								$qty = strip_tags($qty);
								$qty = htmlspecialchars($qty);
								$qqty = mysqli_real_escape_string($cnn, $qty);						
							
								$barcode = trim($_POST['barcode']);
								$barcode = strip_tags($barcode);
								$barcode = htmlspecialchars($barcode);
								$bbarcode = mysqli_real_escape_string($cnn, $barcode);
							
								//echo 'This is manu date: '.$_POST['manu_dt'];
								$mmanu_dt	= date("Y-m-d", strtotime($_POST['manu_dt']));
								
								$eexpiry_dt	= date("Y-m-d", strtotime($_POST['expiry_dt']));
								
								
								
								// basic name validation
								if (empty($ppro_name)){
									$error = true;
									$nameError = "Enter Product Name.";
								} 
								else {
									// check product already exist or not
									$chk_query = "SELECT product_name FROM sellnsell_products WHERE product_name ='$ppro_name'";
									$chk_result = mysqli_query($cnn, $chk_query);
									$chk_count = mysqli_num_rows($chk_result);
									if($chk_count !=0){
										$error = true;
										$nameError = "Provided Product Name is already registered.";
									}
							
									if (empty($bbuy_price)) {
									$error = true;
									$buy_priceError = "Enter Unit Purchase price.";

								} 
									
									elseif (empty($uunit_sell_price)) {
									$error = true;
									$sell_priceError = "Enter Unit Purchase price.";

								} 
									
									elseif (empty($qty)) {
									$error = true;
									$qtyError = "Enter Quantity of products.";

								} 
									
									elseif (empty($barcode)) {
									$error = true;
									$bar_codeError = "Enter Barcode Number.";

								} 
									
							
							// if there's no error, continue to Register Supplier
								if( !$error ) {
									
									
		$query = mysqli_query($cnn, "INSERT INTO sellnsell_products(product_cat, product_name, manu_name, supp_name, buy_price, unit_sell_price, qty, barcode, manu_dt, expiry_dt)
		VALUES('".$ppro_cat."', '".$ppro_name."', '".$mmanu_name."', '".$ssupp_name."', '".$bbuy_price."', '".$uunit_sell_price."', '".$qqty."', '".$bbarcode."', CAST('". $mmanu_dt ."' AS DATE), CAST('". $eexpiry_dt ."' AS DATE))");
		
		
		//create activity log
		
		$activity_details = "Created $wwarehouse_name";
		$query = mysqli_query($cnn, "INSERT INTO activity_log(activity)
		VALUES('".$activity_details."')");	
		
		
		
		
		
		if ($query) {
		$errTyp = "success";
		echo  "$mmanu_dt Product Stocked Successfully";
				} 
			
					else {
				$errTyp = "danger";
				$errMSG = "$mmanu_dt Something went wrong, try again later...";	
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
							elseif (isset($buy_priceError))
							{
								echo $buy_priceError;
							}
							elseif (isset($sell_priceError))
							{
								echo $sell_priceError;
							}
							
							elseif (isset($qtyError))
							{
								echo $qtyError;
							}
							
						elseif (isset($bar_codeError))
						{
							echo $bar_codeError;
						}
						}
		 
						?>