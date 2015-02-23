-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2015 at 05:44 PM
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
-- Table structure for table `noteurl`
--

CREATE TABLE IF NOT EXISTS `noteurl` (
  `NoteURLID` int(11) NOT NULL AUTO_INCREMENT,
  `TaskEventID` int(11) NOT NULL,
  `Note` varchar(100) NOT NULL,
  `Link` varchar(2083) NOT NULL COMMENT 'Stack OverFlow Answer',
  `DateCreated` timestamp NOT NULL,
  `LastModified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`NoteURLID`),
  KEY `fk_noteurl` (`TaskEventID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `noteurl`
--
ALTER TABLE `noteurl`
  ADD CONSTRAINT `fk_noteurl` FOREIGN KEY (`TaskEventID`) REFERENCES `taskevents` (`TaskEventID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertNoteURL`(IN `exNote` INT, IN `exLink` INT, IN `exCalendarID` INT, OUT `iTaskEventID` INT)
    NO SQL
BEGIN

/* Do any Reads */
Select TaskEventID into iTaskEventID 
From noteurl 
INNER JOIN taskevents on noteurl.TaskEventID = taskevents.TaskEventID
INNER JOIN calendar on taskevents.CalendarID = calendar.CalendarID
WHERE GroupID = exCalendarID; 



/* Business Logic*/

/* Just Insert*/
Insert into noteurl
         (
             TaskEventID,
             Note,
             Link,
             DateCreated
         )
    VALUES 
         ( 
           iTaskEventID,
             exNote,
             exLink,
             NOW()
         ) ;
END

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateNoteURL`(IN `exNote` VARCHAR(100), IN `exLink` VARCHAR(2083))
    NO SQL
BEGIN



  UPDATE noteurl
    SET                        
           Note  = exStartDate,
           Link = exEndDate,
          LastModified = NOW()
    WHERE CalendarID = exCalendarID;
END

