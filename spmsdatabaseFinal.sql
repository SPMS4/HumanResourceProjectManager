-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2015 at 06:35 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spmsdatabase`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `CountGroups`(IN `exGroupName` VARCHAR(50), OUT `Groups` INT)
    NO SQL
BEGIN
SELECT COUNT(*)               
    INTO   Groups                   
    FROM   groups
    WHERE  GroupName = exGroupName;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CountUserNames`(IN `exUserName` VARCHAR(50), OUT `Names` INT)
BEGIN
SELECT COUNT(*)               
    INTO   Names                   
    FROM   users
    WHERE  uName = exUserName;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteTaskEvent`(IN `exTaskEventID` INT)
    NO SQL
BEGIN
 DELETE FROM taskevents0
 WHERE TaskEventID = exTaskEventID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `inout`(IN `inNum` INT, OUT `outNum` INT)
    NO SQL
BEGIN

select inNum+2 into outNum;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `inoutexampleproc`(IN `exUserID` INT, OUT `ifName` VARCHAR(50), OUT `iStatus` VARCHAR(50))
Begin 
Select uName,UserCurrentStatus into ifName, iStatus
From users 
Where exUserID = UserID; 
End$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertEvent`(exEventName varchar(50), exEventDate date, exEventDescription varchar(2000), exEventTime time, exLocation varchar(25) )
BEGIN 

/* Delcare Internal Variables*/ 
Declare iCalendarID int DEFAULT 0;

/*Declare iTaskID;*/ 
/* Do any Reads */ 
Select iCalendarID = CalendarID 
From calendar 
INNER JOIN groups on calendar.GroupID = groups.GroupID;

 
insert INTO event
( 
CalendarID,
 
EventName,
    
EventDate,
    
EventDescription,
    
EventTime,
    
Location
) 

VALUES 
( 
iCalendarID, 

exEventName, 
    
exEventDate, 
    
exNoteDescription,
    
exEventTime,
    
exLocation
 ) ; 


/* END NIGHTMARE */ 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertGroup`(IN `exgroupname` VARCHAR(50), IN `exprojectID` INT, IN `exUserID` INT)
    NO SQL
begin
    INSERT INTO groups
         (
           Groupname,
           UserID,
           ProjectID
         )
    VALUES 
         ( 
           exgroupname,
           exUserID,
           exprojectID                      
         ) ; 
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertGroup2`(IN `exgroupname` VARCHAR(50), IN `exUserID` INT, OUT `iprojectID` INT, IN `exprojectID` INT)
    NO SQL
BEGIN 
Select iprojectID = ProjectID 
From project 
Where ProjectName = exprojectname;

/*Select igroupmember = fname,sname
From users
INNER JOIN  groups  on users.GroupID = groups.GroupID
Where GroupMember = exUserName;*/


    INSERT INTO groups
         (
           /*Groupmember,*/ 
           Groupname,
           UserID,
           ProjectID
         )
    VALUES 
         ( 
           /*exgroupmember*/ /*igroupmember,*/ 
           exgroupname,
           exUserID,
           iprojectID                      
         ) ; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertLink`(exLinkName varchar(50),exLinkText varchar(2083),exLinkDate date)
BEGIN 

/* Delcare Internal Variables*/ 
Declare iCalendarID int DEFAULT 0;

/*Declare iTaskID;*/ 
/* Do any Reads */ 
Select iCalendarID = CalendarID 
From calendar 
INNER JOIN groups on calendar.GroupID = groups.GroupID;

/*  INNER JOIN `course` on user.course = course.id;/* 

/* Select iTaskID = TaskID 
From task 
INNER JOIN calendar on task.TaskID = calendar.TaskID; */ 

/* Business Logic*/ 

/* Just Insert*/
 
insert INTO link
( 
CalendarID,
 
LinkDate,
 
LinkName, 

LinkText 

) 

VALUES 
( 
iCalendarID, 

exLinkDate, 

exLinkName, 
    
exLinkText
 ) ; 


/* END NIGHTMARE */ 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertNote`(exNoteName varchar(50), exNoteDate date, exNoteDescription varchar(2000))
BEGIN 

/* Delcare Internal Variables*/ 
Declare iCalendarID int DEFAULT 0;

/*Declare iTaskID;*/ 
/* Do any Reads */ 
Select iCalendarID = CalendarID 
From calendar 
INNER JOIN groups on calendar.GroupID = groups.GroupID;

 
insert INTO note
( 
CalendarID,
 
NoteName,
    
NoteDate,
    
NoteDescription
) 

