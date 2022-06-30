<?php
session_start();
  $isIndex = 1;
  if(array_key_exists('type',$_SESSION) && isset($_SESSION['type'])) {
	switch($_SESSION['type'])
	{
			case 0:	
				header("Location:admin/index.php");	//redirect to admin home
				break;
			case 1:	
				header("Location:customer/index.php");
				break;
			case 2:	
				header("Location:shop/index.php");	
				break;
			Default :
				header("Location:index.php");	//redirect to home
				break;
				
	}
  } else {
    if(!$isIndex) header('Location: index.php');
  }

?>