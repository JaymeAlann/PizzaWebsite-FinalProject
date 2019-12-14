<?php
	session_Start();
	unset($_SESSION['cart_item']);
	unset($_SESSION['cart_count']);
	header("Location: order-home.php");
?>