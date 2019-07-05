-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 05 juil. 2019 à 16:28
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mga.db`
--

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `getrandom`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getrandom` (OUT `randomNumber` INT)  BEGIN
  SELECT floor(rand()*100000000) INTO randomNumber;
end$$

--
-- Fonctions
--
DROP FUNCTION IF EXISTS `randomNumber`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `randomNumber` () RETURNS INT(50) RETURN floor(rand()*1000000)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
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
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`adminID`, `adminName`, `email`, `nom`, `prenom`, `motdepasse`, `role`) VALUES
(1, 'admin', NULL, 'el amrani', 'chakir', '051487088', 'administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `articleID` int(11) NOT NULL AUTO_INCREMENT,
  `articleNom` varchar(100) NOT NULL,
  `articlePrix` decimal(15,2) NOT NULL,
  `articlePrixRemise` decimal(15,2) DEFAULT NULL,
  `articleDescription` text,
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`articleID`, `articleNom`, `articlePrix`, `articlePrixRemise`, `articleDescription`, `tauxRemise`, `remiseDisponible`, `unitesEnStock`, `unitesSurCommande`, `articleDisponible`, `niveau`, `dateAjoute`, `categorieID`) VALUES
(1, 'CamÃ©ra', '500.00', '450.00', 'CamÃ©ra', 10, b'1', 8000, 0, b'1', 3, '2019-07-01 02:04:44', 36),
(2, 'Iphone6', '2500.00', NULL, 'Iphone6', NULL, b'0', 10, 0, b'1', 5, '2019-07-01 02:04:44', 30),
(3, 'CasqueG3', '2500.00', NULL, 'CasqueG3', NULL, b'0', 10, 0, b'1', 5, '2019-07-01 02:04:44', 36),
(4, 'ACER i5', '3500.00', '3150.00', 'ACER i5 ', 10, b'1', 10, 0, b'1', 5, '2019-07-01 02:04:44', 27),
(5, 'Caméra', '500.00', '450.00', 'Caméra', 10, b'1', 8000, 0, b'1', 3, '2019-07-01 02:04:44', 28),
(6, 'Iphone6', '2500.00', NULL, 'Iphone6', NULL, b'0', 10, 0, b'1', 5, '2019-07-01 02:04:44', 33),
(7, 'CasqueG3', '2500.00', NULL, 'CasqueG3', NULL, b'0', 10, 0, b'1', 5, '2019-07-01 02:04:44', 34),
(8, 'LENOVO 541', '4000.00', '3200.00', 'LENOVO 541', 20, b'1', 10, 0, b'1', 5, '2019-07-01 02:04:44', 27),
(19, 'PC HP 84120', '2500.00', '2250.00', 'PC HP 84120\nRAM 2GB', 10, b'1', 1, 0, b'1', 5, '2019-07-04 06:28:28', 27),
(20, 'LENOVO 541', '4000.00', '3600.00', 'LENOVO 541', 10, b'1', 10, 0, b'1', 5, '2019-07-01 02:04:44', 31),
(21, 'LENOVO 541', '4000.00', '3200.00', 'LENOVO 541', 20, b'1', 10, 0, b'1', 5, '2019-07-01 02:04:44', 27),
(22, 'PC HP 84120', '2500.00', '2250.00', 'PC HP 84120\r\nRAM 2GB', 10, b'1', 1, 0, b'1', 5, '2019-07-04 06:28:28', 27);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `categorieID` int(11) NOT NULL AUTO_INCREMENT,
  `categorieNom` varchar(100) NOT NULL,
  `description` text,
  `active` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`categorieID`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`categorieID`, `categorieNom`, `description`, `active`) VALUES
(36, 'Tablettes & Smartphones', 'Tablettes & Smartphones', b'1'),
(28, 'Accessoires & Périph', 'Accessoires & Périphériques', b'1'),
(30, 'Impression', 'Impression', b'1'),
(27, 'PC-Portable', 'PC-Portable', b'1'),
(31, 'Image & Son', 'Image & Son', b'1'),
(32, 'Serveurs', 'Serveurs', b'1'),
(33, 'Logiciel', 'Logiciel', b'1'),
(34, 'Bonnes affaires', 'Bonnes affaires', b'1'),
(35, 'Réseaux', 'Réseaux', b'1'),
(37, 'PC-Bureau', 'PC-Bureau', b'1');

-- --------------------------------------------------------

