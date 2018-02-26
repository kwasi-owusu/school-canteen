 		<?php
		include_once('conn/conn.php');
		?>
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
                  <h3 class="box-title">Food Sales Report</h3> 
                  <div class="clearfix"></div>
          </div>
        </div>
			<div class="box box-info">
            
            <!-- /.box-header -->
          
            
            <div class="box-body">
              <table id="user_tbl" class="table table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0">
        <thead>
            <tr>
                
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Menu Purchased</th>
                <th>Cost of Menu</th>
                <th>Plate Quantity</th>
                <th>Sold By</th>
                <th>Date Sold</th>
                <th>Details</th>
                                
            </tr>
        </thead>
        <tbody>
        	
        				<?php
                        $exp_chk = mysqli_query($cnn, "SELECT * FROM sell_fud ORDER BY dt_sold DESC");
						while ($d=mysqli_fetch_array($exp_chk))
						{
							?>
            <tr>
                <td><?php echo $d['buyer_ID']; ?></td>
                <td><?php echo $d['buyer_name']; ?></td>
                <td><?php echo $d['menu']; ?></td>
                <td><?php echo $d['menu_cost']; ?></td>
                <td><?php echo $d['qty']; ?></td>
                <td><?php echo $d['sold_by']; ?></td>
                <td><?php echo $d['dt_sold']; ?></td>
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
