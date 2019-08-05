-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 06, 2019 at 12:32 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mga.db`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `getrandom`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getrandom` (OUT `randomNumber` INT)  BEGIN
  SELECT floor(rand()*100000000) INTO randomNumber;
end$$

--
-- Functions
--
DROP FUNCTION IF EXISTS `randomNumber`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `randomNumber` () RETURNS INT(50) RETURN floor(rand()*1000000)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `adminID` int(11) NOT NULL AUTO_INCREMENT,
  `adminName` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `motdepasse` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  PRIMARY KEY (`adminID`),
  UNIQUE KEY `adminName` (`adminName`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `adminName`, `email`, `nom`, `prenom`, `motdepasse`, `role`) VALUES
(1, 'admin', NULL, 'el amrani', 'chakir', '051487088', 'administrateur');

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `articleID` int(11) NOT NULL AUTO_INCREMENT,
  `articleNom` varchar(100) NOT NULL,
  `articlePrix` decimal(15,2) NOT NULL,
  `articlePrixRemise` decimal(15,2) DEFAULT NULL,
  `articleDescription` text,
  `articleMarque` varchar(100) DEFAULT 'N/A',
  `tauxRemise` float DEFAULT NULL,
  `remiseDisponible` bit(1) NOT NULL DEFAULT b'0',
  `unitesEnStock` int(11) NOT NULL DEFAULT '1',
  `unitesSurCommande` int(11) DEFAULT '0',
  `articleDisponible` bit(1) NOT NULL DEFAULT b'1',
  `niveau` int(11) DEFAULT '5',
  `dateAjoute` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `categorieID` int(11) NOT NULL,
  PRIMARY KEY (`articleID`),
  KEY `categorieID` (`categorieID`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`articleID`, `articleNom`, `articlePrix`, `articlePrixRemise`, `articleDescription`, `articleMarque`, `tauxRemise`, `remiseDisponible`, `unitesEnStock`, `unitesSurCommande`, `articleDisponible`, `niveau`, `dateAjoute`, `categorieID`) VALUES
(27, 'LENOVO 541', '5000.00', NULL, 'LENOVO 541', 'LENOVO', NULL, b'0', 2, 0, b'1', 5, '2019-07-09 17:38:17', 40),
(30, 'HP 640', '5000.00', '4500.00', 'HP 640', 'HP', 10, b'1', 2, 0, b'1', 5, '2019-07-09 17:38:56', 40),
(31, 'CAMERA HD SONY 14000', '6000.00', '3600.00', 'CAMERA HD SONY 14000', 'SONY', 40, b'1', 1, 0, b'1', 5, '2019-07-09 18:58:55', 31),
(32, 'Iphone6 S', '1500.00', '1350.00', 'Iphone6 S', 'Iphone', 10, b'1', 1, 0, b'1', 5, '2019-07-09 19:50:39', 36),
(34, 'LENOVO 541', '5000.00', '4500.00', 'LENOVO 541', 'LENOVO', 10, b'1', 2, 0, b'1', 5, '2019-07-09 17:38:17', 40),
(35, 'LENOVO 541', '5000.00', NULL, 'LENOVO 541', 'LENOVO', NULL, b'0', 2, 0, b'1', 5, '2019-07-09 17:38:17', 40),
(36, 'LENOVO 541', '5000.00', '4500.00', 'LENOVO 541', 'LENOVO', 10, b'1', 2, 0, b'1', 5, '2019-07-09 17:38:26', 40),
(38, 'HP 640', '5000.00', '4500.00', 'HP 640', 'HP', 10, b'1', 2, 0, b'1', 5, '2019-07-09 17:38:56', 40),
(39, 'CAMERA HD SONY 14000', '6000.00', '3600.00', 'CAMERA HD SONY 14000', 'SONY', 40, b'1', 1, 0, b'1', 5, '2019-07-09 18:58:55', 31),
(40, 'Iphone6 S', '1500.00', '1350.00', 'Iphone6 S', 'Iphone', 10, b'1', 1, 0, b'1', 5, '2019-07-09 19:50:39', 36),
(41, 'Samsung', '2500.00', '2000.00', 'Samsung', 'Samsung', 20, b'1', 1, 0, b'1', 5, '2019-07-09 19:51:25', 36),
(42, 'LENOVO 541', '5000.00', '4500.00', 'LENOVO 541', 'LENOVO', 10, b'1', 2, 0, b'1', 5, '2019-07-09 17:38:17', 40);

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `categorieID` int(11) NOT NULL AUTO_INCREMENT,
  `categorieNom` varchar(100) NOT NULL,
  `description` text,
  `active` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`categorieID`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`categorieID`, `categorieNom`, `description`, `active`) VALUES
