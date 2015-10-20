-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 19, 2015 at 03:00 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `oztinate`
--
CREATE DATABASE IF NOT EXISTS `oztinate` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `oztinate`;

-- --------------------------------------------------------

--
-- Table structure for table `assignedtask`
--

CREATE TABLE IF NOT EXISTS `assignedtask` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `taskId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createdUserId` int(11) NOT NULL,
  `assignedDate` date NOT NULL,
  `completionDate` date NOT NULL DEFAULT '0000-00-00',
  `isCreatedByUser` char(1) NOT NULL,
  `isNew` int(11) NOT NULL DEFAULT '1',
  `updatedId` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Id`),
  KEY `Id` (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `assignedtask`
--

INSERT INTO `assignedtask` (`Id`, `taskId`, `userId`, `status`, `createdUserId`, `assignedDate`, `completionDate`, `isCreatedByUser`, `isNew`, `updatedId`, `createdDate`) VALUES
(1, 1, 1, 0, 1, '2015-06-17', '2015-06-15', 'Y', 0, '2015-06-09 16:29:00', '2015-06-09 16:29:00'),
(2, 1, 1, 0, 1, '2015-06-17', '2015-06-15', 'Y', 0, '2015-06-09 16:29:00', '2015-06-09 16:29:00'),
(3, 1, 1, 0, 3, '2015-06-17', '0000-00-00', 'Y', 0, '2015-06-17 13:08:12', '2015-06-17 13:08:12'),
(4, 1, 1, 0, 3, '2015-06-17', '2015-06-18', 'Y', 0, '2015-06-17 13:15:00', '2015-06-17 13:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `commentId` int(11) NOT NULL AUTO_INCREMENT,
  `assignedTaskId` int(11) NOT NULL,
  `commentUser` int(11) NOT NULL,
  `commentText` text NOT NULL,
  `updatedId` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createdDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`commentId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentId`, `assignedTaskId`, `commentUser`, `commentText`, `updatedId`, `createdDate`) VALUES
(1, 1, 3, 'Sample comment1', '2015-06-19 11:38:04', '2015-06-19 14:42:01'),
(2, 1, 3, 'Sample comment2', '2015-06-19 11:38:06', '2015-06-19 14:42:01');

-- --------------------------------------------------------

--
-- Table structure for table `soundclip`
--

CREATE TABLE IF NOT EXISTS `soundclip` (
  `clipId` int(11) NOT NULL AUTO_INCREMENT,
  `assignedTaskId` int(11) NOT NULL,
  `clipName` varchar(45) NOT NULL,
  `clipUrl` varchar(100) NOT NULL,
  `updateId` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`clipId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `soundclip`
--

INSERT INTO `soundclip` (`clipId`, `assignedTaskId`, `clipName`, `clipUrl`, `updateId`, `createdDate`) VALUES
(1, 1, 'Sample clip1', 'https://samplesoudclip1', '2015-06-19 14:42:55', '2015-06-09 16:32:29'),
(2, 1, 'Sample clip2', 'https://samplesoudclip2', '2015-06-19 14:42:55', '2015-06-09 16:32:29');

-- --------------------------------------------------------

--
-- Table structure for table `tablature`
--

