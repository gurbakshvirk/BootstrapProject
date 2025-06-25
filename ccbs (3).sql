-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2025 at 02:57 PM
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
-- Database: `ccbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `popular` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `popular`, `image`, `created_at`) VALUES
(1, 'Shirts', 'Shirts', 'Shirts', 'Shirts', 'Shirts', 'Shirts', 0, 0, '', '2025-06-23 06:16:00'),
(2, 'MensWear', 'MensWear', 'MensWear', 'MensWear', 'MensWear', 'MensWear', 1, 1, '1750661230.jpg', '2025-06-23 06:47:10'),
(3, 'MensWear', 'MensWear', 'MensWear', 'MensWear', 'MensWear', 'MensWear', 1, 1, '1750661515.jpg', '2025-06-23 06:51:55'),
(4, 'Shirt', 'Shirt', 'Shirt', '', '', '', 1, 1, '1750662462.jpg', '2025-06-23 07:07:42');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `small_description` mediumtext NOT NULL,
  `description` varchar(255) NOT NULL,
  `original_price` int(11) NOT NULL,
  `selling_price` int(11) NOT NULL,
  `images` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `trending` tinyint(4) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` mediumtext NOT NULL,
  `meta_description` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `small_description`, `description`, `original_price`, `selling_price`, `images`, `qty`, `status`, `trending`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`) VALUES
(4, 1, 'Shirt Jeans', 'Shirt', '', 'Shirt', 500, 200, 'test', 5, 1, 1, 'Shirt', 'Shirt', 'Shirt', '2025-06-24 07:32:12'),
(5, 2, 'Shirts', 'Shirt Jeans', '', 'Shirt', 10000, 120000, '', 4, 1, 1, 'Shirt', 'ShirtShirt', 'Shirt', '2025-06-24 07:39:00'),
(6, 4, 'Shirt', 'Shirt', '', 'Shirt', 550, 200, '1750750951.jpg', 5, 1, 1, 'Shirt', 'Shirt', 'Shirt', '2025-06-24 07:42:31'),
(7, 2, 'jgyjuhf', 'Shirt', '', 'jbkugku', 650, 850, '1750827315.jpg', 5, 1, 1, 'Shirt', 'kuigiy', 'kugiygi', '2025-06-25 04:55:15'),
(8, 2, 'jgyjuhf', 'Shirt', '', 'jbkugku', 650, 850, '1750827409.jpg', 5, 1, 1, 'Shirt', 'kuigiy', 'kugiygi', '2025-06-25 04:56:49'),
(9, 2, 'jgyjuhf', 'Shirt', '', 'jbkugku', 650, 850, '1750827806.jpg', 5, 1, 1, 'Shirt', 'kuigiy', 'kugiygi', '2025-06-25 05:03:26'),
(10, 2, 'jgyjuhf', 'Shirt', '', 'jbkugku', 650, 850, '1750827812.jpg', 5, 1, 1, 'Shirt', 'kuigiy', 'kugiygi', '2025-06-25 05:03:32'),
(11, 2, 'jgyjuhf', 'Shirt', '', 'jbkugku', 650, 850, '1750827816.jpg', 5, 1, 1, 'Shirt', 'kuigiy', 'kugiygi', '2025-06-25 05:03:36'),
(12, 2, 'Shirt', 'Shirt', 'fvvdfv', 'jbkugku', 650, 850, '1750827964.jpg', 5, 1, 1, 'Shirt', 'kuigiy', 'kugiygi', '2025-06-25 05:06:04'),
(13, 2, 'Shirt', 'Shirt', 'fvvdfv', 'jbkugku', 650, 850, '1750828060.jpg', 5, 1, 1, 'Shirt', 'kuigiy', 'kugiygi', '2025-06-25 05:07:40'),
(14, 2, 'Shirt', 'Shirt', 'fvvdfv', 'jbkugku', 650, 850, '1750828065.jpg', 5, 1, 1, 'Shirt', 'kuigiy', 'kugiygi', '2025-06-25 05:07:45'),
(15, 2, 'Shirt', 'Shirt', 'fvvdfv', 'jbkugku', 650, 850, '1750828230.jpg', 5, 1, 1, 'Shirt', 'kuigiy', 'kugiygi', '2025-06-25 05:10:30'),
(16, 2, 'Shirt', 'Shirt', 'fvvdfv', 'jbkugku', 650, 850, '1750828234.jpg', 5, 1, 1, 'Shirt', 'kuigiy', 'kugiygi', '2025-06-25 05:10:34'),
(17, 2, 'Brooks Brothers', 'Brooks Brothers', 'Brooks Brothers', 'Brooks Brothers', 3000000, 1200, '1750828324.jpg', 3, 1, 1, 'Brooks Brothers', 'Brooks Brothers', 'Brooks Brothers', '2025-06-25 05:12:04'),
(18, 2, 'Brooks Brothers', 'Brooks Brothers', 'Brooks Brothers', 'Brooks Brothers', 3000000, 1200, '1750828461.jpg', 3, 1, 1, 'Brooks Brothers', 'Brooks Brothers', 'Brooks Brothers', '2025-06-25 05:14:21'),
(19, 2, 'Brooks Brothers', 'Brooks Brothers', 'Brooks Brothers', 'Brooks Brothers', 3000000, 1200, '1750828488.jpg', 3, 1, 1, 'Brooks Brothers', 'Brooks Brothers', 'Brooks Brothers', '2025-06-25 05:14:48'),
(20, 2, 'Brooks Brothers', 'Brooks Brothers', 'Brooks Brothers', 'Brooks Brothers', 3000000, 1200, '1750829380.jpg', 3, 1, 1, 'Brooks Brothers', 'Brooks Brothers', 'Brooks Brothers', '2025-06-25 05:29:40'),
(21, 2, 'Brooks Brothers', 'Brooks Brothers', 'Brooks Brothers', 'Brooks Brothers', 3000000, 1200, '1750829387.jpg', 3, 1, 1, 'Brooks Brothers', 'Brooks Brothers', 'Brooks Brothers', '2025-06-25 05:29:47'),
(22, 2, 'Brooks Brothers', 'Brooks Brothers', 'Brooks Brothers', 'Brooks Brothers', 3000000, 1200, '1750830473.jpg', 3, 1, 1, 'Brooks Brothers', 'Brooks Brothers', 'Brooks Brothers', '2025-06-25 05:47:53'),
(23, 2, 'Brooks Brothers', 'Brooks Brothers', 'Brooks Brothers', 'Brooks Brothers', 3000000, 1200, '1750830634.jpg', 3, 1, 1, 'Brooks Brothers', 'Brooks Brothers', 'Brooks Brothers', '2025-06-25 05:50:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cpassword` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `cpassword`, `created_at`, `role`) VALUES
(1, 'Lavi', 'lovyvirk34@gmail.com', '1234', '1234', '2025-06-22 06:55:27', 'admin'),
(7, 'Lavi', 'lovyv189@gmail.com', '1234', '1234', '2025-06-22 08:28:40', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
