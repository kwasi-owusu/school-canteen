			<script>
				var chars = "0123456789ABCDEFGHIJKLP";
				var string_length = 3;
				var cat_Code = '';
				for (var i=0; i < string_length; i++) 
			{
				var rnum = Math.floor(Math.random() * chars.length);
				cat_Code += chars.substring(rnum,rnum+1);
			}
				document.getElementById("cat_code").value = cat_Code;
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
              <h3 class="box-title">Add Product Categories</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="post" id="pro_cat_frm" autocomplete="off">
              <div class="box-body">
              	
              	<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Category Code</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="cat_code" name="cat_code" readonly>
                  </div>
                  </div>
              	
              	<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Product Category</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="cat_name" placeholder="Category Name" name="cat_name" required>
                  </div>
                </div>
                               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" class="btn btn-info pull-right" name="add_tax">Add Product Category</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <script>
/* Submit form via JQuery */
$('#pro_cat_frm').submit(function(e){
  
    e.preventDefault(); // Prevent Default Submission
  
    $.post('processing/process_product_cat.php', $(this).serialize() )
    .done(function(data){
      $('#submit_output').fadeOut('slow', function(){
          $('#submit_output').fadeIn('slow').html(data);
          $("#pro_cat_frm").trigger("reset");
          
          // generate a new Category Code for next Inventory category
          var chars = "0123456789ABCDEFGHIJKLP";
				var string_length = 3;
				var cat_Code = '';
				for (var i=0; i < string_length; i++) 
			{
				var rnum = Math.floor(Math.random() * chars.length);
				cat_Code += chars.substring(rnum,rnum+1);
			}
				document.getElementById("cat_code").value = cat_Code;
        });
    })
    .fail(function(data){
     $('#submit_output').fadeOut('slow', function(){
          $('#submit_output').fadeIn('slow').html(data);
          $("#pro_cat_frm").trigger("reset");
        });
});
});
  </script>