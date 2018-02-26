<?php
	ob_start();
	session_start();
	include_once('conn/conn.php');
	
	if (!(isset($_SESSION['login']) || $_SESSION['login'] != '')) {
		header ("Location: index");
	}
	   
	 
	?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Providence School Canteen- Control</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="assets/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="assets/plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="assets/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="assets/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="assets/select2/dist/css/select2.min.css">
  
  <link rel="stylesheet" href="assets/jquery-ui/themes/smoothness/jquery-ui.css" />
  
  <link rel="stylesheet" href="mycss/styles.css" />
  
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
  <!-- Jquery UI-->
  				<link rel="stylesheet" href="assets/jquery/dist/jquery-ui.css" />
			  <script src="assets/jquery/dist/jquery-ui.js"></script>
 <script src="exports/jquery-1.12.4.js"></script>
  <!-- DataTables -->
 <!-- <link rel="stylesheet" href="exports/dataTables.bootstrap.min.js" />-->
  <link rel="stylesheet" href="exports/buttons.dataTables.min.css" />
  <link rel="stylesheet" href="assets/plugins/datatables/bootstrap.min.css" />
  <script src="assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="assets/plugins/datatables/responsive.bootstrap.min.css" />
 		  
			  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

 
  <script src="assets/plugins/datatables/jquery-1.12.4.js"></script>
<script src="assets/jquery/dist/jquery.min.js"></script>
  <!-- scripts for datatable; export to excel, pdf csv, and print  -->
<script src="exports/dataTables.bootstrap.min.js"></script>
<script src="exports/jquery.dataTables.min.js"></script>
<script src="exports/dataTables.responsive.min.js"></script>
<script src="exports/responsive.bootstrap.min.js"></script>

<script src="exports/buttons.flash.min.js"></script>
<script src="exports/buttons.html5.min.js"></script>
<script src="exports/buttons.print.min.js"></script>
<script src="exports/dataTables.buttons.min.js"></script>
<script src="exports/jszip.min.js"></script>
<script src="exports/pdfmake.min.js"></script>
<script src="exports/vfs_fonts.js"></script>


</head>
<body class="hold-transition skin-red sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Control</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
             
              <span class="hidden-xs">
				<?php
			    echo $_SESSION['fname']. " " . $_SESSION['lname'];
				?>
			</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                                <p>
                  <?php
			    echo $_SESSION['fname']. " " . $_SESSION['lname'];
				?>
                  <small><?php echo $_SESSION['level']; ?></small>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="javascript:void(0);" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Logout</a></a>
                </div>
              </li>
            </ul>
          </li>
         
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
   	<!-- sidebar menu: : style can be found in sidebar.less -->
      
      
      <?php include_once ('control_menu.php'); ?>
      <?php
		/*
              $uzalevel	= $_SESSION['level'];
			  
			  switch ($uzalevel)
			  {
				  case  1:
					  include_once('control_menu.php');
					  break;
				  case 2:
					  include_once('teller_menu.php');
					  break;
				 	 default:
					  header("Location: index.php");
					  
			  }
		 
		 */
			  
			  ?>
      
      
      
      
      
      
      
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <!--
      <h1>
        <?php
        $controlHeading = "Control";
		echo $controlHeading;
		
		
		?>
       
      </h1>
      
    </section>
	-->
    <!-- Main content -->
    <section class="content">
    	<div id="top_alerts">
    		
    		
    	</div>
    
      <!-- Default box -->
      <div class="box" id="load_body">
      
      </div>
        
               
        
        
        
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 
    	<?php 
    	$dt = DATE('Y');
		echo $dt;
		?>
    	<!--<a href="http://bahrima.com" target="_blank">Bahrima InfoSystems</a>.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->

<!-- Bootstrap 3.3.7 -->
<script src="assets/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="assets/select2/dist/js/select2.full.min.js"></script>
<script src="assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="assets/moment/min/moment.min.js"></script>
<script src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="assets/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- Icheck -->
<script src="assets/plugins/iCheck/icheck.min.js"></script>




<!-- SlimScroll -->
<script src="assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="assets/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>

   <!-- Date and Time Picker -->
  <script>
  $(function () {
    
    //Date picker
    $('#datepicker, #datepicker11').datepicker({
      autoclose: true,
      locale: 'no',
  	format: 'yyyy-mm-dd'
    })

    

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>


			<!--<script>
			var refreshId = setInterval(function()
			{
				
					$('#top_alerts').fadeOut("slow").load('top_alerts.php').fadeIn("slow");
				
			}, 10000);
	
			</script>-->
			
<script src="load_divs.js"></script>

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

</body>
</html>
