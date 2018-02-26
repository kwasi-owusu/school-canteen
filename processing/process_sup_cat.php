							<?php
							include_once('../conn/conn.php');
							session_start();
							$error = false;

								// clean user inputs to prevent sql injections
								$sup_code 	= $_POST['sup_code'];
								
								$cat 	= trim($_POST['sup_cat']);
								$cat 	= strip_tags($cat);
								$cat 	= htmlspecialchars($cat);
								$ccat 	= mysqli_real_escape_string($cnn, $cat);
								
															
								// check email exist or not
									$chk_cust_cat = "SELECT SCCode, SCDesc FROM suppliercategories WHERE SCDesc='sup_cat' OR SCCode = '$sup_code' ";
									$cust_cat_type_result = mysqli_query($cnn, $chk_cust_cat);
									$cust_cat_count = mysqli_num_rows($cust_cat_type_result);
									if($cust_cat_count !=0){
										$error = true;
										$cust_cat_Error = "$ccat is already entered.";
									}
									
						
				
		if( !$error ) {
									
									
		$added_by = $_SESSION['email'];												
		$query = mysqli_query($cnn, "INSERT INTO suppliercategories (SCCode, SCDesc) VALUES($sup_code, '".$ccat."')");
			
			
			if ($query) {
		
		/* // select what was just inserted from mysql and insert into prvasive
			
		$zql = "INSERT INTO SupplierCategories(SCCode, SCDesc) 
		VALUES($sup_code, '".$ccat."')";
		//execute query
		$perv = odbc_exec($cnnct, $zql);
			}
			
			if($perv)	
				{*/
				$errTyp = "success";
				echo  "$ccat Added Successfully";
				
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
							elseif (isset($cust_cat_Error)) 
							{
							 echo $cust_cat_Error; 
							}
		 
		?>