//adds extra table rows
var i=$('table tr').length;
$(".addmore").on('click',function(){
	html = '<tr>';
	html += '<td><input class="case" type="checkbox"/></td>';
	html += '<td><input type= data-type="productCode" name="itemNo[]" id="itemNo_'+i+'" class="form-control autocomplete_txt itemNo" contenteditable="true"></td>';
	html += '<td><input type="text" data-type="productName" name="itemName[]" id="itemName_'+i+'" class="form-control search_canteen_prod chk_product for_Price" autocomplete="off"></td>';
	html += '<td><input type="number" name="price[]" id="price_'+i+'" class="form-control changesNo price New_price for_Price" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" readonly></td>';
	html += '<td><input type="text" name="quantity[]" id="quantity_'+i+'" class="form-control changesNo quantity" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
	html += '<td><input type="text" name="total[]" id="total_'+i+'" class="form-control totalLinePrice totalPrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" readonly></td>';
	html += '</tr> <script>$( ".search_canteen_prod" ).autocomplete({source: "canteen/search_for_product.php"});</script>';
	$('table').append(html);
	i++;
});

//to check all checkboxes
$(document).on('change','#check_all',function(){
	$('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
});

//deletes the selected table rows
$(".delete").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('#check_all').prop("checked", false); 
	calculateTotal();
});


//get product prices
		 $(document).on('change keyup blur','.chk_product',function(){
		  iid_arr = $(this).attr('id');
		  iid = iid_arr.split("_");
			
		  prodd_name = $('#itemName_'+iid[1]).val();
		 
		 // var prodd_name = $('#itemName_, #itemName_' + iid[1]).val();
		  //var prodd_name = $('#itemName_' + iid[1]).val();
	
		$.ajax({
		   url:"canteen/select_for_canteen_sales.php",
		   method: "POST",
		   data:{prodd_name: prodd_name},
		   dataType: "JSON",
		   
		  success:function(data)
		  {
		      //$('#price').val(data.selling_price);
		      $('#price_'+iid[1]).val(data.selling_price);
		   
		  }		}); });	 
		  
//price change
$(document).on('change keyup blur','.changesNo',function(){
	id_arr = $(this).attr('id');
	id = id_arr.split("_");
	quantity = $('#quantity_'+id[1]).val();
	price = $('#price_'+id[1]).val();
	if( quantity!='' && price !='' ) $('#total_'+id[1]).val( (parseFloat(price)*parseFloat(quantity)).toFixed(2) );	
	calculateTotal();
});

$(document).on('change keyup blur','#tax',function(){
	calculateTotal();
});

//total price calculation 
function calculateTotal(){
	subTotal = 0 ; total = 0; 
	$('.totalLinePrice').each(function(){
		if($(this).val() != '' )subTotal += parseFloat( $(this).val() );
	
	
	});
	$('#subTotal').val( subTotal.toFixed(2) );
	tax = $('#tax').val();
	if(tax != '' && typeof(tax) != "undefined" ){
		taxAmount = subTotal * ( parseFloat(tax) /100 );
		$('#taxAmount').val(taxAmount.toFixed(2));
		total = subTotal + taxAmount;
	}else{
		$('#taxAmount').val(0);
		total = subTotal;
	}
	$('#totalAftertax').val( total.toFixed(2) );
	calculateAmountDue();
}

$(document).on('change keyup blur','#amountPaid',function(){
	calculateAmountDue();
});

//due amount calculation
function calculateAmountDue(){
	amountPaid = $('#amountPaid').val();
	total = $('#totalAftertax').val();
	if(amountPaid != '' && typeof(amountPaid) != "undefined" ){
		amountDue = parseFloat(total) - parseFloat( amountPaid );
		$('.amountDue').val( amountDue.toFixed(2) );
	}else{
		total = parseFloat(total).toFixed(2);
		$('.amountDue').val( total );
	}
}


//It restrict the non-numbers
var specialKeys = new Array();
specialKeys.push(8,46); //Backspace
function IsNumeric(e) {
    var keyCode = e.which ? e.which : e.keyCode;
    console.log( keyCode );
    var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
    return ret;
}

//datepicker
$(function () {
    $('#invoiceDate').datepicker({});
});

