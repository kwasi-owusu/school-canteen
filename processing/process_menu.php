							<?php
							include_once('../conn/conn.php');
							$error = false;

								// clean user inputs to prevent sql injections
								$menu_name 		= trim($_POST['menu_name']);
								$menu_name 		= strip_tags($menu_name);
								$menu_name 		= htmlspecialchars($menu_name);
								$mmenu_name 	= mysqli_real_escape_string($cnn, $menu_name);
								
								
								// clean user inputs to prevent sql injections
								$cost_per_plate 	= trim($_POST['cost_per_plate']);
								$cost_per_plate 	= strip_tags($cost_per_plate);
								$cost_per_plate 	= htmlspecialchars($cost_per_plate);
								$ccost_per_plate 	= mysqli_real_escape_string($cnn, $cost_per_plate);
								
								// check email exist or not
									$chk_menu = "SELECT menu_name FROM sch_menu WHERE menu_name='$mmenu_name'";
									$chk_menu_result = mysqli_query($cnn, $chk_menu);
									$chk_menu_count = mysqli_num_rows($chk_menu_result);
									if($chk_menu_count !=0){
										$error = true;
										$menu_Error = "$mmenu_name is already registered.";
									}
									
						
				
		if( !$error ) {
									
									
														
		$query = mysqli_query($cnn, "INSERT INTO sch_menu (menu_name, menu_cost) VALUES('".$mmenu_name."', '".$ccost_per_plate."')");
		
		//create activity log
		
		$activity_details = "Created Tax $mmenu_name";
		$qquery = mysqli_query($cnn, "INSERT INTO activity_log(activity)
		VALUES('".$activity_details."')");	
		
		if ($query) {
				$errTyp = "success";
				echo  "$mmenu_name Added Successfully";
				
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