-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2025 at 12:41 AM
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
-- Database: `voyager_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `id` int(11) NOT NULL,
  `country` varchar(50) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `popularity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`id`, `country`, `category`, `popularity`) VALUES
(1, 'Australia', 'Great nature and wildlife | Suggested: New Zealand | Interests: Adventure', 8),
(2, 'Oman', 'not yet to there but i will | Suggested: Syria | Interests: Adventure', 7),
(3, 'Seychelles', 'Amazing beaches and islands | Suggested: Maldives | Interests: Relaxation', 9),
(4, 'Morocco', 'Rich culture and old cities | Suggested: Egypt | Interests: Culture', 8),
(5, 'Rome', 'Historical landmarks and museums | Suggested: Florence | Interests: History', 9),
(6, 'Bali', 'Tropical vibes and temples | Suggested: Thailand | Interests: Nature', 8);

-- --------------------------------------------------------

--
-- Table structure for table `guides`
--

CREATE TABLE `guides` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `language` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `rate` int(11) DEFAULT NULL CHECK (`rate` between 1 and 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guides`
--

INSERT INTO `guides` (`id`, `name`, `language`, `country`, `rate`) VALUES
(1, 'Marie Conti', 'Italian, English, French', 'Italy', 5),
(2, 'Kenji Tanaka', 'Japanese, English', 'Japan', 5),
(3, 'Sofia Rodriguez', 'Spanish, Catalan, English, French', 'Spain', 4),
(4, 'Hana Kim', 'Korean, English', 'South Korea', 4),
(5, 'Marco Reyes', 'English, Spanish', 'Seychelles', 5);

-- --------------------------------------------------------

--
-- Table structure for table `travelers`
--

CREATE TABLE `travelers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 0 and 10)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `travelers`
--

INSERT INTO `travelers` (`id`, `name`, `email`, `rating`) VALUES
(1, 'Alice Johnson', 'alice.johnson@mail.com', 8),
(2, 'Bob Smith', 'bob.smith@mail.com', 7),
(3, 'Charlie Brown', 'charlie.brown@mail.com', 9),
(4, 'Diana Lee', 'diana.lee@mail.com', 8),
(5, 'Ethan Miller', 'ethan.miller@mail.com', 6),
(6, 'Fatima Al Said', 'fatima.alsaid@mail.com', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guides`
--
ALTER TABLE `guides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `travelers`
--
ALTER TABLE `travelers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `guides`
--
ALTER TABLE `guides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `travelers`
--
ALTER TABLE `travelers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
