<?php
session_start();
include_once('conn/conn.php');

$ssql = 'select * from sch_menu where sch_menu_ID = ' .$_GET['id'];
$uza = mysqli_query($cnn,$ssql);
$row = mysqli_fetch_assoc($uza);
?>


    <!-- Main content -->
    
      <!-- title row -->
      
      <div class="row">
      	
           <div class="col-md-12 bxshdw">
           	
			<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Update Menu & Prices</h3>
              
              <hr />
              <span style="font-weight: bold; color: #444;" id="submit_output1"></span>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="post" id="update_menu_frm" name="update_menu_frm" autocomplete="off">
            	
              <div class="box-body">
              	
              	<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Menu Name</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="menu_name" name="menu_name" value="<?php echo $row['menu_name'];?>">
                    <input type="hidden" class="form-control" id="menu_ID" name="menu_ID" value="<?php echo $row['sch_menu_ID'];?>">
                    
                  </div>
                
                  <label for="inputEmail3" class="col-sm-2 control-label">Cost Per Plate</label>

                  <div class="col-sm-4">
                    <input type="tel" class="form-control" id="menu_cost" name="menu_cost" required value="<?php echo $row['menu_cost'];?>">
                  </div>
                </div>
               
                                    
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" class="btn btn-info pull-right" id="update_user">Update Menu</button>
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
$('#update_menu_frm').submit(function(e){
  
    e.preventDefault(); // Prevent Default Submission
  
    $.post('processing/update_menu.php', $(this).serialize() )
    .done(function(data){
      $('#submit_output1').fadeOut('slow', function(){
          $('#submit_output1').fadeIn('slow').html(data);
          $("#update_menu_frm").trigger("reset");
        });
    })
    .fail(function(data){
     $('#submit_output1').fadeOut('slow', function(){
          $('#submit_output1').fadeIn('slow').html(data);
          $("#update_menu_frm").trigger("reset");
        });
});
});
  </script>