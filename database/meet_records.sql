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
-- Table structure for table `meet_records`
--

CREATE TABLE `meet_records` (
  `id` int(20) NOT NULL,
  `appId` varchar(255) NOT NULL,
  `record` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`record`)),
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meet_records`
--

INSERT INTO `meet_records` (`id`, `appId`, `record`, `date`) VALUES
(1, 'vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe', '{\n    \"eventType\": \"USAGE\",\n    \"sessionId\": \"807177b9-edcb-4680-8b64-49c078557aaa\",\n    \"timestamp\": 1742390078425,\n    \"fqn\": \"vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe/hr\",\n    \"idempotencyKey\": \"65640e7d-2f59-4187-9108-b960f8644a2b\",\n    \"customerId\": \"29fc818fdf9f401bae6d13cf0216cdfe\",\n    \"appId\": \"vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe\",\n    \"data\": [\n        {\n            \"isBreakout\": false,\n            \"participantId\": \"38183446\",\n            \"userId\": \"255185757ee44716beb6839255641ba2\",\n            \"email\": \"\",\n            \"kid\": \"vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe/d1fd8f-PUBLIC_ACCESS\",\n            \"deviceId\": \"692ecefdcbff5f8045e07fce608251dd\",\n            \"customerId\": \"29fc818fdf9f401bae6d13cf0216cdfe\"\n        },\n        {\n            \"isBreakout\": false,\n            \"participantId\": \"e1c08610\",\n            \"userId\": 1741874536208,\n            \"email\": \"\",\n            \"kid\": \"vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe/987745\",\n            \"deviceId\": \"94e7dc49cc5198c4465bde3dcb511482\",\n            \"customerId\": \"29fc818fdf9f401bae6d13cf0216cdfe\"\n        }\n    ]\n}', '2025-03-19 13:14:44'),
(2, 'vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe', '{\n    \"eventType\": \"USAGE\",\n    \"sessionId\": \"807177b9-edcb-4680-8b64-49c078557aaa\",\n    \"timestamp\": 1742390960417,\n    \"fqn\": \"vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe/hr\",\n    \"idempotencyKey\": \"489893e7-5f86-45c3-a327-c5b88a93c944\",\n    \"customerId\": \"29fc818fdf9f401bae6d13cf0216cdfe\",\n    \"appId\": \"vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe\",\n    \"data\": [\n        {\n            \"isBreakout\": false,\n            \"participantId\": \"38183446\",\n            \"userId\": \"255185757ee44716beb6839255641ba2\",\n            \"email\": \"\",\n            \"kid\": \"vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe/d1fd8f-PUBLIC_ACCESS\",\n            \"deviceId\": \"692ecefdcbff5f8045e07fce608251dd\",\n            \"customerId\": \"29fc818fdf9f401bae6d13cf0216cdfe\"\n        },\n        {\n            \"isBreakout\": false,\n            \"participantId\": \"8c1cc9ca\",\n            \"userId\": \"34ecddfead784cceaa5962c23737ae76\",\n            \"email\": \"\",\n            \"kid\": \"vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe/d1fd8f-PUBLIC_ACCESS\",\n            \"deviceId\": \"23056720a062625190034c26dad1c1d5\",\n            \"customerId\": \"29fc818fdf9f401bae6d13cf0216cdfe\"\n        }\n    ]\n}', '2025-03-19 13:29:26'),
(3, 'vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe', '{\n    \"eventType\": \"USAGE\",\n    \"sessionId\": \"807177b9-edcb-4680-8b64-49c078557aaa\",\n    \"timestamp\": 1742390970924,\n    \"fqn\": \"vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe/hr\",\n    \"idempotencyKey\": \"d3a290e2-b20d-47b6-bb58-01fbb4a70e5b\",\n    \"customerId\": \"29fc818fdf9f401bae6d13cf0216cdfe\",\n    \"appId\": \"vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe\",\n    \"data\": [\n        {\n            \"isBreakout\": false,\n            \"participantId\": \"36e45d0d\",\n            \"userId\": \"34ecddfead784cceaa5962c23737ae76\",\n            \"email\": \"\",\n            \"kid\": \"vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe/d1fd8f-PUBLIC_ACCESS\",\n            \"deviceId\": \"23056720a062625190034c26dad1c1d5\",\n            \"customerId\": \"29fc818fdf9f401bae6d13cf0216cdfe\"\n        }\n    ]\n}', '2025-03-19 13:29:35'),
(4, 'vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe', '{\n    \"eventType\": \"USAGE\",\n    \"sessionId\": \"807177b9-edcb-4680-8b64-49c078557aaa\",\n    \"timestamp\": 1742392159575,\n    \"fqn\": \"vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe/hr\",\n    \"idempotencyKey\": \"bdd6949c-100b-435a-af1a-f73c5db3437b\",\n    \"customerId\": \"29fc818fdf9f401bae6d13cf0216cdfe\",\n    \"appId\": \"vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe\",\n    \"data\": [\n        {\n            \"isBreakout\": false,\n            \"participantId\": \"f61066c4\",\n            \"userId\": \"978ee270cc9247498ade73aafc94bfe5\",\n            \"email\": \"\",\n            \"kid\": \"vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe/d1fd8f-PUBLIC_ACCESS\",\n            \"deviceId\": \"621d8f7b832623f92f0d119c78ebbfa9\",\n            \"customerId\": \"29fc818fdf9f401bae6d13cf0216cdfe\"\n        }\n    ]\n}', '2025-03-19 13:49:25'),
(5, 'vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe', '{\n    \"eventType\": \"USAGE\",\n    \"sessionId\": \"807177b9-edcb-4680-8b64-49c078557aaa\",\n    \"timestamp\": 1742392343019,\n    \"fqn\": \"vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe/hr\",\n    \"idempotencyKey\": \"16127231-f604-494b-8362-b5d4d483be5d\",\n    \"customerId\": \"29fc818fdf9f401bae6d13cf0216cdfe\",\n    \"appId\": \"vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe\",\n    \"data\": [\n        {\n            \"isBreakout\": false,\n            \"participantId\": \"94f65ee8\",\n            \"userId\": \"181183ced8ea4641b58db05fe24166bd\",\n            \"email\": \"\",\n            \"kid\": \"vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe/d1fd8f-PUBLIC_ACCESS\",\n            \"deviceId\": \"621d8f7b832623f92f0d119c78ebbfa9\",\n            \"customerId\": \"29fc818fdf9f401bae6d13cf0216cdfe\"\n        }\n    ]\n}', '2025-03-19 13:52:28'),
(6, 'vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe', '{\n    \"eventType\": \"USAGE\",\n    \"sessionId\": \"807177b9-edcb-4680-8b64-49c078557aaa\",\n    \"timestamp\": 1742392358220,\n    \"fqn\": \"vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe/hr\",\n    \"idempotencyKey\": \"aeb70452-ad30-45e5-8f4d-274907e2d1bf\",\n    \"customerId\": \"29fc818fdf9f401bae6d13cf0216cdfe\",\n    \"appId\": \"vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe\",\n    \"data\": [\n        {\n            \"isBreakout\": false,\n            \"participantId\": \"05af8991\",\n            \"userId\": \"181183ced8ea4641b58db05fe24166bd\",\n            \"email\": \"\",\n            \"kid\": \"vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe/d1fd8f-PUBLIC_ACCESS\",\n            \"deviceId\": \"621d8f7b832623f92f0d119c78ebbfa9\",\n            \"customerId\": \"29fc818fdf9f401bae6d13cf0216cdfe\"\n        }\n    ]\n}', '2025-03-19 13:52:43'),
(7, 'vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe', '{\n    \"eventType\": \"USAGE\",\n    \"sessionId\": \"807177b9-edcb-4680-8b64-49c078557aaa\",\n    \"timestamp\": 1742392441260,\n    \"fqn\": \"vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe/hr\",\n    \"idempotencyKey\": \"958ec650-3afc-4228-a1d7-e310f4f46423\",\n    \"customerId\": \"29fc818fdf9f401bae6d13cf0216cdfe\",\n    \"appId\": \"vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe\",\n    \"data\": [\n        {\n            \"isBreakout\": false,\n            \"participantId\": \"64830ace\",\n            \"userId\": \"9d8a15f1a6a94c239ab27b65bbfd5e14\",\n            \"email\": \"\",\n            \"kid\": \"vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe/d1fd8f-PUBLIC_ACCESS\",\n            \"deviceId\": \"621d8f7b832623f92f0d119c78ebbfa9\",\n            \"customerId\": \"29fc818fdf9f401bae6d13cf0216cdfe\"\n        }\n    ]\n}', '2025-03-19 13:54:06'),
(8, 'vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe', '{\n    \"eventType\": \"USAGE\",\n    \"sessionId\": \"807177b9-edcb-4680-8b64-49c078557aaa\",\n    \"timestamp\": 1742392444678,\n    \"fqn\": \"vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe/hr\",\n    \"idempotencyKey\": \"c8cf9ae0-3666-4c80-8de2-d4eb1d906c9b\",\n    \"customerId\": \"29fc818fdf9f401bae6d13cf0216cdfe\",\n    \"appId\": \"vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe\",\n    \"data\": [\n        {\n            \"isBreakout\": false,\n            \"participantId\": \"7e7e620f\",\n            \"userId\": \"9d8a15f1a6a94c239ab27b65bbfd5e14\",\n            \"email\": \"\",\n            \"kid\": \"vpaas-magic-cookie-29fc818fdf9f401bae6d13cf0216cdfe/d1fd8f-PUBLIC_ACCESS\",\n            \"deviceId\": \"621d8f7b832623f92f0d119c78ebbfa9\",\n            \"customerId\": \"29fc818fdf9f401bae6d13cf0216cdfe\"\n        }\n    ]\n}', '2025-03-19 13:54:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meet_records`
--
ALTER TABLE `meet_records`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meet_records`
--
ALTER TABLE `meet_records`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
