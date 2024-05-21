-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2024 at 11:03 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `vcode` varchar(45) DEFAULT NULL,
  `m_status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `vcode`, `m_status`) VALUES
(3, 'dissanayakedmtn.22@uom.lk', '663748a85c940', 0);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `bname` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `bname`) VALUES
(1, 'Apple'),
(2, 'Samsung'),
(3, 'Canon'),
(4, 'Nikon'),
(5, 'Dell');

-- --------------------------------------------------------

--
-- Table structure for table `brand_has_model`
--

CREATE TABLE `brand_has_model` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `brand_has_model`
--

INSERT INTO `brand_has_model` (`id`, `brand_id`, `model_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 2, 9),
(10, 5, 10),
(11, 1, 11),
(12, 1, 12),
(13, 2, 13),
(14, 2, 14),
(15, 2, 15),
(16, 3, 16),
(17, 1, 17),
(18, 1, 18),
(19, 1, 19),
(20, 1, 20),
(21, 1, 21),
(22, 1, 22),
(23, 1, 23),
(24, 1, 24),
(25, 1, 25),
(26, 1, 26),
(27, 3, 27),
(28, 3, 28);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `user_email`, `qty`) VALUES
(67, 5, 'gayaranaweera006@gmail.com', 1),
(75, 3, 'gayaranaweera001@gmail.com', 1),
(76, 5, 'gayaranaweera001@gmail.com', 1),
(94, 15, 'kasu@gmail.com', 10);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `catname` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `catname`) VALUES
(1, 'Tablet'),
(2, 'Cellphone and accessories'),
(3, 'Laptop'),
(4, 'Camera');

-- --------------------------------------------------------

--
-- Table structure for table `colour`
--

