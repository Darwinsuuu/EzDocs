-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2024 at 11:00 PM
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
-- Database: `ezdocsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `student_tbl`
--

CREATE TABLE `student_tbl` (
  `id` int(11) NOT NULL,
  `studentId` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `gradeLevel` varchar(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`id`, `studentId`, `firstname`, `middlename`, `lastname`, `suffix`, `gradeLevel`, `phoneNumber`, `emailAddress`, `password`) VALUES
(1, '482914', 'Darwin', 'Bulgado', 'Labiste', '', '9', '09278285895', 'personal.darwinlabiste@gmail.com', '$2y$10$l0kBLAVi99xUkyX.YuzISe4PVdLJ.kOqoeDm0SXesKB.esSQdBiRm'),
(2, '481912', 'john', '', 'doe', '', '8', '09278285892', 'johndoe@gmail.com', '$2y$10$mJ39AAYSSFQ3.vdniUtpA.rEuKvaPX4odSIWe36sPUdgxux8oUJYC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `studentId` (`studentId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
