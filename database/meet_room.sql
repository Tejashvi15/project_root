-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2025 at 12:36 PM
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
-- Table structure for table `meet`
--

CREATE TABLE `meet_room` (
  `id` int(11) NOT NULL,
  `roomName` varchar(255) NOT NULL,
  `appId` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meet`
--

INSERT INTO `meet_room` (`id`, `roomName`, `appId`) VALUES
(1, 'meet1', 'vpaas-magic-cookie-01a4f784d99d4e12a678d677fdf0f60e'),
(2, 'meet2', 'vpaas-magic-cookie-cb5de9454347490a93542a28720e7a6d'),
(4, 'class7', 'vpaas-magic-cookie-dca638b2f6e94b0caf3ab6c28fbebb77'),
(5, 'trial-class', 'vpaas-magic-cookie-5aec4271dc114aa09a60048ad9e3a759'),
(6, 'hr', 'vpaas-magic-cookie-8efa606db35544ffbb2204dd6de734b8'),
(7, 'sales', 'vpaas-magic-cookie-3b30008fe7e94db995da5450e1319ebd'),
(8, 'academics', 'vpaas-magic-cookie-2bc81c75d9e84448b52fc4cfe7369c62'),
(9, 'pr', 'vpaas-magic-cookie-54b77ebe681f44a39fc88535f940933e'),
(10, 'finance', 'vpaas-magic-cookie-cb5de9454347490a93542a28720e7a6d'),
(11, 'content-writing', 'vpaas-magic-cookie-dca638b2f6e94b0caf3ab6c28fbebb77'),
(12, 'customer-support', 'vpaas-magic-cookie-5aec4271dc114aa09a60048ad9e3a759'),
(13, 'graphic-design', 'vpaas-magic-cookie-ce6f16fcdd7a4c0b832ede9b8b3a5b6f'),
(14, 'research-development', 'vpaas-magic-cookie-676d91e42add44879089b9f07228c991'),
(15, 'tech', 'vpaas-magic-cookie-dca638b2f6e94b0caf3ab6c28fbebb77'),
(16, 'class6', 'vpaas-magic-cookie-2bc81c75d9e84448b52fc4cfe7369c62'),
(17, 'class8', 'vpaas-magic-cookie-5aec4271dc114aa09a60048ad9e3a759'),
(18, 'class9', 'vpaas-magic-cookie-dca638b2f6e94b0caf3ab6c28fbebb77vpaas-magic-cookie-b1030da33a8e4c6d92760935e3ef2f00'),
(19, 'class10', 'vpaas-magic-cookie-2bc81c75d9e84448b52fc4cfe7369c62'),
(20, 'class11', 'vpaas-magic-cookie-c584c26e7e314ee09f9b46a2b86f2325vpaas-magic-cookie-b1030da33a8e4c6d92760935e3ef2f00'),
(21, 'class12', 'vpaas-magic-cookie-5aec4271dc114aa09a60048ad9e3a759'),
(22, 'da', 'vpaas-magic-cookie-54b77ebe681f44a39fc88535f940933e'),
(23, 'digital', 'vpaas-magic-cookie-4ed68df45b1141a8b09ba967fbbe4c10'),
(24, 'interview1', 'vpaas-magic-cookie-c4699be5f43140eea05f27adbe4b4a81'),
(25, 'interview2', 'vpaas-magic-cookie-4f2c1141452a4644895f294803b2cf7b'),
(26, 'interview3', 'vpaas-magic-cookie-f210099ca7604321ac44ce3d0a179d99'),
(27, 'interview4', 'vpaas-magic-cookie-05e88785ea6640f086476552f0805dd4'),
(28, 'projmgt', ''),
(29, 'cc', 'vpaas-magic-cookie-ce6f16fcdd7a4c0b832ede9b8b3a5b6f'),
(30, 'ca', 'vpaas-magic-cookie-ce6f16fcdd7a4c0b832ede9b8b3a5b6f'),
(31, 'intern-interaction', 'vpaas-magic-cookie-00d7bae8e3b14e2cb5ffbffd48e0a44a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meet`
--
ALTER TABLE `meet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meet`
--
ALTER TABLE `meet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
