								<?php
								session_start();
								include_once('../conn/conn.php');
								$error = false;
								
								// clean user inputs to prevent sql injections
								$product_code 	= trim($_POST['product_code']);
								$product_code 	= strip_tags($product_code);
								$product_code 	= htmlspecialchars($product_code);
								$pproduct_code 	= mysqli_real_escape_string($cnn, $product_code);
								
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
								
								/*$buy_price 	= trim($_POST['buy_price']);
								$buy_price 	= strip_tags($buy_price);
								$buy_price 	= htmlspecialchars($buy_price);
								$bbuy_price = mysqli_real_escape_string($cnn, $buy_price);
															
																
								$unit_sell_price = trim($_POST['unit_sell_price']);
								$unit_sell_price = strip_tags($unit_sell_price);
								$unit_sell_price = htmlspecialchars($unit_sell_price);
								$uunit_sell_price = mysqli_real_escape_string($cnn, $unit_sell_price);
								*/
								
								$barcode 	= trim($_POST['barcode']);
								$barcode 	= strip_tags($barcode);
								$barcode 	= htmlspecialchars($barcode);
								$bbarcode 	= mysqli_real_escape_string($cnn, $barcode);
								
								 
								$int_ref = trim($_POST['Internal_ref']);
								$int_ref = strip_tags($int_ref);
								$int_ref = htmlspecialchars($int_ref);
								$iint_ref = mysqli_real_escape_string($cnn, $int_ref);						
							
								
								$reorder_rules = trim($_POST['reorder_rules']);
								$reorder_rules = strip_tags($reorder_rules);
								$reorder_rules = htmlspecialchars($reorder_rules);
								$rreorder_rules = mysqli_real_escape_string($cnn, $reorder_rules);
								
								$uom = trim($_POST['uom']);
								$uom = strip_tags($uom);
								$uom = htmlspecialchars($uom);
								$uuom = mysqli_real_escape_string($cnn, $uom);
							
							
								
								// basic name validation
								if (empty($ppro_name)){
									$error = true;
									$nameError = "Enter Product Name.";
								} 
								else {
									// check product already exist or not
									$chk_query = "SELECT product_name, product_code FROM products_master WHERE product_name ='".$ppro_name."' AND product_code = '".$pproduct_code."' ";
									$chk_result = mysqli_query($cnn, $chk_query);
									$ch_row = mysqli_fetch_array($chk_result);
									$chk_count = mysqli_num_rows($chk_result);
									if($chk_count !=0){
										$error = true;
										$nameError = "Provided Product Name is already registered.";
									}
							
									if (empty($ppro_name)) {
									$error = true;
									$ppro_nameError = "Product Name Cannot be empty.";

								} 
									 
									
								elseif (empty($rreorder_rules)) {
									$error = true;
									$rreorder_rulesError = "Indicate the minimum quantity to be alerted for shortage.";

								} 
									/*
									elseif ($bbuy_price > $uunit_sell_price) {
									$error = true;
									$qtyError = "Selling Price must be more than Purchased Price ";

								} 
									
									elseif (empty($barcode)) {
									$error = true;
									$bar_codeError = "Enter Barcode Number.";

								} 
									 * */
							
		// if there's no error, continue to Register Supplier
		if( !$error ) {
		$entereby = $_SESSION['email'];							
		//echo $ppro_cat;						
		$query = mysqli_query($cnn, "INSERT INTO products_master(product_code, product_cat, product_name, manu_name, supp_name, Internal_ref, barcode, re_order_rule, uom, entered_by)
		VALUES('".$pproduct_code."', '".$ppro_cat."', '".$ppro_name."', '".$mmanu_name."', '".$ssupp_name."', '".$iint_ref."', '".$bbarcode."', $rreorder_rules, '". $uuom ."', '". $entereby ."')");
			
			if ($query)
			 {
				echo  "$ppro_name Added Successfully";
					
					
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
							elseif (isset($ppro_nameError)) 
							{
							 echo $ppro_nameError; 
							}
							elseif (isset($rreorder_rulesError))
							{
								echo $rreorder_rulesError;
							}
							
						}
		 
						?>