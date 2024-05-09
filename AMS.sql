SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
-- 
-- Database: `tms`
--  
DROP DATABASE IF EXISTS `tms`;
CREATE DATABASE IF NOT EXISTS `tms`;
USE `tms`;
-- Programmes  table
DROP TABLE IF EXISTS `Programme`;
CREATE TABLE IF NOT EXISTS `Programme` (
    `programmeCode` VARCHAR(5) UNIQUE NOT NULL,
    `programmeName` VARCHAR(255) NOT NULL
);
INSERT INTO `Programme` (`programmeCode`, `programmeName`)
VALUES ('NTA', 'National Technical Award'),
    (
        'BTCS',
        'Basic Technician Certificate in Statistics'
    ),
    (
        'BTCIT',
        'Basic Technician Certificate in Information Technology'
    ),
    ('TCS', 'Technician Certificate in Statistics'),
    (
        'TCIT',
        'Technician Certificate in Information Technology'
    ),
    ('ODS', 'Ordinary Diploma in Statistics'),
    (
        'ODIT',
        'Ordinary Diploma in Information Technology'
    ),
    ('BOS', 'Bachelor degree in Official Statistics'),
    ('BDS', 'Bachelor degree in Data Science'),
    (
        'BBSE',
        'Bachelor degree in Business Statistics and Economics'
    ),
    (
        'BASE',
        'Bachelor degree in Agricultural Statistics and Economics'
    );
-- User Table
DROP TABLE IF EXISTS `User`;
CREATE TABLE IF NOT EXISTS `User` (
    `UserID` INT PRIMARY KEY AUTO_INCREMENT,
    `username` VARCHAR(255) UNIQUE NOT NULL,
    `password` VARCHAR(255),
    `role` ENUM ('student', 'instructor') NOT NULL,
    `password_hash` VARCHAR(255) NOT NULL,
    `password_reset_token` VARCHAR(255),
    `verification_token` VARCHAR(255),
    `email` VARCHAR(255) UNIQUE NOT NULL,
    `email_verified` BOOL DEFAULT FALSE,
    `auth_key` VARCHAR(255) NOT NULL,
    `status` INT NOT NULL,
    `created_at` INT (11) NOT NULL,
    `updated_at` INT (11) NOT NULL
);
-- Admin Table
CREATE TABLE IF NOT EXISTS `Admin` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `username` VARCHAR(255) UNIQUE NOT NULL,
    `password` VARCHAR(255),
    `password_hash` VARCHAR(255) NOT NULL,
    `password_reset_token` VARCHAR(255),
    `verification_token` VARCHAR(255),
    `email` VARCHAR(255) UNIQUE NOT NULL,
    `email_verified` BOOL DEFAULT FALSE,
    `auth_key` VARCHAR(255) NOT NULL,
    `status` INT NOT NULL,
    `created_at` INT (11) NOT NULL,
    `updated_at` INT (11) NOT NULL
);
INSERT INTO `Admin` (
        `username`,
        `password_hash`,
        `verification_token`,
        `email`,
        `email_verified`,
        `auth_key`,
        `status`,
        `created_at`,
        `updated_at`
    )
VALUES (
        'JOHCRAZY',
        '$2y$13$z.ufNMlsFxk8thgJBJkqCO/R5qZIZCJNlkPAeUy.eK802zvl.5r6u',
        'G2wAmg8cOaFZpVyBmbrvpr3BaLu_k4Qg_1713101628',
        'jjuma8165@gmail.com',
        '0',
        '9pOPaRA1HfBc86BXU5QDK-8SgvFgjLTo',
        '10',
        '1713101628',
        '1713101628'
    );

