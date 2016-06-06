-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 06, 2016 at 11:27 PM
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
-- Table structure for table `administracija`
--

CREATE TABLE IF NOT EXISTS `administracija` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `brojPosjeta` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `administracija`
--

INSERT INTO `administracija` (`ID`, `brojPosjeta`) VALUES
(1, 114),
(2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE IF NOT EXISTS `komentar` (
  `Komentar_id` int(11) NOT NULL AUTO_INCREMENT,
  `ObjekatID` int(11) DEFAULT NULL,
  `Tekst` text,
  `AutorID` int(11) DEFAULT NULL,
  `Vrijeme` datetime DEFAULT NULL,
  `Aktivan` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Komentar_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`Komentar_id`, `ObjekatID`, `Tekst`, `AutorID`, `Vrijeme`, `Aktivan`) VALUES
(13, 30, 'Odlicno izgleda, samo malo smanji zum', 15, '2016-05-29 08:44:18', '1'),
(14, 30, 'Lijepo ti ovo izgleda', 18, '2016-05-30 01:50:16', '1'),
(15, 30, 'Malo ovaj zoom promijeni', 18, '2016-05-30 01:57:49', '1'),
(16, 30, 'Testni', 18, '2016-05-30 02:05:44', '1'),
(17, 30, 'Komentar novi', 0, '2016-06-03 03:58:37', '1'),
(18, 30, 'anonimni sda', 0, '2016-06-05 02:44:03', '1'),
(19, 30, 'TEst notifikacije', 15, '2016-06-06 11:19:39', '1');

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
  `BrojTelefona` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`korisnik_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korisnik_id`, `ime`, `prezime`, `datum`, `mail`, `profilnaSlikaID`, `korisnikAccID`, `Aktivan`, `BrojTelefona`) VALUES
(13, 'Kerim', 'Balic', '2016-05-19', 'kerimko@email.com', NULL, 15, 1, '062257026'),
(16, 'Kenan ', 'Prses ', '2016-05-30', 'kena@gmail.com  ', NULL, 18, 0, ' 062123123 '),
(17, 'Administrator', 'Administratorcic', '2016-06-01', 'admin@3dpteam.com', NULL, 19, 1, '061123456'),
(24, NULL, NULL, '2016-06-06', 'teest@tes.com', NULL, 26, 0, NULL),
(25, 'Test', 'Tetovic', '0000-00-00', 'emirhh@yahoo.com', NULL, 27, 0, '0622544'),
(26, 'Testni', 'Testovic', '2016-06-06', 'teest@tes.com', NULL, 28, 0, '022222');

-- --------------------------------------------------------

--
-- Table structure for table `korisnikaccount`
--

CREATE TABLE IF NOT EXISTS `korisnikaccount` (
  `korisnikAcc_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `rolaID` int(11) DEFAULT NULL,
  `Aktivan` int(11) DEFAULT NULL,
  PRIMARY KEY (`korisnikAcc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `korisnikaccount`
--

INSERT INTO `korisnikaccount` (`korisnikAcc_id`, `username`, `password`, `rolaID`, `Aktivan`) VALUES
(15, 'kerimko', '2168ad5e463d9accb215edaafa31c8d9', 0, 1),
(18, 'kenan      ', '2168ad5e463d9accb215edaafa31c8d9', 0, 0),
(19, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1),
(26, 'tete', '098f6bcd4621d373cade4e832627b4f6', 1, 0),
(27, 'test', '098f6bcd4621d373cade4e832627b4f6', 0, 0),
(28, 'test', '098f6bcd4621d373cade4e832627b4f6', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `objekat`
--

CREATE TABLE IF NOT EXISTS `objekat` (
  `ObjekatID` int(11) NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(100) DEFAULT NULL,
  `BrojPregleda` int(11) DEFAULT NULL,
  `DatumObjave` datetime DEFAULT NULL,
  `Ocjena` varchar(5) DEFAULT NULL,
  `SrcSlika` varchar(1000) DEFAULT NULL,
  `SrcObjekat` varchar(1000) DEFAULT NULL,
  `KorisnikObjavioID` int(11) DEFAULT NULL,
  `Aktivan` bit(1) DEFAULT NULL,
  `BrojNovihKomentara` int(11) DEFAULT NULL,
  `Opis` text,
  `MogucnostKomentara` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ObjekatID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `objekat`
--

INSERT INTO `objekat` (`ObjekatID`, `Naziv`, `BrojPregleda`, `DatumObjave`, `Ocjena`, `SrcSlika`, `SrcObjekat`, `KorisnikObjavioID`, `Aktivan`, `BrojNovihKomentara`, `Opis`, `MogucnostKomentara`) VALUES
(26, 'Medaljon', 33, '2016-05-29 08:26:58', '1', 'data/kerimko/Medaljon-29-05-2016-20-26-58/29-05-2016-20-26-58medallionCompleteMap.jpg', 'data/kerimko/Medaljon-29-05-2016-20-26-58/meda', 13, '1', 0, 'Ovo je jedan stari medaljon iskopina zapravo njegova', 0),
(29, 'Mac', 6, '2016-05-29 08:30:48', '1', 'data/kerimko/Mac-29-05-2016-20-30-48/29-05-2016-20-30-48gl.jpg', 'data/kerimko/Mac-29-05-2016-20-30-48/mac', 13, '1', 0, 'Mac iskopina', 0),
(30, 'Sjekira', 33, '2016-05-29 08:37:36', '1', 'data/kerimko/Sjekira-29-05-2016-20-37-36/29-05-2016-20-37-36godovi.jpg', 'data/kerimko/Sjekira-29-05-2016-20-37-36/axe', 13, '1', 0, 'Jedna stara sjekira isto iskopina', 1);

-- --------------------------------------------------------

--
-- Table structure for table `replika`
--

CREATE TABLE IF NOT EXISTS `replika` (
  `Replika_id` int(11) NOT NULL AUTO_INCREMENT,
  `KomentarID` int(11) DEFAULT NULL,
  `Tekst` text,
  `AutorID` int(11) DEFAULT NULL,
  `Vrijeme` datetime DEFAULT NULL,
  `Aktivan` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Replika_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `replika`
--

INSERT INTO `replika` (`Replika_id`, `KomentarID`, `Tekst`, `AutorID`, `Vrijeme`, `Aktivan`) VALUES
(9, 13, 'Znam, al napravit cu da vi mozete zumati i odzumati, jer nisu svi modeli u istoj velicini', 15, '2016-05-29 08:44:51', '1'),
(10, 13, 'replika', 0, '2016-06-03 03:55:30', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
