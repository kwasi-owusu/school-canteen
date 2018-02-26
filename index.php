<?php
	ob_start();
	session_start();
	include_once('conn/conn.php');
 	include_once('conn/pervasive_conn.php');
//login script begins here
	
	$error = false;
	
	if( isset($_POST['lognsell']) ) {	
		
		// prevent sql injections/ clear user invalid inputs
		$logemail = trim($_POST['email']);
		$logemail = strip_tags($logemail);
		$logemail = htmlspecialchars($logemail);
		$LLogemail = mysqli_real_escape_string($cnn, $logemail);
		
		$log_pass = trim($_POST['pwd']);
		$log_pass = strip_tags($log_pass);
		$log_pass = htmlspecialchars($log_pass);
		$llog_pass = mysqli_real_escape_string($cnn, $log_pass);
		
		// prevent sql injections / clear user invalid inputs
		
		if(empty($LLogemail)){
			$error = true;
			$Login_emailError = "Please enter your email address.";
		} 
		
		if(empty($llog_pass)){
			$error = true;
			$Login_passError = "Please enter your password.";
		}
		
		// if there's no error, continue to login
		if (!$error) {
			
			$login_pass = hash('sha256', $llog_pass); // password hashing using SHA256
		
			$login_res = mysqli_query($cnn, "SELECT * FROM portal_uzas WHERE email = '".$LLogemail."' AND pwd = '".$login_pass."'");
			$login_row = mysqli_fetch_array($login_res);
			$login_count = mysqli_num_rows($login_res); // if uname/pass correct it returns must be 1 row
			
			if( $login_count == 1 && $login_row['pwd'] == $login_pass && $login_row['uza_status'] == 0 && $login_row['email'] ==  $LLogemail) {
				
				$error = true;
				$activation_emailError = "Sorry your account has been suspended.";
				
			}
			
			elseif( $login_count == 1 && $login_row['pwd'] == $login_pass && $login_row['uza_status'] == 1 && $login_row['email'] ==  $LLogemail) {
				
				$_SESSION['user'] 	= $login_row['uza_ID'];
				$_SESSION['fname']	= $login_row['fname'];
				$_SESSION['lname'] 	= $login_row['lname'];
				$_SESSION['email'] 	= $login_row['email'];
				$_SESSION['level']	= $login_row['sellnsell_uza_level'];
				$_SESSION['login']  = "1";
				header("Location: control");
			}
			
			elseif( $login_count == 1 && $login_row['pwd'] == $login_pass && $login_row['uza_status'] == 1 && $login_row['email'] ==  $LLogemail)
			{
				
				$_SESSION['user'] 	= $login_row['uza_ID'];
				$_SESSION['fname']	= $login_row['fname'];
				$_SESSION['lname'] 	= $login_row['lname'];
				$_SESSION['email'] 	= $login_row['email'];
				$_SESSION['level']	= $login_row['sellnsell_uza_level'];
				$_SESSION['login']  = "1";
				header("Location: control");
			} 
			
			else {
				$Login_errMSG = "Incorrect Login Credentials, Try again...";
			}
				
		}
		
	}

		
	?>


<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Provident International School</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
  
  <link rel="stylesheet" href="assets/LatoWebFont/Lato/latofonts.css" />
  <link rel="stylesheet" href="assets/LatoWebFont/Lato/latostyle.css" /> 
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font 
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
  
</head>
<body class="hold-transition login-page" style="background-image: url('images/index_bg1.jpg'); background-attachment: fixed;">
<div class="login-box" style="border-radius: 4px;">
  <div class="login-logo">
    <b style="color: #d75f00;">Provident International School</b>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <h3 class="login-box-msg">Sign in to start your session</h3>
					<?php
						
							if ( isset($Login_errMSG) ) {
							?>
               				<span class="text-danger"><?php echo $Login_errMSG; ?></span>
                   			<?php
								}
						
							elseif ( isset($activation_emailError) ) {
							?>
               				<span class="text-danger"><?php echo $activation_emailError; ?></span>
                   			<?php
								}
							?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" autocomplete="off">
      <div class="form-group has-feedback">
      						<?php
							if ( isset($Login_emailError) ) {
							?>
               				<span class="text-danger"><?php echo $Login_emailError; ?></span>
                   			<?php
								}
							?>
        <input type="email" class="form-control" placeholder="Email" name="email" id="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
      						<?php
							if ( isset($Login_passError) ) {
							?>
               				<span class="text-danger"><?php echo $Login_passError; ?></span>
                   			<?php
								}
							?>
        <input type="password" class="form-control" placeholder="Password" name="pwd">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="lognsell">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="assets/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
  
  document.getElementById("email").focus();
</script>
</body>
</html>
