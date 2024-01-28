-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2024 at 02:49 PM
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
-- Database: `teamtwoone-final`
--

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `documentID` int(11) NOT NULL,
  `documentName` varchar(200) NOT NULL,
  `documentFile` varchar(1000) NOT NULL,
  `documentStatus` varchar(50) NOT NULL,
  `userid` int(7) NOT NULL,
  `officeid` int(7) NOT NULL,
  `comment` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`documentID`, `documentName`, `documentFile`, `documentStatus`, `userid`, `officeid`, `comment`) VALUES
(36, 'Requester Upload', '1702405407053-plants.docx', 'pending', 3, 5, ''),
(35, 'Requester 1 Upload', '1702405365986-junk food is typically characterized by its low nutritional value.docx', 'pending', 4, 3, ''),
(37, 'plants', '1702873483696-plants.docx', 'pending', 3, 3, ''),
(38, 'about plant', '1702874302733-plants.docx', 'pending', 3, 3, ''),
(39, 'sample', '1703045681428-junk food is typically characterized by its low nutritional value.docx', 'pending', 37, 2, 'backgroud of study '),
(40, '', '1703012589414-junk food is typically characterized by its low nutritional value.docx', 'approved', 37, 5, 'good job'),
(41, 'sam', '1703012923754-junk food is typically characterized by its low nutritional value.docx', 'approved', 37, 5, ''),
(42, 'sam', '1703012923755-plants.docx', 'pending', 37, 1, ''),
(43, '', '', '', 0, 0, ''),
(44, '', '', '', 0, 0, ''),
(45, 'sample2', '1703045733143-junk food is typically characterized by its low nutritional value.docx', 'pending', 37, 4, 'bla bla'),
(46, 'DRt', '1703047522703-plants.docx', 'pending', 37, 2, ''),
(47, 'test1', '1703086822065-1702312924374-plants (1).docx', 'pending', 2, 5, ''),
(48, 'test2', '1703087245673-1702303695904-plants.docx', 'pending', 2, 1, ''),
(49, 'sample', '1703087803576-plants.docx', 'approved', 2, 5, ''),
(50, 'sample2', '1703088723121-junk food is typically characterized by its low nutritional value.docx', 'approved', 2, 5, 'goodjob'),
(51, 'test4', '1705425185988-junk food is typically characterized by its low nutritional value.docx', 'pending', 2, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `event` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`data`)),
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `event`, `timestamp`, `data`, `uid`) VALUES
(1, 'created new user', '2023-12-20 14:51:03', '{\"username\":\"requester2\",\"first_name\":\"Boy\",\"last_name\":\"Wonder\",\"userType\":\"Requester\",\"officeID\":6}', 36),
(2, 'uploaded a document', '2023-12-20 15:52:09', '{\"filename\":\"1703087529808-plants.docx\",\"title\":\"sample\"}', 2),
(3, 'made changes to a document', '2023-12-20 15:53:36', '{\"status\":\"approved\",\"comment\":\"\",\"documentid\":\"49\"}', 4),
(4, 'made changes to a document', '2023-12-20 15:54:20', '{\"status\":\"approved\",\"comment\":\"\",\"documentid\":\"49\"}', 5),
(5, 'made changes to a document', '2023-12-20 15:54:47', '{\"status\":\"approved\",\"comment\":\"\",\"documentid\":\"49\"}', 3),
(6, 'made changes to a document', '2023-12-20 15:55:37', '{\"status\":\"return\",\"comment\":\"need more information in chapter 3\",\"documentid\":\"49\"}', 6),
(7, 'reuploaded a document', '2023-12-20 15:56:43', '{\"filename\":\"1703087803576-plants.docx\"}', 2),
(8, 'made changes to a document', '2023-12-20 15:57:53', '{\"status\":\"approved\",\"comment\":\"\",\"documentid\":\"49\"}', 6),
(9, 'made changes to a document', '2023-12-20 15:58:36', '{\"status\":\"approved\",\"comment\":\"\",\"documentid\":\"49\"}', 7),
(10, 'made changes to a document', '2023-12-20 16:08:58', '{\"status\":\"approved\",\"comment\":\"\",\"documentid\":\"50\"}', 4),
(11, 'made changes to a document', '2023-12-20 16:09:38', '{\"status\":\"approved\",\"comment\":\"\",\"documentid\":\"50\"}', 5),
(12, 'made changes to a document', '2023-12-20 16:09:59', '{\"status\":\"approved\",\"comment\":\"\",\"documentid\":\"50\"}', 3),
(13, 'made changes to a document', '2023-12-20 16:10:52', '{\"status\":\"return\",\"comment\":\"more information in chapter 3\",\"documentid\":\"50\"}', 6),
(14, 'made changes to a document', '2023-12-20 16:11:01', '{\"status\":\"return\",\"comment\":\"\",\"documentid\":\"50\"}', 6),
(15, 'made changes to a document', '2023-12-20 16:11:27', '{\"status\":\"return\",\"comment\":\"more information in chapter 3\",\"documentid\":\"50\"}', 6),
(16, 'reuploaded a document', '2023-12-20 16:12:03', '{\"filename\":\"1703088723121-junk food is typically characterized by its low nutritional value.docx\"}', 2),
(17, 'made changes to a document', '2023-12-20 16:12:49', '{\"status\":\"approved\",\"comment\":\"\",\"documentid\":\"50\"}', 6),
(18, 'made changes to a document', '2023-12-20 16:13:22', '{\"status\":\"approved\",\"comment\":\"goodjob\",\"documentid\":\"50\"}', 7),
(19, 'created new user', '2023-12-20 16:24:13', '{\"username\":\"wonder\",\"first_name\":\"bogart\",\"last_name\":\"wonder\",\"userType\":\"Requester\",\"officeID\":6}', 1),
(20, 'Deleted user account', '2023-12-20 16:24:36', '{\"user_ID\":\"40\"}', 1),
(21, 'created new user', '2023-12-20 16:30:29', '{\"username\":\"wonder\",\"first_name\":\"bogart\",\"last_name\":\"wonderer\",\"userType\":\"Administrator\",\"officeID\":6}', 1),
(22, 'Modified user account', '2023-12-20 16:31:20', '{\"user_ID\":\"41\",\"username\":\"wonder\",\"password\":\"12345\",\"firstName\":\"Bhogart\",\"lastName\":\"wonderer\",\"officeID\":\"6\",\"userType\":\"Requester\"}', 1),
(23, 'Deleted user account', '2023-12-20 16:31:32', '{\"user_ID\":\"41\"}', 1),
(24, 'uploaded a document', '2024-01-16 17:13:05', '{\"filename\":\"1705425185988-junk food is typically characterized by its low nutritional value.docx\",\"title\":\"test4\"}', 2);

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `officeID` int(11) NOT NULL,
  `officeName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`officeID`, `officeName`) VALUES
(1, 'OGRAA'),
(2, 'OVP for Academic Affairs'),
(3, 'OVP for Finance'),
(4, 'Office for Legal Affair'),
(5, 'OVP for Administration'),
(6, 'UNIT');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `reviewID` int(11) NOT NULL,
  `reviewComment` varchar(50) NOT NULL,
  `reviewContent` varchar(50) NOT NULL,
  `reviewDate` date NOT NULL,
  `documentID` int(11) NOT NULL,
  `roleID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`reviewID`, `reviewComment`, `reviewContent`, `reviewDate`, `documentID`, `roleID`) VALUES
