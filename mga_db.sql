-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 22, 2019 at 08:23 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `articleID` int(11) NOT NULL AUTO_INCREMENT,
  `articleNom` varchar(100) NOT NULL,
  `articlePrix` decimal(15,2) NOT NULL,
  `articleDescription` text,
  `articlePhoto` varchar(255) DEFAULT NULL,
  `remise` int(11) DEFAULT NULL,
  `remiseDisponible` bit(1) NOT NULL DEFAULT b'0',
  `unitesEnStock` int(11) DEFAULT '1',
  `unitesSurCommande` int(11) DEFAULT '0',
  `articleDisponible` int(11) DEFAULT NULL,
  `niveau` int(11) DEFAULT '5',
  `categorieID` int(11) NOT NULL,
  PRIMARY KEY (`articleID`),
  KEY `categorieID` (`categorieID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `categorieID` int(11) NOT NULL AUTO_INCREMENT,
  `categorieNom` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`categorieID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `clientID` int(11) NOT NULL AUTO_INCREMENT,
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
  KEY `panierID` (`panierID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `couleur`
--

DROP TABLE IF EXISTS `couleur`;
CREATE TABLE IF NOT EXISTS `couleur` (
  `codeCouleur` varchar(100) NOT NULL,
  `nomCouleur` varchar(100) NOT NULL,
  PRIMARY KEY (`codeCouleur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `couleur_article`
--

DROP TABLE IF EXISTS `couleur_article`;
CREATE TABLE IF NOT EXISTS `couleur_article` (
  `couleur_article` int(11) NOT NULL AUTO_INCREMENT,
  `articleID` int(11) NOT NULL,
  `codeCouleur` varchar(100) NOT NULL,
  PRIMARY KEY (`couleur_article`),
  KEY `articleID` (`articleID`),
  KEY `codeCouleur` (`codeCouleur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
-- Table structure for table `livraison`
--

DROP TABLE IF EXISTS `livraison`;
CREATE TABLE IF NOT EXISTS `livraison` (
  `livraisonID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`livraisonID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
  PRIMARY KEY (`panierID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `panierdetails`
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