(36, 'Tablettes &amp; Smartphones', 'Tablettes &amp; Smartphones', b'1'),
(41, 'Accessoires &amp; Périph', 'Accessoires &amp; Périphériques', b'1'),
(57, 'Impression', 'Impression', b'1'),
(31, 'Image & Son', 'Image & Son', b'1'),
(32, 'Serveurs', 'Serveurs', b'1'),
(33, 'Logiciel', 'Logiciel', b'1'),
(34, 'Bonnes affaires', 'Bonnes affaires', b'1'),
(35, 'Réseaux', 'Réseaux', b'1'),
(40, 'PC Portable', 'PC Portable', b'1'),
(37, 'PC Bureau', 'PC Bureau', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `clientID` int(11) NOT NULL AUTO_INCREMENT,
  `clientUserName` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `ville` varchar(100) NOT NULL,
  `emailValid` bit(1) NOT NULL DEFAULT b'0',
  `codeEmail` varchar(100) DEFAULT NULL,
  `codePostal` int(11) DEFAULT NULL,
  `telephone` varchar(100) NOT NULL,
  `motdepasse` varchar(100) NOT NULL,
  `questionSecurite` varchar(100) NOT NULL,
  `reponseQuestion` varchar(100) NOT NULL,
  `panierID` int(11) DEFAULT NULL,
  PRIMARY KEY (`clientID`),
  UNIQUE KEY `clientUserName` (`clientUserName`),
  KEY `fk_panierID_client` (`panierID`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`clientID`, `clientUserName`, `prenom`, `nom`, `email`, `adresse`, `ville`, `emailValid`, `codeEmail`, `codePostal`, `telephone`, `motdepasse`, `questionSecurite`, `reponseQuestion`, `panierID`) VALUES
(46, 'chou500', 'chakir', 'el amrani', 'elamrani.sv.laza@gmail.com', 'tanger', 'tanger', b'1', '247001', 90002, '0659630023', '$2y$10$29PASy6y1i15UatstpF0teWAvGHl7n6WA0DPmoMbuWGOc2iskoSDO', 'Quel était le nom de votre premier animal ?', 'orio', 7);

--
-- Triggers `client`
--
DROP TRIGGER IF EXISTS `randomNumber`;
DELIMITER $$
CREATE TRIGGER `randomNumber` BEFORE INSERT ON `client` FOR EACH ROW set new.codeEmail=randomNumber()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `clientID` int(11) NOT NULL,
  `articleID` int(11) NOT NULL,
  `accepte` bit(1) NOT NULL DEFAULT b'0',
  `niveau` int(11) NOT NULL DEFAULT '1',
  `commentaire` text NOT NULL,
  `titre` varchar(100) DEFAULT NULL,
  `dateComm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`clientID`,`articleID`),
  KEY `fk_articleID_commentaire` (`articleID`),
  KEY `fk_clientID_commentaire` (`clientID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commentaire`
--

INSERT INTO `commentaire` (`clientID`, `articleID`, `accepte`, `niveau`, `commentaire`, `titre`, `dateComm`) VALUES
(11, 32, b'1', 3, 'Excellent', 'Excellent', '2019-07-27 19:09:29'),
(12, 27, b'1', 4, 'sqdqsd', 'sdqqsd', '2019-07-27 19:25:06'),
(13, 27, b'1', 4, 'qsdqsd', 'qdsqds', '2019-07-27 02:20:25'),
(38, 27, b'1', 3, 'Excellent', 'Excellent', '2019-07-27 19:09:29'),
(41, 27, b'1', 4, 'sqdqsd', 'sdqqsd', '2019-07-27 19:25:06'),
(42, 27, b'1', 4, 'qsdqsd', 'qdsqds', '2019-07-27 02:20:25');

-- --------------------------------------------------------

--
-- Table structure for table `couleurarticle`
--

DROP TABLE IF EXISTS `couleurarticle`;
CREATE TABLE IF NOT EXISTS `couleurarticle` (
  `nomCouleur` varchar(100) NOT NULL,
  `articleID` int(11) NOT NULL,
  PRIMARY KEY (`nomCouleur`,`articleID`),
  KEY `fk_articleID_couleurarticle` (`articleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `couleurarticle`
--

INSERT INTO `couleurarticle` (`nomCouleur`, `articleID`) VALUES
('Blue', 27);

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

DROP TABLE IF EXISTS `coupon`;
CREATE TABLE IF NOT EXISTS `coupon` (
  `couponID` int(11) NOT NULL AUTO_INCREMENT,
  `couponNom` varchar(100) NOT NULL,
  `couponCode` varchar(100) NOT NULL,
  `valide` bit(1) NOT NULL DEFAULT b'1',
  `taux` float NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `appliquerAu` text,
  `filter` varchar(100) DEFAULT NULL,
  `dateAjoute` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`couponID`),
  UNIQUE KEY `couponCode` (`couponCode`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`couponID`, `couponNom`, `couponCode`, `valide`, `taux`, `dateDebut`, `dateFin`, `appliquerAu`, `filter`, `dateAjoute`) VALUES
(3, 'ZZZZ', '7KUFY7', b'1', 44, '2019-08-05', '2019-08-29', 'tous', 'tous', '2019-08-05 08:36:43'),
(4, '213', '1P30VU', b'1', 22, '2019-08-05', '2019-08-21', 'tous', 'tous', '2019-08-05 08:36:52');

-- --------------------------------------------------------

--
-- Table structure for table `coupondetails`
--

DROP TABLE IF EXISTS `coupondetails`;
CREATE TABLE IF NOT EXISTS `coupondetails` (
  `articleID` int(11) NOT NULL,
  `couponID` int(11) NOT NULL,
  PRIMARY KEY (`couponID`,`articleID`),
  KEY `fk_articleID_coupondetails` (`articleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coupondetails`
--

INSERT INTO `coupondetails` (`articleID`, `couponID`) VALUES
(27, 3),
(27, 4),
(30, 3),
(30, 4),
(31, 3),
(31, 4),
(32, 3),
(32, 4),
(34, 3),
(34, 4),
(35, 3),
(35, 4),
(36, 3),
(36, 4),
(38, 3),
(38, 4),
(39, 3),
(39, 4),
(40, 3),
(40, 4),
(41, 3),
(41, 4),
(42, 3),
(42, 4);

-- --------------------------------------------------------

--
-- Table structure for table `demande`
--

DROP TABLE IF EXISTS `demande`;
CREATE TABLE IF NOT EXISTS `demande` (
  `demandeID` int(11) NOT NULL AUTO_INCREMENT,
  `paiementDate` datetime NOT NULL,
  `paye` int(11) DEFAULT NULL,
  `termine` bit(1) NOT NULL DEFAULT b'0',
  `dateDemende` datetime NOT NULL,
  `dateLivraison` datetime DEFAULT NULL,
  `dateEnvoi` datetime DEFAULT NULL,
  `poidsTotal` decimal(15,3) DEFAULT NULL,
  PRIMARY KEY (`demandeID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `demandedetails`
--

DROP TABLE IF EXISTS `demandedetails`;
CREATE TABLE IF NOT EXISTS `demandedetails` (
  `demandeDetailsID` int(11) NOT NULL AUTO_INCREMENT,
  `demandeID` int(11) NOT NULL,
  `articleID` int(11) NOT NULL,
  PRIMARY KEY (`demandeDetailsID`),
  KEY `demandeID` (`demandeID`),
  KEY `articleID` (`articleID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `favoridetails`
--

DROP TABLE IF EXISTS `favoridetails`;
CREATE TABLE IF NOT EXISTS `favoridetails` (
  `articleID` int(11) NOT NULL,
  `clientID` int(11) NOT NULL,
  `dateAjoute` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`articleID`,`clientID`),
  KEY `fk_clientID_favoridetails` (`clientID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favoridetails`
--

INSERT INTO `favoridetails` (`articleID`, `clientID`, `dateAjoute`) VALUES
(27, 40, '2019-07-27 20:17:30'),
(30, 40, '2019-07-27 22:54:55'),
(31, 40, '2019-07-26 19:38:54'),
(31, 46, '2019-08-05 23:41:57'),
(32, 40, '2019-07-27 19:51:01'),
(39, 46, '2019-08-05 22:55:06'),
(41, 46, '2019-08-05 22:55:04'),
(42, 46, '2019-08-05 22:55:05');

-- --------------------------------------------------------

--
-- Table structure for table `imagearticle`
--

DROP TABLE IF EXISTS `imagearticle`;
CREATE TABLE IF NOT EXISTS `imagearticle` (
  `imageArticleNom` varchar(256) NOT NULL,
  `articleID` int(11) NOT NULL,
  PRIMARY KEY (`imageArticleNom`,`articleID`),
  KEY `fk_articleID_imagearticle` (`articleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `imagearticle`
--

INSERT INTO `imagearticle` (`imageArticleNom`, `articleID`) VALUES
('product01.png', 27),
('product06.png', 27),
('product08.png', 27),
('shop02.png', 31),
('product07.png', 32),
('product04.png', 33),
('download.png', 43),
('download.png', 44);

-- --------------------------------------------------------

--
-- Table structure for table `livraison`
--

DROP TABLE IF EXISTS `livraison`;
CREATE TABLE IF NOT EXISTS `livraison` (
  `livraisonID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`livraisonID`)
) ENGINE=MyISAM AUTO_INCREMENT=1002 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `livraison`
--

INSERT INTO `livraison` (`livraisonID`) VALUES
(1001);

-- --------------------------------------------------------

--
-- Table structure for table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `paiementID` int(11) NOT NULL AUTO_INCREMENT,
  `paiementType` varchar(100) NOT NULL,
  `permis` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`paiementID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `panierID` int(11) NOT NULL AUTO_INCREMENT,
  `dateAjoute` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`panierID`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `panier`
--

INSERT INTO `panier` (`panierID`, `dateAjoute`) VALUES
(5, '2019-07-22 16:09:52'),
(6, '2019-07-22 16:54:51'),
(7, '2019-08-01 07:30:48'),
(8, '2019-08-05 09:36:25'),
(9, '2019-08-05 09:37:49'),
(10, '2019-08-05 09:38:38'),
(11, '2019-08-05 09:57:13'),
(12, '2019-08-05 09:57:32'),
(13, '2019-08-05 09:58:06'),
(14, '2019-08-05 09:58:29'),
(15, '2019-08-05 09:58:33'),
(16, '2019-08-05 09:58:51'),
(17, '2019-08-05 09:59:04'),
(18, '2019-08-05 09:59:08'),
(19, '2019-08-05 10:48:06'),
(20, '2019-08-05 10:48:43'),
(21, '2019-08-05 10:49:16'),
(22, '2019-08-05 10:49:27'),
(23, '2019-08-05 10:49:33'),
(24, '2019-08-05 10:50:14'),
(25, '2019-08-05 10:51:19'),
(26, '2019-08-05 10:52:04'),
(27, '2019-08-05 10:52:08'),
(28, '2019-08-05 10:52:21'),
(29, '2019-08-05 10:54:43'),
(30, '2019-08-05 10:54:47'),
(31, '2019-08-05 10:55:11'),
(32, '2019-08-05 10:56:14'),
(33, '2019-08-05 10:56:59'),
(34, '2019-08-05 10:57:39'),
(35, '2019-08-05 10:58:37'),
(36, '2019-08-05 10:58:50'),
(37, '2019-08-05 10:59:09'),
(38, '2019-08-05 10:59:26'),
(39, '2019-08-05 10:59:39'),
(40, '2019-08-05 11:00:06'),
(41, '2019-08-05 11:01:05'),
(42, '2019-08-05 11:01:16'),
(43, '2019-08-05 11:01:20'),
(44, '2019-08-05 11:01:56'),
(45, '2019-08-05 11:02:03'),
(46, '2019-08-05 11:02:58'),
(47, '2019-08-05 11:03:13'),
(48, '2019-08-05 11:03:37'),
(49, '2019-08-05 11:03:50'),
(50, '2019-08-05 11:06:11'),
(51, '2019-08-05 11:06:28'),
(52, '2019-08-05 11:06:50'),
(53, '2019-08-05 11:07:58'),
(54, '2019-08-05 11:08:12'),
(55, '2019-08-05 11:08:59'),
(56, '2019-08-05 11:09:09'),
(57, '2019-08-05 11:10:26'),
(58, '2019-08-05 11:10:36'),
(59, '2019-08-05 11:10:43'),
(60, '2019-08-05 11:10:59'),
(61, '2019-08-05 11:11:05'),
(62, '2019-08-05 11:11:23'),
(63, '2019-08-05 11:11:31'),
(64, '2019-08-05 11:11:39'),
(65, '2019-08-05 11:44:32'),
(66, '2019-08-05 11:44:46'),
(67, '2019-08-05 11:47:14'),
(68, '2019-08-05 11:47:44'),
(69, '2019-08-05 11:47:54'),
(70, '2019-08-05 11:48:02'),
(71, '2019-08-05 11:48:09'),
(72, '2019-08-05 11:54:43'),
(73, '2019-08-05 12:35:07'),
(74, '2019-08-05 12:35:41'),
(75, '2019-08-05 12:35:48'),
(76, '2019-08-05 12:36:03'),
(77, '2019-08-05 12:36:55'),
(78, '2019-08-05 12:37:04'),
(79, '2019-08-05 12:37:15'),
(80, '2019-08-05 12:38:10'),
(81, '2019-08-05 12:38:16'),
(82, '2019-08-05 12:38:45'),
(83, '2019-08-05 12:39:22'),
(84, '2019-08-05 12:39:34'),
(85, '2019-08-05 12:40:37'),
(86, '2019-08-05 12:40:59'),
(87, '2019-08-05 12:41:09'),
(88, '2019-08-05 12:41:35'),
(89, '2019-08-05 12:43:58'),
(90, '2019-08-05 12:44:32'),
(91, '2019-08-05 12:44:50'),
(92, '2019-08-05 12:45:19'),
(93, '2019-08-05 12:45:26'),
(94, '2019-08-05 12:45:47'),
(95, '2019-08-05 12:46:07'),
(96, '2019-08-05 12:47:57'),
(97, '2019-08-05 12:48:24'),
(98, '2019-08-05 12:48:50'),
(99, '2019-08-05 12:49:18'),
(100, '2019-08-05 12:50:47'),
(101, '2019-08-05 12:50:53'),
(102, '2019-08-05 12:50:56'),
(103, '2019-08-05 12:51:17'),
(104, '2019-08-05 12:51:29'),
(105, '2019-08-05 12:51:54'),
(106, '2019-08-05 12:52:54'),
(107, '2019-08-05 12:53:47'),
(108, '2019-08-05 12:54:27'),
(109, '2019-08-05 12:54:38'),
(110, '2019-08-05 13:00:47'),
(111, '2019-08-05 13:01:19'),
(112, '2019-08-05 13:01:45'),
(113, '2019-08-05 13:01:59'),
(114, '2019-08-05 13:02:22'),
(115, '2019-08-05 13:03:35'),
(116, '2019-08-05 13:04:04'),
(117, '2019-08-05 13:06:22'),
(118, '2019-08-05 13:07:05'),
(119, '2019-08-05 13:07:38'),
(120, '2019-08-05 13:07:56'),
(121, '2019-08-05 13:08:28'),
(122, '2019-08-05 13:08:51'),
(123, '2019-08-05 13:09:26'),
(124, '2019-08-05 13:09:45'),
(125, '2019-08-05 13:10:50'),
(126, '2019-08-05 13:16:38'),
(127, '2019-08-05 13:17:26'),
(128, '2019-08-05 13:18:14'),
(129, '2019-08-05 13:18:25');

-- --------------------------------------------------------

--
-- Table structure for table `panierdetails`
--

DROP TABLE IF EXISTS `panierdetails`;
CREATE TABLE IF NOT EXISTS `panierdetails` (
  `panierID` int(11) NOT NULL,
  `articleID` int(11) NOT NULL,
  `quantite` int(11) NOT NULL DEFAULT '1',
  `dateAjoute` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`panierID`,`articleID`),
  KEY `fk_articleID_panierdetails` (`articleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `panierdetails`
--

INSERT INTO `panierdetails` (`panierID`, `articleID`, `quantite`, `dateAjoute`) VALUES
(7, 27, 1, '2019-08-06 00:30:25'),
(7, 31, 10, '2019-08-05 23:41:43'),
(7, 32, 1, '2019-08-06 00:30:28');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `fk_panierID_client` FOREIGN KEY (`panierID`) REFERENCES `panier` (`panierID`);

--
-- Constraints for table `couleurarticle`
--
ALTER TABLE `couleurarticle`
  ADD CONSTRAINT `fk_articleID_couleurarticle` FOREIGN KEY (`articleID`) REFERENCES `article` (`articleID`) ON DELETE CASCADE;

--
-- Constraints for table `coupondetails`
--
ALTER TABLE `coupondetails`
  ADD CONSTRAINT `fk_articleID_coupondetails` FOREIGN KEY (`articleID`) REFERENCES `article` (`articleID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_couponID_coupondetails` FOREIGN KEY (`couponID`) REFERENCES `coupon` (`couponID`) ON DELETE CASCADE;

--
-- Constraints for table `panierdetails`
--
ALTER TABLE `panierdetails`
  ADD CONSTRAINT `fk_articleID_panierdetails` FOREIGN KEY (`articleID`) REFERENCES `article` (`articleID`),
  ADD CONSTRAINT `fk_panierID_panierdetails` FOREIGN KEY (`panierID`) REFERENCES `panier` (`panierID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
