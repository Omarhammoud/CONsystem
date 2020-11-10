-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8881
-- Generation Time: Nov 10, 2020 at 06:48 PM
-- Server version: 5.7.30
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `Consys`
--

-- --------------------------------------------------------

--
-- Table structure for table `Comment`
--

CREATE TABLE `Comment` (
  `CommentID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `ContentID` int(11) NOT NULL,
  `CommentBody` varchar(25) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `CondoAdmin`
--

CREATE TABLE `CondoAdmin` (
  `MemberID` int(11) NOT NULL,
  `AppointeDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `CondoAdmin`
--

INSERT INTO `CondoAdmin` (`MemberID`, `AppointeDate`) VALUES
(1, '2020-11-10'),
(2, '2020-11-10');

-- --------------------------------------------------------

--
-- Table structure for table `Content`
--

CREATE TABLE `Content` (
  `ContentID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `Title` varchar(25) NOT NULL,
  `ContentBody` varchar(25) NOT NULL,
  `Type` varchar(25) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Date`
--

CREATE TABLE `Date` (
  `Day` int(11) NOT NULL,
  `Month` int(11) NOT NULL,
  `Year` int(11) NOT NULL,
  `ContentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Email`
--

CREATE TABLE `Email` (
  `EmailID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `Subject` varchar(25) NOT NULL,
  `EmailBody` varchar(25) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Event_Poll`
--

CREATE TABLE `Event_Poll` (
  `ContentID` int(11) NOT NULL,
  `StartTime` date NOT NULL,
  `EndTime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Group`
--

CREATE TABLE `Group` (
  `GroupID` int(11) NOT NULL,
  `GroupName` varchar(25) NOT NULL,
  `Date` date NOT NULL,
  `Owner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Image`
--

CREATE TABLE `Image` (
  `ImageID` int(11) NOT NULL,
  `ContentID` int(11) NOT NULL,
  `ImageContent` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Manage_Group`
--

CREATE TABLE `Manage_Group` (
  `MemberID` int(11) NOT NULL,
  `CondoAdminID` int(11) NOT NULL,
  `ActionDone` varchar(25) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Manage_User`
--

CREATE TABLE `Manage_User` (
  `MemberID` int(11) NOT NULL,
  `CondoAdminID` int(11) NOT NULL,
  `ActionDone` varchar(25) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Member`
--

CREATE TABLE `Member` (
  `MemberID` int(11) NOT NULL,
  `Password` varchar(25) NOT NULL,
  `Email` varchar(25) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Address` varchar(25) NOT NULL,
  `Status` varchar(25) NOT NULL,
  `Privilege` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Member`
--

INSERT INTO `Member` (`MemberID`, `Password`, `Email`, `Name`, `Address`, `Status`, `Privilege`) VALUES
(1, '123', 'admin@a.com', 'admin', 'address', 'owner', 'owner'),
(2, '123', 'admin@a.com', 'admin', 'address', 'owner', 'owner'),
(3, '1', 'a@a.com', 'a', '1', '1', '1'),
(5, '123', 'q@q.com', 'a', 'a', 'a', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `MemberVote`
--

CREATE TABLE `MemberVote` (
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
-- Table structure for table `Part_Entourage`
--

CREATE TABLE `Part_Entourage` (
  `MemberID` int(11) NOT NULL,
  `EntourageID` int(11) NOT NULL,
  `Relationship_Type` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Part_Of`
--

CREATE TABLE `Part_Of` (
  `MemberID` int(11) NOT NULL,
  `GroupID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Permission`
--

CREATE TABLE `Permission` (
  `MemberID` int(11) NOT NULL,
  `ContentID` int(11) NOT NULL,
  `Classification` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Place`
--

CREATE TABLE `Place` (
  `Address` varchar(25) NOT NULL,
  `Contentid` int(11) NOT NULL,
  `PlaceName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Send_To`
--

CREATE TABLE `Send_To` (
  `EmailID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Time`
--

CREATE TABLE `Time` (
  `Hour` int(11) NOT NULL,
  `Minutes` int(11) NOT NULL,
  `ContentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Comment`
--
ALTER TABLE `Comment`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `MemberID` (`MemberID`),
  ADD KEY `ContentID` (`ContentID`);

--
-- Indexes for table `CondoAdmin`
--
ALTER TABLE `CondoAdmin`
  ADD PRIMARY KEY (`MemberID`);

--
-- Indexes for table `Content`
--
ALTER TABLE `Content`
  ADD PRIMARY KEY (`ContentID`),
  ADD KEY `Memberid` (`MemberID`);

--
-- Indexes for table `Date`
--
ALTER TABLE `Date`
  ADD PRIMARY KEY (`Day`,`Month`,`Year`,`ContentID`),
  ADD KEY `Contentid` (`ContentID`);

--
-- Indexes for table `Email`
--
ALTER TABLE `Email`
  ADD PRIMARY KEY (`EmailID`);

--
-- Indexes for table `Event_Poll`
--
ALTER TABLE `Event_Poll`
  ADD PRIMARY KEY (`ContentID`);

--
-- Indexes for table `Group`
--
ALTER TABLE `Group`
  ADD PRIMARY KEY (`GroupID`);

--
-- Indexes for table `Image`
--
ALTER TABLE `Image`
  ADD PRIMARY KEY (`ImageID`),
  ADD KEY `Contentid` (`ContentID`);

--
-- Indexes for table `Manage_Group`
--
ALTER TABLE `Manage_Group`
  ADD PRIMARY KEY (`MemberID`,`CondoAdminID`),
  ADD KEY `manage_group_ibfk_2` (`CondoAdminID`);

--
-- Indexes for table `Manage_User`
--
ALTER TABLE `Manage_User`
  ADD PRIMARY KEY (`MemberID`,`CondoAdminID`),
  ADD KEY `CondoAdminID` (`CondoAdminID`);

--
-- Indexes for table `Member`
--
ALTER TABLE `Member`
  ADD PRIMARY KEY (`MemberID`);

--
-- Indexes for table `MemberVote`
--
ALTER TABLE `MemberVote`
  ADD PRIMARY KEY (`VoteID`),
  ADD KEY `Memberid` (`MemberID`),
  ADD KEY `Contentid` (`ContentID`);

--
-- Indexes for table `Part_Entourage`
--
ALTER TABLE `Part_Entourage`
  ADD PRIMARY KEY (`MemberID`,`EntourageID`),
  ADD KEY `EntourageID` (`EntourageID`);

--
-- Indexes for table `Part_Of`
--
ALTER TABLE `Part_Of`
  ADD PRIMARY KEY (`MemberID`,`GroupID`),
  ADD KEY `Groupid` (`GroupID`);

--
-- Indexes for table `Permission`
--
ALTER TABLE `Permission`
  ADD PRIMARY KEY (`MemberID`,`ContentID`),
  ADD KEY `Contentid` (`ContentID`);

--
-- Indexes for table `Place`
--
ALTER TABLE `Place`
  ADD PRIMARY KEY (`Address`),
  ADD KEY `place_ibfk_1` (`Contentid`);

--
-- Indexes for table `Send_To`
--
ALTER TABLE `Send_To`
  ADD PRIMARY KEY (`EmailID`,`MemberID`),
  ADD KEY `MemberID` (`MemberID`);

--
-- Indexes for table `Time`
--
ALTER TABLE `Time`
  ADD PRIMARY KEY (`Hour`,`Minutes`,`ContentID`),
  ADD KEY `time_ibfk_1` (`ContentID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `Member` (`MemberID`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`ContentID`) REFERENCES `Content` (`ContentID`);

--
-- Constraints for table `CondoAdmin`
--
ALTER TABLE `CondoAdmin`
  ADD CONSTRAINT `condoadmin_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `Member` (`MemberID`);

--
-- Constraints for table `Content`
--
ALTER TABLE `Content`
  ADD CONSTRAINT `content_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `Member` (`MemberID`);

--
-- Constraints for table `Date`
--
ALTER TABLE `Date`
  ADD CONSTRAINT `date_ibfk_1` FOREIGN KEY (`ContentID`) REFERENCES `Content` (`ContentID`);

--
-- Constraints for table `Event_Poll`
--
ALTER TABLE `Event_Poll`
  ADD CONSTRAINT `event_poll_ibfk_1` FOREIGN KEY (`ContentID`) REFERENCES `Content` (`ContentID`);

--
-- Constraints for table `Image`
--
ALTER TABLE `Image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`ContentID`) REFERENCES `Content` (`ContentID`);

--
-- Constraints for table `Manage_Group`
--
ALTER TABLE `Manage_Group`
  ADD CONSTRAINT `manage_group_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `Member` (`MemberID`),
  ADD CONSTRAINT `manage_group_ibfk_2` FOREIGN KEY (`CondoAdminID`) REFERENCES `CondoAdmin` (`MemberID`);

--
-- Constraints for table `Manage_User`
--
ALTER TABLE `Manage_User`
  ADD CONSTRAINT `manage_user_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `Member` (`MemberID`),
  ADD CONSTRAINT `manage_user_ibfk_2` FOREIGN KEY (`CondoAdminID`) REFERENCES `CondoAdmin` (`MemberID`);

--
-- Constraints for table `MemberVote`
--
ALTER TABLE `MemberVote`
  ADD CONSTRAINT `membervote_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `Member` (`MemberID`),
  ADD CONSTRAINT `membervote_ibfk_2` FOREIGN KEY (`ContentID`) REFERENCES `Content` (`ContentID`);

--
-- Constraints for table `Part_Entourage`
--
ALTER TABLE `Part_Entourage`
  ADD CONSTRAINT `part_entourage_ibfk_1` FOREIGN KEY (`EntourageID`) REFERENCES `Member` (`MemberID`),
  ADD CONSTRAINT `part_entourage_ibfk_2` FOREIGN KEY (`MemberID`) REFERENCES `Member` (`MemberID`);

--
-- Constraints for table `Part_Of`
--
ALTER TABLE `Part_Of`
  ADD CONSTRAINT `part_of_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `Member` (`MemberID`),
  ADD CONSTRAINT `part_of_ibfk_2` FOREIGN KEY (`GroupID`) REFERENCES `Group` (`GroupID`);

--
-- Constraints for table `Permission`
--
ALTER TABLE `Permission`
  ADD CONSTRAINT `permission_ibfk_1` FOREIGN KEY (`ContentID`) REFERENCES `Content` (`ContentID`),
  ADD CONSTRAINT `permission_ibfk_2` FOREIGN KEY (`MemberID`) REFERENCES `Member` (`MemberID`);

--
-- Constraints for table `Place`
--
ALTER TABLE `Place`
  ADD CONSTRAINT `place_ibfk_1` FOREIGN KEY (`Contentid`) REFERENCES `Event_Poll` (`ContentID`);

--
-- Constraints for table `Send_To`
--
ALTER TABLE `Send_To`
  ADD CONSTRAINT `send_to_ibfk_1` FOREIGN KEY (`EmailID`) REFERENCES `Email` (`EmailID`),
  ADD CONSTRAINT `send_to_ibfk_2` FOREIGN KEY (`MemberID`) REFERENCES `Member` (`MemberID`);

--
-- Constraints for table `Time`
--
ALTER TABLE `Time`
  ADD CONSTRAINT `time_ibfk_1` FOREIGN KEY (`ContentID`) REFERENCES `Event_Poll` (`ContentID`);
