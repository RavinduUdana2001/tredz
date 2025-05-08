-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: eshopme
-- ------------------------------------------------------
-- Server version	8.0.35

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `fname` varchar(50) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `vcode` varchar(20) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES ('kavindu','singhapura','kavindusinghapura64@gmail.com','66652c2728b0c');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brand` (
  `brand_id` int NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brand`
--

LOCK TABLES `brand` WRITE;
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;
INSERT INTO `brand` VALUES (6,'nb'),(7,'mas');
/*!40000 ALTER TABLE `brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `qty` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `fk_cart_user1_idx` (`user_email`),
  KEY `fk_cart_product1_idx` (`product_id`),
  CONSTRAINT `fk_cart_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_cart_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (41,1,'kavindusinghapura64@gmail.com',11);
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Mens fashions'),(2,'Ladies fashions'),(3,'Kids fashions'),(4,'Others');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_has_brand`
--

DROP TABLE IF EXISTS `category_has_brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category_has_brand` (
  `category_cat_id` int NOT NULL,
  `brand_brand_id` int NOT NULL,
  KEY `fk_category_has_brand_brand1_idx` (`brand_brand_id`),
  KEY `fk_category_has_brand_category1_idx` (`category_cat_id`),
  CONSTRAINT `fk_category_has_brand_brand1` FOREIGN KEY (`brand_brand_id`) REFERENCES `brand` (`brand_id`),
  CONSTRAINT `fk_category_has_brand_category1` FOREIGN KEY (`category_cat_id`) REFERENCES `category` (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_has_brand`
--

LOCK TABLES `category_has_brand` WRITE;
/*!40000 ALTER TABLE `category_has_brand` DISABLE KEYS */;
/*!40000 ALTER TABLE `category_has_brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chat` (
  `chat_id` int NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `date_time` datetime NOT NULL,
  `status` int NOT NULL,
  `from` varchar(100) NOT NULL,
  `to` varchar(100) NOT NULL,
  PRIMARY KEY (`chat_id`),
  KEY `fk_chat_user1_idx` (`from`),
  KEY `fk_chat_user2_idx` (`to`),
  CONSTRAINT `fk_chat_user1` FOREIGN KEY (`from`) REFERENCES `user` (`email`),
  CONSTRAINT `fk_chat_user2` FOREIGN KEY (`to`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
INSERT INTO `chat` VALUES (75,'hi','2024-06-06 10:38:22',1,'12345@gmail.com','kavindu@gmail.com');
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `city` (
  `city_id` int NOT NULL AUTO_INCREMENT,
  `city_name` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `district_district_id` int NOT NULL,
  PRIMARY KEY (`city_id`),
  KEY `fk_city_district1_idx` (`district_district_id`),
  CONSTRAINT `fk_city_district1` FOREIGN KEY (`district_district_id`) REFERENCES `district` (`district_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` VALUES (5,'Newtown',8),(6,'Kekirawa',9),(7,'Bogambara',10);
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `color`
--

DROP TABLE IF EXISTS `color`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `color` (
  `color_id` int NOT NULL AUTO_INCREMENT,
  `color_name` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`color_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `color`
--

LOCK TABLES `color` WRITE;
/*!40000 ALTER TABLE `color` DISABLE KEYS */;
INSERT INTO `color` VALUES (6,'blue'),(7,'black'),(8,'Red');
/*!40000 ALTER TABLE `color` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `district`
--

DROP TABLE IF EXISTS `district`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `district` (
  `district_id` int NOT NULL AUTO_INCREMENT,
  `district_name` varchar(45) DEFAULT NULL,
  `province_province_id` int NOT NULL,
  PRIMARY KEY (`district_id`),
  KEY `fk_district_province1_idx` (`province_province_id`),
  CONSTRAINT `fk_district_province1` FOREIGN KEY (`province_province_id`) REFERENCES `province` (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `district`
--

LOCK TABLES `district` WRITE;
/*!40000 ALTER TABLE `district` DISABLE KEYS */;
INSERT INTO `district` VALUES (8,'polonnaruwa',2),(9,'Anuradhapura',2),(10,'Kandy',3),(11,'Nuwara eliya',3),(12,'Mathale',3);
/*!40000 ALTER TABLE `district` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feedback` (
  `feed_id` int NOT NULL AUTO_INCREMENT,
  `type` int DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `feed` varchar(250) DEFAULT NULL,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`feed_id`),
  KEY `fk_feedback_product1_idx` (`product_id`),
  KEY `fk_feedback_user1_idx` (`user_email`),
  CONSTRAINT `fk_feedback_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_feedback_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` VALUES (6,3,'2024-02-25 22:42:43','it is good product ',17,'kavindusinghapura64@gmail.com'),(7,1,'2024-02-25 22:56:45','good one',11,'kavindusinghapura64@gmail.com'),(8,3,'2024-02-26 00:16:11','thats greate',11,'kavindusinghapura64@gmail.com'),(9,2,'2024-02-26 00:17:20','brillient',11,'kavindusinghapura64@gmail.com'),(10,3,'2024-03-11 19:37:28','that is a good quality product',13,'kavindu@gmail.com'),(11,3,'2024-03-14 15:32:18','movindu harak',11,'kavindu@gmail.com'),(12,3,'2024-05-22 11:25:10','very good product faster delivery',8,'movindu@gmail.com'),(13,2,'2024-06-06 10:36:47','I am happy for this item so much',8,'12345@gmail.com'),(14,3,'2024-06-08 10:51:02','thats well product i am very happy',11,'kavindusinghapura64@gmail.com'),(15,3,'2024-06-09 09:40:11','good one',11,'kavindusinghapura64@gmail.com');
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gender`
--

DROP TABLE IF EXISTS `gender`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gender` (
  `gender_id` int NOT NULL AUTO_INCREMENT,
  `gender_name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`gender_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gender`
--

LOCK TABLES `gender` WRITE;
/*!40000 ALTER TABLE `gender` DISABLE KEYS */;
INSERT INTO `gender` VALUES (3,'Male'),(4,'Female');
/*!40000 ALTER TABLE `gender` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoice` (
  `invoice_id` int NOT NULL AUTO_INCREMENT,
  `order_id` varchar(20) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `total` double DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`invoice_id`),
  KEY `fk_invoice_product1_idx` (`product_id`),
  KEY `fk_invoice_user1_idx` (`user_email`),
  CONSTRAINT `fk_invoice_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_invoice_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
INSERT INTO `invoice` VALUES (9,'65db782545c51','2024-02-25 22:56:32',4600,1,2,11,'kavindusinghapura64@gmail.com'),(12,'65f2cab3cde20','2024-03-14 15:31:41',4600,1,2,11,'kavindu@gmail.com'),(13,'66125eb760e0e','2024-04-07 14:22:25',4300,1,2,16,'kavindusinghapura64@gmail.com'),(14,'664d87f59fce1','2024-05-22 11:22:24',4500,1,2,8,'movindu@gmail.com'),(16,'66615ffc3bda6','2024-06-06 12:38:15',4500,1,2,8,'12345@gmail.com'),(17,'66632dd6afcd2','2024-06-07 21:28:00',4600,1,2,11,'kavindusinghapura64@gmail.com'),(18,'6663e99510caf','2024-06-08 10:48:47',8600,2,2,11,'kavindusinghapura64@gmail.com'),(19,'6664207cc7e56','2024-06-08 14:43:07',4600,1,0,11,'kavindusinghapura64@gmail.com');
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model`
--

DROP TABLE IF EXISTS `model`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model` (
  `model_id` int NOT NULL AUTO_INCREMENT,
  `model_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model`
--

LOCK TABLES `model` WRITE;
/*!40000 ALTER TABLE `model` DISABLE KEYS */;
INSERT INTO `model` VALUES (6,'Trousers'),(7,'Shirts'),(8,'T-shirts'),(9,'shorts'),(10,'belts'),(11,'shoes');
/*!40000 ALTER TABLE `model` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_brand`
--

DROP TABLE IF EXISTS `model_has_brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_brand` (
  `model_model_id` int NOT NULL,
  `brand_brand_id` int NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `fk_model_has_brand_brand1_idx` (`brand_brand_id`),
  KEY `fk_model_has_brand_model1_idx` (`model_model_id`),
  CONSTRAINT `fk_model_has_brand_brand1` FOREIGN KEY (`brand_brand_id`) REFERENCES `brand` (`brand_id`),
  CONSTRAINT `fk_model_has_brand_model1` FOREIGN KEY (`model_model_id`) REFERENCES `model` (`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_brand`
--

LOCK TABLES `model_has_brand` WRITE;
/*!40000 ALTER TABLE `model_has_brand` DISABLE KEYS */;
INSERT INTO `model_has_brand` VALUES (6,6,7),(6,7,8),(8,6,9),(7,6,10),(9,6,11),(8,7,12),(9,7,13),(10,7,14),(11,7,15),(11,6,16);
/*!40000 ALTER TABLE `model_has_brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `price` double NOT NULL,
  `qty` int NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `datetime_added` datetime NOT NULL,
  `delivery_fee_colombo` double NOT NULL,
  `delivery_fee_other` double NOT NULL,
  `category_cat_id` int NOT NULL,
  `model_has_brand_id` int NOT NULL,
  `status_status_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_category1_idx` (`category_cat_id`),
  KEY `fk_product_model_has_brand1_idx` (`model_has_brand_id`),
  KEY `fk_product_status1_idx` (`status_status_id`),
  KEY `fk_product_user1_idx` (`user_email`),
  CONSTRAINT `fk_product_category1` FOREIGN KEY (`category_cat_id`) REFERENCES `category` (`cat_id`),
  CONSTRAINT `fk_product_model_has_brand1` FOREIGN KEY (`model_has_brand_id`) REFERENCES `model_has_brand` (`id`),
  CONSTRAINT `fk_product_status1` FOREIGN KEY (`status_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `fk_product_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (8,4000,114,'Trousers','Mens trousers small','2024-02-10 00:17:03',300,500,1,7,1,'kavindu@gmail.com'),(9,2000,12,'trousers','Girls trousers Blue','2024-02-10 00:27:37',100,300,2,8,1,'kavindusinghapura64@gmail.com'),(11,4000,1226,'wewd','T-shirts','2024-02-14 12:08:37',400,600,1,10,1,'kavindu@gmail.com'),(12,3000,13,'shorts','Shorts for mens','2024-02-18 13:48:17',300,500,1,11,1,'kavindu@gmail.com'),(13,4000,12,'shirts','Mens shirts','2024-02-18 13:49:41',300,500,1,10,1,'kavindu@gmail.com'),(14,3000,23,'trousers','Girls trousers','2024-02-18 13:51:13',400,500,2,8,1,'kavindu@gmail.com'),(15,2000,134,'blouses','Girls blouses','2024-02-18 13:52:54',400,600,2,10,1,'kavindu@gmail.com'),(16,4000,33,'tshirts','Girls T-shirts','2024-02-18 13:53:55',200,300,2,12,1,'kavindu@gmail.com'),(17,4000,33,'frocks','Girls frocks','2024-02-18 13:55:50',100,300,2,13,1,'kavindu@gmail.com'),(18,2000,23,'shirts','Kids T-shirts','2024-02-18 13:57:36',300,500,3,10,1,'kavindu@gmail.com'),(19,4000,34,'triusers','Kids Trousers','2024-02-18 13:58:45',300,600,3,7,1,'kavindu@gmail.com'),(20,3000,4,'shorts','Kids shorts','2024-02-18 14:04:36',300,400,3,11,1,'kavindu@gmail.com'),(21,4000,34,'shirts','Kids shirts','2024-02-18 14:06:26',300,500,3,10,1,'kavindu@gmail.com'),(22,2000,123,'belts','Leather belts for mens','2024-02-18 14:09:46',200,500,4,14,1,'kavindu@gmail.com'),(23,4000,34,'shoes','Shoes for girls','2024-02-18 14:10:38',300,300,4,15,1,'kavindu@gmail.com'),(24,5000,45,'shoes','Sport shoes','2024-02-18 14:11:50',300,400,4,16,1,'kavindu@gmail.com'),(25,5000,45,'shoes','Shoes for mens','2024-02-18 14:12:47',300,400,4,15,1,'kavindu@gmail.com'),(26,3000,9,'Trousers for mens','Mens Trousers','2024-06-08 10:54:50',200,500,1,7,2,'kavindusinghapura64@gmail.com'),(27,-3000,6,'Trousers','Mens Trouser','2024-06-09 09:50:30',300,400,1,7,1,'kavindusinghapura64@gmail.com');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_has_color`
--

DROP TABLE IF EXISTS `product_has_color`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_has_color` (
  `product_id` int NOT NULL,
  `color_clr_id` int NOT NULL,
  KEY `fk_product_has_color_product1_idx` (`product_id`),
  KEY `fk_product_has_color_color1_idx` (`color_clr_id`),
  CONSTRAINT `fk_product_has_color_color1` FOREIGN KEY (`color_clr_id`) REFERENCES `color` (`color_id`),
  CONSTRAINT `fk_product_has_color_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_has_color`
--

LOCK TABLES `product_has_color` WRITE;
/*!40000 ALTER TABLE `product_has_color` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_has_color` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_image`
--

DROP TABLE IF EXISTS `product_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_image` (
  `img_path` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`img_path`),
  KEY `fk_product_img_product1_idx` (`product_id`),
  CONSTRAINT `fk_product_img_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_image`
--

LOCK TABLES `product_image` WRITE;
/*!40000 ALTER TABLE `product_image` DISABLE KEYS */;
INSERT INTO `product_image` VALUES ('resource//product_images//Mens trousers_0_65c6732707aff.jpeg',8),('resource//product_images//Mens trousers_1_65c673270c84a.jpeg',8),('resource//product_images//Mens trousers_2_65c673270d4ba.png',8),('resource//product_images//Girls trousers_0_65d5535d7e866.jpeg',9),('resource//product_images//Girls trousers_1_65d5535d7f569.jpeg',9),('resource//product_images//shirts_0_65cc5fedeb24c.jpeg',11),('resource//product_images//shirts_1_65cc5fedec8c6.jpeg',11),('resource//product_images//Shorts for mens_0_65d1bd494e271.jpeg',12),('resource//product_images//Mens shirts_0_65d1bd9d1e1fd.png',13),('resource//product_images//Girls trousers_0_65d1bdf950e5b.png',14),('resource//product_images//Girls blouses_0_65d1be5e04063.jpeg',15),('resource//product_images//Girls T-shirts_0_65d1be9b4c432.png',16),('resource//product_images//Girls frocks_0_65d1bf0e650df.png',17),('resource//product_images//Kids T-shirts_0_65d1bf781e82c.jpeg',18),('resource//product_images//Kids Trousers_0_65d1bfbd9cc8f.jpeg',19),('resource//product_images//Kids shorts_0_65d1c11cb0706.jpeg',20),('resource//product_images//Kids shirts_0_65d1c18a87b26.png',21),('resource//product_images//Leather belts for mens_0_65d1c2520c424.jpeg',22),('resource//product_images//Shoes for girls_0_65d1c286c38eb.jpeg',23),('resource//product_images//Sport shoes_0_65d1c2ce88a2d.png',24),('resource//product_images//Shoes for mens_0_65d1c3076eba2.png',25),('resource//product_images//Mens Trousers_0_6663eb22105bf.png',26),('resource//product_images//Mens Trousers_1_6663eb2211d69.png',26),('resource//product_images//Mens Trousers_2_6663eb22126d6.jpeg',26),('resource//product_images//Mens Trousers_0_66652d8e02198.png',27),('resource//product_images//Mens Trousers_1_66652d8e03a5a.png',27),('resource//product_images//Mens Trousers_2_66652d8e052fc.jpeg',27);
/*!40000 ALTER TABLE `product_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile_img`
--

DROP TABLE IF EXISTS `profile_img`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profile_img` (
  `path` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_profile_img_user1_idx` (`user_email`),
  CONSTRAINT `fk_profile_img_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_img`
--

LOCK TABLES `profile_img` WRITE;
/*!40000 ALTER TABLE `profile_img` DISABLE KEYS */;
INSERT INTO `profile_img` VALUES ('resource//profile_images//Kavindu_66befdec0b2e8.jpeg','kavindusinghapura64@gmail.com');
/*!40000 ALTER TABLE `profile_img` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `province`
--

DROP TABLE IF EXISTS `province`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `province` (
  `province_id` int NOT NULL AUTO_INCREMENT,
  `province_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `province`
--

LOCK TABLES `province` WRITE;
/*!40000 ALTER TABLE `province` DISABLE KEYS */;
INSERT INTO `province` VALUES (2,'North centrel'),(3,'Centrel');
/*!40000 ALTER TABLE `province` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recent`
--

DROP TABLE IF EXISTS `recent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recent` (
  `r_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`r_id`),
  KEY `fk_recent_product1_idx` (`product_id`),
  KEY `fk_recent_user1_idx` (`user_email`),
  CONSTRAINT `fk_recent_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_recent_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recent`
--

LOCK TABLES `recent` WRITE;
/*!40000 ALTER TABLE `recent` DISABLE KEYS */;
/*!40000 ALTER TABLE `recent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status` (
  `status_id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'Active'),(2,'Inactive');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `name` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `joined_date` datetime NOT NULL,
  `verification_code` varchar(20) DEFAULT NULL,
  `gender_gender_id` int NOT NULL,
  `status_status_id` int NOT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_user_gender_idx` (`gender_gender_id`),
  KEY `fk_user_status1_idx` (`status_status_id`),
  CONSTRAINT `fk_user_gender` FOREIGN KEY (`gender_gender_id`) REFERENCES `gender` (`gender_id`),
  CONSTRAINT `fk_user_status1` FOREIGN KEY (`status_status_id`) REFERENCES `status` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('kavindu','12345@gmail.com','1234567','0778274850','2024-06-06 10:31:31',NULL,3,1),('kavindu','ddd@gmail.com','1234567','0778293758','2024-06-07 21:16:10',NULL,3,1),('Trendz','kavindu@gmail.com','1234567','0770098576','2024-02-10 00:08:34',NULL,3,1),('Kavindu','kavindusinghapura64@gmail.com','1234567','-702435578','2024-02-10 00:26:03','66632b6056909',3,1),('kavindu','movindu123@gmail.com','123456','0702435575','2024-05-31 11:44:38',NULL,3,1),('kavindu','movindu@gmail.com','12345','0702435570','2024-05-22 11:20:26',NULL,3,1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_has_address`
--

DROP TABLE IF EXISTS `user_has_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_has_address` (
  `user_email` varchar(100) NOT NULL,
  `city_city_id` int NOT NULL,
  `address_id` int NOT NULL AUTO_INCREMENT,
  `line1` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `line2` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `postal_code` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`address_id`),
  KEY `fk_user_has_city_city1_idx` (`city_city_id`),
  KEY `fk_user_has_city_user1_idx` (`user_email`),
  CONSTRAINT `fk_user_has_city_city1` FOREIGN KEY (`city_city_id`) REFERENCES `city` (`city_id`),
  CONSTRAINT `fk_user_has_city_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_has_address`
--

LOCK TABLES `user_has_address` WRITE;
/*!40000 ALTER TABLE `user_has_address` DISABLE KEYS */;
INSERT INTO `user_has_address` VALUES ('movindu@gmail.com',5,7,'no 5','firstlane','51000'),('movindu123@gmail.com',5,8,'','','51000'),('12345@gmail.com',5,10,'no 5','firstlane','51000'),('kavindusinghapura64@gmail.com',5,11,'no 5','firstlane','51000');
/*!40000 ALTER TABLE `user_has_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `watchlist`
--

DROP TABLE IF EXISTS `watchlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `watchlist` (
  `w_id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`w_id`) USING BTREE,
  KEY `fk_watchlist_user1_idx` (`user_email`),
  KEY `fk_watchlist_product1_idx` (`product_id`),
  CONSTRAINT `fk_watchlist_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_watchlist_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `watchlist`
--

LOCK TABLES `watchlist` WRITE;
/*!40000 ALTER TABLE `watchlist` DISABLE KEYS */;
INSERT INTO `watchlist` VALUES (34,'12345@gmail.com',12);
/*!40000 ALTER TABLE `watchlist` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-21  9:16:15
