-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 04, 2016 at 12:21 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `3dpteam`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE IF NOT EXISTS `korisnik` (
  `korisnik_id` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(50) DEFAULT NULL,
  `prezime` varchar(50) DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `profilnaSlikaID` int(11) DEFAULT NULL,
  `korisnikAccID` int(11) DEFAULT NULL,
  `Aktivan` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`korisnik_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korisnik_id`, `ime`, `prezime`, `datum`, `mail`, `profilnaSlikaID`, `korisnikAccID`, `Aktivan`) VALUES
(4, NULL, NULL, '2016-03-31', 'balickerim@hotmail.com', NULL, 6, 1),
(7, 'Kenan', 'Prses', '2016-04-02', 'kena@gmail.com', NULL, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `korisnikaccount`
--

CREATE TABLE IF NOT EXISTS `korisnikaccount` (
  `korisnikAcc_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `rolaID` int(11) DEFAULT NULL,
  PRIMARY KEY (`korisnikAcc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `korisnikaccount`
--

INSERT INTO `korisnikaccount` (`korisnikAcc_id`, `username`, `password`, `rolaID`) VALUES
(6, 'kerim', 'test', 1),
(9, 'kenan', 'test', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
