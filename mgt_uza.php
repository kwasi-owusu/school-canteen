 		<?php
		include_once('conn/conn.php');
		?>

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
                  <h3 class="box-title">Expired Products  <a href="javascript:void(0)" id="excel"> <i class="fa fa-file-excel-o"> Excel</i></a></h3> 
                  <div class="clearfix"></div>
          </div>
        </div>
			<div class="box box-info">
            
            <!-- /.box-header -->
          
            
            <div class="box-body" id="expired_div">
            	<table id="user_tbl" class="table table-striped table-bordered dt-responsive nowrap display" width="100%" cellspacing="0">
        <thead>
            <tr>
                
                <th>Name of Product</th>
                <th>Batch Number</th>
                <th>Bar Code</th>
                <th>Warehouse Stored</th>
                <th>Warehouse Row</th>
                <th>Row Shelve</th>
                <th>Shelve Cage</th>
                <th>Quantity</th>
                <th>Manufactured <br /> Date</th>
                <th>Expiry Date</th>
                <th>Scrap</th>
                <th>Re-Test</th>
                                
            </tr>
        </thead>
        <tbody>
        	
 <?php 
  $exp_chk = mysqli_query($cnn, "SELECT products_storage.storage_ID, products_storage.product_code, products_storage.product_name, products_storage.batch_num, 
  products_storage.barcode, products_storage.whse_qty, products_storage.wh_stored, products_storage.wh_row_number, products_storage.wh_shelve_num, 
  products_storage.shelve_cage_num, products_storage.manu_dt, products_storage.expiry_dt, warehse_cat.wh_stored AS warehouse
  FROM products_storage, warehse_cat 
  WHERE products_storage.wh_stored = warehse_cat.warehse_cat_ID AND products_storage.expiry_dt <= DATE_ADD(CURDATE(), INTERVAL 6 MONTH) AND products_storage.whse_qty > 0");      				
        				
        			
                      //  $exp_chk = mysqli_query($cnn, "SELECT * FROM products_storage WHERE expiry_dt <= DATE_ADD(CURDATE(), INTERVAL 6 MONTH) AND whse_qty > 0");
						while ($d=mysqli_fetch_array($exp_chk))
						{
							?>
            <tr>
                <td><?php echo $d['product_name']; ?></td>
                <td><?php echo $d['batch_num']; ?></td>
                <td><?php echo $d['barcode']; ?></td>
                <td><?php echo $d['warehouse']; ?></td>
                
                <td><?php echo $d['wh_row_number']; ?></td>
                <td><?php echo $d['wh_shelve_num']; ?></td>
                <td><?php echo $d['shelve_cage_num']; ?></td>
                <td><?php echo $d['whse_qty'];?></td>
                <td><?php echo $d['manu_dt']; ?></td>
                <td><?php echo $d['expiry_dt']; ?></td>
              	<td><a href="javascript:void(0)" data-id="<?php echo $d['storage_ID'];?>" onclick="scrap_product(this)"><i class="fa fa-cut"></i></a></td>
                <td><a href="javascript:void(0)" data-id="<?php echo $d['storage_ID'];?>" onclick="re_test_product(this)"><i class="fa fa-thermometer-0"></i></a></td>
                
                
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
//function to move product to scrap when expire
function scrap_product(itm)
	{
	  var id = $(itm).attr("data-id");
	  $('#load_body_more').load('scrap.php?id='+id,function(data){
		$("#load_body_more").html(data);
		 
		});
		
	}
	
	//function to retest product when 6 months due to expire
function re_test_product(itm)
	{
	  var id = $(itm).attr("data-id");
	  $('#load_body_more').load('re_test.php?id='+id,function(data){
		$("#load_body_more").html(data);
		 
		});
		
	}
	</script>
	



<script>
	$("#excel").click(function (e) {
	window.open('data:application/vnd.ms-excel,' +  encodeURIComponent($('#expired_div').html()));
   	e.preventDefault();
});
	
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
