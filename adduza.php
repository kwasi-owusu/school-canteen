			<div class="row">
           <div class="col-md-6 col-md-offset-3 bxshdw">
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
              <h3 class="box-title">Add New Users</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="post" id="reg_new_user" autocomplete="No">
            <div class="box-body">
              	
              	<div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">First Name</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="fname" placeholder="First Name" name="fname" required>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Last Name</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Last Name" name="lname" required>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Phone Number</label>

                  <div class="col-sm-6">
                    <input type="tel" class="form-control" id="inputEmail3" placeholder="Phone Number" name="uza_phone" required>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Address Line 1</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Address Line 1" name="address1" required>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Address Line 2</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Address Line 2" name="address2" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Email</label>

                  <div class="col-sm-6">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">Password</label>

                  <div class="col-sm-6">
                    <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="pwd" required>
                  </div>
                </div>
                
                  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Register User As</label>

                  <div class="col-sm-6">
                    <select class="form-control" name="sellnsell_uza_level">
                    <option value="Administrator">Administrator</option>
                    <option value="Manager">Manager</option>
                    <option value="Cashier">Cashier</option>
                    <option value="Sales Person">Sales Person</option>
                    <option value="Logistics Manager">Logistics Manager</option>
                    <option value="Warehouse Manager">Warehouse Manager</option>
                    <option value="Logistics">Logistics</option>
                    <option value="Warehouse">Warehouse</option>
                    <option value="Master Admin">Master Admin</option>
                    <option value="Canteen">Canteen</option>
                    
                  </select>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" class="btn btn-info pull-right" name="add_uza">Add User</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          </div>
          </div>
          
          
<script>
/* Submit form via JQuery */
$('#reg_new_user').submit(function(e){
  
    e.preventDefault(); // Prevent Default Submission
  
    $.post('processing/process_uza_add.php', $(this).serialize() )
    .done(function(data){
      $('#submit_output').fadeOut('slow', function(){
          $('#submit_output').fadeIn('slow').html(data);
          $("#reg_new_user").trigger("reset");
        });
    })
    .fail(function(data){
     $('#submit_output').fadeOut('slow', function(){
          $('#submit_output').fadeIn('slow').html(data);
          $("#reg_new_user").trigger("reset");
        });
});
});
  </script>