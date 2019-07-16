-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 25 juin 2019 à 11:33
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
-- Base de données :  `transport`
--

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `compteur`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `compteur` (OUT `nb_commandes` INT)  BEGIN
SELECT COUNT(*) INTO nb_commandes
FROM commande;
END$$

DROP PROCEDURE IF EXISTS `export`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `export` ()  BEGIN
 SELECT * FROM commande INTO OUTFILE 'C:\Users\chauffeur.csv';
  SELECT * FROM client INTO OUTFILE 'C:\Users\client.csv';
  SELECT * FROM chauffeur INTO OUTFILE 'C:\Users\chauffeur.csv';
  SELECT * FROM remorque  INTO OUTFILE 'C:\Users\remorque.csv';
  SELECT * FROM tracteur  INTO OUTFILE 'C:\Users\tracteur.csv';
END$$

DROP PROCEDURE IF EXISTS `tri`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `tri` (IN `orderBy` VARCHAR(50))  BEGIN

SELECT * FROM tracteur 
ORDER BY
CASE 
WHEN orderBy = 'annee' THEN annee
WHEN orderBy = 'plaque' THEN plaque
WHEN orderBy = 'modele' THEN modele
WHEN orderBy = 'marque' THEN marque
WHEN orderBy = 'ID' THEN id

END;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `chauffeur`
--

