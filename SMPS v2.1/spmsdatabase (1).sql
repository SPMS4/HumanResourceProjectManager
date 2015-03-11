-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2015 at 06:04 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`CalendarID`, `GroupID`) VALUES
(3, 133),
(4, 134),
(5, 135),
(6, 136),
(7, 137),
(8, 138),
(9, 139),
(10, 140),
(11, 141),
(12, 142),
(13, 143),
(14, 144),
(15, 145),
(16, 146),
(17, 147),
(18, 148),
(19, 149);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=150 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`GroupID`, `ProjectID`, `GroupMember`, `GroupName`, `UserID`, `Color`) VALUES
(1, 1, NULL, 'Spms', 27, NULL),
(2, 1, NULL, 'hjk', 22, NULL),
(3, 2, NULL, 'hhg', 22, NULL),
(4, 1, NULL, 'kjf', 22, NULL),
(25, 3, NULL, 'name', 27, NULL),
(133, 10, NULL, 'testHi', 273, NULL),
(134, 7, NULL, 'adf', 273, NULL),
(135, 7, NULL, 'dfas', 273, NULL),
(136, 13, NULL, 'hbcjvlead', 273, NULL),
(137, 3, NULL, 'hblu', 273, NULL),
(138, 3, NULL, 'dsd', 273, NULL),
(139, 3, NULL, 'lllll', 27, NULL),
(140, 18, NULL, 'Big', 27, NULL),
(141, 18, NULL, 'new group', 27, NULL),
(142, 19, NULL, 'vstdgw', 27, NULL),
(143, 21, NULL, 'romo', 27, NULL),
(144, 22, NULL, 'awrfa', 27, NULL),
(145, 23, NULL, 'yyyyy', 27, NULL),
(146, 3, NULL, 'ffsf', 27, NULL),
(147, 3, NULL, 'efd', 27, NULL),
(148, 27, NULL, 'ski', 27, NULL),
(149, 24, NULL, 'sad', 27, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `noteurl`
--

INSERT INTO `noteurl` (`NoteURLID`, `TaskEventID`, `Note`, `Link`, `DateCreated`, `LastModified`) VALUES
(6, 1, 'this note', '', '2015-02-21 18:07:37', NULL),
(7, 1, '', 'www.facebook.com', '2015-02-21 18:08:23', NULL),
(9, 58, 'this aul note', '', '2015-02-23 11:38:32', NULL),
(20, 136, 'First Note', '', '2015-03-03 16:41:23', NULL),
(36, 152, ',jhbjl', '', '2015-03-05 10:12:46', NULL),
(37, 153, '', '', '2015-03-05 11:51:56', NULL),
(38, 154, '', '', '2015-03-05 12:05:47', NULL),
(39, 155, 'eghe', '', '2015-03-05 12:18:21', NULL),
(40, 156, 'sdgewg', '', '2015-03-05 12:18:58', NULL),
(41, 157, 'sf', '', '2015-03-05 12:20:42', NULL),
(42, 158, '', '', '2015-03-05 13:30:48', NULL),
(43, 159, 'vewtvw', '', '2015-03-05 13:32:51', NULL),
(44, 160, 'fewve', '', '2015-03-05 14:08:31', NULL),
(45, 161, 'dgfs', '', '2015-03-05 14:10:36', NULL),
(46, 162, 'vsf', '', '2015-03-06 14:33:51', NULL),
(47, 163, 'evksdn', '', '2015-03-06 14:36:11', NULL),
(48, 164, 'esdfs', '', '2015-03-06 14:37:06', NULL),
(49, 165, 'bj.bljb hjb h oub uuo yh yuh uy buoy b uy', '', '2015-03-06 19:48:56', NULL),
(50, 166, '', '', '2015-03-06 19:49:17', NULL),
(51, 167, 'Do engine', '', '2015-03-07 15:41:09', NULL),
(52, 168, 'first meeting', '', '2015-03-07 15:42:10', NULL),
(54, 170, 'gvs gs gfs ', '', '2015-03-09 17:17:27', NULL),
(55, 171, 'srgsdf gs ', '', '2015-03-09 17:17:43', NULL),
(56, 172, '', '', '2015-03-09 17:18:21', NULL),
(57, 173, '', '', '2015-03-09 17:19:15', NULL),
(58, 174, '', '', '2015-03-09 17:19:50', NULL),
(59, 175, 'dfe', '', '2015-03-09 17:20:26', NULL),
(60, 176, '', '', '2015-03-09 18:12:48', NULL),
(61, 177, 'fvzd', '', '2015-03-09 18:43:38', NULL),
(62, 178, '', '', '2015-03-09 18:44:14', NULL),
(63, 179, 'va avsf vas ', '', '2015-03-10 15:22:55', NULL),
(64, 180, 'here is some note content', 'http://www.jhgjhg.com', '2015-03-10 15:25:04', NULL),
(65, 181, '', '', '2015-03-10 15:32:12', NULL),
(66, 182, '', '', '2015-03-10 15:32:48', NULL),
(67, 183, 'ddfaaz', '', '2015-03-11 00:07:01', NULL),
(68, 184, 'jlhb', '', '2015-03-11 03:23:55', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`ProjectID`, `Description`, `ProjectName`, `ProjectStart`, `ProjectEnd`, `datecreate`) VALUES
(1, 'Prj300 description is here', 'Prj300', '2015-01-01', '2015-04-01', NULL),
(2, 'Prj400', 'Prj400', '2015-01-09', '2015-04-01', NULL),
(3, 'jhk sa fv dv wet vwev we vweve ve vweatf', 'Big Prj', '2015-01-06', '2015-07-01', NULL),
(5, 'this the 500 project', 'prj500', '2015-01-01', '2015-03-05', NULL),
(18, 'this is the description for the project', 'This Project', '2015-02-23', '2015-02-28', '2015-02-23 18:54:47'),
(19, 'lets learn more mvc', 'Rad302', '2015-03-02', '2015-03-25', '2015-03-02 16:28:54'),
(20, 'lets learn more mvc', 'Rad302', '2015-03-02', '2015-03-25', '2015-03-02 16:31:42'),
(21, 'web project description', 'web1 ', '2015-03-02', '2015-03-26', '2015-03-02 17:10:49'),
(22, 'sdtesds ', 'database', '2015-03-05', '2015-03-20', '2015-03-05 11:50:39'),
(23, 'vsfv vse vsa v av ', 'dacs', '2015-03-06', '2015-03-18', '2015-03-06 14:35:00'),
(24, 'dfvcz', 'zv', '0000-00-00', '0000-00-00', '2015-03-06 15:32:34'),
(25, 'dfvcz', 'zv', '0000-00-00', '0000-00-00', '2015-03-06 15:33:01'),
(26, 'safad', 'WO', '0000-00-00', '0000-00-00', '2015-03-06 19:47:59'),
(27, 'edbd egweb geg bves vbe steve sfcwesvs', 'Jet Ski', '2015-03-07', '2015-03-31', '2015-03-07 15:35:34'),
(28, 'sgdg sdg fsd fs dvsad fva dasc ads c\\z', 'dddd', '2015-03-10', '2015-03-24', '2015-03-09 19:38:46');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=185 ;

--
-- Dumping data for table `taskevents0`
--

INSERT INTO `taskevents0` (`TaskEventID`, `StartDate`, `EndDate`, `Title`, `Backlog`, `color`, `Description`, `DateCreated`, `DateLastModified`, `GroupID`) VALUES
(1, '2015-02-15', '2015-02-22', 'heg', b'1', 'ff0000', 'avadv vw', '2015-02-15 22:51:58', NULL, 0),
(58, '2015-02-22', '2015-02-26', 'WOW', b'1', '', 'eve ev weav ew vwea rv', '2015-02-18 00:47:46', NULL, 1),
(63, '0000-00-00', NULL, 'updated', b'0', '', NULL, '2015-02-19 13:25:30', '2015-02-21 14:31:51', 1),
(100, '0000-00-00', '0000-00-00', 'New', b'1', '', NULL, '2015-02-21 18:20:05', NULL, 2),
(101, '0000-00-00', '0000-00-00', 'New', b'1', '', NULL, '2015-02-21 18:21:19', NULL, 2),
(102, '0000-00-00', '0000-00-00', 'New', b'1', '', NULL, '2015-02-21 18:33:50', NULL, 2),
(103, '2015-02-16', '2015-02-21', 'New', b'1', '', NULL, '2015-02-21 18:33:54', NULL, 1),
(104, '0000-00-00', '0000-00-00', '', b'0', '', NULL, '2015-02-21 21:22:55', NULL, 25),
(105, '2015-02-19', '2015-02-27', 'dfda', b'1', '', NULL, '2015-02-23 11:13:03', NULL, 2),
(111, '0000-00-00', '0000-00-00', 'Title', b'1', '', NULL, '2015-03-02 11:32:58', NULL, 2),
(112, '0000-00-00', '0000-00-00', 'Title', b'1', '', NULL, '2015-03-02 11:33:37', NULL, 2),
(113, '2015-03-18', '2015-03-21', 'Title012', b'1', 'ff0000', '', '2015-03-02 12:06:41', '2015-03-09 16:25:39', 1),
(125, '0000-00-00', '0000-00-00', 'fsdg', b'1', '', NULL, '2015-03-02 12:47:17', NULL, 2),
(136, '2015-03-10', '1970-01-01', 'vsfdvd', b'1', 'ff0000', '', '2015-03-03 16:41:20', '2015-03-09 16:28:17', 1),
(137, '0000-00-00', '0000-00-00', 'fsf', b'0', 'ff0000', NULL, '2015-03-05 09:52:41', NULL, 143),
(138, '0000-00-00', '0000-00-00', 'fsf', b'0', 'ff0000', NULL, '2015-03-05 09:56:12', NULL, 143),
(139, '0000-00-00', '0000-00-00', 'fsf', b'0', 'ff0000', NULL, '2015-03-05 09:56:49', NULL, 143),
(140, '0000-00-00', '0000-00-00', 'fsf', b'0', 'ff0000', NULL, '2015-03-05 09:57:27', NULL, 143),
(141, '2015-03-04', '0000-00-00', 'fsf', b'0', 'ff0000', NULL, '2015-03-05 09:57:58', NULL, 143),
(142, '2015-03-04', '2015-04-01', '', b'0', 'ff0000', NULL, '2015-03-05 09:59:51', NULL, 143),
(143, '2015-03-04', '2015-04-01', '', b'0', 'ff0000', NULL, '2015-03-05 10:00:54', NULL, 143),
(144, '2015-03-04', '1970-01-01', 'fsf', b'0', 'ff0000', NULL, '2015-03-05 10:01:12', NULL, 143),
(145, '2015-03-03', '2015-03-07', 'Dsd', b'0', 'ff0000', NULL, '2015-03-05 10:02:00', NULL, 141),
(151, '2015-03-03', '2015-03-05', 'col', b'0', '00ff00', NULL, '2015-03-05 10:08:56', NULL, 141),
(152, '2015-03-02', '2015-03-05', 'ihih', b'0', '', NULL, '2015-03-05 10:12:45', NULL, 141),
(153, '2015-03-03', '2015-03-06', 'tasks', b'0', '', NULL, '2015-03-05 11:51:56', NULL, 144),
(154, '2015-03-03', '2015-03-19', 'john', b'0', '', NULL, '2015-03-05 12:05:47', NULL, 144),
(155, '2015-03-03', '2015-03-12', 'rtge', b'0', 'ff00ff', NULL, '2015-03-05 12:18:21', NULL, 141),
(156, '2015-03-03', '2015-03-12', 'coloured', b'0', 'ffff00', NULL, '2015-03-05 12:18:58', NULL, 141),
(157, '2015-03-03', '2015-03-19', 'function', b'0', 'ffff00', NULL, '2015-03-05 12:20:42', NULL, 141),
(158, '2015-03-08', '0000-00-00', 'event', b'1', '00f00f', NULL, '2015-03-05 13:30:48', NULL, 141),
(159, '2015-03-10', '0000-00-00', 'trt', b'0', '000000', NULL, '2015-03-05 13:32:51', NULL, 141),
(160, '2015-03-05', '1970-01-01', 'All Day', b'0', 'ffff00', NULL, '2015-03-05 14:08:31', NULL, 139),
(161, '2015-03-11', '1970-01-01', 'events', b'1', 'ffff00', NULL, '2015-03-05 14:10:36', NULL, 139),
(162, '2015-03-17', '1970-01-01', 'eeee', b'1', 'ffff00', '', '2015-03-06 14:33:51', '2015-03-09 16:28:04', 1),
(163, '2015-03-17', '2015-03-19', 'task0101', b'1', 'ffff00', '', '2015-03-06 14:36:11', '2015-03-11 03:24:49', 145),
(164, '2015-03-21', '1970-01-01', 'philknk', b'1', 'ff0ff0', '', '2015-03-06 14:37:06', '2015-03-11 03:24:31', 145),
(165, '2015-03-06', '2015-03-16', 'project', b'1', 'ff0ff0', NULL, '2015-03-06 19:48:56', NULL, 147),
(166, '2015-03-07', '1970-01-01', 'day', b'0', 'ff0ff0', NULL, '2015-03-06 19:49:17', NULL, 147),
(167, '2015-03-07', '2015-04-04', 'engine', b'0', 'ff0ff0', NULL, '2015-03-07 15:41:08', NULL, 148),
(168, '2015-03-10', '1970-01-01', 'metting', b'1', 'ff0ff0', NULL, '2015-03-07 15:42:10', NULL, 148),
(170, '2015-03-11', '2015-03-20', 'cormac', b'0', 'A6FFEA', NULL, '2015-03-09 17:17:27', NULL, 1),
(171, '2015-03-10', '2015-03-17', 'tom', b'0', 'A6FFEA', NULL, '2015-03-09 17:17:43', NULL, 1),
(172, '2015-03-11', '2015-03-17', 'tommy', b'0', 'A6FFEA', NULL, '2015-03-09 17:18:21', NULL, 1),
(173, '2015-03-21', '1970-01-01', 'sgsfg', b'0', 'A6FFEA', NULL, '2015-03-09 17:19:15', NULL, 1),
(174, '2015-03-26', '1970-01-01', 'fgs', b'0', 'FFFF00', NULL, '2015-03-09 17:19:50', NULL, 1),
(175, '2015-03-25', '1970-01-01', 'dfsdz', b'0', 'ff0000', NULL, '2015-03-09 17:20:26', NULL, 1),
(176, '2015-03-11', '1970-01-01', 'df', b'1', 'F4FF8C', NULL, '2015-03-09 18:12:48', NULL, 147),
(177, '2015-03-11', '1970-01-01', 'eve', b'1', '4DCFFF', NULL, '2015-03-09 18:43:38', NULL, 25),
(178, '2015-03-10', '2015-03-18', 'sd', b'0', 'A6FFEA', NULL, '2015-03-09 18:44:14', NULL, 144),
(179, '2015-03-11', '2015-03-18', 'dsd', b'1', 'A6FFEA', '', '2015-03-10 15:22:55', '2015-03-10 15:23:41', 2),
(180, '2015-03-04', '2015-03-04', 'test event', b'0', 'A6FFEA', NULL, '2015-03-10 15:25:04', NULL, 2),
(181, '2015-03-10', '2015-03-31', 'taskk', b'0', 'A6FFEA', NULL, '2015-03-10 15:32:12', NULL, 2),
(182, '2015-03-06', '2015-03-06', 'test task', b'0', 'A6FFEA', NULL, '2015-03-10 15:32:48', NULL, 2),
(183, '2015-03-17', '2015-03-20', 'asdsa', b'0', 'FF5498', NULL, '2015-03-11 00:07:01', NULL, 1),
(184, '2015-03-18', '1970-01-01', 'hbl', b'1', '000530', '', '2015-03-11 03:23:55', '2015-03-11 03:24:06', 145);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `usergroup`
--

INSERT INTO `usergroup` (`UserID`, `GroupID`, `UserGroupID`) VALUES
(2, 1, 28),
(3, 1, 29),
(4, 1, 30),
(5, 1, 31),
(1110, 2, 34),
(2, 2, 35),
(5, 25, 38),
(3, 25, 39),
(32, 139, 40),
(33, 139, 41),
(47, 140, 42),
(32, 140, 43),
(2, 141, 44),
(32, 141, 45),
(47, 142, 46),
(31, 142, 47),
(2, 143, 48),
(4, 143, 49),
(31, 143, 50),
(2, 144, 51),
(31, 144, 52),
(32, 144, 53),
(2, 145, 54),
(47, 145, 55),
(31, 145, 56),
(2, 146, 57),
(32, 146, 58),
(33, 146, 59),
(2, 147, 60),
(4, 147, 61),
(3, 147, 62),
(32, 148, 63),
(31, 148, 64),
(4, 148, 65),
(1112, 148, 66),
(2, 149, 67),
(31, 149, 68),
(4, 149, 69),
(30, 149, 70);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1128 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `GroupID`, `uName`, `pass`, `UserCurrentStatus`, `fName`, `sName`, `Address`, `Address2`, `City`, `county`, `Country`, `Email`, `Phone`, `Phone2`, `CollegeName`, `CourseName`, `Color`) VALUES
(2, 2, 'cormac', '040b7cf4a55014e185813e0644502ea9', 'students', 'cormac', 'hallinan', 'ballykilcash', 'dromore west', 'dromore west', 'Antrim', NULL, 'cormac@hotmail.com', '09647444', '0878574859', 'It Sligo', 'Science', '000530'),
(3, 2, 'Tom', '040b7cf4a55014e185813e0644502ea9', 'students', 'Tomas', '', '', 'f', '', 'Antrim', 'Ireland', 'tom@hotmail.com', '', '', 'It Sligo', 'Science', '4DCFFF'),
(4, 117, 'Greg', '040b7cf4a55014e185813e0644502ea9', 'students', '0', '0', '0', '0', '0', '0', '0', 'Greg@hotmail.com', '9675885', '875748374', 'It Sligo', 'Science', '0'),
(5, 117, 'John', '040b7cf4a55014e185813e0644502ea9', 'students', '', '', '', '', '', 'Antrim', 'Ireland', 'john@hotmail.com', '', '', 'It Sligo', 'Science', 'ff0000'),
(6, NULL, 'Pat', '040b7cf4a55014e185813e0644502ea9', 'students', '', '', '', '', '', 'Antrim', 'Ireland', 'pat@hotmail.com', '', '', 'It Sligo', 'Science', NULL),
(7, NULL, 'Joe', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'students', '', '', '', '', '', 'Antrim', 'Ireland', 'jor@hotmail.com', '', '', 'It Sligo', 'Science', NULL),
(8, NULL, 'tommy', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'student', '', '', '', '', '', 'Antrim', 'Ireland', '', '', '', 'It Sligo', '', NULL),
(9, NULL, 'tomas', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'student', '', '', '', '', '', 'Antrim', 'Ireland', '', '', '', 'It Sligo', '', NULL),
(10, NULL, '', 'd41d8cd98f00b204e9800998ecf8427e', 'student', '', '', '', '', '', 'Antrim', 'Ireland', '', '', '', 'It Sligo', 'Computing', NULL),
(11, NULL, 'soo129359', 'd41d8cd98f00b204e9800998ecf8427e', 'student', '', '', '', '', '', 'Antrim', 'Ireland', '', '', '', 'It Sligo', '', NULL),
(12, NULL, 'cormac1234', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'student', 'h', 'hj', 'j', 'jn', 'k', 'Sligo', 'Ireland', 'fkjdsg@hotmail.com', '08599278694', '0987583849', 'It Sligo', 'Computing', NULL),
(13, NULL, 's000129359', '6eea9b7ef19179a06954edd0f6c05ceb', 'student', 'cormac', 'hallinan', 'sligo', 'sligo', 'sligo', 'Sligo', 'Ireland', 'cormac@hotmail.com', '09647444', '0879719323', 'It Sligo', 'Computing', NULL),
(14, NULL, 'sLecturer', '6acc3dbb4d1025bc89a896daaa599ca1', 'lecturer', 'cormac', 'hallinan', 'ballykilcash', '', 'dromore west', 'Sligo', 'Ireland', 'cormac@hotmail.com', '08797485948', '', 'It Sligo', 'Computing', NULL),
(15, NULL, '12345', '827ccb0eea8a706c4c34a16891f84e7b', 'student', 'jh', 'j', 'k', 'k', 'k', 'Armagh', 'Ireland', 'hjk', '9', '8', 'It Sligo', 'Computing', NULL),
(16, NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, NULL, 'as', 'as', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, NULL, '123', '827ccb0eea8a706c4c34a16891f84e7b', 'student', '', '', '', '', '', 'Antrim', 'Ireland', '', '', '', 'It Sligo', 'Science', NULL),
(23, NULL, 'test', '5f4dcc3b5aa765d61d8327deb882cf99', 'student', '', '', '', '', '', 'Antrim', 'Ireland', '', '', '', 'It Sligo', 'Science', NULL),
(24, NULL, 'test', '5f4dcc3b5aa765d61d8327deb882cf99', 'student', '', '', '', '', '', 'Antrim', 'Ireland', '', '', '', 'It Sligo', 'Science', NULL),
(27, NULL, 'L00123', '040b7cf4a55014e185813e0644502ea9', 'lecturer', 'John', 'Doe', 'sligo', 'sligo', '', 'Antrim', NULL, 'jhbev@aevv.dsavg', '071 123434', '', 'It Sligo', NULL, '52FF6E'),
(30, NULL, 'S40123', '7815696ecbf1c96e6894b779456d330e', 'students', '', '', '', '', '', 'Antrim', 'Ireland', 's@hotmail.com', '', '', 'It Sligo', 'Science', NULL),
(31, NULL, 'S100123', '7815696ecbf1c96e6894b779456d330e', 'students', '', '', '', '', '', 'Antrim', 'Ireland', 'dsg@hotmail.com', '', '', 'It Sligo', 'Science', NULL),
(32, NULL, 'S200123', 'f970e2767d0cfe75876ea857f92e319b', 'students', '', '', '', '', '', 'Antrim', 'Ireland', 'df@hotmail.com', '', '', 'It Sligo', 'Science', NULL),
(33, NULL, 'S300123', 'f970e2767d0cfe75876ea857f92e319b', 'students', '', '', '', '', '', 'Antrim', 'Ireland', 'wow@hotmail.com', '', '', 'It Sligo', 'Science', NULL),
(34, NULL, 'f', '8fa14cdd754f91cc6554c9e71929cce7', 'lecturer', '', '', '', '', '', 'Antrim', 'Ireland', '', '', '', 'It Sligo', NULL, NULL),
(35, NULL, 'd', '8277e0910d750195b448797616e091ad', 'lecturer', '', '', '', '', '', 'Antrim', 'Ireland', '', '', '', 'It Sligo', NULL, NULL),
(36, NULL, 'k', '8ce4b16b22b58894aa86c421e8759df3', 'lecturer', '', '', '', '', '', 'Antrim', 'Ireland', '', '', '', 'It Sligo', NULL, NULL),
(37, NULL, 'o', 'd95679752134a2d9eb61dbd7b91c4bcc', 'lecturer', '', '', '', '', '', 'Antrim', 'Ireland', '', '', '', 'It Sligo', NULL, NULL),
(38, NULL, 'lec', 'b4d4a7d37880103e6c90370e171edfd6', 'lecturer', '', '', '', '', '', 'Antrim', 'Ireland', '', '', '', 'It Sligo', NULL, NULL),
(39, NULL, 'q', '7694f4a66316e53c8cdd9d9954bd611d', 'lecturer', '', '', '', '', '', 'Antrim', 'Ireland', '', '', '', 'It Sligo', NULL, NULL),
(40, NULL, 'i', '865c0c0b4ab0e063e5caa3387c1a8741', 'students', '', '', '', '', '', 'Antrim', 'Ireland', '', '', '', 'It Sligo', 'Science', NULL),
(41, NULL, 'b', '92eb5ffee6ae2fec3ad71c777531578f', 'lecturer', '', '', '', '', '', 'Antrim', 'Ireland', '', '', '', 'It Sligo', NULL, NULL),
(42, NULL, 'p', '83878c91171338902e0fe0fb97a8c47a', 'lecturer', '', '', '', '', '', 'Antrim', 'Ireland', '', '', '', 'It Sligo', NULL, NULL),
(43, NULL, 'p', '83878c91171338902e0fe0fb97a8c47a', 'lecturer', '', '', '', '', '', 'Antrim', 'Ireland', '', '', '', 'It Sligo', NULL, NULL),
(44, NULL, 'w', 'f1290186a5d0b1ceab27f4e77c0c5d68', 'lecturer', '', '', '', '', '', 'Antrim', 'Ireland', '', '', '', 'It Sligo', NULL, NULL),
(45, NULL, 'w', 'f1290186a5d0b1ceab27f4e77c0c5d68', 'lecturer', '', '', '', '', '', 'Antrim', 'Ireland', '', '', '', 'It Sligo', NULL, NULL),
(46, NULL, 'v', '9e3669d19b675bd57058fd4664205d2a', 'lecturer', '', '', '', '', '', 'Antrim', 'Ireland', '', '', '', 'It Sligo', NULL, NULL),
(47, NULL, 'liam', '040b7cf4a55014e185813e0644502ea9', 'students', '', '', '', '', '', 'Antrim', 'Ireland', '', '', '', 'It Sligo', 'Science', NULL),
(48, NULL, 'liam0', '040b7cf4a55014e185813e0644502ea9', 'students', '', '', 'sligo', 'sligo', 'sligo', 'Sligo', 'Ireland', '', '', '', 'It Sligo', 'Science', NULL),
(1110, NULL, 's00123', '040b7cf4a55014e185813e0644502ea9', 'student', '', '', '', '', '', 'Antrim', 'Ireland', '', '', '', 'It Sligo', 'Science', NULL),
(1111, NULL, '', 'd41d8cd98f00b204e9800998ecf8427e', 'lecturer', '', '', '', '', '', 'Antrim', 'Ireland', '', '', '', '', NULL, NULL),
(1112, NULL, 'pickleo', '040b7cf4a55014e185813e0644502ea9', 'students', '', '', '', '', '', 'Antrim', 'Ireland', 'stephen@ymail.com', '', '', 'It Sligo', 'Science', NULL),
(1117, NULL, 'dfds', '7815696ecbf1c96e6894b779456d330e', 'lecturer', 'dsada', 'dasdsa', NULL, NULL, NULL, '', NULL, 'dasdas@ymail.com', NULL, NULL, NULL, NULL, NULL),
(1118, NULL, 'saf', '040b7cf4a55014e185813e0644502ea9', 'students', '', '', NULL, NULL, NULL, '', NULL, 'huy@ymail.com', NULL, NULL, NULL, NULL, NULL),
(1119, NULL, 'joj', 'a', 'lecturer', 'as', 'ds', NULL, NULL, NULL, '', NULL, 'sd@ymail.com', NULL, NULL, NULL, NULL, NULL),
(1120, NULL, 'fdk', '8ce4b16b22b58894aa86c421e8759df3', 'students', 'kl', 'kl', NULL, NULL, NULL, '', NULL, 'klkml', NULL, NULL, NULL, NULL, NULL),
(1121, NULL, 'userNme', 'abc', 'students', 'corm', 'hall', NULL, NULL, NULL, '', NULL, 'ch@ymail.com', NULL, NULL, NULL, NULL, NULL),
(1122, NULL, 'lectTest', '7b774effe4a349c6dd82ad4f4f21d34c', 'lecturer', 'iop', 'poi', NULL, NULL, NULL, '', NULL, 'ad@fd.f', NULL, NULL, NULL, NULL, NULL),
(1123, NULL, 'fdfd', '8fa14cdd754f91cc6554c9e71929cce7', 'students', 'as', 'fd', NULL, NULL, NULL, '', NULL, 'sds@fd.f', NULL, NULL, NULL, NULL, NULL),
(1124, NULL, 'fsf', '83878c91171338902e0fe0fb97a8c47a', 'students', 'uio', 'poi', NULL, NULL, NULL, '', NULL, 'sf@fdfd.fdf', NULL, NULL, NULL, NULL, NULL),
(1125, NULL, 'gf', '83878c91171338902e0fe0fb97a8c47a', 'lecturer', 'sfdsf', 'sfsf', NULL, NULL, NULL, '', NULL, 'sf@fdf.ddf', NULL, NULL, NULL, NULL, NULL),
(1126, NULL, 'vd', '7b774effe4a349c6dd82ad4f4f21d34c', 'lecturer', 'sfds', 'dsds', NULL, NULL, NULL, '', NULL, 'sfs@fd.ff', NULL, NULL, NULL, NULL, NULL),
(1127, NULL, 'L00123f', '7694f4a66316e53c8cdd9d9954bd611d', 'lecturer', 'sr', 'rs', NULL, NULL, NULL, '', NULL, 'sfdv@vg.vd', NULL, NULL, NULL, NULL, NULL);

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
