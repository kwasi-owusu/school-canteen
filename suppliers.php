			<?php
			session_start();
			include_once('conn/conn.php');
			?>
			
			<script>

		var chars = "0123456789ABCDEFGHIJKLP";
		var string_length = 6;
		var sup_Code = '';
		for (var i=0; i < string_length; i++) 
	{
		var rnum = Math.floor(Math.random() * chars.length);
		sup_Code += chars.substring(rnum,rnum+1);
	}
		document.getElementById("sup_code").value = sup_Code;

		</script>
			
			<div class="row">
           <div class="col-md-8 col-md-offset-2 bxshdw">
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
              <h3 class="box-title">Add New Supplier <small>(All fields are required)</small></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="post" id="supplier_frm" autocomplete="off">
              <div class="box-body">
              	
              	<div class="form-group">
              		
              		<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Supplier Description</label>

                  <div class="col-sm-4">
                    <select class="form-control" name="sup_cat" id="sup_cat">
                    <?php
                        $sup="SELECT SCCode, SCDesc FROM suppliercategories  ORDER BY SCCode ASC";
						$qms=mysqli_query($cnn, $sup) or die(mysql_error());

						while ($dms=mysqli_fetch_array($qms))
						{
							?>                           
                    <option value="<?php echo $dms['SCDesc']; ?>"><?php echo $dms['SCDesc']; ?></option>
                   				 <?php
									}
								  ?>
                  </select>
                  </div>
                  
                   <label for="Customer_code" class="col-sm-2 control-label">Supplier Code</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="sup_code" placeholder="Suoplier Code" name="sup_code" readonly>
                  </div>
                  
                </div>
                  <label for="inputEmail3" class="col-sm-2 control-label">Name of Supplier</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Supplier Name" name="supp_name" required>
                  </div>
                
                  <label for="inputEmail3" class="col-sm-2 control-label">Supplier Phone Number</label>

                  <div class="col-sm-4">
                    <input type="tel" class="form-control" id="inputEmail3" placeholder="Phone Number" name="supp_phone" required>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Supplier Email</label>

                  <div class="col-sm-4">
                    <input type="email" class="form-control" placeholder="Supplier Email" name="supp_email" required>
                  </div>
                
                  <label for="inputEmail3" class="col-sm-2 control-label">Address Line 1</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Address Line 1" name="address1" required>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Address Line 2</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Address Line 2" name="address2" required>
                  </div>
                
                  <label for="inputEmail3" class="col-sm-2 control-label">Contact Person</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Contact Person" name="contact_person" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Contact Person Phone</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Contact Person Phone Number" name="contact_person_phone" required>
                  </div>
                  
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" class="btn btn-info pull-right">Add Supplier</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <script>
/* Submit form via JQuery */
$('#supplier_frm').submit(function(e){
  
    e.preventDefault(); // Prevent Default Submission
  
    $.post('processing/process_suppliers.php', $(this).serialize() )
    .done(function(data){
      $('#submit_output').fadeOut('slow', function(){
          $('#submit_output').fadeIn('slow').html(data);
          $("#supplier_frm").trigger("reset");
          
          //generate again a supplier code for next supplier entry
        var chars = "0123456789ABCDEFGHIJKLP";
		var string_length = 6;
		var sup_Code = '';
		for (var i=0; i < string_length; i++) 
	{
		var rnum = Math.floor(Math.random() * chars.length);
		sup_Code += chars.substring(rnum,rnum+1);
	}
		document.getElementById("sup_code").value = sup_Code;
        });
    })
    .fail(function(data){
     $('#submit_output').fadeOut('slow', function(){
          $('#submit_output').fadeIn('slow').html(data);
          //$("#supplier_frm").trigger("reset");
        });
});
});
  </script>