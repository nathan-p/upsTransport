-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 02 Avril 2014 à 15:01
-- Version du serveur: 5.5.16-log
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `upstransport`
--

-- --------------------------------------------------------

--
-- Structure de la table `apikey`
--

CREATE TABLE IF NOT EXISTS `apikey` (
  `idKey` int(11) NOT NULL AUTO_INCREMENT,
  `ref` varchar(33) NOT NULL,
  PRIMARY KEY (`idKey`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `apikey`
--

INSERT INTO `apikey` (`idKey`, `ref`) VALUES
(1, '123456789');

-- --------------------------------------------------------

--
-- Structure de la table `bus`
--

CREATE TABLE IF NOT EXISTS `bus` (
  `numBus` varchar(3) NOT NULL,
  `directionBus` varchar(50) NOT NULL,
  `nbLike` int(3) NOT NULL,
  `nbUnlike` int(3) NOT NULL,
  PRIMARY KEY (`numBus`,`directionBus`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `bus`
--

INSERT INTO `bus` (`numBus`, `directionBus`, `nbLike`, `nbUnlike`) VALUES
('2', 'Cours Dillon', 0, 2),
('34', 'Ar&Atilde;&uml;nes', 1, 0),
('54', 'Empalot', 0, 2),
('54', 'Gleyze-Vieille', 1, 1),
('56', 'Auzeville Eglise', 1, 1),
('78', 'Saint Orens Lyc&Atilde;&copy;e', 0, 2),
('81', 'Castanet-Tolosan', 2, 0),
('82', 'Ramonville Port Sud', 1, 1),
('88', 'CHR Rangueil', 0, 0),
('88', 'H&Atilde;&acute;pital Larrey', 2, 0),
('88', 'Ramonville M&Atilde;&copy;tro', 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `metro`
--

CREATE TABLE IF NOT EXISTS `metro` (
  `idMetro` char(1) NOT NULL,
  `directionMetro` varchar(50) NOT NULL,
  `nbLike` int(3) NOT NULL,
  `nbUnlike` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `metro`
--

INSERT INTO `metro` (`idMetro`, `directionMetro`, `nbLike`, `nbUnlike`) VALUES
('B', 'Ramonville ', 1, 0),
('B', 'Borderouge', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `velo`
--

CREATE TABLE IF NOT EXISTS `velo` (
  `idVelo` int(3) NOT NULL,
  `contratVelo` varchar(50) NOT NULL DEFAULT 'Toulouse',
  `nbLike` int(3) NOT NULL,
  `nbUnlike` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `velo`
--

INSERT INTO `velo` (`idVelo`, `contratVelo`, `nbLike`, `nbUnlike`) VALUES
(227, 'Toulouse', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
