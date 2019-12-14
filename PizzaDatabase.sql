-- MySQL dump 10.14  Distrib 5.5.64-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: jgrady6
--
-- DATABASE (c) 2019 James Grady
-- github.com/JaymeAlann
-- ------------------------------------------------------
-- Server version	5.5.64-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ADDRESS`
--

DROP TABLE IF EXISTS `ADDRESS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ADDRESS` (
  `Address_ID` int(11) NOT NULL,
  `Address_Nickname` varchar(50) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Street` varchar(50) NOT NULL,
  `Suite` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL,
  `Zip` int(11) NOT NULL,
  PRIMARY KEY (`Address_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `CUSTOMER`
--

DROP TABLE IF EXISTS `CUSTOMER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CUSTOMER` (
  `Customer_ID` int(11) NOT NULL,
  `Customer_Phone` bigint(20) NOT NULL,
  `First_Name` varchar(50) NOT NULL,
  `Last_Name` varchar(50) NOT NULL,
  `Customer_Email` varchar(50) NOT NULL,
  PRIMARY KEY (`Customer_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `CUSTOMER_ADDRESS`
--

DROP TABLE IF EXISTS `CUSTOMER_ADDRESS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CUSTOMER_ADDRESS` (
  `Customer_Address_ID` int(11) NOT NULL,
  `Customer_ID` int(11) NOT NULL,
  `Address_ID` int(11) NOT NULL,
  PRIMARY KEY (`Customer_Address_ID`),
  KEY `FK_CUSTOMERADDRESS_CUSTOMER` (`Customer_ID`),
  KEY `FK_CUSTOMERADDRESS_ADDRESS` (`Address_ID`),
  CONSTRAINT `FK_CUSTOMERADDRESS_ADDRESS` FOREIGN KEY (`Address_ID`) REFERENCES `ADDRESS` (`Address_ID`),
  CONSTRAINT `FK_CUSTOMERADDRESS_CUSTOMER` FOREIGN KEY (`Customer_ID`) REFERENCES `CUSTOMER` (`Customer_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `CUSTOMER_LOGIN`
--

DROP TABLE IF EXISTS `CUSTOMER_LOGIN`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CUSTOMER_LOGIN` (
  `Customer_ID` int(11) NOT NULL,
  `Customer_Password` varchar(50) NOT NULL,
  PRIMARY KEY (`Customer_ID`),
  CONSTRAINT `FK_CUSTOMERLOGIN_CUSTOMER` FOREIGN KEY (`Customer_ID`) REFERENCES `CUSTOMER` (`Customer_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `CUSTOMER_PAYMENT`
--

DROP TABLE IF EXISTS `CUSTOMER_PAYMENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CUSTOMER_PAYMENT` (
  `Customer_Payment_ID` int(11) NOT NULL,
  `Customer_ID` int(11) NOT NULL,
  `Payment_ID` int(11) NOT NULL,
  PRIMARY KEY (`Customer_Payment_ID`),
  KEY `FK_CUSTOMERPAYMENT_CUSTOMER` (`Customer_ID`),
  KEY `FL_CUSTOMERPAYMENT_PAYMENT` (`Payment_ID`),
  CONSTRAINT `FL_CUSTOMERPAYMENT_PAYMENT` FOREIGN KEY (`Payment_ID`) REFERENCES `PAYMENTS` (`Payment_ID`),
  CONSTRAINT `FK_CUSTOMERPAYMENT_CUSTOMER` FOREIGN KEY (`Customer_ID`) REFERENCES `CUSTOMER` (`Customer_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `ORDER`
--

DROP TABLE IF EXISTS `ORDER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ORDER` (
  `Order_ID` int(11) NOT NULL,
  `Order_Type` varchar(50) DEFAULT NULL,
  `Customer_Address_ID` int(11) NOT NULL,
  `Order_Timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `Order_Status` varchar(50) NOT NULL,
  `Order_Total` decimal(8,2) NOT NULL,
  `Payment_Type` varchar(50) NOT NULL,
  PRIMARY KEY (`Order_ID`),
  KEY `FK_ORDER_CUSTOMERADDRESS` (`Customer_Address_ID`),
  CONSTRAINT `FK_ORDER_CUSTOMERADDRESS` FOREIGN KEY (`Customer_Address_ID`) REFERENCES `CUSTOMER_ADDRESS` (`Customer_Address_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `ORDER_DETAILS`
--

DROP TABLE IF EXISTS `ORDER_DETAILS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ORDER_DETAILS` (
  `Order_ID` int(11) NOT NULL,
  `Item_ID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Item_Price` decimal(8,2) NOT NULL,
  `Total_Price` decimal(8,2) NOT NULL,
  KEY `FK_ORDERDETAILS_ORDER` (`Order_ID`),
  KEY `Item_ID` (`Item_ID`),
  CONSTRAINT `FK_ORDERDETAILS_ORDER` FOREIGN KEY (`Order_ID`) REFERENCES `ORDER` (`Order_ID`),
  CONSTRAINT `ORDER_DETAILS_ibfk_1` FOREIGN KEY (`Item_ID`) REFERENCES `ORDER_ITEM` (`Item_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `ORDER_ITEM`
--

DROP TABLE IF EXISTS `ORDER_ITEM`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ORDER_ITEM` (
  `Item_ID` int(11) NOT NULL,
  `Product_ID` int(11) NOT NULL,
  `Pizza_ID` int(11) NOT NULL,
  PRIMARY KEY (`Item_ID`),
  KEY `FK_ITEM_PRODUCT` (`Product_ID`),
  KEY `FK_ITEM_PIZZA` (`Pizza_ID`),
  CONSTRAINT `FK_ITEM_PIZZA` FOREIGN KEY (`Pizza_ID`) REFERENCES `PIZZA` (`Pizza_ID`),
  CONSTRAINT `FK_ITEM_PRODUCT` FOREIGN KEY (`Product_ID`) REFERENCES `PRODUCT` (`Product_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `PAYMENTS`
--

DROP TABLE IF EXISTS `PAYMENTS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PAYMENTS` (
  `Payment_ID` int(11) NOT NULL,
  `Payment_Nickname` varchar(50) NOT NULL,
  `Name_On_Card` varchar(50) NOT NULL,
  `Card_Number` bigint(20) NOT NULL,
  `Security_Code` int(11) NOT NULL,
  `Expiration_Date` date NOT NULL,
  `Billing_Code` int(11) NOT NULL,
  PRIMARY KEY (`Payment_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `PIZZA`
--

DROP TABLE IF EXISTS `PIZZA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PIZZA` (
  `Pizza_ID` int(11) NOT NULL,
  `Crust` varchar(20) NOT NULL,
  `Sauce` varchar(20) NOT NULL,
  `Topping_ID` int(11) NOT NULL,
  PRIMARY KEY (`Pizza_ID`),
  KEY `FK_PIZZA_TOPPINGS` (`Topping_ID`),
  CONSTRAINT `FK_PIZZA_TOPPINGS` FOREIGN KEY (`Topping_ID`) REFERENCES `TOPPINGS` (`Topping_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `PRODUCT`
--

DROP TABLE IF EXISTS `PRODUCT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PRODUCT` (
  `Product_ID` int(11) NOT NULL,
  `Product_Name` varchar(50) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Price` decimal(8,2) NOT NULL,
  `Size` varchar(50) NOT NULL,
  `IMG` text NOT NULL,
  PRIMARY KEY (`Product_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `TOPPINGS`
--

DROP TABLE IF EXISTS `TOPPINGS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TOPPINGS` (
  `Topping_ID` int(11) NOT NULL,
  `Cheddar` tinyint(1) NOT NULL DEFAULT '0',
  `Parmesan_Asiago` tinyint(1) NOT NULL DEFAULT '0',
  `Shredded_Provolone` tinyint(1) NOT NULL DEFAULT '0',
  `Feta` tinyint(1) NOT NULL DEFAULT '0',
  `Mozzerella` tinyint(1) NOT NULL DEFAULT '0',
  `Buffalo_Sauce` tinyint(1) NOT NULL DEFAULT '0',
  `Jalepenos` tinyint(1) NOT NULL DEFAULT '0',
  `Onions` tinyint(1) NOT NULL DEFAULT '0',
  `Banana_Peppers` tinyint(1) NOT NULL DEFAULT '0',
  `Pineapple` tinyint(1) NOT NULL DEFAULT '0',
  `Olives` tinyint(1) NOT NULL DEFAULT '0',
  `Mushrooms` tinyint(1) NOT NULL DEFAULT '0',
  `Green_Peppers` tinyint(1) NOT NULL DEFAULT '0',
  `Spinach` tinyint(1) NOT NULL DEFAULT '0',
  `Red_Peppers` tinyint(1) NOT NULL DEFAULT '0',
  `Ham` tinyint(1) NOT NULL DEFAULT '0',
  `Pepperoni` tinyint(1) NOT NULL DEFAULT '0',
  `Sausage` tinyint(1) NOT NULL DEFAULT '0',
  `Anchovies` tinyint(1) NOT NULL DEFAULT '0',
  `Chicken` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Topping_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-11 19:30:38
