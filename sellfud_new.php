		<!-- Jquery UI-->
  <link rel="stylesheet" href="assets/jquery/dist/jquery-ui.css" />
  <script src="assets/jquery/dist/jquery-1.10.2.js"></script>
  <script src="assets/jquery/dist/jquery-ui.js"></script>
  <!-- autocomplete -->
   <script>
  $(function() {
    $("#search_prod_name").autocomplete({
      source: 'canteen/search_for_product.php'
    });
  });
  </script>
  
  
		<style>
			input
			{
				margin:5px;
			}
		</style>
			<div class="row">
           <div class="col-md-10 col-md-offset-1 bxshdw">
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
              <h3 class="box-title">Sell Products</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="post" id="sell_product_frm">
              <div class="box-body">
              	
              	<h4> Sell By</h4>
              	<div class="form-group">
              	<label for="inputEmail3" class="col-sm-2 control-label">Product Name</label>

                  <div class="col-sm-4 ui-widget ui-widget">
                    <input type="text" class="form-control chk_product" placeholder="Name of Product" name="search_prod_name" id="search_prod_name">
                    <div id="product_List">
                    	
                    	
                    </div>  
            
                  </div>
                  
                  <label for="inputEmail3" class="col-sm-2 control-label">Quantity In Stock</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Quantity In Stock" name="whse_qty" id="whse_qty" readonly>
                  </div>
                  
                  </div>
                  
                  <hr />
              	
              	<div class="form-group">
                  
                  <label for="inputEmail3" class="col-sm-2 control-label">Name of Product</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Name of Product" name="product_name" id="product_name" readonly>
                  </div>
                  
                  <label for="inputEmail3" class="col-sm-2 control-label">Quantity</label>

                  <div class="col-sm-4">
                    <input type="number" class="form-control" placeholder="Quantity" name="buy_qty" id="buy_qty" required>
                  </div>
                </div>
                  
                  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Unit Sell Price </label>

                  <div class="col-sm-4">
                    <input type="number" class="form-control" placeholder="Unit Sell Price" name="unit_sell_price" id="unit_sell_price" readonly>
                  </div>
                  <label for="inputEmail3" class="col-sm-2 control-label">Total Sales</label>
				<div class="col-sm-4">
                    <input type="text" class="form-control" placeholder="Total Sales" name="total_sales" id="total_sales" readonly>
                  </div>
                  </div>
                 
              <hr />
             
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button class="btn btn-info pull-right" name="push_to_cart" id="push_to_cart">Push To Cart</button>
               
              </div>
              
              
              <!-- /.box-footer -->
            </form>
            <h3> Shopping Cart</h3>
            <hr />
            <table class="table table-responsive table-bordered" id="table" style="width: 80%; margin: auto; padding: 5px;">
            	<tr>
            		<th> Name of Product</th>
            		<th> Unit Price</th>
            		<th> Quantity</th>
            		<th> Total</th>
            		<th>Remove </th>
            		
            		
            	</tr>
            	
            </table>
            <div class="box-footer">
               
                <button type="submit" class="btn btn-info pull-right" name="save" id="save">Sell From Cart</button>
               </div>
               <form class="form-horizontal" action="" method="post" id="push_to_frm">
               <div class="form-group">
                   	<label for="inputEmail3" class="col-sm-2 control-label">Grand Total Sales</label>
                  <div class="col-sm-1">
                  	<!-- <h4 id="grand_total" value="0" style="font-weight: bolder; color:  #c70039 ;"></h4>-->
                   <input type="text" name="grand_total_sales" id="grand_total" value="0" style="font-weight: bolder; color:  #c70039; font-size: 20px;" readonly> 
                  </div>
                   </div>
                   </form>
          </div>
        
        
        

   
  
  
   <!-- calculate the total sales -->
  <script>  
 $('#buy_qty').on('change keyup blur',function(){
 	var buyingQty  = $('#buy_qty').val();
	 var buy_Price = $('#unit_sell_price').val();
	 
 $('#total_sales').val( (parseFloat(buyingQty)*parseFloat(buy_Price)).toFixed(2) );
	 var rowSubTotal = $('#total_sales').val();
	
}); 
</script>

 <script>
 //add table rows for cart*/
