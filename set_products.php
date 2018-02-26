								<?php
								session_start();
								include_once('conn/conn.php');
								?>
								
			<script>
				var chars = "0123456789ABCDEFGHIJKLP";
				var string_length = 6;
				var cat_Code = '';
				for (var i=0; i < string_length; i++) 
			{
				var rnum = Math.floor(Math.random() * chars.length);
				cat_Code += chars.substring(rnum,rnum+1);
			}
				document.getElementById("product_code").value = cat_Code;
			</script>
			
			
			<div class="row">
           <div class="col-md-8 col-md-offset-2 bxshdw">
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
              <h3 class="box-title">Register New Product</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="post" id="product_frm" autocomplete="off">
              <div class="box-body">
              	
              	<div class="form-group">
              		<label for="inputEmail3" class="col-sm-2 control-label">Product Code</label>

                  <div class="col-sm-4">
                    <input type="tel" class="form-control" placeholder="Product Code" name="product_code" id="product_code" readonly>
                  </div>
              		
              	</div>
              	
              	
              	<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Product Category</label>

                  <div class="col-sm-4">
                    <select class="form-control" name="product_cat" id="product_cat">
                    <?php
                        $sup = "SELECT * FROM prod_cat  ORDER BY cat_name ASC";
						$qms = mysqli_query($cnn, $sup) or die(mysql_error());
						
						while ($cat=mysqli_fetch_array($qms))
						{
							?>                           
                    <option value="<?php echo $cat['ICCode']; ?>"><?php echo $cat['cat_name'];?></option>
                   				 <?php
									}
								  ?>
                  </select>
                 </div>
                
                  <label for="inputEmail3" class="col-sm-2 control-label">Name of Product</label>

                  <div class="col-sm-4">
                    <input type="tel" class="form-control" id="inputEmail3" placeholder="Name of Product" name="product_name">
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Name of Manufacturer</label>

                  <div class="col-sm-4">
                    <select class="form-control" name="manu_name" id="manu_name">
                    <?php
                        $sup="SELECT manu_ID, manu_name FROM sellnsell_manufacturers  ORDER BY manu_ID ASC";
						$qms=mysqli_query($cnn, $sup) or die(mysql_error());

						while ($dms=mysqli_fetch_array($qms))
						{
							?>                           
                    <option value="<?php echo $dms['manu_name']; ?>"><?php echo $dms['manu_name']; ?></option>
                   				 <?php
									}
								  ?>
                  </select>
                  </div>
                
                  <label for="inputEmail3" class="col-sm-2 control-label">Name of Supplier</label>

                  <div class="col-sm-4">
                    <select class="form-control" name="supp_name" id="supp_name">
                    <?php
                        $sup="SELECT supp_ID, supp_name FROM sellnsell_suppliers  ORDER BY supp_ID ASC";
						$qms=mysqli_query($cnn, $sup) or die(mysql_error());

						while ($dms=mysqli_fetch_array($qms))
						{
							?>                           
                    <option value="<?php echo $dms['supp_name']; ?>"><?php echo $dms['supp_name']; ?></option>
                   				 <?php
									}
								  ?>
                  </select>
                  </div>
                </div>
                <!--
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Unit Buy Price</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="buy_price" placeholder="Unit Buy Price" name="buy_price">
                  </div>
                
                  <label for="inputEmail3" class="col-sm-2 control-label">Unit Sell Price</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Unit Sell Price" name="unit_sell_price">
                  </div>
                </div>
                -->
                <div class="form-group">
                  <label for="InternalRef" class="col-sm-2 control-label">Internal Reference</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Internal Reference" name="Internal_ref">
                  </div>
                  
                  <label for="UOM" class="col-sm-2 control-label">Unit Of Measurement</label>

                  <div class="col-sm-4">
                    <select class="form-control" name="uom" id="uom">
                    			<?php
                        $sup="SELECT uom FROM uom  ORDER BY uom_ID ASC";
						$qms=mysqli_query($cnn, $sup) or die(mysql_error());

						while ($dms = mysqli_fetch_array($qms))
						{
							?>                           
                    	<option value="<?php echo $dms['uom']; ?>"><?php echo $dms['uom']; ?></option>
                   				 <?php
									}
								  ?>
                  </select>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">ReOrder Rule</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="ReOrder Rule" name="reorder_rules">
                  </div>
                  
                  <label for="barcode" class="col-sm-2 control-label">Product Barcode</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Product Barcode" name="barcode" id="barcode">
                  </div>
                  
                  
                </div>
                
                
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" class="btn btn-info pull-right">Save</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <script>
/* Submit form via JQuery */
$('#product_frm').submit(function(e){
  
    e.preventDefault(); // Prevent Default Submission
  
    $.post('processing/process_prod.php', $(this).serialize() )
    .done(function(data){
      $('#submit_output').fadeOut('slow', function(){
          $('#submit_output').fadeIn('slow').html(data);
          $("#product_frm").trigger("reset");
          
          var chars = "0123456789ABCDEFGHIJKLP";
				var string_length = 6;
				var cat_Code = '';
				for (var i=0; i < string_length; i++) 
			{
				var rnum = Math.floor(Math.random() * chars.length);
				cat_Code += chars.substring(rnum,rnum+1);
			}
				document.getElementById("product_code").value = cat_Code;
        });
    })
    .fail(function(data){
     $('#submit_output').fadeOut('slow', function(){
          $('#submit_output').fadeIn('slow').html(data);
          //$("#product_frm").trigger("reset");
        });
});
});
  </script>