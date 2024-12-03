-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 21, 2024 at 09:32 PM
-- Server version: 8.0.35
-- PHP Version: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apex_motorsport`
--

-- --------------------------------------------------------

--
-- Table structure for table `Cars`
--

CREATE TABLE `Cars` (
  `car_id` int NOT NULL,
  `model_name` varchar(100) NOT NULL,
  `horsepower` int NOT NULL,
  `engine_type` varchar(50) NOT NULL,
  `engine_capacity` decimal(4,2) NOT NULL,
  `top_speed` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `weight_kg` int NOT NULL,
  `manufacturer_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Cars`
--

INSERT INTO `Cars` (`car_id`, `model_name`, `horsepower`, `engine_type`, `engine_capacity`, `top_speed`, `price`, `weight_kg`, `manufacturer_id`) VALUES
(13, 'Aventador SVJ', 770, 'V12', 6.50, 350, 517000.00, 1525, 1),
(14, 'Huracan Evo', 640, 'V10', 5.20, 325, 261000.00, 1422, 1),
(15, 'Urus', 650, 'V8', 4.00, 305, 218000.00, 2200, 1),
(16, '911 Turbo S', 650, 'Flat-6', 3.80, 330, 207000.00, 1640, 2),
(17, 'Cayman GT4 RS', 500, 'Flat-6', 4.00, 302, 142000.00, 1415, 2),
(18, 'Taycan Turbo S', 761, 'Electric', 0.00, 260, 185000.00, 2295, 2),
(19, 'SF90 Stradale', 1000, 'V8 Hybrid', 4.00, 340, 625000.00, 1570, 3),
(20, '488 Pista', 720, 'V8', 3.90, 340, 350000.00, 1280, 3),
(21, 'Roma', 620, 'V8', 3.90, 320, 222000.00, 1472, 3),
(22, '720S', 720, 'V8', 4.00, 341, 299000.00, 1419, 4),
(23, 'Artura', 671, 'V6 Hybrid', 3.00, 330, 225000.00, 1498, 4),
(24, 'Senna', 800, 'V8', 4.00, 335, 960000.00, 1198, 4),
(25, 'Huracan STO', 640, 'V10', 5.20, 310, 327000.00, 1339, 1),
(26, 'Aventador S', 740, 'V12', 6.50, 350, 417000.00, 1575, 1),
(27, 'Gallardo Superleggera', 570, 'V10', 5.20, 325, 240000.00, 1340, 1),
(28, 'Panamera Turbo S', 620, 'V8', 4.00, 315, 179000.00, 2035, 2),
(29, 'Cayenne Turbo GT', 631, 'V8', 4.00, 300, 182000.00, 2200, 2),
(30, '911 GT3', 510, 'Flat-6', 4.00, 318, 163000.00, 1418, 2),
(31, '812 Superfast', 789, 'V12', 6.50, 340, 335000.00, 1630, 3),
(32, 'Portofino M', 612, 'V8', 3.90, 320, 226000.00, 1664, 3),
(33, 'F8 Tributo', 710, 'V8', 3.90, 340, 280000.00, 1330, 3),
(34, 'McLaren GT', 612, 'V8', 4.00, 326, 210000.00, 1530, 4),
(35, '650S', 641, 'V8', 3.80, 333, 265000.00, 1428, 4),
(36, 'P1', 903, 'Hybrid V8', 3.80, 350, 1150000.00, 1395, 4),
(37, 'Sian FKP 37', 819, 'Hybrid V12', 6.50, 350, 3600000.00, 1620, 1),
(38, 'Murcielago LP670-4 SV', 670, 'V12', 6.50, 342, 450000.00, 1565, 1),
(39, 'Gallardo LP560-4', 560, 'V10', 5.20, 325, 202000.00, 1530, 1),
(40, '918 Spyder', 887, 'Hybrid V8', 4.60, 345, 845000.00, 1640, 2),
(41, '718 Boxster GTS', 394, 'Flat-6', 4.00, 293, 110000.00, 1420, 2),
(42, 'Macan Turbo', 434, 'V6', 2.90, 270, 84000.00, 1945, 2),
(43, 'LaFerrari', 950, 'Hybrid V12', 6.30, 350, 1400000.00, 1585, 3),
(44, 'F12berlinetta', 730, 'V12', 6.30, 340, 319000.00, 1630, 3),
(45, 'California T', 553, 'V8 Turbo', 3.90, 315, 202000.00, 1730, 3),
(46, '765LT', 755, 'V8', 4.00, 330, 358000.00, 1339, 4),
(47, '570S', 562, 'V8', 3.80, 328, 191000.00, 1450, 4),
(48, 'P1 GTR', 986, 'Hybrid V8', 3.80, 350, 2200000.00, 1440, 4);

-- --------------------------------------------------------

--
-- Table structure for table `Manufacturers`
--

CREATE TABLE `Manufacturers` (
  `manufacturer_id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Manufacturers`
--

INSERT INTO `Manufacturers` (`manufacturer_id`, `name`, `country`) VALUES
(1, 'Lamborghini', 'Italy'),
(2, 'Porsche', 'Germany'),
(3, 'Ferrari', 'Italy'),
(4, 'McLaren', 'United Kingdom');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `ID` int NOT NULL,
  `Path` varchar(255) NOT NULL,
  `Alt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`ID`, `Path`, `Alt`) VALUES
(7, '../assets/uploads/folder_1/1732224021-viber_image_2024-10-06_19-04-51-254.jpg', 'this is some text'),
(8, '../assets/uploads/folder_1/1732224570-viber_image_2024-10-06_19-04-51-254.jpg', 'this is second attempt');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `country` varchar(50) NOT NULL,
  `comment` text,
  `gender` enum('male','female') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `lastname`, `firstname`, `email`, `password`, `country`, `comment`, `gender`) VALUES
(27, 'Veneta', 'Minkova', 'Veneta', 'veneta.minkova@gmail.com', '$2y$10$ZzK4tz30Y3scr9d/IvAGL.RXZBDwykTSRCYS9hQwtYrmmakO2CBZW', 'Switzerland', '', 'female'),
(28, 'petko', 'petko', 'petko', 'petko@petko.me', '$2y$10$l4wg2g/2IZLJnMlP6kuabu9ldshbj3aaYYDDcl8ICIOPwR/tvBvlG', 'Switzerland', '', 'male'),
(31, 'Lazar', 'Minkov', 'Lazar', 'lazarminkov@gmail.com', '$2y$10$R7dB8CWgwnbHemtY.NBsVuEVcjmo96idodJRj4OgQ2sLjOb9b/Hwi', 'Switzerland', '', 'male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Cars`
--
ALTER TABLE `Cars`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `manufacturer_id` (`manufacturer_id`);

--
-- Indexes for table `Manufacturers`
--
ALTER TABLE `Manufacturers`
  ADD PRIMARY KEY (`manufacturer_id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Cars`
--
ALTER TABLE `Cars`
  MODIFY `car_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `Manufacturers`
--
ALTER TABLE `Manufacturers`
  MODIFY `manufacturer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Cars`
--
ALTER TABLE `Cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`manufacturer_id`) REFERENCES `Manufacturers` (`manufacturer_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
