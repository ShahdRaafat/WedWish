-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2025 at 04:57 PM
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
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`user_id`, `product_id`, `name`, `image`, `price`, `category`, `quantity`) VALUES
(3, 9, 'dress 2', '6769a01dcdd30_d4.png', 1500.00, 'dress', 2),
(1, 8, 'accsessory1', '6769982153d85_a3.png', 100.00, 'access', 1);

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `paymentMethod` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`id`, `firstName`, `lastName`, `address`, `city`, `paymentMethod`, `created_at`) VALUES
(1, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-21 21:40:27'),
(2, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-21 21:43:33'),
(3, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-22 19:53:27'),
(4, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-22 19:58:54'),
(5, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-22 20:00:05'),
(6, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-22 20:01:32'),
(7, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-22 20:03:35'),
(8, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-22 20:04:03'),
(9, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-22 20:10:10'),
(10, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-22 20:15:12'),
(11, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-22 20:15:42'),
(12, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-22 20:18:35'),
(13, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-22 20:18:59'),
(14, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-22 20:21:16'),
(15, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-22 20:24:28'),
(16, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-22 20:25:05'),
(17, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-22 20:25:16'),
(18, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-22 20:26:05'),
(19, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-22 20:27:11'),
(20, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-22 20:30:11'),
(21, 'omnia', 'sayed', '4s', 'sd', 'd', '2024-12-22 20:31:20'),
(22, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-23 11:22:15'),
(23, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-23 11:38:55'),
(24, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-23 11:54:42'),
(25, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-23 11:54:50'),
(26, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-23 11:54:55'),
(27, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-23 13:44:20'),
(28, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-23 14:40:20'),
(29, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-23 14:40:45'),
(30, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-23 14:51:56'),
(31, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-23 15:29:20'),
(32, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-23 15:29:34'),
(33, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-23 15:30:22'),
(34, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-23 15:33:01'),
(35, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-23 15:42:26'),
(36, 'shahd', 'raafat', '5 street', 'Benha', 'd', '2024-12-23 17:18:14'),
(37, 'shahd', 'raafat', '45gd', 'dfjh', 'd', '2024-12-23 17:34:07');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `phone`, `email`, `message`, `created_at`) VALUES
(1, 'shahd', '01156962875', 'shahd@gmail.com', 'sssssssss', '2024-12-23 16:54:33'),
(2, 'shahd', '0198398988', 'shahd@fjkk', 'kjhgfhjkjh', '2024-12-23 17:39:23'),
(3, 'sh', '234567897', 'shah@gghjn', 'dfghjfdghj', '2024-12-23 17:40:48');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price`, `category`) VALUES
(6, 'dress 1', '6769970ef1b76_d3.png', 1200.00, 'dress'),
(7, 'dec1', '6769981153d15_c1.png', 200.00, 'decor'),
(8, 'accsessory1', '6769982153d85_a3.png', 100.00, 'access'),
(9, 'dress 2', '6769a01dcdd30_d4.png', 1500.00, 'dress'),
(11, 'dress 4', '6769cbbf3355b_d1.png', 2600.00, 'dress'),
(12, 'dress 5', '6769cc65b1780_d15.png', 3400.00, 'dress'),
(13, 'accessory 2', '6769ccce1d0c9_a1.png', 360.00, 'access'),
(14, 'accessory 3', '6769ccfb80042_a5.png', 500.00, 'access'),
(15, 'accessory 4', '6769cd3cdc2b5_a6.png', 500.00, 'access'),
(16, 'accessory 5', '6769cd8f3a548_a4.png', 1000.00, 'access'),
(18, 'accessory 6', '6769cdfa00250_a10.png', 500.00, 'access'),
(19, 'dec2', '676a5736bcda4_c2.png', 350.00, 'decor'),
(20, 'dec3', '676a66269b38f_c2.png', 55.00, 'decor');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin'),
(2, 'souad', 'souad@gmail.com', '1818'),
(3, 'shahd', 'shahd@gmail.com', '111');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `FK` (`product_id`),
  ADD KEY `FK1` (`user_id`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `FK1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
