			<script>

		var chars = "0123456789ABCDEFGHIJKLP";
		var string_length = 4;
		var sup_Code = '';
		for (var i=0; i < string_length; i++) 
	{
		var rnum = Math.floor(Math.random() * chars.length);
		sup_Code += chars.substring(rnum,rnum+1);
	}
	document.getElementById("sup_code").value = sup_Code;

</script>
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
              <h3 class="box-title">Supplier Categories</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="post" id="sup_cat_frm" autocomplete="off">
              <div class="box-body">
              	
              	<div class="form-group">
                  <label for="Customer_code" class="col-sm-2 control-label">Supplier Code</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="sup_code" placeholder="Suoplier Code" name="sup_code" readonly>
                  </div>
                </div>
                        
              	
              	<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Supplier Category</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="sup_cat" placeholder="Category Name" name="sup_cat">
                  </div>
                </div>
                               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" class="btn btn-info pull-right" name="add_tax">Add Supplier Category</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <script>
/* Submit form via JQuery */
$('#sup_cat_frm').submit(function(e){
  
    e.preventDefault(); // Prevent Default Submission
  
    $.post('processing/process_sup_cat.php', $(this).serialize() )
    .done(function(data){
      $('#submit_output').fadeOut('slow', function(){
          $('#submit_output').fadeIn('slow').html(data);
          $("#sup_cat_frm").trigger("reset");
          
          var chars = "0123456789";
		var string_length = 4;
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
          //$("#sup_cat_frm").trigger("reset");
        });
});
});
  </script>