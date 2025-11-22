-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2025 at 04:25 PM
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
-- Table structure for table `notification_table`
--

CREATE TABLE `notification_table` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) DEFAULT NULL,
  `display` tinyint(1) DEFAULT 0,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` varchar(30) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification_table`
--

INSERT INTO `notification_table` (`id`, `user_id`, `display`, `title`, `description`, `created_at`, `is_read`) VALUES
(1, 'User1000', 1, 'Profile Update Notification', 'Your Profile is Update', NULL, 0),
(2, 'User1000', 1, 'Profile Update Notification', 'Your Profile is Update', NULL, 0),
(3, '', 0, NULL, NULL, NULL, 0),
(4, 'User1000', 1, 'Profile Update Notification', 'Your Profile is Update', NULL, 0),
(5, 'User1000', 1, 'Profile Update Notification', 'Your Profile is Update', NULL, 0),
(6, 'User1000', 1, 'Profile Update Notification', 'Your Profile is Update', NULL, 0),
(7, 'User1000', 0, NULL, NULL, NULL, 0),
(8, 'User1000', 0, NULL, NULL, NULL, 0),
(9, 'User1000', 0, NULL, NULL, NULL, 0),
(10, 'User1000', 0, NULL, NULL, NULL, 0),
(11, 'User1000', 0, NULL, NULL, NULL, 0),
(12, 'User1000', 0, NULL, NULL, NULL, 0),
(13, 'User1000', 0, NULL, NULL, NULL, 0),
(14, 'User1000', 0, NULL, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notification_table`
--
ALTER TABLE `notification_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notification_table`
--
ALTER TABLE `notification_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
