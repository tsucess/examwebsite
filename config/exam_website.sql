-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2022 at 07:08 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `passport_no` varchar(150) NOT NULL,
  `nationality` varchar(150) NOT NULL,
  `avatar` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `gender` int(1) NOT NULL,
  `is_super_admin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `firstname`, `lastname`, `passport_no`, `nationality`, `avatar`, `password`, `gender`, `is_super_admin`) VALUES
(1, 'ABIDEMI', 'OLATUNJI', '112334542', 'Nigeria', '1668213198VYNTAGE.jpg', '$2y$10$gwrQjSYodk7fx6RpGvTMHemcnD1keeWNev9Ut35c60Ve3n.Uo8ibO', 1, 1),
(2, 'HADIZA', 'ALIMI', '34567852', 'Arab', '16682136031578294401390.jpg', '$2y$10$faXDSYWslTvV9lpT/eUv/eRvDa1YorLh42kO7Uf/8yBjALDfLNr02', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `document` varchar(150) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `author_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `title`, `document`, `date_time`, `author_id`) VALUES
(1, 'Sell with ease on whatsapp', '1668157124Sell with Ease - Touch their emotion and make them buy from you..pdf', '2022-11-11 08:58:44', 1),
(3, 'new jobberman certificates', '1668155823Jobberman_Soft_Skill_Certificate_6232514.pdf', '2022-11-11 15:02:59', 3);

-- --------------------------------------------------------

--
-- Table structure for table `registered_subjects`
--

CREATE TABLE `registered_subjects` (
  `id` int(11) UNSIGNED NOT NULL,
  `subject` varchar(100) NOT NULL,
  `subject_code` int(11) NOT NULL,
  `student_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `subject_code` int(100) NOT NULL,
  `option_code` varchar(100) NOT NULL,
  `fee` varchar(10000) NOT NULL,
  `thumbnail` varchar(150) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject`, `subject_code`, `option_code`, `fee`, `thumbnail`, `date_time`) VALUES
(1, 'Mathematics', 411, '01st November 2022 - 10th November 2022', '800', '1668165308Wordle-Math.png', '2022-11-12 01:27:02'),
(2, 'Biology', 211, '12th November 2022 - 30th November 2022', '500', '1668165324cells-animal-plant-ways-nucleus-difference-organelles.png', '2022-11-12 01:08:15'),
(4, 'Physics', 422, '15th November 2022 - 29th November 2022', '700', '1668215539physics-tuition-500x500.png', '2022-11-12 01:12:19'),
(5, 'English Language', 122, '12th November 2022 - 30th January 2023', '900', '1668216224do-you-speak-english.png', '2022-11-12 01:23:44'),
(6, 'Commerce', 234, '20th November 2022 - 30th December 2022', '400', '1668216284Business-Commerce-min.png', '2022-11-12 01:24:44'),
(7, 'Information and Communication Technology', 109, '10th October 2022 - 30th November 2022', '750', '1668216391ICT-image.jpg', '2022-11-12 01:26:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `passport_no` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `dob` varchar(11) NOT NULL,
  `passport` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` int(1) NOT NULL,
  `is_super_admin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `passport_no`, `nationality`, `dob`, `passport`, `password`, `gender`, `is_super_admin`) VALUES
(1, 'OGUNSANYA TAOFEEQ', '123456', 'Nigeria', '2000-09-22', '1668084454passportred.png', '$2y$10$sM1DW13IkEFLVw/F6y.Ooe6NccbaGZ3w/SHSy2vfwBPYDURAl2j76', 1, 0),
(3, 'AREMU SIMBIAT', '987654', 'USA', '2005-09-04', '1668092423FB_IMG_1600723540974.png', '$2y$10$49q6BG.BJQCkuAod8.NZxe749mZQANZs.89w0lYgZm6eeKMj0hFC.', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registered_subjects`
--
ALTER TABLE `registered_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `registered_subjects`
--
ALTER TABLE `registered_subjects`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
