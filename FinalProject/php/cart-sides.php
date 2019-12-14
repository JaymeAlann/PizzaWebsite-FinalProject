<?php
	session_start();
	require('../mysql.php');
	ini_set("display_errors","1");
	error_reporting(E_ALL);
	
	$conn = OpenCon();


	if(isset($_POST['Breadsticks'])){
		$productName = "Breadsticks";
		$sql = "select Product_ID from PRODUCT where Product_Name ='$productName'";
		$sqlResults = MySQLi_Query($conn,$sql);
		$sqlRow = mysqli_fetch_array($sqlResults,MYSQLI_ASSOC);
		$ProductID = $sqlRow['Product_ID'];
		
		// FIRST CHECK ORDER_ITEM FOR REDUNDANCIES
		$checkOrderItem = "select count(*) from ORDER_ITEM where Product_ID='".$ProductID."' and Pizza_ID='0'";
		$orderItemQuery=MySQLi_Query($conn, $checkOrderItem);
		$orderItemRow = mysqli_fetch_array($orderItemQuery,MYSQLI_ASSOC);
		$ItemCount = $orderItemRow['count(*)']; // IF 0 THEN ENTER INTO ORDER_ITEM;
		
		
		if($ItemCount == 0){
			// ENTER PRODUCT_ID AND PIZZA_ID INTO ORDER_ITEMS
			// FIRST GET ORDER_ITEM ID THEN ENTER
			$orderItemIDSQL = "select max(Item_ID) from ORDER_ITEM";
			$OrderItemresutls = MySQLi_Query($conn, $orderItemIDSQL);
			$ItemNumberRow =  mysqli_fetch_array($OrderItemresutls,MYSQLI_ASSOC);
			$orderItemID = $ItemNumberRow['max(Item_ID)']+1;
			
			
			$orderItemInsert = "insert into ORDER_ITEM values('".$orderItemID."','".$ProductID."','0')";
			
			if(MySQLi_Query($conn, $orderItemInsert)){
				
			}else{
				echo "ERROR: ".mysqli_error($conn);
			}
		}else{
			$getOrderID = "select Item_ID from ORDER_ITEM where Product_ID='".$ProductID."' and Pizza_ID='".$PizzaID."'";
			$getOrderIDquery=MySQLi_Query($conn, $getOrderID);
			$getOrderItemRow = mysqli_fetch_array($getOrderIDquery,MYSQLI_ASSOC);
			$orderItemID = $getOrderItemRow['Item_ID'];
		}
		$_SESSION['cart_item'][] = $orderItemID;
		if(isset($_SESSION['cart_count'])){
			$_SESSION['cart_count'] += 1;
		}else{
			$_SESSION['cart_count'] = 0;
		}
		header("Location: menu-items.php#sides");
	}
	
	if(isset($_POST['Breadsticks2'])){
		$productName = "Garlic Knots";
		$sql = "select Product_ID from PRODUCT where Product_Name ='$productName'";
		$sqlResults = MySQLi_Query($conn,$sql);
		$sqlRow = mysqli_fetch_array($sqlResults,MYSQLI_ASSOC);
		$ProductID = $sqlRow['Product_ID'];
		
		// FIRST CHECK ORDER_ITEM FOR REDUNDANCIES
		$checkOrderItem = "select count(*) from ORDER_ITEM where Product_ID='".$ProductID."' and Pizza_ID='0'";
		$orderItemQuery=MySQLi_Query($conn, $checkOrderItem);
		$orderItemRow = mysqli_fetch_array($orderItemQuery,MYSQLI_ASSOC);
		$ItemCount = $orderItemRow['count(*)']; // IF 0 THEN ENTER INTO ORDER_ITEM;
		
		
		if($ItemCount == 0){
			// ENTER PRODUCT_ID AND PIZZA_ID INTO ORDER_ITEMS
			// FIRST GET ORDER_ITEM ID THEN ENTER
			$orderItemIDSQL = "select max(Item_ID) from ORDER_ITEM";
			$OrderItemresutls = MySQLi_Query($conn, $orderItemIDSQL);
			$ItemNumberRow =  mysqli_fetch_array($OrderItemresutls,MYSQLI_ASSOC);
			$orderItemID = $ItemNumberRow['max(Item_ID)']+1;
			
			
			$orderItemInsert = "insert into ORDER_ITEM values('".$orderItemID."','".$ProductID."','0')";
			
			if(MySQLi_Query($conn, $orderItemInsert)){
				
			}else{
				echo "ERROR: ".mysqli_error($conn);
			}
		}else{
			$getOrderID = "select Item_ID from ORDER_ITEM where Product_ID='".$ProductID."' and Pizza_ID='".$PizzaID."'";
			$getOrderIDquery=MySQLi_Query($conn, $getOrderID);
			$getOrderItemRow = mysqli_fetch_array($getOrderIDquery,MYSQLI_ASSOC);
			$orderItemID = $getOrderItemRow['Item_ID'];
		}
		$_SESSION['cart_item'][] = $orderItemID;
		if(isset($_SESSION['cart_count'])){
			$_SESSION['cart_count'] += 1;
		}else{
			$_SESSION['cart_count'] = 0;
		}
		header("Location: menu-items.php#sides");
	}
	
	if(isset($_POST['Caesar'])){
		$productName = "Caesar Salad";
		$sql = "select Product_ID from PRODUCT where Product_Name ='$productName'";
		$sqlResults = MySQLi_Query($conn,$sql);
		$sqlRow = mysqli_fetch_array($sqlResults,MYSQLI_ASSOC);
		$ProductID = $sqlRow['Product_ID'];
		
		// FIRST CHECK ORDER_ITEM FOR REDUNDANCIES
		$checkOrderItem = "select count(*) from ORDER_ITEM where Product_ID='".$ProductID."' and Pizza_ID='0'";
		$orderItemQuery=MySQLi_Query($conn, $checkOrderItem);
		$orderItemRow = mysqli_fetch_array($orderItemQuery,MYSQLI_ASSOC);
		$ItemCount = $orderItemRow['count(*)']; // IF 0 THEN ENTER INTO ORDER_ITEM;
		
		
		if($ItemCount == 0){
			// ENTER PRODUCT_ID AND PIZZA_ID INTO ORDER_ITEMS
			// FIRST GET ORDER_ITEM ID THEN ENTER
			$orderItemIDSQL = "select max(Item_ID) from ORDER_ITEM";
			$OrderItemresutls = MySQLi_Query($conn, $orderItemIDSQL);
			$ItemNumberRow =  mysqli_fetch_array($OrderItemresutls,MYSQLI_ASSOC);
			$orderItemID = $ItemNumberRow['max(Item_ID)']+1;
			
			
			$orderItemInsert = "insert into ORDER_ITEM values('".$orderItemID."','".$ProductID."','0')";
			
			if(MySQLi_Query($conn, $orderItemInsert)){
				
			}else{
				echo "ERROR: ".mysqli_error($conn);
			}
		}else{
			$getOrderID = "select Item_ID from ORDER_ITEM where Product_ID='".$ProductID."' and Pizza_ID='".$PizzaID."'";
			$getOrderIDquery=MySQLi_Query($conn, $getOrderID);
			$getOrderItemRow = mysqli_fetch_array($getOrderIDquery,MYSQLI_ASSOC);
			$orderItemID = $getOrderItemRow['Item_ID'];
		}
		$_SESSION['cart_item'][] = $orderItemID;
		if(isset($_SESSION['cart_count'])){
			$_SESSION['cart_count'] += 1;
		}else{
			$_SESSION['cart_count'] = 0;
		}
		header("Location: menu-items.php#sides");
	}
	
	if(isset($_POST['Mixed'])){
		$productName = "Mixed Salad ";
		$sql = "select Product_ID from PRODUCT where Product_Name ='$productName'";
		$sqlResults = MySQLi_Query($conn,$sql);
		$sqlRow = mysqli_fetch_array($sqlResults,MYSQLI_ASSOC);
		$ProductID = $sqlRow['Product_ID'];
		
		// FIRST CHECK ORDER_ITEM FOR REDUNDANCIES
		$checkOrderItem = "select count(*) from ORDER_ITEM where Product_ID='".$ProductID."' and Pizza_ID='0'";
		$orderItemQuery=MySQLi_Query($conn, $checkOrderItem);
		$orderItemRow = mysqli_fetch_array($orderItemQuery,MYSQLI_ASSOC);
		$ItemCount = $orderItemRow['count(*)']; // IF 0 THEN ENTER INTO ORDER_ITEM;
		
		
		if($ItemCount == 0){
			// ENTER PRODUCT_ID AND PIZZA_ID INTO ORDER_ITEMS
			// FIRST GET ORDER_ITEM ID THEN ENTER
			$orderItemIDSQL = "select max(Item_ID) from ORDER_ITEM";
			$OrderItemresutls = MySQLi_Query($conn, $orderItemIDSQL);
			$ItemNumberRow =  mysqli_fetch_array($OrderItemresutls,MYSQLI_ASSOC);
			$orderItemID = $ItemNumberRow['max(Item_ID)']+1;
			
			
			$orderItemInsert = "insert into ORDER_ITEM values('".$orderItemID."','".$ProductID."','0')";
			
			if(MySQLi_Query($conn, $orderItemInsert)){
				
			}else{
				echo "ERROR: ".mysqli_error($conn);
			}
		}else{
			$getOrderID = "select Item_ID from ORDER_ITEM where Product_ID='".$ProductID."' and Pizza_ID='".$PizzaID."'";
			$getOrderIDquery=MySQLi_Query($conn, $getOrderID);
			$getOrderItemRow = mysqli_fetch_array($getOrderIDquery,MYSQLI_ASSOC);
			$orderItemID = $getOrderItemRow['Item_ID'];
		}
		$_SESSION['cart_item'][] = $orderItemID;
		if(isset($_SESSION['cart_count'])){
			$_SESSION['cart_count'] += 1;
		}else{
			$_SESSION['cart_count'] = 0;
		}
		header("Location: menu-items.php#sides");
	}
?>