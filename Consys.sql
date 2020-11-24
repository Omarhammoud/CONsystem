-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2020 at 03:58 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


--

--
-- Database: `consys`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `CommentID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `ContentID` int(11) NOT NULL,
  `CommentBody` varchar(25) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `condoadmin`
--

CREATE TABLE `condoadmin` (
  `MemberID` int(11) NOT NULL,
  `AppointeDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `condoadmin`
--

INSERT INTO `condoadmin` (`MemberID`, `AppointeDate`) VALUES
(1, '2020-11-10'),
(2, '2020-11-10');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `ContentID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `Title` varchar(25) NOT NULL,
  `ContentBody` varchar(25) NOT NULL,
  `Type` varchar(25) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `date`
--

CREATE TABLE `date` (
  `Day` int(11) NOT NULL,
  `Month` int(11) NOT NULL,
  `Year` int(11) NOT NULL,
  `ContentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `EmailID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `Subject` varchar(25) NOT NULL,
  `EmailBody` varchar(25) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event_poll`
--

CREATE TABLE `event_poll` (
  `ContentID` int(11) NOT NULL,
  `StartTime` date NOT NULL,
  `EndTime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `GroupID` int(11) NOT NULL,
  `GroupName` varchar(25) NOT NULL,
  `Date` date NOT NULL,
  `Owner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`GroupID`, `GroupName`, `Date`, `Owner`) VALUES
(4, 'Another Group', '2020-11-15', 1),
(6, 'Concordia', '2020-11-15', 5),
(7, 'INK', '2020-11-16', 2);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `ImageID` int(11) NOT NULL,
  `ContentID` int(11) NOT NULL,
  `ImageContent` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `manage_group`
--

CREATE TABLE `manage_group` (
  `MemberID` int(11) NOT NULL,
  `CondoAdminID` int(11) NOT NULL,
  `ActionDone` varchar(25) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `manage_user`
--

CREATE TABLE `manage_user` (
  `MemberID` int(11) NOT NULL,
  `CondoAdminID` int(11) NOT NULL,
  `ActionDone` varchar(25) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `MemberID` int(11) NOT NULL,
  `Password` varchar(25) NOT NULL,
  `Email` varchar(25) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Address` varchar(25) NOT NULL,
  `Status` varchar(25) NOT NULL,
  `Privilege` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`MemberID`, `Password`, `Email`, `Name`, `Address`, `Status`, `Privilege`) VALUES
(1, '123', 'admin@a.com', 'admin', 'address', 'owner', 'owner'),
(2, '123', 'admin@a.com', 'admin', 'address', 'owner', 'owner'),
(3, '1', 'a@a.com', 'a', '1', '1', '1'),
(5, '123', 'q@q.com', 'a', 'a', 'a', 'a'),
(8, 'pass', 'user@consystem.com', 'New User', '12 guy', 'active', 'administrator');

-- --------------------------------------------------------

--
-- Table structure for table `membervote`
--

CREATE TABLE `membervote` (
  `VoteID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Hour` int(11) NOT NULL,
  `Minute` int(11) NOT NULL,
  `Place` varchar(25) NOT NULL,
  `MemberID` int(25) NOT NULL,
  `ContentID` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `part_entourage`
--

CREATE TABLE `part_entourage` (
  `MemberID` int(11) NOT NULL,
  `EntourageID` int(11) NOT NULL,
  `Relationship_Type` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `part_of`
--

CREATE TABLE `part_of` (
  `MemberID` int(11) NOT NULL,
  `GroupID` int(11) NOT NULL,

  `Status` varchar(15) NOT NULL DEFAULT 'In progress',
  `RequestDate` date NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `part_of`
--

INSERT INTO `part_of` (`MemberID`, `GroupID`, `Status`, `RequestDate`) VALUES
(2, 6, 'In Progress', '2020-11-16'),
(2, 7, 'Accepted', '2020-11-16');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `MemberID` int(11) NOT NULL,
  `ContentID` int(11) NOT NULL,
  `Classification` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `place`
--

CREATE TABLE `place` (
  `Address` varchar(25) NOT NULL,
  `ContentID` int(11) NOT NULL,
  `PlaceName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `send_to`
--

CREATE TABLE `send_to` (
  `EmailID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

CREATE TABLE `time` (
  `Hour` int(11) NOT NULL,
  `Minutes` int(11) NOT NULL,
  `ContentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `MemberID` (`MemberID`),
  ADD KEY `ContentID` (`ContentID`);

--
-- Indexes for table `condoadmin`
--
ALTER TABLE `condoadmin`
  ADD PRIMARY KEY (`MemberID`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`ContentID`),
  ADD KEY `Memberid` (`MemberID`);

--
-- Indexes for table `date`
--
ALTER TABLE `date`
  ADD PRIMARY KEY (`Day`,`Month`,`Year`,`ContentID`),
  ADD KEY `Contentid` (`ContentID`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`

  ADD PRIMARY KEY (`EmailID`),
  ADD KEY `MemberID` (`MemberID`);


--
-- Indexes for table `event_poll`
--
ALTER TABLE `event_poll`
  ADD PRIMARY KEY (`ContentID`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`

  ADD PRIMARY KEY (`GroupID`),
  ADD KEY `Owner` (`Owner`);


--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`ImageID`),
  ADD KEY `Contentid` (`ContentID`);

--
-- Indexes for table `manage_group`
--
ALTER TABLE `manage_group`
  ADD PRIMARY KEY (`MemberID`,`CondoAdminID`),
  ADD KEY `manage_group_ibfk_2` (`CondoAdminID`);

--
-- Indexes for table `manage_user`
--
ALTER TABLE `manage_user`
  ADD PRIMARY KEY (`MemberID`,`CondoAdminID`),
  ADD KEY `CondoAdminID` (`CondoAdminID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`MemberID`);

--
-- Indexes for table `membervote`
--
ALTER TABLE `membervote`
  ADD PRIMARY KEY (`VoteID`),
  ADD KEY `Memberid` (`MemberID`),
  ADD KEY `Contentid` (`ContentID`);

--
-- Indexes for table `part_entourage`
--
ALTER TABLE `part_entourage`
  ADD PRIMARY KEY (`MemberID`,`EntourageID`),
  ADD KEY `EntourageID` (`EntourageID`);

--
-- Indexes for table `part_of`
--
ALTER TABLE `part_of`

  ADD PRIMARY KEY (`MemberID`),
  ADD KEY `GroupID` (`GroupID`);


--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`MemberID`,`ContentID`),
  ADD KEY `Contentid` (`ContentID`);

--
-- Indexes for table `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`Address`),
  ADD KEY `place_ibfk_1` (`ContentID`);

--
-- Indexes for table `send_to`
--
ALTER TABLE `send_to`
  ADD PRIMARY KEY (`EmailID`,`MemberID`),
  ADD KEY `MemberID` (`MemberID`);

--
-- Indexes for table `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`Hour`,`Minutes`,`ContentID`),
  ADD KEY `time_ibfk_1` (`ContentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `ContentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `EmailID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `GroupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `ImageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `MemberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `membervote`
--
ALTER TABLE `membervote`
  MODIFY `VoteID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`

--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`ContentID`) REFERENCES `content` (`ContentID`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`);

--
-- Constraints for table `condoadmin`
--
ALTER TABLE `condoadmin`
  ADD CONSTRAINT `condoadmin_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`);

--
-- Constraints for table `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `content_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`);

--
-- Constraints for table `date`
--
ALTER TABLE `date`
  ADD CONSTRAINT `date_ibfk_1` FOREIGN KEY (`ContentID`) REFERENCES `content` (`ContentID`);

--
-- Constraints for table `email`
--
ALTER TABLE `email`
  ADD CONSTRAINT `email_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`);

--
-- Constraints for table `event_poll`
--
ALTER TABLE `event_poll`
  ADD CONSTRAINT `event_poll_ibfk_1` FOREIGN KEY (`ContentID`) REFERENCES `content` (`ContentID`);

--
-- Constraints for table `group`
--
ALTER TABLE `group`
  ADD CONSTRAINT `group_ibfk_1` FOREIGN KEY (`Owner`) REFERENCES `member` (`MemberID`);


--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`ContentID`) REFERENCES `content` (`ContentID`);

--
-- Constraints for table `manage_group`
--
ALTER TABLE `manage_group`
  ADD CONSTRAINT `manage_group_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`),
  ADD CONSTRAINT `manage_group_ibfk_2` FOREIGN KEY (`CondoAdminID`) REFERENCES `condoadmin` (`MemberID`);

--
-- Constraints for table `manage_user`
--
ALTER TABLE `manage_user`

  ADD CONSTRAINT `manage_user_ibfk_1` FOREIGN KEY (`CondoAdminID`) REFERENCES `condoadmin` (`MemberID`),
  ADD CONSTRAINT `manage_user_ibfk_2` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`);


