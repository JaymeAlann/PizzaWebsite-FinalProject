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
			<?php
				session_start();
				if(isset($_SESSION['user_id'])){
					?>
					<li class="nav-item mr-3">
						<a class="nav-link" href="order-home.php">HOME</a>
					 </li>
					 <li class="nav-item mr-3">
						<a class="nav-link" href="menu-items.php">MENU</a>
					 </li>
					 <li class="nav-item mr-3">
						<a class="nav-link" href="UserAccount.php">MY ACCOUNT</a>
					 </li>
					 <?php
				}else{
					?>
					<li class="nav-item mr-3">
						<a class="nav-link" href="order-home.php">HOME</a>
					 </li>
					 <li class="nav-item mr-3">
						<a class="nav-link" href="menu-items.php">MENU</a>
					 </li>
					 <li class="nav-item mr-3">
						<a class="nav-link" href="login.php">LOGIN</a>
					 </li>
					 <?php
				}

			 ?>
            </ul>
          </div>
        </div>
    </nav>
	 <!-- ********************************************************* USER SECTION *********************************************************** -->
	 <section>
              <div class="row mt-5 checkout">
                <div class="col-75">
                  <div class="container">
                    <form action="processOrder.php">

                      <div class="row">
                        <div class="col-50">
                          <h3>Billing Address</h3>
                          <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                          <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
                          <label for="email"><i class="fa fa-envelope"></i> Email</label>
                          <input type="text" id="email" name="email" placeholder="john@example.com">
                          <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                          <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
                          <label for="city"><i class="fa fa-institution"></i> City</label>
                          <input type="text" id="city" name="city" placeholder="New York">

                          <div class="row">
                            <div class="col-50">
                              <label for="state">State</label>
                              <input type="text" id="state" name="state" placeholder="NY">
                            </div>
                            <div class="col-50">
                              <label for="zip">Zip</label>
                              <input type="text" id="zip" name="zip" placeholder="10001">
                            </div>
                          </div>
                        </div>

                        <div class="col-50">
                          <h3>Payment</h3>
                          <label for="fname">Accepted Cards</label>
                          <div class="icon-container">
                            <i class="fa fa-cc-visa" style="color:navy;"></i>
                            <i class="fa fa-cc-amex" style="color:blue;"></i>
                            <i class="fa fa-cc-mastercard" style="color:red;"></i>
                            <i class="fa fa-cc-discover" style="color:orange;"></i>
                          </div>
                          <label for="cname">Name on Card</label>
                          <input type="text" id="cname" name="cardname" placeholder="John More Doe">
                          <label for="ccnum">Credit card number</label>
                          <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                          <label for="expmonth">Exp Month</label>
                          <input type="text" id="expmonth" name="expmonth" placeholder="September">

                          <div class="row">
                            <div class="col-50">
                              <label for="expyear">Exp Year</label>
                              <input type="text" id="expyear" name="expyear" placeholder="2018">
                            </div>
                            <div class="col-50">
                              <label for="cvv">CVV</label>
                              <input type="text" id="cvv" name="cvv" placeholder="352">
                            </div>
                          </div>
                        </div>

                      </div>
                      <label>
                        <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
                      </label>
					  <label>
                        <input type="checkbox" name=" paycashcheck"> Pay Cash or Check Upon Delivery/Pick-up
                      </label>
                      <input type="submit" value="Continue to checkout" class="btn">
                    </form>
                  </div>
                </div>

                <div class="col-25">
                  <div class="container">
                    <h4>Cart
                      <span class="price" style="color:black">
                        <i class="fa fa-shopping-cart"></i>
                        <b><?php
                          session_start();
                          require('../mysql.php');
                          ini_set("display_errors","1");
                          error_reporting(E_ALL);

                          if(isset($_SESSION['cart_count'])){
                            echo $_SESSION['cart_count'];
                          }
                        ?></b>
                      </span>
                    </h4>
                    <?php

            						$conn = OpenCon();
            						ini_set("display_errors","1");
            						error_reporting(E_ALL);
            						//$_SESSION[cart-item] = Product id
            						if($_SESSION['cart_count']==0){
            							echo "<p> <strong> Your Cart is Empty</strong> <br> <i>Select one of our delicous items below!</i> </p>";
            						}else{
            							echo "<p> <strong>".$_SESSION['ordertype']." for ".$_SESSION['ordertime']."</strong></p> <hr>";
            							$_SESSION['total_price']=0;
            							$insideCart = implode(',',$_SESSION['cart_item']);
            							$sqlTry = "select Product_Name, Size, IMG, Price from ORDER_ITEM join PRODUCT on PRODUCT.Product_ID = ORDER_ITEM.Product_ID where Item_ID  in ($insideCart)";
            							$cartResults=MySQLi_Query($conn, $sqlTry);
            							while($row = mysqli_fetch_array($cartResults,MYSQLI_ASSOC)){
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
            							$_SESSION['tax']=$_SESSION['total_price']*.075;
            							echo "<p><strong>Sub Total: </strong>$".round($_SESSION['total_price'],2)."</br><p>";
            							echo "<p><strong>Tax: </strong>$".round($_SESSION['tax'],2)."</br><p>";
            							$_SESSION['final_price']=$_SESSION['tax']+$_SESSION['total_price'];
            							echo "<p><strong>TOTAL PRICE: <span class='price' style='color:black'></strong>$".round($_SESSION['final_price'],2)."</br></span><p>";
            						}
            			?>
                  </div>
                </div>
              </div>
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
      <!-- Smooth Scroll -->
      <!-- <script src="../js/smooth-scroll.js"></script> -->
      <!-- <script>var scroll = new SmoothScroll('a[href*="#"]');</script> -->

  </body>
</html>
