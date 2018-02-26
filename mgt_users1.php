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
                <th>First name</th>
                <th>Last name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Status</th>
                <th>Edit</th>
                
            </tr>
        </thead>
        <tbody>
        	
        				<?php
                        $s="SELECT * FROM portal_uzas  ORDER BY user_ID DESC";
						$q=mysqli_query($cnn, $s) or die(mysql_error());
						while ($d=mysqli_fetch_array($q))
						{
							?>
            <tr>
                <td><?php echo $d['fname']; ?></td>
                <td><?php echo $d['lname']; ?></td>
                <td><?php echo $d['uza_phone']; ?></td>
                <td><?php echo $d['email']; ?></td>
                <td><?php echo $d['uza_status']; ?></td>
                <td><a href="cont_details.php?id=<?php echo $d['user_ID'];?>"><i class="fa fa-edit"></i> </a></td>
                
            </tr>
            					<?php
									}
								  ?>
        </tbody>
    </table>
            </div>
            
            
          </div>
          </div>
          </div>
          
          
<!-- Data Tables -->
<script>
	$(document).ready(function() {
    $('#user_tbl').DataTable();
} );
</script>
<script src="assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables/responsive.bootstrap.min.js"></script>