--
-- Constraints for table `membervote`
--
ALTER TABLE `membervote`

  ADD CONSTRAINT `membervote_ibfk_1` FOREIGN KEY (`ContentID`) REFERENCES `content` (`ContentID`),
  ADD CONSTRAINT `membervote_ibfk_2` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`);


--
-- Constraints for table `part_entourage`
--
ALTER TABLE `part_entourage`

  ADD CONSTRAINT `part_entourage_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`),
  ADD CONSTRAINT `part_entourage_ibfk_2` FOREIGN KEY (`EntourageID`) REFERENCES `member` (`MemberID`);

--
-- Constraints for table `part_of`
--
ALTER TABLE `part_of`

  ADD CONSTRAINT `part_of_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`),
  ADD CONSTRAINT `part_of_ibfk_2` FOREIGN KEY (`GroupID`) REFERENCES `group` (`GroupID`);


--
-- Constraints for table `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `permission_ibfk_1` FOREIGN KEY (`ContentID`) REFERENCES `content` (`ContentID`),
  ADD CONSTRAINT `permission_ibfk_2` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`);

--
-- Constraints for table `place`
--
ALTER TABLE `place`

  ADD CONSTRAINT `place_ibfk_1` FOREIGN KEY (`ContentID`) REFERENCES `content` (`ContentID`);


--
-- Constraints for table `send_to`
--
ALTER TABLE `send_to`
  ADD CONSTRAINT `send_to_ibfk_1` FOREIGN KEY (`EmailID`) REFERENCES `email` (`EmailID`),
  ADD CONSTRAINT `send_to_ibfk_2` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`);

--
-- Constraints for table `time`
--
ALTER TABLE `time`

  ADD CONSTRAINT `time_ibfk_1` FOREIGN KEY (`ContentID`) REFERENCES `content` (`ContentID`);

