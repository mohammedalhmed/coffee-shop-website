-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2026 at 07:46 PM
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
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(22,0) NOT NULL,
  `qty` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `price`, `qty`) VALUES
(9, 0, 2, 3999, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `number` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `address` varchar(100) NOT NULL,
  `address_type` varchar(100) NOT NULL,
  `method` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(250) NOT NULL DEFAULT 'pending',
  `total_products` varchar(1000) NOT NULL,
  `total_price` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `address`, `address_type`, `method`, `product_id`, `price`, `qty`, `date`, `status`, `total_products`, `total_price`) VALUES
(1, 19, 'عماد حامد محمد', 779630129, 'emadalhamadi434@gmail.com', '1,الصافية,صنعاء,اليمن,1234', 'المنزل', 'الدفع عند الاستلام', 5, 7000.00, 1, '2026-02-04 20:58:21', '', '', ''),
(2, 19, 'حامد ', 739007460, 'emadalhamadi434@gmail.com', '20,الصافية,صنعاء,اليمن,12345', 'المنزل', 'تحويل بنكي', 4, 5000.00, 1, '2026-02-04 21:31:56', '', '', ''),
(8, 20, 'نصر ', 77946072, 'nskslk@gmail.com', '16,هائل,صنعاء,اليمن,123456', 'المنزل', 'الدفع عند الاستلام', 6, 2500.00, 1, '2026-02-05 09:00:57', 'قيد المعالجة', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `image` varchar(255) NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `details`) VALUES
(2, 'coffee', 500, 'WhatsApp Image 2026-02-01 at 1.58.04 AM (2).jpeg', 'قهوه خظراء'),
(4, 'slim Green Coffee', 1000, 'WhatsApp Image 2026-02-01 at 1.58.00 AM (1).jpeg', 'اللوان الاخضر'),
(5, 'Green Coffee Beans', 900, 'WhatsApp Image 2026-02-01 at 1.58.27 AM.jpeg', 'ممتاز'),
(6, 'Green Coffee ', 2500, 'WhatsApp Image 2026-02-01 at 1.58.27 AM (1).jpeg', ' pure %100');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(18, 'emad', 'emadalhamadi434@gmail.com', '$2y$10$Sz5uc57yTrf5pEH4ORMyoultBI6FiRcqdENrh3/NPCThNIVU9YvU6', 'user'),
(19, 'عماد الحمادي', 'emadalhamadi@gmail.com', '$2y$10$oNbEvGkh7Svxbx5kues4SOZ5hjAdztCXL1/pQIGzIBvsME62mPVWu', 'admin'),
(20, 'محمد عبدالروؤف', 'emadalhamadi43@gmail.com', '$2y$10$xhWZ.MTdS4kjDC0QloJi9eOjLM9NQuKIMzDRWQ8rAwxi2FLDhARNy', 'user'),
(21, 'سمير الزين', 'samur@gmail.com', '$2y$10$/RLr2kusyMLIIueUhF6L3.BgxevdSM1T6IZ17OXZHlknGZqndRgqi', 'user'),
(22, 'محمد عبد الدائم', 'mohammad@gmail.com', '$2y$10$LnzkHPITi2OeoPqJ.fYu8.UwEnNYQp142pWinjyrijDSNp1xAQQ1C', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(22,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `price`) VALUES
(2, 0, 1, 3000),
(3, 19, 2, 3999),
(4, 19, 6, 2000),
(7, 18, 2, 3999);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
