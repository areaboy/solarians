-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: solarians_db
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `comments_solar`
--

DROP TABLE IF EXISTS `comments_solar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments_solar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postid` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `timer1` varchar(100) DEFAULT NULL,
  `userid` text DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `photo` varchar(400) DEFAULT NULL,
  `data` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments_solar`
--

LOCK TABLES `comments_solar` WRITE;
/*!40000 ALTER TABLE `comments_solar` DISABLE KEYS */;
INSERT INTO `comments_solar` VALUES (5,4,'Nice updates. Keep it up','1726920246','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','Esedo Fredrick','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3AnnBall.png',NULL),(6,5,'Nice Updates','1726920606','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','Esedo Fredrick','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3AnnBall.png',NULL),(7,5,'nice','1726921268','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','Esedo Fredrick','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3AnnBall.png',NULL),(8,4,'hi','1726924627','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','Esedo Fredrick','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3AnnBall.png',NULL);
/*!40000 ALTER TABLE `comments_solar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_solar`
--

DROP TABLE IF EXISTS `company_solar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_solar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) DEFAULT NULL,
  `company_name` varchar(200) DEFAULT NULL,
  `company_desc` varchar(300) DEFAULT NULL,
  `created_time` varchar(200) DEFAULT NULL,
  `timing` varchar(200) DEFAULT NULL,
  `photo` varchar(300) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL,
  `country_name` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_solar`
--

LOCK TABLES `company_solar` WRITE;
/*!40000 ALTER TABLE `company_solar` DISABLE KEYS */;
INSERT INTO `company_solar` VALUES (1,'company@gmail.com','Company Solartis','solar company','Thursday, September 12, 2024, 2:41 pm','1726166498','66e335e2efb8817261664984fd3d2377438303c544393e24c593a03annball4.png','Broadway 10012, New York, NY, USA)',NULL,NULL,'United States','United States'),(2,'so@gmail.com','solar co','desco','Thursday, September 12, 2024, 11:04 pm','1726196646','66e3aba6e5bb9172619664633ea397b13dffe52180f55f2f7f7fdabannball4.png','Broadway 10012, New York, NY, USA',40.725132,-73.997009,'United States','United States'),(3,'solatex56@gmail.com','SolarTex Technologies','We are SolarTex Technologies. We deals in all kind of Solar Energy Products such as Solar Inverters, Solar Panel, Solar Batteries, Solar Fans. etc.','Thursday, September 19, 2024, 2:39 pm','1726771171','66ec6fe35ad6417267711716962f3ca052acac918d59997d898d51esolar.png','Plot 73A Kofo Abayomi Street, Victoria Island, Lagos',6.435451,3.414438,'Nigeria','Nigeria'),(4,'sander675@gmail.com','Sandrex Solar Greener Energy Limited','We are Sandrex Solar Greener Energy Limited. We deals in all kind of Solar Energy Products such as Solar Inverters, Solar Panel, Solar Batteries, Solar Fans. etc.','Thursday, September 19, 2024, 2:42 pm','1726771374','66ec70aeaef001726771374798b295512504d70c7f59ce010626ac3solar2.png','No. 11 New Market Road, Off Main Market, Onitsha, Anambra State, Nigeria',6.150997,6.777249,'Nigeria','Nigeria');
/*!40000 ALTER TABLE `company_solar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification_solar`
--

DROP TABLE IF EXISTS `notification_solar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification_solar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `userid` text DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `reciever_id` text DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `timing` varchar(100) DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `title_seo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification_solar`
--

