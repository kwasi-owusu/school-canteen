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
         
          <div class="panel-heading">
            <div class="widget-icons pull-right">
                    <a href=""><i class="fa fa-times wclose"></i></a>
                  </div> 
                  <h3 class="box-title">Stock Report</h3> 
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
                <th>Bar Code</th>
                <th>Warehouse Stored</th>
                <th>Quantity</th>
                <th>Warehouse Row</th>
                <th>Row Shelve</th>
                <th>Shelve Cage/Pallette</th>
                <th>Manufactured <br /> Date</th>
                <th>Expiry Date</th>
                <th>Details</th>
                                
            </tr>
        </thead>
        <tbody>
        	
        				<?php
                        $stock_chk = mysqli_query($cnn, "SELECT * FROM products_storage WHERE whse_qty > 0 ORDER BY product_name ASC");
						while ($d=mysqli_fetch_array($stock_chk))
						{
							?>
            <tr>
                <td><?php echo $d['product_name']; ?></td>
                <td><?php echo $d['batch_num']; ?></td>
                <td><?php echo $d['barcode']; ?></td>
                <td><?php echo $d['wh_stored']; ?></td>
                <td><?php echo $d['whse_qty']; ?></td>
                <td><?php echo $d['wh_row_number']; ?></td>
                <td><?php echo $d['wh_shelve_num']; ?></td>
                <td><?php echo $d['shelve_cage_num']; ?></td>
                <td><?php echo $d['manu_dt']; ?></td>
                <td><?php echo $d['expiry_dt']; ?></td>
                <td><a href="javascript:void(0)" data-id="<?php echo $d['po_ID'];?>" onclick="podetails(this)"><i class="fa fa-eye"></i> </a></td>
                
                
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
	<script>

function podetails(itm)
	{
	  var id = $(itm).attr("data-id");
	  $('#load_body_more').load('po_details.php?id='+id,function(data){
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