-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 01, 2021 at 12:05 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `images`
--

-- --------------------------------------------------------

--
-- Table structure for table `Categorie`
--

CREATE TABLE `Categorie` (
  `catId` int(11) NOT NULL COMMENT 'L''identifiant de la catégorie',
  `nomCat` varchar(250) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Le nom de la catégorie'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Cette table contient les catégories des images';

--
-- Dumping data for table `Categorie`
--

INSERT INTO `Categorie` (`catId`, `nomCat`) VALUES
(1, 'banc'),
(2, 'bibliothèque'),
(3, 'buffet'),
(4, 'caisses'),
(5, 'chaise'),
(6, 'cheminée'),
(7, 'escalier'),
(8, 'lit'),
(9, 'râtelier'),
(10, 'table'),
(11, 'trappe');

-- --------------------------------------------------------

--
-- Table structure for table `Photo`
--

CREATE TABLE `Photo` (
  `photoId` int(11) NOT NULL COMMENT 'L''identifiant de la photo',
  `nomFich` varchar(250) CHARACTER SET utf8 NOT NULL COMMENT 'Le nom du fichier correspondant',
  `description` varchar(250) CHARACTER SET utf8 NOT NULL COMMENT 'La description de la photo',
  `catId` int(11) NOT NULL COMMENT 'L''Id de la catégorie de la photo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Une photo';

--
-- Dumping data for table `Photo`
--

INSERT INTO `Photo` (`photoId`, `nomFich`, `description`, `catId`) VALUES
(2, 'banc1.png', 'un banc en bois horizontal de 3 cases de long', 1),
(3, 'biblio1.png', 'Une bibliothèque avec un livre ouvert (3 cases)', 2),
(4, 'biblio2.png', 'Une bibliothèque avec livres et parchemins (3 cases)', 2),
(5, 'buffet1.png', 'Un buffet poussiéreux rempli de matériaux ésotériques (3 cases)', 3),
(6, 'buffet2.png', 'Un buffet rouge fermé (3 cases)', 3),
(7, 'caisses1.png', 'Un tas de 4 caisses (1 case)', 4),
(8, 'chaise1.png', 'Une chaise parée de dorures avec un coussin rouge (1 case)', 5),
(9, 'chaise2.png', 'Une modeste chaise en bois (1 case)', 5),
(10, 'chaise3.png', 'Une chaise en métal très metal (1 case)', 5),
(11, 'chaise4.png', 'Une chaise parée de dorures avec un coussin rouge au centre d\'un tapis décomposé (2x2 cases)', 5),
(12, 'cheminee1.png', 'Une cheminée protégée en longueur (4 cases)', 6),
(13, 'cheminee2.png', 'Une cheminée élaborée (2x4 cases)', 6),
(14, 'escalier1.png', 'Un escalier en colimaçon en pierre allant vers le bas (2x2 cases)', 7),
(15, 'escalier2.png', 'Un escalier classique descendant vers une grande porte (2x2 cases)', 7),
(16, 'lit1.png', 'Un lit en bois avec matelas, oreiller et couverture grise (2 cases)', 8),
(17, 'lit2.png', 'Un lit en bois avec matelat, oreiller gris et couverture à carreaux (2 cases)', 8),
(18, 'lit3.png', 'Un lit double en bois sur paille avec 2 oreillers marrons (2x2 cases)', 8),
(19, 'lit4.png', 'Un sac de couchage en cuir (2 cases)', 8),
(20, 'ratelier1.png', 'Un râtelier à armes contenant 2 glaives, 1 hache et 1 bouclier (3 cases)', 9),
(21, 'ratelier2.png', 'Un râtelier à armes contenant 1 masse à 1 main, 2 haches, 1 marteau, 1 masse à 2 mains et une masse à pics (3 cases)', 9),
(22, 'table1.png', 'Une table couverte d\'objets évoquant la magie noire (2x3 cases)', 10),
(23, 'table2.png', 'Une table en bon état avec du matériel d\'alchimie (2x3 cases)', 10),
(24, 'table3.png', 'Une table avec un équipement classique d\'aventurier: corde, protections, épée, couteau, arbalète, carquois, carte et sac à dos (2x3 cases)', 10),
(25, 'table4.png', 'Une table de taverne peu recommendable: couteau, 2 choppes renversées, 1 os et 1 bourse (2x3 cases)', 10),
(26, 'table5.png', 'Table de taverne: 1 pichet, 2 choppes, 1 bougie, 1 bourse et 1 couteau (2x3 cases)', 10),
(27, 'table6.png', 'Table carée d\'herbologie (2x2 cases)', 10),
(28, 'tonneaux1.png', '3 tonneaux (1 case)', 4),
(29, 'trappe1.jpg', 'Une trappe vers une fosse à pieux (nxn cases)', 11),
(30, 'trappe2.jpg', 'Une trappe vers un trou sans fond (4x4 cases)', 11),
(31, 'trappe3.png', 'Un piège à rondin à pics (2x2 cases)', 11),
(32, 'trappe4.png', 'Un portail noir vers une créature tentaculaire (2x3 cases)', 11),
(33, 'trappe5.png', 'Un puit de lave (2x2 cases)', 11),
(34, 'trappe6.png', 'Une flaque d\'acide (2x2 cases)', 11),
(35, 'trappe7.png', 'Une fosse dont on aperçoit le fond (nxn cases)', 11);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `pseudo` varchar(100) NOT NULL COMMENT 'Le pseudonyme de l''utilisateur',
  `passwordHash` varchar(60) NOT NULL COMMENT 'Le Hash du mot de passe de l''utilisateur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Les utilisateurs du site';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Categorie`
--
ALTER TABLE `Categorie`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `Photo`
--
ALTER TABLE `Photo`
  ADD PRIMARY KEY (`photoId`),
  ADD UNIQUE KEY `photoId` (`photoId`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD UNIQUE KEY `Pseudo` (`pseudo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Categorie`
--
ALTER TABLE `Categorie`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'L''identifiant de la catégorie', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `Photo`
--
ALTER TABLE `Photo`
  MODIFY `photoId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'L''identifiant de la photo', AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Photo`
--
ALTER TABLE `Photo`
  ADD CONSTRAINT `Category must exist` FOREIGN KEY (`catId`) REFERENCES `Categorie` (`catId`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
