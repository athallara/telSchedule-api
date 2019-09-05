-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 18, 2019 at 06:02 PM
-- Server version: 5.7.26-0ubuntu0.18.04.1
-- PHP Version: 7.2.19-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `telschedules`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `courseName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `courseCode` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `courseDesc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lectureName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lectureCode` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lectureContact` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `courseName`, `courseCode`, `courseDesc`, `lectureName`, `lectureCode`, `lectureContact`, `user_id`, `created_at`, `updated_at`) VALUES
(21, 'punya thall 2', 'zxcsda', 'zxc', 'zxc', 'zxc', 'zxc', 5, '2019-05-30 09:28:27', '2019-05-30 09:28:27'),
(22, '123', '1432', '123432', '32132', '4123432', '321432', 6, NULL, NULL),
(23, '32132', '312432', '32432', '342132', '312432', '132432', 6, NULL, NULL),
(24, 'punya thall 2', 'zxcsda', 'zxc', 'zxc', 'zxc', 'zxc', 6, '2019-06-01 07:26:08', '2019-06-01 07:26:08'),
(30, 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 7, '2019-06-03 12:15:14', '2019-06-03 14:04:57'),
(31, 'punya empty 33', 'zxcsda', 'zxc', 'zxc', 'zxc', 'zxc', 7, '2019-06-03 12:15:25', '2019-06-03 12:15:25');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2019_05_24_035522_create_course_list_table', 2),
(8, '2019_05_09_035818_create_users_table', 3),
(9, '2019_05_24_040826_create_courses_table', 3),
(10, '2019_05_30_074904_create_schedules_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(10) UNSIGNED NOT NULL,
  `day` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `type` enum('fixed','temporary') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fixed',
  `course_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `day`, `startTime`, `endTime`, `type`, `course_id`, `created_at`, `updated_at`) VALUES
(1, 'monday', '19:00:00', '20:00:00', 'fixed', 21, NULL, NULL),
(2, 'monday', '19:00:00', '20:00:00', 'fixed', 21, NULL, NULL),
(3, 'tue', '03:00:00', '04:00:00', 'fixed', 22, NULL, NULL),
(4, 'tue', '03:00:00', '04:00:00', 'fixed', 22, NULL, NULL),
(5, 'wed', '06:00:00', '07:00:00', 'fixed', 23, NULL, NULL),
(6, 'wec', '06:00:00', '08:00:00', 'fixed', 23, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `university` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `major` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `classGroup` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `password`, `university`, `major`, `classGroup`, `created_at`, `updated_at`) VALUES
(5, 'admin', 'admin123', '$2y$10$/TWJKJAWJl9oFVI0Qd.gbOKH2i8XHwrSMP3K5d0wHVaViUYl9J.jK', 'admin', 'admin', 'admin', '2019-05-29 09:38:48', '2019-05-29 09:54:27'),
(6, 'athalla', 'Athalla Rizky', '$2y$10$hdUTlsKVZsoE64BwS2HKV.gQM2RI.rI0Hm3biWfz6lP9WpTDF0V.K', 'Telkom University', 'Teknik Informatika', 'IF-42-09', '2019-05-29 10:09:34', '2019-05-29 10:09:34'),
(7, 'empty', 'Athalla Rizky', '$2y$10$1maP/y7o3oULXvsM0fupOuYnEPtMQ.sDxws/5ULcZF1BBS9qOkGKa', 'Telkom University', 'Teknik Informatika', 'IF-42-09', '2019-06-01 07:30:38', '2019-06-01 07:30:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedules_course_id_foreign` (`course_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
