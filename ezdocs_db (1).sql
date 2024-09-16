-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2024 at 08:57 AM
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
-- Database: `ezdocs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ezdadmintbl`
--

CREATE TABLE `ezdadmintbl` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ezdadmintbl`
--

INSERT INTO `ezdadmintbl` (`id`, `name`, `email`, `password`, `type`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$yNIzF5rOwA1LrgzYzhz1QePMDm09w7/8Znr0aEs41kr6sYc2sCLsG', 'principal');

-- --------------------------------------------------------

--
-- Table structure for table `requesthistory`
--

CREATE TABLE `requesthistory` (
  `id` int(11) NOT NULL,
  `studentID` int(12) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `reqDoc` varchar(50) NOT NULL,
  `claimDate` date NOT NULL,
  `status` enum('pending','processing','ready','claimed') NOT NULL DEFAULT 'claimed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_tbl`
--

CREATE TABLE `request_tbl` (
  `id` int(11) NOT NULL,
  `studentID` varchar(12) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `reqDoc` varchar(50) NOT NULL,
  `reqDate` varchar(50) NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','processing','ready','claimed') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `gradelvl` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_tbl`
--

INSERT INTO `request_tbl` (`id`, `studentID`, `fullname`, `reqDoc`, `reqDate`, `status`, `gradelvl`) VALUES
(1, '00637', 'lorraine yung system ', 'coe', '2024-09-01', 'claimed', 'gd7'),
(2, '00597', 'rhia yung flowchart sige', 'goodMoral', '2024-09-01', 'processing', 'gd9'),
(3, '00637', 'lorraine yung system ', 'coe', '2024-09-02', 'claimed', 'gd11'),
(4, '00637', 'lorraine yung system ', 'coe', '2024-09-02', 'processing', 'gd7');

-- --------------------------------------------------------

--
-- Table structure for table `student_tbl`
--

CREATE TABLE `student_tbl` (
  `id` int(11) NOT NULL,
  `studentID` varchar(12) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(15) NOT NULL,
  `lastname` varchar(15) NOT NULL,
  `suffix` varchar(5) NOT NULL,
  `gradeLevel` varchar(2) NOT NULL,
  `phoneNumber` int(11) NOT NULL,
  `emailAddress` varchar(50) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`id`, `studentID`, `firstname`, `middlename`, `lastname`, `suffix`, `gradeLevel`, `phoneNumber`, `emailAddress`, `password`) VALUES
(1, '482914', 'Darwin', 'Bulgado', 'Labiste', '', '9', 2147483647, 'personal.darwinlabiste@gmail.com', '$2y$10$l0kBLAVi99xUkyX.YuzISe4PVdLJ.kOqoeDm0SXesKB.esSQdBiRm'),
(2, '481912', 'john', '', 'doe', '', '8', 2147483647, 'johndoe@gmail.com', '$2y$10$mJ39AAYSSFQ3.vdniUtpA.rEuKvaPX4odSIWe36sPUdgxux8oUJYC'),
(3, '00637', 'lorraine', 'yung', 'system', '', '9', 929216348, 'lorraineyungsystem@gmail.com', '$2y$10$4pV7Wb.6xg81DDdADO4iPutegYQPn0cfma/Cv2LvnbNtkNHr9X.p6'),
(4, '00597', 'rhia', 'yung', 'flowchart', 'sige', '12', 951875694, 'rhiayungflowchart@gmail.com', '$2y$10$DvJVqQ6dEJz9h/Ch8tzTFeeQ4aqzLDM9zf5nbdDCUrdSBQhCLICma');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ezdadmintbl`
--
ALTER TABLE `ezdadmintbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requesthistory`
--
ALTER TABLE `requesthistory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reqID` (`studentID`);

--
-- Indexes for table `request_tbl`
--
ALTER TABLE `request_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `studentId` (`studentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ezdadmintbl`
--
ALTER TABLE `ezdadmintbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `requesthistory`
--
ALTER TABLE `requesthistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_tbl`
--
ALTER TABLE `request_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
