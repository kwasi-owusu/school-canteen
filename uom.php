			<div class="row">
           <div class="col-md-4 col-md-offset-4 bxshdw">
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
              <h3 class="box-title">Add New Unit of Measurement</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
             <form class="form-horizontal" action="" method="post" id="add_new_tax">
              <div class="box-body">
              	
              	<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Unit Of Measurement</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="uom" placeholder="Enter UOM" name="uom">
                  </div>
                </div>
                
                
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" class="btn btn-info pull-right" name="add_tax">Save</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          </div>
          </div>
          
          
<script>
/* Submit form via JQuery */
$('#add_new_tax').submit(function(e){
  
    e.preventDefault(); // Prevent Default Submission
  
    $.post('processing/process_uom.php', $(this).serialize() )
    .done(function(data){
      $('#submit_output').fadeOut('slow', function(){
          $('#submit_output').fadeIn('slow').html(data);
          $("#add_new_tax").trigger("reset");
        });
    })
    .fail(function(data){
     $('#submit_output').fadeOut('slow', function(){
          $('#submit_output').fadeIn('slow').html(data);
          $("#add_new_tax").trigger("reset");
        });
});
});
  </script>