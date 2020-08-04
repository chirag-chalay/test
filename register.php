<!DOCTYPE html>
<?php
   include("config.php");
   session_start();
   
   // Define variables and initialize with empty values
   $username = $password = $confirm_password = $name = "";
   $username_err = $password_err = $confirm_password_err = $name_err = "";
   
if($_SERVER["REQUEST_METHOD"] == "POST") {
     // receive all input values from the form
	 $name = mysqli_real_escape_string($db,$_POST['name']);
     $username = mysqli_real_escape_string($db, $_POST['username']);
     $password = mysqli_real_escape_string($db,$_POST['password']);
	 $confirm_password = mysqli_real_escape_string($db,$_POST['confirm_password']);

	 // Validate username
     if(empty($name)){
		$name_err = "* Please enter a name.";
     }
	 
	 // Validate username
     if(empty($username)){
		$username_err = "* Please enter a username.";
     }else{
		// Prepare a select statement
		$sql = "SELECT user_id FROM users WHERE username = '$username'";
		$result = mysqli_query($db,$sql);
		$count = mysqli_num_rows($result);
		
		// If result having matched $myusername , table row must be 1 row	
		if($count > 0) {
			$username_err = "* This username is already exists.";
			//return($username_err);
		}
	 }
	 
	 // Validate password
     if(empty($password)){
         $password_err = "* Please enter a password.";     
     }
     
     // Validate confirm password
     if(empty( $confirm_password )){
         $confirm_password_err = "* Please enter confirm password.";     
     } else{
         if( $password_err != "" && ($password != $confirm_password)){
             $confirm_password_err = "* Password did not match.";
         }
     }
	 
	 // Check input errors before inserting in database
     if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
         
         // Prepare an insert statement
	 	 $sql = "INSERT INTO users (username, password, name) VALUES ('$username', '$password', '$name')";	
		 mysqli_query($db, $sql);
     }
   }
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <form action="" method="post">
	  <!-- Name field -->
      <div class="form-group has-feedback">
        <input type="text" name="name" class="form-control" placeholder="Full name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
	  <?php if( $name_err != "") { ?>
	  <span class="help-block"><?php echo '*'. $name_err; ?></span>
	  <?php } ?>
	  
	  <!-- Username field -->
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
	  <?php if( $username_err != "") { ?>
	  <span class="help-block"><?php echo $username_err; ?></span>
	  <?php } ?>
	  
	  <!-- Password field -->
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
	  <?php if( $password_err != "") { ?>
	  <span class="help-block"><?php echo $password_err; ?></span>
	  <?php } ?>
	  
	  <!-- Confire password field -->
      <div class="form-group has-feedback">
        <input type="password" name="confirm_password" class="form-control" placeholder="Retype password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
	  <?php if( $confirm_password_err != "") { ?>
	  <span class="help-block"><?php echo $confirm_password_err; ?></span>
	  <?php } ?>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="login.php" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
