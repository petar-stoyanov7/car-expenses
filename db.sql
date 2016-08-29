CREATE DATABASE  IF NOT EXISTS `pestart_car_expenses` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `pestart_car_expenses`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: l.me    Database: pestart_car_expenses
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.13-MariaDB

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
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cars` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) DEFAULT NULL,
  `Brand` varchar(50) DEFAULT NULL,
  `Model` varchar(50) DEFAULT NULL,
  `Year` varchar(5) DEFAULT NULL,
  `Color` varchar(50) DEFAULT NULL,
  `Mileage` int(11) DEFAULT NULL,
  `Fuel_ID` int(11) DEFAULT NULL,
  `Fuel_ID2` int(11) DEFAULT NULL,
  `Notes` mediumtext,
  PRIMARY KEY (`ID`),
  KEY `Fuel_ID` (`Fuel_ID`),
  KEY `Fuel_ID2` (`Fuel_ID2`),
  CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`Fuel_ID`) REFERENCES `fuel_types` (`ID`),
  CONSTRAINT `cars_ibfk_2` FOREIGN KEY (`Fuel_ID2`) REFERENCES `fuel_types` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cars`
--

LOCK TABLES `cars` WRITE;
/*!40000 ALTER TABLE `cars` DISABLE KEYS */;
INSERT INTO `cars` VALUES (1,1,'BMW','328i','1998','Silver',202416,1,3,NULL),(5,2,'Wolkswagen','Golf2','1991','Ð§ÐµÑ€Ð²ÐµÐ½',532123,1,3,'Moiata gordos!!!!'),(6,7,'Opel','Astra','1999','Ð—ÐµÐ»ÐµÐ½',215160,2,NULL,'Ð—ÐµÐ»ÐµÐ½Ð°Ñ‚Ð° Ð¿Ñ€Ð°ÑˆÐºÐ°'),(8,6,'BMW','316','1992','4erwen',519731,2,NULL,'IAKATA RAOTA'),(9,7,'Mercedes','E220','2006','Ð¡Ñ€ÐµÐ±ÑŠÑ€ÐµÐ½',200123,1,NULL,'ÐšÐ¾Ñ€Ð°Ð±'),(10,7,'Wolkswagen','Polo','1998','Ð¡Ð¸Ð½',521301,1,NULL,'ÐœÐ°Ð»ÐºÐ¸Ñ'),(11,8,'wv','g','1919','h',10928302,1,NULL,'');
/*!40000 ALTER TABLE `cars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense_2014`
--

DROP TABLE IF EXISTS `expense_2014`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expense_2014` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) DEFAULT NULL,
  `CID` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Mileage` int(11) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL,
  `Expense_ID` int(11) DEFAULT NULL,
  `Fuel_ID` int(11) DEFAULT NULL,
  `Insurance_ID` int(11) DEFAULT NULL,
  `Liters` int(11) DEFAULT NULL,
  `Notes` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense_2014`
--

LOCK TABLES `expense_2014` WRITE;
/*!40000 ALTER TABLE `expense_2014` DISABLE KEYS */;
/*!40000 ALTER TABLE `expense_2014` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense_2015`
--

DROP TABLE IF EXISTS `expense_2015`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expense_2015` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) DEFAULT NULL,
  `CID` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Mileage` int(11) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL,
  `Expense_ID` int(11) DEFAULT NULL,
  `Fuel_ID` int(11) DEFAULT NULL,
  `Insurance_ID` int(11) DEFAULT NULL,
  `Liters` int(11) DEFAULT NULL,
  `Notes` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense_2015`
--

LOCK TABLES `expense_2015` WRITE;
/*!40000 ALTER TABLE `expense_2015` DISABLE KEYS */;
INSERT INTO `expense_2015` VALUES (26,1,1,'2015-06-06',186154,29,1,3,NULL,31,NULL),(27,1,1,'2015-06-06',186155,52,1,3,NULL,52,NULL),(28,1,1,'2015-06-06',186157,40,1,3,NULL,40,NULL),(29,1,1,'2015-06-06',187823,46,1,3,NULL,50,NULL),(30,1,1,'2015-06-06',188162,50,1,3,NULL,54,NULL),(31,1,1,'2015-06-06',188620,42,1,3,NULL,43,NULL),(32,1,1,'2015-06-06',188881,40,1,3,NULL,40,NULL),(33,1,1,'2015-06-06',189626,44,1,3,NULL,52,NULL),(34,1,1,'2015-06-06',190000,39,1,3,NULL,41,NULL),(35,1,1,'2015-06-06',190532,47,1,3,NULL,52,NULL),(36,1,1,'2015-06-06',190722,21,1,3,NULL,24,NULL),(37,1,1,'2015-06-06',191122,47,1,3,NULL,54,NULL),(38,1,1,'2015-08-08',188162,20,1,1,NULL,8,NULL),(39,1,1,'2015-08-08',190346,50,1,1,NULL,20,NULL),(40,1,1,'2015-08-08',191122,30,1,1,NULL,15,NULL),(41,1,1,'2015-06-06',186155,175,4,NULL,NULL,NULL,''),(42,1,1,'2015-08-08',186156,400,2,NULL,2,NULL,''),(43,1,1,'2015-09-10',186157,280,2,NULL,1,NULL,'');
/*!40000 ALTER TABLE `expense_2015` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense_2016`
--

DROP TABLE IF EXISTS `expense_2016`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expense_2016` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) DEFAULT NULL,
  `CID` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Mileage` int(11) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL,
  `Expense_ID` int(11) DEFAULT NULL,
  `Fuel_ID` int(11) DEFAULT NULL,
  `Insurance_ID` int(11) DEFAULT NULL,
  `Liters` int(11) DEFAULT NULL,
  `Notes` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense_2016`
--

LOCK TABLES `expense_2016` WRITE;
/*!40000 ALTER TABLE `expense_2016` DISABLE KEYS */;
INSERT INTO `expense_2016` VALUES (1,1,1,'2016-01-01',191300,1070,3,NULL,NULL,NULL,'Ð¡Ð²ÐµÑ‰Ð¸, Ð±Ð¾Ð±Ð¸Ð½Ð¸, Ð´Ñ€.'),(2,1,1,'2016-01-05',191300,127,3,NULL,NULL,NULL,''),(3,1,1,'2016-01-12',191300,50,1,1,NULL,24,''),(4,1,1,'2016-02-12',191504,100,2,NULL,2,NULL,''),(5,1,1,'2016-02-12',191504,65,2,NULL,1,NULL,''),(6,1,1,'2016-02-12',191504,45,5,NULL,NULL,NULL,'Ð“Ð¾Ð´Ð¸ÑˆÐµÐ½ Ð¿Ñ€ÐµÐ³Ð»ÐµÐ´.'),(7,1,1,'2016-08-12',191504,97,5,NULL,NULL,NULL,'Ð’Ð¸Ð½ÐµÑ‚ÐºÐ°. ÐžÐ±Ð¸Ñ€.'),(8,1,1,'2016-01-12',191504,38,1,3,NULL,43,''),(9,1,1,'2016-08-12',191967,140,3,NULL,NULL,NULL,''),(10,1,1,'2016-08-12',192188,25,1,3,NULL,31,''),(11,1,1,'2016-08-12',192544,33,1,3,NULL,40,''),(12,1,1,'2016-03-12',192852,166,4,NULL,NULL,NULL,''),(13,1,1,'2016-08-12',192928,38,1,3,NULL,48,''),(14,1,1,'2016-08-12',192928,34,1,3,NULL,41,''),(15,1,1,'2016-08-12',193792,29,1,3,NULL,37,''),(16,1,1,'2016-08-12',194271,42,1,3,NULL,52,''),(17,1,1,'2016-08-12',194618,33,1,3,NULL,40,''),(18,1,1,'2016-08-12',194972,29,1,3,NULL,38,''),(19,1,1,'2016-08-12',195385,67,2,NULL,1,NULL,''),(20,1,1,'2016-08-12',195385,107,2,NULL,2,NULL,''),(21,1,1,'2016-08-12',195385,42,1,3,NULL,54,''),(22,1,1,'2016-08-12',195688,26,1,3,NULL,34,''),(23,1,1,'2016-08-12',196052,37,1,3,NULL,47,''),(24,1,1,'2016-08-12',196768,35,1,3,NULL,39,''),(25,1,1,'2016-08-12',196768,20,1,1,NULL,10,''),(26,1,1,'2016-08-12',197629,37,1,3,NULL,39,''),(27,1,1,'2016-08-12',197772,26,1,3,NULL,39,''),(28,1,1,'2016-08-12',198240,50,1,1,NULL,26,''),(29,1,1,'2016-08-12',198344,47,1,3,NULL,53,''),(30,1,1,'2016-08-12',198344,60,3,NULL,NULL,NULL,'Ð—Ð°Ñ€ÐµÐ¶Ð´Ð°Ð½Ðµ Ñ„Ñ€ÐµÐ¾Ð½ Ð½Ð° ÐºÐ»Ð¸Ð¼Ð°Ñ‚Ð¸Ðº'),(31,1,1,'2016-08-12',198786,24,1,3,NULL,30,''),(32,1,1,'2016-08-12',199181,44,1,3,NULL,54,''),(33,1,1,'2016-08-12',199181,870,3,NULL,NULL,NULL,'Ð¡Ð¼ÑÐ½Ð° Ð½Ð° Ð³ÑƒÐ¼Ð¸'),(34,1,1,'2016-08-12',199181,20,1,3,NULL,30,''),(35,1,1,'2016-08-12',199802,41,1,3,NULL,49,''),(36,1,1,'2016-08-12',199802,64,2,NULL,1,NULL,''),(37,1,1,'2016-08-12',199802,100,2,NULL,2,NULL,''),(38,1,1,'2016-08-12',199802,105,3,NULL,NULL,NULL,'Ð£Ð¿Ð»ÑŠÑ‚Ð½ÐµÐ½Ð¸Ðµ Ð½Ð° Ð¿Ñ€ÐµÐ´Ð½Ð¾ ÑÑ‚ÑŠÐºÐ»Ð¾.'),(39,1,1,'2016-08-12',200192,30,1,3,NULL,38,''),(40,1,1,'2016-08-12',200541,41,1,3,NULL,47,''),(41,1,1,'2016-08-12',200837,37,1,3,NULL,45,''),(42,1,1,'2016-08-12',201075,20,1,1,NULL,9,''),(43,1,1,'2016-08-12',201075,34,1,3,NULL,37,''),(44,1,1,'2016-08-12',201448,41,1,3,NULL,51,''),(45,1,1,'2016-08-12',201778,40,1,3,NULL,45,''),(46,1,1,'2016-08-12',202085,38,1,3,NULL,44,''),(49,7,6,'2016-08-14',215150,20,1,1,NULL,8,''),(50,7,9,'2016-08-14',196000,250,4,NULL,NULL,NULL,''),(51,7,6,'2016-08-14',215150,50,2,NULL,1,NULL,''),(52,1,1,'2016-08-21',202086,300,3,NULL,NULL,NULL,'Ñ€ÐµÐ¼Ð¾Ð½Ñ‚ ÐºÐ»Ð¸Ð¼Ð°Ñ‚Ð¸Ðº'),(53,1,1,'2016-08-21',202416,41,1,3,NULL,40,''),(54,7,6,'2016-08-27',215160,50,1,1,NULL,20,''),(55,7,9,'2016-08-27',197000,50,3,NULL,NULL,NULL,'Ð§Ð¸ÑÑ‚Ð°Ñ‡ÐºÐ¸'),(59,7,9,'2016-08-27',200123,110,1,1,NULL,50,''),(60,7,10,'2016-08-27',521200,50,3,NULL,NULL,NULL,''),(61,7,10,'2016-08-27',521300,50,3,NULL,NULL,NULL,''),(62,7,10,'2016-08-27',215170,50,1,1,NULL,20,''),(63,7,6,'2016-08-27',521200,50,1,1,NULL,20,''),(64,1,1,'2016-08-29',202416,1,1,1,NULL,1,'');
/*!40000 ALTER TABLE `expense_2016` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense_types`
--

DROP TABLE IF EXISTS `expense_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expense_types` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense_types`
--

LOCK TABLES `expense_types` WRITE;
/*!40000 ALTER TABLE `expense_types` DISABLE KEYS */;
INSERT INTO `expense_types` VALUES (1,'Fuel'),(2,'Insurance'),(3,'Maintenance'),(4,'Tax'),(5,'Other');
/*!40000 ALTER TABLE `expense_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_types`
--

DROP TABLE IF EXISTS `fuel_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_types` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_types`
--

LOCK TABLES `fuel_types` WRITE;
/*!40000 ALTER TABLE `fuel_types` DISABLE KEYS */;
INSERT INTO `fuel_types` VALUES (1,'Gas'),(2,'Diesel'),(3,'LPG'),(4,'Methane'),(5,'Electricity'),(6,'Other');
/*!40000 ALTER TABLE `fuel_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `insurance_types`
--

DROP TABLE IF EXISTS `insurance_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `insurance_types` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `insurance_types`
--

LOCK TABLES `insurance_types` WRITE;
/*!40000 ALTER TABLE `insurance_types` DISABLE KEYS */;
INSERT INTO `insurance_types` VALUES (1,'GO'),(2,'Kasko'),(3,'Other');
/*!40000 ALTER TABLE `insurance_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Col1` varchar(50) DEFAULT NULL,
  `col2` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test`
--

LOCK TABLES `test` WRITE;
/*!40000 ALTER TABLE `test` DISABLE KEYS */;
INSERT INTO `test` VALUES (1,'1',0),(2,'Ð¿Ñ€Ð¾Ð±Ð»ÐµÐ¼',13),(3,'Ð¿Ñ€Ð¾Ð±Ð»ÐµÐ¼',1),(4,'Ð¿Ñ€Ð¾Ð±Ð»ÐµÐ¼',1),(5,'Ð¿Ñ€Ð¾Ð±Ð»ÐµÐ¼',1),(6,'Ð¿Ñ€Ð¾Ð±Ð»ÐµÐ¼',1);
/*!40000 ALTER TABLE `test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_timestamp`
--

DROP TABLE IF EXISTS `test_timestamp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_timestamp` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Field` varchar(50) DEFAULT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_timestamp`
--

LOCK TABLES `test_timestamp` WRITE;
/*!40000 ALTER TABLE `test_timestamp` DISABLE KEYS */;
INSERT INTO `test_timestamp` VALUES (1,'Entry #1','2016-08-10 10:14:43'),(2,'TEST','2016-08-10 18:44:43'),(3,'TEST2','2016-08-09 21:00:00');
/*!40000 ALTER TABLE `test_timestamp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `Group` varchar(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Fname` varchar(120) DEFAULT NULL,
  `Lname` varchar(120) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `Sex` varchar(10) DEFAULT NULL,
  `Notes` mediumtext,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','$2y$10$XCD1Zl7qZqbiObAnPH6S2Ol/liIJQQUWwL/Ei9SbYqm2UTIokS.46','admins','petar.stoyanov@gmail.com','Admin','User','Sofia','male',NULL),(2,'ivan85','$2y$10$4EcE/.gY26D2jbu23H5nu.QN5P.wv2qu6.iHaTrzEsLu0MMobzIMW','users','ivan@abv.bg','Ivan','Ivanov','Pernik','male',''),(6,'stamat13','$2y$10$ycpcvfbxqAv1BeZMrX7VXOoL8IexhTJDwbvE5hv7Ykuv8RfHQpftC','users','stamat@abv.bg','Ð¡Ñ‚Ð°Ð¼Ð°Ñ‚','Ð¡Ñ‚Ð°Ð¼Ð°Ñ‚Ð¾Ð²','Ð¢ÑƒÑ‚Ñ€Ð°ÐºÐ°Ð½','male',''),(7,'nadia3','$2y$10$ycpcvfbxqAv1BeZMrX7VXOoL8IexhTJDwbvE5hv7Ykuv8RfHQpftC','users','nade@abv.bg','ÐÐ°Ð´ÐµÐ¶Ð´Ð°','ÐšÐ¾ÑÑ‚Ð¾Ð²Ð°','Ð¢ÐµÑ‚ÐµÐ²ÐµÐ½','female','');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'pestart_car_expenses'
--

--
-- Dumping routines for database 'pestart_car_expenses'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-29 20:00:05
