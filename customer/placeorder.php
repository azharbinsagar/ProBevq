<?php require('customer_session.php');
require_once("../asset/db.php");

      $uname=$_SESSION['username'];
			$q1=mysqli_query($con,"SELECT `name` from `user` WHERE `email`='$uname'");
			$r1=mysqli_fetch_object($q1);		
      $name=$r1->name;

      $pid=$_GET['pid'];
      $qry=mysqli_query($con,"SELECT * FROM `product` where `pid`= '$pid'");
      $obj=mysqli_fetch_object ( $qry );
      $sid=$obj->sid;
      $pname=$obj->pname;

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
        
        $phone=$_POST["phone"];
        $address=$_POST["address"];
        $district=$_POST["district"];
        $pincode=$_POST["pincode"];
        

      /*phone number  validation and length validation*/
      if (!isset($error_message)){
        if(!preg_match("/^[6-9][0-9]{9}$/",$phone)) {
        $error_message="Invalid phone number";
      }
      }

      
        if(!isset($error_message)) {
         
         $q1 = mysqli_query($con,"INSERT INTO `homedelivery` (`sid`, `pname`, `name`, `phone`, `address`, `district`, `pincode`) VALUES ('$sid', '$pname', '$name', $phone, '$address', '$district', $pincode)");
         if($q1)
         {
           $success_message="<strong>Success</strong>, Your order is successfully placed.<br><script>setTimeout(function(){window.location=\"index.php\";},3000);</script>";
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

  <title>Customer Panel | Home :: Bevq</title>
  <!-- Bootstrap Core CSS -->
  <link href="assets/css/bootstrap.css" rel='stylesheet' type='text/css' />
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style-starter.css">
  <!-- font-awesome icons -->
  <link href="assets/css/font-awesome.css" rel="stylesheet"> 
  <!-- google fonts -->
  <link href="//fonts.googleapis.com/css?family=Nunito:300,400,600,700,800,900&display=swap" rel="stylesheet">
  
  <style>
  
  .demo{padding:45px 0}
.product-grid2{font-family:'Open Sans',sans-serif;position:relative}
.product-grid2 .product-image2{overflow:hidden;position:relative}
.product-grid2 .product-image2 a{display:block}
.product-grid2 .product-image2 img{width:100%;height:auto}
.product-image2 .pic-1{opacity:1;transition:all .5s}
.product-grid2:hover .product-image2 .pic-1{opacity:0}
.product-image2 .pic-2{width:100%;height:100%;opacity:0;position:absolute;top:0;left:0;transition:all .5s}
.product-grid2:hover .product-image2 .pic-2{opacity:1}
.product-grid2 .social{padding:0;margin:0;position:absolute;bottom:50px;right:25px;z-index:1}
.product-grid2 .social li{margin:0 0 10px;display:block;transform:translateX(100px);transition:all .5s}
.product-grid2:hover .social li{transform:translateX(0)}
.product-grid2:hover .social li:nth-child(2){transition-delay:.15s}
.product-grid2:hover .social li:nth-child(3){transition-delay:.25s}
.product-grid2 .social li a{color:#505050;background-color:#fff;font-size:17px;line-height:45px;text-align:center;height:45px;width:45px;border-radius:50%;display:block;transition:all .3s ease 0s}
.product-grid2 .social li a:hover{color:#fff;background-color:#3498db;box-shadow:0 0 10px rgba(0,0,0,.5)}
.product-grid2 .social li a:after,.product-grid2 .social li a:before{content:attr(data-tip);color:#fff;background-color:#000;font-size:12px;line-height:22px;border-radius:3px;padding:0 5px;white-space:nowrap;opacity:0;transform:translateX(-50%);position:absolute;left:50%;top:-30px}
.product-grid2 .social li a:after{content:'';height:15px;width:15px;border-radius:0;transform:translateX(-50%) rotate(45deg);top:-22px;z-index:-1}
.product-grid2 .social li a:hover:after,.product-grid2 .social li a:hover:before{opacity:1}
.product-grid2 .add-to-cart{color:#fff;background-color:#404040;font-size:15px;text-align:center;width:100%;padding:10px 0;display:block;position:absolute;left:0;bottom:-100%;transition:all .3s}
.product-grid2 .add-to-cart:hover{background-color:#3498db;text-decoration:none}
.product-grid2:hover .add-to-cart{bottom:0}
.product-grid2 .product-new-label{background-color:#3498db;color:#fff;font-size:17px;padding:5px 10px;position:absolute;right:0;top:0;transition:all .3s}
.product-grid2:hover .product-new-label{opacity:0}
.product-grid2 .product-content{padding:20px 10px;text-align:center}
.product-grid2 .title{font-size:17px;margin:0 0 7px}
.product-grid2 .title a{color:#303030}
.product-grid2 .title a:hover{color:#3498db}
.product-grid2 .price{color:#303030;font-size:15px}
@media screen and (max-width:990px){.product-grid2{margin-bottom:30px}
}
  </style>

  <style type="text/css">
    .gallery-wrap .img-big-wrap img {
    height: 450px;
    width: auto;
    display: inline-block;
    cursor: zoom-in;
}


.gallery-wrap .img-small-wrap .item-gallery {
    width: 60px;
    height: 60px;
    border: 1px solid #ddd;
    margin: 7px 2px;
    display: inline-block;
    overflow: hidden;
}

.gallery-wrap .img-small-wrap {
    text-align: center;
}
.gallery-wrap .img-small-wrap img {
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
    border-radius: 4px;
    cursor: zoom-in;
}
  </style>
  
</head>

<body class="sidebar-menu-collapsed">
<div class="se-pre-con"></div>
<section>
  <!-- sidebar menu start -->
  <div class="sidebar-menu sticky-sidebar-menu">

    <!-- logo start -->
    <div class="logo">
      <h1><a href="index.php">Customers Panel</a></h1>
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
      <h3>Product View</h3>
    </div>
    <!-- //card heading -->
   

    <!-- content block style 7 -->
    <div class="w3l-about1 card card_border p-lg-5 p-3 mb-4">
      <div class="card-body py-3 p-0">
						<!-- forms 1 -->




            <div class="container">
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

  
<div class="card">
  <div class="row">
    <aside class="col-sm-5 border-right">
<article class="gallery-wrap"> 
<div class="img-big-wrap">
  <div> <a href="#">
    <?php echo "<img class=\"pic-1\"  src=\"../images/$obj->pid.1.jpg\">";?>
  </a></div>
</div> <!-- slider-product.// -->
 <!-- slider-nav.// -->
</article> <!-- gallery-wrap .end// -->
    </aside>
    <aside class="col-sm-7">
<article class="card-body p-5">
  <h3 class="title mb-3"><?php echo $obj->pname; ?></h3>

<p class="price-detail-wrap"> 
  <span class="price h3 text-warning"> 
    <span class="currency">??? </span><span class="num"><?php echo $obj->amount; ?></span>
  </span> 
  <span><?php echo $obj->qty; ?> /litre</span>
</p> <!-- price-detail-wrap .// -->

<dl class="param param-feature">
  <dt>Category: <?php echo $obj->cat; ?></dt>
</dl>  <!-- item-property-hor .// -->

<hr>
  <div class="row">
    <div class="col-sm-7">
    </div> <!-- col.// -->

  </div> <!-- row.// -->

  <form method="POST"> 
  <div class="form-group">
    <label for="exampleFormControlInput1">Name</label>
    <input type="text" class="form-control" name="name" value="<?php echo $r1->name ?>" >
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Mobile</label>
    <input type="text" class="form-control" placeholder="Mobile" name="phone">
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Address</label>
    <textarea class="form-control" rows="3" name="address"></textarea>
  </div>
    <div class="form-group">
    <label for="exampleFormControlSelect1">District</label>
    <select class="form-control" name="district">
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
              <label for="exampleFormControlInput1">Pincode</label>
              <input type="text" class="form-control" placeholder="Pincode" name="pincode">
            </div>
            <button type="submit" class="btn btn-primary">Buy now</button>
</form>

  
</article> <!-- card-body.// -->
    </aside> <!-- col.// -->
  </div> <!-- row.// -->
</div> <!-- card.// -->


</div>
<!--container.//-->


<br><br><br>

   
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
