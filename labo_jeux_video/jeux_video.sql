-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 19 mai 2026 à 02:53
-- Version du serveur : 8.3.0
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `jeux_video`
--

-- --------------------------------------------------------

--
-- Structure de la table `genres`
--

DROP TABLE IF EXISTS `genres`;
CREATE TABLE IF NOT EXISTS `genres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_genre` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `genres`
--

INSERT INTO `genres` (`id`, `nom_genre`) VALUES
(1, 'RPG'),
(2, 'FPS'),
(3, 'Survie'),
(4, 'Aventure'),
(5, 'Simulation');

-- --------------------------------------------------------

--
-- Structure de la table `jeux`
--

DROP TABLE IF EXISTS `jeux`;
CREATE TABLE IF NOT EXISTS `jeux` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `annee_sortie` int NOT NULL,
  `note` int NOT NULL,
  `genre_id` int NOT NULL,
  `studio_id` int NOT NULL,
  `ajoute_par` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_genre` (`genre_id`),
  KEY `fk_studio` (`studio_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `jeux`
--

INSERT INTO `jeux` (`id`, `titre`, `annee_sortie`, `note`, `genre_id`, `studio_id`, `ajoute_par`) VALUES
(1, 'Skyrim', 2011, 19, 1, 2, 'Prof'),
(2, 'Half-Life 2', 2004, 18, 2, 4, 'Prof'),
(3, 'The Witcher 3', 2015, 20, 1, 3, 'Prof'),
(4, 'Far Cry 5', 2018, 15, 2, 1, 'Prof'),
(5, 'Subnautica', 2018, 17, 3, 2, 'Prof'),
(6, 'GTA V', 2013, 19, 4, 5, 'Prof'),
(7, 'Assassin Creed Mirage', 2023, 14, 4, 1, 'Prof');

-- --------------------------------------------------------

--
-- Structure de la table `studios`
--

DROP TABLE IF EXISTS `studios`;
CREATE TABLE IF NOT EXISTS `studios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_studio` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `pays` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `studios`
--

INSERT INTO `studios` (`id`, `nom_studio`, `pays`) VALUES
(1, 'Ubisoft', 'France'),
(2, 'Bethesda', 'USA'),
(3, 'CD Projekt', 'Pologne'),
(4, 'Valve', 'USA'),
(5, 'Rockstar Games', 'USA');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
