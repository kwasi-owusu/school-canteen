	<link rel="stylesheet" href="assets/jquery/dist/jquery-ui.css" />
  <script src="assets/jquery/dist/jquery-1.10.2.js"></script>
  <script src="assets/jquery/dist/jquery-ui.js"></script>
  <!-- autocomplete -->
   <script>
  $(function() {
    $(".search_prod_name" ).autocomplete({
      source: 'processing/search_for_product.php'
    });
  });
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
              <h3 class="box-title">Stock Canteen Products</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="post" id="stock_canteen" autocomplete="off">
              <div class="box-body">
              	
              	<div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Product Name</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control search_prod_name" id="product_name" placeholder="Product Name" name="product_name">
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Stock Quantity</label>

                  <div class="col-sm-8">
                    <input type="number" class="form-control" id="qty" placeholder="Stock Quantity" name="qty">
                  </div>
                </div>

                
                <!--<div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Selling Price</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="selling_price" placeholder="Selling Price" name="selling_price">
                  </div>
                </div>-->
                               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" class="btn btn-info pull-right" name="save_product">Save</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          
   <!-- Search for Products -->
   
          
          
          <script>
/* Submit form via JQuery */
$('#stock_canteen').submit(function(e){
  
    e.preventDefault(); // Prevent Default Submission
  
    $.post('processing/process_canteen_stock.php', $(this).serialize() )
    .done(function(data){
      $('#submit_output').fadeOut('slow', function(){
          $('#submit_output').fadeIn('slow').html(data);
          $("#stock_canteen").trigger("reset");
        });
    })
    .fail(function(data){
     $('#submit_output').fadeOut('slow', function(){
          $('#submit_output').fadeIn('slow').html(data);
          $("#stock_canteen").trigger("reset");
        });
});
});
  </script>