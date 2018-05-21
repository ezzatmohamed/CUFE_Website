-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2018 at 09:41 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(73, '2018_03_03_113916_create_users_table', 1),
(74, '2018_03_18_181909_create_students_table', 1),
(75, '2018_05_02_060543_create_comments_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) NOT NULL,
  `text` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `program` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `student_id`, `text`, `photo_name`, `created_at`, `updated_at`, `program`) VALUES
(2, 1152127, 'asdf', NULL, '2018-05-07 15:40:15', '2018-05-07 15:40:15', 'CCE'),
(3, 1162271, 'ay 7aga', NULL, '2018-05-12 04:33:33', '2018-05-12 04:33:33', 'CCEC');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_you` text COLLATE utf8mb4_unicode_ci,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkdin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img_ext` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gpa` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cv` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `city`, `about_you`, `facebook`, `twitter`, `linkdin`, `img_ext`, `created_at`, `updated_at`, `name`, `gpa`, `program`, `cv`) VALUES
(1152127, NULL, NULL, NULL, NULL, NULL, 'unknown.jpg', '2018-05-07 15:32:22', '2018-05-07 15:32:22', 'Aisha Hussein Abdellatif Abdelwahid', '3.050', 'CCE', NULL),
(1162271, NULL, NULL, NULL, NULL, NULL, '1162271.jpg', '2018-05-07 14:29:56', '2018-05-07 16:10:11', 'Mohamed Ezzat Abd Hamed', '2.580', 'CCEC', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `timetables`
--

CREATE TABLE `timetables` (
  `id` int(10) NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_code` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `location` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `time` varchar(100) NOT NULL,
  `day` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timetables`
--

INSERT INTO `timetables` (`id`, `student_id`, `course_name`, `course_code`, `type`, `location`, `time`, `day`) VALUES
(57, 1162271, 'Basic Engineering Design', 'GENN003', 'Lecture', '\'[51206]\'', '8:00 To 9:50', 'Saturday'),
(58, 1162271, 'Computer Architecture', 'CMPN301', 'Tutorial', '\'[3201]\'', '11:00 To 1:50', 'Sunday'),
(59, 1162271, 'Computer Architecture', 'CMPN301', 'Lecture', '\'[3702]\'', '9:00 To 10:50', 'Sunday'),
(60, 1162271, 'Seminar-1', 'CCEN280', 'Lecture', '\'[1520]\'', '8:00 To 8:50', 'Sunday'),
(61, 1162271, 'Electronics-2 Analog and Digital Electronics', 'ELCN201', 'Lecture', '\'[18302]\'', '1:00 To 3:50', 'Monday'),
(62, 1162271, 'Electronics-2 Analog and Digital Electronics', 'ELCN201', 'Tutorial', '\'[20511]\'', '11:00 To 12:50', 'Monday'),
(63, 1162271, 'Microprocessor Systems-2', 'CMPN211', 'Lecture', '\'[20503]\'', '9:00 To 10:50', 'Monday'),
(64, 1162271, 'Communication and Presentation Skills', 'GENN201', 'Lecture', '\'[20104]\'', '11:00 To 12:50', 'Tuesday'),
(65, 1162271, 'Microprocessor Systems-2', 'CMPN211', 'Tutorial', '\'[3709]\'', '2:00 To 3:50', 'Tuesday'),
(66, 1162271, 'Software Engineering', 'CMPN203', 'Lecture', '\'[3701]\'', '2:00 To 3:50', 'Wednesday'),
(67, 1162271, 'Software Engineering', 'CMPN203', 'Tutorial', '\'[3706]\'', '11:00 To 1:50', 'Wednesday'),
(68, 1162271, 'Signal Analysis', 'ELCN203', 'Tutorial', '\'[18201]\'', '2:00 To 3:50', 'Thursday'),
(69, 1162271, 'Signal Analysis', 'ELCN203', 'Lecture', '\'[18202]\'', '8:00 To 10:50', 'Thursday'),
(70, 1162271, 'Signal Analysis', 'ELCN203', 'Lecture', '\'[18202]\'', '8:00 To 10:50Credits', 'Thursday'),
(71, 1152127, 'Computer Architecture', 'CMPN301', 'Tutorial', '\'[3201]\'', '11:00 To 1:50', 'Sunday'),
(72, 1152127, 'Computer Architecture', 'CMPN301', 'Lecture', '\'[3702]\'', '9:00 To 10:50', 'Sunday'),
(73, 1152127, 'Seminar-1', 'CCEN280', 'Lecture', '\'[1520]\'', '8:00 To 8:50', 'Sunday'),
(74, 1152127, 'Microprocessor Systems-2', 'CMPN211', 'Lecture', '\'[20503]\'', '9:00 To 10:50', 'Monday'),
(75, 1152127, 'Microprocessor Systems-2', 'CMPN211', 'Tutorial', '\'[3709]\'', '2:00 To 3:50', 'Tuesday'),
(76, 1152127, 'Risk Management and Environment', 'GENN210', 'Lecture', '\'[20510]\'', '11:00 To 12:50', 'Tuesday'),
(77, 1152127, 'Risk Management and Environment', 'GENN210', 'Lecture', '\'[20510]\'', '11:00 To 12:50Credits', 'Tuesday');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1152127, '1152127', '11041155', '9QWo99d4UJEZCVcitZQ3M39UkFyYlWNBUgWQsoAQ90Lxr9ovmExA4uOrRht2', '2018-05-07 15:32:20', '2018-05-07 15:32:20'),
(1162271, '1162271', 'parkour2020', 'hIuR2Y4FlcluGcloNM6AMs9cIsl5QAllhLpHAQ5EmRtARVjm2R7ZDJDBnxCx', '2018-05-07 14:29:54', '2018-05-07 14:29:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_student_id_foreign` (`student_id`),
  ADD KEY `comments_post_id_foreign` (`post_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_ibfk_1` (`student_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_ibfk_1` (`student_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_ibfk_1` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timetables`
--
ALTER TABLE `timetables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timetables_ibfk_1` (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timetables`
--
ALTER TABLE `timetables`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1162272;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_id_foreign` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `timetables`
--
ALTER TABLE `timetables`
  ADD CONSTRAINT `timetables_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
