-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 01, 2026 at 07:21 PM
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
-- Database: `sensaskin`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_category` int(255) NOT NULL,
  `category_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_category`, `category_name`) VALUES
(1, 'Serums'),
(2, 'Moisturizers'),
(3, 'Cleansers'),
(4, 'Sun Protection'),
(5, 'Toners'),
(6, 'Eye Care'),
(7, 'Face Masks');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `full_name`, `email`, `message`, `sent_at`) VALUES
(3, 'Marko Maric', 'marko@gmail.com', 'Is a refund possible?', '2026-04-01 18:02:11');

-- --------------------------------------------------------

--
-- Table structure for table `navigation`
--

CREATE TABLE `navigation` (
  `id_nav` int(255) NOT NULL,
  `label` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) NOT NULL,
  `position` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `navigation`
--

INSERT INTO `navigation` (`id_nav`, `label`, `path`, `position`) VALUES
(1, 'HOME', 'index.php\r\n', 1),
(2, 'ALL PRODUCTS', 'shop.php', 2),
(3, 'MOST POPULAR', 'index.php#popular', 3),
(5, 'CONTACT', 'contact.php', 4),
(6, 'AUTHOR', 'author.php', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_order`, `user_id`, `total_price`, `created_at`) VALUES
(1, 12, 95.99, '2026-04-02 21:07:36'),
(2, 12, 133.99, '2026-04-02 21:10:08'),
(3, 12, 32.00, '2026-04-02 21:11:30'),
(4, 12, 44.99, '2026-04-02 21:11:56'),
(5, 13, 76.99, '2026-04-03 09:14:37');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id_item` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price_at_purchase` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id_item`, `order_id`, `product_id`, `quantity`, `price_at_purchase`) VALUES
(1, 1, 18, 2, 28.00),
(2, 1, 9, 1, 39.99),
(3, 2, 5, 1, 30.00),
(4, 2, 9, 1, 39.99),
(5, 2, 10, 2, 32.00),
(6, 3, 10, 1, 32.00),
(7, 4, 13, 1, 44.99),
(8, 5, 10, 1, 32.00),
(9, 5, 13, 1, 44.99);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_product` int(255) NOT NULL,
  `name` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `old_price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `is_popular` tinyint(1) DEFAULT 0,
  `category_id` int(255) NOT NULL,
  `skin_type_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `name`, `description`, `price`, `old_price`, `image`, `is_popular`, `category_id`, `skin_type_id`) VALUES
