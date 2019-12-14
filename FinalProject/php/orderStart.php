<?php
  session_start();
  $_SESSION["ordertype"] = $_POST['ordertype'];
  $_SESSION["ordertime"] = $_POST['order-time'];
  $_SESSION['cart_count'] =0;
  if(!isset($_SESSION['session_user'])){
	  $_SESSION['session_user'] = 'Guest';
  }
  $ordertime = $_SESSION["ordertime"];
  $ordertype = $_SESSION["ordertype"];
  


  if($ordertime != null && $ordertype != null){
	  if($_SESSION['session_user'] == 'Guest'){
		  header("Location: menu-items.php");
	  }else{
		   header("Location: menu-items.php");
	  }
  }else{
    alert("Please make a selection before ordering!");
  }
 ?>