--
-- Structure de la table `client`
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
  KEY `panierID` (`panierID`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`clientID`, `clientUserName`, `prenom`, `nom`, `email`, `adresse`, `ville`, `emailValid`, `codeEmail`, `codePostal`, `telephone`, `motdepasse`, `questionSecurite`, `reponseQuestion`, `panierID`) VALUES
(29, 'dfgfdg', 'qsdqsd', 'qsdqsdqsdqs', 'elamrani.sv.laza@gmail.com', 'qsdqsdqs', 'casa', b'0', '43430', 445585, '+212144710547', 'testtest', 'Quel était le nom de votre premier animal ?', 'ffffffff', NULL),
(25, 'dqsd', 'qsdqsd', 'qsdqsdqsdqs', 'elamrani.sv.laza@gmail.com', 'qsdqsdqs', 'casa', b'0', '728623', 445585, '+212144710547', 'testtest', 'Quel était le nom de votre premier animal ?', 'ffffffff', NULL),
(27, 'qsdqd', 'qsdqsd', 'qsdqsdqsdqs', 'elamrani.sv.laza@gmail.com', 'qsdqsdqs', 'casa', b'0', '137165', 445585, '+212144710547', 'testtest', 'Quel était le nom de votre premier animal ?', 'ffffffff', NULL),
(26, 'dqsdfsdf', 'qsdqsd', 'qsdqsdqsdqs', 'elamrani.sv.laza@gmail.com', 'qsdqsdqs', 'casa', b'0', '335736', 445585, '+212144710547', 'testtest', 'Quel était le nom de votre premier animal ?', 'ffffffff', NULL);

--
-- Déclencheurs `client`
--
DROP TRIGGER IF EXISTS `randomNumber`;
DELIMITER $$
CREATE TRIGGER `randomNumber` BEFORE INSERT ON `client` FOR EACH ROW set new.codeEmail=randomNumber()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `couleurarticle`
--

DROP TABLE IF EXISTS `couleurarticle`;
CREATE TABLE IF NOT EXISTS `couleurarticle` (
  `nomCouleur` varchar(100) NOT NULL,
  `articleID` int(11) NOT NULL,
  PRIMARY KEY (`nomCouleur`,`articleID`),
  KEY `fk_articleID_couleurarticle` (`articleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `couleurarticle`
--

INSERT INTO `couleurarticle` (`nomCouleur`, `articleID`) VALUES
('rouge,blue, noir, ', 1),
('noir, ', 2),
('noir', 3),
('noir, blue, , ', 4),
('noir, ', 19);

-- --------------------------------------------------------

--
-- Structure de la table `demande`
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
-- Structure de la table `demandedetails`
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
-- Structure de la table `imagearticle`
--

DROP TABLE IF EXISTS `imagearticle`;
CREATE TABLE IF NOT EXISTS `imagearticle` (
  `imageArticleNom` varchar(256) NOT NULL,
  `articleID` int(11) NOT NULL,
  PRIMARY KEY (`imageArticleNom`,`articleID`),
  KEY `fk_articleID_imagearticle` (`articleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `imagearticle`
--

INSERT INTO `imagearticle` (`imageArticleNom`, `articleID`) VALUES
('product09.png', 1),
('shop02.png', 1),
('product07.png', 2),
('product02.png', 3),
('product05.png', 3),
('product06.png', 4),
('product04.png', 7),
('product06.png', 8),
('product03.png', 19);

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

DROP TABLE IF EXISTS `livraison`;
CREATE TABLE IF NOT EXISTS `livraison` (
  `livraisonID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`livraisonID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
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
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `panierID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`panierID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `panierdetails`
--

DROP TABLE IF EXISTS `panierdetails`;
CREATE TABLE IF NOT EXISTS `panierdetails` (
  `panierDetailsID` int(11) NOT NULL,
  `panierID` int(11) NOT NULL,
  `articleID` int(11) NOT NULL,
  PRIMARY KEY (`panierDetailsID`),
  KEY `panierID` (`panierID`),
  KEY `articleID` (`articleID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `couleurarticle`
--
ALTER TABLE `couleurarticle`
  ADD CONSTRAINT `fk_articleID_couleurarticle` FOREIGN KEY (`articleID`) REFERENCES `article` (`articleID`) ON DELETE CASCADE;

--
-- Contraintes pour la table `imagearticle`
--
ALTER TABLE `imagearticle`
  ADD CONSTRAINT `fk_articleID_imagearticle` FOREIGN KEY (`articleID`) REFERENCES `article` (`articleID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
