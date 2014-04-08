-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 08 Avril 2014 à 16:32
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
  `ref` varchar(33) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `apikey`
--

INSERT INTO `apikey` (`ref`) VALUES
('123456789'),
('x0zk4s0nqbc2nvsgdbtp5xr2i4vem4mid'),
('b6zd29pyzcp7bzovhtvgbnua3quw357cz'),
('nc4202xmpaof5r30pdarr50ivo5rssa3w'),
('ppsdt82ldfrypbzr2ggmo32rndnaqv1jn'),
('kt7lw0v1167m6j6ph7zayj43qemsf3m5x');

-- --------------------------------------------------------

--
-- Structure de la table `bus`
--

CREATE TABLE IF NOT EXISTS `bus` (
  `numBus` varchar(6) NOT NULL,
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
('34', 'Ar&Atilde;&uml;nes', 3, 0),
('54', 'Empalot', 0, 2),
('54', 'Gleyze-Vieille', 2, 2),
('56', 'Auzeville Eglise', 1, 2),
('78', 'Saint Orens Lyc&Atilde;&copy;e', 0, 2),
('79', 'Saint Orens Lyc&Atilde;&copy;e', 0, 1),
('81', 'Castanet-Tolosan', 2, 0),
('82', 'Ramonville Port Sud', 1, 2),
('88', 'CHR Rangueil', 0, 0),
('88', 'H&Atilde;&acute;pital Larrey', 3, 0),
('88', 'Ramonville M&Atilde;&copy;tro', 0, 3),
('NOCT', 'Ramonville M&Atilde;&copy;tro', 0, 0);

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
('B', 'Ramonville ', 1, 1),
('B', 'Borderouge', 1, 1);

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
(227, 'Toulouse', 1, 0),
(228, 'Toulouse', 0, 0),
(229, 'Toulouse', 0, 0),
(230, 'Toulouse', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
