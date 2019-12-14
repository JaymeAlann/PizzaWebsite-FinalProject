<?php
	ini_set("display_errors","1");
	error_reporting(E_ALL);
	
	
	require('../mysql.php');
	session_start();

	$conn = OpenCon();
	
	$oldPSW = $_POST['psw'];
	$newPSW = $_POST['new-psw'];
	$rpNewPSW = $_POST['new-psw-repeat'];
	
	$query1 = "select Customer_Password from CUSTOMER_LOGIN join CUSTOMER on CUSTOMER.Customer_ID = CUSTOMER_LOGIN.Customer_ID where Customer_Phone ='".$_SESSION["phone"]."'";
	
	$results=MySQLi_Query($conn, $query1);
	$row = mysqli_fetch_array($results,MYSQLI_ASSOC);
	$psw = $row['Customer_Password'];
	if($oldPSW == $psw && $newPSW == $rpNewPSW){
		$query2 = "update CUSTOMER_LOGIN set Customer_Password = '".$newPSW."' where Customer_ID = '".$_SESSION['user_id']."'";
		if(mysqli_query($conn, $query2)){
				$_SESSION['error_msg']=null;
				CloseCon($conn);
				header("Location: UserAccount.php");
				echo '<script type="text/javascript">alert("PASSWORD SAVED!");</script>';
			}else{
				CloseCon($conn);
				echo "ERROR: ".mysqli_error($conn);
				header("Location: UserAccount.php");
			}
	}else{
		echo "ERROR: ".mysqli_error($conn);
		//header("Location: UserAccount.php");
	}

?>