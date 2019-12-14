<html>
	<head>
		<title>Papis Login</title>
		<link rel="stylesheet" type="text/css" href="../style.css">
	</head>
	<body class="LoginBody">

    <!-- ************************************* LOGIN BOX ********************************************* -->
		<div class ="loginbox">
			<img src="../img/papislogo.png" class="avatar">
			<h2>Sign Up Here</h2>
			<?php
				ini_set("display_errors","1");
				error_reporting(E_ALL);
				session_start();
				
				if(isset($_SESSION['error_msg'])){
					echo $_SESSION['error_msg'];
				}else{
					$_SESSION['error_msg']=" ";
				}
				
			?>
			<form action="signup.php" method="POST" name="login">
				<div class="inputBox">
					<input type="text" name="phonenumber" required="">
					<label>Phone Number</label>
				</div>
				<div class="inputBox">
					<input type="text" name="firstname" required="">
					<label>First Name</label>
				</div>
				<div class="inputBox">
					<input type="text" name="lastname" required="">
					<label>Last Name</label>
				</div>
				<div class="inputBox">
					<input type="text" name="email" required="">
					<label>Email</label>
				</div>
				<div class="inputBox">
					<input type="password" name="password" required="">
					<label>Password</label>
				</div>
				<div class="inputBox">
					<input type="password" name="passwordConfirm" required="">
					<label>Confirm Password</label>
				</div>
				<input type="submit" name="submit" value="login">
				<div class ="rightHref" style="float: right;"><a href="order-home.php">Continue as Guest ></a></div>
			</form>
		</div>
	</body>
</html>
