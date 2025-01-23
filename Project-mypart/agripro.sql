-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2025 at 12:43 PM
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
-- Database: `agripro`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `summary` varchar(500) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `author_id`, `title`, `content`, `summary`, `created_at`, `updated_at`) VALUES
(1, 11, 'Agriculture', 'AI Detection.', 'AI Detection.', '2025-01-18 01:55:21', NULL),
(7, 11, 'yhgvc vc', 'cdcdccdc', 'cdcdccdc', '2025-01-18 18:20:51', NULL),
(8, 11, 'cdcdcdc', 'cdcdcdcc', 'cdcdcdcc', '2025-01-18 18:20:59', NULL),
(9, 11, 'Saikot', 'Saikot Kundu', 'Saikot Kundu', '2025-01-18 18:21:14', NULL),
(10, 13, 'Rojina', 'First Blog', 'First Blog', '2025-01-18 18:22:36', NULL),
(11, 13, 'Rojina', 'Second BLog', 'Second BLog', '2025-01-18 18:22:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `survey_feedback`
--

CREATE TABLE `survey_feedback` (
  `feedback_id` int(11) NOT NULL,
  `survay_feedbacker_id` int(11) NOT NULL,
  `satisfaction` enum('satisfied','neutral','dissatisfied') NOT NULL,
  `recommend` enum('yes','no') NOT NULL,
  `improvements` text NOT NULL,
  `rating` tinyint(4) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survey_feedback`
--

INSERT INTO `survey_feedback` (`feedback_id`, `survay_feedbacker_id`, `satisfaction`, `recommend`, `improvements`, `rating`, `submitted_at`) VALUES
(1, 0, 'satisfied', 'yes', 'Good.', 4, '2025-01-17 20:42:42'),
(5, 0, 'dissatisfied', 'no', 'bad', 2, '2025-01-18 06:20:03'),
(14, 0, 'neutral', 'yes', 'not so good or bad', 3, '2025-01-18 06:40:42'),
(20, 12, 'dissatisfied', 'no', 'bad', 4, '2025-01-18 06:54:11'),
(21, 12, 'satisfied', 'yes', 'yes', 4, '2025-01-19 19:02:19');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `gender` enum('MALE','FEMALE','OTHERS') NOT NULL,
  `dob` date NOT NULL,
  `image` text DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `utype` enum('Admin','Advisor','Farmer') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `phone`, `gender`, `dob`, `image`, `password`, `utype`, `created_at`, `updated_at`) VALUES
(1, 'Saikot Kundu', 'saikot@gmail.com', '01768200420', 'MALE', '2010-04-07', 'IMG20210125221841_00.jpg', '54321', 'Admin', '2025-01-05 09:57:39', '2025-01-19 10:37:26'),
(11, 'Md Rafi', 'rafi@gmail.com', '12345678901', 'MALE', '1996-05-06', '418838317_785171643641355_2264073435640715296_n.jpg', '45678', 'Advisor', '2025-01-05 20:45:58', '2025-01-06 06:37:27'),
(12, 'Rajesh Saha', 'rajesh@gmail.com', '01789234564', 'MALE', '1998-02-03', 'IMG20210715183200_00.jpg', '09876', 'Farmer', '2025-01-10 18:43:34', '2025-01-19 20:36:09'),
(13, 'Rojina Akhter', 'rojina@gmail.com', '09876543210', 'FEMALE', '1995-06-06', '20869321.jpg', '56789', 'Advisor', '2025-01-10 19:11:18', '2025-01-10 19:11:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_blogs_user_id` (`author_id`);

--
-- Indexes for table `survey_feedback`
--
ALTER TABLE `survey_feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `fk_survey_feedback_feedbacker_id` (`survay_feedbacker_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `survey_feedback`
--
ALTER TABLE `survey_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