(5, 'Luminous Glow Serum', 'Hydrating serum for dry skin.', 30.00, NULL, 'serum1.jpg', 1, 1, 1),
(6, 'Matte Balance Cream', 'Oil control for oily skin.', 28.00, NULL, 'cream1.jpg', 1, 2, 2),
(7, 'AHA/BHA Exfoliating Toner', 'Refines pores and improves texture.', 18.99, NULL, 'toner1.jpg', 1, 3, 3),
(8, 'Gentle Cleansing Oil', 'Removes makeup without irritation.', 25.00, NULL, 'oil1.jpg', 1, 3, 4),
(9, 'Daily Defense SPF 50', 'High protection with a dewy finish.', 39.99, NULL, 'spf1.jpg', 1, 4, 1),
(10, 'Night Repair Cream', 'Overnight hydration for thirsty skin.', 32.00, NULL, 'cream2.jpg', 1, 2, 1),
(11, 'Rose Water Toner', 'Soothing toner for all skin types.', 15.00, 18.00, 'toner2.jpg', 0, 5, 4),
(12, 'Vitamin C Brightening Serum', 'Powerful antioxidant for glowing skin.', 39.00, NULL, 'serum2.jpg', 1, 1, 3),
(13, 'Retinol Night Serum', 'Anti-aging formula with pure retinol.', 44.99, 52.00, 'serum3.jpg', 0, 1, 1),
(14, 'Hyaluronic Acid Mist', 'Instant hydration on the go.', 12.00, NULL, 'toner3.jpg', 0, 5, 1),
(15, 'Deep Clean Gel', 'Removes excess oil and impurities.', 21.00, NULL, 'cleanser2.jpg', 0, 3, 2),
(16, 'Mineral Sunscreen SPF 30', 'Physical barrier protection.', 32.00, NULL, 'spf2.jpg', 0, 4, 4),
(17, 'Detox Clay Mask', 'Purifies pores and mattifies skin.', 26.00, 30.00, 'mask.jpg', 0, 7, 2),
(18, 'Revitalizing Eye Cream', 'Reduces dark circles and puffiness.', 28.00, NULL, 'eyecream.jpg', 1, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `role_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_role`, `role_name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `skin_types`
--

CREATE TABLE `skin_types` (
  `id_skin_type` int(255) NOT NULL,
  `type_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skin_types`
--

INSERT INTO `skin_types` (`id_skin_type`, `type_name`) VALUES
(1, 'Dry Skin'),
(2, 'Oily Skin'),
(3, 'Combination Skin'),
(4, 'Sensitive Skin');

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE `surveys` (
  `id_surveys` int(11) NOT NULL,
  `question` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`id_surveys`, `question`, `is_active`) VALUES
(1, 'What is your skin type?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `survey_options`
--

CREATE TABLE `survey_options` (
  `id_option` int(255) NOT NULL,
  `option_text` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `survey_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survey_options`
--

INSERT INTO `survey_options` (`id_option`, `option_text`, `survey_id`) VALUES
(1, 'Dry', 1),
(2, 'Oily', 1),
(3, 'Combination', 1),
(4, 'Sensitive', 1);

-- --------------------------------------------------------

--
-- Table structure for table `survey_results`
--

CREATE TABLE `survey_results` (
  `id_result` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `option_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survey_results`
--

INSERT INTO `survey_results` (`id_result`, `user_id`, `option_id`) VALUES
(4, 13, 3),
(5, 12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `first_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `first_name`, `last_name`, `email`, `password`, `is_active`, `role_id`) VALUES
(10, 'Jelena', 'Popadić', 'admin@gmail.com', '$2y$10$cswQt9fDLMZXgqNqPe5XXeHK28/6linGeC3lMZ0weZH/mBicD/Sr.', 1, 1),
(12, 'Mark', 'Twain', 'mark@gmail.com', '$2y$10$SV/nVCRUage0Pe9nPNEVbudJG4qiRsRrCYbxlnBluE1PBw4iQqq0G', 1, 2),
(13, 'Ana', 'Smith', 'ana@gmail.com', '$2y$10$joj96yOuxmX26I2qC4isDe0sk6TFCaOObDtMAtcEqD1g/bDqdd9pa', 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `navigation`
--
ALTER TABLE `navigation`
  ADD PRIMARY KEY (`id_nav`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `skin_type_id` (`skin_type_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`),
  ADD KEY `role_name` (`role_name`);

--
-- Indexes for table `skin_types`
--
ALTER TABLE `skin_types`
  ADD PRIMARY KEY (`id_skin_type`);

--
-- Indexes for table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`id_surveys`);

--
-- Indexes for table `survey_options`
--
ALTER TABLE `survey_options`
  ADD PRIMARY KEY (`id_option`),
  ADD KEY `survey_id` (`survey_id`);

--
-- Indexes for table `survey_results`
--
ALTER TABLE `survey_results`
  ADD PRIMARY KEY (`id_result`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `option_id` (`option_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email_unique` (`email`),
  ADD KEY `users_ibfk_1` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `navigation`
--
ALTER TABLE `navigation`
  MODIFY `id_nav` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `skin_types`
--
ALTER TABLE `skin_types`
  MODIFY `id_skin_type` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id_surveys` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `survey_options`
--
ALTER TABLE `survey_options`
  MODIFY `id_option` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `survey_results`
--
ALTER TABLE `survey_results`
  MODIFY `id_result` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id_order`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id_product`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`skin_type_id`) REFERENCES `skin_types` (`id_skin_type`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `survey_options`
--
ALTER TABLE `survey_options`
  ADD CONSTRAINT `survey_options_ibfk_1` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id_surveys`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `survey_results`
--
ALTER TABLE `survey_results`
  ADD CONSTRAINT `survey_results_ibfk_1` FOREIGN KEY (`option_id`) REFERENCES `survey_options` (`id_option`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `survey_results_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
