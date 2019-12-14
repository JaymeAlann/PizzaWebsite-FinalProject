<!DOCTYPE html>
<?php
session_start();
require('../mysql.php');
ini_set("display_errors","1");
error_reporting(E_ALL);

if(empty($_SESSION['cart_item'])){
	$_SESSION['cart_item']=array();
}

?>
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
  <body data-spy="scroll" data-target="#navbar-Menu">
    <!-- ********************************************************* NAVAGATION BAR *********************************************************** -->
    <nav class="navbar navbar-expand-lg navbar-expand-md navbar-dark fixed-top">
      <div class="container">
          <button id="modalBtn" class="button"><a class="navbar-brand"><img src="../img/papislogo.png" alt="logo" style="width: 45px;" class="img-responsive">&nbsp; PAPIES PIES</a></button>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-Menu" aria-controls="navbar-Menu" expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbar-Menu" align="right">
            <ul class="navbar-nav ml-auto">
			<?php

				if(isset($_SESSION['user_id'])){
			?>
              <li class="nav-item mr-3 ">
                <a class="nav-link" href="#pizza">PIZZA</a>
              </li>
              <li class="nav-item mr-3 ">
                <a class="nav-link" href="#sides">SIDES</a>
              </li>
              <li class="nav-item mr-3 ">
                <a class="nav-link" href="#drinks">DRINKS</a>
              </li>
              <li class="nav-item mr-3 ">
                <a class="nav-link" href="#dessert">DESSERT</a>
              </li>
			  <li class="nav-item mr-3 ">
                <a class="nav-link" href="UserAccount.php">MY ACCOUNT</a>
              </li>
              <li class="nav-item mr-3 ">
                <a class="nav-link" id="cartBTN"><img src="../img/shoppingCart.png" style="width: 35px;" alt="cart"></a>
              </li>
			   <?php
					}else{
				?>
				<li class="nav-item mr-3 ">
                <a class="nav-link" href="#pizza">PIZZA</a>
              </li>
              <li class="nav-item mr-3 ">
                <a class="nav-link" href="#sides">SIDES</a>
              </li>
              <li class="nav-item mr-3 ">
                <a class="nav-link" href="#drinks">DRINKS</a>
              </li>
              <li class="nav-item mr-3 ">
                <a class="nav-link" href="#dessert">DESSERT</a>
              </li>
              <li class="nav-item mr-3 ">
                <a class="nav-link" id="cartBTN"><img src="../img/shoppingCart.png" style="width: 35px;" alt="cart"></a>
              </li>
			  <?php
				}

			 ?>
            </ul>
          </div>
        </div>
    </nav>
    <!-- ************************************************************* SHOPPING CART ***********************************************************-->
    <div class="container">
      <div class="shopping-cart">
        <div class="card card-info cart-card">
          <div class="card-body text-center">

            <h4 id="cartHeader"><strong><?php echo $_SESSION['session_user']; ?></strong></h4>
            <hr>
						<div class="phpHolder">
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
								$_SESSION['total_price']=$_SESSION['tax']+$_SESSION['total_price'];
								echo "<p><strong>TOTAL PRICE: </strong>$".round($_SESSION['total_price'],2)."</br><p>";
							}
						?>
					</div>
            <a  href="checkout.php"><button class="checkout myModalBtn ml-4 mr-4 text-light" type="button" name="button">Proceed To Checkout</button></a>

          </div>
        </div>
      </div>
      <script type="text/javascript">
        var cartBTN = document.getElementById("cartBTN");
        var cart = document.getElementsByClassName('shopping-cart')[0];

        cartBTN.addEventListener('click', openCart);

        function openCart(){
          if (cart.style.right == "0px") {
            cart.style.right = "-350px";
          }else {
            cart.style.right = "0px";
          }
        }
      </script>
    </div>


    <!-- ********************************************************* CLEAR ORDER MODAL *********************************************************** -->
    <div id="simpleModal" class="my-modal">
      <div class="my-modal-content text-center" style="padding-bottom: 2px;">
        <p>Are you Sure you would like to exit?</p>
        <p class="progress-p">You will lose your current order progress!</p>

        <a href="cancelOrder.php">
			<button class="myModalBtn" type="button" name="button">Exit</button>
		</a>
        <a id="closeBtn" class="pt-3"><p style="padding-top: 10px; margin: 3px;">continue shopping</p></a>
      </div>
    </div>

    <!-- ********************************************************* PIZZA PARALLAX *********************************************************** -->
    <section id="my-pizza-plx">
      <div class="container" id="pizza">
        <div class="my-pizza-plx-title text-center text-light">
        </div>
      </div>
    </section>

    <!-- ********************************************************* PIZZA MODAL *********************************************************** -->

	<form action="cart.php" method="POST">
    <div id="pizzaModal" class="my-pizza-modal">
      <div class="my-pizza-modal-content" style="padding-bottom: 2px;">
        <h2 style="text-align: center;"> <strong>Please select your toppings</strong> </h2>
        <hr>
			<div class="containter">
          <div class="row">
            <input type="hidden" id="PizzaType" name="PizzaType" value="Cheese">
            <div class="col-sm-6 col-md-6 col-lg 3">
              <h4>Cheese & Meats</h4>
              <div class="row box-row">
                <div class="col-sm-12 col-md-6 col-lg 3">
                  <input class="cheeseCheckbox" type="checkbox" name="topping[]" id="cheddar" value="Cheddar"> CHEDDAR<br>
                  <input class="cheeseCheckbox" type="checkbox" name="topping[]" id="asiago" value="Parmesan_Asiago"> ASIAGO<br>
                  <input class="cheeseCheckbox" type="checkbox" name="topping[]" id="provolone" value="Shredded_Provolone" > PROVOLONE<br>
                  <input class="cheeseCheckbox" type="checkbox" name="topping[]" id="feta" value="Feta" > FETA<br>
                  <input class="cheeseCheckbox" type="checkbox" name="topping[]" id="mozzerella" value="Mozzerella" > MOZZERELLA<br>
                </div>
                <div class="col-sm-12 col-md-6 col-lg 3">
                  <input class="toppings" type="checkbox" name="topping[]" id="ham" value="Ham"> HAM<br>
                  <input class="toppings" type="checkbox" name="topping[]" id="pepperoni" value="Pepperoni"> PEPPERONI<br>
                  <input class="toppings" type="checkbox" name="topping[]" id="sausage" value="Sausage" > SAUSAGE<br>
                  <input class="toppings" type="checkbox" name="topping[]" id="anchovies" value="Anchovies" > ANCHOVIES<br>
                  <input class="toppings" type="checkbox" name="topping[]" id="chicken" value="Chicken" > CHICKEN<br>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg 3">
              <h4>Veggies & More</h4>
              <div class="row box-row">
                <div class="col-sm-12 col-md-6 col-lg 3">
                  <input class="toppings" type="checkbox" name="topping[]" id="banana-peppers" value="Banana_Peppers" > BANANA PEPPERS<br>
                  <input class="toppings" type="checkbox" name="topping[]" id="Pineapple" value="Pineapple" >PINEAPPLE<br>
                  <input class="toppings" type="checkbox" name="topping[]" id="olives" value="Olives" > OLIVES<br>
                  <input class="toppings" type="checkbox" name="topping[]" id="green-peppers" value="Green_Peppers" > GREEN PEPPERS<br>
                  <input class="toppings" type="checkbox" name="topping[]" id="spinach" value="Spinach" > SPINACH<br>
                </div>
                <div class="col-sm-12 col-md-6 col-lg 3">
                  <input class="toppings" type="checkbox" name="topping[]" id="mushrooms" value="Mushrooms" > MUSHROOMS<br>
                  <input class="toppings" type="checkbox" name="topping[]" id="redpeppers" value="Red_Peppers" > RED PEPPERS<br>
                  <input class="toppings" type="checkbox" name="topping[]" id="Buffalo_Sauce" value="Buffalo_Sauce "> BUFFALO SAUCE<br>
                  <input class="toppings" type="checkbox" name="topping[]" id="jalepenos" value="Jalepenos "> JALEPENOS<br>
                  <input class="toppings" type="checkbox" name="topping[]" id="onions" value="Onions" > ONIONS<br>
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="text-center" style="margin-top: 15px;">
          <button id="addToCart" class="addToCart" type="submit" name="button">Add to Cart</button>
        </div>
        <a id="pizzaCloseBtn" class="pt-3"><p style="padding-top: 10px; margin: 3px;">Cancel, Go back to menu</p></a>
      </div>
    </div>

    <!-- ********************************************************* PIZZA SELECTIONS *********************************************************** -->

	<section id="menu">
      <div class="container">
        <div class="card-group text-center p-5">
          <div class="row">

              <!-- CARD 1 -->
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="card m-4">
                  <img class="card-img-top mb-3" src="../img/cheese.jpg" alt="Cheese">
                  <div class="card-block">

						<h4 class="card-title">CHEESE</h4>
						<div class="text-right pr-5">

						  <div class="size-select">
							<label for="cheese-size"> Size</label>
							<select class="pizza-size" name="Cheese-size" id="Cheese-size" style="width: 75px;">
							  <option value="SM">SML</option>
							  <option value="MED">MED</option>
							  <option value="LG">LRG</option>
							</select>
						  </div>

						  <div class="crust-select">
							<label for="cheese-crust"> Crust</label>
							<select class="pizza-crust" name="Cheese-crust" id="Cheese-crust"  style="width: 75px;">
							  <option value="Hand Tossed">Hand Tossed</option>
							  <option value="papispan">Papi's Pan</option>
							  <option value="Brooklyn">Brooklyn</option>
							  <option value="thincrispy">Thin'n Crunchy</option>
							</select>
						  </div>

						  <div class="sauce-select">
							<label for="cheese-sauce"> Sauce</label>
							<select class="pizza-sauce" name="Cheese-sauce" id="Cheese-sauce"  style="width: 75px;">
							  <option value="Hearty Tomatoe">Hearty Tomatoe</option>
							  <option value="Robust Marinara">Robust Marinara</option>
							  <option value="BBQ Sauce">BBQ Sauce</option>
							</select>
						  </div>
						</div>
						<span>
						  <a id="cheesepzBTN" class="btn btn-info mb-3 text-light">Select</a>
						</span>

                  </div>
                </div>
              </div>

              <!-- CARD 2 -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
              <div class="card m-4">
                <img class="card-img-top mb-3" src="../img/pepperoni.jpg" alt="Card image Cap">
                <div class="card-block">
                  <h4 class="card-title">PEPPERONI</h4>
					 <div class="text-right pr-5">
						<div class="size-select">
						  <label for="cheese-size"> Size</label>
						  <select class="pizza-size" name="Pepperoni-size" id="Pepperoni-size" style="width: 75px;">
							<option value="SM">SML</option>
							<option selected="selected" value="MED">MED</option>
							<option value="LG">LRG</option>
						  </select>
						</div>

						<div class="crust-select">
						  <label for="pepperoni-crust"> Crust</label>
						  <select class="pizza-crust" name="Pepperoni-crust" id="Pepperoni-crust" style="width: 75px;">
							<option selected="selected" value="handtossed">Hand Tossed</option>
							<option value="papispan">Papi's Pan</option>
							<option value="brooklyn">Brooklyn</option>
							<option value="thincrispy">Thin'n Crunchy</option>
						  </select>
						</div>

						<div class="sauce-select">
						  <label for="pepperoni-sauce"> Sauce</label>
						  <select class="pizza-sauce" name="Pepperoni-sauce" id="Pepperoni-sauce" style="width: 75px;">
							<option value="Hearty Tomatoe">Hearty Tomatoe</option>
							<option value="Robust Marinara">Robust Marinara</option>
							<option value="BBQ Sauce">BBQ Sauce</option>
						  </select>
						</div>
					  </div>

                  <span>
                    <a id="pepperonipzBTN" class="btn btn-info mb-3 text-light">Select</a>
                  </span>
                </div>
              </div>
            </div>

            <!-- CARD 3 -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
              <div class="card m-4">
                <img class="card-img-top mb-3" src="../img/supreme.jpg" alt="Card image Cap">
                <div class="card-block">
                  <h4 class="card-title">SUPREME</h4>
					 <div class="text-right pr-5">
						<div class="size-select">
						  <label for="cheese-size"> Size</label>
						  <select class="pizza-size" name="Supreme-size"  id="Supreme-size"style="width: 75px;">
							<option value="SM">SML</option>
							<option selected="selected" value="MED">MED</option>
							<option value="LG">LRG</option>
						  </select>
						</div>

						<div class="crust-select">
						  <label for="pepperoni-crust"> Crust</label>
						  <select class="pizza-crust" name="Supreme-crust"id="Supreme-crust" style="width: 75px;">
							<option value=""></option>
							<option selected="selected" value="handtossed">Hand Tossed</option>
							<option value="papispan">Papi's Pan</option>
							<option value="brooklyn">Brooklyn</option>
							<option value="thincrispy">Thin'n Crunchy</option>
						  </select>
						</div>

						<div class="sauce-select">
						  <label for="pepperoni-sauce"> Sauce</label>
						  <select class="pizza-sauce" name="Supreme-sauce"id="Supreme-sauce" style="width: 75px;">
							<option value="Hearty Tomatoe">Hearty Tomatoe</option>
							<option value="Robust Marinara">Robust Marinara</option>
							<option value="BBQ Sauce">BBQ Sauce</option>
						  </select>
						</div>
					  </div>
				  <span>
					<a id="supremepzBTN" class="btn btn-info mb-3 text-light">Select</a>
				  </span>
                </div>
              </div>
            </div>
            <!-- CARD 4 -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
              <div class="card m-4">
                <img class="card-img-top mb-3" src="../img/buffaloChicken.jpg" alt="Card image Cap">
                <div class="card-block">
                  <h4 class="card-title">BUFFALO CHICKEN</h4>
					 <div class="text-right pr-5">
						<div class="size-select">
						  <label for="buffChic-size"> Size</label>
						  <select class="pizza-size" name="Buffalo-Chicken-size"id="Buffalo Chicken-size" style="width: 75px;">
							<option value="SM">SML</option>
							<option selected="selected" value="MED">MED</option>
							<option value="LG">LRG</option>
						  </select>
						</div>

						<div class="crust-select">
						  <label for="buffChic-crust"> Crust</label>
						  <select class="pizza-crust" name="Buffalo-Chicken-crust"id="Buffalo Chicken-crust" style="width: 75px;">
							<option value=""></option>
							<option selected="selected" value="handtossed">Hand Tossed</option>
							<option value="papispan">Papi's Pan</option>
							<option value="brooklyn">Brooklyn</option>
							<option value="thincrispy">Thin'n Crunchy</option>
						  </select>
						</div>

						<div class="sauce-select">
						  <label for="buffChic-sauce"> Sauce</label>
						  <select class="pizza-sauce" name="Buffalo-Chicken-sauce"id="Buffalo Chicken-sauce" style="width: 75px;">
							<option value="Hearty Tomatoe">Hearty Tomatoe</option>
							<option value="Robust Marinara">Robust Marinara</option>
							<option value="BBQ Sauce">BBQ Sauce</option>
						  </select>
						</div>
					  </div>
                  <span>
                    <a id="buffChicpzBTN" class="btn btn-info mb-3 text-light">Select</a>
                  </span>
                </div>
              </div>
            </div>

            <!-- CARD 5 -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
              <div class="card m-4">
                <img class="card-img-top mb-3" src="../img/pacifica.jpeg" alt="Card image Cap">
                <div class="card-block">
                  <h4 class="card-title">PACIFICO</h4>
					 <div class="text-right pr-5">
						<div class="size-select">
						  <label for="pacifica-size"> Size</label>
						  <select class="pizza-size" name="Papis-Pacifica-size"id="Papis Pacifica-size" style="width: 75px;">
							<option value="SM">SML</option>
							<option selected="selected" value="MED">MED</option>
							<option value="LG">LRG</option>
						  </select>
						</div>

						<div class="crust-select">
						  <label for="pacifica-crust"> Crust</label>
						  <select class="pizza-crust" name="Papis-Pacifica-crust"id="Papis Pacifica-crust" style="width: 75px;">
							<option value=""></option>
							<option selected="selected" value="handtossed">Hand Tossed</option>
							<option value="papispan">Papi's Pan</option>
							<option value="brooklyn">Brooklyn</option>
							<option value="thincrispy">Thin'n Crunchy</option>
						  </select>
						</div>

						<div class="sauce-select">
						  <label for="pacifica-sauce"> Sauce</label>
						  <select class="pizza-sauce" name="Papis-Pacifica-sauce"id="Papis Pacifica-sauce" style="width: 75px;">
							<option value="Hearty Tomatoe">Hearty Tomatoe</option>
							<option value="Robust Marinara">Robust Marinara</option>
							<option value="BBQ Sauce">BBQ Sauce</option>
						  </select>
						</div>
					  </div>
                  <span>
                    <a id="pacificopzBTN" class="btn btn-info mb-3 text-light">Select</a>
                  </span>
                </div>
              </div>
            </div>

            <!-- CARD 6 -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
              <div class="card m-4">
                <img class="card-img-top mb-3" src="../img/BYOP.jpg" alt="Card image Cap">
                <div class="card-block">
                  <h4 class="card-title">BUILD YOUR OWN</h4>
					 <div class="text-right pr-5">
						<div class="size-select">
						  <label for="BYOP-size"> Size</label>
						  <select class="pizza-size" name="Build-Your-Own-size"id="BYOP-size" style="width: 75px;">
							<option value="SM">SML</option>
							<option selected="selected" value="MED">MED</option>
							<option value="LG">LRG</option>
						  </select>
						</div>

						<div class="crust-select">
						  <label for="BYOP-crust"> Crust</label>
						  <select class="pizza-crust" name="Build-Your-Own-crust"id="BYOP-crust" style="width: 75px;">
							<option value=""></option>
							<option selected="selected" value="handtossed">Hand Tossed</option>
							<option value="papispan">Papi's Pan</option>
							<option value="brooklyn">Brooklyn</option>
							<option value="thincrispy">Thin'n Crunchy</option>
						  </select>
						</div>

						<div class="sauce-select">
						  <label for="BYOP-sauce"> Sauce</label>
						  <select class="pizza-sauce" name="Build-Your-Own-sauce"id="BYOP-sauce" style="width: 75px;">
							<option value="Hearty Tomatoe">Hearty Tomatoe</option>
							<option value="Robust Marinara">Robust Marinara</option>
							<option value="BBQ Sauce">BBQ Sauce</option>
						  </select>
						</div>
					  </div>
                  <span>
                    <a id="byoppzBTN" class="btn btn-info mb-3 text-light">Select</a>
                  </span>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
	</form>
    <!-- ********************************************************* SIDES  PARALLAX *********************************************************** -->
    <section id="my-sides-plx">
      <div class="container" id="sides">
        <div class="my-sides-plx-title text-center text-light">
        </div>
      </div>
    </section>

    <!-- ********************************************************* SIDES SELECTIONS *********************************************************** -->
    <form action="cart-sides" method="POST">
	<section id="menu">
      <div class="container">
        <div class="card-group text-center p-5">
          <div class="row">
              <!-- CARD 1 -->
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card m-3">
                  <img class="card-img-top mb-3" src="../img/breadsticks.jpg" alt="Cheese">
                  <div class="card-block">
                    <h4 class="card-title">BREADSTICKS</h4>
                    <p class="card-text p-3">Soft and hot on the inside! Crunchy and Golden on the outside! The perfect pie partner!</p>
                    <button name="Breadsticks" value="Breadsticks" class="btn btn-info mb-3">Add to Cart</button>
                  </div>
                </div>
              </div>
              <!-- CARD 2 -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
              <div class="card m-3">
                <img class="card-img-top mb-3" src="../img/garlicknots.png" alt="Card image Cap">
                <div class="card-block">
                  <h4 class="card-title">GARLIC KNOTS</h4>
                  <p class="card-text p-3">You might wanna tie the knot on these cheesy, garlic, hot commodities! They sell fast!</p>
                  <button name="Breadsticks2" value="Breadsticks2" class="btn btn-info mb-3">Add to Cart</button>
                </div>
              </div>
            </div>
            <!-- CARD 3 -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
              <div class="card m-3">
                <img class="card-img-top mb-3" src="../img/caesar.jpg" alt="Card image Cap">
                <div class="card-block">
                  <h4 class="card-title">CAESAR SALAD</h4>
                  <p class="card-text p-3"><i>It is better to create than to learn! Creating is the essence of life.</i> So Papi created his own take on a this classic!</p>
                  <button name="Caesar" value="Caesar"  class="btn btn-info mb-3">Add to Cart</button>
                </div>
              </div>
            </div>
            <!-- CARD 4 -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
              <div class="card m-3">
                <img class="card-img-top mb-3" src="../img/salad.jpg" alt="Card image Cap">
                <div class="card-block">
                  <h4 class="card-title">MIXED SALAD</h4>
                  <p class="card-text p-3">We bet you never thought your taste buds would beg you for a salad? Well look no further!</p>
                  <button name="Mixed" value="Mixed"  class="btn btn-info mb-3">Add to Cart</button>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
	</form>

    <!-- *********************************************************DRINKS PARALLAX *********************************************************** -->
    <section id="my-drinks-plx">
      <div class="container" id="drinks">
        <div class="my-drinks-plx-title text-center text-light">
        </div>
      </div>
    </section>

    <!-- ********************************************************* DRINKS SELECTIONS *********************************************************** -->
    <form action="cart-drinks.php" method="POST">
	<section id="menu">
      <div class="container">
        <div class="card-group text-center p-5">
          <div class="row">
              <!-- CARD 1 -->
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="card m-4">
                  <img class="card-img-top mb-3" src="../img/coke.jpg" alt="Cheese">
                  <div class="card-block">
                    <h4 class="card-title">COKE</h4>
					<p><i><br></i></p>
                    <button name="coke" class="btn btn-info mb-3" data-toggle="modal" data-target=".apps">Add To Cart</button>
                  </div>
                </div>
              </div>
              <!-- CARD 2 -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
              <div class="card m-4">
                <img class="card-img-top mb-3" src="../img/dietcoke.jpg" alt="Card image Cap">
                <div class="card-block">
                  <h4 class="card-title">DIET COKE</h4>
				  <p><i><br></i></p>
                  <button name="dietcoke" class="btn btn-info mb-3" data-toggle="modal" data-target=".apps">Add To Cart</button>
                </div>
              </div>
            </div>
            <!-- CARD 3 -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
              <div class="card m-4">
                <img class="card-img-top mb-3" src="../img/cokezero.jpg" alt="Card image Cap">
                <div class="card-block">
                  <h4 class="card-title">COKE ZERO</h4>
				  <p><i><br></i></p>
                  <button name="cokezero"class="btn btn-info mb-3" data-toggle="modal" data-target=".apps">Add To Cart</button>
                </div>
              </div>
            </div>
            <!-- CARD 4 -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
              <div class="card m-4">
                <img class="card-img-top mb-3" src="../img/sprite.jpg" alt="Card image Cap">
                <div class="card-block">
                  <h4 class="card-title">SPRITE</h4>
				  <p><i><br></i></p>
                  <button name="sprite" class="btn btn-info mb-3" data-toggle="modal" data-target=".apps">Add To Cart</button>
                </div>
              </div>
            </div>
            <!-- CARD 5 -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
              <div class="card m-4">
                <img class="card-img-top mb-3" src="../img/peaceTea.gif" alt="Card image Cap">
                <div class="card-block">
                  <h4 class="card-title">PEACE TEA</h4>
				  <p><i><br></i></p>
                  <button name="peacetea" class="btn btn-info mb-3" data-toggle="modal" data-target=".apps">Add To Cart</button>
                </div>
              </div>
            </div>
            <!-- CARD 6 -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
              <div class="card m-4">
                <img class="card-img-top mb-3" src="../img/tea.jpg" alt="Card image Cap">
                <div class="card-block">
                  <h4 class="card-title">SWEET/UNSWEET</h4>
				  <p><i><br></i></p>
                  <button name="tea" class="btn btn-info mb-3" data-toggle="modal" data-target=".apps">Add To Cart</button>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
	</form>


    <!-- *********************************************************DESSERT PARALLAX *********************************************************** -->
    <section id="my-dessert-plx">
      <div class="container" id="dessert">
        <div class="my-dessert-plx-title text-center text-light">
        </div>
      </div>
    </section>

    <!-- ********************************************************* DESSERT SELECTIONS *********************************************************** -->
   <form action="cart-desserts.php" method="POST">
	   <section id="menu">
		  <div class="container">
			<div class="card-group text-center p-5">
			  <div class="row">
				  <!-- CARD 1 -->
				  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
					<div class="card m-3">
					  <img class="card-img-top mb-3" src="../img/buns.jpg" alt="Cheese">
					  <div class="card-block">
						<h4 class="card-title">STICKY BUNS</h4>
						<p class="card-text p-3">Soft and hot on the inside! Crunchy and Golden on the outside! The perfect pie partner!</p>
						<button id="buns" name="buns" class="btn btn-info mb-3" data-toggle="modal">Add to Cart</button>
					  </div>
					</div>
				  </div>
				  <!-- CARD 2 -->
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
				  <div class="card m-3">
					<img class="card-img-top mb-3" src="../img/cookies.jpg" alt="Card image Cap">
					<div class="card-block">
					  <h4 class="card-title">COOKIES</h4>
					  <p class="card-text p-3">You might wanna tie the knot on these cheesy, garlic, hot commodities! They sell fast!</p>
					  <button id="cookies" name="cookies" class="btn btn-info mb-3" data-toggle="modal">Add to Cart</button>
					</div>
				  </div>
				</div>
				<!-- CARD 3 -->
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
				  <div class="card m-3">
					<img class="card-img-top mb-3" src="../img/lavacake.jpg" alt="Card image Cap">
					<div class="card-block">
					  <h4 class="card-title">CHOCOLATE CAKE</h4>
					  <p class="card-text p-3"><i>It is better to create than to learn! Creating is the essence of life.</i> This salad is just that!</p>
					  <button id="lavacake" name="cake" class="btn btn-info mb-3" data-toggle="modal">Add to Cart</button>
					</div>
				  </div>
				</div>
				<!-- CARD 4 -->
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
				  <div class="card m-3">
					<img class="card-img-top mb-3" src="../img/brownies.jpeg" alt="Card image Cap">
					<div class="card-block">
					  <h4 class="card-title">BROWNIE</h4>
					  <p class="card-text p-3">We bet you never thought your taste buds would beg you for a salad? Well look no further!</p>
					  <button id="brownies" name="brownies" class="btn btn-info mb-3" data-toggle="modal">Add to Cart</button>
					</div>
				  </div>
				</div>

			  </div>
			</div>
		  </div>
		</section>
	</form>


    <!-- ********************************************************* FOOTER *********************************************************** -->
    <section id="footer">
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
    <script src="../js/smooth-scroll.js"></script>
    <script>var scroll = new SmoothScroll('a[href*="#"]');</script>
    <!-- My Modal -->
    <script src="../js/mymodal.js"></script>
  </body>
</html>
