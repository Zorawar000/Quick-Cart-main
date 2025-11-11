-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2025 at 02:18 PM
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
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `admin_id` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `status` int(1) DEFAULT 1 COMMENT '1=Active, 0=Inactive',
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `admin_id`, `username`, `email`, `password`, `full_name`, `status`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'ADMIN001', 'admin', 'admin@quickcart.com', '$2y$10$rwusimsxDEp.JwMhxlP/z.ynnY3lguYUV30gnJfLIPup9ySmFIc8a', 'Super Administrator', 1, '2025-10-07 15:39:10', '2025-10-03 06:17:47', '2025-10-07 10:09:10');

-- --------------------------------------------------------

--
-- Table structure for table `business_profiles`
--

CREATE TABLE `business_profiles` (
  `id` int(11) NOT NULL,
  `banner_photo` varchar(255) DEFAULT NULL,
  `business_name` varchar(255) DEFAULT NULL,
  `service_name` varchar(255) DEFAULT NULL,
  `service_location` varchar(255) DEFAULT NULL,
  `business_owner_name` varchar(255) DEFAULT NULL,
  `business_owner_number` varchar(20) DEFAULT NULL,
  `business_email` varchar(150) DEFAULT NULL,
  `business_contact_number` varchar(20) DEFAULT NULL,
  `business_whatsapp_number` varchar(20) DEFAULT NULL,
  `business_pan_number` varchar(20) DEFAULT NULL,
  `business_gst_number` varchar(20) DEFAULT NULL,
  `business_aadhar_number` varchar(20) DEFAULT NULL,
  `business_cat_id` int(11) DEFAULT NULL,
  `business_description` text DEFAULT NULL,
  `describe_goal` text DEFAULT NULL,
  `describe_service_type` text DEFAULT NULL,
  `tick_business_goal` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `ec_products`
--

CREATE TABLE `ec_products` (
  `id` int(11) NOT NULL,
  `pro_id` int(10) DEFAULT NULL,
  `pro_name` varchar(255) DEFAULT NULL,
  `pro_cate` int(10) DEFAULT NULL,
  `pro_sub_cate` int(10) DEFAULT NULL,
  `pro_desc` longblob DEFAULT NULL,
  `stock` int(10) DEFAULT NULL,
  `mrp` decimal(10,2) DEFAULT NULL,
  `selling_price` decimal(10,2) DEFAULT NULL,
  `pro_image` varchar(255) DEFAULT NULL,
  `meta_title` text DEFAULT NULL,
  `meta_desc` text DEFAULT NULL,
  `meta_key` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `slug_url` text DEFAULT NULL,
  `added_on` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ec_products`
--

INSERT INTO `ec_products` (`id`, `pro_id`, `pro_name`, `pro_cate`, `pro_sub_cate`, `pro_desc`, `stock`, `mrp`, `selling_price`, `pro_image`, `meta_title`, `meta_desc`, `meta_key`, `status`, `slug_url`, `added_on`) VALUES
(1, 65521, 'UBON J8 Model', 83847, 36376, 0x55424f4e204a38206973206120776972656c65737320656172627564207769746820636c65617220736f756e6420616e64206c6f6e672062617474657279206c6966652e, 30, 800.00, 1500.00, 'product_1759652945.jpg', 'UBON J8 earbuds', 'UBON J8 earbuds', 'UBON J8 earbuds', 1, 'ubon-j8-model', 'Oct 01, 2025'),
(3, 29344, 'VIVO V20', 47441, 66944, 0x446973636f76657220746865205669766f2056323020736d61727470686f6e6520776974682061207374756e6e696e672034344d5020457965204175746f666f6375732066726f6e742063616d6572612c20736c65656b20756c7472612d736c696d2064657369676e2c2076696272616e7420414d4f4c454420646973706c61792c20616e6420706f77657266756c20706572666f726d616e63652e20427579206e6f77206174207468652062657374207072696365, 25, 18000.00, 25000.00, 'product_1759661414.jpeg', 'Vivo V20 – Sleek Design, 44MP Eye Autofocus Camera & AMOLED Display | Buy Now', 'Discover the Vivo V20 smartphone with a stunning 44MP Eye Autofocus front camera, sleek ultra-slim design, vibrant AMOLED display, and powerful performance. Buy now at the best price', 'Vivo V20, Vivo V20 smartphone, Vivo V20 specs, Vivo V20 price, buy Vivo V20 online, Vivo V20 features, Vivo V20 44MP camera, Vivo V20 AMOLED display, Vivo V20 India, Vivo V20 review, Vivo V20 battery life, Vivo V20 performance, Vivo V20 camera quality', 1, 'vivo-v20', 'Oct 05, 2025'),
(4, 71419, 'boAt Airdops Alpha Gen 2', 83847, 86079, 0x436f6d7061637420616e64206572676f6e6f6d6963207472756520776972656c6573732065617262756473206f66666572696e6720626f4174205369676e617475726520536f756e6420766961203133e280af6d6d206475616c20647269766572732c20757020746f203435e280af686f757273206f6620746f74616c20706c61796261636b2028776974682063617365292c20415341502066617374206368617267696e6720283130206d696e75746573206769766573207e313530206d696e7574657320706c617974696d65292c204245415354204d6f6465206c6f772d6c6174656e637920283530e280af6d732920666f722067616d696e672c20717561642d6d696320454e78e284a220746563686e6f6c6f677920666f7220636c65617265722063616c6c732c20696e7374616e742077616b65202620706169722028495750292c20616e6420495058352077617465722f737765617420726573697374616e63652e, 25, 800.00, 1500.00, '1759832308_earpodes.jpeg', 'boAt Airdopes Alpha Gen 2 – 45H Playtime, Fast Charging & Gaming Mode', 'Experience crystal-clear sound with boAt Airdopes Alpha Gen 2. Enjoy 45 hours of playtime, ENx™ noise cancellation, BEAST™ Mode for gaming, and ASAP fast charging in a compact, IPX5-rated design.', 'boAt Airdopes Alpha Gen 2, boAt Alpha Gen 2 earbuds, boAt TWS earbuds, boAt wireless earbuds, Airdopes Alpha Gen 2 specs, boAt ENx technology, BEAST Mode earbuds, boAt 45 hours playback, fast charging earbuds, gaming earbuds boAt, boAt Bluetooth earphones, IPX5 earbuds India', 1, 'boat-airdops-alpha-gen-2', 'Oct 07, 2025'),
(5, 21248, 'Samsung Fridge', 53501, 70681, 0x4578706c6f7265206120776964652072616e6765206f662053616d73756e6720726566726967657261746f7273207769746820616476616e63656420636f6f6c696e672c206469676974616c20696e76657274657220746563686e6f6c6f67792c20616e6420736d6172742066656174757265732e204275792073696e676c6520646f6f722c20646f75626c6520646f6f722c20616e6420736964652d62792d736964652053616d73756e6720667269646765732061742074686520626573742070726963657320696e20496e6469612e, 15, 28000.00, 35000.00, '1759832792_fridge.jpg', 'Samsung Refrigerator – Smart, Energy Efficient Fridges at Best Price', 'Explore a wide range of Samsung refrigerators with advanced cooling, digital inverter technology, and smart features. Buy single door, double door, and side-by-side Samsung fridges at the best prices in India.', 'Samsung fridge, Samsung refrigerator, buy Samsung fridge online, Samsung double door fridge, Samsung single door fridge, smart fridge Samsung, inverter fridge Samsung, frost free Samsung fridge, energy efficient fridge, Samsung fridge price India', 1, 'samsung-fridge', 'Oct 07, 2025');

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

-- --------------------------------------------------------

--
-- Table structure for table `my_cart`
--

CREATE TABLE `my_cart` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `total_pro_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `my_cart`
--

INSERT INTO `my_cart` (`id`, `cart_id`, `user_id`, `pro_id`, `quantity`, `total_pro_price`, `created_at`) VALUES
(1, 41554, 'User1000', 71419, 1, 1500.00, '2025-10-09 12:15:00');

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
(9, 'User1000', 0, NULL, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_profiles`
--
ALTER TABLE `business_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ec_categories`
--
ALTER TABLE `ec_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ec_products`
--
ALTER TABLE `ec_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ec_sub_categories`
--
ALTER TABLE `ec_sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `last_login_logout_table`
--
ALTER TABLE `last_login_logout_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `my_cart`
--
ALTER TABLE `my_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_project_table`
--
ALTER TABLE `new_project_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_table`
--
ALTER TABLE `notification_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `business_profiles`
--
ALTER TABLE `business_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ec_categories`
--
ALTER TABLE `ec_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ec_products`
--
ALTER TABLE `ec_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ec_sub_categories`
--
ALTER TABLE `ec_sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `last_login_logout_table`
--
ALTER TABLE `last_login_logout_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `my_cart`
--
ALTER TABLE `my_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `new_project_table`
--
ALTER TABLE `new_project_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notification_table`
--
ALTER TABLE `notification_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