DROP TABLE IF EXISTS `chauffeur`;
CREATE TABLE IF NOT EXISTS `chauffeur` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nom_chauffeur` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prenom_chauffeur` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ville` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tracteur` int(5) DEFAULT NULL,
  `remorque` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tracteur_id` (`tracteur`),
  KEY `remorque_id` (`remorque`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `chauffeur`
--

INSERT INTO `chauffeur` (`id`, `nom_chauffeur`, `prenom_chauffeur`, `ville`, `tracteur`, `remorque`) VALUES
(1, 'Poitou', 'Gilles', 'Warcoing', 1, 1),
(2, 'Lassoie', 'Samuel', 'Tournai', 2, 3),
(3, 'Vandermersch', 'Bertrand', 'Celles', 4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nom_client` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `nom_client`, `adresse`, `telephone`, `email`) VALUES
(1, 'Fusrodah', '49 Avenue du poney qui tousse, 7700 Mouscron', '04333444720', 'accueil@fusrodah.net'),
(2, 'Reubeucar', '77, Avenue des bouches, 59000 Lille', '0611821827', 'contact@reubeucar.fr'),
(3, 'Debuf', 'Rue de Luingne, 77', '056444719', 'debuf@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `marque` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `modele` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `plaque` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `client` int(5) NOT NULL,
  `adresse_chargement` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adresse_livraison` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_chargement` date NOT NULL,
  `date_livraison` date NOT NULL,
  `heure_chargement` time(6) NOT NULL,
  `heure_livraison` time(6) NOT NULL,
  `date_chargee` date DEFAULT NULL,
  `date_livree` date DEFAULT NULL,
  `heure_chargee` time(6) DEFAULT NULL,
  `heure_livree` time(6) DEFAULT NULL,
  `chauffeur_chargement` int(5) DEFAULT NULL,
  `chauffeur_livraison` int(5) DEFAULT NULL,
  `remarque` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client`),
  KEY `chauffeur_delivery_id` (`chauffeur_livraison`),
  KEY `chauffeur_loading_id` (`chauffeur_chargement`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `marque`, `modele`, `plaque`, `client`, `adresse_chargement`, `adresse_livraison`, `date_chargement`, `date_livraison`, `heure_chargement`, `heure_livraison`, `date_chargee`, `date_livree`, `heure_chargee`, `heure_livree`, `chauffeur_chargement`, `chauffeur_livraison`, `remarque`) VALUES
(1, 'BMW', 'Serie 1', '1DGO232', 1, '78 Rue de la pipe, 1080 Bruxelles', '47, Les bains de pied, 86000 Poitiers', '2019-06-03', '2019-06-06', '09:00:00.000000', '08:00:00.000000', '2019-06-04', '2019-06-06', '14:36:00.000000', '08:47:00.000000', 1, 1, 'Client de merde! attention !'),
(2, 'Tesla', 'Model S', '1SQL808', 2, '12 Rue de l\'oie, 75018 Paris', 'vangoghstraat 32, 8000 Brugge', '2019-05-15', '2019-05-20', '12:00:00.000000', '08:00:00.000000', '2019-05-15', '2019-05-20', '07:56:00.000000', '12:22:00.000000', 2, 1, 'Voiture HS'),
(9, 'Peugeot', '308', '1DGO898', 2, 'Mouscron', 'Tournai', '2019-06-16', '2019-06-17', '08:00:00.000000', '08:00:00.000000', '2019-06-17', '2019-06-19', '08:00:00.000000', '16:54:00.000000', 1, 3, 'Un ajout fait par formulaire'),
(10, 'OPEL', 'corsa', '1DGX999', 2, '47 TEST', 'COUCOU', '2019-10-04', '2019-10-04', '08:00:00.000000', '09:00:00.000000', '2019-10-05', '2019-10-05', '08:00:00.000000', '09:00:00.000000', 1, 1, 'test'),
(11, 'test trig', 'trig', '1UWE003', 3, 'trig', 'trig', '2020-07-22', '2020-07-23', '00:52:00.000000', '00:53:00.000000', '2020-07-22', '2020-07-22', '00:53:00.000000', '01:52:00.000000', 1, 3, 'test trig'),
(12, 'Opel', 'Vivaro', '1REX069', 3, 'Dépôt Mouscron', 'Rue de la vieille peau, 33000 Bordeaux', '2019-07-26', '2019-07-28', '07:00:00.000000', '12:00:00.000000', '2019-07-26', '2019-07-28', '06:27:00.000000', '09:53:00.000000', 3, 3, 'Pare-choc arrière touché');

--
-- Déclencheurs `commande`
--
DROP TRIGGER IF EXISTS `BEFORE_INSERT_COMMANDE`;
DELIMITER $$
CREATE TRIGGER `BEFORE_INSERT_COMMANDE` BEFORE INSERT ON `commande` FOR EACH ROW IF NEW.heure_livraison < NEW.heure_chargement
OR NEW.date_livraison < NEW.date_chargement
OR NEW.heure_livree < NEW.heure_chargee
OR NEW.date_livree < NEW.date_livree
OR NEW.plaque NOT REGEXP '1[A-Z][A-Z][A-Z][0-9][0-9][0-9]'
THEN
UPDATE commande SET NEW.id=FALSE;
END IF
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `BEFORE_UPDATE_COMMANDE`;
DELIMITER $$
CREATE TRIGGER `BEFORE_UPDATE_COMMANDE` BEFORE UPDATE ON `commande` FOR EACH ROW IF NEW.heure_livraison < NEW.heure_chargement
OR NEW.date_livraison < NEW.date_chargement
OR NEW.heure_livree < NEW.heure_chargee
OR NEW.date_livree < NEW.date_livree
OR NEW.plaque NOT REGEXP '1[A-Z][A-Z][A-Z][0-9][0-9][0-9]'
THEN
UPDATE commande SET NEW.id=FALSE;
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `remorque`
--

DROP TABLE IF EXISTS `remorque`;
CREATE TABLE IF NOT EXISTS `remorque` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `marque` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `modele` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `plaque` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `annee` year(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `remorque`
--

INSERT INTO `remorque` (`id`, `marque`, `modele`, `plaque`, `annee`) VALUES
(1, 'Kassbohrer', 'Porte 5', 'Remor1', 2001),
(2, 'Kassbohrer', 'Porte 8', 'Remor2', 1998),
(3, 'Kassbohrer', 'Porte 8', 'Remor3', 1995),
(4, 'Kassbohrer', 'Porte 8', 'QDB088', 1969);

--
-- Déclencheurs `remorque`
--
DROP TRIGGER IF EXISTS `BEFORE_INSERT_REMORQUE`;
DELIMITER $$
CREATE TRIGGER `BEFORE_INSERT_REMORQUE` BEFORE INSERT ON `remorque` FOR EACH ROW IF plaque NOT REGEXP 'Q[A-Z][A-Z][A-Z][0-9][0-9][0-9]'
THEN
UPDATE NEW.id SET NEW.id=FALSE;
END IF
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `BEFORE_UPDATE_REMORQUE`;
DELIMITER $$
CREATE TRIGGER `BEFORE_UPDATE_REMORQUE` BEFORE UPDATE ON `remorque` FOR EACH ROW IF plaque NOT REGEXP 'Q[A-Z][A-Z][A-Z][0-9][0-9][0-9]'
THEN
UPDATE NEW.id SET NEW.id=FALSE;
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `tracteur`
--

DROP TABLE IF EXISTS `tracteur`;
CREATE TABLE IF NOT EXISTS `tracteur` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `marque` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `modele` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `plaque` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `annee` year(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `tracteur`
--

INSERT INTO `tracteur` (`id`, `marque`, `modele`, `plaque`, `annee`) VALUES
(1, 'Scania', 'Model1', 'Tract1', 2014),
(2, 'Iveco', 'XF455', 'Tract2', 2015),
(3, 'Mercedes', 'Actros', 'Tract3', 2001),
(4, 'Mercedes', 'Axor', '1SQL042', 2017),
(6, 'Iveco', 'testicouille', '1ZZT777', 2019);

--
-- Déclencheurs `tracteur`
--
DROP TRIGGER IF EXISTS `BEFORE_INSERT_TRACTEUR`;
DELIMITER $$
CREATE TRIGGER `BEFORE_INSERT_TRACTEUR` BEFORE INSERT ON `tracteur` FOR EACH ROW IF plaque NOT REGEXP '1[A-Z][A-Z][A-Z][0-9][0-9][0-9]'
THEN
UPDATE NEW.id SET NEW.id=FALSE;
END IF
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `BEFORE_UPDATE_TRACTEUR`;
DELIMITER $$
CREATE TRIGGER `BEFORE_UPDATE_TRACTEUR` BEFORE UPDATE ON `tracteur` FOR EACH ROW IF plaque NOT REGEXP '1[A-Z][A-Z][A-Z][0-9][0-9][0-9]'
THEN
UPDATE NEW.id SET NEW.id=FALSE;
END IF
$$
DELIMITER ;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chauffeur`
--
ALTER TABLE `chauffeur`
  ADD CONSTRAINT `remorque_id` FOREIGN KEY (`remorque`) REFERENCES `remorque` (`id`),
  ADD CONSTRAINT `tracteur_id` FOREIGN KEY (`tracteur`) REFERENCES `tracteur` (`id`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `chauffeur_delivery_id` FOREIGN KEY (`chauffeur_livraison`) REFERENCES `chauffeur` (`id`),
  ADD CONSTRAINT `chauffeur_loading_id` FOREIGN KEY (`chauffeur_chargement`) REFERENCES `chauffeur` (`id`),
  ADD CONSTRAINT `client_id` FOREIGN KEY (`client`) REFERENCES `client` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
