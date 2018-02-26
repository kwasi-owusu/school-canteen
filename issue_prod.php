								<?php
								session_start();
								include_once('conn/conn.php');
								?>

  
  
		<!-- Jquery UI-->
  <link rel="stylesheet" href="assets/jquery/dist/jquery-ui.css" />
  <script src="assets/jquery/dist/jquery-1.10.2.js"></script>
  <script src="assets/jquery/dist/jquery-ui.js"></script>
  <!-- autocomplete -->
   <script>
  $(function() {
    $( "#search_prod_name" ).autocomplete({
      source: 'processing/search_for_prod_to_issue.php'
    });
  });
  </script>
  
  
		<style>
			input
			{
				margin:5px;
			}
		</style>
			<div class="row">
           <div class="col-md-10 col-md-offset-1 bxshdw">
           	<div class="box-header">
         <span style="font-weight: bold; color: #444;" id="submit_output"></span>
          <div class="panel-heading">
            <div class="widget-icons pull-right">
                    <a href=""><i class="fa fa-times wclose"></i></a>
                  </div>  
                  <div class="clearfix"></div>
          </div>
        </div>
			<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Issue/Transfer Product- FIFO (First to Expire)</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="post" id="issue_product_frm" autocomplete="off">
              <div class="box-body">
              	
              	
              	<div class="form-group">
              	<label for="inputEmail3" class="col-sm-2 control-label">Select Location</label>

                  <div class="col-sm-4">
                    <select class="form-control" name="location" id="location">
                    <?php
                        $sup="SELECT warehse_cat_ID, wh_stored FROM warehse_cat  ORDER BY wh_stored ASC";
						$qms=mysqli_query($cnn, $sup) or die(mysql_error());

						while ($dms=mysqli_fetch_array($qms))
						{
							?>                           
                    <option value="<?php echo $dms['warehse_cat_ID']; ?>"><?php echo $dms['wh_stored']; ?></option>
                   				 <?php
									}
								  ?>
                  </select>

                  </div>
              	
              	
              	<label for="inputEmail3" class="col-sm-2 control-label">Product Name</label>

                  <div class="col-sm-4 ui-widget ui-widget">
                    <input type="text" class="form-control chk_product" placeholder="Name of Product" name="search_prod_name" id="search_prod_name">
                    
                  </div>
                    </div>
                  
                  <hr />
              	
              	<div class="form-group">
              		<label for="inputEmail3" class="col-sm-2 control-label">Batch Number</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Batch Number" name="batch_number" id="batch_number" readonly>
                  </div>
                  
                  
                  <label for="inputEmail3" class="col-sm-2 control-label">Quantity in Stock</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Batch Quantity" name="whse_qty" id="whse_qty" readonly>
                  </div>
                
                  
                </div>
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Warehouse Stored</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Warehouse Stored" name="wh_stored" id="wh_stored" readonly>
                  </div>
                  
                  <label for="inputEmail3" class="col-sm-2 control-label">Warehouse Row Number</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Warehouse Row Number" name="wh_row_number" id="wh_row_number" readonly>
                  </div>
                
                  
                </div>
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Warehouse Shelve Number</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Warehouse Shelve Number" name="wh_shelve_num" id="wh_shelve_num" readonly>
                  </div>
                  
                  <label for="inputEmail3" class="col-sm-2 control-label">Date Manufactured</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Date Manufactured" name="manu_dt" id="manu_dt" readonly>
                  </div>
                
                  
                </div>
                  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Expiry Date </label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Expiry Date" name="expiry_dt" id="expiry_dt" readonly>
                  </div>
                  
                  <label for="inputEmail3" class="col-sm-2 control-label">Quantity to Issue</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Quantity" name="issued_qty" id="issued_qty">
                  </div>
                  </div>
                  
                  
                  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Issue To</label>

                  <div class="col-sm-4">
                    <select class="form-control" name="issued_to" id="issued_to">
                    <optgroup>
                    	<option value="Production">Production</option>
                    	<option value="Sales Person">Sales Person</option>
                    	<option value="Canteen">Canteen</option>
                    	<optgroup>
                    		<option> <strong> --- Loan Product ---</strong></option>
                    		<?php
                        $pat="SELECT comp_name FROM partner_company  ORDER BY comp_name ASC";
						$pms=mysqli_query($cnn, $pat) or die(mysql_error());

						while ($p_ms=mysqli_fetch_array($pms))
						{
							?>                           
                    <option value="<?php echo $p_ms['comp_name']. " (Loan)"; ?>"><?php echo $p_ms['comp_name']; ?></option>
                   				 <?php
									}
								  ?>
                    	</optgroup>
                    </optgroup>
                  </select>
                  </div>
                
                  	<label for="inputEmail3" class="col-sm-2 control-label">Person In Charge</label>
                  	<div class="col-sm-4">
                    <select class="form-control" name="person" id="person">
                    <?php
                        $sup="SELECT fname, lname FROM portal_uzas  ORDER BY user_ID ASC";
						$qms=mysqli_query($cnn, $sup) or die(mysql_error());

						while ($dms=mysqli_fetch_array($qms))
						{
							?>                           
                    <option value="<?php echo $dms['lname']. " ". $dms['fname']; ?>"><?php echo $dms['lname']. " ". $dms['fname']; ?></option>
                   				 <?php
									}
								  ?>
                  </select>
                  </div>
                  </div>
                
              
              <hr />
              
                   
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button class="btn btn-info pull-right" name="addmore" id="addmore">Add More</button>
               
              </div>
              
              
              <!-- /.box-footer -->
            
            <h4>Issue/Transfer Product</h4>
            <hr />
           <table class="table-responsive" id="table" style="width: 100%; margin: auto; padding: 5px;">
            	<tr>
            		<th> Product</th>
            		<th> Batch</th>
            		<th>Quantity <br />in Stock</th>
            		<th> Warehouse</th>
            		<th> Row </th>
            		<th> Shelve </th>
            		<th> Date <br />Manu</th>
            		<th> Expiry <br />Date</th>
            		<th> Quantity <br />Issued</th>
            		<th> Issued To</th>
            		<th> Receipient</th>
            		
            		
            	</tr>
            	
            </table>
            
	            <div class="box-footer">
                
                <button class="btn btn-info pull-right" name="save" id="save">Save</button>
               
              </div>
               
          </div>
        </form>
 
 <!-- select from database and populate into field -->
   
  
   


 <script>
 //add table rows for cart*/