CREATE TABLE IF NOT EXISTS `tablature` (
  `tabId` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `tabUrl` varchar(100) NOT NULL,
  `updatedId` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`tabId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tablature`
--

INSERT INTO `tablature` (`tabId`, `name`, `tabUrl`, `updatedId`, `createdDate`, `updatedDate`) VALUES
(1, 'Sample Tablature1', 'https://sampleurl1', '0000-00-00 00:00:00', '2015-06-09 16:24:30', '0000-00-00 00:00:00'),
(2, 'Sample Tablature2', 'https://sampleurl2', '0000-00-00 00:00:00', '2015-06-09 16:23:56', '0000-00-00 00:00:00'),
(3, 'dasdas', '', '0000-00-00 00:00:00', '2015-06-18 06:52:55', '0000-00-00 00:00:00'),
(4, 'asdsa', '', '0000-00-00 00:00:00', '2015-06-18 06:55:02', '0000-00-00 00:00:00'),
(5, 'asdsadas', '', '2015-06-18 06:57:59', '2015-06-18 06:57:59', '0000-00-00 00:00:00'),
(6, 'asdasds', '', '2015-06-18 06:59:14', '2015-06-18 06:59:14', '0000-00-00 00:00:00'),
(7, 'addsad', '', '2015-06-18 07:01:12', '2015-06-18 07:01:12', '0000-00-00 00:00:00'),
(8, 'dasdasdsdsad', 'http://localhost/oztinate/uploads/tabs/tab_8.png', '2015-06-18 07:05:02', '2015-06-18 07:05:02', '0000-00-00 00:00:00'),
(10, 'SDAS', 'http://localhost/oztinate/uploads/tabs/tab_10.png', '2015-06-18 09:39:58', '2015-06-18 09:39:58', '0000-00-00 00:00:00'),
(11, 'sample tablature', 'http://localhost/oztinate/uploads/tabs/tab_11.png', '2015-06-18 17:02:00', '2015-06-18 17:02:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `taskId` int(11) NOT NULL AUTO_INCREMENT,
  `taskName` varchar(45) NOT NULL,
  `instruction` text NOT NULL,
  `minDuration` decimal(5,2) NOT NULL,
  `practiceDuration` decimal(5,2) NOT NULL,
  `details` text NOT NULL,
  `updatedId` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`taskId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`taskId`, `taskName`, `instruction`, `minDuration`, `practiceDuration`, `details`, `updatedId`, `enabled`, `createdDate`) VALUES
(1, 'SampleTask', 'Sample task instructions', '15.00', '30.00', 'Sample Details', '2015-06-09 16:22:06', 1, '2015-06-19 14:44:48'),
(2, 'asdsdas', 'sadas', '12.00', '2.00', 'dasda', '2015-06-17 09:18:05', 1, '2015-06-19 14:44:48'),
(3, 'aasd', 'sadasd', '1.00', '1.00', 'adsdas', '2015-06-17 09:26:29', 1, '2015-06-19 14:44:48'),
(4, 'fsdf', 'fsdfsd', '1.00', '1.00', 'sdfdf', '2015-06-17 09:27:15', 1, '2015-06-19 14:44:48'),
(5, 'MysampleTask', 'sample Instructions', '15.00', '20.00', 'qwq', '2015-06-18 09:10:53', 1, '2015-06-19 14:44:48'),
(7, 'sampeltask3', 'sad', '13.00', '15.00', 'eww', '2015-06-18 09:14:29', 1, '2015-06-19 14:44:48'),
(9, 'sasAS', 'Asa', '11.00', '24.00', 'mufeed', '2015-06-18 09:18:50', 1, '2015-06-19 14:44:48'),
(11, 'asA', 'Sas', '12.00', '12.00', 'sqw', '2015-06-18 09:25:31', 1, '2015-06-19 14:44:48'),
(12, 'asA', 'Sas', '12.00', '12.00', 'sqw', '2015-06-18 09:25:32', 1, '2015-06-19 14:44:48'),
(13, 'sad', 'dasd', '11.00', '21.00', 'sdas', '2015-06-18 09:27:56', 1, '2015-06-19 14:44:48'),
(14, 'sad', 'dasd', '11.00', '21.00', 'sdas', '2015-06-18 09:27:56', 1, '2015-06-19 14:44:48'),
(15, 'sdfasd', 'dsafasd', '12.00', '999.99', 'eqwe', '2015-06-18 09:32:18', 1, '2015-06-19 14:44:48'),
(16, 'sdfasd', 'dsafasd', '12.00', '999.99', 'eqwe', '2015-06-18 09:32:18', 1, '2015-06-19 14:44:48'),
(17, 'dsfdf', 'sdfsd', '12.00', '21.00', 'asdsa', '2015-06-18 09:33:30', 1, '2015-06-19 14:44:48'),
(18, 'dsfdf', 'sdfsd', '12.00', '21.00', 'asdsa', '2015-06-18 09:33:30', 1, '2015-06-19 14:44:48'),
(19, 'aSAD', 'ASD', '12.00', '45.00', 'SFDF', '2015-06-18 09:36:50', 1, '2015-06-19 14:44:48'),
(20, 'aSAD', 'ASD', '12.00', '45.00', 'SFDF', '2015-06-18 09:36:50', 1, '2015-06-19 14:44:48'),
(21, 'SADASD', 'ASDAS', '12.00', '123.00', 'WDWQE', '2015-06-18 09:38:07', 1, '2015-06-19 14:44:48'),
(22, 'SADASD', 'ASDAS', '12.00', '123.00', 'WDWQE', '2015-06-18 09:38:07', 1, '2015-06-19 14:44:48'),
(23, 'aSDASD', 'SADAS', '12.00', '999.99', 'DASD', '2015-06-18 09:39:20', 1, '2015-06-19 14:44:48'),
(24, 'aSDASD', 'SADAS', '12.00', '999.99', 'DASD', '2015-06-18 09:39:20', 1, '2015-06-19 14:44:48');

-- --------------------------------------------------------

--
-- Table structure for table `tasktablatures`
--

CREATE TABLE IF NOT EXISTS `tasktablatures` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `taskId` int(11) NOT NULL,
  `tablatureId` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tasktablatures`
--

INSERT INTO `tasktablatures` (`Id`, `taskId`, `tablatureId`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 5, 1),
(4, 5, 2),
(5, 7, 1),
(6, 9, 1),
(7, 11, 1),
(8, 13, 1),
(9, 15, 1),
(10, 17, 1),
(11, 19, 1),
(12, 21, 1),
(13, 23, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(45) NOT NULL,
  `password` varchar(20) NOT NULL,
  `userType` int(11) NOT NULL DEFAULT '1',
  `sessionToken` varchar(45) NOT NULL,
  `loginStatus` char(1) NOT NULL DEFAULT 'N',
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `password`, `userType`, `sessionToken`, `loginStatus`, `enabled`, `createdDate`, `updatedDate`) VALUES
(1, 'mufeed', 'mufeed123', 1, 'f0dbbccb1681695f9444fc4f556e8e69', 'Y', 1, '2015-06-19 14:50:26', '0000-00-00 00:00:00'),
(3, 'admin', 'admin', 0, 'f0dbbccb1681695f9444fc4f556e8e69', 'Y', 1, '2015-06-19 14:50:26', '0000-00-00 00:00:00'),
(4, 'sujeesh', 'sujeesh123', 1, 'f0dbbccb1681695f9444fc4f556e8e69', 'Y', 1, '2015-06-19 14:50:26', '0000-00-00 00:00:00'),
(5, 'Binu', 'binu123', 1, 'f0dbbccb1681695f9444fc4f556e8e69', 'Y', 1, '2015-06-19 14:50:26', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `usertasks`
--

CREATE TABLE IF NOT EXISTS `usertasks` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `assignedTaskId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `usertasks`
--

INSERT INTO `usertasks` (`Id`, `assignedTaskId`, `UserId`) VALUES
(1, 1, 1),
(2, 2, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
