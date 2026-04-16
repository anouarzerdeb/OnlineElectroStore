/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.16-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: db    Database: db
-- ------------------------------------------------------
-- Server version	10.11.16-MariaDB-ubu2204-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin_info`
--

DROP TABLE IF EXISTS `admin_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_info` (
  `admin_id` int(10) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(300) NOT NULL,
  `admin_password` varchar(300) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_info`
--

LOCK TABLES `admin_info` WRITE;
/*!40000 ALTER TABLE `admin_info` DISABLE KEYS */;
INSERT INTO `admin_info` VALUES
(1,'admin','admin@gmail.com','25f9e794323b453885f5181f1b624d0b');
/*!40000 ALTER TABLE `admin_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `brands` (
  `brand_id` int(100) NOT NULL AUTO_INCREMENT,
  `brand_title` text NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES
(1,'HP'),
(2,'Samsung'),
(3,'Apple'),
(4,'motorolla'),
(5,'LG'),
(6,'Cloth Brand');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(250) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `qty` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES
(6,26,'::1',4,1),
(9,10,'::1',7,1),
(10,11,'::1',7,1),
(11,45,'::1',7,1),
(44,5,'::1',3,0),
(46,2,'::1',3,0),
(48,72,'::1',3,0),
(49,60,'::1',8,1),
(50,61,'::1',8,1),
(51,1,'::1',8,1),
(52,5,'::1',9,1),
(53,2,'::1',14,1),
(54,3,'::1',14,1),
(55,5,'::1',14,1),
(56,1,'::1',9,1),
(57,2,'::1',9,1),
(71,61,'127.0.0.1',-1,1),
(147,71,'172.18.0.8',-1,1);
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `cat_id` int(100) NOT NULL AUTO_INCREMENT,
  `cat_title` text NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES
(1,'Electronics'),
(2,'Ladies Wears'),
(3,'Mens Wear'),
(4,'Kids Wear'),
(5,'Furnitures'),
(6,'Home Appliances'),
(7,'Electronics Gadgets');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_info`
--

DROP TABLE IF EXISTS `email_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_info` (
  `email_id` int(100) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  PRIMARY KEY (`email_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_info`
--

LOCK TABLES `email_info` WRITE;
/*!40000 ALTER TABLE `email_info` DISABLE KEYS */;
INSERT INTO `email_info` VALUES
(3,'admin@gmail.com'),
(4,'anouarzerdeb@gmail.com'),
(5,'anouarzerdeb@gmail.com');
/*!40000 ALTER TABLE `email_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_products`
--

DROP TABLE IF EXISTS `order_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_products` (
  `order_pro_id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(15) DEFAULT NULL,
  `amt` int(15) DEFAULT NULL,
  PRIMARY KEY (`order_pro_id`),
  KEY `order_products` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_products` FOREIGN KEY (`order_id`) REFERENCES `orders_info` (`order_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_products`
--

LOCK TABLES `order_products` WRITE;
/*!40000 ALTER TABLE `order_products` DISABLE KEYS */;
INSERT INTO `order_products` VALUES
(73,1,1,1,5000),
(74,1,4,2,64000),
(75,1,8,1,40000);
/*!40000 ALTER TABLE `order_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `trx_id` varchar(255) NOT NULL,
  `p_status` varchar(20) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES
(1,12,7,1,'07M47684BS5725041','Completed'),
(2,14,2,1,'07M47684BS5725041','Completed');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_info`
--

DROP TABLE IF EXISTS `orders_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders_info` (
  `order_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` int(10) NOT NULL,
  `cardname` varchar(255) NOT NULL,
  `cardnumber` varchar(20) NOT NULL,
  `expdate` varchar(255) NOT NULL,
  `prod_count` int(15) DEFAULT NULL,
  `total_amt` int(15) DEFAULT NULL,
  `cvv` int(5) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_info`
--

LOCK TABLES `orders_info` WRITE;
/*!40000 ALTER TABLE `orders_info` DISABLE KEYS */;
INSERT INTO `orders_info` VALUES
(1,12,'Anouar','anouarzerdeb@gmail.com','Berlin, Germany','Berlin','Berlin',10115,'pokjhgfcxc','4321 2345 6788 7654','12/90',3,77000,1234);
/*!40000 ALTER TABLE `orders_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `product_id` int(100) NOT NULL AUTO_INCREMENT,
  `product_cat` int(100) NOT NULL,
  `product_brand` int(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` text NOT NULL,
  `product_keywords` text NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES
(1,1,2,'Samsung galaxy s7 edge',5000,'Samsung galaxy s7 edge','product07.png','samsung mobile electronics'),
(2,1,3,'iPhone 5s',25000,'iphone 5s','http___pluspng.com_img-png_iphone-hd-png-iphone-apple-png-file-550.png','mobile iphone apple'),
(3,1,3,'iPad air 2',30000,'ipad apple brand','da4371ffa192a115f922b1c0dff88193.png','apple ipad tablet'),
(4,1,3,'iPhone 6s',32000,'Apple iPhone ','http___pluspng.com_img-png_iphone-6s-png-iphone-6s-gold-64gb-1000.png','iphone apple mobile'),
(5,1,2,'iPad 2',10000,'samsung ipad','iPad-air.png','ipad tablet samsung'),
(6,1,1,'samsung Laptop r series',35000,'samsung Black combination Laptop','laptop_PNG5939.png','samsung laptop '),
(7,1,1,'Laptop Pavillion',50000,'Laptop Hp Pavillion','laptop_PNG5930.png','Laptop Hp Pavillion'),
(8,1,4,'Sony',40000,'Sony Mobile','530201353846AM_635_sony_xperia_z.png','sony mobile'),
(9,1,3,'iPhone New',12000,'iphone','iphone-hd-png-iphone-apple-png-file-550.png','iphone apple mobile'),
(10,2,6,'Red Ladies dress',1000,'red dress for girls','red dress.jpg','red dress '),
(11,2,6,'Blue Heave dress',1200,'Blue dress','images.jpg','blue dress cloths'),
(12,2,6,'Ladies Casual Cloths',1500,'ladies casual summer two colors pleted','7475-ladies-casual-dresses-summer-two-colors-pleated.jpg','girl dress cloths casual'),
(13,2,6,'SpringAutumnDress',1200,'girls dress','Spring-Autumn-Winter-Young-Ladies-Casual-Wool-Dress-Women-s-One-Piece-Dresse-Dating-Clothes-Medium.jpg_640x640.jpg','girl dress'),
(14,2,6,'Casual Dress',1400,'girl dress','download.jpg','ladies cloths girl'),
(15,2,6,'Formal Look',1500,'girl dress','shutterstock_203611819.jpg','ladies wears dress girl'),
(16,3,6,'Sweter for men',600,'2012-Winter-Sweater-for-Men-for-better-outlook','2012-Winter-Sweater-for-Men-for-better-outlook.jpg','black sweter cloth winter'),
(17,3,6,'Gents formal',1000,'gents formal look','gents-formal-250x250.jpg','gents wear cloths'),
(19,3,6,'Formal Coat',3000,'ad','images (1).jpg','coat blazer gents'),
(20,3,6,'Mens Sweeter',1600,'jg','Winter-fashion-men-burst-sweater.png','sweeter gents '),
(21,3,6,'T shirt',800,'ssds','IN-Mens-Apparel-Voodoo-Tiles-09._V333872612_.jpg','formal t shirt black'),
(22,4,6,'Yellow T shirt ',1300,'yello t shirt with pant','1.0x0.jpg','kids yellow t shirt'),
(23,4,6,'Girls cloths',1900,'sadsf','GirlsClothing_Widgets.jpg','formal kids wear dress'),
(24,4,6,'Blue T shirt',700,'g','images.jpg','kids dress'),
(25,4,6,'Yellow girls dress',750,'as','images (3).jpg','yellow kids dress'),
(27,4,6,'Formal look',690,'sd','image28.jpg','formal kids dress'),
(32,5,0,'Book Shelf',2500,'book shelf','furniture-book-shelf-250x250.jpg','book shelf furniture'),
(33,6,2,'Refrigerator',35000,'Refrigerator','CT_WM_BTS-BTC-AppliancesHome_20150723.jpg','refrigerator samsung'),
(34,6,4,'Emergency Light',1000,'Emergency Light','emergency light.jpg','emergency light'),
(35,6,0,'Vaccum Cleaner',6000,'Vaccum Cleaner','images (2).jpg','Vaccum Cleaner'),
(36,6,5,'Iron',1500,'gj','iron.jpg','iron'),
(37,6,5,'LED TV',20000,'LED TV','images (4).jpg','led tv lg'),
(38,6,4,'Microwave Oven',3500,'Microwave Oven','images.jpg','Microwave Oven'),
(39,6,5,'Mixer Grinder',2500,'Mixer Grinder','singer-mixer-grinder-mg-46-medium_4bfa018096c25dec7ba0af40662856ef.jpg','Mixer Grinder'),
(40,2,6,'Formal girls dress',3000,'Formal girls dress','girl-walking.jpg','ladies'),
(45,1,2,'Samsung Galaxy Note 3',10000,'0','samsung_galaxy_note3_note3neo.jpg','samsung galaxy Note 3 neo'),
(46,1,2,'Samsung Galaxy Note 3',10000,'','samsung_galaxy_note3_note3neo.jpg','samsung galxaxy note 3 neo'),
(47,4,6,'Laptop',650,'nbk','product01.png','Dell Laptop'),
(48,1,7,'Headphones',250,'Headphones','product05.png','Headphones Sony'),
(49,1,7,'Headphones',250,'Headphones','product05.png','Headphones Sony'),
(50,3,6,'boys shirts',350,'shirts','pm1.jpg','suit boys shirts'),
(51,3,6,'boys shirts',270,'shirts','pm2.jpg','suit boys shirts'),
(52,3,6,'boys shirts',453,'shirts','pm3.jpg','suit boys shirts'),
(53,3,6,'boys shirts',220,'shirts','ms1.jpg','suit boys shirts'),
(54,3,6,'boys shirts',290,'shirts','ms2.jpg','suit boys shirts'),
(55,3,6,'boys shirts',259,'shirts','ms3.jpg','suit boys shirts'),
(56,3,6,'boys shirts',299,'shirts','pm7.jpg','suit boys shirts'),
(57,3,6,'boys shirts',260,'shirts','i3.jpg','suit boys shirts'),
(58,3,6,'boys shirts',350,'shirts','pm9.jpg','suit boys shirts'),
(59,3,6,'boys shirts',855,'shirts','a2.jpg','suit boys shirts'),
(60,3,6,'boys shirts',150,'shirts','pm11.jpg','suit boys shirts'),
(61,3,6,'boys shirts',215,'shirts','pm12.jpg','suit boys shirts'),
(62,3,6,'boys shirts',299,'shirts','pm13.jpg','suit boys shirts'),
(63,3,6,'boys Jeans Pant',550,'Pants','pt1.jpg','boys Jeans Pant'),
(64,3,6,'boys Jeans Pant',460,'pants','pt2.jpg','boys Jeans Pant'),
(65,3,6,'boys Jeans Pant',470,'pants','pt3.jpg','boys Jeans Pant'),
(66,3,6,'boys Jeans Pant',480,'pants','pt4.jpg','boys Jeans Pant'),
(67,3,6,'boys Jeans Pant',360,'pants','pt5.jpg','boys Jeans Pant'),
(68,3,6,'boys Jeans Pant',550,'pants','pt6.jpg','boys Jeans Pant'),
(69,3,6,'boys Jeans Pant',390,'pants','pt7.jpg','boys Jeans Pant'),
(70,3,6,'boys Jeans Pant',399,'pants','pt8.jpg','boys Jeans Pant'),
(71,1,2,'Samsung galaxy s7',5000,'Samsung galaxy s7','product07.png','samsung mobile electronics'),
(72,7,2,'sony Headphones',3500,'sony Headphones','product02.png','sony Headphones electronics gadgets'),
(73,7,2,'samsung Headphones',3500,'samsung Headphones','product05.png','samsung Headphones electronics gadgets'),
(74,1,1,'HP i5 laptop',5500,'HP i5 laptop','product01.png','HP i5 laptop electronics'),
(75,1,1,'HP i7 laptop 8gb ram',5500,'HP i7 laptop 8gb ram','product03.png','HP i7 laptop 8gb ram electronics'),
(76,1,5,'sony note 6gb ram',4500,'sony note 6gb ram','product04.png','sony note 6gb ram mobile electronics'),
(77,1,4,'MSV laptop 16gb ram NVIDEA Graphics',5499,'MSV laptop 16gb ram','product06.png','MSV laptop 16gb ram NVIDEA Graphics electronics'),
(78,1,5,'dell laptop 8gb ram intel integerated Graphics',4579,'dell laptop 8gb ram intel integerated Graphics','product08.png','dell laptop 8gb ram intel integerated Graphics electronics'),
(79,7,2,'camera with 3D pixels',2569,'camera with 3D pixels','product09.png','camera with 3D pixels camera electronics gadgets');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_info` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address1` varchar(300) NOT NULL,
  `address2` varchar(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_info`
--

LOCK TABLES `user_info` WRITE;
/*!40000 ALTER TABLE `user_info` DISABLE KEYS */;
INSERT INTO `user_info` VALUES
(12,'Anouar','Zerdeb','anouarzerdeb@gmail.com','testpass','0123456789','Berlin','Germany'),
(15,'hemu','ajhgdg','anouarzerdeb@gmail.com','346778','536487276',',mdnbca','asdmhmhvbv'),
(16,'venky','vs','venkey@gmail.com','1234534','9877654334','snhdgvajfehyfygv','asdjbhfkeur'),
(19,'abhishek','bs','abhishekbs@gmail.com','asdcsdcc','9871236534','bangalore','hassan'),
(21,'prajval','mcta','prajvalmcta@gmail.com','1234545662','202-555-01','bangalore','kumbalagodu'),
(22,'testuser','v','hemu@gmail.com','1234534','9877654334','test address','test city'),
(23,'hemanth','reddy','hemanth@gmail.com','Test@123','9876543234','Berlin','Germany'),
(24,'newuser','user','newuser@gmail.com','test@123','9535688928','Berlin','Germany'),
(25,'otheruser','user','otheruser@gmail.com','test@123','9535688928','Berlin','Germany');
/*!40000 ALTER TABLE `user_info` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `after_user_info_insert` AFTER INSERT ON `user_info` FOR EACH ROW BEGIN 
INSERT INTO user_info_backup VALUES(new.user_id,new.first_name,new.last_name,new.email,new.password,new.mobile,new.address1,new.address2);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `user_info_backup`
--

DROP TABLE IF EXISTS `user_info_backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_info_backup` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address1` varchar(300) NOT NULL,
  `address2` varchar(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_info_backup`
--

LOCK TABLES `user_info_backup` WRITE;
/*!40000 ALTER TABLE `user_info_backup` DISABLE KEYS */;
INSERT INTO `user_info_backup` VALUES
(12,'Anouar','Zerdeb','anouarzerdeb@gmail.com','123456789','0123456789','Berlin','Germany'),
(14,'hemanthu','reddy','hemanthreddy951@gmail.com','123456788','6526436723','s,dc wfjvnvn','b efhfhvvbr'),
(15,'hemu','ajhgdg','keeru@gmail.com','346778','536487276',',mdnbca','asdmhmhvbv'),
(16,'venky','vs','venkey@gmail.com','1234534','9877654334','snhdgvajfehyfygv','asdjbhfkeur'),
(19,'abhishek','bs','abhishekbs@gmail.com','asdcsdcc','9871236534','bangalore','hassan'),
(20,'pramod','vh','pramod@gmail.com','124335353','9767645653','ksbdfcdf','sjrgrevgsib'),
(21,'prajval','mcta','prajvalmcta@gmail.com','1234545662','202-555-01','bangalore','kumbalagodu'),
(22,'testuser','v','hemu@gmail.com','1234534','9877654334','test address','test city'),
(23,'hemanth','reddy','hemanth@gmail.com','Test@123','9876543234','Berlin','Germany'),
(24,'newuser','user','newuser@gmail.com','test@123','9535688928','Berlin','Germany'),
(25,'otheruser','user','otheruser@gmail.com','test@123','9535688928','Berlin','Germany');
/*!40000 ALTER TABLE `user_info_backup` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-16 15:45:58
