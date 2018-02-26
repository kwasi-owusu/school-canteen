<?php
session_start();
include_once('conn/conn.php');

$ssql = 'select * from products_master where product_ID = ' .$_GET['id'];
$uza = mysqli_query($cnn,$ssql);
$row = mysqli_fetch_assoc($uza);
?>


    <!-- Main content -->
    
      <!-- title row -->
      
      <div class="row">
      	
           <div class="col-md-12 bxshdw">
           	
			<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Update Product Prices</h3>
              
              <hr />
              <span style="font-weight: bold; color: #444;" id="submit_output1"></span>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="post" id="update_prod_frm" name="update_prod_frm" autocomplete="off">
            	
              <div class="box-body">
              	
              	<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Product Name</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $row['product_name'];?>">
                    <input type="hidden" class="form-control" id="producy_ID" name="product_ID" value="<?php echo $row['product_ID'];?>">
                    
                  </div>
                
                  <label for="inputEmail3" class="col-sm-2 control-label">Name of Supplier</label>

                  <div class="col-sm-4">
                    <input type="tel" class="form-control" id="supp_name" name="supp_name" required value="<?php echo $row['supp_name'];?>">
                  </div>
                </div>
                
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Buy Price</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="buy_price" name="buy_price" value="<?php echo $row['buy_price'];?>">
                    
                    
                  </div>
                
                  <label for="inputEmail3" class="col-sm-2 control-label">Unit Sell Price</label>

                  <div class="col-sm-4">
                    <input type="tel" class="form-control" id="sell_price" name="sell_price" required value="<?php echo $row['unit_sell_price'];?>">
                  </div>
                </div>
               
                                    
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" class="btn btn-info pull-right" id="update_user">Update Prices</button>
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
$('#update_prod_frm').submit(function(e){
  
    e.preventDefault(); // Prevent Default Submission
  
    $.post('processing/update_product_prices.php', $(this).serialize() )
    .done(function(data){
      $('#submit_output1').fadeOut('slow', function(){
          $('#submit_output1').fadeIn('slow').html(data);
          $("#update_prod_frm").trigger("reset");
        });
    })
    .fail(function(data){
     $('#submit_output1').fadeOut('slow', function(){
          $('#submit_output1').fadeIn('slow').html(data);
          $("#update_prod_frm").trigger("reset");
        });
});
});
  </script>