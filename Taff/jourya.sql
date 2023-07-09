-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 07 juil. 2023 à 12:18
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `jourya`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `admin_lastname` varchar(30) NOT NULL,
  `admin_firstname` varchar(30) NOT NULL,
  `admin_email` varchar(30) NOT NULL,
  `admin_pass` varchar(30) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `cus_id` int NOT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `cart`
--

INSERT INTO `cart` (`cart_id`, `cus_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `cart_item`
--

DROP TABLE IF EXISTS `cart_item`;
CREATE TABLE IF NOT EXISTS `cart_item` (
  `cart_id` int NOT NULL,
  `prod_id` int NOT NULL,
  `qte` int NOT NULL,
  `unit_price` int NOT NULL,
  `dejaPaye` int NOT NULL,
  `ord_id` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `cart_item`
--

INSERT INTO `cart_item` (`cart_id`, `prod_id`, `qte`, `unit_price`, `dejaPaye`, `ord_id`) VALUES
(9, 21, 6, 109, 1, 41),
(9, 54, 6, 199, 1, 41),
(9, 89, 4, 150, 1, 41),
(1, 12, 11, 5200, 1, 39),
(1, 52, 1, 2349, 1, 39),
(1, 37, 14, 149, 1, 39),
(1, 27, 1, 149, 1, 39),
(10, 16, 3, 139, 1, 40),
(1, 19, 16, 179, 1, 39),
(9, 51, 3, 9999, 1, 41),
(9, 47, 2, 199, 1, 41),
(9, 50, 7, 5999, 1, 41),
(9, 48, 2, 299, 1, 41),
(9, 47, 3, 199, 1, 41),
(0, 54, 1, 199, 0, 0),
(0, 17, 1, 89, 0, 0),
(10, 18, 1, 249, 1, 40),
(10, 9, 1, 2154, 1, 40),
(10, 57, 1, 18, 1, 40),
(9, 78, 7, 23, 1, 41),
(9, 50, 6, 5999, 1, 41),
(9, 89, 3, 150, 1, 41),
(1, 67, 1, 849, 1, 39);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(30) NOT NULL,
  `cat_desc` varchar(30) NOT NULL,
  `cat_img` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `SubCat` int NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`cat_id`, `cat_title`, `cat_desc`, `cat_img`, `SubCat`) VALUES
(1, ' Makeup', '', '', 12),
(2, 'Skin Care', '', '', 12),
(3, 'Hair Care', '', '', 12),
(4, 'Fragrance', '', '', 12),
(5, 'Foot & Hand Care', '', '', 12),
(6, 'Tools & Accessories', '', '', 12),
(7, 'Shave & Hair Removal', '', '', 12),
(8, 'Personal Care', '', '', 12),
(9, 'Camera', '', '', 1),
(10, 'Cell Phones', '', '', 1),
(11, 'Computers', '', '', 1),
(12, 'Television', '', '', 1),
(13, 'GPS & Navigation', '', '', 1),
(14, 'Headphones', '', '', 1),
(15, 'Home Audio', '', '', 1),
(16, 'Video Projectors', '', '', 1),
(17, 'Wearable Technology', '', '', 1),
(18, 'Clothing', '', '', 2),
(19, 'Shoes', '', '', 2),
(20, 'Jewerly', '', '', 2),
(21, 'Watches', '', '', 2),
(22, 'HandBag', '', '', 2),
(23, 'Accessories', '', '', 2),
(24, 'Men\'s Fashion', '', '', 3),
(25, 'BasketBall', '', '', 41),
(26, 'Football', '', '', 41),
(27, 'Tennis', '', '', 41),
(28, 'Golf', '', '', 41),
(29, 'Natation', '', '', 41),
(30, 'Chasse et pêche', '', '', 41),
(31, 'Compléments alimentaires', '', '', 42),
(32, 'Appareils de musculation', '', '', 42),
(33, 'Accessoires Fitness & Pilates', '', '', 42),
(34, 'Vêtement d\'entrainement', '', '', 42),
(35, 'Danse', '', '', 42),
(36, 'Gymnastique artistique', '', '', 42),
(37, 'Hoverboard', '', '', 43),
(38, 'Trottinette', '', '', 43),
(39, 'Vélo', '', '', 43),
(40, 'Camping et randonnée', '', '', 43),
(41, 'Sports Nautique', '', '', 43),
(42, 'Kitchen ', '', '', 51),
(43, 'Dining Room', '', '', 51),
(44, 'Breakfast Nook', '', '', 51),
(45, 'Living Room', '', '', 52),
(46, 'Sun Room', '', '', 52),
(47, 'Family Room', '', '', 52),
(48, 'Bathroom ', '', '', 53),
(49, 'Powder Room', '', '', 53),
(50, 'Baby & Kid', '', '', 53),
(51, 'Laundry', '', '', 54),
(52, 'Garage', '', '', 54),
(61, 'New', '', '', 1),
(54, 'Girl\'s Fashion', '', '', 0),
(55, 'Boy\'s Fashion', '', '', 0),
(56, 'Health & Household', '', '', 0),
(57, 'Pet Supplie', '', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `cus_id` int NOT NULL AUTO_INCREMENT,
  `cus_username` varchar(30) NOT NULL,
  `cus_firstname` varchar(30) NOT NULL,
  `cus_lastname` varchar(30) NOT NULL,
  `cus_adr` varchar(30) NOT NULL,
  `cus_tel` int NOT NULL,
  `cus_email` varchar(30) NOT NULL,
  `cus_password` varchar(30) NOT NULL,
  `cart_id` int NOT NULL,
  `cus_admin` int NOT NULL,
  PRIMARY KEY (`cus_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `customer`
--

INSERT INTO `customer` (`cus_id`, `cus_username`, `cus_firstname`, `cus_lastname`, `cus_adr`, `cus_tel`, `cus_email`, `cus_password`, `cart_id`, `cus_admin`) VALUES
(1, 'j', 'Jack', 'Fiadeh', 'Monterieux', 8232, 'Faideh@gmail.Com', 'password', 1, 0),
(2, '&', '&', '&', '&', 999, '&', '&', 0, 0),
(6, '', '&', '&&', '&', 0, '&&&&&', '&&', 0, 1),
(8, '&&&', '&&&', 'FIADEHOUNDJI', '', 0, 'Fiadehoundji@gmail.com', '', 0, 0),
(9, 'uuuu', 'uuuoo', 'ooooo', '', 798786544, 'fdfsfd@gmail.com', 'js', 9, 1),
(10, 'Jacki', 'Jo', 'Fia', '', 767558888, 'fiad@gmail.com', 'AZ', 10, 0),
(12, 'Ayoub', 'Ayoub', 'Ourya', '', 0, 'Ayoub@gmail.com', 'ayoub', 12, 0),
(13, 'admin', 'Jo', 'Fiadeh', '', 0, 'fiadeh222@gmail.com', 'admin', 13, 1);

-- --------------------------------------------------------

--
-- Structure de la table `gr_cat`
--

DROP TABLE IF EXISTS `gr_cat`;
CREATE TABLE IF NOT EXISTS `gr_cat` (
  `idGCat` int NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `icon` text NOT NULL,
  PRIMARY KEY (`idGCat`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `ord_id` int NOT NULL AUTO_INCREMENT,
  `cus_id` int NOT NULL,
  `ord_total` int NOT NULL,
  `ord_status` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ord_adr` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `paid` int NOT NULL,
  PRIMARY KEY (`ord_id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`ord_id`, `cus_id`, `ord_total`, `ord_status`, `ord_adr`, `paid`) VALUES
(1, 1, 0, '', '', 0),
(2, 4, 0, '', '', 0),
(3, 0, 1, '', '', 0),
(4, 0, 2203, '', '', 0),
(5, 0, 2203, '', '', 0),
(6, 0, 2203, '', '', 0),
(7, 0, 2203, '', '', 0),
(8, 0, 2203, '', '', 0),
(9, 9, 2203, 'Delivered', '', 0),
(10, 9, 2203, 'Canceled', '', 0),
(11, 9, 2203, '', '', 0),
(12, 9, 2203, '', '', 0),
(13, 9, 2203, '', '', 0),
(14, 9, 2648, '', '', 0),
(15, 9, 1649, '', '', 0),
(16, 9, 2303, '', '', 0),
(17, 9, 2901, '', '', 0),
(18, 9, 44449, '', '', 0),
(19, 9, 44449, '', '', 0),
(20, 9, 44449, '', '', 0),
(21, 9, 44449, '', '', 0),
(22, 9, 74446, '', '', 0),
(23, 9, 74844, '', '', 0),
(24, 9, 74844, '', '', 0),
(25, 9, 74844, '', '', 0),
(26, 9, 74844, '', '', 0),
(27, 9, 74844, '', '', 0),
(28, 9, 74844, 'Canceled', 'ssss', 1),
(29, 9, 75441, 'Canceled', 'eeeee', 1),
(30, 9, 75441, 'Delivered', 'Rue 08 NR 145 BIS Cite AZEMOUR', 1),
(31, 10, 259, 'In Progress', 'Rue 08 NR 145 BIS Cite AZEMOUR', 1),
(32, 10, 259, 'Canceled', 'GHYJ', 1),
(33, 10, 259, 'Canceled', 'Rue 08 NR 145 BIS Cite AZEMOUR', 1),
(34, 10, 28, '', '', 0),
(35, 10, 2182, 'Canceled', 'Rue 08 NR 145 BIS Cite AZEMOUR', 1),
(36, 9, 36165, '', '', 0),
(37, 9, 36615, 'In Progress', 'koooo', 1),
(38, 1, 70102, '', '', 0),
(39, 1, 65507, 'In Progress', 'Rue 08 NR 145 BIS Cite AZEMOUR', 1),
(40, 10, 427, 'In Progress', 'Rue 08 NR 145 BIS Cite AZEMOUR', 1),
(41, 9, 610, 'In Progress', 'Rue 08 NR 145 BIS Cite AZEMOUR', 1);

-- --------------------------------------------------------

--
-- Structure de la table `order_line`
--

DROP TABLE IF EXISTS `order_line`;
CREATE TABLE IF NOT EXISTS `order_line` (
  `ord_id` int NOT NULL,
  `prod_id` int NOT NULL,
  `ol_qte` int NOT NULL,
  `ol_total_price` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `prod_id` int NOT NULL AUTO_INCREMENT,
  `prod_name` varchar(30) NOT NULL,
  `prod_price` int NOT NULL,
  `prod_desc` varchar(30) NOT NULL,
  `prod_qte` int NOT NULL,
  `cat_id` int NOT NULL,
  `prod_img` text NOT NULL,
  `brand` varchar(30) NOT NULL,
  `prod_qte_dispo` int NOT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=MyISAM AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`prod_id`, `prod_name`, `prod_price`, `prod_desc`, `prod_qte`, `cat_id`, `prod_img`, `brand`, `prod_qte_dispo`) VALUES
(1, 'XIAOMI POCO M5s - 4GB RAM, 128', 2123, 'Caractéristiques :  Processeur', 28, 10, '../../assets/products/1.jpg', 'XIAOMI', 0),
(2, 'Samsung Galaxy A04e Copper 3+3', 989, 'Display: \"6.5” HD+ PLS LCD Inf', 33, 10, '../../assets/products/2.jpg', '', 0),
(3, 'XIAOMI Redmi Note 12 Amoled 6,', 2788, '', 12, 10, '../../assets/products/3.jpg', '', 0),
(4, 'Apple iPhone 14 Pro Max 256GB/', 15789, '', 10, 10, '../../assets/products/5.jpg', '', 0),
(6, 'Apple iPhone 13 128GB Rose 6,1', 9333, '', 4, 10, '../../assets/products/6.jpg', '', 0),
(7, 'Apple iPhone 11, 6.1\", 64Go - ', 4569, '', 10, 10, '../../assets/products/7.jpg', '', 0),
(8, 'Hp PC HP 8200/6200 - Intel Cor', 1999, '', 13, 11, '../../assets/products/8.jpg', '', 0),
(9, 'Hp PC GAMER EliteDesk 800 i5-4', 2154, '', 2, 11, '../../assets/products/9.jpg', '', 0),
(10, 'XIAOMI Mi 23.8\" Desktop Monito', 1683, '', 42, 11, '../../assets/products/10.jpg', '', 0),
(12, 'XIAOMI Mi Curved Gaming Monito', 5200, '', 5, 11, '../../assets/products/11.jpg', '', 0),
(13, 'Aoc Écran LED 24\" 24P1 - Full ', 1399, '', 15, 11, '../../assets/products/12.jpg', '', 0),
(14, 'Aoc ECRAN 24P1 DisplayPort, HD', 1579, '', 1, 11, '../../assets/products/14.jpg', '', 0),
(15, 'Hp EliteDisplay E233 DisplayPo', 1500, '', 6, 11, '../../assets/products/15.jpg', '', 0),
(16, 'tee-shirt-running-homme-respir', 139, '', 111, 24, '../../assets/products/16.jpg', '', 0),
(17, 't-shirt-fitness-cardio-trainin', 89, '', 23, 24, '../../assets/products/17.jpg', '', 0),
(18, 'POLO DE GOLF MANCHES COURTES H', 249, '', 12, 24, '../../assets/products/18.jpg', '', 0),
(19, 'TEE SHIRT MANCHES LONGUES DE R', 179, '', 21, 24, '../../assets/products/19.jpg', '', 0),
(20, 'T-SHIRT REGULAR FITNESS HOMME ', 60, '', 9, 24, '../../assets/products/20.jpg', '', 0),
(21, 'T-SHIRT FITNESS MANCHES COURTE', 109, '', 32, 24, '../../assets/products/21.jpg', '', 0),
(22, 'BERMUDA 500 CAMOUFLAGE WOODLAN', 249, '', 8, 24, '../../assets/products/22.jpg', '', 0),
(23, 'short-running-respirant-homme-', 159, '', 98, 24, '../../assets/products/23.jpg', '', 0),
(24, 'SHORT LONG 2 EN 1 DE RUNNING H', 249, '', 5, 24, '../../assets/products/24.jpg', '', 0),
(25, 'SHORT DE FOOTBALL VIRALTO CLUB', 149, '', 22, 24, '../../assets/products/25.jpg', '', 0),
(26, 'SHORT DE TENNIS HOMME TSH 900 ', 130, '', 6, 24, '../../assets/products/26.jpg', '', 0),
(27, 'SHORT FITNESS HOMME - 500 ESSE', 149, '', 12, 24, '../../assets/products/27.jpg', '', 0),
(71, 'THE ART BOX Affiche Decoration', 6, '', 0, 46, '../../assets/products/112.jpg', '', 0),
(31, 'POLO DE GOLF MANCHES LONGUES H', 199, '', 7, 24, '../../assets/products/28.jpg', '', 0),
(33, 'PANTALON RUNNING RESPIRANT HOM', 189, '', 12, 24, '../../assets/products/33.jpg', '', 0),
(70, ' ZWGQZYTX Fenêtre Sheer Rideau', 21, '', 0, 46, '../../assets/products/111.jpg', '', 0),
(37, 'PULL DE RANDONNÉE - NH150 COL ', 149, '', 6, 24, '../../assets/products/39.jpg', '', 0),
(38, 'CHEMISE MANCHES LONGUES DE TRE', 398, '', 8, 24, '../../assets/products/40.jpg', '', 0),
(39, 'SWEAT DE FITNESS ESSENTIEL RES', 249, '', 2, 24, '../../assets/products/41.jpg', '', 0),
(40, 'TROTTINETTE 3 ROUES ENFANT B1 ', 299, '', 55, 38, '../../assets/products/42.jpg\r\n', '', 0),
(41, 'TROTTINETTE 3 ROUES ENFANT B1 ', 999, '', 8, 38, '../../assets/products/43.jpg\r\n', '', 0),
(42, 'TROTTINETTE 3 ROUES ENFANT B1 ', 699, '', 52, 38, '../../assets/products/44.jpg\r\n', '', 0),
(43, 'TROTTINETTE ADULTE T7XL NOIRE', 1689, '', 3, 38, '../../assets/products/42.jpg\r\n', '', 0),
(45, 'BALLON DE BASKET BT100', 379, '', 7, 25, '../../assets/products/45.jpg', '', 0),
(46, 'CHAUSSURES DE BASKETBALL TIGE ', 549, '', 32, 25, '../../assets/products/46.jpg', '', 0),
(47, 'BALLON DE BASKET BT100 DE TAIL', 199, '', 7, 25, '../../assets/products/48.jpg', '', 0),
(48, 'BALLON DE BASKETBALL TAILLE 7 ', 299, '', 12, 25, '../../assets/products/49.jpg', '', 0),
(49, 'CHAUSSURES DE BASKETBALL ENFAN', 299, '', 21, 25, '../../assets/products/50.jpg', '', 0),
(50, 'PANIER DE BASKET SUR PIED RÉGL', 5999, '', 0, 25, '../../assets/products/51.jpg', '', 0),
(51, 'PANIER DE BASKET PLIABLE SUR R', 9999, '', 21, 25, '../../assets/products/52.jpg', '', 0),
(52, 'CERCLE DE BASKETBALL RING 500 ', 2349, '', 22, 25, '../../assets/products/53.jpg', '', 0),
(53, 'CHAUSSURES DE BASKETBALL ENFAN', 499, '', 0, 25, '../../assets/products/54.jpg', '', 0),
(54, 'T-SHIRT / MAILLOT BASKETBALL H', 199, '', 99, 25, '../../assets/products/55.jpg', '', 0),
(55, 'Apple iPhone 14 Pro Max 256GB/', 15459, '', 10, 10, '../../assets/products/5.jpg', '', 0),
(56, 'Black Women\'s Coat Dress', 130, '', 0, 0, '../../assets/products/apparel4.jpg', '', 0),
(57, 'Pro Onion Chopper, Multifuncti', 18, '', 233, 42, '../../assets/products/100.jpg', '', 0),
(62, 'Dining Table Set with Collapsi', 150, '', 0, 43, '../../assets/products/103.jpg', '', 0),
(63, 'NIERN Tempered Glass Dining Ta', 170, '', 0, 43, '../../assets/products/104.jpg', '', 0),
(69, 'Aspire Homeware traitements de', 59, '', 0, 46, '../../assets/products/110.jpg', '', 0),
(64, 'H.VERSAILTEX Blackout Tie Up C', 29, '', 0, 44, '../../assets/products/105.jpg', '', 0),
(65, 'VECELO 3-Piece Dining Room Woo', 104, '', 0, 44, '../../assets/products/106.jpg', '', 0),
(66, 'HOMORE Luxury Fluffy Area Rug ', 39, '', 0, 45, '../../assets/products/107.jpg', '', 0),
(67, 'celimi Farmhouse Wagon Wheel C', 849, '', 0, 45, '../../assets/products/108.jpg', '', 0),
(68, 'Air Purifiers for Bedroom, Hep', 70, '', 0, 45, '../../assets/products/109.jpg', '', 45),
(72, ' Mr Mrs Family Simple Quote Wa', 143, '', 0, 47, '../../assets/products/113.jpg', '', 0),
(73, 'Glart 3 universal fluffy 600 G', 20, '', 0, 48, '../../assets/products/114.jpg', '', 0),
(74, ' Relaxdays Lot d’Accessoires d', 24, '', 0, 48, '../../assets/products/115.jpg', '', 0),
(75, 'Yankee Candle Cire parfumée po', 2, '', 0, 49, '../../assets/products/116.jpg', '', 0),
(76, ' Bent Eyeliner Brush, Gel Eyel', 8, '', 0, 49, '../../assets/products/117.jpg', '', 0),
(77, ' KINOUSSES - Kit Naissance 6 P', 56, '', 0, 50, '../../assets/products/118.jpg', '', 0),
(78, 'FantasyDay 28 Pcs Kit de Maqui', 23, '', 0, 1, '../../assets/products/119.jpg', '', 0),
(79, ' NYX Professional Makeup Glue ', 8, '', 0, 50, '../../assets/products/120.jpg', '', 0),
(80, ' NIVEA Derma Skin Clear Gel ne', 34, '', 0, 2, '../../assets/products/121.jpg', '', 0),
(81, 'L\'Oréal Paris - Midnight Sérum', 76, '', 0, 2, '../../assets/products/122.jpg', '', 0),
(89, 'Adidas Shoes', 150, '', 0, 0, '../../assets/products/150.jpg', '', 0),
(95, 'chaussure-de-football-terrain-', 112, '', 44, 26, '../../assets/products/chaussure-de-football-terrain-dur-agility-100-hg-noire-rouge.jpg', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `rvw_id` int NOT NULL AUTO_INCREMENT,
  `cus_id` int NOT NULL,
  `rvw_review` text NOT NULL,
  `prod_id` int NOT NULL,
  `rvw_update_date` date NOT NULL,
  `rvw_rating` int NOT NULL,
  PRIMARY KEY (`rvw_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
