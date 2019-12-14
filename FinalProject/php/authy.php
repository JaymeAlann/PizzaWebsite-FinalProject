<?php
	ini_set("display_errors","1");
	error_reporting(E_ALL);
	
	require('../mysql.php');
	session_start();
	$_SESSION["phone"] = $_POST['phonenumber'];
	$_SESSION["pass"] = $_POST['password'];
	

	$userPhone = $_SESSION["phone"];
	$pass = $_SESSION["pass"];
	
	$conn = OpenCon();
	
	if(MYSQLI_Connect_Errno()){
		echo "<tr align='center'> <td colspan='5'> FAILED TO CONNECTO TO MYSQL Database </td></tr>";
	}
	else{
		$query1 = "select count(*) as num from CUSTOMER inner join CUSTOMER_LOGIN on CUSTOMER.Customer_ID = CUSTOMER_LOGIN.Customer_ID where Customer_Phone='".$userPhone."' AND Customer_Password='".$pass."'";
		
	
		$check_Phone=MySQLi_Query($conn, $query1);
		$results = mysqli_fetch_array($check_Phone,MYSQLI_ASSOC);
		$count = $results['num'];
		
		if($count == 1) {
			$query2 = "select First_Name, Last_Name, Customer_ID from CUSTOMER where Customer_Phone = '".$userPhone."'";
			$userCheck = MySQLi_Query($conn, $query2);
			$row = mysqli_fetch_array($userCheck,MYSQLI_ASSOC);
			$_SESSION['user_id'] = $row['Customer_ID'];
			$_SESSION['session_user'] = $row['First_Name']." ".$row['Last_Name'];
			//echo $_SESSION['session_user'];
			CloseCon($conn);
			header("Location: order-home.php");
		  }else {
			header("Location: login.php");
			 CloseCon($conn);
		  }
		 
	}

?>
