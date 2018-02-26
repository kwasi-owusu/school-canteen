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
                  <h3 class="box-title">Manage Users</h3> 
                  <div class="clearfix"></div>
          </div>
        </div>
			<div class="box box-info">
            
            <!-- /.box-header -->
          
            
            <div class="box-body">
              <table id="user_tbl" class="table table-striped table-bordered dt-responsive nowrap" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Status</th>
                <th>User Designation</th>
                <th>Edit</th>
                
            </tr>
        </thead>
        <tbody>
        	
        				<?php
                        $s="SELECT * FROM portal_uzas  ORDER BY user_ID DESC";
						$q=mysqli_query($cnn, $s) or die(mysql_error());
						while ($d=mysqli_fetch_array($q))
						{
						
						$uza_desig	= $d['sellnsell_uza_level'];
							if ($uza_desig == 1)
							{
								$uza_desig ="Administrator";
							}
							
							elseif ($uza_desig == 2)
							{
								$uza_desig = "Acountant";
							}
							
							
							elseif ($uza_desig == 3)
							{
								$uza_desig = "Sales Person";
							}
						$uza_status = $d['uza_status'];
						
							
						if ($uza_status == 1)
						{
							$uza_status = "Enbled";
						}
						
						elseif ($uza_status == 2)
						{
							$uza_status = "Suspended";
						}
							
						elseif ($uza_status == 3)
						{
							$uza_status = "Deactivated";
						}
							?>
            <tr>
                <td><?php echo $d['user_ID'];?></td>
                <td><?php echo $d['fname']; ?></td>
                <td><?php echo $d['lname']; ?></td>
                <td><?php echo $d['uza_phone']; ?></td>
                <td><?php echo $d['email']; ?></td>
                <td><?php echo $uza_status; ?></td>
                <td><?php echo $uza_desig;?></td>
                <td><a href="javascript:void(0)" data-id="<?php echo $d['user_ID'];?>" onclick="mgtUzas(this)"><i class="fa fa-edit"></i></a></td>
                <!--<td><a href="javascript:void(0)" data-id="<?php echo $d['storage_ID'];?>" onclick="scrap_product(this)"><i class="fa fa-cut"></i></a></td>-->
                
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
function mgtUzas(itm)
	{
	  var id = $(itm).attr("data-id");
	  $('#load_body_more').load('mgt_users_more.php?id='+id,function(data){
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