CREATE TABLE `colour` (
  `id` int(11) NOT NULL,
  `colour` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `colour`
--

INSERT INTO `colour` (`id`, `colour`) VALUES
(1, 'Red'),
(2, 'Blue'),
(3, 'Pink'),
(4, 'Black'),
(5, 'Silver'),
(6, 'White');

-- --------------------------------------------------------

--
-- Table structure for table `condition`
--

CREATE TABLE `condition` (
  `id` int(11) NOT NULL,
  `conname` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `condition`
--

INSERT INTO `condition` (`id`, `conname`) VALUES
(1, 'Brand New'),
(2, 'Used');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `feedback` text DEFAULT NULL,
  `star` int(11) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `m_status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `product_id`, `user_email`, `feedback`, `star`, `time`, `m_status`) VALUES
(1, 2, 'gayaranaweera006@gmail.com', 'Really good product', 3, '2022-12-14 19:10:01', 1),
(3, 5, 'gayaranaweera006@gmail.com', 'Supper!!', 4, '2022-12-14 19:10:03', 1),
(4, 9, 'gayaranaweera003@gmail.com', 'Good', 4, '2023-04-03 23:39:05', 1),
(5, 3, 'gayaranaweera003@gmail.com', 'Patta', 2, '2023-04-03 23:40:18', 0),
(6, 3, 'gayaranaweera003@gmail.com', 'Good', 4, '2023-04-04 00:58:56', 0),
(7, 2, 'gayaranaweera00456@gmail.com', 'Patta', 4, '2024-05-02 19:30:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `img`
--

CREATE TABLE `img` (
  `code1` text DEFAULT NULL,
  `code2` text DEFAULT NULL,
  `code3` text DEFAULT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `img`
--

INSERT INTO `img` (`code1`, `code2`, `code3`, `product_id`) VALUES
('img//Apple iPhone 13 Mini_0_66334e747b08e.webp', 'img//Apple iPhone 13 Mini_1_66334e747bc5f.webp', 'img//Apple iPhone 13 Mini_2_66334e747c9fd.webp', 2),
('img//Apple iPhone 13_0_66334e26e66de.webp', 'img//Apple iPhone 13_1_66334e26e79e4.webp', 'img//Apple iPhone 13_2_66334e26e8593.webp', 3),
('img//Apple MacBook Pro M2 _0_66334ccf3d87a.webp', 'img//Apple MacBook Pro M2 _1_66334ccf3e330.webp', 'img//Apple MacBook Pro M2 _2_66334ccf3ed97.webp', 5),
('img//Apple iPad_0_66334b60b89fc.webp', 'img//Apple iPad_1_66334b60baabb.webp', 'img//Apple iPad_2_66334b60bbc40.webp', 9),
('img//Apple iPhone 12_0_66334de1dd5a3.webp', 'img//Apple iPhone 12_1_66334de1ddf0c.webp', 'img//Apple iPhone 12_2_66334de1de81a.webp', 10),
('img//Apple iPhone 14_0_66334da7efacf.webp', 'img//Apple iPhone 14_1_66334da7f1c91.webp', 'img//Apple iPhone 14_2_66334da7f26c2.webp', 11),
('img//samsung galaxy A50_0_66334d5638c27.webp', 'img//samsung galaxy A50_1_66334d5639df5.webp', 'img//samsung galaxy A50_2_66334d563adce.webp', 12),
('img//samsung galaxy s-10_0_66334d19b8813.webp', 'img//samsung galaxy s-10_1_66334d19b922a.webp', 'img//samsung galaxy s-10_2_66334d19b9c9e.webp', 13),
('img//samsung tab s-6_0_66333bf1c8ce4.webp', 'img//samsung tab s-6_1_66333bf1ce2e8.webp', 'img//samsung tab s-6_2_66333bf1cedfe.webp', 14),
('img//canon DSLR_0_66334c1c3e277.jpeg', 'img//canon DSLR_1_66334c1c3fe7c.jpeg', 'img//canon DSLR_2_66334c1c40908.jpeg', 15),
('img//Apple IPone 13 Pro Max_0_6633503a158a3.webp', 'img//Apple IPone 13 Pro Max_1_6633503a16b9e.webp', 'img//Apple IPone 13 Pro Max_2_6633503a18bd7.webp', 16),
('img//Apple IPhone 14 Pro Max_0_66335095a65e7.webp', 'img//Apple IPhone 14 Pro Max_1_66335095a745a.webp', 'img//Apple IPhone 14 Pro Max_2_66335095a8fa0.webp', 17),
('img//Apple IPhone 15 Plus_0_663350f0197e4.webp', 'img//Apple IPhone 15 Plus_1_663350f01a212.webp', 'img//Apple IPhone 15 Plus_2_663350f01b0a5.webp', 18),
('img//Apple iPad Air (4th Gen)_0_66335195e0e44.webp', 'img//Apple iPad Air (4th Gen)_1_66335195e2739.webp', 'img//Apple iPad Air (4th Gen)_2_66335195e41e8.webp', 19),
('img//Apple iPad Air (5th Gen)_0_663351e040311.webp', 'img//Apple iPad Air (5th Gen)_1_663351e040d00.webp', 'img//Apple iPad Air (5th Gen)_2_663351e041c50.webp', 20),
('img//Apple iPad Mini_0_6633522e297d3.webp', 'img//Apple iPad Mini_1_6633522e2a1b6.webp', 'img//Apple iPad Mini_2_6633522e2b19b.webp', 21),
('img//Apple iPad Pro M2_0_6633526e70803.webp', 'img//Apple iPad Pro M2_1_6633526e7199f.webp', NULL, 22),
('img//MacBook Pro M3 _0_663353b4bb293.webp', 'img//MacBook Pro M3 _1_663353b4bc290.webp', 'img//MacBook Pro M3 _2_663353b4bd47c.webp', 23),
('img//MacBook Pro M2 _0_663353fd97698.webp', 'img//MacBook Pro M2 _1_663353fd983e3.webp', 'img//MacBook Pro M2 _2_663353fd997be.webp', 24),
('img//MacBook Pro M1 _0_6633544761efb.webp', 'img//MacBook Pro M1 _1_6633544762883.webp', 'img//MacBook Pro M1 _2_6633544763516.webp', 25),
('img//Nikon D7500 DSLR Camera with 18-140mm Lens_0_663355c38d055.jpeg', 'img//Nikon D7500 DSLR Camera with 18-140mm Lens_1_663355c38e662.jpeg', 'img//Nikon D7500 DSLR Camera with 18-140mm Lens_2_663355c38fd17.jpeg', 26),
('img//Canon EOS 250D DSLR Camera with 18-55 Lens_0_6633560c561d4.jpeg', 'img//Canon EOS 250D DSLR Camera with 18-55 Lens_1_6633560c56c5e.jpeg', 'img//Canon EOS 250D DSLR Camera with 18-55 Lens_2_6633560c57554.jpeg', 27);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `order_id` varchar(45) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `time` datetime DEFAULT NULL,
  `a_status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`order_id`, `user_email`, `time`, `a_status`) VALUES
('63985d9e22c96', 'gayaranaweera006@gmail.com', '2022-12-13 16:41:11', 1),
('63985e5d1a338', 'gayaranaweera006@gmail.com', '2022-12-13 16:44:01', 1),
('63985ea616bc4', 'gayaranaweera006@gmail.com', '2022-12-13 16:45:07', 2),
('639893987c54f', 'gayaranaweera006@gmail.com', '2022-12-13 20:31:26', 2),
('63989469db21d', 'gayaranaweera006@gmail.com', '2022-12-13 20:34:50', 2),
('63989c228ca9e', 'gayaranaweera006@gmail.com', '2022-12-13 21:08:14', 1),
('6399c06c67351', 'gayaranaweera006@gmail.com', '2022-11-14 17:54:40', 1),
('6399c168a1981', 'gayaranaweera006@gmail.com', '2022-12-14 17:58:42', 2),
('6399c1828d8cd', 'gayaranaweera006@gmail.com', '2022-12-14 17:59:09', 2),
('639aa0f042d0e', 'gayaranaweera006@gmail.com', '2022-10-15 09:53:28', 2),
('639c11b8d25d0', 'gayaranaweera006@gmail.com', '2022-07-16 12:06:22', 0),
('639c14bd2b4d2', 'gayaranaweera006@gmail.com', '2022-12-16 12:18:51', 1),
('63bea0d3b7c54', 'janinduranaweera0001@gmail.com', '2023-01-11 17:14:51', 2),
('642b0b0bb6450', 'gayaranaweera003@gmail.com', '2023-04-03 22:51:15', 1),
('642b0b113073f', 'gayaranaweera003@gmail.com', '2023-04-03 22:51:21', 1),
('642b0b1740733', 'gayaranaweera003@gmail.com', '2023-04-03 22:51:27', 0),
('642b0b20dcaaa', 'gayaranaweera003@gmail.com', '2023-04-03 22:51:36', 0),
('642b0b3177030', 'gayaranaweera003@gmail.com', '2023-04-03 22:51:53', 0),
('642b0b59bc9ad', 'gayaranaweera003@gmail.com', '2023-04-03 22:52:33', 0),
('642b0bc2a703e', 'gayaranaweera003@gmail.com', '2023-04-03 22:54:29', 0),
('642b0bd110b9e', 'gayaranaweera003@gmail.com', '2023-04-03 22:54:39', 0),
('642b0bf4e07d1', 'gayaranaweera003@gmail.com', '2023-04-03 22:55:14', 0),
('642b28996e94f', 'gayaranaweera003@gmail.com', '2023-04-04 00:57:26', 1),
('642b294433183', 'gayaranaweera003@gmail.com', '2023-04-04 01:00:14', 2),
('642b902c41c66', 'gayaranaweera003@gmail.com', '2023-04-04 08:19:21', 0),
('642b913f11705', 'gayaranaweera003@gmail.com', '2023-04-04 08:23:55', 2),
('6628a3f1544c8', 'gayaranaweera0088@gmail.com', '2024-04-24 11:47:52', 0),
('6628a47f1fc67', 'gayaranaweera0088@gmail.com', '2024-04-24 11:49:52', 0),
('6628a49aca38a', 'gayaranaweera0088@gmail.com', '2024-04-24 11:50:16', 0),
('6628a4a6ce4d8', 'gayaranaweera0088@gmail.com', '2024-04-24 11:50:29', 0),
('6628a4b916a73', 'gayaranaweera0088@gmail.com', '2024-04-24 11:50:46', 0),
('66333777ace5a', 'gayaranaweera00456@gmail.com', '2024-05-02 12:19:52', 0),
('6633a4262163a', 'gayaranaweera00456@gmail.com', '2024-05-02 20:03:22', 0),
('663739e26b2d9', 'dissanayakedmtn.22@uom.lk', '2024-05-05 13:19:09', 0),
('6637491e1fe18', 'dissanayakedmtn.22@uom.lk', '2024-05-05 14:23:59', 0),
('6637495dab63f', 'dissanayakedmtn.22@uom.lk', '2024-05-05 14:25:07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_item`
--

CREATE TABLE `invoice_item` (
  `id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `buy_price` double NOT NULL,
  `product_id` int(11) NOT NULL,
  `invoice_order_id` varchar(45) NOT NULL,
  `u_status` int(11) DEFAULT 1,
  `m_status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `invoice_item`
--

INSERT INTO `invoice_item` (`id`, `qty`, `buy_price`, `product_id`, `invoice_order_id`, `u_status`, `m_status`) VALUES
(4, 2, 7000, 5, '639893987c54f', 0, 1),
(6, 1, 10000, 2, '639893987c54f', 0, 0),
(8, 1, 7000, 5, '63989469db21d', 0, 0),
(9, 1, 7000, 5, '63989c228ca9e', 0, 0),
(13, 1, 7000, 5, '639aa0f042d0e', 1, 0),
(14, 1, 10000, 2, '639c11b8d25d0', 1, 0),
(15, 1, 7000, 5, '639c14bd2b4d2', 1, 0),
(16, 1, 10000, 3, '639c14bd2b4d2', 1, 1),
(17, 1, 10000, 2, '639c14bd2b4d2', 1, 1),
(18, 1, 7000, 5, '63bea0d3b7c54', 1, 0),
(19, 1, 10000, 3, '642b0b0bb6450', 1, 1),
(20, 1, 85000, 9, '642b0b59bc9ad', 1, 1),
(21, 1, 85000, 9, '642b0bc2a703e', 1, 0),
(22, 1, 85000, 9, '642b0bf4e07d1', 1, 0),
(23, 2, 10000, 3, '642b28996e94f', 1, 0),
(24, 2, 7000, 5, '642b28996e94f', 1, 0),
(25, 1, 10000, 3, '642b294433183', 1, 0),
(26, 1, 65000, 13, '642b902c41c66', 1, 0),
(27, 1, 85000, 9, '642b913f11705', 1, 0),
(28, 4, 6500, 14, '6628a3f1544c8', 1, 0),
(29, 1, 65000, 13, '6628a47f1fc67', 1, 0),
(30, 1, 65000, 13, '6628a49aca38a', 1, 0),
(31, 1, 100000, 15, '6628a4a6ce4d8', 1, 0),
(32, 1, 6500, 14, '6628a4b916a73', 1, 0),
(33, 1, 10000, 2, '66333777ace5a', 1, 1),
(34, 1, 85000, 9, '6633a4262163a', 1, 1),
(35, 1, 384900, 25, '6633a4262163a', 1, 0),
(36, 1, 384900, 25, '663739e26b2d9', 1, 0),
(37, 1, 299900, 26, '6637491e1fe18', 1, 0),
(38, 5, 504000, 23, '6637495dab63f', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `id` int(11) NOT NULL,
  `mname` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id`, `mname`) VALUES
(1, 'iPhone 7'),
(2, 'iPhone 8'),
(3, 'iPhone 9'),
(4, 'iPhone 10'),
(5, 'iPhone 11'),
(6, 'iPhone 12'),
(7, 'MacBook'),
(8, 'iPad'),
(9, 'J7'),
(10, 'core i7'),
(11, 'iPhone12'),
(12, 'iPhone 14'),
(13, 'galaxy'),
(14, 's10'),
(15, 'galaxy s6'),
(16, '4000D DSLR'),
(17, 'IPhone 13 Pro'),
(18, 'IPhone 14 Pro Max'),
(19, 'IPhone 15 Plus'),
(20, 'iPad Air'),
(21, 'iPad Mini'),
(22, 'iPad Pro M1'),
(23, 'iPad Pro M2'),
(24, 'MacBook Pro M3'),
(25, 'MacBook Pro M2'),
(26, 'MacBook Pro M1'),
(27, 'DSLR'),
(28, '250D DSLR');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `description` text DEFAULT NULL,
  `qty` varchar(45) DEFAULT NULL,
  `brand_has_model_id` int(11) NOT NULL,
  `condition_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `colour_id` int(11) NOT NULL,
  `upload_date` datetime DEFAULT NULL,
  `m_status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `title`, `price`, `description`, `qty`, `brand_has_model_id`, `condition_id`, `category_id`, `status_id`, `colour_id`, `upload_date`, `m_status`) VALUES
(2, 'Apple iPhone 13 Mini', 239900, 'Apple iPhone 13 Mini Brand New', '12', 2, 1, 2, 1, 6, '2024-05-02 13:58:09', 0),
(3, 'Apple iPhone 13', 199900, 'Apple iPhone 9 Brand New', '10', 3, 1, 2, 1, 5, '2024-05-02 13:56:14', 1),
(5, 'Apple MacBook Pro M2 ', 394900, 'Apple MacBook Brand New', '5', 7, 1, 3, 1, 4, '2024-05-02 13:58:24', 0),
(9, 'Apple iPad', 85000, 'Brand New Apple iPad', '25', 8, 1, 1, 1, 2, '2024-05-02 13:44:24', 0),
(10, 'Apple iPhone 12', 100000, 'Brand New Apple iPhone 12', '10', 6, 1, 2, 1, 4, '2024-05-02 13:55:05', 0),
(11, 'Apple iPhone 14', 85000, 'Brand New Apple iPhone 14', '15', 12, 1, 2, 1, 4, '2024-05-02 13:54:07', 0),
(12, 'samsung galaxy A50', 75000, 'Brand new Samsung galaxy A50', '10', 13, 1, 2, 1, 4, '2024-05-02 13:52:46', 0),
(13, 'samsung galaxy s-10', 65000, 'Brand New samsung galaxy s-10', '7', 14, 1, 2, 1, 5, '2024-05-02 13:51:45', 0),
(14, 'samsung tab s-6', 120000, 'Brand new Samsung Galaxy Tab S6\r\n', '8', 15, 1, 1, 1, 4, '2024-05-02 13:57:48', 0),
(15, 'canon DSLR', 250000, 'Brand new canon DSLR', '13', 16, 1, 4, 1, 4, '2024-05-02 13:58:38', 0),
(16, 'Apple IPone 13 Pro Max', 3299000, 'A Good Quality Product', '6', 17, 1, 2, 1, 4, '2024-05-02 14:05:06', 0),
(17, 'Apple IPhone 14 Pro Max', 379900, 'A Brand New Item', '8', 18, 1, 2, 1, 5, '2024-05-02 14:06:37', 0),
(18, 'Apple IPhone 15 Plus', 249900, 'A Brand New Item and Trusted Seller', '9', 19, 1, 2, 1, 4, '2024-05-02 14:08:08', 0),
(19, 'Apple iPad Air (4th Gen)', 189900, 'Good Quality Product', '3', 20, 1, 1, 1, 5, '2024-05-02 14:10:53', 0),
(20, 'Apple iPad Air (5th Gen)', 159900, 'Good Quality Product and  bearly used', '5', 20, 2, 1, 1, 5, '2024-05-02 14:12:08', 0),
(21, 'Apple iPad Mini', 169900, 'Good Quality Product and  Trusted seller', '5', 21, 1, 1, 1, 5, '2024-05-02 14:13:26', 0),
(22, 'Apple iPad Pro M2', 264900, 'Good Quality Product and  Trusted seller', '5', 23, 1, 1, 1, 5, '2024-05-02 14:14:30', 0),
(23, 'MacBook Pro M3 ', 504000, 'A Good Quality Durable Product', '5', 24, 1, 3, 1, 5, '2024-05-02 14:19:56', 1),
(24, 'MacBook Pro M2 ', 374900, 'A Good Quality Durable Product', '15', 25, 1, 3, 1, 5, '2024-05-02 14:21:09', 0),
(25, 'MacBook Pro M1 ', 384900, 'By Trusted Seller', '4', 26, 1, 3, 1, 5, '2024-05-02 14:22:23', 0),
(26, 'Nikon D7500 DSLR Camera with 18-140mm Lens', 299900, '3.2\" 922k-Dot Tilting Touchscreen LCD', '2', 27, 1, 4, 1, 4, '2024-05-02 14:28:43', 0),
(27, 'Canon EOS 250D DSLR Camera with 18-55 Lens', 189500, 'UHD 4K24p Video and 4K Time-Lapse Movie', '4', 28, 1, 4, 1, 4, '2024-05-02 14:29:56', 0);

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `id` int(11) NOT NULL,
  `district` varchar(45) DEFAULT NULL,
  `fee` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`id`, `district`, `fee`) VALUES
(1, 'Kegalle', 1400),
(2, 'Ampara', 600),
(3, 'Anuradhapura', 300),
(4, 'Badulla', 400),
(5, 'Batticaloa', 100),
(6, 'Colombo', 500),
(7, 'Galle', 300),
(8, 'Gampaha', 400),
(9, 'Hambantota', 500),
(10, 'Jaffna', 1000),
(11, 'Kalutara', 400),
(12, 'Kandy', 600),
(13, 'Kilinochchi', 300),
(14, 'Kurunegala', 300),
(15, 'Mannar', 400),
(16, 'Matale', 300),
(17, 'Matara', 300),
(18, 'Monaragala', 300),
(19, 'Nuwara Eliya', 300),
(20, 'Polonnaruwa', 300),
(21, 'Puttalam', 300),
(22, 'Ratnapura', 300),
(23, 'Trincomalee', 300),
(24, 'Vavuniya', 300),
(25, 'Mullaitivu', 300);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
(1, 'Active'),
(2, 'Deactive');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  `mobile1` varchar(12) DEFAULT NULL,
  `mobile2` varchar(12) DEFAULT NULL,
  `line1` varchar(100) DEFAULT NULL,
  `line2` varchar(100) DEFAULT NULL,
  `pcode` varchar(10) DEFAULT NULL,
  `shipping_id` int(11) DEFAULT NULL,
  `a_status` int(11) DEFAULT 1,
  `time` datetime DEFAULT NULL,
  `m_status` int(11) DEFAULT 0,
  `vcode` varchar(45) DEFAULT NULL,
  `profile_pic` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`fname`, `lname`, `email`, `password`, `mobile1`, `mobile2`, `line1`, `line2`, `pcode`, `shipping_id`, `a_status`, `time`, `m_status`, `vcode`, `profile_pic`) VALUES
('Thishani', 'Dissanayake', 'dissanayakedmtn.22@uom.lk', '12345678', '0719367715', '234567890', 'wsedrcftvgbhnjmk,l', 'sxdcfvgbhjnk,l', '72350', 1, 1, '2024-05-05 13:07:29', 1, NULL, NULL),
('Gaya', 'Ranaweera', 'gayaranaweera001@gmail.com', 'Gaya2002#', '0771259526', '', 'Anguruwella road, niyadurupola', '', '71602', 12, 1, '2023-01-30 12:29:12', 1, NULL, ''),
('Gaya', 'Ranaweera', 'gayaranaweera003@gmail.com', 'Gaya2002#', '0701258536', '', 'Anguruwella road, niyadurupola', '', '71602', 2, 1, '2022-12-18 02:12:33', 0, '639f86e657b92', 'profile_pic/propic_642b91771911c_Gaya.webp'),
('gaya', 'ranaweera', 'gayaranaweera00456@gmail.com', 'Gaya2002#', '0785373789', '1234567890', 'vfc dfvsd/adsv/aefwqef', 'ebv ergfwe werqg3efrqwef', '125432', 12, 1, '2024-05-01 19:09:13', 1, NULL, 'profile_pic/propic_6633371c26993_gaya.png'),
('gaya', 'ranaweera', 'gayaranaweera005@gmail.com', 'Gaya2002#', '0753873891', NULL, NULL, NULL, NULL, 1, 1, '2022-12-17 11:55:40', 1, NULL, ''),
('Gaya', 'Ranaweera', 'gayaranaweera006@gmail.com', 'Gaya2002#', '0701259526', '0702741596', 'Anguruwella road, niyadurupola', '', '71602', 1, 1, '2022-12-17 11:55:41', 0, NULL, ''),
('Gaya', 'Ranaweera', 'gayaranaweera0088@gmail.com', 'gaya1234', '0701259566', '', 'Anguruwella road, niyadurupola', '', '71602', 1, 1, '2024-04-24 10:52:33', 0, NULL, 'profile_pic/propic_6628a45f3f31f_Gaya.jpg'),
('Gaya', 'Ranaweera', 'gayaranaweera@gmail.com', 'Gaya2002#', '0700259526', NULL, NULL, NULL, NULL, 2, 1, '2022-12-18 11:14:19', 0, NULL, ''),
('Janindu', 'Ranaweera', 'janinduranaweera0001@gmail.com', 'janindu', '0786226678', '0701259526', 'Anguruwella road, niyadurupola', '', '71602', 4, 1, '2022-12-18 11:15:56', 0, NULL, ''),
('Gaya', 'Ranaweera', 'janinduranaweera001@gmail.com', 'Gaya2002#', '0701245378', NULL, NULL, NULL, NULL, 1, 1, '2022-12-18 02:15:00', 0, NULL, ''),
('gaya', 'Ranaweera', 'kasu@gmail.com', 'Kasu@123', '0701259545', NULL, NULL, NULL, NULL, 1, 1, '2024-03-27 22:24:27', 0, NULL, NULL),
('Sansala', 'Ranaweera', 'sansalaranaweera001@gmail.com', 'salamax', '0745783967', NULL, NULL, NULL, NULL, 19, 1, '2022-12-18 11:17:14', 0, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `watchlist`
--

CREATE TABLE `watchlist` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `watchlist`
--

INSERT INTO `watchlist` (`id`, `product_id`, `user_email`) VALUES
(25, 2, 'gayaranaweera006@gmail.com'),
(54, 3, 'gayaranaweera003@gmail.com'),
(57, 14, 'gayaranaweera0088@gmail.com'),
(58, 15, 'gayaranaweera0088@gmail.com'),
(59, 13, 'gayaranaweera0088@gmail.com'),
(91, 14, 'gayaranaweera00456@gmail.com'),
(101, 23, 'gayaranaweera00456@gmail.com'),
(103, 26, 'gayaranaweera00456@gmail.com'),
(107, 25, 'gayaranaweera00456@gmail.com'),
(113, 26, 'dissanayakedmtn.22@uom.lk'),
(114, 23, 'dissanayakedmtn.22@uom.lk');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_has_model`
--
ALTER TABLE `brand_has_model`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_brand_has_model_model1_idx` (`model_id`),
  ADD KEY `fk_brand_has_model_brand1_idx` (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_has_user_user1_idx` (`user_email`),
  ADD KEY `fk_product_has_user_product1_idx` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colour`
--
ALTER TABLE `colour`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `condition`
--
ALTER TABLE `condition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_has_user_user4_idx` (`user_email`),
  ADD KEY `fk_product_has_user_product3_idx` (`product_id`);

--
-- Indexes for table `img`
--
ALTER TABLE `img`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_product_has_user_user3_idx` (`user_email`);

--
-- Indexes for table `invoice_item`
--
ALTER TABLE `invoice_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_invoice_item_product1_idx` (`product_id`),
  ADD KEY `fk_invoice_item_invoice1_idx` (`invoice_order_id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_brand_has_model1_idx` (`brand_has_model_id`),
  ADD KEY `fk_product_condition1_idx` (`condition_id`),
  ADD KEY `fk_product_category1_idx` (`category_id`),
  ADD KEY `fk_product_status1_idx` (`status_id`),
  ADD KEY `fk_product_colour1_idx` (`colour_id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`),
  ADD KEY `fk_user_shipping1_idx` (`shipping_id`);

--
-- Indexes for table `watchlist`
--
ALTER TABLE `watchlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_has_user_user2_idx` (`user_email`),
  ADD KEY `fk_product_has_user_product2_idx` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brand_has_model`
--
ALTER TABLE `brand_has_model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `colour`
--
ALTER TABLE `colour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `condition`
--
ALTER TABLE `condition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `invoice_item`
--
ALTER TABLE `invoice_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `watchlist`
--
ALTER TABLE `watchlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brand_has_model`
--
ALTER TABLE `brand_has_model`
  ADD CONSTRAINT `fk_brand_has_model_brand1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`),
  ADD CONSTRAINT `fk_brand_has_model_model1` FOREIGN KEY (`model_id`) REFERENCES `model` (`id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_product_has_user_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `fk_product_has_user_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `fk_product_has_user_product3` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `fk_product_has_user_user4` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`);

--
-- Constraints for table `img`
--
ALTER TABLE `img`
  ADD CONSTRAINT `fk_img_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `fk_product_has_user_user3` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`);

--
-- Constraints for table `invoice_item`
--
ALTER TABLE `invoice_item`
  ADD CONSTRAINT `fk_invoice_item_invoice1` FOREIGN KEY (`invoice_order_id`) REFERENCES `invoice` (`order_id`),
  ADD CONSTRAINT `fk_invoice_item_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_brand_has_model1` FOREIGN KEY (`brand_has_model_id`) REFERENCES `brand_has_model` (`id`),
  ADD CONSTRAINT `fk_product_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `fk_product_colour1` FOREIGN KEY (`colour_id`) REFERENCES `colour` (`id`),
  ADD CONSTRAINT `fk_product_condition1` FOREIGN KEY (`condition_id`) REFERENCES `condition` (`id`),
  ADD CONSTRAINT `fk_product_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_shipping1` FOREIGN KEY (`shipping_id`) REFERENCES `shipping` (`id`);

--
-- Constraints for table `watchlist`
--
ALTER TABLE `watchlist`
  ADD CONSTRAINT `fk_product_has_user_product2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `fk_product_has_user_user2` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