(1, 'System architecture diagram missing', 'DocumentTracking', '2023-12-03', 0, 0),
(2, 'System architecture diagram missing', 'DocumentTracking', '2023-12-03', 0, 1),
(3, 'methodology ', 'POS', '2023-12-01', 0, 2),
(4, 'background of study ', 'DFA', '2023-12-04', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_ID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `userType` varchar(20) NOT NULL,
  `officeID` int(7) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_ID`, `username`, `password`, `firstName`, `lastName`, `userType`, `officeID`) VALUES
(1, 'admin', 'admin', 'Bruce', 'Wayne', 'Admin', 6),
(2, 'requester', 'requester', 'Borgaduis', 'Bogart', 'Requester', 6),
(3, 'finance', 'finance', 'Tony', 'Stark', 'Reviewer', 3),
(4, 'ograa', 'ograa', 'The', 'Hulk', 'Reviewer', 1),
(5, 'acadsaffair', '12345', 'Black', 'Window', 'Reviewer', 2),
(6, 'legalaffair', 'legalaffair', 'Super', 'Man', 'Reviewer', 4),
(7, 'administration', 'administration', 'Purple', 'Barney', 'Reviewer', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`documentID`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`officeID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`reviewID`),
  ADD KEY `documentID` (`documentID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`),
  ADD KEY `officeID` (`officeID`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `documentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `officeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `reviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
