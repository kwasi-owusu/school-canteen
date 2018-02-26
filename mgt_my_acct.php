 		<?php
 		session_start();
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
                  <h3 class="box-title">Manage My Users Account</h3> 
                  <div class="clearfix"></div>
          </div>
        </div>
			<div class="box box-info">
            
            <!-- /.box-header -->
          
            
            <div class="box-body">
            	<?php
            	$my_acct = $_SESSION['user'];
				/*$query_user = $PDO->prepare("SELECT * FROM frank04frimxwz.online_appntmt WHERE msged = 0 ORDER BY apptmnt_ID DESC");
				$query_user->execute();
				$result = $query_user->fetchAll();*/
				
		    	$query_user = ("SELECT * FROM portal_uzas WHERE user_ID = :u_id");
				$stmt = $PDO->prepare($query_user);
          		$stmt->bindParam('u_id', $my_acct, PDO::PARAM_STR);
				
				$stmt->execute();
				$result = $stmt->fetchAll();
            	
              echo "<table id='user_tbl' class='table table-striped table-bordered dt-responsive nowrap' width='100%' cellspacing='0''>
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
        <tbody>";
        	
        	foreach($result as $d)
    		{
    			$user_status = $d['uza_status'];
				$u_level	 = $d['sellnsell_uza_level'];
				if ($user_status ==1)
				{
				$user_status = "Enabled";	
				}
				
				else if ($user_status == 0)
				{
					$user_status = "Disabled";
				}
				
				if ($u_level == 1)
				{
					$u_level = "Administrator";
				}
				elseif ($u_level == 2)
				{
					$u_level ="Other Staff";
				}
           
		   echo "<tr>";
                echo "<td>" .$d['user_ID']. "</td>";
                echo "<td>" .$d['fname']. "</td>";
                echo "<td>" .$d['lname']. "</td>";
                echo "<td>" .$d['uza_phone']. "</td>";
                echo "<td>" .$d['email']. "</td>";
                echo "<td>" .$user_status. "</td>";
                echo "<td>" .$u_level. "</td>";
                echo "<td><a href=\"javascript:void(0)\" data-id=". $d['user_ID']." onclick=\"mgtUzas(this)\"><i class='fa fa-edit'></i></a></td>";
               
            echo "</tr>";
            					
			}
								  
       echo "</tbody>";
       echo	"</table>";
	   ?>
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
	  $('#load_body_more').load('mgt_my_acct_more.php?id='+id,function(data){
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