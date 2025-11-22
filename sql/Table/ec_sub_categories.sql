-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2025 at 04:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `ec_sub_categories`
--

CREATE TABLE `ec_sub_categories` (
  `id` int(11) NOT NULL,
  `cate_id` int(10) DEFAULT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `cate_name` varchar(255) DEFAULT NULL,
  `meta_title` varchar(500) DEFAULT NULL,
  `meta_desc` varchar(500) DEFAULT NULL,
  `meta_key` varchar(50) DEFAULT NULL,
  `slug_url` varchar(255) DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `added_on` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ec_sub_categories`
--

INSERT INTO `ec_sub_categories` (`id`, `cate_id`, `parent_id`, `cate_name`, `meta_title`, `meta_desc`, `meta_key`, `slug_url`, `status`, `added_on`) VALUES
(1, 48571, 47441, 'Realme', 'This is a Realme Company Phone', 'Meta Description', 'realme phone', 'realme', 1, 'Sep 08, 2025'),
(2, 86079, 83847, 'boAt earbuds', 'boAt earbuds', 'boAt earbuds', 'boAt earbuds', 'boat-earbuds', 1, 'Sep 30, 2025'),
(3, 36376, 83847, 'UBON J8', 'UBON J8 earbuds', 'UBON J8 earbuds', 'UBON J8 earbuds', 'ubon-j8', 1, 'Sep 30, 2025'),
(4, 66944, 47441, 'VIVO', 'VIVO F19 ', 'VIVO F19 mobile phone', 'VIVO F19 mobile phone', 'vivo', 1, 'Sep 30, 2025'),
(6, 96688, 53501, 'Washing Machine', 'Samsung Washing Machice', 'Samsung washing machines are advanced home appliances designed to make laundry easy, fast, and energy-efficient. They feature AI-powered controls that customize washing cycles based on fabric type and load size for optimal cleaning and fabric care. Technologies like EcoBubble generate cleaning bubbles that penetrate clothes quickly, enabling effective washing even in cold water, which saves energy. Many models include smart connectivity through the SmartThings app, allowing remote control, cycle', 'Samsung Washing Machine', 'washing-machine', 1, 'Oct 01, 2025'),
(7, 70681, 53501, 'Fridge', 'Buy Refrigerator Online at Best Price | Single & Double Door Fridges', 'Shop the latest refrigerators online at the best prices. Choose from single door, double door, and inverter fridges from top brands with energy-efficient technology and fast cooling features.', 'refrigerator, fridge, buy fridge online, double do', 'fridge', 1, 'Oct 07, 2025');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ec_sub_categories`
--
ALTER TABLE `ec_sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ec_sub_categories`
--
ALTER TABLE `ec_sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
