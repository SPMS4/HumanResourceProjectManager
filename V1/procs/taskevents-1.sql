-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2015 at 04:43 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spmspractice`
--

-- --------------------------------------------------------

--
-- Table structure for table `taskevents`
--

CREATE TABLE IF NOT EXISTS `taskevents` (
  `TaskEventID` int(11) NOT NULL AUTO_INCREMENT,
  `CalendarID` int(11) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date DEFAULT NULL,
  `Title` int(11) NOT NULL,
  `Backlog` bit(1) NOT NULL,
  `Description` varchar(1000) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL,
  `DateLastModified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`TaskEventID`),
  KEY `taskevents_FK_constraint` (`CalendarID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `taskevents`
--
ALTER TABLE `taskevents`
  ADD CONSTRAINT `taskevents_FK_constraint` FOREIGN KEY (`CalendarID`) REFERENCES `calendar` (`CalendarID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
