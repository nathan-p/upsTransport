-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 26 Mars 2014 à 08:24
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
  `moyen_transport` enum('BUS','METRO','VELO') NOT NULL,
  `nbLike` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idLike`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
