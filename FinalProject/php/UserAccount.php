<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>PAPIS PIES</title>

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" type="text/css" href="../style.css">
    <!-- FONT AWESOME CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  </head>

  <body>

    <!-- ********************************************************* NAVAGATION BAR *********************************************************** -->

    <nav class="navbar navbar-expand-lg navbar-expand-md navbar-dark fixed-top">
      <div class="container">
          <a href="#" class="navbar-brand">(404) 440-4044</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-Menu" aria-controls="navbar-Menu" expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbar-Menu" align="right">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item mr-3">
                <a class="nav-link" onclick="goBack()">BACK</a>
				<script>
					function goBack(){
						window.history.back();
					}
				</script>
              </li>
            </ul>
          </div>
        </div>
    </nav>
	 <!-- ********************************************************* ADDRESS MODAL *********************************************************** -->
	 <div class="AddAddressModal" id="AddressModal">
      <div class="AddAddressModalContent">
        <div class="AddressModalHeader text-center">
          <span class="AddAddressCloseBTN">&times;</span>
          <h2>Add Another Address</h2>
        </div>
        <div class="AddressModalBody">
          <form action="AddAddress.php" method="POST">
            <div class="container">
              <p class="text-center">Please fill in this form to add a saved address</p>
              <hr>

              <label for="StreetName"><b>Address Nickname</b></label>
              <input type="text" placeholder="Enter Name" name="StreetName" required>
              <div class="row">
                <div class="col-sm-6 col-med-6 col-lg-6">
                  <label for="Street"><b>Street</b></label>
                  <input type="text" placeholder="Enter Street Address" name="Street" required>
                </div>
				<div class="col-sm-3 col-med-3 col-lg-3">
                  <label for="Type"><b>Type</b></label>
                  <input type="text" placeholder="Type" name="Type" required>
                </div>
                <div class="col-sm-3 col-med-3 col-lg-3">
                  <label for="Suite"><b>Suite</b></label>
                  <input type="text" placeholder="Suite" name="Suite" required>
                </div>
              </div>


              <div class="row">
                <div class="col-sm-6 col-med-6 col-lg-6">
                  <label for="City"><b>City</b></label>
                  <input type="text" placeholder="City" name="City" required>
                </div>
                <div class="col-sm-3 col-med-3 col-lg-3">
                  <label for="State"><b>State</b></label>
                  <input type="text" placeholder="State" name="State" required>
                </div>
                <div class="col-sm-3 col-med-3 col-lg-3">
                  <label for="Zip"><b>Zip</b></label>
                  <input type="text" placeholder="Zip" name="Zip" required>
                </div>
              </div>

              <hr>
              <button type="submit" class="registerbtn">Save Address</button>
            </div>
          </form>
        </div>
        <div class="AddressModalFooter">

        </div>
      </div>
    </div>

	 <!-- ********************************************************* PAYMENT MODAL *********************************************************** -->
	 <div class="AddPaymentModal" id="PaymentModal">
      <div class="AddPaymentModalContent">
        <div class="PaymentModalHeader text-center">
          <span class="AddPaymentCloseBTN">&times;</span>
          <h2>Add Payment Option</h2>
        </div>
        <div class="PaymentModalBody">
          <form action="AddPayment.php" method="POST">
            <div class="container">
              <p class="text-center">Please fill in this form to add a saved payment</p>
              <hr>

              <div class="row">
                <div class="col-sm-4 col-med-4 col-lg-4">
                  <label for="Payment_Nickname"><b>Payment Nickname</b></label>
                  <input type="text" placeholder="Enter Payment Nickname" name="Payment_Nickname" required>
                </div>
				<div class="col-sm-6 col-med-6 col-lg-6">
                  <label for="Name"><b>Name On Card</b></label>
                  <input type="text" placeholder="Enter Name On Card" name="Name" required>
                </div>
              </div>

			  <label for="Card_Number"><b>Card Number</b></label>
              <input type="text" placeholder="Card Number" name="Card_Number" required>

              <div class="row">
                <div class="col-sm-4 col-med-4 col-lg-4">
                  <label for="CVV"><b>CVV</b></label>
                  <input type="text" placeholder="CVV" name="CVV" required>
                </div>
                <div class="col-sm-4 col-med-4 col-lg-4">
                  <label for="Exp_Date"><b>Exp Date</b></label>
                  <input type="text" placeholder="Exp Date (2012-10-00)" name="Exp_Date" required>
                </div>
                <div class="col-sm-4 col-med-4 col-lg-4">
                  <label for="Zip"><b>Zip</b></label>
                  <input type="text" placeholder="Zip" name="Zip" required>
                </div>
              </div>

              <hr>
              <button type="submit" class="registerbtn">Save Payment Option</button>
            </div>
          </form>
        </div>
        <div class="AddressModalFooter">

        </div>
      </div>
    </div>


	<?php
		/*gotcha3@yahoo.com*/
		session_start();
		require('../mysql.php');

		$conn = OpenCon();

		$query1 = "select ADDRESS.Address_Nickname, ADDRESS.Type, ADDRESS.Street, ADDRESS.Suite, ADDRESS.City, ADDRESS.State, ADDRESS.Zip from CUSTOMER_ADDRESS join CUSTOMER on CUSTOMER.Customer_ID = CUSTOMER_ADDRESS.Customer_ID join ADDRESS on CUSTOMER_ADDRESS.Address_ID = ADDRESS.Address_ID where Customer_Phone = '".$_SESSION["phone"]."'";

		$results=MySQLi_Query($conn, $query1);




	?>


	 <!-- ********************************************************* USER SECTION *********************************************************** -->
	 <section>
		<?php
			$query = "select Customer_Email from CUSTOMER where Customer_Phone = '".$_SESSION["phone"]."'";

			$results=MySQLi_Query($conn, $query);
			$row = mysqli_fetch_array($results,MYSQLI_ASSOC);
			$email = $row['Customer_Email'];
			$_SESSION['Customer_Email'] = $email;
		?>
		<div class="container">
			<span class="text-center p-4"><h3>Welcome, <?php echo $_SESSION['session_user'] ?></h3> <hr></span>
			<p></p>
			<button type="button" class="collapsible">Personal Information</button>
			<div class="content">
				<hr>
				<h6><u>CONTACT EMAIL</u></h6>
				<p><?php echo $_SESSION['Customer_Email'] ?><br></p>
				<h6><u>PHONE</u></h6>
				<p><?php echo $_SESSION['phone'] ?><br></p>
				<h6><u>ADDRESS</u></h6>
				<?php

				ini_set("display_errors","1");
				error_reporting(E_ALL);
				$query1 = "select ADDRESS.Address_Nickname, ADDRESS.Type, ADDRESS.Street, ADDRESS.Suite, ADDRESS.City, ADDRESS.State, ADDRESS.Zip from CUSTOMER_ADDRESS join CUSTOMER on CUSTOMER.Customer_ID = CUSTOMER_ADDRESS.Customer_ID join ADDRESS on CUSTOMER_ADDRESS.Address_ID = ADDRESS.Address_ID where Customer_Phone = '".$_SESSION["phone"]."'";

				$results=MySQLi_Query($conn, $query1);
				while($row = mysqli_fetch_array($results,MYSQLI_ASSOC)){
					$customer_AddressName = $row['Address_Nickname'];
					$customer_AddressType = $row['Type'];
					$customer_AddressStreet = $row['Street'];
					$customer_AddressCity = $row['City'];
					$customer_AddressState = $row['State'];
					$customer_AddressZip = $row['Zip'];
					echo "<p><strong>".$customer_AddressName." | ".$customer_AddressType."</strong></br>";
					echo $customer_AddressStreet."</br>";
					echo $customer_AddressCity." ".$customer_AddressState." ".$customer_AddressZip."</p>";
				}
				?>
				<hr>
				<button id="addAddressBTN" class="checkout myModalBtn ml-4 mr-4 text-light" type="button" name="button">Add Address</button>
				<hr>
			</div>
			<hr>

			<button type="button" class="collapsible">My Orders</button>
			<div class="content">
				<hr>
				<h6>ORDER</h6>
				<?php
					ini_set("display_errors","1");
					error_reporting(E_ALL);
					$query2 = "select Product_Name, Size, IMG, Price, Order_Total from `ORDER` join ORDER_DETAILS on ORDER_DETAILS.Order_ID = `ORDER`.Order_ID join ORDER_ITEM on ORDER_ITEM.Item_ID = ORDER_DETAILS.Item_ID join PRODUCT on PRODUCT.Product_ID = ORDER_ITEM.Product_ID join CUSTOMER_ADDRESS on CUSTOMER_ADDRESS.Customer_Address_ID = `ORDER`.Customer_Address_ID where Customer_ID = '".$_SESSION['user_id']."'";


					$results2=MySQLi_Query($conn, $query2);
					while($row = mysqli_fetch_array($results2,MYSQLI_ASSOC)){
						$order_Total = $row['Order_Total'];
						$cart_Product_ID = $row['Product_Name'];
						$cart_Product_Size = $row['Size'];
						$cart_Product_IMG = $row['IMG'];
						$cart_Product_Price = $row['Price'];
						$_SESSION['total_price']+=$cart_Product_Price;
						echo "<p><strong>".$cart_Product_ID." | ".$cart_Product_Size."</strong></br>";
						echo "<img height='75px' width=='75px' src='".$cart_Product_IMG."' alt='product' /></br>";
						echo "$<i>".$cart_Product_Price."</i></br></p>";
						echo "<hr>";
					}
					
					
				?>
				<hr>
			</div>
			<hr>

			<button type="button" class="collapsible">Saved Payment Options</button>
			<div class="content">
				<hr>
				<h6><u>PAYMENT NAME</u></h6>
				<?php
					ini_set("display_errors","1");
					error_reporting(E_ALL);
					$query2 = "select Payment_Nickname,Name_On_Card, Card_Number, Security_Code, Expiration_Date, Billing_Code from CUSTOMER_PAYMENT join CUSTOMER on CUSTOMER.Customer_ID = CUSTOMER_PAYMENT.Customer_ID join PAYMENTS on CUSTOMER_PAYMENT.Payment_ID = PAYMENTS.Payment_ID where Customer_Phone = '".$_SESSION["phone"]."'";

					$results2=MySQLi_Query($conn, $query2);
					while($row2 = mysqli_fetch_array($results2,MYSQLI_ASSOC)){
						$paymentNickname = $row2['Payment_Nickname'];
						$paymentCardName = $row2['Name_On_Card'];
						$cardNum = $row2['Card_Number'];
						$Security_Code = $row2['Security_Code'];
						$expiration = $row2['Expiration_Date'];
						$billing = $row2['Billing_Code'];
						echo "<p><strong>".$paymentCardName." | ".$paymentNickname."</strong></br>";
						echo $cardNum."</br>";
						echo $expiration."</br>";
						echo $Security_Code." ".$billing."</p>";
					}
				?>
				<hr>
				<button id="addPaymentBTN" class="checkout myModalBtn ml-4 mr-4 text-light" type="button" name="button">Add Payment Option</button>
				<hr>
			</div>
			<hr>

			<button type="button" class="collapsible">Change Password</button>
			<div class="content">
				<hr>
				<form action="UserAccount.php" method="POST">
					 <div class="container">
						<div class="changePSW">
							<p>Please fill in this form to change Password.</p>
							<hr>

							<label for="email"><b>Original Password</b></label>
							<input type="password" placeholder="Enter Password" name="psw" required>

							<label for="psw"><b>New Password</b></label>
							<input type="password" placeholder="Enter New Password" name="new-psw" required>

							<label for="psw-repeat"><b>Repeat New Password</b></label>
							<input type="password" placeholder="Repeat New Password" name="new-psw-repeat" required>

							<button type="submit" class="registerbtn">Change Password</button>
						</div>
					  </div>
					  <?php
						ini_set("display_errors","1");
						error_reporting(E_ALL);
						if(isset($_POST['psw']) && isset($_POST['new-psw']) && isset($_POST['new-psw-repeat']) ){
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
										//CloseCon($conn);
										//header("Location: UserAccount.php");
										echo '<script type="text/javascript">alert("PASSWORD SAVED!");</script>';
									}else{
										//CloseCon($conn);
										echo "ERROR: ".mysqli_error($conn);
										//header("Location: UserAccount.php");
									}
							}else{
								echo "ERROR: ".mysqli_error($conn);
							}
							}

					?>
				</form>
				<hr>
			</div>
		</div>
		<script>
			var coll = document.getElementsByClassName("collapsible");
			var i;

			for (i = 0; i < coll.length; i++) {
			  coll[i].addEventListener("click", function() {
				this.classList.toggle("active");
				var content = this.nextElementSibling;
				if (content.style.display === "block") {
				  content.style.display = "none";
				} else {
				  content.style.display = "block";
				}
			  });
			}
		</script>
	 </section>



    <!-- ********************************************************* FOOTER *********************************************************** -->
    <section id="footer" style="
      position: fixed;
      right: 0;
      left: 0;
      bottom: 0;">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

          </div>
          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="copyrights text-light text-center">
              <p>© 2019 Kennesaw Student JGrady6 </p>
            </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

          </div>
        </div>
      </div>
    </section>




      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <!-- scrollspy -->
      <script>$('body').scrollspy({ target: '#navbar-Menu', offset: 85 })</script>
	  <script src="../js/addressModal.js"></script>
      <!-- Smooth Scroll -->
      <!-- <script src="../js/smooth-scroll.js"></script> -->
      <!-- <script>var scroll = new SmoothScroll('a[href*="#"]');</script> -->

  </body>
</html>