$('#push_to_cart').click(function(e){
  
    e.preventDefault(); // Prevent Default Submission
  
    $.post('sell.php', $(this).serialize() )
    
   var rIndex,
	table = document.getElementById("table"),
	newRow 		= table.insertRow(table.length),
	cell1 		= newRow.insertCell(0),
	cell2 		= newRow.insertCell(1),
	cell3 		= newRow.insertCell(2),
	cell4 		= newRow.insertCell(3),
	cell5 		= newRow.insertCell(4),
	
	
	prodName 	= $('#product_name').val(),
	unitPrice 	= $('#unit_sell_price').val(),
	prodQty 	= $('#buy_qty').val();
	
	
	
	//get sub total cost
	total_sales = parseFloat(unitPrice * prodQty);
	
	
	cell1.innerHTML = prodName;
	cell2.innerHTML = unitPrice;
	cell3.innerHTML = prodQty;
	cell4.innerHTML = total_sales;
	cell5.innerHTML = "Remove";
	
	
	
	// get total price
  var grand1 = parseFloat($('#grand_total').val());
  
  //Grand Total for all products
  $('#grand_total').val(total_sales + grand1);
  
  
  //save to database
  $('#save').click(function(e){
	
e.preventDefault(); // Prevent Default Submission
  var pproduct_Name = [];
  var bbarCode		= [];
  var bbatch		= [];
  var sell_price	= [];
  var pro_qty	 	= [];
  var sub_total		= [];
  
  var ttable = document.getElementById("table");
  
 //loop thru the table cells and append products to array variable
 $(cell1).each(function(){
   pproduct_Name.push($(this).text());
  });
  
  $(cell2).each(function(){
   bbarCode.push($(this).text());
  });
  
   $(cell3).each(function(){
   bbatch.push($(this).text());
  });
  
  $(cell4).each(function(){
   sell_price.push($(this).text());
  });
  
  $(cell5).each(function(){
   pro_qty.push($(this).text());
  });
  
  $(cell6).each(function(){
   sub_total.push($(this).text());
  });
  
  $.ajax({
   url:"processing/process_sell.php",
   method:"POST",
   data:{pproduct_Name:pproduct_Name, bbarCode:bbarCode, bbatch:bbatch, sell_price:sell_price, pro_qty:pro_qty, sub_total:sub_total},
   success:function(data)
   {
		$('#submit_output').fadeOut('slow', function(){
          $('#submit_output').fadeIn('slow').html(data);
          $("#sell_product_frm").trigger("reset");
          
        });
        // delete all table rows after successful insert
        ttable.deleteRow(1);
        //reset the default value of grand total to 0 to avoid Nan error
        $('#grand_total').val(0);
        //document.getElementById("grand_total").value = "0";
   }
  });
  
 });
   
$("#sell_product_frm").trigger("reset");

	$(cell7).click(function(e)
	{	
		/*var xtable = document.getElementById("table");	
	rIndex = xtable.rowIndex;
	xtable.deleteRow(rIndex); */
	
	//delete a row 
	document.getElementById("table").deleteRow(1);
	$('#grand_total').val(total_sales);
	});





});

  </script>
  
    
  
   <!-- select from database and populate into field -->
  <script> 
  $(document).ready(function(){	     
  	
 $('.chk_product, chk_product_again').on('change, paste, blur', function() {
 
var prodd_name = $(this).val();

$.ajax({
   url:"canteen/select_for_canteen_sales.php",
   method: "POST",
   data:{prodd_name: prodd_name},
   dataType: "JSON",
   
  success:function(data)
  {
      				$('#product_name').val(data.product_name);
              		$('#whse_qty').val(data.qty);
               		$('#unit_sell_price').val(data.selling_price);
               		//$('.New_price').val(data.selling_prce);
               			
               							 
           
   }		}); });	}); 
  </script> 
  
  
  