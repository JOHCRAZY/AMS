SET
    SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET
    AUTOCOMMIT = 0;

START TRANSACTION;

SET
    time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

/*!40101 SET NAMES utf8mb4 */;

-- 
-- Database: `tms`
--  
CREATE DATABASE IF NOT EXISTS `tms`;

USE `tms`;

-- Programmes  table
DROP TABLE IF EXISTS `Programme`;

CREATE TABLE
    IF NOT EXISTS `Programme` (
        `programmeCode` VARCHAR(5) UNIQUE NOT NULL,
        `programmeName` VARCHAR(255) NOT NULL
    );

INSERT INTO
    `Programme` (`programmeCode`, `programmeName`)
VALUES
    ('NTA', 'National Technical Award'),
    ('BTCS', 'Basic Technician Certificate in Statistics'),
    ('BTCIT','Basic Technician Certificate in Information Technology'),
    ('TCS', 'Technician Certificate in Statistics'),
    ('TCIT','Technician Certificate in Information Technology'),
    ('ODS', 'Ordinary Diploma in Statistics'),
    ('ODIT','Ordinary Diploma in Information Technology' ),
    ('BOS', 'Bachelor degree in Official Statistics'),
    ('BDS', 'Bachelor degree in Data Science'),
    ('BBSE','Bachelor degree in Business Statistics and Economics'),
    ('BASE','Bachelor degree in Agricultural Statistics and Economics');

-- User Table
CREATE TABLE
    IF NOT EXISTS `User` (
        `UserID` INT PRIMARY KEY AUTO_INCREMENT,
        `username` VARCHAR(255) UNIQUE NOT NULL,
        `password` VARCHAR(255),
        `role` ENUM ('student', 'instructor') NOT NULL,
        `password_hash` VARCHAR(255) NOT NULL,
        `password_reset_token` VARCHAR(255),
        `verification_token` VARCHAR(255),
        `email`  VARCHAR(255) UNIQUE NOT NULL,
        `email_verified` BOOL DEFAULT FALSE,
        `auth_key` VARCHAR(255) NOT NULL,
        `status` INT NOT NULL,
        `created_at` INT(11) NOT NULL,
        `updated_at` INT(11) NOT NULL
    );

-- Admin Table
-- CREATE TABLE
--     IF NOT EXISTS `Admin` (
--         `id` INT PRIMARY KEY AUTO_INCREMENT,
--         `username` VARCHAR(255) UNIQUE NOT NULL,
--         `password` VARCHAR(255),
--         `password_hash` VARCHAR(255) NOT NULL,
--         `password_reset_token` VARCHAR(255),
--         `verification_token` VARCHAR(255),
--         `email`  VARCHAR(255) UNIQUE NOT NULL,
--         `email_verified` BOOL DEFAULT FALSE,
--         `auth_key` VARCHAR(255) NOT NULL,
--         `status` INT NOT NULL,
--         `created_at` INT(11) NOT NULL,
--         `updated_at` INT(11) NOT NULL
--     );

-- Instructor  Table
DROP TABLE IF EXISTS `Instructor`;

