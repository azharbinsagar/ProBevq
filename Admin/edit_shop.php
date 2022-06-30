<?php require('admin_session.php');
require_once("../asset/db.php");
$sid=$_GET['sid'];
$qry=mysqli_query($con,"SELECT * FROM `outlet` WHERE sid='$sid'");
$obj1=mysqli_fetch_object ( $qry );
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
   	$name=$_POST["shopname"];
	$licnumber=$_POST["licnumber"];
	$dist=$_POST["location"];
	$pincode=$_POST["pincode"];
	$phone=$_POST["phone"];
	$email=$_POST["email"];
	
	
	
	if (!isset($error_message)) {
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
	$error_message="Invalid Email Address";
		}
	}	
	/*phone number  validation */
	if (!isset($error_message)) {
		if(!filter_var($phone,FILTER_VALIDATE_INT)) {
	$error_message="Invalid phone number";
		}
	}
	/*phone number length validation*/
	if (!isset($error_message)){
	if(strlen($phone)!=10){
		$error_message="Invalid phone number";
	}
	}
	/*email in db validation*/
	if ($obj1->email != $email)
	{
	$dbemail=mysqli_query($con,"SELECT `email` from `outlet` WHERE `email`='$email'");
	if(mysqli_num_rows($dbemail) == 1)
	{
		$error_message="This email is already in use";
	}
	}
	/*phone number in db validation*/
	if ($obj1->phone != $phone)
	{
	$dbph=mysqli_query($con,"SELECT `phone` from `outlet` WHERE `phone`='$phone'");
	if(mysqli_num_rows($dbph) == 1)
	{
		$error_message="This phonenumber is already in use";
	}
	}


 if(!isset($error_message)) {
    $q2 = mysqli_query($con,"UPDATE `outlet` SET `shopname`='$name',`licnumber`='$licnumber',`location`='$dist',`pincode`='$pincode',`phone`='$phone',`email`='$email' WHERE sid='$sid'");
    if($q2)
   { 
       unset($_POST);
	   $success_message="<script>setTimeout(function(){window.location=\"view_outlet.php\";},3000);</script><strong>Success</strong>,Shop details changed.";
   }
}
}
if (isset ($_GET['sid']))
{

?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Admin Panel | Home :: Bevq</title>
  <!-- Bootstrap Core CSS -->
  <link href="assets/css/bootstrap.css" rel='stylesheet' type='text/css' />
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style-starter.css">
  <!-- font-awesome icons -->
  <link href="assets/css/font-awesome.css" rel="stylesheet"> 
  <!-- google fonts -->
  <link href="//fonts.googleapis.com/css?family=Nunito:300,400,600,700,800,900&display=swap" rel="stylesheet">
</head>

<body class="sidebar-menu-collapsed">
<div class="se-pre-con"></div>
<section>
  <!-- sidebar menu start -->
  <div class="sidebar-menu sticky-sidebar-menu">

    <!-- logo start -->
    <div class="logo">
      <h1><a href="index.php">Admin Panel</a></h1>
    </div>

  <!-- if logo is image enable this -->
    <!-- image logo --
    <div class="logo">
      <a href="index.html">
        <img src="image-path" alt="Your logo" title="Your logo" class="img-fluid" style="height:35px;" />
      </a>
    </div>
    <!-- //image logo -->

    <div class="logo-icon text-center">
      <a href="index.php" title="logo"><img src="assets/images/logo.png" alt="logo-icon"> </a>
    </div>
    <!-- //logo end -->

    <div class="sidebar-menu-inner">

      <!-- sidebar nav start -->
			<?php include('header.php'); ?>
      <!-- //sidebar nav end -->
      <!-- toggle button start -->
      <a class="toggle-btn">
        <i class="fa fa-angle-double-left menu-collapsed__left"><span>Collapse Sidebar</span></i>
        <i class="fa fa-angle-double-right menu-collapsed__right"></i>
      </a>
      <!-- //toggle button end -->
    </div>
  </div>
  <!-- //sidebar menu end -->
  <!-- header-starts -->
  <div class="header sticky-header">

    <!-- notification menu start -->
    <div class="menu-right">
      <div class="navbar user-panel-top">
        <div class="search-box">
          <form action="#search-results.html" method="get">
            <input class="search-input" placeholder="Search Here..." type="search" id="search">
            <button class="search-submit" value=""><span class="fa fa-search"></span></button>
          </form>
        </div>
        <div class="user-dropdown-details d-flex">
          <div class="profile_details">
            <ul>
              <li class="dropdown profile_details_drop">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="dropdownMenu3" aria-haspopup="true"
                  aria-expanded="false">
                  <div class="profile_img">
                    <img src="assets/images/profileimg.jpg" class="rounded-circle" alt="" />
                    <div class="user-active">
                      <span></span>
                    </div>
                  </div>
                </a>
                <ul class="dropdown-menu drp-mnu" aria-labelledby="dropdownMenu3">
                  <li class="user-info">
                    <h5 class="user-name">Hi Admin</h5>
                    <span class="status ml-2">Available</span>
                  </li>
                  <li> <a href="#"><i class="lnr lnr-user"></i>My Profile</a> </li>
                  <li> <a href="#"><i class="lnr lnr-cog"></i>Setting</a> </li>
                  <li class="logout"> <a href="../logout.php"><i class="fa fa-power-off"></i> Logout</a> </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!--notification menu end -->
  </div>
  <!-- //header-ends -->
<!-- main content start -->
<div class="main-content">

  <!-- content -->
  <div class="container-fluid content-top-gap">

    

    <!-- card heading -->
    <div class="cards__heading">
      <h3>Update Shop Details</h3>
    </div>
    <!-- //card heading -->
   

    <!-- content block style 7 -->
    <div class="w3l-about1 card card_border p-lg-5 p-3 mb-4">
      <div class="card-body py-3 p-0">
        
          

						            <!-- forms 1 -->
            <div class="card card_border py-2 mb-4">
               
                <div class="card-body">
                    <form action="#" method="post">
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
                            <label for="exampleInputPassword1" class="input__label">Shop Name</label>
                            <input type="text" class="form-control input-style" name="shopname" value="<?php if(isset($_POST['shopname']))echo $_POST['shopname']; else { echo $obj1->shopname;}?>"
                                placeholder="Shop Name">
                        </div>
						<div class="form-group">
                            <label for="exampleInputPassword1" class="input__label">Licence Number</label>
                            <input type="text" class="form-control input-style" name="licnumber" value="<?php if(isset($_POST['licnumber']))echo $_POST['licnumber']; else { echo $obj1->licnumber;}?>"
                                placeholder="Licence Number">
                        </div>
						<div class="form-group ">
                                <label for="inputState" class="input__label">Location</label>
                                <select  name="location" class="form-control login_text_field_bg input-style">
								    <option value="<?php if(isset($_POST['location']))echo $_POST['location']; else { echo $obj1->location;}?>"><?php if(isset($_POST['location']))echo $_POST['location']; else { echo $obj1->location;}?></option>
                                    <option  value="Thiruvanathapuram">Thiruvanathapuram</option>
									<option  value="Kollam">Kollam</option>
									<option  value="Pathanamthitta">Pathanamthitta</option>
									<option  value="Alappuzha">Alappuzha</option>
									<option  value="Kottayam">Kottayam</option>
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
                            <label for="exampleInputPassword1" class="input__label">Pincode</label>
                            <input type="text" class="form-control input-style" name="pincode" value="<?php if(isset($_POST['pincode']))echo $_POST['pincode']; else { echo $obj1->pincode;}?>"
                                placeholder="Pincode">
                        </div>
						<div class="form-group">
                            <label for="exampleInputPassword1" class="input__label">Mobile Number</label>
                            <input type="text" class="form-control input-style" name="phone" value="<?php if(isset($_POST['phone']))echo $_POST['phone']; else { echo $obj1->phone;}?>"
                                placeholder="Mobile Number	">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="input__label">Email address</label>
                            <input type="email" class="form-control input-style" name="email" value="<?php if(isset($_POST['email']))echo $_POST['email']; else { echo $obj1->email;}?>"
                                aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                                anyone else.</small>
                        </div>
                        <button type="submit" class="btn btn-primary btn-style mt-4">Submit</button>
                    </form>
                </div>
            </div>
            <!-- //forms 1 -->
		  
		  
       
      </div>
    </div>
    <!-- //content block style 7 -->

  </div>
  <!-- //content -->

</div>
<!-- main content end-->
</section>
<!--footer section start-->
<footer class="dashboard">
  <p>&copy 2020  All Rights Reserved | Design by <a href="#" target="_blank"
      class="text-primary">Arjun.</a></p>
</footer>
<!--footer section end-->
<!-- move top -->
<button onclick="topFunction()" id="movetop" class="bg-primary" title="Go to top">
  <span class="fa fa-angle-up"></span>
</button>
<script>
  // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function () {
    scrollFunction()
  };

  function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      document.getElementById("movetop").style.display = "block";
    } else {
      document.getElementById("movetop").style.display = "none";
    }
  }

  // When the user clicks on the button, scroll to the top of the document
  function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }
