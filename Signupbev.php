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
	
	$shname=$_POST["shopname"];
	$licn=$_POST["licnumber"];
	$loc=$_POST["location"];
	$pin=$_POST["pincode"];
	$phn=$_POST["phone"];
	$em=$_POST["email"];
	$pass=$_POST["pass"];
	$conf=$_POST["cpass"];
	
/*Name validation*/
if (!isset($error_message)) {
	if(!preg_match("/^[a-zA-Z ]*$/",$shname)) {
$error_message="Invalid name";
	}
}
/*Email  validation */
if (!isset($error_message)) {
	if(!filter_var($em,FILTER_VALIDATE_EMAIL)) {
$error_message="Invalid Email Address";
	}
}	
/*phone number  validation and length validation*/
if (!isset($error_message)){
	if(!preg_match("/^[6-9][0-9]{9}$/",$phn)) {
	$error_message="invalid phone number";
}
}

/*email in db validation*/
$dbemail=mysqli_query($con,"SELECT `email` from `outlet` WHERE `email`='$em'");
if(mysqli_num_rows($dbemail) == 1)
{
	$error_message="This email is already in used";
}
/*phone number in db validation*/
$dbph=mysqli_query($con,"SELECT `phone` from `outlet` WHERE `phone`='$phn'");
if(mysqli_num_rows($dbph) == 1)
{
	$error_message="This phonenumber is already in used";
}
/*Password Matching Validation*/
if($pass != $conf) {
	$error_message='password must be same<br>';
}
	if(!isset($error_message)) {
		$epass=password_hash($pass,PASSWORD_BCRYPT);
   $q1 = mysqli_query($con,"INSERT INTO `login`(`username`,`password`,`type`)VALUES('$em','$epass',2)");
   if($q1){
   $q2 = mysqli_query($con,"INSERT INTO `outlet`(`shopname`,`licnumber`,`location`,`pincode`,`phone`,`email`)VALUES('$shname','$licn','$loc',$pin,$phn,'$em')"); 
   if($q2)
   {
	   unset($_POST);
	   $success_message="<strong>Success</strong>, You are successfully registred.<br> <a href=\"login.php\">Login Now</a>";
   }
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

  <title>Bevq | Signup :: User</title>

  <!-- Template CSS -->
  <link rel="stylesheet" href="admin/assets/css/style-liberty.css">

  <!-- google fonts -->
  <link href="//fonts.googleapis.com/css?family=Nunito:300,400,600,700,800,900&display=swap" rel="stylesheet">
</head>

<body class="sidebar-menu-collapsed">
<script src='//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script><script src="//m.servedby-buysellads.com/monetization.js" type="text/javascript"></script>

<meta name="robots" content="noindex">
<body><link rel="stylesheet" href="/images/demobar_w3_4thDec2019.css">

  <section>
    <!-- content -->
    <div class="">
        <!-- Register form -->
        <section class="register-form py-md-5 py-3">
            <div class="card card_border p-md-4">
                <div class="card-body">
                    <!-- form -->
                    <form action="#" method="POST">
                        <div class="register__header text-center mb-lg-5 mb-4">
                            <h3 class="register__title mb-2">Outlet Registration</h3>
                            <p>Create your account here, and continue </p>
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
                            <label for="exampleInputName" class="input__label">Shop Name</label>
                            <input type="text" class="form-control login_text_field_bg input-style" name ="shopname" placeholder="" required>
                        </div>
						<div class="form-group">
                            <label for="exampleInputEmail1" class="input__label">License Number</label>
                            <input type="text" class="form-control login_text_field_bg input-style" name="licnumber" placeholder="" required>
                        </div>
						 <div class="form-group ">
                                <label for="inputState" class="input__label">Location</label>
                                <select id="location" name="location"class="form-control login_text_field_bg input-style">
                                    <option selected>Select The Location</option>
                                    <option  value="Thiruvanathapuram">Thiruvanathapuram</option>
                  									<option  value="Kollam">Kollam</option>
                  									<option  value="Pathanamthitta">Pathanamthitta</option>
                  									<option  value="Kottayam">Kottayam</option>
                  									<option  value="Alappuzha">Alappuzha</option>
                  									<option  value="Idukki">Idukki</option>
                  									<option  value="Eranakulam">Eranakulam</option>
                  									<option  value="Thrissur">Thrissur</option>
                  									<option  value="Palakkad">Palakkad</option>
                  									<option  value="Kozhikkod">Kozhikkod</option>
                  									<option  value="Wayanad">Wayanad</option>
                  									<option  value="Kannur">Kannur</option>
                  									<option  value="Kasargod">Kasargod</option>
                  									<option  value="Malappuram">Malappuram</option>
									
                                </select>
                            </div>
								<div class="form-group">
                            <label for="exampleInputEmail1" class="input__label">Pincode</label>
                            <input type="text" class="form-control login_text_field_bg input-style" name="pincode" placeholder="" required>
                        </div>
						<div class="form-group">
                            <label for="exampleInputEmail1" class="input__label">Phone Number</label>
                            <input type="text" class="form-control login_text_field_bg input-style" name="phone" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="input__label">Email address</label>
                            <input type="email" class="form-control login_text_field_bg input-style" name="email" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="input__label">Password</label>
                            <input type="password" class="form-control login_text_field_bg input-style" name="pass" placeholder="" required>
                        </div>
						<div class="form-group">
                            <label for="exampleInputPassword1" class="input__label">Confirm Password</label>
                            <input type="password" class="form-control login_text_field_bg input-style" name="cpass" placeholder="" required>
                        </div>
                        <div class="form-check check-remember check-me-out">
                            
                            <label class="form-check-label checkmark" for="exampleCheck1">I agree to the
                                <a href="#terms">Terms of service</a> and <a href="#privacy">Privacy policy</a> </label>
                        </div>
                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                            <button type="submit" class="btn btn-primary btn-style mt-4">Create Account</button>
                            <p class="signup mt-4">Already have an account? <a href="login.php" class="signuplink">Login </a>
                                    
                            </p>
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