-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 04 mai 2021 à 16:51
-- Version du serveur :  10.4.18-MariaDB
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `images`
--

-- --------------------------------------------------------

--
-- Structure de la table `Categorie`
--

CREATE TABLE `Categorie` (
  `catId` int(11) NOT NULL COMMENT 'L''identifiant de la catégorie',
  `nomCat` varchar(250) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Le nom de la catégorie'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Cette table contient les catégories des images';

--
-- Déchargement des données de la table `Categorie`
--

INSERT INTO `Categorie` (`catId`, `nomCat`) VALUES
(1, 'paysage'),
(2, 'bateau'),
(3, 'squelette'),
(4, 'jeux vidéos'),
(6, 'animal'),
(12, 'espace'),
(13, 'la catégorie vide');

-- --------------------------------------------------------

--
-- Structure de la table `Photo`
--

CREATE TABLE `Photo` (
  `photoId` int(11) NOT NULL COMMENT 'L''identifiant de la photo',
  `nomFich` varchar(250) CHARACTER SET utf8 NOT NULL COMMENT 'Le nom du fichier correspondant',
  `description` varchar(250) CHARACTER SET utf8 NOT NULL COMMENT 'La description de la photo',
  `catId` int(11) NOT NULL COMMENT 'L''Id de la catégorie de la photo',
  `auteur` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'L''utilisateur ayant ajouté la photo',
  `hidden` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indique si la photo est cachée'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Une photo';

--
-- Déchargement des données de la table `Photo`
--

INSERT INTO `Photo` (`photoId`, `nomFich`, `description`, `catId`, `auteur`, `hidden`) VALUES
(38, 'DSC37.png', 'Une planète rouge entourée de galaxies', 12, 'Eggman', 0),
(39, 'DSC39.png', 'La Terre dans une jarre', 12, 'Eggman', 0),
(40, 'DSC40.png', 'Un pont entre 2 étoiles', 12, 'Eggman', 1),
(41, 'DSC41.png', 'La Terre plate', 12, 'Eggman', 0),
(42, 'DSC42.png', 'Chevalier chevauchant une vache dans l\'espace', 12, 'Eggman', 0),
(43, 'DSC43.png', 'Un Kraken détruit la Terre', 12, 'Eggman', 0),
(44, 'DSC44.png', 'La Terre en forme de diplodocus', 12, 'Eggman', 0),
(45, 'DSC45.png', 'Un coucher de soleil avec un phare', 1, 'admin', 0),
(46, 'DSC46.png', 'Forêt de sapins en couleurs sépia', 1, 'admin', 0),
(47, 'DSC47.png', 'Le Mordor, avec l\'œuil de sauron au milieu', 1, 'admin', 0),
(48, 'DSC48.png', 'Phare dans la soirée', 1, 'admin', 0),
(49, 'DSC49.png', 'Soleil dans les nuages', 1, 'admin', 0),
(50, 'DSC50.png', 'Un cheval avec quelques jambes de trop', 6, 'admin', 0),
(51, 'DSC51.png', 'Un bébé dinosaure', 6, 'admin', 0),
(52, 'DSC52.png', 'Un canard cyborg', 6, 'admin', 0),
(53, 'DSC53.png', 'Une girafe clairement sur le point de tomber', 6, 'admin', 0),
(54, 'DSC54.png', 'Une chouette-terminator (terminatowl)', 6, 'admin', 0),
(55, 'DSC55.png', 'Un oiseau qui aime l\'hiver', 6, 'admin', 0),
(56, 'DSC56.png', 'Billy, un personnage du jeu Karlson', 4, 'admin', 0),
(57, 'DSC57.png', 'Des personnage du jeu Amon Us en train de dessiner', 4, 'Eggman', 1),
(58, 'DSC58.png', 'Un ours dans un carton', 6, 'Eggman', 0),
(59, 'DSC59.png', 'Hornet, un personnage du jeu Hollow Knight', 4, 'Eggman', 0),
(60, 'DSC60.png', 'Un pacman en 3D coincé par un fantôme rouge', 4, 'Eggman', 0),
(61, 'DSC61.png', 'Deux étoiles avec des visages sourient', 12, 'Eggman', 0),
(62, 'DSC62.png', 'Dromadaire habillé en Rick Astley', 6, 'admin', 0),
(63, 'DSC63.png', 'Un squelette essayant de boire', 3, 'admin', 0),
(64, 'DSC64.png', 'Un squelette travaillant en tant que serveur', 3, 'admin', 1),
(65, 'DSC65.png', 'Un squelette agacé de recevoir des os sur le crâne', 3, 'admin', 0),
(66, 'DSC66.png', 'Un poisson TIRE SON LASEEEEEEEEEEEER', 6, 'admin', 1),
(67, 'DSC67.png', 'Un bateau-taco', 2, 'Eggman', 0),
(68, 'DSC68.png', 'Un bateau volant, traversant les nuages', 2, 'Eggman', 0),
(69, 'DSC69.gif', 'Kirbo, un personnage de TerminalMontage, triste', 4, 'admin', 0),
(70, 'DSC70.png', 'Beaucoup (trop) de souris', 6, 'Eggman', 0);

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE `User` (
  `pseudo` varchar(100) NOT NULL COMMENT 'Le pseudonyme de l''utilisateur',
  `passwordHash` varchar(60) NOT NULL COMMENT 'Le Hash du mot de passe de l''utilisateur',
  `admin` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indique si l''utilisateur est administrateur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Les utilisateurs du site';

--
-- Déchargement des données de la table `User`
--

INSERT INTO `User` (`pseudo`, `passwordHash`, `admin`) VALUES
('admin', '$2y$10$dCig0vdT1jmhKC8V95i6w.UvfZuXAxH0zonPdSoF3vzJN5ZUSBXF2', 1),
('Eggman', '$2y$10$gM/hmHBQB.90sPYozzTLv.LTsWCMfC7Gpc.VCSHG2X64yreEyJtv6', 0),
('Félix', '$2y$10$JPbGlh1uAjte1oGlEF5hheZFnGUVgnRPB9dhavikLjDrFTvd0pFda', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Categorie`
--
ALTER TABLE `Categorie`
  ADD PRIMARY KEY (`catId`);

--
-- Index pour la table `Photo`
--
ALTER TABLE `Photo`
  ADD PRIMARY KEY (`photoId`),
  ADD UNIQUE KEY `photoId` (`photoId`),
  ADD KEY `Category must exist` (`catId`),
  ADD KEY `Author must exist` (`auteur`);

--
-- Index pour la table `User`
--
ALTER TABLE `User`
  ADD UNIQUE KEY `Pseudo` (`pseudo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Categorie`
--
ALTER TABLE `Categorie`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'L''identifiant de la catégorie', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `Photo`
--
ALTER TABLE `Photo`
  MODIFY `photoId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'L''identifiant de la photo', AUTO_INCREMENT=73;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Photo`
--
ALTER TABLE `Photo`
  ADD CONSTRAINT `Author must exist` FOREIGN KEY (`auteur`) REFERENCES `User` (`pseudo`) ON DELETE SET NULL,
  ADD CONSTRAINT `Category must exist` FOREIGN KEY (`catId`) REFERENCES `Categorie` (`catId`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
