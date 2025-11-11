-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2025 at 02:20 PM
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
-- Table structure for table `ec_categories`
--

CREATE TABLE `ec_categories` (
  `id` int(11) NOT NULL,
  `cate_id` int(10) DEFAULT NULL,
  `cate_name` varchar(255) DEFAULT NULL,
  `meta_title` varchar(500) DEFAULT NULL,
  `meta_desc` varchar(500) DEFAULT NULL,
  `meta_key` varchar(50) DEFAULT NULL,
  `slug_url` varchar(255) DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `added_on` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ec_categories`
--

INSERT INTO `ec_categories` (`id`, `cate_id`, `cate_name`, `meta_title`, `meta_desc`, `meta_key`, `slug_url`, `status`, `added_on`) VALUES
(1, 47441, 'Mobile Phone', 'Meta Title', 'Meta Description', 'Meta Keyword', 'mobile-phone', 1, 'Sep 08, 2025'),
(2, 83847, 'Ear Buds', 'Meta Title', 'Meta Description', 'Meta Keyword', 'ear-buds', 1, 'Sep 08, 2025'),
(3, 53501, 'Electronics', 'Meta Title', 'Meta Description', 'Meta Keyword', 'electronics', 1, 'Oct 01, 2025');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ec_categories`
--
ALTER TABLE `ec_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ec_categories`
--
ALTER TABLE `ec_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
