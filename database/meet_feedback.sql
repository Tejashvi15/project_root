-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2025 at 12:38 PM
-- Server version: 10.11.10-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u409067159_studifysuccess`
--

-- --------------------------------------------------------

--
-- Table structure for table `meet_feedback`
--

CREATE TABLE `meet_feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `feedback` text NOT NULL,
  `ratings` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meet_feedback`
--

INSERT INTO `meet_feedback` (`id`, `name`, `email`, `feedback`, `ratings`, `date`) VALUES
(3, 'Naman', 'namanjain9868@gmail.com', 'interface was looking too old and not apt for kids from my perspective\ncomparing this with gmeet, gmeet looks better', '2', '2025-03-18 18:07:11'),
(4, 'Priya Dubey', 'pd81902@gmail.com', 'Great experience.I like the additional features like GIF and whiteboard features as well.Great work.', '5', '2025-01-13 18:07:15'),
(5, 'Sahil Sharma', 'sahilsharma.ss1766@gmail.com', 'All great', '5', '2025-01-14 18:07:27'),
(6, 'Veepanshu Kasana', 'veepanshukasana2728@gmail.com', 'It was awesome and recruitment team is so cooperative.', '5', '2025-01-22 18:07:31'),
(7, 'Anushka Jaiswal', 'anushkajaiswal0928@gmail.com', 'had very nice experience', '5', '2024-11-13 18:07:40'),
(8, 'Dev Garg', 'dev816828@gmail.com', 'It was a good experience. I am looking forward the opportunity', '5', '2024-10-16 18:07:46'),
(9, 'Shefali Singh', 'shefalithakur072@gmail.com', 'It was very informative and interactive session', '5', '2024-12-24 18:07:51'),
(10, 'Kashish', 'pahadiakashish7@gmail.com', 'It was great', '4', '2025-03-10 15:10:56'),
(11, 'Manvi Jain', 'manvijain1723@gmail.com', 'my experience was good the interviewers were very polite', '5', '2025-03-11 15:01:20'),
(12, 'Sahil Rajput', 'sahilr073@gmail.com', 'it was informative and lag free', '5', '2025-03-11 16:10:02'),
(13, 'Daksh Bansal', 'dakshbansal12112005@gmail.com', 'my experience is great , admin is very cooperative and kind .', '5', '2025-03-13 14:09:20'),
(14, 'Simran', 'worksimran126@gmail.com', 'Good', '5', '2025-03-16 14:57:28'),
(15, 'Harsimran Singh Ikwan', 'harsimransinghikwan11@gmail.com', 'It was great to interact with the HR! Looking forward to hear & contributing to studifysuccess:)', '5', '2025-03-17 14:11:49'),
(16, 'Anvi Gupta', 'anvi01156@gmail.com', 'Great altogether!', '4', '2025-03-17 14:59:23'),
(17, 'Kaushal Kumar', 'tkd7739502012@gmail.com', 'It was good experience', '5', '2025-03-19 13:37:51'),
(18, 'Rahul Verma', 'vermarahul72787@gmail.com', 'It was a really good experience.', '5', '2025-03-19 14:17:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meet_feedback`
--
ALTER TABLE `meet_feedback`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meet_feedback`
--
ALTER TABLE `meet_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
