-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 19, 2019 at 09:18 AM
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
  `unitesCommandees` int(11) DEFAULT '0',
  `articleDisponible` bit(1) NOT NULL DEFAULT b'1',
  `niveau` int(11) DEFAULT '5',
  `dateAjoute` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `categorieID` int(11) NOT NULL,
  PRIMARY KEY (`articleID`),
  UNIQUE KEY `articleNom` (`articleNom`),
  KEY `categorieID` (`categorieID`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`articleID`, `articleNom`, `articlePrix`, `articlePrixRemise`, `articleDescription`, `articleMarque`, `tauxRemise`, `remiseDisponible`, `unitesEnStock`, `unitesCommandees`, `articleDisponible`, `niveau`, `dateAjoute`, `categorieID`) VALUES
(46, 'HP 8741', '5000.00', '4500.00', 'Using POST as opposed to GET will “hide” the parameters in a packet and not send them in the URL. You may need to change the way your server-side code accepts the request. Java Servlets for instance, have separate method that need to be implemented for GET and POST. Furthermore if your site is HTTPS, all the traffic will be encrypted. This is assuming of course that you are not going cross domain for AJAX. In terms of hiding the actual script’s name, the best you can do is obfuscate it.', 'hp', 10, b'1', 8, 2, b'1', 5, '2019-08-09 20:49:55', 40),
(47, 'CAMERA HD SONY 14000 CAMERA HD SONY 14000 CAMERA HD SONY 14000', '4500.00', NULL, 'CAMERA HD SONY 14000', 'sony', NULL, b'0', 8, 2, b'1', 5, '2019-08-10 07:20:34', 31),
(48, 'Handphones 2055', '500.00', NULL, 'Handphones 2055', '', NULL, b'0', 7, 3, b'1', 5, '2019-08-14 13:54:44', 41);

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
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`categorieID`, `categorieNom`, `description`, `active`) VALUES
(36, 'Tablettes &amp; Smartphones', 'Tablettes &amp; Smartphones', b'1'),
(41, 'Accessoires &amp; Périph', 'Accessoires &amp; Périphériques', b'1'),
(31, 'Image & Son', 'Image & Son', b'1'),
(32, 'Serveurs', 'Serveurs', b'1'),
(34, 'Impression', 'Impression', b'1'),
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
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`clientID`, `clientUserName`, `prenom`, `nom`, `email`, `adresse`, `ville`, `emailValid`, `codeEmail`, `codeRec`, `codePostal`, `telephone`, `motdepasse`, `questionSecurite`, `reponseQuestion`, `panierID`) VALUES
(46, 'chou500', 'EL AMRANI', 'CHAKIR', '', 'BNI MAKADA', 'Tanger', b'1', '247001', NULL, 90002, '0651487088', '$2y$10$bSlqi8xJEeyek62yrnleie6eo4r3XRdo6anKBwq/RomgU0Pq0/SFi', 'Quel était le nom de votre premier animal ?', 'orioo', 130),
(63, 'ahmed', 'ahmed', 'el amrani', 'ahmed@gmail.com', 'tanger', 'casa', b'0', '928322', NULL, 445585, '+212144710547', '$2y$10$MOOoqR0/lknqaALxuB41b.FB67cmvO3gsNHolD2LmVm.tdek5Vqt2', 'Quel était le nom de votre premier animal ?', 'oodf', 133),
(70, 'chou500d', 'chakira', 'qsdqsdqsdqs', 'elamrani.sv.laza@gmail.com', 'qsdqsqsddqs', 'casa', b'1', '787235', NULL, 2312321, '+212144710547', '$2y$10$oc8t0d7s.XpU6rOjDMFtgepTFovk4V0v2j6yvFPEzhweBthz0HXXC', 'Quel était le nom de votre premier animal ?', 'DDSQD', 134);

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
) ENGINE=InnoDB AUTO_INCREMENT=10089 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`commandeID`, `clientID`, `commandeDate`, `status`, `nbrArticles`, `totalApayer`, `typeLivraison`, `couponUtilise`, `vu`) VALUES
(10087, 46, '2019-08-18 11:40:56', 1, 1, 500, 'amana', b'0', b'1'),
(10088, 46, '2019-08-17 11:59:04', 1, 3, 9500, 'gratuit', b'0', b'1');

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
  PRIMARY KEY (`commandeID`,`articleID`),
  KEY `fk_articleId_commandedetails` (`articleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commandedetails`
--

INSERT INTO `commandedetails` (`commandeID`, `articleID`, `quantite`, `couleur`) VALUES
(10087, 48, 1, 'Noir'),
(10088, 46, 1, 'Gris'),
(10088, 47, 1, 'Blue'),
(10088, 48, 1, 'Noir');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commentaire`
--

INSERT INTO `commentaire` (`commentaireID`, `clientID`, `articleID`, `accepte`, `niveau`, `commentaire`, `titre`, `dateComm`) VALUES
(3, 46, 46, b'1', 3, '\r\nUsing POST as opposed to GET will “hide” the parameters in a packet and not send them in the URL. You may need to change the way your server-side code accepts the request. Java Servlets for instance, have separate method that need to be implemented for GET and POST. Furthermore if your site is HTTPS, all the traffic will be encrypted. This is assuming of course that you are not going cross domain for AJAX. In terms of hiding the actual script’s name, the best you can do is obfuscate it.\r\n', '  Using POST as opposed to GET will “hide” the parameters in a packet and not send them in the URL. You may need to change the way your server-side code accepts the request. Java Servlets for instance, have separate method that need to be implemented for GET and POST. Furthermore if your site is HTTPS, all the traffic will be encrypted. This is assuming of course that you are not going cross domain for AJAX. In terms of hiding the actual script’s name, the best you can do is obfuscate it.', '2019-08-18 00:32:18'),
(5, 46, 48, b'1', 3, 'Bon produit', 'Bon produit', '2019-08-18 06:49:04');

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
('Gris', 46),
('Noir', 46),
('Blue', 47),
('Noir', 48);

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

--
-- Dumping data for table `coupondetails`
--

INSERT INTO `coupondetails` (`articleID`, `couponID`) VALUES
(46, 1),
(47, 1),
(48, 1);

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
(46, 46, '2019-08-17 11:21:52');

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
('product01.png', 46, b'0'),
('product02.png', 48, b'1'),
('product03.png', 48, b'0'),
('product04.png', 48, b'0'),
('product08.png', 46, b'1'),
('product09.png', 47, b'1');

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
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `livraison`
--

INSERT INTO `livraison` (`livraisonID`, `commandeID`, `confirmationDate`) VALUES
(42, 10074, '2019-08-16 09:55:47'),
(41, 10072, '2019-08-15 07:39:59'),
(43, 10074, '2019-08-16 10:04:47'),
(44, 10074, '2019-08-16 10:14:42'),
(45, 10074, '2019-08-16 10:16:40'),
(46, 10074, '2019-08-16 10:17:44'),
(47, 10073, '2019-08-16 10:22:38'),
(67, 10085, '2019-08-18 11:38:40'),
(77, 10088, '2019-08-18 17:30:16'),
(78, 10087, '2019-08-18 17:30:17');

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
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notID`, `titre`, `dateNot`, `type`, `vu`) VALUES
(9, 'Nouveau Commande de [CHAKIR EL AMRANI]', '2019-08-17 18:32:49', 'commande', b'1'),
(10, 'Nouveau Commentaire de [CHAKIR EL AMRANI]', '2019-08-18 06:49:04', 'commentaire', b'1'),
(11, 'Nouveau Client Enregistré', '2019-08-18 10:50:58', 'client', b'1'),
(12, 'Nouveau Commande de [CHAKIR EL AMRANI]', '2019-08-18 11:38:08', 'commande', b'1'),
(13, 'Nouveau Commande de [CHAKIR EL AMRANI]', '2019-08-18 11:39:44', 'commande', b'1'),
(14, 'Nouveau Commande de [CHAKIR EL AMRANI]', '2019-08-18 11:40:56', 'commande', b'1'),
(15, 'Nouveau Commande de [CHAKIR EL AMRANI]', '2019-08-18 11:59:04', 'commande', b'1'),
(16, 'Nouveau Commentaire de [CHAKIR EL AMRANI]', '2019-08-18 11:59:20', 'commentaire', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `panierID` int(11) NOT NULL AUTO_INCREMENT,
  `dateAjoute` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`panierID`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `panier`
--

INSERT INTO `panier` (`panierID`, `dateAjoute`) VALUES
(130, '2019-08-10 04:23:09'),
(131, '2019-08-15 09:55:09'),
(132, '2019-08-15 12:35:29'),
(133, '2019-08-16 08:05:59'),
(134, '2019-08-18 10:51:06');

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

-- --------------------------------------------------------

--
-- Table structure for table `statistiques`
--

DROP TABLE IF EXISTS `statistiques`;
CREATE TABLE IF NOT EXISTS `statistiques` (
  `valeur` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) DEFAULT NULL,
  `dateStat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`valeur`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `statistiques`
--

INSERT INTO `statistiques` (`valeur`, `type`, `dateStat`) VALUES
(1, 'visite', '2019-08-18 08:29:36'),
(2, 'visite', '2019-08-19 08:29:36');

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
  ADD CONSTRAINT `fk_articleId_commandedetails` FOREIGN KEY (`articleID`) REFERENCES `article` (`articleID`),
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
