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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ec_products`
--
ALTER TABLE `ec_products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ec_products`
--
ALTER TABLE `ec_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
