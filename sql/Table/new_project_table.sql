-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2025 at 02:21 PM
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
-- Table structure for table `new_project_table`
--

CREATE TABLE `new_project_table` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `address2` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `added_on` varchar(30) DEFAULT NULL,
  `status` enum('t','f') DEFAULT 't'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `new_project_table`
--

INSERT INTO `new_project_table` (`id`, `user_id`, `first_name`, `last_name`, `user_image`, `email`, `password`, `phone_number`, `address`, `address2`, `city`, `state`, `zip`, `added_on`, `status`) VALUES
(1, 'User1000', 'Hemraj', 'Prajapati', 'images.jpeg', 'hemraj@gmail.com', '$2y$10$k6lHjNeileax1Tjivgzg1uKHxc2JCt5LNyds8.f7x4/84EYyw9Cyq', '1111111111', 'Jhotwara, Jaipur, Rajasthan', 'Jhotwara, Jaipur, Rajasthan', 'Jaipur', 'Delhi', '66666', 'Oct 01,2025', 'f');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `new_project_table`
--
ALTER TABLE `new_project_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `new_project_table`
--
ALTER TABLE `new_project_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