LOCK TABLES `notification_solar` WRITE;
/*!40000 ALTER TABLE `notification_solar` DISABLE KEYS */;
INSERT INTO `notification_solar` VALUES (21,'4','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','Esedo Fredrick','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3AnnBall.png','66db3b9d443ee1725643677e65d57cb8be18b67fd4ae66da1f9b498','unread','post','1726920201','My 500 Watts Lithium Solar Energy Experience','66eeb609197dd17269202010d3517a326f267e1802ad2df215a2dc8'),(22,'4','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','Esedo Fredrick','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3AnnBall.png','66e3aab7b433717261964072372292184d7924e611e3d63de48d8f2','unread','post','1726920201','My 500 Watts Lithium Solar Energy Experience','66eeb609197dd17269202010d3517a326f267e1802ad2df215a2dc8'),(23,'4','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','Esedo Fredrick','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3AnnBall.png','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','unread','post','1726920201','My 500 Watts Lithium Solar Energy Experience','66eeb609197dd17269202010d3517a326f267e1802ad2df215a2dc8'),(24,'4','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','Esedo Fredrick','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3AnnBall.png','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','unread','comment','1726920246','My 500 Watts Lithium Solar Energy Experience','66eeb609197dd17269202010d3517a326f267e1802ad2df215a2dc8'),(25,'5','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','Esedo Fredrick','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3AnnBall.png','66db3b9d443ee1725643677e65d57cb8be18b67fd4ae66da1f9b498','unread','post','1726920509','1000 Watts Solar Energy for Sales','66eeb73dcfe0d172692050928b0208978856a1a8bc10df03a8d5f40'),(26,'5','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','Esedo Fredrick','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3AnnBall.png','66e3aab7b433717261964072372292184d7924e611e3d63de48d8f2','unread','post','1726920509','1000 Watts Solar Energy for Sales','66eeb73dcfe0d172692050928b0208978856a1a8bc10df03a8d5f40'),(27,'5','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','Esedo Fredrick','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3AnnBall.png','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','unread','post','1726920509','1000 Watts Solar Energy for Sales','66eeb73dcfe0d172692050928b0208978856a1a8bc10df03a8d5f40'),(28,'5','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','Esedo Fredrick','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3AnnBall.png','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','unread','comment','1726920606','1000 Watts Solar Energy for Sales','66eeb73dcfe0d172692050928b0208978856a1a8bc10df03a8d5f40'),(29,'5','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','Esedo Fredrick','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3AnnBall.png','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','unread','comment','1726921268','1000 Watts Solar Energy for Sales','66eeb73dcfe0d172692050928b0208978856a1a8bc10df03a8d5f40'),(30,'5','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','Esedo Fredrick','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3AnnBall.png','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','unread','post_like','1726921275','1000 Watts Solar Energy for Sales','66eeb73dcfe0d172692050928b0208978856a1a8bc10df03a8d5f40'),(31,'4','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','Esedo Fredrick','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3AnnBall.png','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','unread','comment','1726924627','My 500 Watts Lithium Solar Energy Experience','66eeb609197dd17269202010d3517a326f267e1802ad2df215a2dc8'),(32,'4','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','Esedo Fredrick','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3AnnBall.png','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','unread','post_like','1726924633','My 500 Watts Lithium Solar Energy Experience','66eeb609197dd17269202010d3517a326f267e1802ad2df215a2dc8');
/*!40000 ALTER TABLE `notification_solar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_like_solar`
--

DROP TABLE IF EXISTS `post_like_solar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_like_solar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postid` int(11) NOT NULL,
  `like_count` text DEFAULT NULL,
  `timer1` varchar(100) DEFAULT NULL,
  `userid` text DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_like_solar`
--

LOCK TABLES `post_like_solar` WRITE;
/*!40000 ALTER TABLE `post_like_solar` DISABLE KEYS */;
INSERT INTO `post_like_solar` VALUES (12,5,'1','1726921275','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','Esedo Fredrick','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3AnnBall.png'),(13,4,'1','1726924633','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','Esedo Fredrick','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3AnnBall.png');
/*!40000 ALTER TABLE `post_like_solar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts_solar`
--

DROP TABLE IF EXISTS `posts_solar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts_solar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `title_seo` varchar(200) DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `timer` varchar(100) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `userphoto` varchar(300) DEFAULT NULL,
  `userid` text DEFAULT NULL,
  `points` varchar(100) DEFAULT NULL,
  `total_comments` varchar(100) DEFAULT NULL,
  `total_like` varchar(20) DEFAULT NULL,
  `country_name` varchar(100) DEFAULT NULL,
  `country_nickname` varchar(100) DEFAULT NULL,
  `data` varchar(100) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `solar_inverter_capacity` varchar(100) DEFAULT NULL,
  `battery_type` varchar(100) DEFAULT NULL,
  `battery_capacity` varchar(100) DEFAULT NULL,
  `solar_panel_capacity` varchar(100) DEFAULT NULL,
  `solar_panel_installed_quantity` varchar(100) DEFAULT NULL,
  `video` varchar(100) DEFAULT NULL,
  `video_type` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts_solar`
--

LOCK TABLES `posts_solar` WRITE;
/*!40000 ALTER TABLE `posts_solar` DISABLE KEYS */;
INSERT INTO `posts_solar` VALUES (4,'My 500 Watts Lithium Solar Energy Experience','66eeb609197dd17269202010d3517a326f267e1802ad2df215a2dc8','My name is Esedo Fredrick Chijioke.  This is my  experience with My 500 Watts Lithium Solar Energy Experience. I am from Nigeria. I have used this Solar for the past six years and its working fine.  Its noiseless and also make our environments greener..  Other Details are stated below','1726920201','Esedo Fredrick','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3AnnBall.png','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','200','2','1','Nigeria','Nigerians',NULL,'66eeb609197dd17269202010d3517a326f267e1802ad2df215a2dc8solar.png','500','Lithium','500','50','4','kwqHwlhQoLA',NULL),(5,'1000 Watts Solar Energy for Sales','66eeb73dcfe0d172692050928b0208978856a1a8bc10df03a8d5f40','My name is Esedo Fredrick Chijioke. I have 1000 Watts Lithium Solar Energy for Sales. I am from Nigeria and I deal with Solar Equipments. Its noiseless and also make our environments greener.. It can Carry Refrigerators, 1 Horse Power AC, tv. Fans etc. Other Details are stated below','1726920509','Esedo Fredrick','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3AnnBall.png','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','200','2','1','Nigeria','Nigerians',NULL,'66eeb73dcfe0d172692050928b0208978856a1a8bc10df03a8d5f40solar2.png','1000','Lithium','1000','150','3','C0jwuVoboAg',NULL);
/*!40000 ALTER TABLE `posts_solar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_solar`
--

DROP TABLE IF EXISTS `users_solar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_solar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) DEFAULT NULL,
  `fullname` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `created_time` varchar(200) DEFAULT NULL,
  `timing` varchar(200) DEFAULT NULL,
  `userid` varchar(300) DEFAULT NULL,
  `photo` varchar(300) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `lat` varchar(30) DEFAULT NULL,
  `lng` varchar(30) DEFAULT NULL,
  `map_zoom` varchar(10) DEFAULT NULL,
  `country_nickname` varchar(30) DEFAULT NULL,
  `points` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_solar`
--

LOCK TABLES `users_solar` WRITE;
/*!40000 ALTER TABLE `users_solar` DISABLE KEYS */;
INSERT INTO `users_solar` VALUES (4,'test@gmail.com','Esedo Fredrick','$2y$04$Zh.l6glOOtqCynu/YScAkuwvsdgsmEwsikD0IFhPaGX1Y9SeaxmUe','Thursday, September 19, 2024, 2:44 pm','1726771469','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3','66ec710d92ef217267714691fca23a115cb12a8e68d2c48cca595d3AnnBall.png','Nigeria','No 14 independent Layout, Abapa, Enugu State, Nigeria','9.081999','8.675277','7','Nigerians','200');
/*!40000 ALTER TABLE `users_solar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'solarians_db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-25 14:39:51
