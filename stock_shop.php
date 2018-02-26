 		<?php
		include_once('conn/conn.php');
		?>
 
 <!-- DataTables -->
  <link rel="stylesheet" href="assets/plugins/datatables/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.min.js" />
  <link rel="stylesheet" href="assets/plugins/datatables/responsive.bootstrap.min.css" />
			
			<div class="row">
           <div class="col-md-10 col-md-offset-1 bxshdw">
           	<div class="box-header">
         <span style="font-weight: bold; color: #444;" id="submit_output"></span>
          <div class="panel-heading">
            <div class="widget-icons pull-right">
                    <a href=""><i class="fa fa-times wclose"></i></a>
                  </div> 
                  <h3 class="box-title">Products In Warehouse</h3> 
                  <div class="clearfix"></div>
          </div>
        </div>
			<div class="box box-info">
            
            <!-- /.box-header -->
          
            
            <div class="box-body">
              <table id="user_tbl" class="table table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Name of Product</th>
                <th>Batch Number</th>
                <th>Billed Quantity</th>
                <th>Received Quantity</th>
                <th>Rejected Quantity</th>
                <th>Quanrantine Row Number</th>
                <th>Quanrantine Shelve Number</th>
                <th>Name of Supplier</th>
                <th>Purchase Order Number</th>
                <th>Details</th>
                
                
            </tr>
        </thead>
        <tbody>
        	
        				<?php
                        $s="SELECT * FROM quarantine ORDER BY product_ID DESC";
						$q=mysqli_query($cnn, $s) or die(mysql_error());
						while ($d=mysqli_fetch_array($q))
						{
							?>
            <tr>
                <td><?php echo $d['product_name']; ?></td>
                <td><?php echo $d['batch_num']; ?></td>
                <td><?php echo $d['billed_qty']; ?></td>
                <td><?php echo $d['received_qty']; ?></td>
                <td><?php echo $d['rejected_qty']; ?></td>
                <td><?php echo $d['row_number']; ?></td>
                <td><?php echo $d['shelve_number']; ?></td>
                <td><?php echo $d['supp_name']; ?></td>
                <td><?php echo $d['po_Number']; ?></td>
               <td><a href="javascript:void(0)" data-id="<?php echo $d['product_ID'];?>" onclick="podetails(this)"><i class="fa fa-eye"></i> </a></td>
                
                
            </tr>
            					<?php
									}
								  ?>
        </tbody>
    </table>
            </div>
            
            
          </div>
          <hr />
          <div class="box" id="load_body_more">
        	
        	
        </div>
          
          </div>
          </div>
          
          
<!-- Data Tables -->
<script>
	$(document).ready(function() {
    $('#user_tbl').DataTable();
} );
</script>

	<script>

function podetails(itm)
	{
	  var id = $(itm).attr("data-id");
	  $('#load_body_more').load('stock_warehse_details.php?id='+id,function(data){
		$("#load_body_more").html(data);
		 
		});
		
	}
	</script>
	
	
<!-- Data Tables -->
<script>
	$(document).ready(function() {
		if ( $.fn.dataTable.isDataTable( '#user_tbl' ) ) {
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
