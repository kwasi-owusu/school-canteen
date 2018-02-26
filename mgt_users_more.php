<?php
session_start();
include_once('conn/conn.php');

$ssql = 'select * from portal_uzas where user_ID = ' .$_GET['id'];
$uza = mysqli_query($cnn,$ssql);
$row = mysqli_fetch_assoc($uza);
?>


    <!-- Main content -->
    
      <!-- title row -->
      
      <div class="row">
      	
           <div class="col-md-12 bxshdw">
           	
			<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Update User Account</h3>
              
              <hr />
              <span style="font-weight: bold; color: #444;" id="submit_output1"></span>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="post" id="update_user_frm" name="update_user_frm" autocomplete="off">
            	
              <div class="box-body">
              	
              	<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">First Name</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $row['fname'];?>">
                    <input type="hidden" class="form-control" id="userID" name="userID" value="<?php echo $row['user_ID'];?>">
                    
                  </div>
                
                  <label for="inputEmail3" class="col-sm-2 control-label">Last Name</label>

                  <div class="col-sm-4">
                    <input type="tel" class="form-control" id="lname" name="lname" required value="<?php echo $row['lname'];?>">
                  </div>
                </div>
               
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Phone</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="uza_phone" id="uza_phone" value="<?php echo $row['uza_phone'];?>">
                  </div>
                  
                  <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-4">
                    <input type="password" class="form-control" name="pwd" id="pwd" placeholder="New Password">
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
                  <label for="inputPassword3" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="email" id="email" value="<?php echo $row['email'];?>">
                  </div>
                  
                  <label for="inputPassword3" class="col-sm-2 control-label">User Level</label>

                  <div class="col-sm-4">
                	<select class="form-control" name="sellnsell_uza_level" id="sellnsell_uza_level">
                    <?php
                        /*$sup="SELECT sellnsell_uza_level FROM portal_uzas  ORDER BY sellnsell_uza_level ASC";
						$qms=mysqli_query($cnn, $sup) or die(mysql_error());

						while ($dms=mysqli_fetch_array($qms))
						{*/
							?>                           
                    <option value="1">Administrator</option>
                  	<option value="2">Accountant</option>
                  	<option value="3">Sales Person</option>
                   				 <?php
									//}
								  ?>
                  </select>
                  </div>
                </div>
                
                <div class="form-group">
                	<label for="inputPassword3" class="col-sm-2 control-label">User Status</label>

                  <div class="col-sm-4">
                	<select class="form-control" name="uza_status" id="uza_status">
                                            
                    <option value="1">Enabled</option>
                    <option value="2"> Suspended</option>
                    <option value="3">Deactivated</option>
                   				
                  </select>
                  </div>
                  
                </div>
                                    
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" class="btn btn-info pull-right" id="update_user">Update User Account</button>
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
$('#update_user_frm').submit(function(e){
  
    e.preventDefault(); // Prevent Default Submission
  
    $.post('processing/process_uza_update.php', $(this).serialize() )
    .done(function(data){
      $('#submit_output1').fadeOut('slow', function(){
          $('#submit_output1').fadeIn('slow').html(data);
          $("#update_user_frm").trigger("reset");
        });
    })
    .fail(function(data){
     $('#submit_output1').fadeOut('slow', function(){
          $('#submit_output1').fadeIn('slow').html(data);
          $("#update_user_frm").trigger("reset");
        });
});
});
  </script>