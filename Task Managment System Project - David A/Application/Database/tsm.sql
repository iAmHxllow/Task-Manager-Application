-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2024 at 08:19 PM
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
-- Database: `tsm`
--

-- --------------------------------------------------------

--
-- Table structure for table `collabpage`
--

CREATE TABLE `collabpage` (
  `CollabPage_ID` int(11) NOT NULL,
  `Host` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collabpage`
--

INSERT INTO `collabpage` (`CollabPage_ID`, `Host`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invite`
--

CREATE TABLE `invite` (
  `Invite_ID` int(11) NOT NULL,
  `DestinationPage_ID` int(11) DEFAULT NULL,
  `Sender` int(11) DEFAULT NULL,
  `Recipient` enum('Email','Username') NOT NULL,
  `Sent` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invite`
--

INSERT INTO `invite` (`Invite_ID`, `DestinationPage_ID`, `Sender`, `Recipient`, `Sent`) VALUES
(1, 1, 1, 'Email', 1);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `Permission_ID` int(11) NOT NULL,
  `Setting` enum('View Only','Can Edit','Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`Permission_ID`, `Setting`) VALUES
(1, 'View Only'),
(2, 'Can Edit'),
(3, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tasklist`
--

CREATE TABLE `tasklist` (
  `TaskList_ID` int(11) NOT NULL,
  `Name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasklist`
--

INSERT INTO `tasklist` (`TaskList_ID`, `Name`) VALUES
(1, 'Personal To-Do List'),
(2, 'Work Project Tasks');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `Task_ID` int(11) NOT NULL,
  `AssignedTaskList` int(11) DEFAULT NULL,
  `Author` int(11) DEFAULT NULL,
  `Name` varchar(50) NOT NULL,
  `Due_Date` date NOT NULL,
  `Priority` enum('Urgent','Important','Low') NOT NULL,
  `Progress` enum('Not Started','In Progress','Completed') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`Task_ID`, `AssignedTaskList`, `Author`, `Name`, `Due_Date`, `Priority`, `Progress`) VALUES
(1, 1, 1, 'Finish Report', '2024-04-15', 'Urgent', 'Not Started'),
(2, 1, 1, 'Grocery Shopping', '2024-04-02', 'Important', 'In Progress'),
(3, 2, 2, 'Team Meeting', '2024-04-04', 'Urgent', 'Completed'),
(4, 2, 2, 'Develop new feature', '2024-04-20', 'Important', 'Not Started');

-- --------------------------------------------------------

--
-- Table structure for table `usercollaborationlink`
--

CREATE TABLE `usercollaborationlink` (
  `User_ID` int(11) DEFAULT NULL,
  `CollabPage_ID` int(11) DEFAULT NULL,
  `Permission_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usercollaborationlink`
--

INSERT INTO `usercollaborationlink` (`User_ID`, `CollabPage_ID`, `Permission_ID`) VALUES
(2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_ID` int(11) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Role` enum('Admin','Registered User','Non-Registered USER') NOT NULL,
  `Admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_ID`, `Email`, `Password`, `Username`, `Role`, `Admin`) VALUES
(1, 'Admin@gmail.com', 'secure_password', 'Admin_Username', 'Admin', 1),
(2, 'TestUser@gmail.com', 'another_password', 'User 1', 'Registered User', 0),
(3, 'guest@example.com', 'Pass', 'Guest', 'Registered User', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `collabpage`
--
ALTER TABLE `collabpage`
  ADD PRIMARY KEY (`CollabPage_ID`),
  ADD KEY `Host` (`Host`);

--
-- Indexes for table `invite`
--
ALTER TABLE `invite`
  ADD PRIMARY KEY (`Invite_ID`),
  ADD KEY `DestinationPage_ID` (`DestinationPage_ID`),
  ADD KEY `Sender` (`Sender`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`Permission_ID`);

--
-- Indexes for table `tasklist`
--
ALTER TABLE `tasklist`
  ADD PRIMARY KEY (`TaskList_ID`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`Task_ID`),
  ADD KEY `AssignedTaskList` (`AssignedTaskList`),
  ADD KEY `Author` (`Author`);

--
-- Indexes for table `usercollaborationlink`
--
ALTER TABLE `usercollaborationlink`
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `CollabPage_ID` (`CollabPage_ID`),
  ADD KEY `Permission_ID` (`Permission_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `collabpage`
--
ALTER TABLE `collabpage`
  ADD CONSTRAINT `collabpage_ibfk_1` FOREIGN KEY (`Host`) REFERENCES `users` (`User_ID`);

--
-- Constraints for table `invite`
--
ALTER TABLE `invite`
  ADD CONSTRAINT `invite_ibfk_1` FOREIGN KEY (`DestinationPage_ID`) REFERENCES `collabpage` (`CollabPage_ID`),
  ADD CONSTRAINT `invite_ibfk_2` FOREIGN KEY (`Sender`) REFERENCES `collabpage` (`Host`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`AssignedTaskList`) REFERENCES `tasklist` (`TaskList_ID`),
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`Author`) REFERENCES `users` (`User_ID`);

--
-- Constraints for table `usercollaborationlink`
--
ALTER TABLE `usercollaborationlink`
  ADD CONSTRAINT `usercollaborationlink_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`),
  ADD CONSTRAINT `usercollaborationlink_ibfk_2` FOREIGN KEY (`CollabPage_ID`) REFERENCES `collabpage` (`CollabPage_ID`),
  ADD CONSTRAINT `usercollaborationlink_ibfk_3` FOREIGN KEY (`Permission_ID`) REFERENCES `permissions` (`Permission_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