VALUES 
( 
iCalendarID, 

exNoteName, 
    
exNoteDate, 
    
exNoteDescription 
 ) ; 


/* END NIGHTMARE */ 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertNoteUrl0`(IN `exTitle` VARCHAR(50), IN `exTaskEventID` INT, IN `exNote` VARCHAR(100), IN `exLink` VARCHAR(2083))
    NO SQL
BEGIN

/* Do any Reads */
/*
Select TaskEventID into iTaskEventID 
From noteurl 
INNER JOIN taskevents on noteurl.TaskEventID = taskevents.TaskEventID
INNER JOIN calendar on taskevents.CalendarID = calendar.CalendarID
WHERE GroupID = exGroupID; */



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
           exTaskEventID,
             exNote,
             exLink,
             NOW()
         ) ;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertProject`(IN `proName` VARCHAR(50), IN `proStart` DATE, IN `proEnd` DATE, IN `proDescription` VARCHAR(2000))
BEGIN 

INSERT INTO project ( ProjectName, ProjectStart, ProjectEnd, Description, datecreate ) VALUES ( proName, proStart, proEnd, proDescription, NOW() ) ;END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertTask`(exTaskName varchar(50),exTaskDescription varchar(2000),exTaskStartDate date,exTaskEndDate date)
BEGIN

/* Delcare Internal Variables*/
Declare iCalendarID int DEFAULT 0;
/*Declare iTaskID;*/

/* Do any Reads */
Select iCalendarID = CalendarID
From calendar
INNER JOIN  groups  on calendar.GroupID = groups.GroupID;/* * INNER JOIN `course` on user.course = course.id;/* */

/*
Select iTaskID = TaskID
From task
INNER JOIN 'calendar' on task.TaskID = calendar.TaskID;
*/

/* Business Logic*/

/* Just Insert*/
insert INTO task
 
(
                
CalendarID,
                
Description,
                
End_Date,
                
Name,

Start_Date        
)
    
VALUES 
(
iCalendarID,
           
exTaskDescription, 
    
exTaskEndDate, 
    
exTaskName,
    
exTaskStartDate 
           
) ; 

/* END NIGHTMARE */
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertTaskEvent`(IN `exTitle` VARCHAR(50), IN `exBacklog` BIT, IN `exStartDate` DATE, IN `exEndDate` DATE, IN `exGroupID` INT, IN `exColor` VARCHAR(6), OUT `exNewId` INT)
    NO SQL
BEGIN
/* Just Insert*/
Insert into taskevents0
         (
             StartDate,
             EndDate,
             Title,
             Backlog,
             color,
             GroupID,
             DateCreated
         )
    VALUES 
         ( 
             exStartDate,
             exEndDate,
             exTitle,
           	 exBacklog,
             exColor,
             exGroupID,
             NOW()
         ) ;
    SET exNewId = LAST_INSERT_ID();

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ProjectDetailsForGroup`(IN `exGroupID` INT)
    NO SQL
Begin

Select g.ProjectID, p.ProjectName, p.Description
From groups g
inner join project p on
g.ProjectID = p.ProjectID
Where GroupID = exGroupID;

End$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `RegisterUser`(IN `exUserName` VARCHAR(50), IN `exPass` VARCHAR(50), IN `exFName` VARCHAR(50), IN `exSName` VARCHAR(50), IN `exEmail` VARCHAR(254), IN `exStatus` VARCHAR(50))
    NO SQL
BEGIN

if exUserName is null then SELECT 'UserName cannot be null';
Rollback;
END IF;

if exPass is null then SELECT 'Pass cannot be null';
Rollback;
END IF;

if exEmail is null then SELECT 'Email Required';
Rollback;
END IF;

Insert into users
         (
             uName,
             pass,
             fName,
             sName,
             Email,
             UserCurrentStatus
             
         )
    VALUES 
         ( 
             exUserName,
             exPass,
             exFName,
             exSName,
             exEmail,
             exStatus
         ) ;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectEvent`(IN `exGroupID` INT)
    NO SQL
begin

Select *
From TaskEvents0
Where GroupID = exGroupID
and EndDate = 00-00-00;


