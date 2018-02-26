								<?php
								session_start();
								include_once('../conn/conn.php');
								require_once('tc_pdf/tcpdf.php');
								
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
									
					$currentDateTime = date('Y-m-d H:i:s');
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
			
			if ($newBal) 
				{
				$errTyp = "success";
				
				//generate a pdf receipt
				$html = "

				<style>
						@media print {
							@page {
								margin: 0 auto; /* imprtant to logo margin */
								sheet-size: 300px 250mm; /* imprtant to set paper size */
							}
							html {
								direction: rtl;
							}
							html,body{margin:0;padding:0}
							#printContainer {
								width: 250px;
								margin: auto;
								/*padding: 10px;*/
								/*border: 2px dotted #000;*/
								text-align: justify;
							}

						   .text-center{text-align: center;}
						}
					</style>

				<div id='printContainer'>
				<table class='table' width='100%' id='tbl'>
				<tr>
				<th colspan='2'>
				Provident International Sch 
				</th>
				</tr>

				<tr>
				<td> Student ID </td>
				<td>  $sstudent_ID </td>
				</tr>

				<tr>
				<td> Student Name </td>
				<td>  $sstudent_name </td>
				</tr>

				<tr>
				<td> Menu</td>
				<td>  $mmenu_name </td>
				</tr>

				<tr>
				<td> Cost </td>
				<td>  $mmenu_cost </td>
				</tr>

				<tr>
				<td> Total Cost </td>
				<td>  $mmenu_cost </td>
				</tr>
				
				<tr>
				<td>Sold By:</td>
				<td>  $sold_by </td>
				</tr>

				<tr>
				<td> Date Sold </td>
				<td>  $currentDateTime </td>
				</tr>

				</table>
				";
					
					// create new PDF document
				$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
				// set margins
				$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

				// set auto page breaks
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
				// set some language-dependent strings (optional)
				if (@file_exists(dirname(__FILE__).'/lang/eng.php')) 
				{
					require_once(dirname(__FILE__).'/lang/eng.php');
					$pdf->setLanguageArray($l);
				}
					// set font
				$pdf->SetFont('times', 'BI', 13);

				// add a page
				$pdf->AddPage();
				// print a block of text using Write()
				$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
				
				// Close and output PDF document
				// This method has several options, check the source code documentation for more information.
				ob_end_clean();
				$pdf->Output("$sstudent_ID.pdf", 'I');

/*
				$mpdf=new mPDF();
				$mpdf->WriteHTML($html);
				//$mpdf->SetDisplayMode('fullpage');

				$mpdf->Output();*/
				
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