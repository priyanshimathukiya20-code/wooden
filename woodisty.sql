-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2026 at 06:53 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `woodisty`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`, `quantity`, `added_at`) VALUES
(16, 28, 41, 2, '2026-08-25 06:14:55'),
(17, 28, 57, 1, '2026-09-16 09:40:31'),
(23, 25, 61, 1, '2026-09-26 06:04:47');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `category_image`) VALUES
(17, 'BED', 'kingbed.jpg'),
(18, 'CHAIR', 'chair1.jpg'),
(19, 'DINNING TABLE ', 'dainingtable.jpg'),
(20, 'COFFEE TABLE ', 'coffe.jpg'),
(21, 'WARDROBE ', 'wardrobe.jpg'),
(23, 'SOFA', 'luxary.jpg.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `rating` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `subject`, `email`, `message`, `rating`) VALUES
(5, 'bed', 'jenish30@gmail.com', 'i am very happy  beacuse my dream bed i purchas ein only for your site so thank you ', 2),
(6, 'chair  collection', 'jenish30@gmail.com', 'super design and identy is unique', 5),
(7, 'bed', 'meet@gmail.com', 'nice ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_number` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `customer_address` text NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `order_status` varchar(50) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `user_id`, `customer_name`, `customer_email`, `customer_phone`, `customer_address`, `product_name`, `quantity`, `price`, `total_amount`, `payment_method`, `order_status`, `created_at`) VALUES
(1, 0, NULL, 'bhakti movaliya', 'bhakti@gmail.com', '4567890214', 'bagasara, junagadh, gujarat - 890765', 'Luxury Wooden Wardrobe', 2, '49990.00', '99980.00', 'Cash On Delivery', 'Shipped', '2026-08-22 09:29:49'),
(2, 0, NULL, 'bhakti movaliya', 'bhakti@gmail.com', '4567890214', 'bagasara, junagadh, gujarat - 890765', 'LUXURY SOFA', 2, '21000.00', '42000.00', 'Cash On Delivery', 'Pending', '2026-08-22 09:29:49'),
(3, 0, NULL, 'bhakti movaliya', 'bhakti@gmail.com', '4567890214', 'bagasara, junagadh, gujarat - 890765', 'Premium Corner Sofa', 1, '54100.00', '54100.00', 'Cash On Delivery', 'Processing', '2026-08-22 09:29:49'),
(4, 0, NULL, 'bhakti movaliya', 'bhakti@gmail.com', '4567890214', 'bagasara, junagadh, gujarat - 890765', 'Luxury King Size Bed', 1, '45000.00', '45000.00', 'Cash On Delivery', 'Pending', '2026-08-22 09:29:49'),
(5, 0, NULL, 'meet pokal', 'meet@gmail.com', '8235789065', 'ahemdabas, jungdh, gujarat - 778899', 'Royal Sheesham Chair', 1, '12999.00', '12999.00', 'Credit Card', 'Pending', '2026-08-22 09:36:29'),
(6, 0, NULL, 'meet pokal', 'meet@gmail.com', '8235789065', 'ahemdabas, jungdh, gujarat - 778899', 'Storage Coffee Table', 1, '15945.00', '15945.00', 'Credit Card', 'Pending', '2026-08-22 09:36:29'),
(7, 0, NULL, 'meet pokal', 'meet@gmail.com', '8235789065', 'ahemdabas, jungdh, gujarat - 778899', 'L SHAPE SOFA', 1, '7990.00', '7990.00', 'Credit Card', 'Pending', '2026-08-22 09:36:29'),
(8, 0, NULL, 'bhakti', 'bha@gmail.com', '6785432336', 'nhju, hfg, hfgh - u67fgh', 'Storage Wooden Bed', 1, '38999.00', '38999.00', 'Debit Card', 'Pending', '2026-08-22 09:39:47'),
(9, 0, NULL, 'mayur', 'mayur3@gmail.com', '7788990677', 'sueat, surat, gujarat - 678905', 'Oak Essence Dining Table', 1, '16999.00', '16999.00', 'Credit Card', 'Pending', '2026-08-25 06:12:38'),
(10, 0, NULL, 'bhakti movaliya', 'bhakti@gmail.com', '6785432336', 'jnd, baroda, gujarat - 678905', '2 Door Wooden Wardrobe', 1, '18920.00', '18920.00', 'Cash On Delivery', 'Pending', '2026-08-26 04:31:08'),
(11, 0, NULL, 'bhakti movaliya', 'bhakti@gmail.com', '6785432336', 'jnd, baroda, gujarat - 678905', 'Luxury Wooden Wardrobe', 1, '1200.00', '1200.00', 'Cash On Delivery', 'Pending', '2026-08-26 04:31:08'),
(12, 0, NULL, 'bhakti movaliya', 'bhakti@gmail.com', '6785432336', 'rjk, surat, gujarat - 678905', '3 Door Wooden Wardrobe', 1, '24500.00', '24500.00', 'UPI', 'Pending', '2026-08-26 04:32:05'),
(13, 0, NULL, 'bhakti', 'bhakti@gmail.com', '7788990055', 'ahemdabad, ahemdabad, gujarate - 889900', 'Luxury King Size Bed', 1, '45000.00', '45000.00', 'Cash On Delivery', 'Pending', '2026-09-10 10:09:38'),
(14, 0, NULL, 'bhakti', 'bhakti@gmail.com', '7788990055', 'ahemdabad, ahemdabad, gujarate - 889900', '3 Door Wooden Wardrobe', 1, '24500.00', '24500.00', 'Cash On Delivery', 'Pending', '2026-09-10 10:09:38'),
(15, 0, NULL, 'bhakti', 'bhakti@gmail.com', '9566778899', 'ahemdabad, , gujarat - ', 'Modern Oak Dining Chair', 1, '4200.00', '4200.00', 'UPI', 'Pending', '2026-09-10 10:12:58'),
(16, 0, NULL, 'bhakti', 'bhakti@gmail.com', '7788990055', 'ahemdabad, , gujarat - ', 'Storage Wooden Bed', 1, '38999.00', '38999.00', 'UPI', 'Processing', '2026-09-10 10:15:34'),
(17, 0, NULL, 'bhakti', 'bhakti@gmail.com', '7788990055', 'ahemdabad, , gujarat - ', 'L SHAPE SOFA', 1, '7990.00', '7990.00', 'UPI', 'Pending', '2026-09-10 10:17:07'),
(18, 0, NULL, 'bhakti', 'bhakti@gmail.com', '9988776655', 'ahemdabad, gujarat', 'Heritage Dining Collection', 1, '22499.00', '22499.00', 'Cash On Delivery', 'Pending', '2026-09-11 05:23:03'),
(19, 0, NULL, 'bhakti ', 'bhakti@gmail.com', '7788996755', 'mumbai, sgujarat', 'Modern Oak Dining Chair', 1, '4200.00', '4200.00', 'Cash On Delivery', 'Pending', '2026-09-11 09:16:58'),
(20, 0, NULL, 'riddhi savaliya', 'riddhisavaliya@gmail.com', '7899567435', 'surat  yogi chowk, gujarat', 'Oak Essence Dining Table', 1, '16999.00', '16999.00', 'Cash On Delivery', 'Pending', '2026-09-11 09:25:55'),
(21, 0, NULL, 'riddhi savaliya', 'riddhisavaliya@gmail.com', '7899567435', 'surat  yogi chowk, gujarat', 'Sliding Door Wardrobe', 1, '24000.00', '24000.00', 'Cash On Delivery', 'Pending', '2026-09-11 09:25:55'),
(22, 0, NULL, 'riddhi savaliya', 'riddhisavaliya@gmail.com', '7899567435', 'surat  yogi chowk, gujarat', 'modern woodern sofa', 1, '22890.00', '22890.00', 'Cash On Delivery', 'Pending', '2026-09-11 09:25:55'),
(23, 0, NULL, 'meet', 'meet22@gmail.com', '7788990066', 'baroda, gujarat', 'Round Wooden Coffee Table', 1, '14470.00', '14470.00', 'Cash On Delivery', 'Pending', '2026-09-11 09:29:10'),
(24, 0, NULL, 'meet', 'meet22@gmail.com', '7788990066', 'baroda, gujarat', '2 Door Wooden Wardrobe', 1, '18920.00', '18920.00', 'Cash On Delivery', 'Pending', '2026-09-11 09:29:10'),
(25, 0, NULL, 'meet', 'meet22@gmail.com', '7788990066', 'baroda, gujarat', 'Oak Essence Dining Table', 1, '16999.00', '16999.00', 'Cash On Delivery', 'Pending', '2026-09-11 09:34:06'),
(26, 1, 27, 'meet', 'meet22@gmail.com', '7899567435', 'bbaroda, gujarat', 'Luxury Rosewood Lounge Chair', 1, '15499.00', '15499.00', 'Cash On Delivery', 'Shipped', '2026-09-11 09:36:43'),
(27, 2, 27, 'meet', 'meet22@gmail.com', '7899567435', 'baroda, gujarat', 'Harmony Wooden Dining Set', 1, '18999.00', '18999.00', 'Cash On Delivery', 'Return Rejected', '2026-09-11 09:38:30'),
(28, 2, 27, 'meet', 'meet22@gmail.com', '7899567435', 'baroda, gujarat', 'Heritage Dining Collection', 1, '22499.00', '22499.00', 'Cash On Delivery', 'Return Rejected', '2026-09-11 09:38:30'),
(29, 2, 27, 'meet', 'meet22@gmail.com', '7899567435', 'baroda, gujarat', 'Luxury Wooden Wardrobe', 1, '49990.00', '49990.00', 'Cash On Delivery', 'Return Rejected', '2026-09-11 09:38:30'),
(30, 1, 30, 'dhyey', 'dhyey@gmail.com', '6785438909', 'surat, gujarat', 'Wood Haven Dining Collection', 1, '23999.00', '23999.00', 'Cash On Delivery', 'Pending', '2026-09-11 09:52:01'),
(31, 1, 30, 'dhyey', 'dhyey@gmail.com', '6785438909', 'surat, gujarat', 'Sheesham Wood Wardrobe', 1, '35670.00', '35670.00', 'Cash On Delivery', 'Pending', '2026-09-11 09:52:01'),
(32, 2, 30, 'dhyey', 'dhyey@gmail.com', '6785438909', 'baroda, gujarat', 'Wood Haven Dining Collection', 1, '23999.00', '23999.00', 'Cash On Delivery', 'Pending', '2026-09-11 09:56:51'),
(33, 2, 30, 'dhyey', 'dhyey@gmail.com', '6785438909', 'baroda, gujarat', 'Oak Wood Wardrobe', 2, '38990.00', '77980.00', 'Cash On Delivery', 'Pending', '2026-09-11 09:56:51'),
(34, 1, 25, 'bhakti', 'bhakti@gmail.com', '7788990066', 'surat, gujarat', 'Luxury King Size Bed', 1, '45000.00', '45000.00', 'Cash On Delivery', 'Pending', '2026-09-12 05:15:41'),
(35, 3, 27, 'meet pokal', 'meet22@gmail.com', '6785432336', 'ahemdabad, gujarat', 'Luxury King Size Bed', 1, '45000.00', '45000.00', 'Cash On Delivery', 'Processing', '2026-09-17 03:12:46'),
(36, 4, 27, 'meet pokal', 'meet22@gmail.com', '6785432336', 'ahemdabd, gujarat', 'Luxury King Size Bed', 1, '45000.00', '45000.00', 'Cash On Delivery', 'Pending', '2026-09-17 03:49:35'),
(37, 4, 27, 'meet pokal', 'meet22@gmail.com', '6785432336', 'ahemdabd, gujarat', 'Luxury Wooden Coffee Table', 3, '21999.00', '65997.00', 'Cash On Delivery', 'Pending', '2026-09-17 03:49:35'),
(38, 4, 27, 'meet pokal', 'meet22@gmail.com', '6785432336', 'ahemdabd, gujarat', 'Sliding Door Wardrobe', 1, '24000.00', '24000.00', 'Cash On Delivery', 'Pending', '2026-09-17 03:49:35'),
(39, 5, 27, 'meet pokal', 'meet22@gmail.com', '6785432336', 'surat, gujarat', 'Sliding Door Wardrobe', 1, '24000.00', '24000.00', 'Cash On Delivery', 'Cancelled', '2026-09-17 03:51:52'),
(40, 6, 27, 'meet pokal', 'meet22@gmail.com', '6785432336', 'surat, gujarat', 'Storage Wooden Bed', 1, '38999.00', '38999.00', 'Cash On Delivery', 'Cancelled', '2026-09-17 03:53:07'),
(41, 7, 27, 'meet pokal', 'meet22@gmail.com', '6785432336', 'surat, gujarat', 'Royal Sheesham Chair', 1, '12999.00', '12999.00', 'Cash On Delivery', 'Cancelled', '2026-09-17 03:53:07'),
(42, 7, 27, 'meet pokal', 'meet22@gmail.com', '6785432336', 'surat, gujarat', 'Modern Oak Dining Chair', 1, '4200.00', '4200.00', 'Cash On Delivery', 'Cancelled', '2026-09-17 03:53:07'),
(43, 8, 27, 'meet pokal', 'meet22@gmail.com', '6785432336', 'surat, gujarat', 'modern woodern sofa', 1, '22890.00', '22890.00', 'Cash On Delivery', 'Return Approved', '2026-09-17 03:53:07'),
(44, 1, 31, 'jenish godhani', 'jenish30@gmail.com', '7869045678', 'surat, gujarat', 'Modern Queen Bed', 1, '32800.00', '32800.00', 'Cash On Delivery', 'Processing', '2026-09-18 09:57:03'),
(45, 2, 31, 'jenish', 'jenish30@gmail.com', '6785432336', ' mahesana, gujarat', 'Modern Oak Dining Chair', 1, '4200.00', '4200.00', 'Cash On Delivery', 'Delivered', '2026-09-19 02:25:45'),
(46, 3, 31, 'jenish', 'jenish30@gmail.com', '6785432336', 'mahesana, gujarat', 'Handcrafted Wooden Stool', 1, '2999.00', '2999.00', 'Cash On Delivery', 'Processing', '2026-09-19 02:59:40'),
(47, 4, 31, 'jenish', 'jenish30@gmail.com', '6785432336', 'mahesana, gujarat', 'Premium Corner Sofa', 2, '54100.00', '108200.00', 'Cash On Delivery', 'Shipped', '2026-09-19 02:59:40'),
(48, 5, 31, 'jenish godhani', 'jenish30@gmail.com', '6785432336', 'yogi chowk surat, gujarat', 'Oak Essence Dining Table', 1, '16999.00', '16999.00', 'Cash On Delivery', 'Pending', '2026-09-21 05:52:10'),
(49, 6, 31, 'jenish godhani', 'jenish30@gmail.com', '6785432336', 'yogi chowk surat, gujarat', 'Premium Corner Sofa', 1, '54100.00', '54100.00', 'Cash On Delivery', 'Pending', '2026-09-21 05:52:10'),
(50, 7, 31, 'jenish godhani', 'jenish30@gmail.com', '6785432336', 'ahemdabad, gujarat', 'Harmony Wooden Dining Set', 1, '18999.00', '18999.00', 'Cash On Delivery', 'Pending', '2026-09-21 06:00:28'),
(51, 8, 31, 'jenish godhani', 'jenish30@gmail.com', '6785432336', 'ahemdabad, gujarat', 'Oak Essence Dining Table', 1, '16999.00', '16999.00', 'Cash On Delivery', 'Pending', '2026-09-21 06:04:53'),
(52, 2, 25, 'bhakti movaliya', 'bhakti@gmail.com', '7788990677', 'surat , gujarat', 'Storage Wooden Bed', 1, '38999.00', '38999.00', 'Cash On Delivery', 'Shipped', '2026-09-21 08:53:16'),
(53, 3, 25, 'bhakti movaliya', 'meet@gmail.com', '7788990677', 'jns, gujarat', 'Modern Designer Wardrobe', 1, '45600.00', '45600.00', 'Cash On Delivery', 'Return Approved', '2026-09-26 05:47:08');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pid` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `category_id`, `product_name`, `price`, `description`, `image`) VALUES
(22, 17, 'Modern Queen Bed', '32800.00', 'It features clean low-profile lines, neutral tones, engineered or solid wood frames, and optional hydraulic or drawer storage. ', 'queenbed.jpg'),
(23, 17, 'Luxury King Size Bed', '45000.00', 'A luxury king size bed combines majestic scale with superior craftsmanship, featuring a solid hardwood.\r\n', 'kingbed.jpg'),
(25, 17, 'Storage Wooden Bed', '38999.00', 'A storage wooden bed combines a sturdy sleeping platform with built-in compartments underneath, saving floor space by eliminating extra closets or chests.', 'storedbed.jpg'),
(26, 17, 'Sheesham Wood Bed', '41999.00', 'A Sheesham wood bed is a sturdy, premium furniture piece made from Indian Rosewood.', 'seesambed.jpg'),
(27, 17, 'Farmhouse Wooden Bed', '54899.00', 'A farmhouse wooden bed combines rustic charm and sturdy craftsmanship, featuring a prominent wood grain headboard.', 'farmhouse.jpg'),
(28, 17, 'Minimal Platform Bed', '29999.00', 'A minimal platform bed features a low-profile, clean-lined frame with a built-in slatted or solid base that supports a mattress directly.', 'minimalbed.jpg'),
(29, 17, '      Royal Canopy Bed', '59999.00', 'A royal canopy bed is an opulent four-poster luxury bed featuring an overhead frame designed for rich drapery, intricate hand-carvings, and solid hardwood construction.', 'royalbed.jpg'),
(30, 17, 'Kids Bunk Bed', '47999.00', 'A kids bunk bed is a vertical, two-tier space-saving frame. It stacks one sleeping area over another.', 'kidsbed.jpg'),
(31, 18, 'Premium Teak Wood Chair', '8499.00', 'A premium teak wood chair is a high-end, handcrafted seating option made from solid teak hardwood, prized for its rich grain, natural weather resistance, and exceptional durability that lasts for generations.', 'chair1.jpg'),
(32, 18, 'Royal Sheesham Chair', '12999.00', 'A Royal Sheesham Chair is a handcrafted luxury accent or lounge chair made from solid Indian Rosewood (Sheesham). ', 'chair2.jpg'),
(33, 18, 'Modern Oak Dining Chair', '4200.00', 'A modern oak dining chair features solid oak construction with a natural finish, clean geometric lines, and an ergonomic curved backrest.\r\n', 'chair3.jfif'),
(34, 18, 'Luxury Rosewood Lounge Chair', '15499.00', 'A luxury rosewood lounge chair is a high-end statement seat.', 'chair4.jpg'),
(35, 18, 'Classic Walnut Chair', '7899.00', 'A classic walnut chair features a rich chocolate-brown wood grain, solid hardwood or form-pressed construction, and a timeless design. ', 'chair5.jpg'),
(36, 18, 'Handcrafted Wooden Stool', '2999.00', 'A handcrafted wooden stool is a versatile, solid wood accent piece featuring unique natural grains, artisan joinery, and a compact design perfect for extra seating, a side table, or a plant display.', 'chair6.jpg'),
(37, 18, 'Rustic Pine Chair', '9199.00', 'a handcrafted solid wood seat featuring visible knots, distinct grain patterns, and a warm, distressed finish that brings natural, farmhouse charm to dining rooms or country kitchens.', 'chair7.jpg'),
(38, 18, 'Bamboo Relax Chair', '5499.00', 'A bamboo relax chair is an eco-friendly, lightweight folding or rocking lounger built with natural curves to support full-body lounging. ', 'chair8.jpg'),
(39, 19, 'Harmony Wooden Dining Set', '18999.00', 'The Harmony Wooden Dining Set typically features a solid wood build (such as mango, rubber wood, or walnut) with a smooth finish, designed to seat 4 to 6 people', 'table1.jpg'),
(40, 19, 'Heritage Dining Collection', '22499.00', 'The Heritage Dining Collection features timeless, handcrafted solid wood or high-gloss veneer furniture inspired by classic old-world charm and traditional craftsmanship.', 'table2.jpg'),
(41, 19, 'Oak Essence Dining Table', '16999.00', 'An Oak Essence Dining Table features a natural white oak or veneer surface highlighting organic wood grain, soft knife-edge top contours, and a sturdy supportive base. ', 'table3.jpg'),
(42, 19, 'Forest Edge Dining Table', '25999.00', 'a solid wood slab top that preserves the natural, irregular contours of the tree trunk, combining rustic charm with sturdy industrial or wooden legs.', 'table4.jpg'),
(43, 19, 'Timber Glow Dining Set', '19499.00', '\"Timber Glow Dining Set.\" describes custom, artisanal, or small-batch solid wood dining furniture featuring warm wood finishes or integrated lighting/resin glow', 'table5.jpg'),
(44, 19, 'Nature Craft Dining Table', '17899.00', 'A Nature Craft dining table features an eco-friendly, rustic solid-wood build with unique organic grains, sturdy handcrafted construction, and warm earthy tones designed to bring natural elegance and lasting durability to modern or traditional dining spaces.', 'table6.jpg'),
(45, 19, 'Wood Haven Dining Collection', '23999.00', 'The Wood Haven Dining Collection features solid wood and oak veneer construction, clean curves, and bold pedestal bases.', 'table7.jpg'),
(46, 19, 'Elegant Family Dining Set', '27999.00', 'An elegant family dining set combines fine craftsmanship with everyday comfort, featuring a smooth durable tabletop such as polished solid wood.', 'table8.jpg'),
(47, 20, 'Modern Coffee Table', '12999.00', 'The Modern Coffee Table is a stylish and practical addition to any contemporary living room.', 'coffe1.jpg'),
(48, 20, 'Round Wooden Coffee Table', '14470.00', 'Its round shape provides a smooth and practical surface while creating a warm and inviting look.', 'coffe2.jpg'),
(49, 20, 'Storage Coffee Table', '15945.00', 'The Storage Coffee Table is a stylish and functional furniture piece designed to provide both surface space and convenient storage.', 'coffe3.jpg'),
(50, 20, 'Glass Top Coffee Table', '17000.00', 'A glass top coffee table features a transparent safety glass surface paired with a supportive base made of wood, metal, or engineered materials, designed to make living spaces feel brighter and more open.', 'coffe4.jpg'),
(51, 20, 'Oak Wood Coffee Table', '18890.00', 'An oak wood coffee table is a durable, premium living room centrepiece crafted from strong hardwood featuring distinct, warm natural grain patterns', 'coffe5.jpg'),
(52, 20, 'Sheesham Coffee Table', '19999.00', 'Sheesham wood coffee table is a durable, premium-quality center piece featuring natural grain patterns and long-lasting hardwood strength.', 'coffe6.jpg'),
(53, 20, 'Premium Designer Coffee Table', '21570.00', 'A premium designer coffee table is a high-end living room centerpiece that combines artisan craftsmanship, sculptural form, and luxury materials like marble, tempered glass, solid wood, and brushed metal.', 'coffe7.jpg'),
(54, 20, 'Luxury Wooden Coffee Table', '21999.00', 'A luxury wooden coffee table is a sophisticated living room centerpiece crafted from premium solid hardwoods like teak, mahogany, or sheesham, often featuring hand-carved detailing, rich natural wood grains, and durable artisan finishes.', 'coffe8.jpg'),
(55, 21, '2 Door Wooden Wardrobe', '18920.00', 'A 2 door wooden wardrobe is a compact, space-saving furniture unit designed to organize clothes and everyday essentials efficiently.', 'wardrobe1.jpg'),
(56, 21, '3 Door Wooden Wardrobe', '24500.00', 'A 3-door wooden wardrobe is a spacious bedroom storage unit featuring three separate cabinet doors, hanging spaces, and multiple internal shelves.', 'wardrobe2.jpg'),
(57, 21, 'Sliding Door Wardrobe', '24000.00', 'A sliding door wardrobe is a modern storage unit with panels that glide horizontally on metal tracks rather than swinging outward on hinges', 'wardrobe3.jpg'),
(58, 21, 'Mirror Wooden Wardrobe', '32980.00', 'a functional bedroom furniture piece that combines natural or engineered wood construction with a built-in, full-length reflective mirror panel.', 'wardrobe4.jpg'),
(59, 21, 'Sheesham Wood Wardrobe', '35670.00', 'A Sheesham wood wardrobe is a durable, premium solid-wood storage cabinet handcrafted from Indian rosewood, known for its rich natural grain patterns, exceptional strength, and long-lasting resistance to decay and termites.', 'wardrobe5.jpg'),
(60, 21, 'Oak Wood Wardrobe', '38990.00', 'An oak wood wardrobe is a durable, premium storage unit featuring a natural oak finish or solid oak construction that adds warmth and classic elegance to a bedroom', 'wardrobe6.jpg'),
(61, 21, 'Modern Designer Wardrobe', '45600.00', 'A modern designer wardrobe combines clean, minimalist aesthetics with smart storage solutions like sliding doors, integrated lighting, and customizable modular compartments.\r\n', 'wardrobe7.jpg'),
(62, 21, 'Luxury Wooden Wardrobe', '49990.00', 'A luxury wooden wardrobe combines premium solid hardwoods like teak, oak, or mango wood.', 'wardrobe8.jpg'),
(66, 23, 'LUXURY SOFA', '21000.00', 'A luxury sofa is an upscale, finely crafted seating piece defined by premium materials, superior structural engineering', 'luxary.jpg.jfif'),
(67, 23, 'modern woodern sofa', '22890.00', 'A modern wooden sofa blends the natural warmth of solid hardwoods with clean, minimalist lines and plush, high-density fabric cushions.', 'modernsofa.jpj.jfif'),
(68, 23, 'L SHAPE SOFA', '7990.00', 'The L Shape Sofa is a stylish and comfortable addition to any modern living room.', 'lshape.jpg'),
(69, 23, 'Recliner Sofa', '44560.00', 'The Recliner Sofa is designed to provide superior comfort and relaxation in your living room.', 'recliener.jpg'),
(70, 23, 'Chesterfield Sofa', '49400.00', 'A Chesterfield sofa is a classic 18th-century British couch known for its distinct low seat, deep button tufting, and rolled arms.', 'esteredsofa.jpg'),
(71, 23, 'Premium Corner Sofa', '54100.00', 'A premium corner sofa is a luxurious, space-saving L-shaped sectional designed to anchor a living room.', 'premcorner.jpg'),
(72, 23, 'Minimal Sofa', '26780.00', 'A minimal sofa features clean lines, a low profile, and neutral colors.', 'minimal.jpg'),
(73, 23, 'Wooden Frame Sofa', '31500.00', 'A wooden frame sofa features a strong, exposed structure built from solid hardwoods like Sheesham or teak.', 'woodenframe.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reg`
--

