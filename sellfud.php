		<!-- Jquery UI-->
  <link rel="stylesheet" href="assets/jquery/dist/jquery-ui.css" />
  <script src="assets/jquery/dist/jquery-1.10.2.js"></script>
  <script src="assets/jquery/dist/jquery-ui.js"></script>
  <!-- Generate ticket ID -->
  <script>

		var chars = "012345789ABCDEFGHIJKLPQ";
		var string_length = 6;
		var tckt = '';
		for (var i=0; i < string_length; i++) 
	{
		var rnum = Math.floor(Math.random() * chars.length);
		tckt += chars.substring(rnum,rnum+1);
	}
		document.getElementById("ticket_id").value = tckt;

		</script>
  
  <!-- autocomplete -->
   <script>
  $(function() {
    $("#menu_name").autocomplete({
      source: 'processing/search_for_menu.php'
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
           <div class="col-md-6 col-md-offset-3 bxshdw">
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
              <h3 class="box-title">Sell Food</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="post" id="sell_fud_frm" autocomplete="off">
              <div class="box-body">
              	
              	<div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Ticket ID</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control " readonly name="ticket_id" id="ticket_id">
                  </div>
                </div>
              	
                 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Student ID</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control search_for_student" placeholder="Student ID" name="student_id" id="student_id" required>
                  </div>
                </div>
                
                <div class="form-group">
                 <label for="studen_name" class="col-sm-4 control-label">Student Name</label>
                  <div class="col-sm-6">
                  	<input type="text" class="form-control" name="student_name" id="student_name" readonly>
                  </div>
                </div>
              	
              	<div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label" style="color:  #c0392b;">Total Balance (GHS)</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="total_bal" id="total_bal" style="color:  #c0392b;" readonly>
                  </div>
                  </div>
                  <hr />
              <h4>Search for food</h4>
              	<div class="form-group">
              	<label for="inputEmail3" class="col-sm-4 control-label">Menu Name</label>

                  <div class="col-sm-6 ui-widget ui-widget">
                    <input type="text" class="form-control chk_product search_for_menu" placeholder="Search for Menu" name="menu_name" id="menu_name">
                    <div id="product_List">
                    	
                    	
                    </div>  
            
                  </div>
                  </div>
                  
                  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Cost of Menu</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder="Cost of Menu" name="menu_cost" id="menu_cost" readonly>
                  </div>
                  
                  </div>
                  
              	
              	<div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Quantity</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="qty" id="qty" value="1" readonly>
                  </div>
                  </div>
                  
                  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Total Cost (GHS)</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="total_cost" id="total_cost" readonly>
                  </div>
                  </div>
              
              <hr />
              
                   
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button class="btn btn-info pull-right" name="sell" id="sell">Sell</button>
               
              </div>
              
              </div>
              <!-- /.box-footer -->
            </form>
           
            
          </div>
        
        
        
 <!-- select from database and populate into field -->
   <script> 
  $(document).ready(function(){	     
  	
 $('.search_for_menu').on('change', function() {
 
				var menu_name 			= $(this).val();
				var cost 	 		 	= parseFloat($('#menu_cost').val()); 
				var fudqty 	  			= parseFloat($('#qty').val());
				var total_menu_cost 	= cost * fudqty; 
				

$.ajax({
   url:"processing/menu_cost.php",
   method: "POST",
   data:{menu_name: menu_name},
   dataType: "JSON",
   
  success:function(data)
  {
      			
		
                $('#menu_cost').val(data.menu_cost);
                $('#total_cost').val(fudqty * parseFloat(data.menu_cost));
                 
                
                
   }		
  
   }); });	}); 
  </script> 
  
  <script> 
 /*$('#total_cost').on('click',function(){
 				var cost 	 		 	= parseFloat($('#menu_cost').val()); 
				var fudqty 	  			= parseFloat($('#qty').val());
				//var default_cost 		= parseFloat($('#total_cost').val());
				var total_menu_cost 	= cost * fudqty; 
 $('#total_cost').val(total_menu_cost);
	
}); */
</script>
  <!-- search for student name based on student ID -->
  <script> 
  $(document).ready(function(){	     
  	
 $('.search_for_student').on('change blur paste', function() {
 
var student_ID = $(this).val();
$.ajax({
   url:"processing/search_student_name.php",
   method: "POST",
   data:{student_ID: student_ID},
   dataType: "JSON",
   
  success:function(data)
  {
      			
                $('#student_name').val(data.fullname);
                $('#total_bal').val(data.bal);
                
                
   }		}); });	}); 
  </script> 
  
<script>
/* Submit form via JQuery */
$('#sell_fud_frm').submit(function(e){
  
    e.preventDefault(); // Prevent Default Submission
  		
	$.post('print/example/interface/process_sell_fud.php', $(this).serialize())
    //$.post('processing/process_sell_fud.php', $(this).serialize() )
    .done(function(data){
      $('#submit_output').fadeOut('slow', function(){
          $('#submit_output').fadeIn('slow').html(data);
          $("#sell_fud_frm").trigger("reset");
		  
		  var chars = "012345789ABCDEFGHIJKLPQ";
		var string_length = 6;
		var tckt = '';
		for (var i=0; i < string_length; i++) 
	{
		var rnum = Math.floor(Math.random() * chars.length);
		tckt += chars.substring(rnum,rnum+1);
	}
		document.getElementById("ticket_id").value = tckt;
        });
    })
    .fail(function(data){
     $('#submit_output').fadeOut('slow', function(){
          $('#submit_output').fadeIn('slow').html(data);
          $("#sell_fud_frm").trigger("reset");
        });
});
});
  </script>