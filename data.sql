CREATE DATABASE  IF NOT EXISTS `it185149` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `it185149`;
-- MySQL dump 10.13  Distrib 8.0.34, for macos13 (x86_64)
--
-- Host: localhost    Database: it185149
-- ------------------------------------------------------
-- Server version	5.7.35

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
-- Dumping data for table `player1attack`
--

LOCK TABLES `player1attack` WRITE;
/*!40000 ALTER TABLE `player1attack` DISABLE KEYS */;
INSERT INTO `player1attack` VALUES (1,'U','U','U','U','U','U'),(2,'U','U','U','U','U','U'),(3,'U','U','U','U','U','U'),(4,'U','U','U','U','U','U'),(5,'U','U','U','U','U','U'),(6,'U','U','U','U','U','U');
/*!40000 ALTER TABLE `player1attack` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `player1ships`
--

LOCK TABLES `player1ships` WRITE;
/*!40000 ALTER TABLE `player1ships` DISABLE KEYS */;
INSERT INTO `player1ships` VALUES (1,'U','U','U','U','U','U'),(2,'U','U','U','U','U','U'),(3,'U','U','U','U','U','U'),(4,'U','U','U','U','U','U'),(5,'U','U','U','U','U','U'),(6,'U','U','U','U','U','U');
/*!40000 ALTER TABLE `player1ships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `player2attack`
--

LOCK TABLES `player2attack` WRITE;
/*!40000 ALTER TABLE `player2attack` DISABLE KEYS */;
INSERT INTO `player2attack` VALUES (1,'U','U','U','U','U','U'),(2,'U','U','U','U','U','U'),(3,'U','U','U','U','U','U'),(4,'U','U','U','U','U','U'),(5,'U','U','U','U','U','U'),(6,'U','U','U','U','U','U');
/*!40000 ALTER TABLE `player2attack` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `player2ships`
--

LOCK TABLES `player2ships` WRITE;
/*!40000 ALTER TABLE `player2ships` DISABLE KEYS */;
INSERT INTO `player2ships` VALUES (1,'U','U','U','U','U','U'),(2,'U','U','U','U','U','U'),(3,'U','U','U','U','U','U'),(4,'U','U','U','U','U','U'),(5,'U','U','U','U','U','U'),(6,'U','U','U','U','U','U');
/*!40000 ALTER TABLE `player2ships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `player_ships`
--

LOCK TABLES `player_ships` WRITE;
/*!40000 ALTER TABLE `player_ships` DISABLE KEYS */;
INSERT INTO `player_ships` VALUES ('Player1','Carrier','Not Set',NULL,NULL,NULL,NULL,NULL,NULL),('Player1','Battleship','Not Set',NULL,NULL,NULL,NULL,NULL,NULL),('Player1','Submarine','Not Set',NULL,NULL,NULL,NULL,NULL,NULL),('Player1','Boat','Not Set',NULL,NULL,NULL,NULL,NULL,NULL),('Player2','Boat','Not Set',NULL,NULL,NULL,NULL,NULL,NULL),('Player2','Submarine','Not Set',NULL,NULL,NULL,NULL,NULL,NULL),('Player2','Battleship','Not Set',NULL,NULL,NULL,NULL,NULL,NULL),('Player2','Carrier','Not Set',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `player_ships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `players`
--

LOCK TABLES `players` WRITE;
/*!40000 ALTER TABLE `players` DISABLE KEYS */;
INSERT INTO `players` VALUES ('Player1',1,1),('Player2',2,0);
/*!40000 ALTER TABLE `players` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES ('Ship Setup','Both');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-11 10:38:00
