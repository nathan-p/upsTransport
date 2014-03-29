-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 29 Mars 2014 à 16:08
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
-- Structure de la table `bus`
--

CREATE TABLE IF NOT EXISTS `bus` (
  `ligneBus` int(4) NOT NULL,
  PRIMARY KEY (`ligneBus`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `metro`
--

CREATE TABLE IF NOT EXISTS `metro` (
  `idMetro` int(1) NOT NULL AUTO_INCREMENT,
  `ligne` varchar(1) NOT NULL,
  PRIMARY KEY (`idMetro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `metro`
--

INSERT INTO `metro` (`idMetro`, `ligne`) VALUES
(0, 'B');

-- --------------------------------------------------------

--
-- Structure de la table `userlike`
--

CREATE TABLE IF NOT EXISTS `userlike` (
  `idLike` int(3) NOT NULL AUTO_INCREMENT,
  `numLigne` int(4) NOT NULL,
  `moyenTransport` enum('BUS','METRO','VELO') NOT NULL,
  `nbLike` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idLike`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Contenu de la table `userlike`
--

INSERT INTO `userlike` (`idLike`, `numLigne`, `moyenTransport`, `nbLike`) VALUES
(15, 227, 'VELO', 30),
(16, 88, 'BUS', 11),
(17, 34, 'BUS', 7),
(18, 54, 'BUS', 35),
(19, 56, 'BUS', 3),
(20, 82, 'BUS', 3),
(21, 81, 'BUS', 2),
(22, 78, 'BUS', 3),
(23, 2, 'BUS', 3),
(24, 0, 'METRO', 13),
(25, 1, 'METRO', 9);

-- --------------------------------------------------------

--
-- Structure de la table `userunlike`
--

CREATE TABLE IF NOT EXISTS `userunlike` (
  `idUnlike` int(4) NOT NULL AUTO_INCREMENT,
  `numLigne` int(3) NOT NULL,
  `moyenTransport` enum('BUS','METRO','VELO') NOT NULL,
  `nbUnlike` int(3) NOT NULL,
  PRIMARY KEY (`idUnlike`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `userunlike`
--

INSERT INTO `userunlike` (`idUnlike`, `numLigne`, `moyenTransport`, `nbUnlike`) VALUES
(1, 34, 'BUS', 2),
(2, 56, 'BUS', 1),
(3, 54, 'BUS', 2),
(4, 82, 'BUS', 1),
(5, 88, 'BUS', 2),
(6, 81, 'BUS', 1),
(7, 78, 'BUS', 1),
(8, 2, 'BUS', 1),
(9, 0, 'METRO', 1),
(10, 1, 'METRO', 1),
(11, 227, 'VELO', 1);

-- --------------------------------------------------------

--
-- Structure de la table `velo`
--

CREATE TABLE IF NOT EXISTS `velo` (
  `idVelo` int(4) NOT NULL,
  `contrat` varchar(50) NOT NULL DEFAULT 'Toulouse'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `velo`
--

INSERT INTO `velo` (`idVelo`, `contrat`) VALUES
(227, 'Toulouse');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
