<?php
session_start();
include_once('conn/conn.php');

$ssql = 'select * from sellnsell_suppliers where supp_ID = ' .$_GET['id'];
$uza = mysqli_query($cnn,$ssql);
$row = mysqli_fetch_assoc($uza);
?>


    <!-- Main content -->
    
      <!-- title row -->
      
      <div class="row">
      	
           <div class="col-md-12 bxshdw">
           	
			<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Update Details for 
              <?php echo $row['supp_name'];?>	
              </h3>
              <br />
              <small> Supplier Created By
              	<?php echo $row['addedd_by']. "<br /> Supplier Created On " . $row['dt_added'];?>
              </small>
              
              <hr />
              <span style="font-weight: bold; color: #444;" id="submit_output1"></span>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="post" id="update_supp_frm" name="update_supp_frm" autocomplete="off">
            	
              <div class="box-body">
              	
              	<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Supplier Desciption</label>

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
                    <input type="hidden" class="form-control" id="supp_ID" name="supp_ID" value="<?php echo $row['supp_ID'];?>">
                    
                  </div>
                
                  <label for="inputEmail3" class="col-sm-2 control-label">Supplier Name</label>

                  <div class="col-sm-4">
                    <input type="tel" class="form-control" id="supp_name" name="supp_name" required value="<?php echo $row['supp_name'];?>">
                  </div>
                </div>
               
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Supplier Phone</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="supp_phone" id="supp_phone" value="<?php echo $row['supp_phone'];?>">
                  </div>
                  
                  <label for="inputPassword3" class="col-sm-2 control-label">Supplier Email</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="supp_email" id="supp_email" value="<?php echo $row['supp_email'];?>">
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Addres Line 1</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="address1" id="address1" value="<?php echo $row['address1'];?>">
                  </div>
                  
                  <label for="inputPassword3" class="col-sm-2 control-label">Addres Line 2</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="address2" id="address2" value="<?php echo $row['address2'];?>">
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Contact Person</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="contact_person" id="contact_person" value="<?php echo $row['contact_person'];?>">
                  </div>
                 
                 <label for="inputPassword3" class="col-sm-2 control-label">Contact Person Phone</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="contact_person_phone" id="contact_person_phone" value="<?php echo $row['contact_person_phone'];?>">
                  </div>
                </div>
                                    
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" class="btn btn-info pull-right" id="update_user">Update Supplier Details</button>
              </div>
              
              <div class="row no-print">
        
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
/* Submit form via JQuery */
$('#update_supp_frm').submit(function(e){
  
    e.preventDefault(); // Prevent Default Submission
  
    $.post('processing/process_supp_update.php', $(this).serialize() )
    .done(function(data){
      $('#submit_output1').fadeOut('slow', function(){
          $('#submit_output1').fadeIn('slow').html(data);
          $("#update_supp_frm").trigger("reset");
        });
    })
    .fail(function(data){
     $('#submit_output1').fadeOut('slow', function(){
          $('#submit_output1').fadeIn('slow').html(data);
          $("#update_supp_frm").trigger("reset");
        });
});
});
  </script>