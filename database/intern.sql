-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2023 at 04:00 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `intern`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `hash_id` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `hash_id`) VALUES
(158, 'test2', 'MTU4'),
(159, 'test2', 'MTU5'),
(160, 'test1', 'MTYw'),
(164, 'test1', 'MTY0');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `userType` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `hashed_data` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `pwd`, `userType`, `email`, `description`, `token`, `hashed_data`) VALUES
(1, 'baoLe', 'Q1234', 'admin', 'lebao123@gmail.com', 'ok123', 'c9733c5c3f4e5bdce238e35ff3b3ce7122c86998e23b04ab095c9927959e125b', NULL),
(336, 'test15', 'Q1234', 'user', 'bao15@gmail.com', '', '320baa298c96625ff0a1900c816ce8678e07091c63cd14e536570159dde3e4da', NULL),
(337, 'test16', 'Q1234', 'user', 'bao16@gmail.com', '', 'cc3412ad3c8cce0f0551e00538b81cae3870adcae23d7c06cbfadeb70de385fa', NULL),
(338, 'test17', 'Q1234', 'user', 'bao17@gmail.com', '', 'd09f989d50a7efa147e96f54070e94707555b8c1faec821964a3fe854b88b654', NULL),
(339, 'test18', 'Q1234', 'user', 'bao18@gmail.com', '', 'abedc720b5d8aa0fa79939a37fb97483b53a883ea9c1f1adfafcc615a35e03c9', NULL),
(340, 'test19', 'Q1234', 'user', 'bao19@gmail.com', '', 'f8d909051eede224cac7add4f772831d2d52c50d1675490c57faa334447731b8', NULL),
(342, 'fake', 'Q1234', 'admin', 'fake@gmail.com', '', '6556f55207a74d393f55a81f3940c646e2d65e60830f8e6e3e300d604ea54e8e', NULL),
(456, 'bao456', 'Q12345', 'admin', 'bao456@gmail.com', '', '6075290a62bfbed293cb09fa067713bf0d233b56d3f9aade22ee0ea1df677f12', NULL),
(457, 'bao_anh', 'Q1234', 'admin', 'anhbao.lampart@gmail.com', '<img src=\"http://php.local/deleteUser.php?id=NDYw&token=077734c4da7628527a26616649e67b6fa87abbcd6905a50427d674d8907cadae\">', '04600fc9a4b16ae1e1401bf6c5e2b73b63dbdce705a1eb305fee2cbe5c60aa2f', NULL),
(460, 'test123', 'Q1234', 'admin', 'bao1@gmail.com', '', '25f3f011026689315f1343cb63999f174a06040f6f57e64d425033c4120a19f0', NULL),
(473, 'test', 'testA', 'admin', 'test@gmail.com', '', NULL, NULL),
(474, 'bao', 'testA', 'admin', 'bao@gmail.com', '', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=475;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
