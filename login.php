<?php
require("session.php");
require_once("asset/db.php");
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	foreach($_POST as $key=>$value)
	{
	if(empty($_POST[$key]))
	{
		$error_message="All fields are required";
		break;
	}
	}
	if(!isset($error_message)) {
	$uname=$_POST["username"];
	$pass=$_POST["password"];
	//echo $uname,$pass;
	$query="SELECT * FROM `login` WHERE `username`='$uname'";
	$result=mysqli_query($con,$query);
	if(mysqli_num_rows($result)==1)
	{
		$obj=mysqli_fetch_object($result);
		$dbpass=$obj->password;
		if (password_verify($pass,$dbpass))
		{
			$_SESSION["username"]=$uname;
			$type=$obj->type;
			$_SESSION["type"]=$type;
			unset($_POST);
		$success_message="<script>setTimeout(function(){
		window.location=\"\";},1000);</script><img src=\"Admin/assets/images/loading.gif\">
		<strong>Welcome</strong>,you are being logged in..";
	}
		else
		{
			$error_message ="Wrong password";
		}
	}
		else
		{
				$error_message ="Invalid user";
         }
}		 
}		 
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Bevq | Login :: User</title>

  <!-- Template CSS -->
  <link rel="stylesheet" href="admin/assets/css/style-liberty.css">

  <!-- google fonts -->
  <link href="//fonts.googleapis.com/css?family=Nunito:300,400,600,700,800,900&display=swap" rel="stylesheet">
</head>

<body class="sidebar-menu-collapsed">
<script src='//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script><script src="//m.servedby-buysellads.com/monetization.js" type="text/javascript"></script>
<!--<script>(function(v,d,o,ai){ai=d.createElement("script");ai.defer=true;ai.async=true;ai.src=v.location.protocol+o;d.head.appendChild(ai);})(window, document, "//a.vdo.ai/core/w3layouts_V2/vdo.ai.js?vdo=34");</script>-->
<div id="codefund"><!-- fallback content --></div>
<script src="https://codefund.io/properties/441/funder.js" async="async"></script>
	

<meta name="robots" content="noindex">
<body>

  <section>

    <!-- content -->
    <div class="">
        <!-- login form -->
        <section class="login-form py-md-5 py-3">
            <div class="card card_border p-md-4">
                <div class="card-body">
                    <!-- form -->
                    <form action="#" method="POST">
                        <div class="login__header text-center mb-lg-5 mb-4">
                            <h3 class="login__title mb-2"> Login</h3>
                            <p>Welcome back, login to continue</p>
                        </div>
						<?php if(!empty($success_message)) {?>
					<div class="alert alert-success">
						 <?php if (isset($success_message))echo $success_message;?>
						 <button type="button" class="close" onclick="$('.alert').addClass('hidden');">&times;</button>
						 </div>	
					<?php } ?>
					<?php if(!empty($error_message)) {?>
						<div class="alert alert-danger">
							 <button type="button" class="close" onclick="$('.alert').addClass('hidden');">&times;</button>
							 <?php if (isset($error_message))echo $error_message;?>
							 </div>	
					<?php } ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="input__label">Username</label>
                            <input type="text" name="username" class="form-control login_text_field_bg input-style" placeholder="Username" required="" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="input__label">Password</label>
                            <input type="password" class="form-control login_text_field_bg input-style"  name="password" placeholder="Password" required>
                        </div>
                        <div class="form-check check-remember check-me-out">
                            <input type="checkbox" class="form-check-input checkbox" id="exampleCheck1">
                            <label class="form-check-label checkmark" for="exampleCheck1">Remember
                                me</label>
                        </div>
                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                            <button type="submit" class="btn btn-primary btn-style mt-4">Login now</button>
                            <p class="signup mt-4">Don’t have an account? <a href="Signup.php"
                                    class="signuplink">Sign
                                    up</a></p>
                        </div>
                    </form>
                    <!-- //form -->
                    <p class="backtohome mt-4"><a href="index.php" class="back">Back to Home </a></p>
                </div>
            </div>
        </section>

    </div>
    <!-- //content -->

</section>


</body>

</html>