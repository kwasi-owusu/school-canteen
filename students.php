							<?php
							include_once('conn/conn.php');
							?>
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
              <h3 class="box-title">Enroll Student</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="post" id="reg_new_std" autocomplete="off">
            <div class="box-body">
            	
            	<div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Student ID</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="student_ID" placeholder="Student ID" name="student_ID">
                  </div>
                </div>
              	
              	<div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">First Name</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="fname" placeholder="First Name" name="fname" required>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Last Name</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="lname" placeholder="Last Name" name="lname" required>
                  </div>
                </div>
                
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Parent/Guardian</label>

                  <div class="col-sm-6">
                    <input type="tel" class="form-control" id="inputEmail3" placeholder="Parent/Guardian" name="parent_guardian" required>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Parent/Guardian Phone</label>

                  <div class="col-sm-6">
                    <input type="tel" class="form-control" id="inputEmail3" placeholder="Parent/Guardian Phone" name="parent_guardian_numb" required>
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
                  <label for="inputEmail3" class="col-sm-4 control-label">Current Class</label>
				<div class="col-sm-6">
                  <select class="form-control" name="current_class" id="current_class">
                    <?php
                        $sup="SELECT class_name FROM sch_classes  ORDER BY class_name ASC";
						$qms=mysqli_query($cnn, $sup) or die(mysql_error());

						while ($dms=mysqli_fetch_array($qms))
						{
							?>                           
                    <option value="<?php echo $dms['class_name']; ?>"><?php echo $dms['class_name']; ?></option>
                   				 <?php
									}
								  ?>
                  </select>
                  </div>
                </div>
                
                
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">Medical Condition</label>

                  <div class="col-sm-6">
                   <textarea class="form-control" id="medical_condition" placeholder="Student Medical Condition" name="medical_condition" required> </textarea>
                  </div>
                </div>
                
                  </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" class="btn btn-info pull-right" name="enroll_student">Enroll Student</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          </div>
          </div>
          
          
<script>
/* Submit form via JQuery */
$('#reg_new_std').submit(function(e){
  
    e.preventDefault(); // Prevent Default Submission
  
    $.post('processing/process_studentx.php', $(this).serialize() )
    .done(function(data){
      $('#submit_output').fadeOut('slow', function(){
          $('#submit_output').fadeIn('slow').html(data);
          $("#reg_new_std").trigger("reset");
        });
    })
    .fail(function(data){
     $('#submit_output').fadeOut('slow', function(){
          $('#submit_output').fadeIn('slow').html(data);
          $("#reg_new_std").trigger("reset");
        });
});
});
  </script>