CREATE DATABASE  IF NOT EXISTS `gzc353_2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `gzc353_2`;
-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: localhost    Database: gzc353_2
-- ------------------------------------------------------
-- Server version	8.0.22

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
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comment` (
  `CommentID` int NOT NULL AUTO_INCREMENT,
  `MemberID` int NOT NULL,
  `ContentID` int NOT NULL,
  `CommentBody` varchar(200) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`CommentID`),
  KEY `MemberID` (`MemberID`),
  KEY `ContentID` (`ContentID`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`ContentID`) REFERENCES `content` (`ContentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `condoadmin`
--

DROP TABLE IF EXISTS `condoadmin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `condoadmin` (
  `MemberID` int NOT NULL,
  `AppointeDate` date NOT NULL,
  PRIMARY KEY (`MemberID`),
  CONSTRAINT `condoadmin_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `content`
--

DROP TABLE IF EXISTS `content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `content` (
  `ContentID` int NOT NULL AUTO_INCREMENT,
  `MemberID` int NOT NULL,
  `ContentBody` varchar(1000) DEFAULT NULL,
  `Type` varchar(25) DEFAULT NULL,
  `Date` datetime DEFAULT CURRENT_TIMESTAMP,
  `Image` longblob,
  PRIMARY KEY (`ContentID`),
  KEY `Memberid` (`MemberID`),
  CONSTRAINT `content_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contract`
--

DROP TABLE IF EXISTS `contract`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contract` (
  `ContractID` int NOT NULL AUTO_INCREMENT,
  `MemberID` int DEFAULT NULL,
  `Status` varchar(25) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Cost` int DEFAULT NULL,
  `ContractorID` int DEFAULT NULL,
  `ContractBody` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Date` date DEFAULT NULL,
  PRIMARY KEY (`ContractID`),
  KEY `MemberID_idx` (`MemberID`),
  KEY `ContractorID_idx` (`ContractorID`),
  CONSTRAINT `ContractorID` FOREIGN KEY (`ContractorID`) REFERENCES `member` (`MemberID`),
  CONSTRAINT `MemberID` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contributions`
--

DROP TABLE IF EXISTS `contributions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contributions` (
  `ContributionID` int NOT NULL AUTO_INCREMENT,
  `MemberID` int NOT NULL,
  `Amount` int DEFAULT NULL,
  PRIMARY KEY (`ContributionID`),
  KEY `MemberID_idx` (`MemberID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `email`
--

DROP TABLE IF EXISTS `email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email` (
  `EmailID` int NOT NULL AUTO_INCREMENT,
  `MemberID` int NOT NULL,
  `Subject` varchar(25) NOT NULL,
  `EmailBody` varchar(1000) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`EmailID`),
  KEY `MemberID` (`MemberID`),
  CONSTRAINT `email_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `event_poll`
--

DROP TABLE IF EXISTS `event_poll`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_poll` (
  `ContentID` int NOT NULL,
  `Title` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ContentID`),
  CONSTRAINT `event_poll_ibfk_1` FOREIGN KEY (`ContentID`) REFERENCES `content` (`ContentID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `event_poll_option`
--

DROP TABLE IF EXISTS `event_poll_option`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_poll_option` (
  `event_poll_optionID` int NOT NULL AUTO_INCREMENT,
  `ContentID` int NOT NULL,
  `Place` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Time` time DEFAULT NULL,
  PRIMARY KEY (`event_poll_optionID`),
  KEY `ContentID` (`ContentID`),
  CONSTRAINT `ContentID` FOREIGN KEY (`ContentID`) REFERENCES `content` (`ContentID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `group` (
  `GroupID` int NOT NULL AUTO_INCREMENT,
  `GroupName` varchar(25) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `Date` date NOT NULL,
  `Owner` int NOT NULL,
  PRIMARY KEY (`GroupID`),
  UNIQUE KEY `GroupName_UNIQUE` (`GroupName`),
  KEY `Owner` (`Owner`),
  CONSTRAINT `group_ibfk_1` FOREIGN KEY (`Owner`) REFERENCES `member` (`MemberID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `manage_group`
--

DROP TABLE IF EXISTS `manage_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `manage_group` (
  `MemberID` int NOT NULL,
  `CondoAdminID` int NOT NULL,
  `ActionDone` varchar(25) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`MemberID`,`CondoAdminID`),
  KEY `manage_group_ibfk_2` (`CondoAdminID`),
  CONSTRAINT `manage_group_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`),
  CONSTRAINT `manage_group_ibfk_2` FOREIGN KEY (`CondoAdminID`) REFERENCES `condoadmin` (`MemberID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `manage_user`
--

DROP TABLE IF EXISTS `manage_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `manage_user` (
  `MemberID` int NOT NULL,
  `CondoAdminID` int NOT NULL,
  `ActionDone` varchar(25) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`MemberID`,`CondoAdminID`),
  KEY `CondoAdminID` (`CondoAdminID`),
  CONSTRAINT `manage_user_ibfk_1` FOREIGN KEY (`CondoAdminID`) REFERENCES `condoadmin` (`MemberID`),
  CONSTRAINT `manage_user_ibfk_2` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member` (
  `MemberID` int NOT NULL AUTO_INCREMENT,
  `Password` varchar(25) NOT NULL,
  `Email` varchar(25) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Address` varchar(25) NOT NULL,
  `Status` varchar(25) NOT NULL,
  `Privilege` varchar(25) NOT NULL,
  PRIMARY KEY (`MemberID`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `part_entourage`
--

DROP TABLE IF EXISTS `part_entourage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `part_entourage` (
  `MemberID` int NOT NULL,
  `EntourageID` int NOT NULL,
  `Relationship_Type` varchar(25) NOT NULL,
  PRIMARY KEY (`MemberID`,`EntourageID`),
  KEY `EntourageID` (`EntourageID`),
  CONSTRAINT `part_entourage_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `part_entourage_ibfk_2` FOREIGN KEY (`EntourageID`) REFERENCES `member` (`MemberID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `part_of`
--

DROP TABLE IF EXISTS `part_of`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `part_of` (
  `MemberID` int NOT NULL,
  `GroupID` int NOT NULL,
  `Status` varchar(15) NOT NULL DEFAULT 'In Progress',
  `RequestDate` date NOT NULL,
  PRIMARY KEY (`MemberID`,`GroupID`),
  KEY `Groupid` (`GroupID`),
  CONSTRAINT `part_of_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `part_of_ibfk_2` FOREIGN KEY (`GroupID`) REFERENCES `group` (`GroupID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `private_content`
--

DROP TABLE IF EXISTS `private_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `private_content` (
  `ContentID` int NOT NULL,
  `MemberID` int NOT NULL,
  KEY `ContentID_idx` (`ContentID`),
  KEY `memberid_idx` (`MemberID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `private_email`
--

DROP TABLE IF EXISTS `private_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `private_email` (
  `EmailID` int NOT NULL,
  `RecipientID` int NOT NULL,
  KEY `EmailID_idx` (`EmailID`),
  KEY `RecipientID_idx` (`RecipientID`),
  CONSTRAINT `EmailID` FOREIGN KEY (`EmailID`) REFERENCES `email` (`EmailID`),
  CONSTRAINT `RecipientID` FOREIGN KEY (`RecipientID`) REFERENCES `member` (`MemberID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `send_to`
--

DROP TABLE IF EXISTS `send_to`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `send_to` (
  `EmailID` int NOT NULL,
  `GroupID` int NOT NULL,
  PRIMARY KEY (`EmailID`,`GroupID`),
  KEY `send_to_ibfk_2_idx` (`GroupID`),
  CONSTRAINT `send_to_ibfk_1` FOREIGN KEY (`EmailID`) REFERENCES `email` (`EmailID`),
  CONSTRAINT `send_to_ibfk_2` FOREIGN KEY (`GroupID`) REFERENCES `group` (`GroupID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vote`
--

DROP TABLE IF EXISTS `vote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vote` (
  `event_poll_optionID` int NOT NULL,
  `ContentID` int NOT NULL,
  `MemberID` int NOT NULL,
  PRIMARY KEY (`ContentID`,`MemberID`),
  KEY `event_option_fk` (`event_poll_optionID`),
  KEY `MemberID_fk` (`MemberID`),
  CONSTRAINT `ContentID_fk` FOREIGN KEY (`ContentID`) REFERENCES `content` (`ContentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `event_option_fk` FOREIGN KEY (`event_poll_optionID`) REFERENCES `event_poll_option` (`event_poll_optionID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `MemberID_fk` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'gzc353_2'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-12-13 13:41:29
