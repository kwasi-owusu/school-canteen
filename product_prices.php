 		<?php
		include_once('conn/conn.php');
		?>
 
 <!-- DataTables -->
  <link rel="stylesheet" href="assets/plugins/datatables/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.min.js" />
  <link rel="stylesheet" href="assets/plugins/datatables/responsive.bootstrap.min.css" />
  
  <!-- scripts for datatable; export to excel, pdf csv, and print  -->
<script src="exports/dataTables.bootstrap.min.js"></script>
<script src="exports/datatables/jquery.dataTables.min.js"></script>
<script src="exports/dataTables.responsive.min.js"></script>
<script src="exports/responsive.bootstrap.min.js"></script>
			
			<div class="row">
           <div class="col-md-10 col-md-offset-1 bxshdw">
           	<div class="box-header">
         <span style="font-weight: bold; color: #444;" id="submit_output"></span>
          <div class="panel-heading">
            <div class="widget-icons pull-right">
                    <a href=""><i class="fa fa-times wclose"></i></a>
                  </div> 
                  <h3 class="box-title">Set Canteen Product Prices</h3> 
                  <div class="clearfix"></div>
          </div>
        </div>
			<div class="box box-info">
            
            <!-- /.box-header -->
          
            
            <div class="box-body">
              <table id="user_tbl" class="table table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Product Code</th>
				<th>Name of Product</th>
				<th>Name of Supplier </th>
                <th>Total Quantity</th></th>
                <th>Buy Price</th>
                <th>Selling Price</th>
                <th>Change Price</th>
                
            </tr>
        </thead>
        <tbody>
        	
        				<?php
			
			
                        $s="SELECT * FROM products_master  ORDER BY product_name ASC";
						$q=mysqli_query($cnn, $s) or die(mysql_error());
						while ($d=mysqli_fetch_array($q))
						{
						?>
            <tr>
                <td><?php echo $d['product_code'];?></td>
                <td><?php echo $d['product_name'];?></td>
                <td><?php echo $d['supp_name'];?></td>
                <td><?php echo $d['total_qty'];?></td>
                <td><?php echo $d['buy_price'];?></td>
                <td><?php echo $d['unit_sell_price']?></td>
                
                
                <td><a href="javascript:void(0)" data-id="<?php echo $d['product_ID'];?>" onclick="mgtProducts(this)"><i class="fa fa-edit"></i></a></td>
                
                
            </tr>
            					<?php
									}
								  ?>
        </tbody>
    </table>
            </div>
            
            
          </div>
         <div class="box" id="load_body_more">
        	
        	
        </div>
          </div>
           </div>
          
 
 <script>
//function to edit user
function mgtProducts(itm)
	{
	  var id = $(itm).attr("data-id");
	  $('#load_body_more').load('edit_prod_prices.php?id='+id,function(data){
		$("#load_body_more").html(data);
		 
		});
		
	}
	
	</script>
	
<!-- Data Tables -->
<script>
	$(document).ready(function() {
		if ( $.fn.dataTable.isDataTable( '#wh_list' ) ) {
    table = $('#user_tbl').DataTable();
	}
	else {
		
    $('#user_tbl').DataTable( {
        dom: 'lBfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
   }
} );
</script>