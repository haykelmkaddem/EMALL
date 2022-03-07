-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 01 sep. 2020 à 07:10
-- Version du serveur :  5.7.24
-- Version de PHP :  7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `emall`
--

-- --------------------------------------------------------

--
-- Structure de la table `boutique`
--

DROP TABLE IF EXISTS `boutique`;
CREATE TABLE IF NOT EXISTS `boutique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomBoutique` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `categorie` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pack` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateD` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateF` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paiement` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_mod` int(11) NOT NULL,
  `description` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `boutique`
--

INSERT INTO `boutique` (`id`, `nomBoutique`, `categorie`, `pack`, `dateD`, `dateF`, `paiement`, `image`, `id_mod`, `description`) VALUES
(6, 'queen', 'meuble', 'or', '2020-10-09', '2020-09-26', 'en ligne', 'queen.PNG', 12, 'bourtique en ligne de produits para pharmaceutique.'),
(7, 'white corner', 'meuble', 'or', '2020-10-09', '2020-10-08', 'en ligne', '151.jpg', 13, 'Le Bon Coin pour le Meilleur Choix.'),
(9, 'essaker', 'meuble', 'argent', '2020-10-01', '2020-09-26', 'en ligne', '22.PNG', 15, 'bourtique en ligne de produits para pharmaceutique.'),
(10, 'Chic', 'vetement', 'argent', '2020-10-01', '2020-09-11', 'en ligne', '33.PNG', 15, 'azertyu'),
(11, 'chez zina', 'vetement', 'argent', '2020-09-16', '2020-09-02', 'en ligne', '44.PNG', 15, 'bourtique en ligne de produits para pharmaceutique.'),
(12, 'Argania', 'vetement', 'bronze', '2020-10-03', '2020-09-26', 'en ligne', '55.PNG', 15, 'bourtique en ligne de produits para pharmaceutique.\r\n'),
(4, 'Oscar', 'meuble', 'or', '2020-09-24', '2020-09-18', 'en ligne', 'oscar-distribution.png', 11, 'bourtique en ligne de produits para pharmaceutique.');

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `collection`
--

DROP TABLE IF EXISTS `collection`;
CREATE TABLE IF NOT EXISTS `collection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pour` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_boutique` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `collection_produits`
--

DROP TABLE IF EXISTS `collection_produits`;
CREATE TABLE IF NOT EXISTS `collection_produits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_collection` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

DROP TABLE IF EXISTS `membre`;
CREATE TABLE IF NOT EXISTS `membre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datenaissance` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tel` int(11) NOT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mdp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id`, `nom`, `prenom`, `datenaissance`, `tel`, `mail`, `img`, `mdp`, `role`) VALUES
(15, 'marwa', 'marwa', '2020-09-16', 52667882, 'marwamarwa@gmail.com', '3.PNG', '1234', 'moderateur'),
(13, 'marwa', 'belkhir', '2020-09-16', 52667882, 'marwa@gmail.com', '6.PNG', '1234', 'moderateur'),
(12, 'malek', 'marwa', '2020-09-19', 52667882, 'malekmarwa@gmail.com', '1.PNG', '1234', 'moderateur'),
(11, 'Marwa', 'Malek', '1996-09-11', 52667882, 'marwamalek@gmail.com', 'gh2.PNG', '1234', 'moderateur');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pour` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `categorie` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prix` int(11) NOT NULL,
  `description` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_boutique` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `nom`, `pour`, `categorie`, `prix`, `description`, `img`, `id_boutique`) VALUES
(10, 'SHEIN Tshi Ã  motif', 'enfant', 'vetement', 50, '\r\n                        ', '7774444.PNG', 12),
(11, 'T-shirt pour home', 'homme', 'vetement', 80, '\r\n                        ', 'ddd.PNG', 12),
(9, 'SHEIN Robe Ã carreau', 'enfant', 'vetement', 40, '\r\n                        ', '8888.PNG', 12),
(8, 'SHEIN Robe fleurie', 'enfant', 'vetement', 50, '\r\n                        ', '4122.PNG', 12),
(7, 'SHEIN Robe sans manches', 'enfant', 'vetement', 60, ' ', 'HKK.PNG', 12);

-- --------------------------------------------------------

--
-- Structure de la table `produit_img`
--

DROP TABLE IF EXISTS `produit_img`;
CREATE TABLE IF NOT EXISTS `produit_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_produit` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
