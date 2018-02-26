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
              <h3 class="box-title">Set Up Classes</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="post" id="sch_classes">
              <div class="box-body">
              	
              	<div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Name of Class</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="class_name" placeholder="Name of Class" name="class_name">
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
          <script>
/* Submit form via JQuery */
$('#sch_classes').submit(function(e){
  
    e.preventDefault(); // Prevent Default Submission
  
    $.post('processing/process_classes.php', $(this).serialize() )
    .done(function(data){
      $('#submit_output').fadeOut('slow', function(){
          $('#submit_output').fadeIn('slow').html(data);
          $("#sch_classes").trigger("reset");
        });
    })
    .fail(function(data){
     $('#submit_output').fadeOut('slow', function(){
          $('#submit_output').fadeIn('slow').html(data);
          $("#sch_classes").trigger("reset");
        });
});
});
  </script>