end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectGroupsByUser`(IN `exUserID` INT)
    NO SQL
Begin
/*Select ug.GroupID, g.GroupName 
From usergroup ug
INNER JOIN groups u on ug.GroupID = g.GroupID
WHERE ug.UserID = exUserID;
*/
Select ug.GroupID, g.GroupName 
From usergroup ug
inner join groups g on ug.GroupID = g.GroupID
WHERE ug.UserID = exUserID;
End$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectGroupsForLecturer`(IN `exUserID` INT)
    NO SQL
BEGIN 

Select GroupID, GroupName 
From groups 
WHERE UserID = exUserID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectTask`(IN `exGroupID` INT)
    NO SQL
BEGIN


Select *
From TaskEvents0
Where GroupID = exGroupID
and EndDate is not null;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectTask0`(IN `exGroupID` INT, OUT `iTaskEventID` INT, OUT `iEndDate` INT, OUT `iStartDate` INT, OUT `iDescription` VARCHAR(2000), OUT `iTitle` VARCHAR(50), OUT `iBacklog` BIT)
    NO SQL
BEGIN

 SELECT
            TaskEventID INTO iTaskEventID
        FROM
            taskevents0
        WHERE
            GroupID = exGroupID;
   /*-----------------------------------------------*/         
             SELECT
            EndDate INTO iEndDate
        FROM
            taskevents0
        WHERE
            GroupID = exGroupID;
         /*-----------------------------------------------*/   
            
           SELECT   StartDate INTO iStartDate
        FROM
            taskevents0
        WHERE
            GroupID = exGroupID;
            
         /*-----------------------------------------------*/   
             SELECT Description INTO iDescription
        FROM
            taskevents0
        WHERE
            GroupID = exGroupID;
            /*-----------------------------------------------*/
            SELECT Title INTO iTitle
        FROM
            taskevents0
        WHERE
            GroupID = exGroupID;
            /*------------------------------------------*/
                SELECT   Backlog INTO iBacklog
        FROM
            taskevents0
        WHERE
            GroupID = exGroupID;
            
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `StudentsinGroup0`(IN `exGroupID` INT)
    NO SQL
BEGIN
Select ug.UserID,uName
From users u
INNER JOIN usergroup ug on ug.UserID = u.UserID
WHERE ug.GroupID = exGroupID;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateNoteURL`(IN `exNote` VARCHAR(100), IN `exLink` VARCHAR(2083))
    NO SQL
BEGIN
  UPDATE noteurl
    SET                        
           Note  = exStartDate,
           Link = exEndDate,
          LastModified = NOW()
    WHERE CalendarID = exCalendarID;



END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateProfile`(IN `exUserID` INT, IN `exfName` VARCHAR(50), IN `exsName` VARCHAR(50), IN `exAddress` VARCHAR(50), IN `exAddress2` VARCHAR(50), IN `exCity` VARCHAR(50), IN `exCountry` VARCHAR(50), IN `exCounty` VARCHAR(50), IN `exPhone` VARCHAR(12), IN `exPhone2` VARCHAR(12), IN `exColor` VARCHAR(6))
    NO SQL
BEGIN 

    UPDATE users
    SET    
                fName =  exfName,
                sName =  exsName,
                Address = exAddress,
                Address2 = exAddress2,
                City =   exCity,
                Country = exCountry,
                county =  excounty,
                Phone =  exPhone,
                Phone2 =  exPhone2,
                Color       =  exColor
    WHERE       UserID = exUserID ; 

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateTaskEvent`(IN `exTitle` INT, IN `exBacklog` INT, IN `exStartDate` INT, IN `exEndDate` INT, OUT `iCalendarID` INT, IN `exGroupID` INT)
    NO SQL
BEGIN
Select CalendarID into iCalendarID 
From calendar 
INNER JOIN groups on calendar.GroupID = groups.GroupID
WHERE GroupID = exGroupID ; 


  UPDATE taskevents
    SET    
           Title  = exTitle,                    
           StartDate  = exStartDate,
           EndDate = exEndDate,
           Backlog = exBacklog,
           DateLastModified = NOW()
    WHERE CalendarID = iCalendarID;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateTaskEvent0`(IN `exTitle` VARCHAR(50), IN `exBacklog` BIT, IN `exStartDate` DATE, IN `exEndDate` DATE, IN `exGroupID` INT, IN `exDesc` VARCHAR(1000), IN `exTaskEventID` INT)
    NO SQL
