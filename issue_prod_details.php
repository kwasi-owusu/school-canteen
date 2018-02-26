<?php
session_start();
include_once('conn/conn.php');

$ssql = 'SELECT * FROM products_storage WHERE storage_ID = ' .$_GET['id'];
$product = mysqli_query($cnn,$ssql);
$row = mysqli_fetch_assoc($product);
?>


    <!-- Main content -->
    
      <!-- title row -->
      
      <div class="row">
      	
           <div class="col-md-12 bxshdw">
           	
			<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Deails of Products in Warehouse</h3>
              <h5>Stored by:  <?php echo $row['moved_by'];?> on <?php echo $row['dt_moved'];?></h5>
              <hr />
               <h4 style="font-weight: bold; color: #444;" id="submit_output"></h4>
              
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="post" id="stock_whs_frm" autocomplete="off">
            	
              <div class="box-body">
              	
              	<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Product Name</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="product_name" readonly name="product_name" value="<?php echo $row['product_name'];?>">
                  </div>
                
                  <label for="inputEmail3" class="col-sm-2 control-label">Batch Number</label>

                  <div class="col-sm-4">
                    <input type="tel" class="form-control" id="batch_number" readonly placeholder="Batch Number" name="batch_number" required value="<?php echo $row['batch_num'];?>">
                  </div>
                </div>
                
                  <h4 class="box-title">Issue Product from Warehouse</h4>
                  
                  <hr />
                  
                  <div class="form-group">
                 <label for="inputPassword3" class="col-sm-2 control-label">Choose Designation</label>

                  <div class="col-sm-4">
                    <select class="form-control" name="department" id="department">
                    <?php
                        $uza="SELECT sellnsell_uza_level FROM portal_uzas  ORDER BY sellnsell_uza_level ASC";
						$qms=mysqli_query($cnn, $uza) or die(mysql_error());

						while ($dms=mysqli_fetch_array($qms))
						{
							?>                           
                    <option value="<?php echo $dms['sellnsell_uza_level']; ?>"><?php echo $dms['sellnsell_uza_level']; ?></option>
                   				 <?php
									}
								  ?>
                  </select>

                  </div>
                 
                 
                  <label for="inputEmail3" class="col-sm-2 control-label">Select Person In Charge</label>

                  <div class="col-sm-4">
                    <select class="form-control" name="person" id="pseron">
                    <?php
                        $name="SELECT fname, lname FROM portal_uzas  ORDER BY user_ID ASC";
						$name_query=mysqli_query($cnn, $name) or die(mysql_error());

						while ($nnn=mysqli_fetch_array($name_query))
						{
							?>                           
                    <option value="<?php echo $nnn['fname']. " ". $nnn['lname']; ?>"><?php echo $nnn['fname']. " ". $nnn['lname']; ?></option>
                   				 <?php
									}
								  ?>
                  </select>
                  </div>
                   </div>
                   
                   <hr />
                  
                  <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Quantity Issueing </label>

                  <div class="col-sm-4">
                    <input type="number" class="form-control" name="qty_issue" id="qty_issue">
                  </div>
                  
                 </div>
                  
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" class="btn btn-info pull-right" id="addmore">Add More</button>
              </div>
              
              <div class="row no-print">
        <div class="col-xs-12">
          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          
          
        </div>
      </div>
              <!-- /.box-footer -->
            </form>
            
          </div>
          </div>
          </div>
          
          

      <!-- this row will not appear when printing -->
   
    <!-- /.content -->
    <div class="clearfix"></div>
   
  		

    <script>
 //add table rows for cart*/

$('#addmore').click(function(e){
  
    e.preventDefault(); // Prevent Default Submission
  	$.post('rfq.php', $(this).serialize() )
    
   
	var table = document.getElementById("table"),
	newRow 		= table.insertRow(table.length),
	cell1 		= newRow.insertCell(0),
	cell2 		= newRow.insertCell(1),
	cell3 		= newRow.insertCell(2),
	cell4 		= newRow.insertCell(3),
	cell5 		= newRow.insertCell(4),
	
	
	
	prodName 		= $('#product_name').val(),
	batch_num 		= $('#batch_number').val(),
	department	 	= $('#department').val(),
	person		 	= $('#person').val(),
	qty_issued	 	= $('#qty_issue').val();
	
	
	
	cell1.innerHTML = prodName;
	cell2.innerHTML = batch_num;
	cell3.innerHTML = department;
	cell4.innerHTML = person;
	cell5.innerHTML = qty_issued;
	

 
$('#save').click(function(e){
	
e.preventDefault(); // Prevent Default Submission
  var pproduct_Name = [];
  var prod_desc 	= [];
  var supp	 		= [];
  var supp_ref 		= [];
  var qty 			= [];
  
  var ttable = document.getElementById("table");
 
 $(cell1).each(function(){
   pproduct_Name.push($(this).text());
  });
  
  $(cell3).each(function(){
   prod_desc.push($(this).text());
  });
  
  $(cell4).each(function(){
   supp.push($(this).text());
  });
  
  $(cell5).each(function(){
   supp_ref.push($(this).text());
  });
  
  $(cell6).each(function(){
   qty.push($(this).text());
  });
   
  
  $.ajax({
   url:"processing/process_rfq.php",
   method:"POST",
   data:{pproduct_Name:pproduct_Name, prod_desc:prod_desc, supp:supp, supp_ref:supp_ref, qty:qty},
   success:function(data)
   {
		$('#submit_output').fadeOut('slow', function(){
          $('#submit_output').fadeIn('slow').html(data);
          $("#supplier_frm").trigger("reset");
        });
        //delete a row 
	 ttable.deleteRow(1);
   }
  });
 });
 
$("#sell_product_frm").trigger("reset");
});
</script> 
 