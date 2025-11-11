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
-- Table structure for table `last_login_logout_table`
--

CREATE TABLE `last_login_logout_table` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) DEFAULT NULL,
  `full_name` varchar(200) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_logout` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `last_login_logout_table`
--

INSERT INTO `last_login_logout_table` (`id`, `user_id`, `full_name`, `password`, `last_login`, `last_logout`) VALUES
(1, 'User1000', 'Hemraj Prajapati', '12345', '2025-10-07 14:56:33', '2025-10-07 14:56:33'),
(2, 'User1000', 'Hemraj Prajapati', '12345', '2025-10-07 14:56:33', '2025-10-07 14:56:33'),
(3, 'User1000', 'Hemraj Prajapati', '$2y$10$HcsVWF0k0O3rcXp6a5mFjON80F8nyZL6PZ9JYaCKjpdU6mdnF/aZe', '2025-10-07 14:56:33', '2025-10-07 14:56:33'),
(4, 'User1000', 'Hemraj Prajapati', '$2y$10$I.kqpnLkP60R3L3UgGoLIuKrbJ.m/pG5gD2jdc5HmJJMPgXKmL4iK', '2025-10-07 14:56:33', '2025-10-07 14:56:33'),
(5, 'User1000', 'Hemraj Prajapati', '$2y$10$I.kqpnLkP60R3L3UgGoLIuKrbJ.m/pG5gD2jdc5HmJJMPgXKmL4iK', '2025-10-07 14:56:33', '2025-10-07 14:56:33'),
(6, 'User1000', 'Hemraj Prajapati', '$2y$10$k6lHjNeileax1Tjivgzg1uKHxc2JCt5LNyds8.f7x4/84EYyw9Cyq', '2025-10-07 14:56:33', '2025-10-07 14:56:33'),
(7, 'User1000', 'Hemraj Prajapati', '$2y$10$k6lHjNeileax1Tjivgzg1uKHxc2JCt5LNyds8.f7x4/84EYyw9Cyq', '2025-10-07 16:32:38', NULL),
(8, 'User1000', 'Hemraj Prajapati', '$2y$10$k6lHjNeileax1Tjivgzg1uKHxc2JCt5LNyds8.f7x4/84EYyw9Cyq', '2025-10-09 09:59:59', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `last_login_logout_table`
--
ALTER TABLE `last_login_logout_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `last_login_logout_table`
--
ALTER TABLE `last_login_logout_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