</script>
<!-- /move top -->


<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/jquery-1.10.2.min.js"></script>

<!-- chart js -->
<script src="assets/js/Chart.min.js"></script>
<script src="assets/js/utils.js"></script>
<!-- //chart js -->

<!-- Different scripts of charts.  Ex.Barchart, Linechart -->
<script src="assets/js/bar.js"></script>
<script src="assets/js/linechart.js"></script>
<!-- //Different scripts of charts.  Ex.Barchart, Linechart -->


<script src="assets/js/jquery.nicescroll.js"></script>
<script src="assets/js/scripts.js"></script>

<!-- close script -->
<script>
  var closebtns = document.getElementsByClassName("close-grid");
  var i;

  for (i = 0; i < closebtns.length; i++) {
    closebtns[i].addEventListener("click", function () {
      this.parentElement.style.display = 'none';
    });
  }
</script>
<!-- //close script -->

<!-- disable body scroll when navbar is in active -->
<script>
  $(function () {
    $('.sidebar-menu-collapsed').click(function () {
      $('body').toggleClass('noscroll');
    })
  });
</script>
<!-- disable body scroll when navbar is in active -->

 <!-- loading-gif Js -->
 <script src="assets/js/modernizr.js"></script>
 <script>
     $(window).load(function () {
         // Animate loader off screen
         $(".se-pre-con").fadeOut("slow");;
     });
 </script>
 <!--// loading-gif Js -->

<!-- Bootstrap Core JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>

</body>

</html>
<?php
}
else{
	header('location:view_outlet.php');
}
?>