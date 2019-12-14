<?php
	ini_set("display_errors","1");
	error_reporting(E_ALL);
	/*gotcha4@yahoo.com*/
	
	require('../mysql.php');
	session_start();
	$conn = OpenCon();
	$nickname = $_POST['StreetName'];
	$type = $_POST['Type'];
	$Street = $_POST['Street'];
	$Suite = $_POST['Suite'];
	$City = $_POST['City'];
	$State = $_POST['State'];
	$Zip = $_POST['Zip'];
	
	
	
	if(MYSQLI_Connect_Errno()){
		echo "<tr align='center'> <td colspan='5'> FAILED TO CONNECTO TO MYSQL Database </td></tr>";
	}
	else{
		$sql1  = "select max(Address_ID) from ADDRESS";
		$id=MySQLi_Query($conn, $sql1);
		$results = mysqli_fetch_array($id,MYSQLI_ASSOC);
		$count = $results['max(Address_ID)']+1;
		
		$sql4  = "select max(Customer_Address_ID) from CUSTOMER_ADDRESS";
		$id2=MySQLi_Query($conn, $sql4);
		$results2 = mysqli_fetch_array($id2,MYSQLI_ASSOC);
		$count2 = $results2['max(Customer_Address_ID)']+1;
		
		$sql2 = "insert into ADDRESS values('".$count."','".$nickname."','".$type."','".$Street."','".$Suite."','".$City."','".$State."','".$Zip."')";
		
		$sql3 = "insert into CUSTOMER_ADDRESS values('".$count2."','".$_SESSION['user_id']."','".$count."')";
		
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