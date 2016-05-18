CREATE DATABASE  IF NOT EXISTS `3dpteam` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `3dpteam`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: 3dpteam
-- ------------------------------------------------------
-- Server version	5.7.11-log

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
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `korisnik` (
  `korisnik_id` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(50) DEFAULT NULL,
  `prezime` varchar(50) DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `profilnaSlikaID` int(11) DEFAULT NULL,
  `korisnikAccID` int(11) DEFAULT NULL,
  `Aktivan` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`korisnik_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `korisnik`
--

LOCK TABLES `korisnik` WRITE;
/*!40000 ALTER TABLE `korisnik` DISABLE KEYS */;
INSERT INTO `korisnik` VALUES (4,NULL,NULL,'2016-03-31','balickerim@hotmail.com',NULL,6,1),(7,'Kenan','Prses','2016-04-02','kena@gmail.com',NULL,9,1),(8,NULL,NULL,'2016-05-18','',NULL,10,1),(9,NULL,NULL,'2016-05-18','',NULL,11,1),(10,NULL,NULL,'2016-05-18','novikorinisk@novi.ba',NULL,12,1);
/*!40000 ALTER TABLE `korisnik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `korisnikaccount`
--

DROP TABLE IF EXISTS `korisnikaccount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `korisnikaccount` (
  `korisnikAcc_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `rolaID` int(11) DEFAULT NULL,
  PRIMARY KEY (`korisnikAcc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `korisnikaccount`
--

LOCK TABLES `korisnikaccount` WRITE;
/*!40000 ALTER TABLE `korisnikaccount` DISABLE KEYS */;
INSERT INTO `korisnikaccount` VALUES (6,'kerim','test',1),(9,'kenan','test',1),(10,'','',1),(11,'','',1),(12,'novikorisnik','pass123A',1);
/*!40000 ALTER TABLE `korisnikaccount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `objekat`
--

DROP TABLE IF EXISTS `objekat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `objekat` (
  `ObjekatID` int(11) NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(100) DEFAULT NULL,
  `BrojPregleda` int(11) DEFAULT NULL,
  `DatumObjave` datetime DEFAULT NULL,
  `Ocjena` varchar(5) DEFAULT NULL,
  `SrcSlika` varchar(1000) DEFAULT NULL,
  `SrcObjekat` varchar(1000) DEFAULT NULL,
  `KorisnikObjavioID` int(11) DEFAULT NULL,
  `Aktivan` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ObjekatID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objekat`
--

LOCK TABLES `objekat` WRITE;
/*!40000 ALTER TABLE `objekat` DISABLE KEYS */;
/*!40000 ALTER TABLE `objekat` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-18 16:06:37
