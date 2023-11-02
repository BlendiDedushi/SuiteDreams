-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2023 at 03:26 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `suitedreams_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `estate`
--

CREATE TABLE `estate` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `location` varchar(100) NOT NULL,
  `lat` float DEFAULT NULL,
  `long` float DEFAULT NULL,
  `price` float NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estate`
--

INSERT INTO `estate` (`id`, `name`, `desc`, `location`, `lat`, `long`, `price`, `created_by`, `created_at`) VALUES
(6, 'Villa Paradise', 'A luxurious villa with stunning ocean views, private pool, and beach access. Ideal for a relaxing beach getaway.', 'Malibu, California', 34.0259, -118.78, 500, 8, NULL),
(7, 'Cozy Cabin Retreat', 'A charming cabin in the woods, perfect for a weekend getaway. Surrounded by nature, this cabin features a cozy fireplace and a hot tub.', 'Lake Tahoe, California', 39.0968, -120.032, 150, 8, NULL),
(8, 'Urban Loft', 'Stylish loft in the heart of the city. Modern amenities, city views, and easy access to restaurants and entertainment.', 'New York City, New York', 40.7128, -74.006, 250, 8, NULL),
(9, 'Mountain View Chalet', 'A cozy chalet nestled in the mountains with breathtaking views. Enjoy hiking, skiing, and relaxation in this mountain retreat.', 'Aspen, Colorado', 39.1911, -106.817, 300, 8, NULL),
(10, 'Lakeside Cottage', 'Quaint cottage located by the lake, perfect for fishing and water sports. Enjoy the tranquility of the lakeside setting.', 'Lake Placid, New York', 44.2795, -73.9791, 120, 8, NULL),
(11, 'Seaside Villa', 'An elegant villa with direct beach access. Relax on the white sandy beach, and watch the sunset over the ocean.', 'Miami Beach, Florida', 25.7617, -80.1918, 400, 8, NULL),
(12, 'Mountain Chalet Retreat', 'A mountain chalet retreat with a fireplace and hot tub. Escape to the mountains for a cozy and relaxing stay.', 'Whistler, Canada', 50.1163, -122.957, 260, 11, NULL),
(13, 'Balkan Mountain Chalet', 'A rustic mountain chalet in the heart of the Balkans. Enjoy hiking, fresh mountain air, and stunning views.', 'Peja, Kosovo', 42.6574, 20.2904, 120, 11, NULL),
(14, 'Bavarian Cottage', 'A cozy cottage in the Bavarian Alps, Germany. Experience traditional Bavarian hospitality and breathtaking landscapes.', 'Garmisch-Partenkirchen, Germany', 47.4919, 11.0955, 180, 11, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `estate_id` int(11) DEFAULT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `estate_id`, `image`) VALUES
(12, 6, '1698755957-7ce978a4.c10.jpg'),
(13, 6, '1698755957-HOTW-Paradise-Cove-Malibu-Front-Hero-Sunset-Alt.jpg'),
(14, 6, '1698755957-images.jpg'),
(15, 7, '1698756052-332867699.jpg'),
(16, 7, '1698756052-425275836.jpg'),
(17, 7, '1698756052-Cozy-Cabin-Retreat-Villa-South-Lake-Tahoe-Exterior.jpg'),
(18, 8, '1698756115--1x-1.jpg'),
(19, 8, '1698756115-unnamed (1).jpg'),
(20, 8, '1698756115-unnamed.jpg'),
(21, 9, '1698756187-36830342.jpg'),
(22, 9, '1698756187-36830379.jpg'),
(23, 9, '1698756187-download (1).jpg'),
(24, 9, '1698756187-download.jpg'),
(25, 10, '1698756258-3ad09c150f709dbd821693c9ec4f5a92.jpg'),
(26, 10, '1698756258-lmc.jpg'),
(27, 10, '1698756258-one-bedroom-cabin_Owls_Head2_14401_standard.jpg'),
(28, 11, '1698756329-unnamed (1).jpg'),
(29, 11, '1698756329-unnamed (2).jpg'),
(30, 11, '1698756329-unnamed.jpg'),
(31, 12, '1698756414-11793335.jpg'),
(32, 12, '1698756414-chalet-front.jpg'),
(33, 12, '1698756414-Luxury-Whistler-Cedar-Log-and-Stone-Alpine-Home_1.jpg'),
(34, 13, '1698756484-download (1).jpg'),
(35, 13, '1698756484-download.jpg'),
(36, 13, '1698756484-IMG_9317.jpg'),
(37, 14, '1698756562-677c908b549bd386e1273434ed4da569.jpg'),
(38, 14, '1698756562-download.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `estate_id` int(11) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `estate_id` int(11) DEFAULT NULL,
  `check_in_date` varchar(45) DEFAULT NULL,
  `check_out_date` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `user_id`, `estate_id`, `check_in_date`, `check_out_date`, `created_at`) VALUES
(2, 10, 6, '2023-10-20', '2023-11-03', '2023-10-31 14:15:28'),
(3, 10, 7, '2023-10-26', '2023-11-03', '2023-10-31 14:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(3, 'admin'),
(2, 'agent'),
(1, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `avatar` varchar(200) DEFAULT NULL,
  `role_id` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `avatar`, `role_id`, `created_at`) VALUES
(1, 'blendi', 'blendidedushi@gmail.com', '$2y$10$P.TTOQtKoFDKqD2iRX46S.xgbPPjRgrjY3FLcLg3Ez0y/e73ek7Xi', '1698750099-', 2, '2023-10-13 21:28:56'),
(8, 'agent', 'agent@gmail.com', '$2y$10$ro9isAzCL0zL3y26NNkx5.g5Csgv9S5055gumMlXWkuPj/3nZYTwm', NULL, 2, '2023-10-31 11:10:34'),
(9, 'admin', 'admin@gmail.com', '$2y$10$Dwp68w.COY7CVjnyITJg2uDm3JuiCZo7lYulqzS0yA6MOdwkRM7vy', '1698751566-uchiha-itachi-naruto-shippuuden-anbu-silhouette-wallpaper-preview.jpg', 3, '2023-10-31 11:10:47'),
(10, 'user', 'User1@gmail.com', '$2y$10$kwzarqfo0gU8aV0f8yOXROdRsVFwFMDzkMwE8hqnwguBc8WzDwGLy', '1698762181-677c908b549bd386e1273434ed4da569.jpg', 1, '2023-10-31 11:58:57'),
(11, 'agent2', 'agent2@gmail.com', '$2y$10$F9cBRNVMfBuqILC98x.MRuJApTzUGIXI.0NvJ2j4ZWwBjCVJphx8q', NULL, 1, '2023-10-31 12:45:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `estate`
--
ALTER TABLE `estate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_estate_created_by_idx` (`created_by`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_image_estate_id_idx` (`estate_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rating_user_id_idx` (`user_id`),
  ADD KEY `fk_rating_estate_id_idx` (`estate_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reservation_user_id_idx` (`user_id`),
  ADD KEY `fk_reservation_estate_id_idx` (`estate_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_name_UNIQUE` (`name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_user_role_id_idx` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `estate`
--
ALTER TABLE `estate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `estate`
--
ALTER TABLE `estate`
  ADD CONSTRAINT `fk_estate_created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk_image_estate_id` FOREIGN KEY (`estate_id`) REFERENCES `estate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `fk_rating_estate_id` FOREIGN KEY (`estate_id`) REFERENCES `estate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rating_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_reservation_estate_id` FOREIGN KEY (`estate_id`) REFERENCES `estate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reservation_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
