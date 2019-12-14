<?php
	session_start();
	require('../mysql.php');
    ini_set("display_errors","1");
    error_reporting(E_ALL);
	
	$conn = OpenCon();
	
	// GET NEW ORDER_ID
	$getOrderIDSQL = "select max(Order_ID) from `ORDER`";
	$OrderIDResults=MySQLi_Query($conn, $getOrderIDSQL);
	$Column = mysqli_fetch_array($OrderIDResults,MYSQLI_ASSOC);
	$OrderID = $Column['max(Order_ID)']+1; 
	
	// GET CUSTOMER_ADDRESS_ID
	if(isset($_SESSION['user_id'])){
		$getCustomerAddressIDSql = "select Customer_Address_ID from CUSTOMER_ADDRESS where Customer_ID = '".$_SESSION['user_id']."'";
		$CustomerAddressResutls=MySQLi_Query($conn, $getCustomerAddressIDSql);
		$Column = mysqli_fetch_array($CustomerAddressResutls,MYSQLI_ASSOC);
		$CustomerAddressID = $Column['Customer_Address_ID']; 
	}else{
		$CustomerAddressID = '0';
	}
	
	/*
	// GET PAYMENT TYPE
	if(isset($_POST['paycashcheck']){
		$_SESSION['Payment_Type'] = 'Cash or Check';
	}else{
		$_SESSION['Payment_Type'] = 'Credit Card';
	}
	*/
	
	// SET THE NEW ORDER INFORMATION
	$timestamp = date('Y-m-d h-i-s');
	$setOrderSql = "insert into `ORDER` values('".$OrderID."','".$_SESSION['ordertype']."','".$CustomerAddressID."','".$timestamp."','complete','".$_SESSION['final_price']."','Credit Card')";
	if(mysqli_query($conn, $setOrderSql)){
		echo "Insert Complete";
	}else{
		echo "error Insert";
	}
	
	
	$insideCart = implode(',',$_SESSION['cart_item']);
	$cartSize = count($_SESSION['cart_item']);
	$indexer=0;
	while($indexer<$cartSize){
		$sql = "select Price from ORDER_ITEM join PRODUCT on PRODUCT.Product_ID = ORDER_ITEM.Product_ID where Item_ID = '$_SESSION['cart_item'][$indexer]'";
		$priceResults = MySQLi_Query($conn, $sql);
		$priceColum = MySQLi_Fetch_Array($priceResults, MYSQLI_ASSOC);
		$price = $priceColum['Price'];
		
		$insertSQL = "insert into ORDER_DETAILS values('$OrderID','$_SESSION['cart_item'][$indexer]','1','$price', '$price')";
		if(mysqli_query($conn, $insertSQL)){
			echo "Insert 2 Complete";
		}else{
			echo "error 2 Insert";
		}
		$indexer++;
	}
	

?>