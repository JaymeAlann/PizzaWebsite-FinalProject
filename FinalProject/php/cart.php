<?php
	session_start();
	require('../mysql.php');
	ini_set("display_errors","1");
	error_reporting(E_ALL);
	
	if(isset($_POST)){
		if(!empty($_POST['topping'])){
			$selection = $_POST['PizzaType'];
			$size = $_POST['PizzaType']."-size";
			$crust = $_POST['PizzaType']."-crust";
			$sauce = $_POST['PizzaType']."-sauce";
			
			$pizzaSize = $_POST[$size];
			$pizzaCrust = $_POST[$crust];
			$pizzaSauce = $_POST[$sauce];
			
			$_SESSION['cart'] = array();
			$item = array();
		
			/*
			[0] => PIZZA SELECTIONS
			[1] => SIZE 
			[2] => CRUST
			[3] => SAUCE
			
			[4] => [MAX] == TOPPINGS
			*/
			$cheddar = 0;
			$Parmesan_Asiago = 0;
			$Shredded_Provolone = 0;
			$Feta = 0;
			$Mozzerella = 0;
			$Buffalo_Sauce = 0;
			$Jalepenos = 0;
			$Onions = 0;
			$Banana_Peppers = 0;
			$Pineapple = 0;
			$Olives = 0;
			$Mushrooms = 0;
			$Green_Peppers = 0;
			$Spinach = 0;
			$Red_Peppers = 0;
			$Ham = 0;
			$Pepperoni = 0;
			$Sausage = 0;
			$Anchovies = 0;
			$Chicken = 0;
			
			foreach($_POST['topping'] as $selected){
				if($selected == 'Cheddar'){
					$cheddar = 1;
				}else if($selected == 'Parmesan_Asiago'){
					$Parmesan_Asiago = 1;
				}else if($selected == 'Shredded_Provolone'){
					$Shredded_Provolone = 1;
				}else if($selected == 'Feta'){
					$Feta = 1;
				}else if($selected == 'Mozzerella'){
					$Mozzerella = 1;
				}else if($selected == 'Buffalo_Sauce '){
					$Buffalo_Sauce = 1;
				}else if($selected == 'Jalepenos '){
					$Jalepenos = 1;
				}else if($selected == 'Onions'){
					$Onions = 1;
				}else if($selected == 'Banana_Peppers'){
					$Banana_Peppers = 1;
				}else if($selected == 'Pineapple'){
					$Pineapple = 1;
				}else if($selected == 'Olives'){
					$Olives = 1;
				}else if($selected == 'Mushrooms'){
					$Mushrooms = 1;
				}else if($selected == 'Green_Peppers'){
					$Green_Peppers = 1;
				}else if($selected == 'Spinach'){
					$Spinach = 1;
				}else if($selected == 'Red_Peppers'){
					$Red_Peppers = 1;
				}else if($selected == 'Ham'){
					$Ham = 1;
				}else if($selected == 'Pepperoni'){
					$Pepperoni = 1;
				}else if($selected == 'Sausage'){
					$Sausage = 1;
				}else if($selected == 'Anchovies'){
					$Anchovies = 1;
				}else if($selected == 'Chicken'){
					$Chicken = 1;
				}else{
					echo $selected;
				}
			}
			
			$sql = "select count(*) from TOPPINGS where Cheddar='".$cheddar."'and Parmesan_Asiago='".$Parmesan_Asiago."'and Shredded_Provolone ='".$Shredded_Provolone."'and Feta='".$Feta."'and Mozzerella ='".$Mozzerella."'and Buffalo_Sauce='".$Buffalo_Sauce."'and Jalepenos='".$Jalepenos."'and Onions='".$Onions."'and Banana_Peppers='".$Banana_Peppers."'and Pineapple='".$Pineapple."'and Olives='".$Olives."'and Mushrooms ='".$Mushrooms."'and Green_Peppers='".$Green_Peppers."'and Spinach ='".$Spinach."'and Red_Peppers='".$Red_Peppers."'and Ham='".$Ham."'and Pepperoni='".$Pepperoni."'and Sausage='".$Sausage."'and Anchovies='".$Anchovies."'and Chicken='".$Chicken."'";
			
			
			
			$conn = OpenCon();
			
			$results=MySQLi_Query($conn, $sql);
			$number = mysqli_fetch_array($results,MYSQLI_ASSOC);
			$count = $number['count(*)']; // IF 0 THEN ENTER INTO TOPPINGS
			
			// IF TOPPING COMBINATION DOESNT EXIST - ADD IT
			if($count == 0){
				// GET NEXT ID
				$sql2 = "select max(Topping_ID) from TOPPINGS";
				$results2=MySQLi_Query($conn, $sql2);
				$number = mysqli_fetch_array($results2,MYSQLI_ASSOC);
				$ToppingID = $number['max(Topping_ID)']+1;
				$_SESSION['temp_toppingID']=$ToppingID;
				// INSERT INTO TOPPINGS
				$sql3 = "insert into TOPPINGS values('".$_SESSION['temp_toppingID']."','".$cheddar."','".$Parmesan_Asiago."','".$Shredded_Provolone."','".$Feta."','".$Mozzerella."','".$Buffalo_Sauce."','".$Jalepenos."','".$Onions."','".$Banana_Peppers."','".$Pineapple."','".$Olives."','".$Mushrooms."','".$Green_Peppers."','".$Spinach."','".$Red_Peppers."','".$Ham."','".$Pepperoni."','".$Sausage."','".$Anchovies."','".$Chicken."')";
				// IF QUERY IS SUCCESFUL IN ENTERING THE DATABASE
				// SAVE PIZZA AND TOPPINGS CHOICE IN PIZZA TABLE
				if(MySQLi_Query($conn, $sql3)){
				}else{
					echo "ERROR: ".mysqli_error($conn);
					echo "<br> error with insert toppings";
				}
				
			}
			// IF COMBINATION DOES EXIST - GET THE TOPPING ID OF STORED DATA
			else{
				$getToppingIDSQL = "select Topping_ID from TOPPINGS where Cheddar='".$cheddar."'and Parmesan_Asiago='".$Parmesan_Asiago."'and Shredded_Provolone ='".$Shredded_Provolone."'and Feta='".$Feta."'and Mozzerella ='".$Mozzerella."'and Buffalo_Sauce='".$Buffalo_Sauce."'and Jalepenos='".$Jalepenos."'and Onions='".$Onions."'and Banana_Peppers='".$Banana_Peppers."'and Pineapple='".$Pineapple."'and Olives='".$Olives."'and Mushrooms ='".$Mushrooms."'and Green_Peppers='".$Green_Peppers."'and Spinach ='".$Spinach."'and Red_Peppers='".$Red_Peppers."'and Ham='".$Ham."'and Pepperoni='".$Pepperoni."'and Sausage='".$Sausage."'and Anchovies='".$Anchovies."'and Chicken='".$Chicken."'";
				
				$Toppingresults2=MySQLi_Query($conn, $getToppingIDSQL);
				$toppinnumber = mysqli_fetch_array($Toppingresults2,MYSQLI_ASSOC);
				$ToppingID = $toppinnumber['Topping_ID'];
				$_SESSION['temp_toppingID']=$ToppingID;
				//echo "<br> success, item already in toppings! from else: ID= ".$ToppingID." ".$_SESSION['temp_toppingID'];
			}
			
			// CHECK IF COMBINATION IS IN PIZZA
			$pizzaSQLCheck = "select count(*) from PIZZA where Crust='".$pizzaCrust."' and Sauce='".$pizzaSauce."' and Topping_ID='".$ToppingID."'";
			$queryPizza=MySQLi_Query($conn, $pizzaSQLCheck);
			$inPizza = mysqli_fetch_array($queryPizza,MYSQLI_ASSOC);
			$pzcount = $inPizza['count(*)']; // IF 0 THEN ENTER INTO PIZZA
			
			if($pzcount == 0){
				$getPzaMaxID = "select max(Pizza_ID) from PIZZA";
				$pzaMaxIDResults = MySQLi_Query($conn, $getPzaMaxID);
				$pzaNumber =  mysqli_fetch_array($pzaMaxIDResults,MYSQLI_ASSOC);
				$PizzaID = $pzaNumber['max(Pizza_ID)']+1;
				
				
				$pzaInsertSql ="insert into PIZZA values('".$PizzaID."','".$pizzaCrust."','".$pizzaSauce."','".$ToppingID."')";
				if(MySQLi_Query($conn, $pzaInsertSql)){
					
				}else{
					echo "ERROR: ".mysqli_error($conn);
					echo "<br> error with insert Pizza";
				}
				
			}else{
				
				$pizzaSQLGetID = "select Pizza_ID from PIZZA where Crust='".$pizzaCrust."' and Sauce='".$pizzaSauce."' and Topping_ID='".$ToppingID."'";
				$pzaresults2=MySQLi_Query($conn, $pizzaSQLGetID);
				$pzanumber = mysqli_fetch_array($pzaresults2,MYSQLI_ASSOC);
				$PizzaID = $pzanumber['Pizza_ID'];
				$_SESSION['temp_pizzaID']=$PizzaID;
				
				
			}
			
			// MATCH PIZZA WITH PRODUCT FROM PRODUCT TABLE 
			// THEN ENTER THE PIZZAID AND PRODUCT ID INTO ORDER_ITMES TABLE
			$sqlGetProductID = "select Product_ID from PRODUCT where Product_Name='".$selection."' and Size='".$pizzaSize."'";
			$ProductResults = MySQLi_Query($conn,$sqlGetProductID);
			$ProductIDFetch = mysqli_fetch_array($ProductResults,MYSQLI_ASSOC);
			$ProductID = $ProductIDFetch['Product_ID'];
			
			
			
			// FIRST CHECK ORDER_ITEM FOR REDUNDANCIES
			$checkOrderItem = "select count(*) from ORDER_ITEM where Product_ID='".$ProductID."' and Pizza_ID='".$PizzaID."'";
			$orderItemQuery=MySQLi_Query($conn, $checkOrderItem);
			$orderItemRow = mysqli_fetch_array($orderItemQuery,MYSQLI_ASSOC);
			$ItemCount = $orderItemRow['count(*)']; // IF 0 THEN ENTER INTO ORDER_ITEM;
			
			
			if($ItemCount == 0){
				// ENTER PRODUCT_ID AND PIZZA_ID INTO ORDER_ITEMS
				// FIRST GET ORDER_ITEM ID THEN ENTER
				$orderItemIDSQL = "select max(Item_ID) from ORDER_ITEM";
				$OrderItemresutls = MySQLi_Query($conn, $orderItemIDSQL);
				$ItemNumberRow =  mysqli_fetch_array($OrderItemresutls,MYSQLI_ASSOC);
				$orderItemID = $ItemNumberRow['max(Item_ID)']+1;
				
				
				$orderItemInsert = "insert into ORDER_ITEM values('".$orderItemID."','".$ProductID."','".$PizzaID."')";
				
				if(MySQLi_Query($conn, $orderItemInsert)){
					
				}else{
					echo "ERROR: ".mysqli_error($conn);
					echo "<br> error with insert Pizza";
				}
			}else{
				$getOrderID = "select Item_ID from ORDER_ITEM where Product_ID='".$ProductID."' and Pizza_ID='".$PizzaID."'";
				$getOrderIDquery=MySQLi_Query($conn, $getOrderID);
				$getOrderItemRow = mysqli_fetch_array($getOrderIDquery,MYSQLI_ASSOC);
				$orderItemID = $getOrderItemRow['Item_ID'];
				
			}
			$_SESSION['cart_item'][] = $orderItemID;
				
			if(isset($_SESSION['cart_count'])){
			$_SESSION['cart_count'] += 1;
			}else{
				$_SESSION['cart_count'] = 0;
			}
		}
		header("Location: menu-items.php");
	}
	
?>