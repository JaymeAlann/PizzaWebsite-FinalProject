<?php
	ini_set("display_errors","1");
	error_reporting(E_ALL);
	
	require('../mysql.php');
	session_start();
	$conn = OpenCon();
	$nickname = $_POST['Payment_Nickname'];
	$name = $_POST['Name'];
	$CardNumber = $_POST['Card_Number'];
	$cvv = $_POST['CVV'];
	$expiration = $_POST['Exp_Date'];
	$zip = $_POST['Zip'];
	
	
	
	if(MYSQLI_Connect_Errno()){
		echo "<tr align='center'> <td colspan='5'> FAILED TO CONNECTO TO MYSQL Database </td></tr>";
	}
	else{
		$sql1  = "select max(Payment_ID) from PAYMENTS";
		$id=MySQLi_Query($conn, $sql1);
		$results = mysqli_fetch_array($id,MYSQLI_ASSOC);
		$count = $results['max(Payment_ID)']+1;
		
		$sql4  = "select max(Customer_Payment_ID) from CUSTOMER_PAYMENT";
		$id2=MySQLi_Query($conn, $sql4);
		$results2 = mysqli_fetch_array($id2,MYSQLI_ASSOC);
		$count2 = $results2['max(Customer_Payment_ID)']+1;
		
		$sql2 = "insert into PAYMENTS values('".$count."','".$nickname."','".$name."','".$CardNumber."','".$cvv."','".$expiration."','".$zip."')";
		
		$sql3 = "insert into CUSTOMER_PAYMENT values('".$count2."','".$_SESSION['user_id']."','".$count."')";
		
		if(mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3)){
			$_SESSION['error_msg']=null;
			CloseCon($conn);
			header("Location: UserAccount.php");
		}else{
			echo "ERROR: ".mysqli_error($conn);
			//header("Location: UserAccount.php");
		}
	}
	
?>