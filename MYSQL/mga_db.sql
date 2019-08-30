-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 30, 2019 at 03:36 PM
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
  `articlePrix` double NOT NULL,
  `articlePrixRemise` double DEFAULT NULL,
  `articleDescription` text,
  `articleMarque` varchar(100) DEFAULT 'N/A',
  `tauxRemise` float DEFAULT NULL,
  `remiseDisponible` bit(1) NOT NULL DEFAULT b'0',
  `unitesEnStock` int(11) NOT NULL DEFAULT '1',
  `unitesCommandees` int(11) DEFAULT '0',
  `articleDisponible` bit(1) NOT NULL DEFAULT b'1',
  `niveau` int(11) DEFAULT '5',
  `dateAjoute` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `categorieID` int(11) NOT NULL,
  PRIMARY KEY (`articleID`),
  UNIQUE KEY `articleNom` (`articleNom`),
  KEY `categorieID` (`categorieID`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`articleID`, `articleNom`, `articlePrix`, `articlePrixRemise`, `articleDescription`, `articleMarque`, `tauxRemise`, `remiseDisponible`, `unitesEnStock`, `unitesCommandees`, `articleDisponible`, `niveau`, `dateAjoute`, `categorieID`) VALUES
(55, 'Samsung 8440', 2500, 2000, 'RAM 2 GB\nCPU 2.6 GHZ', 'Samsung', 20, b'1', 5, 0, b'1', 5, '2019-08-21 14:48:16', 36),
(56, 'PC HP 5471', 5000, NULL, 'RAM 8GB\nGPU INTEL HD\n', 'HP', NULL, b'0', 5, 0, b'1', 5, '2019-08-22 10:57:58', 40);

--
-- Triggers `article`
--
DROP TRIGGER IF EXISTS `notification_qty_stock_insuffisante_trigger`;
DELIMITER $$
CREATE TRIGGER `notification_qty_stock_insuffisante_trigger` BEFORE UPDATE ON `article` FOR EACH ROW BEGIN

	DECLARE article_nom varchar(100);
    set @article_nom = new.articleNom;

    IF (NEW.unitesEnStock = 0)  THEN
    
      INSERT INTO notification VALUES(null, concat("Stock Insuffissante Pour l'article [ ", @article_nom, " ]"), default, 'stock', default );
      
     END IF;
     
end
$$
DELIMITER ;

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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`categorieID`, `categorieNom`, `description`, `active`) VALUES
(31, 'Image & Son', 'Image & Son', b'1'),
(32, 'Serveurs', 'Serveurs', b'1'),
(34, 'Impression', 'Impression', b'1'),
(35, 'Réseaux', 'Réseaux', b'1'),
(36, 'Tablettes &amp; Smartphones', 'Tablettes &amp; Smartphones', b'1'),
(37, 'PC Bureau', 'PC Bureau', b'1'),
(40, 'PC Portable', 'PC Portable', b'1'),
(41, 'Accessoires &amp; Périph', 'Accessoires &amp; Périphériques', b'1');

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
  `codeRec` varchar(100) DEFAULT NULL,
  `codePostal` int(11) DEFAULT NULL,
  `telephone` varchar(100) NOT NULL,
  `motdepasse` varchar(100) NOT NULL,
  `questionSecurite` varchar(100) NOT NULL,
  `reponseQuestion` varchar(100) NOT NULL,
  `panierID` int(11) DEFAULT NULL,
  PRIMARY KEY (`clientID`),
  UNIQUE KEY `clientUserName` (`clientUserName`),
  KEY `fk_panierID_client` (`panierID`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`clientID`, `clientUserName`, `prenom`, `nom`, `email`, `adresse`, `ville`, `emailValid`, `codeEmail`, `codeRec`, `codePostal`, `telephone`, `motdepasse`, `questionSecurite`, `reponseQuestion`, `panierID`) VALUES
