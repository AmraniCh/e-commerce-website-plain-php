-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 15 juil. 2019 à 23:27
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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`articleID`, `articleNom`, `articlePrix`, `articlePrixRemise`, `articleDescription`, `articleMarque`, `tauxRemise`, `remiseDisponible`, `unitesEnStock`, `unitesSurCommande`, `articleDisponible`, `niveau`, `dateAjoute`, `categorieID`) VALUES
(27, 'LENOVO 541', '5000.00', NULL, 'LENOVO 541', 'LENOVO', NULL, b'0', 2, 0, b'1', 5, '2019-07-09 17:38:17', 40),
(28, 'LENOVO 541', '5000.00', '4500.00', 'LENOVO 541', 'LENOVO', 10, b'1', 2, 0, b'1', 5, '2019-07-09 17:38:26', 40),
(29, 'HP 640', '5000.00', '4500.00', 'HP 640', 'HP', 10, b'1', 2, 0, b'1', 5, '2019-07-09 17:38:46', 40),
(30, 'HP 640', '5000.00', '4500.00', 'HP 640', 'HP', 10, b'1', 2, 0, b'1', 5, '2019-07-09 17:38:56', 40),
(31, 'CAMERA HD SONY 14000', '6000.00', '3600.00', 'CAMERA HD SONY 14000', 'SONY', 40, b'1', 1, 0, b'1', 5, '2019-07-09 18:58:55', 31),
(32, 'Iphone6 S', '1500.00', '1350.00', 'Iphone6 S', 'Iphone', 10, b'1', 1, 0, b'1', 5, '2019-07-09 19:50:39', 36),
(33, 'Samsung', '2500.00', '2000.00', 'Samsung', 'Samsung', 20, b'1', 1, 0, b'1', 5, '2019-07-09 19:51:25', 36),
(34, 'LENOVO 541', '5000.00', '4500.00', 'LENOVO 541', 'LENOVO', 10, b'1', 2, 0, b'1', 5, '2019-07-09 17:38:17', 40);

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
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`categorieID`, `categorieNom`, `description`, `active`) VALUES
(36, 'Tablettes & Smartphones', 'Tablettes & Smartphones', b'1'),
(41, 'Accessoires & Périph', 'Accessoires & Périphériques', b'1'),
(30, 'Impression', 'Impression', b'1'),
(31, 'Image & Son', 'Image & Son', b'1'),
(32, 'Serveurs', 'Serveurs', b'1'),
(33, 'Logiciel', 'Logiciel', b'1'),
(34, 'Bonnes affaires', 'Bonnes affaires', b'1'),
(35, 'Réseaux', 'Réseaux', b'1'),
(40, 'PC-Portable', 'PC-Portable', b'1'),
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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`clientID`, `clientUserName`, `prenom`, `nom`, `email`, `adresse`, `ville`, `emailValid`, `codeEmail`, `codePostal`, `telephone`, `motdepasse`, `questionSecurite`, `reponseQuestion`, `panierID`) VALUES
(40, 'chou500', 'elamrani', 'chakir', 'elamrani.sv.laza@gmail.com', 'tanger', 'tanger', b'1', '334882', 90002, '0659630023', '$2y$10$GIDeDZ8Q3cTJ68B10HkPlOVTPiiZoRt2sELWxo7zRqgDgw4Jp8gOK', 'Quel était le nom de votre premier animal ?', 'KAKAKA', NULL);

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
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `commID` int(11) NOT NULL AUTO_INCREMENT,
  `clientID` int(11) NOT NULL,
  `articleID` int(11) NOT NULL,
  `accepte` bit(1) NOT NULL DEFAULT b'0',
  `niveau` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `dateComm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`commID`),
  KEY `fk_articleID_commentaire` (`articleID`),
  KEY `fk_clientID_commentaire` (`clientID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
('Blue', 27);

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
('product01.png', 27),
('product06.png', 27),
('product08.png', 27),
('shop02.png', 31),
('product07.png', 32),
('product04.png', 33);

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

DROP TABLE IF EXISTS `livraison`;
CREATE TABLE IF NOT EXISTS `livraison` (
  `livraisonID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`livraisonID`)
) ENGINE=MyISAM AUTO_INCREMENT=1002 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `livraison`
--

INSERT INTO `livraison` (`livraisonID`) VALUES
(1001);

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
-- Structure de la table `panierdetails`
--

DROP TABLE IF EXISTS `panierdetails`;
CREATE TABLE IF NOT EXISTS `panierdetails` (
  `panierID` int(11) NOT NULL AUTO_INCREMENT,
  `clientID` int(11) NOT NULL,
  `articleID` int(11) NOT NULL,
  PRIMARY KEY (`panierID`,`clientID`,`articleID`),
  KEY `fk_clientID_panierDetails` (`clientID`),
  KEY `fk_articleID_panierDetails` (`articleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `fk_articleID_commentaire` FOREIGN KEY (`articleID`) REFERENCES `article` (`articleID`),
  ADD CONSTRAINT `fk_clientID_commentaire` FOREIGN KEY (`clientID`) REFERENCES `client` (`clientID`);

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

--
-- Contraintes pour la table `panierdetails`
--
ALTER TABLE `panierdetails`
  ADD CONSTRAINT `fk_articleID_panierDetails` FOREIGN KEY (`articleID`) REFERENCES `article` (`articleID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_clientID_panierDetails` FOREIGN KEY (`clientID`) REFERENCES `client` (`clientID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
