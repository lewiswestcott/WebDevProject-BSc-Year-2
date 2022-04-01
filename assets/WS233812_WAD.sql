-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 01, 2022 at 03:33 PM
-- Server version: 10.3.34-MariaDB-0+deb10u1
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `WS233812_WAD`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseID` int(12) NOT NULL,
  `courseName` varchar(32) NOT NULL,
  `courseLocation` varchar(32) NOT NULL,
  `CourseDesc` varchar(255) NOT NULL,
  `CourseExpiry` date NOT NULL,
  `MaxAttend` int(50) NOT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseID`, `courseName`, `courseLocation`, `CourseDesc`, `CourseExpiry`, `MaxAttend`, `TIMESTAMP`) VALUES
(2, 'Health & Safety Advanced', 'UCW Campus', 'fdghfgdhfgdhfg', '2022-03-25', 20, '2022-03-11 10:11:31'),
(13, 'Advanced Data Protection', 'Weston College SWS Campus', 'Learning about data protection for steering group staff memebers.', '2022-08-05', 15, '2022-03-29 20:13:56'),
(14, 'World Skills Web Competition Tra', 'Taunton', 'Learning about how to best prepare for the 2022 World Skills Web Competition', '2022-11-01', 5, '2022-03-29 20:14:53'),
(15, 'BTEC Induction', 'Knightstone Campus Weston Colleg', 'Introduction to the BTEC course', '2022-04-05', 45, '2022-03-29 20:18:47'),
(18, 'Reasoning with Jason Hill', 'UCW', 'It does what it says on the tin!', '2022-12-26', 2022, '2022-04-01 13:47:35');

-- --------------------------------------------------------

--
-- Table structure for table `courseLink`
--

CREATE TABLE `courseLink` (
  `linkID` int(11) NOT NULL,
  `courseID` int(12) NOT NULL,
  `userID` int(12) NOT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(12) NOT NULL,
  `email` varchar(64) NOT NULL,
  `firstName` varchar(64) NOT NULL,
  `lastName` varchar(64) NOT NULL,
  `JobRole` varchar(250) NOT NULL,
  `password` varchar(64) NOT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role` varchar(32) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `email`, `firstName`, `lastName`, `JobRole`, `password`, `TIMESTAMP`, `role`) VALUES
(2, 'ws233812@weston.ac.uk', 'Lewis', 'Westcott', 'Sudo Admin', '$2y$10$3XhLmZcuJlU5u4.OCwad2.zzKzzIeKhue7oIB.lroCWF7e82pllGK', '2022-04-01 10:36:45', 'Admin'),
(28, 'lilly@lilly.com', 'Lilly', 'Radford', 'Assistant', '$2y$10$MOC62N31CVbKLdcLe/47/OiASrub4OG.hSkhdFYBQsFw2xdrFLsRW', '2022-03-29 22:03:42', 'User'),
(29, 'lewis@lewis.com', 'Lewis', 'Westcott', 'Assistant', '$2y$10$utSX0tURmWT6hRaasKZgMOPA3cvPNF8BxgLl1dyG8Uet6g1GjJ5pO', '2022-03-29 22:04:08', 'User'),
(31, 'ryan@ryan.com', 'Ryan', 'White', 'Cleaner', '$2y$10$N8qDJ3r4zsw8pDQHXq1Ly.qsBEe6XXQj47ywP17nj4CrOQCGxBIde', '2022-04-01 10:58:57', 'User'),
(32, 'louelle100@gmail.com', 'Lewis', 'Lewis', 'Tester', '$2y$10$8tl0ci8/fsvQym74BcrCWOE7DBI2Lsb0bZ2nV3hnNjmmVCB6g5zDO', '2022-04-01 11:48:59', 'User'),
(33, 'jk@jackkimmins.com', 'Jack', 'Kimmins', 'Sgt', '$2y$10$5RiRMwk4FjeV3.gXKks12uRIZ6H8MV6g9ZvEqyMr0g4gun6p7NIbu', '2022-04-01 13:45:51', 'User'),
(34, 'userjack@jack.com', 'Jack', 'User', 'General Assistant', '$2y$10$hKcaE6DZ8q4Nuy/YGWLHSOvPMazHxm.rpXfFu282fRVtOmupGg3ay', '2022-04-01 13:44:38', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseID`);

--
-- Indexes for table `courseLink`
--
ALTER TABLE `courseLink`
  ADD PRIMARY KEY (`linkID`),
  ADD KEY `courseID` (`courseID`,`userID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `courseID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `courseLink`
--
ALTER TABLE `courseLink`
  MODIFY `linkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courseLink`
--
ALTER TABLE `courseLink`
  ADD CONSTRAINT `courseLink_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `courseLink_ibfk_2` FOREIGN KEY (`courseID`) REFERENCES `course` (`courseID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
