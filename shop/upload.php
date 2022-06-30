<?php
require("cust_session.php");
require_once("../asset/db.php");
$pid=$_GET["pid"];
$img=$_GET["img"];
	
	$query="SELECT * FROM `product` WHERE `pid` = '$pid'";
	$obj1=mysqli_fetch_object($query);
	
	/* DBupdate */
	$img++;
	
	/* Photo Upload */
		$exts = "jpg";
		$picname="$pid.$img.$exts";
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"../images/$picname");
	/* /Photo Upload */

	$result=mysqli_query($con,"UPDATE `product` SET `img` = '$img' WHERE `pid` = '$pid'");
	if($result){
		header('location:view_product.php');
	}
?>