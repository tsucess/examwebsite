-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2022 at 08:37 PM
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
  `email` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `gender` int(1) NOT NULL,
  `is_super_admin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `firstname`, `lastname`, `passport_no`, `nationality`, `avatar`, `email`, `password`, `gender`, `is_super_admin`) VALUES
(3, 'TAOFEEQ', 'OGUNSANYA', '12345765775768', 'COUNTRY', '1669153376passport white.png', 'admin@gmail.com', '$2y$10$LAfy9VCnBxZQsmuYUgE8veQSSNwfdNtocGpTcMT.sAcDQLFqtbX0u', 1, 2),
(4, 'FOLORUNSHO', 'EMMANUEL', '123456213', 'Armenia', '166905969320190530_134451_0000.png', 'nuel@gmail.com', '$2y$10$4oH3p69lgQtZ.0AecaSWBO.7fWMUi7X0JrP8hahUXA6LNnCC4D8wK', 1, 1),
(5, 'SIMBIAT', 'OLATUNJI', '2341111111234', 'United Kingdom', '1669063201ARTIST INDIA.png', 'simbiat@gmail.com', '$2y$10$hDQY.siWHQ62CuThbqDTYO3k2eUPnHqxc/NsIY7dvttx4IES29GXW', 0, 1);

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
(1, 'the rich dad poor dad', '1669204673Rich Dad Poor Dad.pdf', '2022-11-23 11:57:53', 3);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `body` text NOT NULL,
  `post_thumbnail` varchar(150) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_featured` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `post_thumbnail`, `date_time`, `is_featured`) VALUES
