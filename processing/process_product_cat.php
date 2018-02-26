							<?php
							include_once('../conn/conn.php');
							include_once('../conn/pervasive_conn.php');
							session_start();
							$error = false;

								$cat_code 	= $_POST['cat_code'];
								
								// clean user inputs to prevent sql injections
								$prod_cat 	= trim($_POST['cat_name']);
								$prod_cat 	= strip_tags($prod_cat);
								$prod_cat 	= htmlspecialchars($prod_cat);
								$pprod_cat 	= mysqli_real_escape_string($cnn, $prod_cat);
								
															
								// check email exist or not
									$chk_pro_cat = "SELECT cat_name FROM prod_cat WHERE cat_name='$pprod_cat'";
									$pro_cat_type_result = mysqli_query($cnn, $chk_pro_cat);
									$pro_cat_count = mysqli_num_rows($pro_cat_type_result);
									if($pro_cat_count !=0){
										$error = true;
										$pro_cat_Error = "$pprod_cat is already registered.";
									}
									
						
				
		if( !$error ) {
									
									
		$added_by = $_SESSION['email'];												
		$query = mysqli_query($cnn, "INSERT INTO prod_cat (ICCode, cat_name, added_by) VALUES('".$cat_code."', '".$pprod_cat."', '".$added_by."')");
			if ($query) {
					
				//if successfully inserted into mysql, further insert into pervasive for use by pastel
		$zql = "INSERT INTO InventoryCategory(ICCode, ICDesc) 
		VALUES('".$cat_code."', '".$pprod_cat."')";
		//execute query
		$perv = odbc_exec($cnnct, $zql);	
					
			}
			
			if ($perv)
				{
					
				$errTyp = "success";
				echo  "$pprod_cat Added Successfully";
				
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
							elseif (isset($pro_cat_Error)) 
							{
							 echo $pro_cat_Error; 
							}
		 
		?>