CREATE TABLE `reg` (
  `rid` int(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pwd` varchar(10) NOT NULL,
  `city` varchar(200) NOT NULL,
  `address` varchar(300) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `utype` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reg`
--

INSERT INTO `reg` (`rid`, `name`, `email`, `pwd`, `city`, `address`, `phone`, `gender`, `utype`) VALUES
(22, 'priyanshi', 'priyanshi22@gmail.com', '221020', 'rajkot', 'haliyad', '8469488860', 'Female', 'user'),
(23, 'admin', 'admin@gmail.com', 'admin123', 'surat', 'surat', '9987755051', 'Male', 'admin'),
(25, 'bhakti', 'bhakti@gmail.com', '22134', 'ahemdabad', 'silver oak univercity', '7894567809', 'Female', 'user'),
(26, 'ansh mathukiya', 'anshmathukiya22@gmail.com', 'ansh@123', 'ahemdabad', 'daimond park', '9984522145', 'Male', 'user'),
(27, 'meet', 'meet22@gmail.com', '123678', 'ahemdabad', 'kanba hospital', '2147483647', 'Male', 'user'),
(28, 'mayur', 'mayur3@gmail.com', 'poiuyt', 'surat', 'jagatnaka', '8000199245', 'Male', 'user'),
(29, 'riddhi', 'riddhisavaliya@gmail.com', '345678', 'surat', 'surat', '8750098768', 'Female', 'user'),
(30, 'dhyey', 'dhyey@gmail.com', 'tyuiop', 'surat', 'surat', '6785438909', 'Male', 'user'),
(31, 'jenish', 'jenish30@gmail.com', 'jenish30', 'surat', 'surat', '7869045671', 'Male', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `reg`
--
ALTER TABLE `reg`
  ADD PRIMARY KEY (`rid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `reg`
--
ALTER TABLE `reg`
  MODIFY `rid` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
