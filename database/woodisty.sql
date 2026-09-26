-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2026 at 06:20 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$jX1i6TGfz2YyQkZ8tKwWTODNGjjYRb0AiYvCuZd1QQDZnUdgUNbEe'),
(2, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `cat`
--

CREATE TABLE `cat` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(7, 'wooden plate', 'livingroom.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `reg`
--

CREATE TABLE `reg` (
  `rid` int(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pwd` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `address` varchar(300) NOT NULL,
  `phone` int(10) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `utype` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reg`
--

INSERT INTO `reg` (`rid`, `name`, `email`, `pwd`, `city`, `address`, `phone`, `gender`, `utype`) VALUES
(1, 'Priyanshi Mathukiya20', 'priyanshimathukiya22@gmail.con', '3456789', 'bagasara', 'TYUIOP', 789065, 'Female', ''),
(2, 'happy', 'happy@gmail.com', '456321', 'rajkot', 'anant hights,sarvoday school, mavdi', 360004, 'Female', ''),
(3, 'ansh', 'ansh@gmail.com', '221006', 'suray', 'mota varacha', 672020, 'Male', ''),
(4, 'meet', 'meet@gmail.com', '3456', 'ahemdabad', 'daimond park', 456210, 'Male', ''),
(5, 'rajvi', 'rajvi@gmail.com', '334455', 'baroda', 'baroda', 456210, 'Female', ''),
(6, 'rajvi', 'rajvi@gmail.com', '456788', 'baroda', 'baroda', 456210, 'Female', ''),
(7, 'dhyey', 'dhyey@gmail.com', 'fbhfbfdgd', 'surat', 'jakatnaka', 459874, 'Male', ''),
(8, 'dhyey', 'dhyey@gmail.com', '45632', 'surat', 'jakatnaka', 459874, 'Male', ''),
(18, 'prince', 'prince@gmail.com', '8890', 'ahemdabad', 'nikol area ahemdabad', 2147483647, 'Male', ''),
(19, 'krinal shiyani', 'krinal@gmail.com', 'kinu', 'sdfgsfd', 'ergsfdhg', 2147483647, 'Male', ''),
(20, 'mansvi', 'm@gmail.com', '23456', 'junagadh', 'joshipura', 1239874563, 'Female', ''),
(21, 'mitisa', 'mitisa@gmail.com', '667788', 'parab', 'bhesan', 2147483647, 'Female', ''),
(22, 'priyanshi', 'priyanshi22@gmail.com', '221020', 'rajkot', 'haliyad', 2147483647, 'Female', 'user'),
(23, 'admin', 'admin@gmail.com', 'admin123', 'surat', 'surat', 2147483647, 'Male', 'admin'),
(25, 'bhakti', 'bhakti@gmail.com', '22134', 'ahemdabad', 'silver oak univercity', 2147483647, 'Female', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cat`
--
ALTER TABLE `cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reg`
--
ALTER TABLE `reg`
  ADD PRIMARY KEY (`rid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cat`
--
ALTER TABLE `cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reg`
--
ALTER TABLE `reg`
  MODIFY `rid` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
