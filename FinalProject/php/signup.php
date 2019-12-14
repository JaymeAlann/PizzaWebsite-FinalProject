<?php
	ini_set("display_errors","1");
	error_reporting(E_ALL);
	
	
	require('../mysql.php');
	session_start();
	$conn = OpenCon();
	$phone = $_POST['phonenumber'];
	$fname = $_POST['firstname'];
	$lname = $_POST['lastname'];
	$email = $_POST['email'];
	$passw = $_POST['password'];
	$passc = $_POST['passwordConfirm'];
	
	if(MYSQLI_Connect_Errno()){
		echo "<tr align='center'> <td colspan='5'> FAILED TO CONNECTO TO MYSQL Database </td></tr>";
	}
	else{
		if($passw == $passc){
			$sql1  = "select max(Customer_ID) from CUSTOMER";
			$id=MySQLi_Query($conn, $sql1);
			$results = mysqli_fetch_array($id,MYSQLI_ASSOC);
			$count = $results['max(Customer_ID)']+1;
			
			$sql2 = "insert into CUSTOMER values('".$count."','".$phone."','".$fname."','".$lname."','".$email."')";
			$sql3 = "insert into CUSTOMER_LOGIN values('".$count."','".$passw."')";
			
			if(mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3)){
				$_SESSION['error_msg']=null;
				CloseCon($conn);
				header("Location: login.php");
			}else{
				echo "ERROR: ".mysqli_error($conn);
				header("Location: signupForm.php");
			}
			
		}else{
			$_SESSION['error_msg'] = "<p class='textcenter'><font color='red'>Passwords Do Not Match!</font></p>";
			header("Location: signupForm.php");
		}
	}
	
?>