(46, 'chou500', 'EL AMRANI', 'CHAKIR', 'elamrani.sv.laza@gmail.com', 'BNI MAKADA', 'Tanger', b'0', '247001', 'J98JGWU28HFXNVOXKNCEHFXJPCDZ9QT3KRLG', 90002, '0651487088', '$2y$10$bSlqi8xJEeyek62yrnleie6eo4r3XRdo6anKBwq/RomgU0Pq0/SFi', 'Quel était le nom de votre premier animal ?', 'orioo', 130),
(63, 'ahmed', 'ahmed', 'el amrani', 'chakir_alhoceima_rifi8@hotmail.fr', 'tanger', 'casa', b'0', '928322', 'WFBP8J8GQY0P23Y6E7JG2PZMIC6PDI3TTDC7', 445585, '+212144710547', '$2y$10$MOOoqR0/lknqaALxuB41b.FB67cmvO3gsNHolD2LmVm.tdek5Vqt2', 'Quel était le nom de votre premier animal ?', 'oodf', 133),
(77, 'qsdqsdqs', 'dsqqdsqdqs', 'dqsdsq', 'elamrani_ch@hotmail.com', 'Lyon', 'casa', b'0', '527005', 'P3P15YQ0X277GIS55EZIH2DWK8GWHES031KR', 90002, '0693792055', '$2y$10$wIfFm7Wdz8eKzvwVjV0F2uQT0tavcOI8qvgllaKOU3MXHre72i4Gu', 'Quel était le nom de votre premier animal ?', 'qsdqsdqs', NULL);

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
-- Table structure for table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `commandeID` int(11) NOT NULL AUTO_INCREMENT,
  `clientID` int(11) NOT NULL,
  `commandeDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL,
  `nbrArticles` int(11) NOT NULL,
  `totalApayer` float NOT NULL,
  `typeLivraison` varchar(100) NOT NULL,
  `couponUtilise` bit(1) DEFAULT b'0',
  `vu` bit(1) DEFAULT b'0',
  PRIMARY KEY (`commandeID`),
  KEY `fk_clientID_commande` (`clientID`)
) ENGINE=InnoDB AUTO_INCREMENT=10109 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`commandeID`, `clientID`, `commandeDate`, `status`, `nbrArticles`, `totalApayer`, `typeLivraison`, `couponUtilise`, `vu`) VALUES
(10108, 46, '2019-08-21 16:07:30', 0, 1, 232, 'gratuit', b'0', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `commandedetails`
--

DROP TABLE IF EXISTS `commandedetails`;
CREATE TABLE IF NOT EXISTS `commandedetails` (
  `commandeID` int(11) NOT NULL,
  `articleID` int(11) NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  `couleur` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`commandeID`,`articleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commandedetails`
--

INSERT INTO `commandedetails` (`commandeID`, `articleID`, `quantite`, `couleur`) VALUES
(10108, 55, 1, 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `commentaireID` int(11) NOT NULL AUTO_INCREMENT,
  `clientID` int(11) NOT NULL,
  `articleID` int(11) NOT NULL,
  `accepte` bit(1) NOT NULL DEFAULT b'0',
  `niveau` int(11) DEFAULT NULL,
  `commentaire` text NOT NULL,
  `titre` text,
  `dateComm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`commentaireID`),
  KEY `fk_articleID_commentaire` (`articleID`),
  KEY `fk_clientID_commentaire` (`clientID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
('Blue', 55),
('Noir', 55),
('Noir', 56);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`couponID`, `couponNom`, `couponCode`, `valide`, `taux`, `dateDebut`, `dateFin`, `appliquerAu`, `filter`, `dateAjoute`) VALUES
(1, 'COUPON HP', 'N022YV', b'1', 40, '2019-08-13', '2019-08-30', 'tous', 'tous', '2019-08-13 04:13:40');

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
(32, 40, '2019-07-27 19:51:01'),
(46, 46, '2019-08-20 12:19:24'),
(47, 46, '2019-08-20 12:21:36'),
(48, 46, '2019-08-20 12:23:00'),
(50, 46, '2019-08-20 12:27:09');

-- --------------------------------------------------------

--
-- Table structure for table `imagearticle`
--

DROP TABLE IF EXISTS `imagearticle`;
CREATE TABLE IF NOT EXISTS `imagearticle` (
  `imageArticleNom` varchar(512) NOT NULL,
  `articleID` int(11) NOT NULL,
  `principale` bit(1) DEFAULT b'0',
  PRIMARY KEY (`imageArticleNom`,`articleID`),
  KEY `fk_articleID_imagearticle` (`articleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `imagearticle`
--

INSERT INTO `imagearticle` (`imageArticleNom`, `articleID`, `principale`) VALUES
('413pD2TNh8L._SX466_.jpg', 55, b'1'),
('hp-pc-portable-17-ca0037nf-17-3-hd-amd-e2-r.jpg', 56, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `livraison`
--

DROP TABLE IF EXISTS `livraison`;
CREATE TABLE IF NOT EXISTS `livraison` (
  `livraisonID` int(11) NOT NULL AUTO_INCREMENT,
  `commandeID` int(11) NOT NULL,
  `confirmationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`livraisonID`,`commandeID`),
  KEY `fk_commandeID_livraison` (`commandeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `notID` int(11) NOT NULL AUTO_INCREMENT,
  `titre` text,
  `dateNot` datetime DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(100) DEFAULT NULL,
  `vu` bit(1) DEFAULT b'0',
  PRIMARY KEY (`notID`)
) ENGINE=MyISAM AUTO_INCREMENT=125 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notID`, `titre`, `dateNot`, `type`, `vu`) VALUES
(79, 'PHPMailer erreur : => SMTP connect() failed. https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting', '2019-08-20 21:08:52', 'erreur[php_mailer]', b'1'),
(78, 'Nouveau Client Enregistré', '2019-08-20 21:02:36', 'client', b'1'),
(77, 'PHPMailer erreur : => SMTP connect() failed. https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting', '2019-08-20 20:50:10', 'erreur[php_mailer]', b'1'),
(76, 'PHPMailer erreur : => SMTP connect() failed. https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting', '2019-08-20 20:45:42', 'erreur[php_mailer]', b'1'),
(75, 'PHPMailer erreur : => SMTP connect() failed. https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting', '2019-08-20 20:19:41', 'erreur[php_mailer]', b'1'),
(74, 'PHPMailer erreur : => SMTP connect() failed. https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting', '2019-08-20 20:13:21', 'erreur[php_mailer]', b'1'),
(73, 'PHPMailer erreur : => SMTP connect() failed. https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting', '2019-08-20 20:12:29', 'erreur[php_mailer]', b'1'),
(72, 'PHPMailer erreur : => SMTP connect() failed. https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting', '2019-08-20 20:09:39', 'erreur[php_mailer]', b'1'),
(71, 'PHPMailer erreur : => SMTP connect() failed. https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting', '2019-08-20 20:09:06', 'erreur[php_mailer]', b'1'),
(70, 'PHPMailer erreur : => SMTP connect() failed. https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting', '2019-08-20 18:40:50', 'erreur[php_mailer]', b'1'),
(69, 'PHPMailer erreur : => SMTP Error: Could not authenticate.', '2019-08-20 18:10:17', 'erreur[php_mailer]', b'1'),
(68, 'PHPMailer erreur : => SMTP connect() failed. https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting', '2019-08-20 18:09:13', 'erreur[php_mailer]', b'1'),
(67, 'PHPMailer erreur : => SMTP Error: Could not authenticate.', '2019-08-20 18:07:52', 'erreur[php_mailer]', b'1'),
(66, 'PHPMailer erreur : => SMTP Error: Could not authenticate.', '2019-08-20 18:06:43', 'erreur[php_mailer]', b'1'),
(65, 'Nouveau Commande de [CHAKIR EL AMRANI]', '2019-08-20 15:25:56', 'commande', b'1'),
(64, 'Nouveau Commande de [CHAKIR EL AMRANI]', '2019-08-20 12:16:26', 'commande', b'1'),
(63, 'Nouveau Commande de [CHAKIR EL AMRANI]', '2019-08-20 12:05:42', 'commande', b'1'),
(62, 'Nouveau Commande de [CHAKIR EL AMRANI]', '2019-08-20 12:03:08', 'commande', b'1'),
(61, 'Nouveau Commentaire de [CHAKIR EL AMRANI]', '2019-08-20 12:02:14', 'commentaire', b'1'),
(80, 'PHPMailer erreur : => SMTP Error: Could not authenticate.', '2019-08-20 21:10:01', 'erreur[php_mailer]', b'1'),
(81, 'PHPMailer erreur : => SMTP connect() failed. https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting', '2019-08-20 21:17:50', 'erreur[php_mailer]', b'1'),
(82, 'PHPMailer erreur : => SMTP connect() failed. https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting', '2019-08-20 21:19:17', 'erreur[php_mailer]', b'1'),
(83, 'Nouveau Client Enregistré', '2019-08-20 21:20:17', 'client', b'1'),
(84, '', '2019-08-20 22:11:26', 'erreur', b'1'),
(85, 'Nouveau Commentaire de [CHAKIR EL AMRANI]', '2019-08-20 22:48:40', 'commentaire', b'1'),
(86, 'Stock Insuffissante Pour l\'article [ Handphones 2055 HD ]', '2019-08-21 11:31:16', 'stock', b'1'),
(87, 'Stock Insuffissante Pour l\'article [ Handphones 2055 HD ]', '2019-08-21 11:58:30', 'stock', b'1'),
(88, 'Stock Insuffissante Pour l\'article [ Handphones 2055 HD ]', '2019-08-21 11:59:01', 'stock', b'1'),
(89, 'Stock Insuffissante Pour l\'article [ Handphones 2055 HD ]', '2019-08-21 12:06:52', 'stock', b'1'),
(90, 'Stock Insuffissante Pour l\'article [ Handphones 2055 HD ]', '2019-08-21 12:09:29', 'stock', b'1'),
(91, 'Stock Insuffissante Pour l\'article [ Handphones 2055 HD ]', '2019-08-21 12:18:48', 'stock', b'1'),
(92, 'Nouveau Commande de [CHAKIR EL AMRANI]', '2019-08-21 12:52:36', 'commande', b'1'),
(93, 'Nouveau Commande de [CHAKIR EL AMRANI]', '2019-08-21 12:54:52', 'commande', b'1'),
(94, 'Nouveau Commande de [CHAKIR EL AMRANI]', '2019-08-21 12:55:57', 'commande', b'1'),
(95, 'Nouveau Commande de [CHAKIR EL AMRANI]', '2019-08-21 14:14:37', 'commande', b'1'),
(96, 'Nouveau Commande de [CHAKIR EL AMRANI]', '2019-08-21 14:29:32', 'commande', b'1'),
(97, 'Nouveau Commande de [CHAKIR EL AMRANI]', '2019-08-21 14:36:42', 'commande', b'1'),
(98, 'Nouveau Commande de [CHAKIR EL AMRANI]', '2019-08-21 14:40:51', 'commande', b'1'),
(99, 'Nouveau Commande de [CHAKIR EL AMRANI]', '2019-08-21 14:43:10', 'commande', b'1'),
(100, 'Nouveau Commande de [CHAKIR EL AMRANI]', '2019-08-21 14:45:55', 'commande', b'1'),
(101, 'Nouveau Commande de [CHAKIR EL AMRANI]', '2019-08-21 14:47:08', 'commande', b'1'),
(102, 'Nouveau Commande de [CHAKIR EL AMRANI]', '2019-08-21 14:49:29', 'commande', b'1'),
(103, 'Nouveau Commande de [CHAKIR EL AMRANI]', '2019-08-21 14:56:45', 'commande', b'1'),
(104, 'Nouveau Commande de [CHAKIR EL AMRANI]', '2019-08-21 15:10:11', 'commande', b'1'),
(105, 'Nouveau Commande de [CHAKIR EL AMRANI]', '2019-08-21 16:07:30', 'commande', b'1'),
(106, 'Stock Insuffissante Pour l\'article [ dqsdqsdsq ]', '2019-08-21 16:13:24', 'stock', b'1'),
(107, 'PHPMailer erreur : => SMTP Error: Could not authenticate.', '2019-08-22 11:11:26', 'erreur[php_mailer]', b'1'),
(108, 'PHPMailer erreur : => SMTP Error: Could not authenticate.', '2019-08-22 11:12:15', 'erreur[php_mailer]', b'1'),
(109, 'PHPMailer erreur : => SMTP Error: Could not authenticate.', '2019-08-22 11:13:55', 'erreur[php_mailer]', b'1'),
(110, 'PHPMailer erreur : => SMTP Error: Could not authenticate.', '2019-08-22 11:17:10', 'erreur[php_mailer]', b'1'),
(111, '', '2019-08-22 11:17:40', 'erreur', b'1'),
(112, 'PHPMailer erreur : => SMTP Error: Could not authenticate.', '2019-08-22 11:19:02', 'erreur[php_mailer]', b'1'),
(113, 'PHPMailer erreur : => SMTP Error: Could not authenticate.', '2019-08-22 11:19:29', 'erreur[php_mailer]', b'1'),
(114, 'PHPMailer erreur : => SMTP Error: Could not authenticate.', '2019-08-22 11:22:36', 'erreur[php_mailer]', b'1'),
(115, 'PHPMailer erreur : => SMTP Error: Could not authenticate.', '2019-08-22 11:23:19', 'erreur[php_mailer]', b'1'),
(116, 'PHPMailer erreur : => SMTP Error: Could not authenticate.', '2019-08-22 11:23:29', 'erreur[php_mailer]', b'1'),
(117, 'PHPMailer erreur : => SMTP Error: Could not authenticate.', '2019-08-22 11:24:35', 'erreur[php_mailer]', b'1'),
(118, 'PHPMailer erreur : => SMTP Error: Could not authenticate.', '2019-08-22 11:25:28', 'erreur[php_mailer]', b'1'),
(119, 'PHPMailer erreur : => SMTP Error: Could not authenticate.', '2019-08-22 11:32:55', 'erreur[php_mailer]', b'1'),
(120, 'PHPMailer erreur : => SMTP Error: Could not authenticate.', '2019-08-22 11:33:19', 'erreur[php_mailer]', b'1'),
(121, 'PHPMailer erreur : => SMTP Error: Could not authenticate.', '2019-08-22 11:35:19', 'erreur[php_mailer]', b'1'),
(122, 'PHPMailer erreur : => SMTP Error: Could not authenticate.', '2019-08-22 11:35:48', 'erreur[php_mailer]', b'1'),
(123, 'PHPMailer erreur : => SMTP Error: Could not authenticate.', '2019-08-22 11:36:45', 'erreur[php_mailer]', b'1'),
(124, 'PHPMailer erreur : => SMTP Error: Could not authenticate.', '2019-08-22 11:37:05', 'erreur[php_mailer]', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `panierID` int(11) NOT NULL AUTO_INCREMENT,
  `dateAjoute` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`panierID`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `panier`
--

INSERT INTO `panier` (`panierID`, `dateAjoute`) VALUES
(130, '2019-08-10 04:23:09'),
(131, '2019-08-15 09:55:09'),
(132, '2019-08-15 12:35:29'),
(133, '2019-08-16 08:05:59'),
(134, '2019-08-18 10:51:06'),
(135, '2019-08-20 21:20:41');

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
  `couleur` varchar(100) DEFAULT 'N/A',
  PRIMARY KEY (`panierID`,`articleID`),
  KEY `fk_articleID_panierdetails` (`articleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `panierdetails`
--

INSERT INTO `panierdetails` (`panierID`, `articleID`, `quantite`, `dateAjoute`, `couleur`) VALUES
(130, 55, 1, '2019-08-21 16:07:17', 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `statistiques`
--

DROP TABLE IF EXISTS `statistiques`;
CREATE TABLE IF NOT EXISTS `statistiques` (
  `type` varchar(100) NOT NULL,
  `valeur` double DEFAULT '0',
  PRIMARY KEY (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `statistiques`
--

INSERT INTO `statistiques` (`type`, `valeur`) VALUES
('page vues', 105),
('revenu total', 0),
('total commandes', 13),
('total ventes', 0);

-- --------------------------------------------------------

--
-- Table structure for table `visiteurs`
--

DROP TABLE IF EXISTS `visiteurs`;
CREATE TABLE IF NOT EXISTS `visiteurs` (
  `sessionID` varchar(100) NOT NULL,
  `dateVisite` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sessionID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `visiteurs`
--

INSERT INTO `visiteurs` (`sessionID`, `dateVisite`) VALUES
('es9p7qh73a4q4eq1g9o75albfv', '2019-08-20 17:05:45'),
('6ov9sofdfou231et7ralkhuk23', '2019-08-22 11:33:18'),
('3bbb4tpkf3l3ddm0mo4tm84g99', '2019-08-20 17:13:01'),
('0032hug98bp6mlh13bqbo3ifkv', '2019-08-20 21:27:12'),
('o1rtqfdodc2fr8ejtkm4cggcmh', '2019-08-21 16:07:33'),
('69tsn83ima418ifdfcpddto92b', '2019-08-21 16:32:45'),
('kan5lta9un20f1iq4tlhj52sal', '2019-08-21 16:37:02'),
('og589033a51nuk7otc0tkbe1d8', '2019-08-21 23:52:30'),
('n29ob3eq6290v0opd55dh6nila', '2019-08-22 00:12:19'),
('gggig4lo3j6taiij6tph1tj3nj', '2019-08-22 00:15:53'),
('j9scnh82fpvr5230nvmgdc4uf8', '2019-08-22 10:40:47'),
('4e6u9pj6ndfapigogo2pviv9s4', '2019-08-22 11:03:22'),
('i67epucku9ihqn3i63v2g44akf', '2019-08-22 11:25:24'),
('ia65olglaene427fl0aokm8jk1', '2019-08-25 13:32:32');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `fk_panierID_client` FOREIGN KEY (`panierID`) REFERENCES `panier` (`panierID`);

--
-- Constraints for table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fk_clientID_commande` FOREIGN KEY (`clientID`) REFERENCES `client` (`clientID`);

--
-- Constraints for table `commandedetails`
--
ALTER TABLE `commandedetails`
  ADD CONSTRAINT `fk_commandeID_commandedetails` FOREIGN KEY (`commandeID`) REFERENCES `commande` (`commandeID`) ON DELETE CASCADE;

--
-- Constraints for table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `fk_articleID_commentaire` FOREIGN KEY (`articleID`) REFERENCES `article` (`articleID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_clientID_commentaire` FOREIGN KEY (`clientID`) REFERENCES `client` (`clientID`) ON DELETE CASCADE;

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
-- Constraints for table `imagearticle`
--
ALTER TABLE `imagearticle`
  ADD CONSTRAINT `fk_articleID_imagearticle` FOREIGN KEY (`articleID`) REFERENCES `article` (`articleID`) ON DELETE CASCADE;

--
-- Constraints for table `panierdetails`
--
ALTER TABLE `panierdetails`
  ADD CONSTRAINT `fk_articleID_panierdetails` FOREIGN KEY (`articleID`) REFERENCES `article` (`articleID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