(1, '2022/2023 IGCSE EXAMINATION REGISTERAIOTN COMING SOON', '\r\nLorem ipsum dolor sit, amet consectetur adipisicing elit. \r\nQuo eaque doloribus distinctio optio facilis harum, \r\nitaque nesciunt, iusto culpa impedit natus hic amet. \r\nIn quod omnis dolore harum autem? Necessitatibus.\r\nLorem ipsum dolor sit, amet consectetur adipisicing elit. \r\nQuo eaque doloribus distinctio optio facilis harum, \r\nitaque nesciunt, iusto culpa impedit natus hic amet. \r\nIn quod omnis dolore harum autem? Necessitatibus. \r\nLorem ipsum dolor sit, amet consectetur adipisicing elit. \r\nQuo eaque doloribus distinctio optio facilis harum, \r\nitaque nesciunt, iusto culpa impedit natus hic amet. \r\nIn quod omnis dolore harum autem? Necessitatibus.\r\nLorem ipsum dolor sit, amet consectetur adipisicing elit. \r\nQuo eaque doloribus distinctio optio facilis harum, \r\nitaque nesciunt, iusto culpa impedit natus hic amet. \r\nIn quod omnis dolore harum autem? Necessitatibus. \r\nLorem ipsum dolor sit, amet consectetur adipisicing elit. \r\nQuo eaque doloribus distinctio optio facilis harum, \r\nitaque nesciunt, iusto culpa impedit natus hic amet. \r\nIn quod omnis dolore harum autem? Necessitatibus.\r\nLorem ipsum dolor sit, amet consectetur adipisicing elit. \r\nQuo eaque doloribus distinctio optio facilis harum, \r\nitaque nesciunt, iusto culpa impedit natus hic amet. \r\nIn quod omnis dolore harum autem? Necessitatibus. \r\nLorem ipsum dolor sit, amet consectetur adipisicing elit. \r\nQuo eaque doloribus distinctio optio facilis harum, \r\nitaque nesciunt, iusto culpa impedit natus hic amet. \r\nIn quod omnis dolore harum autem? Necessitatibus.\r\nLorem ipsum dolor sit, amet consectetur adipisicing elit. \r\nQuo eaque doloribus distinctio optio facilis harum, \r\nitaque nesciunt, iusto culpa impedit natus hic amet. \r\nIn quod omnis dolore harum autem? Necessitatibus. \r\nLorem ipsum dolor sit, amet consectetur adipisicing elit. \r\nQuo eaque doloribus distinctio optio facilis harum, \r\nitaque nesciunt, iusto culpa impedit natus hic amet. \r\nIn quod omnis dolore harum autem? Necessitatibus.\r\nLorem ipsum dolor sit, amet consectetur adipisicing elit. \r\nQuo eaque doloribus distinctio optio facilis harum, \r\nitaque nesciunt, iusto culpa impedit natus hic amet. \r\nIn quod omnis dolore harum autem? Necessitatibus.', '1668877636index.jpg', '2022-11-23 13:34:00', 0),
(2, 'New Story on Examination News', 'Lorem ipsum, dolor sit amet &#38;#38;#38;#13;&#38;#38;#38;#10;consectetur adipisicing elit. Sint nulla voluptatibus rem dolorem? Ipsam aut neque, &#38;#38;#38;#13;&#38;#38;#38;#10;aspernatur exercitationem quas enim cumque, &#38;#38;#38;#13;&#38;#38;#38;#10;inventore consectetur molestiae dolorem, tempora alias illo porro ab!&#38;#38;#38;#13;&#38;#38;#38;#10;Lorem ipsum, dolor sit amet &#38;#38;#38;#13;&#38;#38;#38;#10;consectetur adipisicing elit. Sint nulla voluptatibus rem dolorem? Ipsam aut neque, &#38;#38;#38;#13;&#38;#38;#38;#10;aspernatur exercitationem quas enim cumque, &#38;#38;#38;#13;&#38;#38;#38;#10;inventore consectetur molestiae dolorem, tempora alias illo porro ab!&#38;#38;#38;#13;&#38;#38;#38;#10;Lorem ipsum, dolor sit amet &#38;#38;#38;#13;&#38;#38;#38;#10;consectetur adipisicing elit. Sint nulla voluptatibus rem dolorem? Ipsam aut neque, &#38;#38;#38;#13;&#38;#38;#38;#10;aspernatur exercitationem quas enim cumque, &#38;#38;#38;#13;&#38;#38;#38;#10;inventore consectetur molestiae dolorem, tempora alias illo porro ab!&#38;#38;#38;#13;&#38;#38;#38;#10;Lorem ipsum, dolor sit amet &#38;#38;#38;#13;&#38;#38;#38;#10;consectetur adipisicing elit. Sint nulla voluptatibus rem dolorem? Ipsam aut neque, &#38;#38;#38;#13;&#38;#38;#38;#10;aspernatur exercitationem quas enim cumque, &#38;#38;#38;#13;&#38;#38;#38;#10;inventore consectetur molestiae dolorem, tempora alias illo porro ab!&#38;#38;#38;#13;&#38;#38;#38;#10;Lorem ipsum, dolor sit amet &#38;#38;#38;#13;&#38;#38;#38;#10;consectetur adipisicing elit. Sint nulla voluptatibus rem dolorem? Ipsam aut neque, &#38;#38;#38;#13;&#38;#38;#38;#10;aspernatur exercitationem quas enim cumque, &#38;#38;#38;#13;&#38;#38;#38;#10;inventore consectetur molestiae dolorem, tempora alias illo porro ab!', '1669211315Business-Commerce-min.png', '2022-11-23 14:48:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `registered_subjects`
--

CREATE TABLE `registered_subjects` (
  `id` int(11) UNSIGNED NOT NULL,
  `subject` text NOT NULL,
  `subject_code` varchar(150) NOT NULL,
  `subject_id` varchar(100) NOT NULL,
  `student_id` int(11) UNSIGNED NOT NULL,
  `year` varchar(10) NOT NULL,
  `session` int(1) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `payment_status` varchar(10) NOT NULL,
  `amount` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registered_subjects`
--

INSERT INTO `registered_subjects` (`id`, `subject`, `subject_code`, `subject_id`, `student_id`, `year`, `session`, `date_time`, `payment_status`, `amount`) VALUES
(1, 'Furher Mathematics,Information and Communication Technology,Commerce,English Language,Physics,Biolog', '242,109,234,122,422,211', '9,7,6,5,4,2', 4, '2023', 0, '2022-11-22 04:46:09', 'success', 3950),
(2, 'Mathematics,Information and Communication Technology,Commerce,English Language,Physics,Biology', '242,109,234,122,422,211,411', '9,7,6,5,4,2,1', 5, '2023', 1, '2022-11-22 23:06:10', 'success', 4750);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `subject_code` int(100) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `end_date` varchar(100) NOT NULL,
  `fee` varchar(10000) NOT NULL,
  `thumbnail` varchar(150) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject`, `subject_code`, `start_date`, `end_date`, `fee`, `thumbnail`, `date_time`) VALUES
(1, 'Mathematics', 109, '2022-11-25', '2022-11-30', '900', '1669205462Wordle-Math.png', '2022-11-23 12:11:02'),
(2, 'English Language', 201, '2022-12-01', '2022-12-10', '850', '1669205536do-you-speak-english.png', '2022-11-23 12:12:16'),
(3, 'Information and Communication Technology', 211, '2022-12-03', '2022-12-13', '700', '1669205570ICT-image.jpg', '2022-11-23 12:12:50'),
(4, 'Biology', 240, '2022-11-25', '2022-12-08', '750', '1669205617plant-cell-3d.png', '2022-11-23 12:13:37'),
(5, 'Physics', 234, '2022-12-01', '2022-11-10', '800', '1669205674physics_0066f46bde.jpg', '2022-11-23 12:14:34'),
(6, 'Chemistry', 264, '2022-11-25', '2022-12-08', '800', '1669205719chemistry.jpg', '2022-11-23 12:15:19'),
(7, 'Commerce', 222, '2022-11-24', '2022-12-02', '700', '1669205752Business-Commerce-min.png', '2022-11-23 12:15:52'),
(8, 'Economics', 201, '2022-11-26', '2022-11-29', '650', '16692058105414c084-71d4-43fe-a7a6-f07032f42b90.png', '2022-11-23 12:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `passport_no` varchar(50) NOT NULL,
  `passport` varchar(100) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `dob` varchar(11) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` int(1) NOT NULL,
  `is_super_admin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `passport_no`, `passport`, `nationality`, `dob`, `avatar`, `email`, `password`, `gender`, `is_super_admin`) VALUES
(1, 'TAOFEEQ', 'OGUNSANYA', '12345678', '1668431826IMG-20221108-WA0028.jpg', 'Bahrain', '1998-09-22', '16692124079ice Bday2.jpg', 'example@gmail.com', '', 1, 0),
(2, 'SIMBIAT', 'AREMU', '987654', '1668438928relocation_Letter-1.pdf', 'United Arab Emirates', '2013-09-04', '1669212839bola.jpg', 'simbiat@gmail.com', '$2y$10$QlFfYQ9xXwCzfX/3WDu72ed89fwIT1VB3Ah1UknStspQ3l.RrcJjq', 0, 0),
(3, 'PETER', 'OKI', '12345678', 'Dashboard - NASIMS.pdf', 'Botswana', '2019-12-10', '16692128821577962543664.jpg', 'oki@gmail.com', '$2y$10$2YY4fOX1SS15JOxbgO991eg5DXlVINUTlsanK0ShzlNUN7tP1HpwK', 1, 0),
(4, 'KHALEED', 'AHMED', '12345678', 'IMG-20221108-WA0028.jpg', 'Argentina', '2014-09-21', '16689312169icepic1.jpg', 'khaleed@gmail.com', '$2y$10$yLqw/KMGE6xBZGbGYJAtIORgzVlSGHF2ACKZ/BUEHFNvSO0AitJkS', 1, 0),
(5, 'AHMAD', 'AKEEM', '12345667754', 'IMG-20221108-WA0026.jpg', 'Trinidad and Tobago', '2003-06-10', '16690629351577964075757.jpg', 'yusuf@gmail.com', '$2y$10$NRacxZ46HtW7gmBekESFce8dbPFFX2B86hFqIMQRxpNHvLcrY5Kt6', 1, 0);

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
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `registered_subjects`
--
ALTER TABLE `registered_subjects`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