-- Instructor  Table
DROP TABLE IF EXISTS `Instructor`;
CREATE TABLE IF NOT EXISTS `Instructor` (
    `InstructorID` INT PRIMARY KEY AUTO_INCREMENT,
    `fname` VARCHAR(25) NOT NULL,
    `mname` VARCHAR(25),
    `lname` VARCHAR(25) NOT NULL,
    `UserID` INT,
    FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`),
    `emailAddress` VARCHAR(64),
    `phoneNumber` VARCHAR(16),
    `profileImage` VARCHAR(255),
    `Status`  ENUM('Pending','Verified') NOT NULL
);

-- Courses Table
DROP TABLE IF EXISTS `Course`;
CREATE TABLE IF NOT EXISTS `Course` (
    `courseCode` VARCHAR(12) UNIQUE NOT NULL,
    `courseName` VARCHAR(255),
    `semester` ENUM ('I', 'II') NOT NULL,
    `year` ENUM ('I', 'II', 'III') NOT NULL,
    `courseInstructor` INT,
    FOREIGN KEY (`courseInstructor`) REFERENCES `Instructor` (`InstructorID`),
    `programmeCode` VARCHAR(5),
    FOREIGN KEY (`programmeCode`) REFERENCES `Programme` (`programmeCode`)
);
INSERT INTO `Course` (`courseCode`, `courseName`, `semester`, `year`, `courseInstructor`, `programmeCode`) VALUES
('ASU07209', 'Fundamental of microeconomics', 'II', 'I', NULL, 'BASE'),
('ASU07210', 'Design of Experiments', 'II', 'I', NULL, 'BASE'),
('ASU07211', 'Continuous Probability Distribution', 'II', 'I', NULL, 'BASE'),
('ASU07212', 'Price statistics and indices', 'II', 'I', NULL, 'BASE'),
('ASU07213', 'Data Analysis with SPSS', 'II', 'I', NULL, 'BASE'),
('ASU07214', 'Livestock Statistics', 'II', 'I', NULL, 'BASE'),
('ASU07215', 'Crop and Post-harvest Loss Statistics', 'II', 'I', NULL, 'BASE'),
('DSU07315', 'Basics of Big Data', 'I', 'II', NULL, 'BDS'),
('DSU07316', 'Software Engineering', 'I', 'II', NULL, 'BDS'),
('DSU07317', 'Data Analysis with R', 'I', 'II', NULL, 'BDS'),
('DSU07318', 'Statistical Inference', 'I', 'II', NULL, 'BDS'),
('DSU07319', 'Algorithms Design and Data Structures', 'I', 'II', NULL, 'BDS'),
('DSU07320', 'Machine Learning', 'I', 'II', NULL, 'BDS'),
('DSU07421', 'Data Communication and Computer Networks', 'II', 'II', NULL, 'BDS'),
('DSU07422', 'Programming With Python', 'II', 'II', NULL, 'BDS'),
('DSU07423', 'Object Oriented Programming With PHP', 'II', 'II', NULL, 'BDS'),
('DSU07424', 'Big Data Technologies', 'II', 'II', NULL, 'BDS'),
('DSU07425', 'Data Mining Techniques', 'II', 'II', NULL, 'BDS'),
('DSU07426', 'Time Series and Forecasting', 'II', 'II', NULL, 'BDS'),
('DSU07427', 'Field and Practical Training', 'II', 'II', NULL, 'BDS');




-- Students Table
DROP TABLE IF EXISTS `Student`;
CREATE TABLE IF NOT EXISTS `Student` (
    `StudentID` INT PRIMARY KEY AUTO_INCREMENT,
    `fname` VARCHAR(25) NOT NULL,
    `mname` VARCHAR(25),
    `lname` VARCHAR(25) NOT NULL,
    `userID` INT,
    FOREIGN KEY (`userID`) REFERENCES `User` (`UserID`),
    `session` ENUM ('A', 'B', 'C', 'D', 'E'),
    `regNo` VARCHAR(20) UNIQUE,
    `phoneNumber` VARCHAR(16),
    `emailAddress` VARCHAR(64) UNIQUE,
    `gender` ENUM ('Male', 'Female'),
    `profileImage` VARCHAR(255),
    `programmeCode` VARCHAR(5) NOT NULL,
    FOREIGN KEY (`programmeCode`) REFERENCES `Programme` (`programmeCode`),
    `year` ENUM ('I', 'II', 'III') NOT NULL,
    `semester` ENUM ('I', 'II') NOT NULL
);

DROP TABLE IF EXISTS `Group`;
CREATE TABLE IF NOT EXISTS `Group` (
    `GroupID` INT PRIMARY KEY AUTO_INCREMENT,
    `GroupNO` INT,
    `groupName` VARCHAR(64),
    `StudentID` INT,
    FOREIGN KEY(`StudentID`) REFERENCES `Student` (`StudentID`),
    `courseCode` VARCHAR(12),
    FOREIGN KEY (`courseCode`) REFERENCES `Course` (`courseCode`)
);
-- Assignments Table
DROP TABLE IF EXISTS `Assignment`;
CREATE TABLE IF NOT EXISTS `Assignment` (
    `AssignmentID` INT PRIMARY KEY AUTO_INCREMENT,
    `courseCode` VARCHAR(12) NOT NULL,
    FOREIGN KEY (`courseCode`) REFERENCES `Course` (`courseCode`),
    `assignment` ENUM ('Individual Assignment', 'Group Assignment') NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `AssignmentContent` longtext DEFAULT NULL,
    `description` LONGTEXT,
    `fileURL` VARCHAR(255),
    `assignedDate` DATETIME,
    `submissionDate` DATETIME,
    `marks` INT NOT NULL,
    `status` ENUM ('Pending', 'Assigned')
);

-- Submissions Table
DROP TABLE IF EXISTS `Submission`;
CREATE TABLE IF NOT EXISTS `Submission` (
    `SubmissionID` INT PRIMARY KEY AUTO_INCREMENT,
    `AssignmentID` INT,
    FOREIGN KEY (`AssignmentID`) REFERENCES `Assignment` (`AssignmentID`),
    `groupID` INT,
    FOREIGN KEY (`groupID`) REFERENCES `Group` (`groupID`),
    `StudentID` INT,
    FOREIGN KEY (`StudentID`) REFERENCES `Student` (`StudentID`),
    `SubmissionContent` longtext DEFAULT NULL,
    `submissionDate` DATETIME,
    `fileURL` VARCHAR(255),
    `score` INT,
    `AssignmentStatus` ENUM ('Pending', 'Submitted'),
    `SubmissionStatus` ENUM ('Marked', 'Not Marked')
);
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;