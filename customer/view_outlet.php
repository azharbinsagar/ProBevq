<?php 
require('customer_session.php');
require_once("../asset/db.php");

      $uname=$_SESSION['username'];
      $q1=mysqli_query($con,"SELECT `name`,`phone` from `user` WHERE `email`='$uname'");
      $r1=mysqli_fetch_object($q1); 
      $name=$r1->name;
      $phone=$r1->phone;
      

     

     if($_SERVER["REQUEST_METHOD"]=="POST")
     {

      $shopname=$_POST["shopname"];
      $location=$_POST["location"];
      $pincode=$_POST["pincode"];



      $qry1=mysqli_query($con,"SELECT * FROM `outlet` WHERE `shopname` LIKE '%{$shopname}%' or `location` LIKE '{$location}%' or `pincode` LIKE '%{$pincode}%' ");

      if(mysqli_num_rows($qry1) >= 1)
         { 
            
         }
         else

         {
          $error_message="<script>setTimeout(function(){window.location=\"index.php\";},4000);</script><strong>Sorry</strong>, Search outlet is not available in our database.";
         }
     }

     // code for order     
        if(isset($_GET['opid']))
        {
        $opid = $_GET['opid']; // id of user to be suspended

        $q1 = mysqli_query($con, "INSERT INTO `outletpurchase` (`sid`,`name`, `phone`, `date`, `status`) VALUES ( $opid, '$name', '$phone', CURRENT_TIME(),0)") or die("database error:". mysqli_error($con));
         {
          header('location:ordersucess.php');
         }
        }
        
        


 ?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Customer Panel | Home :: Bevq</title>
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
      <h1><a href="index.php">Customer Panel</a></h1>
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
        <i class="fa fa-angle-double-left menu-collapsed__left"><span>Menu Sidebar</span></i>
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
                    <h5 class="user-name">Hi <?php echo $r1->name ?></h5>
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
      <h3>Outlet Details</h3>
    </div>
    <!-- //card heading -->
   

    <!-- content block style 7 -->
    <div class="w3l-about1 card card_border p-lg-5 p-3 mb-4">
      <div class="card-body py-3 p-0">
        <div class="row cwp23-content">
          
                
					
						<div class="table table-responsive">
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
							<table class="table table-hover" id="tblemp">
							<thead> <tr> <th>S.No</th> <th>Shop Name</th> <th>Location</th> <th>Pincode</th> <th>Mobile Number</th> <th>Action</th></tr> </thead>
							<tbody> 
						

								<?php 
								//taking data from database

										$c=1;
										while($obj=mysqli_fetch_object($qry1))
										{
											echo "<tr> <td>$c</td>";
													echo"
														<td>$obj->shopname</td>
														<td>$obj->location</td>
														<td>$obj->pincode</td>
														<td>$obj->phone</td>
														<td><a href=\"view_outlet.php?opid=$obj->sid\">
														<button type=\"button\" class=\"btn btn-primary\">Order Now</button></a></td>
													  </tr>";
											$c++;
										}
								?>
							 </tbody> 
							 </table>
  
						</div>
		  
		  
        </div>
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