BEGIN

  UPDATE taskevents0
    SET    
    	   StartDate  = exStartDate,
           EndDate = exEndDate,
           Title  = exTitle,  
           Backlog = exBacklog,
           Description=exDesc,
           DateLastModified = NOW()
          /* TaskEventID*/
    WHERE TaskEventID = exTaskEventID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UserColour`(IN `exUserID` INT, OUT `iColor` VARCHAR(6))
    NO SQL
BEGIN

select Color into iColor
from users
where UserID = exUserID;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE IF NOT EXISTS `calendar` (
  `CalendarID` int(11) NOT NULL AUTO_INCREMENT,
  `GroupID` int(11) DEFAULT NULL,
  PRIMARY KEY (`CalendarID`),
  KEY `GroupID` (`GroupID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`CalendarID`, `GroupID`) VALUES
(20, 150);

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE IF NOT EXISTS `college` (
  `CollegeID` int(11) NOT NULL AUTO_INCREMENT,
  `CollegeName` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `CollegePresident` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Address` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Phone` varchar(12) DEFAULT NULL,
  `StudentID` int(11) DEFAULT NULL,
  PRIMARY KEY (`CollegeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `CourseID` int(11) NOT NULL AUTO_INCREMENT,
  `DepartmentID` int(11) DEFAULT NULL,
  `CourseName` varchar(50) DEFAULT NULL,
  `CourseDuration` int(11) DEFAULT NULL,
  `CourseInfo` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`CourseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `DepartmentID` int(11) NOT NULL AUTO_INCREMENT,
  `DepName` varchar(50) DEFAULT NULL,
  `CollegeID` int(11) DEFAULT NULL,
  PRIMARY KEY (`DepartmentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `GroupID` int(11) NOT NULL AUTO_INCREMENT,
  `ProjectID` int(11) DEFAULT NULL,
  `GroupMember` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `GroupName` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Color` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`GroupID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=151 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`GroupID`, `ProjectID`, `GroupMember`, `GroupName`, `UserID`, `Color`) VALUES
(150, 29, NULL, 'Spms', 1129, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `noteurl`
--

CREATE TABLE IF NOT EXISTS `noteurl` (
  `NoteURLID` int(11) NOT NULL AUTO_INCREMENT,
  `TaskEventID` int(11) NOT NULL,
  `Note` varchar(100) DEFAULT NULL,
  `Link` varchar(2083) DEFAULT NULL COMMENT 'Stack OverFlow Answer',
  `DateCreated` timestamp NOT NULL,
  `LastModified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`NoteURLID`),
  KEY `fk_noteurl` (`TaskEventID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

--
-- Dumping data for table `noteurl`
--

INSERT INTO `noteurl` (`NoteURLID`, `TaskEventID`, `Note`, `Link`, `DateCreated`, `LastModified`) VALUES
(69, 185, 'Get design Ideas for the meeting event \r\nmonday the 22nd', '', '2015-03-11 05:17:04', NULL),
(71, 187, '1st team meeting to discuss future of the \r\nproject', '', '2015-03-11 05:23:23', NULL),
(72, 188, 'Design what goes on the pages and the \r\nfunction that each of them will do', '', '2015-03-11 05:25:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `ProjectID` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(2000) DEFAULT NULL,
  `ProjectName` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ProjectStart` date DEFAULT NULL,
  `ProjectEnd` date DEFAULT NULL,
  `datecreate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ProjectID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`ProjectID`, `Description`, `ProjectName`, `ProjectStart`, `ProjectEnd`, `datecreate`) VALUES
(29, 'The description of the PRJ300 will be here. You can put in whatever description you want yourself and the students to see on the calendar page.', 'Prj300', '2015-03-11', '2015-04-01', '2015-03-11 05:12:36');

-- --------------------------------------------------------

--
-- Table structure for table `taskevents0`
--

CREATE TABLE IF NOT EXISTS `taskevents0` (
  `TaskEventID` int(11) NOT NULL AUTO_INCREMENT,
  `StartDate` date NOT NULL,
  `EndDate` date DEFAULT NULL,
  `Title` varchar(50) NOT NULL,
  `Backlog` bit(1) NOT NULL,
  `color` varchar(6) NOT NULL,
  `Description` varchar(1000) DEFAULT NULL,
  `DateCreated` timestamp NOT NULL,
  `DateLastModified` timestamp NULL DEFAULT NULL,
  `GroupID` int(11) NOT NULL,
  PRIMARY KEY (`TaskEventID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=189 ;

--
-- Dumping data for table `taskevents0`
--

INSERT INTO `taskevents0` (`TaskEventID`, `StartDate`, `EndDate`, `Title`, `Backlog`, `color`, `Description`, `DateCreated`, `DateLastModified`, `GroupID`) VALUES
(185, '2015-03-19', '2015-03-23', 'Design stage', b'1', '441FFF', '', '2015-03-11 05:17:04', '2015-03-11 05:19:26', 150),
(186, '2015-03-22', '1970-01-01', 'dgd', b'1', '441FFF', '', '2015-03-11 05:17:50', '2015-03-11 05:21:17', 150),
(187, '2015-03-25', '1970-01-01', 'Team Meeting 1', b'0', '9059FF', NULL, '2015-03-11 05:23:23', NULL, 150),
(188, '2015-03-25', '2015-03-30', 'page design', b'1', 'FFF70A', NULL, '2015-03-11 05:25:15', NULL, 150);

-- --------------------------------------------------------

--
-- Table structure for table `usergroup`
--

CREATE TABLE IF NOT EXISTS `usergroup` (
  `UserID` int(11) NOT NULL,
  `GroupID` int(11) NOT NULL,
  `UserGroupID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`UserGroupID`),
  KEY `UserID` (`UserID`),
  KEY `GroupID` (`GroupID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

--
-- Dumping data for table `usergroup`
--

INSERT INTO `usergroup` (`UserID`, `GroupID`, `UserGroupID`) VALUES
(1133, 150, 71),
(1132, 150, 72),
(1131, 150, 73),
(1130, 150, 74);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `GroupID` int(11) DEFAULT NULL,
  `uName` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `pass` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `UserCurrentStatus` varchar(50) DEFAULT NULL,
  `fName` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sName` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Address` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Address2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `City` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `county` varchar(50) NOT NULL,
  `Country` varchar(50) DEFAULT NULL,
  `Email` varchar(254) DEFAULT NULL,
  `Phone` varchar(12) DEFAULT NULL,
  `Phone2` varchar(12) DEFAULT NULL,
  `CollegeName` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `CourseName` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Color` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1134 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `GroupID`, `uName`, `pass`, `UserCurrentStatus`, `fName`, `sName`, `Address`, `Address2`, `City`, `county`, `Country`, `Email`, `Phone`, `Phone2`, `CollegeName`, `CourseName`, `Color`) VALUES
(1129, NULL, 'lecturer', '040b7cf4a55014e185813e0644502ea9', 'lecturer', 'college', 'lecturer', 'here', 'there', 'everywhere', 'Sligo', NULL, 'lecturer@mail.itsligo.ie', '09647444', '0878574859', NULL, NULL, '441FFF'),
(1130, NULL, 'cormac', '040b7cf4a55014e185813e0644502ea9', 'students', 'cormac', 'hallinan', '', '', '', 'Antrim', NULL, 's00129359@mail.itsligo.ie', '', '', NULL, NULL, '9059FF'),
(1131, NULL, 'tomas', '040b7cf4a55014e185813e0644502ea9', 'students', 'tomas', 'McMahon', NULL, NULL, NULL, '', NULL, 's00126699@mail.itsligo.ie', NULL, NULL, NULL, NULL, NULL),
(1132, NULL, 'John', '040b7cf4a55014e185813e0644502ea9', 'students', 'John', 'mcgowan', NULL, NULL, NULL, '', NULL, 'john@mail.itsligo.ie', NULL, NULL, NULL, NULL, NULL),
(1133, NULL, 'greg', '040b7cf4a55014e185813e0644502ea9', 'students', 'greg', 'sheerin', '', '', '', 'Antrim', NULL, 'greg@mail.itsligo.ie', '', '', NULL, NULL, 'FFF70A');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `calendar`
--
ALTER TABLE `calendar`
  ADD CONSTRAINT `calendar_ibfk_1` FOREIGN KEY (`GroupID`) REFERENCES `groups` (`GroupID`);

--
-- Constraints for table `noteurl`
--
ALTER TABLE `noteurl`
  ADD CONSTRAINT `fk_noteurl` FOREIGN KEY (`TaskEventID`) REFERENCES `taskevents0` (`TaskEventID`);

--
-- Constraints for table `usergroup`
--
ALTER TABLE `usergroup`
  ADD CONSTRAINT `UserGroup_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `UserGroup_ibfk_3` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `UserGroup_ibfk_4` FOREIGN KEY (`GroupID`) REFERENCES `groups` (`GroupID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
