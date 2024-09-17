-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2023 at 04:48 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lelang2`
--

-- --------------------------------------------------------

--
-- Table structure for table `auctions`
--

CREATE TABLE `auctions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `auction_item_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` enum('0','1','2','3') NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auctions`
--

INSERT INTO `auctions` (`id`, `user_id`, `auction_item_id`, `price`, `status`, `date`) VALUES
(7, 9, 10, 3500000, '1', '2022-11-13 17:28:43');

-- --------------------------------------------------------

--
-- Table structure for table `auction_items`
--

CREATE TABLE `auction_items` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `location` text NOT NULL,
  `open_price` int(11) NOT NULL,
  `note` text NOT NULL,
  `open_date` datetime NOT NULL,
  `close_date` datetime NOT NULL,
  `status` enum('0','1','2','3') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auction_items`
--

INSERT INTO `auction_items` (`id`, `category_id`, `user_id`, `code`, `name`, `photo`, `location`, `open_price`, `note`, `open_date`, `close_date`, `status`) VALUES
(8, 2, 6, '2342', 'Box', 'cattt3.jpg', '231423', 1000000, 'ssss', '2022-10-17 00:00:00', '2022-10-22 00:00:00', '1'),
(9, NULL, 8, '23123', 'eqrwew', 'cattt.png', '231423', 3000000, 'rqr', '2022-10-21 21:14:00', '2023-01-31 00:00:00', '1'),
(10, 2, 8, '2342wr', 'Ivan', 'test.jpg', 'qwqwr', 1000000, 'wqrqwr', '2022-11-13 17:25:00', '2022-12-31 17:25:00', '2'),
(11, 2, 9, 'KH', 'Ivan', '0001_sale_text_effect1.jpg', '231423', 200000, 'asdasdas', '2022-12-29 22:40:00', '2022-12-31 22:15:00', '1'),
(12, 4, 9, 'dfsdsf', 'dfssdfsdf', '0002_coming_soon_text_effect.jpg', 'sdfsdf', 3000000, 'sdfsdf', '2022-12-29 22:44:00', '2023-01-07 22:33:00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `auction_payments`
--

CREATE TABLE `auction_payments` (
  `id` int(11) NOT NULL,
  `auction_id` int(11) NOT NULL,
  `recipient_name` varchar(255) NOT NULL,
  `recipient_address` text NOT NULL,
  `status` enum('0','1','2') NOT NULL,
  `proof_payment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auction_payments`
--

INSERT INTO `auction_payments` (`id`, `auction_id`, `recipient_name`, `recipient_address`, `status`, `proof_payment`) VALUES
(4, 7, 'pelelang3', 'pelelang3', '0', 'test1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(2, 'dfsdfssdf'),
(3, 'asdasd'),
(4, 'asfasf');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `register_date` date NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_number` int(30) NOT NULL,
  `bank_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `name`, `address`, `phone`, `register_date`, `account_name`, `account_number`, `bank_name`) VALUES
(3, 6, 'pelelange', '212412', '214124', '2022-10-14', 'weqrw', 21412, 'BRI'),
(4, 8, 'adsad', 'asdasdasd', '42342', '2022-10-14', 'wqrewr', 12412, 'BNI'),
(5, 9, 'pelelang3', 'wqrqw', '3423', '2022-10-18', 'wqrqwr', 3423523, 'BNI'),
(6, 10, 'pl45', 'dsfsdfdsf', '24244', '2022-10-18', '', 0, ''),
(7, 11, 'w3eq2', 'qwrqwr', '21412', '2022-10-18', 'qwrqwr', 12412, 'qwr');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('0','1') NOT NULL,
  `status` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `status`) VALUES
(6, 'pelelangg', '$2y$10$Dqhvkq9YkwqZ9QHVt0NgmOnc9dJC4MiZYCofYh79JoB84KoM5hyf2', '1', '1'),
(7, 'admin', '$2y$10$5fhn6sfnBvKG5MJ.yd6oNu3YsEAonI9aCyvJqqHZgHApQ1OLzToOi', '0', '1'),
(8, 'pelelang2', '$2y$10$fdAyC46Qm0HlUqNQ8mlpi.Z2zLyKvqyuYvuh3GxKhitjne69hy2Hu', '1', '1'),
(9, 'pelelang3', '$2y$10$6wcG6ts9G2plfn6JeAu9QuSM4.nVspQ0mzhfDWz7AmQBaiCoFvR9G', '1', '1'),
(10, 'pl45', '$2y$10$WMd8N0MytVJLfufX15Epoet6bGiazihRd/0T9d.zjpfYWfFiNt7Ui', '1', '0'),
(11, 'wqrqw', '$2y$10$hFVJufHKS9CuOYDWxIlTSO4OpbsmmPZ7plS80BrUJBB.iiCAYIby6', '1', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auctions`
--
ALTER TABLE `auctions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_idx` (`user_id`),
  ADD KEY `auction_item_id_idx` (`auction_item_id`);

--
-- Indexes for table `auction_items`
--
ALTER TABLE `auction_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_idx` (`user_id`),
  ADD KEY `auction_items_category_id` (`category_id`);

--
-- Indexes for table `auction_payments`
--
ALTER TABLE `auction_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auction_payments_auction_id_idx` (`auction_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_idx` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auctions`
--
ALTER TABLE `auctions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `auction_items`
--
ALTER TABLE `auction_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `auction_payments`
--
ALTER TABLE `auction_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auctions`
--
ALTER TABLE `auctions`
  ADD CONSTRAINT `auctions_auction_item_id` FOREIGN KEY (`auction_item_id`) REFERENCES `auction_items` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `auctions_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `auction_items`
--
ALTER TABLE `auction_items`
  ADD CONSTRAINT `auction_items_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `auction_items_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `auction_payments`
--
ALTER TABLE `auction_payments`
  ADD CONSTRAINT `auction_payments_auction_id` FOREIGN KEY (`auction_id`) REFERENCES `auctions` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
