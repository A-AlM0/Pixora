-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2024 at 01:50 AM
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
-- Database: `pixora`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `commented_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `user_id`, `comment`, `commented_at`) VALUES
(3, 43, 20, 'I like this movie !!', '2024-12-09 00:06:08'),
(4, 41, 20, 'That looks good though!!!', '2024-12-09 00:34:03');

-- --------------------------------------------------------

--
-- Table structure for table `explore`
--

CREATE TABLE `explore` (
  `explore_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `tag` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `liked_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `user_id`, `post_id`, `liked_at`, `created_at`) VALUES
(27, 20, 41, '2024-12-09 00:34:08', '2024-12-09 00:34:08');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `caption` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `image_path`, `caption`, `created_at`) VALUES
(18, 17, 'uploads/posts/67561c774626d_2.PNG', '1', '2024-12-08 22:23:51'),
(19, 17, 'uploads/posts/67561c9c740be_3.PNG', '2', '2024-12-08 22:24:28'),
(20, 17, 'uploads/posts/67561cb71a839_4.PNG', '4', '2024-12-08 22:24:55'),
(21, 17, 'uploads/posts/67561cd1739dd_5.PNG', '5', '2024-12-08 22:25:21'),
(22, 17, 'uploads/posts/67561cea918b7_6.PNG', '7', '2024-12-08 22:25:46'),
(23, 17, 'uploads/posts/67561d04ee0a5_8.PNG', '9', '2024-12-08 22:26:12'),
(24, 17, 'uploads/posts/67561d22ab36f_9.PNG', '9', '2024-12-08 22:26:42'),
(25, 18, 'uploads/posts/67561dec87aad_1.PNG', '1', '2024-12-08 22:30:04'),
(26, 18, 'uploads/posts/67561e05c22b6_2.PNG', '2', '2024-12-08 22:30:29'),
(27, 18, 'uploads/posts/67561e1d2add2_3.PNG', '3', '2024-12-08 22:30:53'),
(28, 18, 'uploads/posts/67561e32a51a9_4.PNG', '4', '2024-12-08 22:31:14'),
(29, 18, 'uploads/posts/67561e4cce6ca_5.PNG', '5', '2024-12-08 22:31:40'),
(30, 18, 'uploads/posts/67561e6f34214_7.PNG', '7', '2024-12-08 22:32:15'),
(31, 18, 'uploads/posts/67561e9e5dd7a_6.PNG', '6', '2024-12-08 22:33:02'),
(32, 18, 'uploads/posts/67561eb75d92d_99.PNG', '899', '2024-12-08 22:33:27'),
(33, 18, 'uploads/posts/67561ed79b06b_33.PNG', '33', '2024-12-08 22:33:59'),
(34, 19, 'uploads/posts/6756229da2bd5_3.PNG', '1', '2024-12-08 22:50:05'),
(35, 19, 'uploads/posts/675622ed87244_4.PNG', '4', '2024-12-08 22:51:25'),
(36, 19, 'uploads/posts/67562310002be_5.PNG', '5', '2024-12-08 22:52:00'),
(37, 19, 'uploads/posts/675623821654d_3.png', '44', '2024-12-08 22:53:54'),
(38, 19, 'uploads/posts/6756238eb1599_Arcane.png', '7', '2024-12-08 22:54:06'),
(39, 19, 'uploads/posts/675623a734527_MANDOOB-Credit332232.png', '8', '2024-12-08 22:54:31'),
(41, 19, 'uploads/posts/67562442acafd_8.PNG', '8', '2024-12-08 22:57:06'),
(42, 19, 'uploads/posts/6756249db97f9_66.PNG', '66', '2024-12-08 22:58:37'),
(43, 19, 'uploads/posts/675624d2e74be_88.PNG', '88', '2024-12-08 22:59:30'),
(54, 20, 'uploads/posts/6756274ea7bc8_lost-planet23.png', 'lsot', '2024-12-08 23:10:06'),
(55, 20, 'uploads/posts/675627b687aa0_dwe.png', '#arcane', '2024-12-08 23:11:50'),
(56, 20, 'uploads/posts/675627d273cb5_dragoo.png', '0', '2024-12-08 23:12:18'),
(57, 20, 'uploads/posts/675628437afcf_horror.png', '6', '2024-12-08 23:14:11'),
(58, 20, 'uploads/posts/6756286a99680_lost1.png', 'lostt', '2024-12-08 23:14:50'),
(59, 20, 'uploads/posts/675628967e963_strar.png', 's', '2024-12-08 23:15:34'),
(60, 20, 'uploads/posts/675628e9e9053_live-your-life-you-will-remember.png', 'm', '2024-12-08 23:16:57'),
(61, 20, 'uploads/posts/6756294688cb9_32ي.png', 'i', '2024-12-08 23:18:30'),
(62, 20, 'uploads/posts/675629acd966a_IK9.jpg', 'kk', '2024-12-08 23:20:12'),
(64, 20, 'uploads/posts/675629d604fee_Octopus.png', 'ool', '2024-12-08 23:20:54'),
(65, 20, 'uploads/posts/67562a59ef778_سنوره.png', 'lp', '2024-12-08 23:23:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `hobbies` text DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `first_name`, `last_name`, `phone_number`, `hobbies`, `password_hash`, `profile_picture`, `bio`, `created_at`, `avatar`) VALUES
(17, 'TechComp', 'techcomp@gmail.com', 'Tech', 'Comp', '056666666', 'None', '$2y$10$/MscDfYrWpi2xaPEkx/9B.bgSmkEWg.ZYrhvCp1sP4wPMog6K1u2q', NULL, NULL, '2024-12-08 22:12:03', 'uploads/avatars/67561c10812b3_1.jpg'),
(18, 'Hungerstation', 'hunger@gmail.com', 'hunger', 'station', '059999999', 'none', '$2y$10$wd5K1w.2ZNwMryiA24xu0eIRNbk4qUwio0rbZEtAst6LVUMT31OLm', NULL, NULL, '2024-12-08 22:27:35', 'uploads/avatars/67561d7ae98a8_unnamed.png'),
(19, 'Netflex', 'netflex@gmail.com', 'net', 'flex', '05534444444', 'none', '$2y$10$khHmUDVXZcEUevsfANThYeCIXalw4l0S4iHHv/RW7TYLU5isrAnM6', NULL, NULL, '2024-12-08 22:34:40', 'uploads/avatars/675622a156bfc_2.jpg'),
(20, 'MohammedGhazi', 'tst@gmail.com', 'Mohammed', 'Ghazi', '05231112212', 'none', '$2y$10$grJ8tSthRy2TLBiy1tN6C.HG3l2us6yXZFPpSpNo3zXd9HpDHnwbi', NULL, NULL, '2024-12-08 23:01:45', 'uploads/avatars/67563a8eb15e7_Untitled-1.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `explore`
--
ALTER TABLE `explore`
  ADD PRIMARY KEY (`explore_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `explore`
--
ALTER TABLE `explore`
  MODIFY `explore_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `explore`
--
ALTER TABLE `explore`
  ADD CONSTRAINT `explore_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