$('#addmore').click(function(e){
  
    e.preventDefault(); // Prevent Default Submission
  	$.post('issue_prod.php', $(this).serialize() )
    
   
	var table = document.getElementById("table"),
	newRow 		= table.insertRow(table.length),
	cell1 		= newRow.insertCell(0),
	cell2 		= newRow.insertCell(1),
	cell3 		= newRow.insertCell(2),
	cell4 		= newRow.insertCell(3),
	cell5 		= newRow.insertCell(4),
	cell6 		= newRow.insertCell(5),
	cell7 		= newRow.insertCell(6),
	cell8 		= newRow.insertCell(7),
	cell9 		= newRow.insertCell(8),
	cell10 		= newRow.insertCell(9),
	cell11 		= newRow.insertCell(10),
	
	
	product_Name 	= $('#search_prod_name').val(),
	batch_num 		= $('#batch_number').val(),
	qty_in_whse	 	= $('#whse_qty').val(),
	wh_location	 	= $('#wh_stored').val(),
	wh_row		 	= $('#wh_row_number').val(),
	wh_shelve 		= $('#wh_shelve_num').val();
	man_dt	 		= $('#manu_dt').val();
	expriry_dt 		= $('#expiry_dt').val();
	issued_qty 		= $('#issued_qty').val();
	issued_to 		= $('#issued_to').val();
	receipient		= $('#person').val();
	
	
	cell1.innerHTML	 	= product_Name;
	cell2.innerHTML 	= batch_num;
	cell3.innerHTML 	= qty_in_whse;
	cell4.innerHTML 	= wh_location;
	cell5.innerHTML 	= wh_row;
	cell6.innerHTML 	= wh_shelve;
	cell7.innerHTML 	= man_dt;
	cell8.innerHTML 	= expriry_dt;
	cell9.innerHTML 	= issued_qty;
	cell10.innerHTML 	= issued_to;
	cell11.innerHTML 	= receipient;
	
	


 
$('#save').click(function(e){
	
e.preventDefault(); // Prevent Default Submission
  var pproduct_Name = [];
  var bbatch		= [];
  var whse_qty	 	= [];
  var wh_stored		= [];
  var wwh_row_number= [];
  var wwh_shelve_num = [];
  var mmanu_dt		 =[];
  var eexpiry_dt	=[];
  var iissued_qty	=[];
  var iissued_to	=[];
  var iin_charge	=[];
 
 $(cell1).each(function(){
   pproduct_Name.push($(this).text());
  });
  
  $(cell2).each(function(){
   bbatch.push($(this).text());
  });
  
  $(cell3).each(function(){
   whse_qty.push($(this).text());
  });
  
  $(cell4).each(function(){
   wh_stored.push($(this).text());
  });
  
  $(cell5).each(function(){
   wwh_row_number.push($(this).text());
  });
  
  $(cell6).each(function(){
   wwh_shelve_num.push($(this).text());
  });
  
  $(cell7).each(function(){
   mmanu_dt.push($(this).text());
  });
  
  $(cell8).each(function(){
   eexpiry_dt.push($(this).text());
  });
  
  $(cell9).each(function(){
   iissued_qty.push($(this).text());
  });
  
    $(cell10).each(function(){
   iissued_to.push($(this).text());
  });
   
       $(cell11).each(function(){
   iin_charge.push($(this).text());
  });
   
  
  $.ajax({
   url:"processing/process_issued_products.php",
   method:"POST",
   data:{pproduct_Name:pproduct_Name, bbatch:bbatch, whse_qty:whse_qty, wh_stored:wh_stored, wwh_row_number:wwh_row_number, wwh_shelve_num:wwh_shelve_num, mmanu_dt:mmanu_dt, eexpiry_dt:eexpiry_dt, iissued_qty:iissued_qty, iissued_to:iissued_to, iin_charge:iin_charge},
   success:function(data)
   {
		$('#submit_output').fadeOut('slow', function(){
          $('#submit_output').fadeIn('slow').html(data);
          $("#issue_product_frm").trigger("reset");
        });
        // delete all table rows after successful insert
        table.deleteRow(1);
   }
  });
 });
$("#issue_product_frm").trigger("reset");
});
</script>    

 <script> 
  $(document).ready(function(){	     
  	
 $('.chk_product').on('change, paste, blur', function() {
 
var prodd_name = $(this).val();
var location = $('#location').val();
$.ajax({
   url:"processing/select_for_issue.php",
   method: "POST",
   data:{prodd_name: prodd_name, location:location},
   dataType: "JSON",
   
  success:function(data)
  {
      		$('#batch_number').val(data.batch_num);
               $('#product_name').val(data.product_name);
               	$('#whse_qty').val(data.whse_qty);
               		$('#wh_stored').val(data.wh_stored);
               			$('#wh_row_number').val(data.wh_row_number);
               				$('#wh_shelve_num').val(data.wh_shelve_num);
               					$('#manu_dt').val(data.manu_dt);
               						$('#expiry_dt').val(data.expiry_dt);
               							 
           
   }		}); });	}); 
  </script> 


