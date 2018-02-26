  	<!-- <link href="canteen/css/jquery-ui.min.css" rel="stylesheet">
    <link href="canteen/css/bootstrap.min.css" rel="stylesheet">-->
    <link href="canteen/css/inv_style.css" rel="stylesheet">
    
     <script>
  $(function() {
    $(".search_canteen_prod" ).autocomplete({
      source: 'canteen/search_for_product.php'
    });
  });
  </script>
    <!-- Begin page content -->
    <div class="row">
    	<div class="col-md-12 bxshdw">
		
    <div class="container content">
    	
    		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-md-offset-2">
    			<h1 class="text-center title">Sell to Student</h1>
    			<hr />
    			<span style="font-weight: bold; color: #444;" id="submit_output"></span>
    		</div>
    
      	
      	
      	<form action="" method="post" id="sell_frm" autocomplete="off">
      		<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
      			
      			
      		</div>
      		<div class='col-xs-12 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 col-sm-4 col-md-4 col-lg-4'>
      			
				<div class="form-group">
					<label>Amount Due</label>
					<input type="number" class="form-control amountDue" readonly id="amountDueTop" placeholder="Amount Due">
				</div>
      		</div>
      
      		<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
      			<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="2%"><input id="check_all" class="formcontrol" type="checkbox"/></th>
							<th width="10%">Item No</th>
							<th width="20%">Product Name</th>
							<th width="15%">Price</th>
							<th width="15%">Quantity</th>
							<th width="15%">Total</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input class="case" type="checkbox"/></td>
							<td><input type="text" data-type="productCode" name="itemNo[]" id="itemNo_1" class="form-control itemNo" contenteditable="true"></td>
							<td><input type="text" data-type="productName" name="itemName[]" id="itemName_1" class="form-control search_canteen_prod chk_product for_Price" autocomplete="off"></td>
							<td><input type="number" name="price[]" id="price_1" readonly class="form-control changesNo price for_Price New_price" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
							<td><input type="number" name="quantity[]" id="quantity_1" class="form-control changesNo quantity" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
							<td><input type="text" name="total[]" readonly id="total_1" class="form-control totalLinePrice totalPrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
						</tr>
					</tbody>
				</table>
      		</div>
      	
      	
      		<div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
      			<button class="btn btn-danger delete" type="button">- Delete</button>
      			<button class="btn btn-success addmore" type="button">+ Add More</button>
      		</div>
      		<div class='col-xs-12 col-sm-offset-4 col-md-offset-4 col-lg-offset-4 col-sm-5 col-md-5 col-lg-5'>
				<div class="form-inline">
					<div class="form-group">
						<label>Subtotal: &nbsp;</label>
						<div class="input-group">
							<div class="input-group-addon"></div>
							<input type="number" class="form-control" id="subTotal" readonly placeholder="Subtotal" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
						</div>
					</div>
					
					<div class="form-group">
						<label>Total: &nbsp;</label>
						<div class="input-group">
							<div class="input-group-addon"></div>
							<input type="number" class="form-control" id="totalAftertax" placeholder="Total" readonly onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
						</div>
					</div>
					<div class="form-group">
						<label>Amount Paid: &nbsp;</label>
						<div class="input-group">
							<div class="input-group-addon"></div>
							<input type="number" class="form-control" id="amountPaid" name="amountPaid" placeholder="Amount Paid" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
						</div>
					</div>
					<div class="form-group">
						<label>Amount Due: &nbsp;</label>
						<div class="input-group">
							<div class="input-group-addon"></div>
							<input type="number" class="form-control amountDue" id="amountDue" placeholder="Amount Due" readonly onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
						</div>
					</div>
				</div>
			</div>
      	
      		<div class="box-footer">
                <button type="submit" class="btn btn-info pull-left" name="save_sales" id="save_sales">Save</button>
              </div>
              
              </form>
    </div>
   </div>
    </div>
 <script>
/* Submit form via JQuery */
$('#save_sales').click(function(e){
  
  e.preventDefault(); // Prevent Default Submission
  
  var itNum					= [];
  var itemName				= [];
  var unit_cost				= [];
  var qty 					= [];
  var total			 		= [];
  
  
  $('.itemNo').each(function(){
   itNum.push($(this).val());
  });
	
  $('.search_canteen_prod').each(function(){
   itemName.push($(this).val());
  });
	
  $('.price').each(function(){
   unit_cost.push($(this).val());
  });
	
  $('.quantity').each(function(){
   qty.push($(this).val());
  });
	
  
  $('.totalPrice').each(function(){
   total.push($(this).val());
  });
  
   $.ajax({
   url:"canteen/sell_canteen_prod.php",
   method:"POST",
   data:{itNum:itNum, itemName:itemName, unit_cost:unit_cost, qty:qty, total:total},
   success:function(data)
   {
		$('#submit_output').fadeOut('slow', function(){
          $('#submit_output').fadeIn('slow').html(data);
			document.getElementById("sell_frm").reset();
			//$('#sell_frm').trigger("reset");
			//document.getElementById("itemNo").value=" ";
			
       		
        });
        	/*$('.itemNo').trigger("reset");
       		$('.search_prod_name').trigger("reset");*/
       
        
   }
  });
   
});
</script>
  
   
    <script src="canteen/js/auto.js"></script>
    <script src="canteen/js/jquery.min.js"></script>
    <script src="canteen/js/jquery-ui.min.js"></script>
    <script src="canteen/js/bootstrap.min.js"></script>
    <script src="canteen/js/bootstrap-datepicker.js"></script>