CREATE TABLE IF NOT EXISTS `Instructor` (
    `InstructorID` INT PRIMARY KEY AUTO_INCREMENT,
    `fname` VARCHAR(25) NOT NULL,
    `mname` VARCHAR(25),
    `lname` VARCHAR(25) NOT NULL,
    -- `Email` VARCHAR(64) NOT NULL, dropped
    `UserID` INT,
    FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`),
    `emailAddress` VARCHAR(64),
    `phoneNumber` VARCHAR(16),
    `profileImage` VARCHAR(255) DEFAULT 'uploads/eastc.png'
);

-- Courses Table
DROP TABLE IF EXISTS `Course`;

CREATE TABLE IF NOT EXISTS `Course` (
    `courseCode` VARCHAR(12) UNIQUE NOT NULL,
    `courseName` VARCHAR(255),
    `semester` ENUM ('I','II') NOT NULL,
    `year` ENUM ('I','II','III') NOT NULL,
    `courseInstructor` INT,
    FOREIGN KEY (`courseInstructor`) REFERENCES `Instructor` (`InstructorID`),
    `programmeCode` VARCHAR(5),
    FOREIGN KEY (`programmeCode`) REFERENCES `Programme` (`programmeCode`)
);

INSERT INTO `Course`(`courseCode`,`semester`,`year`,`courseName`,`programmeCode`) VALUES(
    ('DSU07315','I','II','Basics of Big Data','BDS'),
    ('DSU07316','I','II','Software Engineering','BDS'),
    ('DSU07317','I','II','Data Analysis with R','BDS'),
    ('DSU07318','I','II','Statistical Inference','BDS'),
    ('DSU07319','I','II','Algorithms Design and Data Structures','BDS'),
    ('DSU07320','I','II','Machine Learning','BDS'),
    ('DSU07421','II','II','Data Communication and Computer Networks','BDS'),
    ('DSU07422','II','II','Programming With Python','BDS'),
    ('DSU07423','II','II','Object Oriented Programming With PHP','BDS'),
    ('DSU07424','II','II','Big Data Technologies','BDS'),
    ('DSU07425','II','II','Data Mining Techniques','BDS'),
    ('DSU07426','II','II','Time Series and Forecasting','BDS'),
    ('DSU07427','II','II','Field and Practical Training','BDS')

    
);
-- Groups  table
DROP TABLE IF EXISTS `Group`;

CREATE TABLE IF NOT EXISTS `Group` (
    `groupID` INT NOT NULL AUTO_INCREMENT,
    `groupNo` INT NOT NULL,
    `courseCode` VARCHAR(12) NOT NULL,
    `groupName` VARCHAR(64),
    PRIMARY KEY (`groupID`),
    FOREIGN KEY (`courseCode`) REFERENCES `Course` (`courseCode`)
);

-- Students Table
DROP TABLE IF EXISTS `Student`;

CREATE TABLE IF NOT EXISTS `Student` (
    `StudentID` INT PRIMARY KEY AUTO_INCREMENT,
    `fname` VARCHAR(25) NOT NULL,
    `mname` VARCHAR(25),
    `lname` VARCHAR(25) NOT NULL,
    `userID` INT,
    FOREIGN KEY (`userID`) REFERENCES `User` (`UserID`),
    `session` ENUM ('A','B','C','D','E'),
    `regNo` VARCHAR(15) UNIQUE,
    `phoneNumber` VARCHAR(16),
    `emailAddress` VARCHAR(64) UNIQUE,
    `gender` ENUM ('Male', 'Female'),
    `profileImage` VARCHAR(255) DEFAULT 'uploads/eastc.png',
    `groupID` INT,
    FOREIGN KEY (`groupID`) REFERENCES `Group` (`groupID`),
    `courseCode` VARCHAR(12),
    FOREIGN KEY (`courseCode`) REFERENCES `Course` (`courseCode`),
    `programmeCode` VARCHAR(5) NOT NULL,
    FOREIGN KEY (`ProgrammeCode`) REFERENCES `Programme` (`ProgrammeCode`),
    `year` ENUM ('I', 'II', 'III') NOT NULL,
    `semester` ENUM ('I', 'II') NOT NULL
);

-- Assignments Table
DROP TABLE IF EXISTS `Assignment`;

CREATE TABLE IF NOT EXISTS `Assignment` (
    `AssignmentID` INT PRIMARY KEY AUTO_INCREMENT,
    `courseCode` VARCHAR(12) NOT NULL,
    FOREIGN KEY (`courseCode`) REFERENCES `Course` (`courseCode`),
    `assignment` ENUM ('Individual Assignment', 'Group Assignment') NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `content` TEXT,
    `description` TEXT,
    `fileURL` VARCHAR(255),
    `assignedDate` DATETIME,
    `submissionDate` DATETIME,
    `marks` INT NOT NULL,
    `status` ENUM ('Pending', 'Submitted')
);
-- Submissions Table
DROP TABLE IF EXISTS `Submission`;

CREATE TABLE IF NOT EXISTS `Submission` (
    `SubmissionID` INT PRIMARY KEY AUTO_INCREMENT,
    `assignmentID` INT,
    FOREIGN KEY (`assignmentID`) REFERENCES `Assignment` (`AssignmentID`),
    `groupID` INT,
    FOREIGN KEY (`GroupID`) REFERENCES `Group` (`GroupID`),
    `StudentID` INT,
    FOREIGN KEY (`StudentID`) REFERENCES `User` (`UserID`),
    `content` TEXT,
    `submissionDate` DATETIME NOT NULL,
    `fileURL` VARCHAR(255)
);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;