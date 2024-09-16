-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2024 at 08:32 AM
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
-- Table structure for table `ezdrequesttbl`
--

CREATE TABLE `ezdrequesttbl` (
  `id` int(11) NOT NULL,
  `studentID` int(20) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `gradelvl` varchar(10) NOT NULL,
  `reqDoc` varchar(50) NOT NULL,
  `reqDate` date NOT NULL,
  `status` enum('pending','processing','ready','claimed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ezdrequesttbl`
--

INSERT INTO `ezdrequesttbl` (`id`, `studentID`, `fullName`, `gradelvl`, `reqDoc`, `reqDate`, `status`) VALUES
(1, 555666444, 'John Dela Cruz Doe Sr.', 'gd12', 'Diploma', '2024-09-01', 'ready'),
(2, 345345, 'Jamesrold Damaso Baliscao ', 'gd12', 'Certificate of Enrollment', '2024-09-01', 'claimed'),
(3, 637, 'lorraine yung system ', 'gd8', 'coe', '2024-09-05', 'pending'),
(4, 637, 'lorraine yung system ', 'gd7', '', '2024-09-05', 'pending'),
(5, 637, 'lorraine yung system ', 'Grade 11', 'Certificate of Good Moral', '2024-09-05', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `requesthistory`
--

CREATE TABLE `requesthistory` (
  `id` int(11) NOT NULL,
  `reqID` int(11) NOT NULL,
  `reqHistoryDesc` text NOT NULL,
  `dateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(5, '345345', 'Jamesrold', 'Damaso', 'Baliscao', '', '12', '09887776666', 'jamesrold@gmail.com', '$2y$10$yNIzF5rOwA1LrgzYzhz1QePMDm09w7/8Znr0aEs41kr6sYc2sCLsG'),
(7, '555666444', 'John', 'Dela Cruz', 'Doe', 'Sr.', '12', '09554443333', 'johndoe@gmail.com', '$2y$10$tRd9oQ185Vg9gVy0ZyW0S.BUsEvoYLskb5.rSQsLOhRKFJwkDHCoe'),
(8, '00637', 'lorraine', 'yung', 'system', '', '12', '09292163485', 'lorraineyungsystem@gmail.com', '$2y$10$/ql5vNr951VlpJVIR0hqLOBrUaBDvkKSwieCETgjFaIkuimcKFVTa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ezdadmintbl`
--
ALTER TABLE `ezdadmintbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ezdrequesttbl`
--
ALTER TABLE `ezdrequesttbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requesthistory`
--
ALTER TABLE `requesthistory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reqID` (`reqID`);

--
-- Indexes for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `studentId` (`studentId`),
  ADD UNIQUE KEY `emailAddress` (`emailAddress`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ezdadmintbl`
--
ALTER TABLE `ezdadmintbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ezdrequesttbl`
--
ALTER TABLE `ezdrequesttbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `requesthistory`
--
ALTER TABLE `requesthistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
