<html>
	<head>
		<title>Papis Login</title>
		<link rel="stylesheet" type="text/css" href="../style.css">
	</head>
	<body class="LoginBody">

    <!-- ************************************* LOGIN BOX ********************************************* -->
		<div class ="loginbox">
			<img src="../img/papislogo.png" class="avatar">
			<h2>Login Here</h2>
			<form action="authy.php" method="POST" name="login">
				<div class="inputBox">
					<input type="text" name="phonenumber" required="">
					<label>Phone Number</label>
				</div>
				<div class="inputBox">
					<input type="password" name="password" required="">
					<label>Password</label>
				</div>
				<input type="submit" name="submit" value="login">
				<div class ="rightHref" style="float: right;"><a href="order-home.php">Continue as Guest ></a></div>
			</form>
		</div>
	</body>
</html>
