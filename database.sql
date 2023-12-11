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
-- Table structure for table `player1attack`
--

DROP TABLE IF EXISTS `player1attack`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `player1attack` (
  `row` int(11) DEFAULT NULL,
  `a` varchar(1) DEFAULT NULL,
  `b` varchar(1) DEFAULT NULL,
  `c` varchar(1) DEFAULT NULL,
  `d` varchar(1) DEFAULT NULL,
  `e` varchar(1) DEFAULT NULL,
  `f` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `player1ships`
--

DROP TABLE IF EXISTS `player1ships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `player1ships` (
  `row` int(11) DEFAULT NULL,
  `a` varchar(1) DEFAULT NULL,
  `b` varchar(1) DEFAULT NULL,
  `c` varchar(1) DEFAULT NULL,
  `d` varchar(1) DEFAULT NULL,
  `e` varchar(1) DEFAULT NULL,
  `f` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `player2attack`
--

DROP TABLE IF EXISTS `player2attack`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `player2attack` (
  `row` int(11) DEFAULT NULL,
  `a` varchar(1) DEFAULT NULL,
  `b` varchar(1) DEFAULT NULL,
  `c` varchar(1) DEFAULT NULL,
  `d` varchar(1) DEFAULT NULL,
  `e` varchar(1) DEFAULT NULL,
  `f` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `player2ships`
--

DROP TABLE IF EXISTS `player2ships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `player2ships` (
  `row` int(11) DEFAULT NULL,
  `a` varchar(1) DEFAULT NULL,
  `b` varchar(1) DEFAULT NULL,
  `c` varchar(1) DEFAULT NULL,
  `d` varchar(1) DEFAULT NULL,
  `e` varchar(1) DEFAULT NULL,
  `f` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `player_ships`
--

DROP TABLE IF EXISTS `player_ships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `player_ships` (
  `ship_owner` enum('Player1','Player2') NOT NULL,
  `ship_name` enum('Battleship','Carrier','Submarine','Boat') NOT NULL,
  `ship_status` enum('Sunk','Damaged','Undamaged','Not Set') NOT NULL,
  `start_position` varchar(2) DEFAULT NULL,
  `end_position` varchar(2) DEFAULT NULL,
  `first_space` enum('OK','DAMAGED') DEFAULT NULL,
  `second_space` enum('OK','DAMAGED') DEFAULT NULL,
  `third_space` enum('OK','DAMAGED') DEFAULT NULL,
  `fourth_space` enum('OK','DAMAGED') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`it185149`@`%`*/ /*!50003 trigger status_update_to_battle after update on player_ships for each row
begin

	if not exists (select * from player_ships where ship_status = 'Not Set') then
   
		update status set gamestate = 'Battle', next_action = 'Player1';
        
	end if;
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`it185149`@`%`*/ /*!50003 trigger status_update_to_win after update on player_ships for each row
begin
	declare counter int;
	set counter = (select count(*) from player_ships where ship_status = 'Sunk' and ship_owner = 'Player1');
	if  counter = 4 then
   
		update status set gamestate = 'Player2 Won', next_action = 'None';
        
	end if;

	set counter = (select count(*) from player_ships where ship_status = 'Sunk' and ship_owner = 'Player2');
	if  counter = 4 then
   
		update status set gamestate = 'Player1 Won', next_action = 'None';
        
	end if;
 
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `players`
--

DROP TABLE IF EXISTS `players`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `players` (
  `name` varchar(30) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `isTheirTurn` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status` (
  `gamestate` enum('Ship Setup','Battle','Player1 Won','Player2 Won') DEFAULT NULL,
  `next_action` enum('Player1','Player2','Both','None') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'it185149'
--
/*!50003 DROP PROCEDURE IF EXISTS `ship_status_from_battle` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`it185149`@`%` PROCEDURE `ship_status_from_battle`()
BEGIN
	update player_ships set ship_status = 'Damaged' where first_space = 'Damaged' or second_space = 'Damaged' or third_space = 'Damaged' or fourth_space = 'Damaged';
    update player_ships set ship_status = 'Sunk' where (first_space <> 'OK' and first_space is not NULL) and (second_space <> 'OK' and second_space is not NULL) and (third_space <> 'OK' or third_space is NULL) and (fourth_space <> 'OK' or fourth_space is NULL);
 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-11 10:34:55
