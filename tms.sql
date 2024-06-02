-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 06, 2024 at 09:10 PM
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
-- Database: `tms`
--
DROP DATABASE IF EXISTS `tms`;
CREATE DATABASE IF NOT EXISTS `tms`;
USE `tms`;

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified` tinyint(1) DEFAULT 0,
  `auth_key` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`id`, `username`, `password`, `password_hash`, `password_reset_token`, `verification_token`, `email`, `email_verified`, `auth_key`, `status`, `created_at`, `updated_at`) VALUES
(1, 'JOHCRAZY', NULL, '$2y$13$z.ufNMlsFxk8thgJBJkqCO/R5qZIZCJNlkPAeUy.eK802zvl.5r6u', NULL, 'G2wAmg8cOaFZpVyBmbrvpr3BaLu_k4Qg_1713101628', 'jjuma8165@gmail.com', 0, '9pOPaRA1HfBc86BXU5QDK-8SgvFgjLTo', 10, 1713101628, 1713101628);

-- --------------------------------------------------------

--
-- Table structure for table `Assignment`
--

CREATE TABLE `Assignment` (
  `AssignmentID` int(11) NOT NULL,
  `courseCode` varchar(12) NOT NULL,
  `assignment` enum('Individual Assignment','Group Assignment') NOT NULL,
  `title` varchar(255) NOT NULL,
  `AssignmentContent` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `fileURL` varchar(255) DEFAULT NULL,
  `assignedDate` datetime DEFAULT current_timestamp(),
  `submissionDate` datetime DEFAULT NULL,
  `marks` int(11) NOT NULL,
  `status` enum('Pending','Assigned') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Assignment`
--

INSERT INTO `Assignment` (`AssignmentID`, `courseCode`, `assignment`, `title`, `AssignmentContent`, `description`, `fileURL`, `assignedDate`, `submissionDate`, `marks`, `status`) VALUES
(1, 'DSU07315', 'Individual Assignment', 'ASSIGNMENT 1', NULL, 'Explain The detrimental Effects of ChatGPT.', NULL, '2024-04-01 13:01:53', '2024-04-30 12:41:22', 100, 'Assigned'),
(6, 'DSU07316', 'Individual Assignment', 'New Assignment', NULL, 'TRIAL ASSIGNMENT', NULL, '2024-04-30 13:24:37', '2024-05-03 19:35:12', 5, 'Assigned'),
(7, 'DSU07315', 'Individual Assignment', 'JOHCRAZY ASSIGNMENT', NULL, 'GOOGLE.COM', NULL, '2024-04-30 15:57:52', '2024-05-03 05:00:21', 20, 'Assigned'),
(8, 'DSU07315', 'Individual Assignment', 'JOHCRAZY ASSIGNMENT2', NULL, '1234567890-=', NULL, '2024-04-30 16:41:17', '2024-05-03 05:00:21', 20, 'Assigned'),
(9, 'DSU07315', 'Individual Assignment', 'JOHCRAZY ASSIGNMENT2', NULL, '<?php $form = ActiveForm::begin([\'action\' => [\'submit\', \'AssignmentID\' => $model->AssignmentID, \'StudentID\' => Student::find()->where([\'userID\' => yii::$app->user->id])->one()->StudentID], \'method\' => \'post\']) ?>\r\n            <?= Html::submitButton(Yii::t(\'app\', \'Submit\'), [\'class\' => \'btn btn-lg btn-primary mt-4 mb-1 w-10\']) ?>\r\n        <?php ActiveForm::end(); ?>', NULL, '2024-04-30 16:46:48', '2024-05-03 14:10:50', 20, 'Assigned'),
(10, 'DSU07316', 'Individual Assignment', 'PENDING ASSIGNMENT', NULL, 'AWECYGVHBJK XCZLKNVXCZ N VXC VJCV X NCV JVC ', NULL, '2024-05-01 02:27:43', '2024-05-11 19:55:18', 100, 'Assigned'),
(11, 'ASU07215', 'Individual Assignment', 'non', NULL, 'yfckggkuvgkugkuggvv   j  jvjjvvgkjv  v vu vkuv rd tvyb yog y yuyvyvvy', NULL, '2024-05-05 05:15:26', '2024-05-01 06:30:53', 12, 'Assigned');

-- --------------------------------------------------------

--
-- Table structure for table `Course`
--

CREATE TABLE `Course` (
  `courseCode` varchar(12) NOT NULL,
  `courseName` varchar(255) DEFAULT NULL,
  `semester` enum('I','II') NOT NULL,
  `year` enum('I','II','III') NOT NULL,
  `courseInstructor` int(11) DEFAULT NULL,
  `programmeCode` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Course`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `Group`
--

-- --------------------------------------------------------

--
-- Table structure for table `Instructor`
--

CREATE TABLE `Instructor` (
  `InstructorID` int(11) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `mname` varchar(25) DEFAULT NULL,
  `lname` varchar(25) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `CourseCode` varchar(12) NOT NULL,
  `emailAddress` varchar(64) DEFAULT NULL,
  `phoneNumber` varchar(16) DEFAULT NULL,
  `profileImage` varchar(255) DEFAULT 'uploads/eastc.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Instructor`
--

INSERT INTO `Instructor` (`InstructorID`, `fname`, `mname`, `lname`, `UserID`, `CourseCode`, `emailAddress`, `phoneNumber`, `profileImage`) VALUES
(1, 'GRACE', 'ABIMAEL', 'KILASI', 3, 'ASU07215', 'gracekilasi5@gmail.com', '0754414123', 'uploads/iconmonstr-user-20.png'),
(2, 'Joseph', 'Juma', 'Magiha', 1, '', 'jjuma8165@gmail.com', '0783610339', '');

-- --------------------------------------------------------

--
-- Table structure for table `Programme`
--

CREATE TABLE `Programme` (
  `programmeCode` varchar(5) NOT NULL,
  `programmeName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Programme`
--

INSERT INTO `Programme` (`programmeCode`, `programmeName`) VALUES
('BASE', 'Bachelor degree in Agricultural Statistics and Economics'),
('BBSE', 'Bachelor degree in Business Statistics and Economics'),
('BDS', 'Bachelor degree in Data Science'),
('BOS', 'Bachelor degree in Official Statistics'),
('BTCIT', 'Basic Technician Certificate in Information Technology'),
('BTCS', 'Basic Technician Certificate in Statistics'),
('NTA', 'National Technical Award'),
('ODIT', 'Ordinary Diploma in Information Technology'),
('ODS', 'Ordinary Diploma in Statistics'),
('TCIT', 'Technician Certificate in Information Technology'),
('TCS', 'Technician Certificate in Statistics');

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

CREATE TABLE `Student` (
  `StudentID` int(11) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `mname` varchar(25) DEFAULT NULL,
  `lname` varchar(25) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `session` enum('A','B','C','D','E') DEFAULT NULL,
  `regNo` varchar(20) DEFAULT NULL,
  `phoneNumber` varchar(16) DEFAULT NULL,
  `emailAddress` varchar(64) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `profileImage` varchar(255) DEFAULT 'uploads/iconmonstr-user-20.png',
  `programmeCode` varchar(5) NOT NULL,
  `year` enum('I','II','III') NOT NULL,
  `semester` enum('I','II') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Student`
--

INSERT INTO `Student` (`StudentID`, `fname`, `mname`, `lname`, `userID`, `session`, `regNo`, `phoneNumber`, `emailAddress`, `gender`, `profileImage`, `groupNo`, `programmeCode`, `year`, `semester`) VALUES
(1, 'GRACE', 'ABIMAEL', 'KILASI', 3, 'A', 'EASTC/BDTS/23/00380', '0754414123', 'gracekilasi5@gmail.com', 'Female', '', NULL, 'BDS', 'II', 'II'),
(10, 'Joseph', 'Juma', 'Magiha', 6, 'A', 'EASTC/BDTS/23/00316', '0783610339', 'jjuma8165@gmail.com', 'Male', 'uploads/Screenshot_20240414-172355.png', NULL, 'BASE', 'III', 'II'),
(12, 'Joseph', 'Juma', 'Magiha', 1, 'B', 'EASTC/BDTS/23/00315', '0783610339', 'joseph.magiha@eastc.ac.tz', 'Male', 'uploads/chrome_qrcode_1714305259278.png', NULL, 'BDS', 'II', 'II'),
(13, 'Hello ', 'World ', 'Programme ', 7, 'E', 'EASTC/BDTS/23/00318', '0783610339', 'Hello@gmail.com', 'Male', 'uploads/Screenshot_20240414-172355.png', NULL, 'BDS', 'III', 'II');

-- --------------------------------------------------------

--
-- Table structure for table `Submission`
--

CREATE TABLE `Submission` (
  `SubmissionID` int(11) NOT NULL,
  `AssignmentID` int(11) DEFAULT NULL,
  `groupID` int(11) DEFAULT NULL,
  `StudentID` int(11) DEFAULT NULL,
  `SubmissionContent` longtext DEFAULT NULL,
  `submissionDate` datetime DEFAULT current_timestamp(),
  `fileURL` varchar(255) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `AssignmentStatus` enum('Pending','Submitted') DEFAULT NULL,
  `SubmissionStatus` enum('Marked','Not Marked') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Submission`
--

INSERT INTO `Submission` (`SubmissionID`, `AssignmentID`, `groupID`, `StudentID`, `SubmissionContent`, `submissionDate`, `fileURL`, `score`, `AssignmentStatus`, `SubmissionStatus`) VALUES
(3, 6, NULL, 12, '<div style=\"color: rgb(204, 204, 204); background-color: rgb(31, 31, 31); font-family: &quot;Droid Sans Mono&quot;, &quot;monospace&quot;, monospace; font-size: 14px; line-height: 19px; white-space: pre;\"><pre><pre style=\"text-align: left; \"><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(212, 212, 212);\">$</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(156, 220, 254);\">model</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(212, 212, 212);\"> </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(212, 212, 212);\">=</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(212, 212, 212);\"> </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(156, 220, 254);\">Assignment</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(212, 212, 212);\">::</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(220, 220, 170);\">find</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(212, 212, 212);\">()<br></span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">        </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">-&gt;</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(220, 220, 170);\">joinWith</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">(</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(206, 145, 120);\">\'submissions\'</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">)<br></span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">        </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">-&gt;</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(220, 220, 170);\">where</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">([</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(206, 145, 120);\">\'Submission.AssignmentID\'</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\"> </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">=&gt;</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\"> </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">$</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(156, 220, 254);\">AssignmentID</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">,</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(206, 145, 120);\">\'Assignment.AssignmentID\'</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\"> </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">=&gt;</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\"> </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">$</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(156, 220, 254);\">AssignmentID</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">])</span><br><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #9cdcfe;\">Yii</span><span style=\"color: #d4d4d4;\">::</span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">app</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">session</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #dcdcaa;\">setFlash</span><span style=\"color: #d4d4d4;\">(</span><span style=\"color: #ce9178;\">\'success\'</span><span style=\"color: #d4d4d4;\">, </span><span style=\"color: #ce9178;\">\'Successfully Saved Assignment.\'</span><span style=\"color: #d4d4d4;\">);</span><span style=\"color: rgb(106, 153, 85);\">// Model saved successfully</span><br><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #9cdcfe;\">Yii</span><span style=\"color: #d4d4d4;\">::</span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">app</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">session</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #dcdcaa;\">setFlash</span><span style=\"color: #d4d4d4;\">(</span><span style=\"color: #ce9178;\">\'success\'</span><span style=\"color: #d4d4d4;\">, </span><span style=\"color: #ce9178;\">\'Successfully Saved Assignment.\'</span><span style=\"color: #d4d4d4;\">);</span></pre></pre><pre style=\"text-align: left; \"><span style=\"color: #d4d4d4;\">        </span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #dcdcaa;\">one</span><span style=\"color: #d4d4d4;\">();</span>// Model saved successfully</pre></div>', '2024-04-30 14:04:00', 'prefix_1714478142.pdf', 20, 'Submitted', 'Marked'),
(21, 7, NULL, 12, '<div style=\"background-color: rgb(31, 31, 31); line-height: 19px;\"><pre style=\"color: rgb(204, 204, 204); font-family: &quot;Droid Sans Mono&quot;, &quot;monospace&quot;, monospace; font-size: 14px; white-space: pre;\"><pre style=\"text-align: left; color: rgb(204, 204, 204); font-family: &quot;Droid Sans Mono&quot;, &quot;monospace&quot;, monospace; font-size: 14px; white-space: pre;\"><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(212, 212, 212);\"> </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(86, 156, 214);\">public</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(212, 212, 212);\"> </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(86, 156, 214);\">function</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(212, 212, 212);\"> </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(220, 220, 170);\">actionDo</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(212, 212, 212);\">(</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(212, 212, 212);\">$</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(156, 220, 254);\">AssignmentID</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(212, 212, 212);\">,</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(212, 212, 212);\">$</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(156, 220, 254);\">StudentID</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(212, 212, 212);\"> </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(212, 212, 212);\">=</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(212, 212, 212);\"> </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(86, 156, 214);\">null</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(212, 212, 212);\">,</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(212, 212, 212);\">$</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(156, 220, 254);\">Submit</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(212, 212, 212);\"> </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(212, 212, 212);\">=</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(212, 212, 212);\"> </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(86, 156, 214);\">false</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(212, 212, 212);\">)<br></span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">    {<br></span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">        </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">$</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(156, 220, 254);\">model</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\"> </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">=</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\"> </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">$</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(156, 220, 254);\">this</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">-&gt;</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(220, 220, 170);\">findModel</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">(</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">$</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(156, 220, 254);\">AssignmentID</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">);<br></span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">       <br></span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">        </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">$</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(156, 220, 254);\">SubmissionModel</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\"> </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">=</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\"> </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(156, 220, 254);\">Submission</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">::</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(220, 220, 170);\">find</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">()</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">-&gt;</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(220, 220, 170);\">where</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">([</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(206, 145, 120);\">\'AssignmentID\'</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\"> </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">=&gt;</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\"> </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">$</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(156, 220, 254);\">AssignmentID</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">,</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(206, 145, 120);\">\'StudentID\'</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\"> </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">=&gt;</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\"> </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">$</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(156, 220, 254);\">StudentID</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">])</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">-&gt;</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(220, 220, 170);\">one</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">();<br></span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">        </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(197, 134, 192);\">if</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\"> (</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">$</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(156, 220, 254);\">StudentID</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\"> </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">!=</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\"> </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(86, 156, 214);\">null</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\"> </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">&amp;&amp;</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\"> </span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">$</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em; color: rgb(156, 220, 254);\">SubmissionModel</span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">) {<br></span><span style=\"font-family: var(--bs-font-monospace); font-size: 0.875em;\">            </span><font color=\"#cccccc\" face=\"Droid Sans Mono, monospace, monospace\"><span style=\"font-size: 14px; white-space: pre;\"><br></span></font><span style=\"color: #d4d4d4;\">            </span><span style=\"color: #c586c0;\">if</span><span style=\"color: #d4d4d4;\">(</span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">SubmissionModel</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">AssignmentStatus</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">==</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #ce9178;\">\'Submitted\'</span><span style=\"color: #d4d4d4;\"> ){</span><br><span style=\"color: #d4d4d4;\">                </span><span style=\"color: #9cdcfe;\">Yii</span><span style=\"color: #d4d4d4;\">::</span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">app</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">session</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #dcdcaa;\">setFlash</span><span style=\"color: #d4d4d4;\">(</span><span style=\"color: #ce9178;\">\'danger\'</span><span style=\"color: #d4d4d4;\">, </span><span style=\"color: #ce9178;\">\'Submitted Assignment Cant</span><span style=\"color: #ce9178;\">\\\'</span><span style=\"color: #ce9178;\">t be Edited.\'</span><span style=\"color: #d4d4d4;\">);<br></span><span style=\"color: #d4d4d4;\">                </span><span style=\"color: #c586c0;\">return</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">this</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #dcdcaa;\">redirect</span><span style=\"color: #d4d4d4;\">([</span><span style=\"color: #ce9178;\">\'view\'</span><span style=\"color: #d4d4d4;\">, </span><span style=\"color: #ce9178;\">\'AssignmentID\'</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">=&gt;</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">model</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">AssignmentID</span><span style=\"color: #d4d4d4;\">]);<br></span><span style=\"color: #d4d4d4;\">            }<br></span><span style=\"color: #d4d4d4;\">            </span><span style=\"color: #6a9955;\">//throw new NotFoundHttpException(\'The requested page does not exist.\');<br></span><span style=\"color: #d4d4d4;\">            </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">model</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">AssignmentContent</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">=</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">SubmissionModel</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">SubmissionContent</span><span style=\"color: #d4d4d4;\">;<br></span><span style=\"color: #d4d4d4;\">            </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">model</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">fileURL</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">=</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">SubmissionModel</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">fileURL</span><span style=\"color: #d4d4d4;\">;<br></span><span style=\"color: #d4d4d4;\">        }</span><br><span style=\"color: #d4d4d4;\">        </span><span style=\"color: #c586c0;\">if</span><span style=\"color: #d4d4d4;\"> (</span><span style=\"color: #9cdcfe;\">Yii</span><span style=\"color: #d4d4d4;\">::</span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">app</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">request</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">isPost</span><span style=\"color: #d4d4d4;\">) {<br></span><span style=\"color: #d4d4d4;\">            </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">model</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #dcdcaa;\">load</span><span style=\"color: #d4d4d4;\">(</span><span style=\"color: #9cdcfe;\">Yii</span><span style=\"color: #d4d4d4;\">::</span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">app</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">request</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #dcdcaa;\">post</span><span style=\"color: #d4d4d4;\">());</span><br><span style=\"color: #d4d4d4;\">            </span><span style=\"color: #6a9955;\">// Get the uploaded file instance<br></span><span style=\"color: #d4d4d4;\">            </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">model</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">file</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">=</span><span style=\"color: #d4d4d4;\"> \\</span><span style=\"color: #9cdcfe;\">yii</span><span style=\"color: #d4d4d4;\">\\</span><span style=\"color: #9cdcfe;\">web</span><span style=\"color: #d4d4d4;\">\\</span><span style=\"color: #9cdcfe;\">UploadedFile</span><span style=\"color: #d4d4d4;\">::</span><span style=\"color: #dcdcaa;\">getInstance</span><span style=\"color: #d4d4d4;\">(</span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">model</span><span style=\"color: #d4d4d4;\">, </span><span style=\"color: #ce9178;\">\'file\'</span><span style=\"color: #d4d4d4;\">);</span><br><span style=\"color: #d4d4d4;\">            </span><span style=\"color: #6a9955;\">// Validate and save the model<br></span><span style=\"color: #d4d4d4;\">            </span><span style=\"color: #c586c0;\">if</span><span style=\"color: #d4d4d4;\"> (</span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">model</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #dcdcaa;\">validate</span><span style=\"color: #d4d4d4;\">()) {<br></span><span style=\"color: #d4d4d4;\">                </span><span style=\"color: #c586c0;\">if</span><span style=\"color: #d4d4d4;\"> (</span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">model</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">file</span><span style=\"color: #d4d4d4;\">) {<br></span><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #6a9955;\">// Delete the existing file, if any<br></span><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #c586c0;\">if</span><span style=\"color: #d4d4d4;\"> (</span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">model</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">fileURL</span><span style=\"color: #d4d4d4;\">) {<br></span><span style=\"color: #d4d4d4;\">                        </span><span style=\"color: #9cdcfe;\">unlink</span><span style=\"color: #d4d4d4;\">(</span><span style=\"color: #9cdcfe;\">Yii</span><span style=\"color: #d4d4d4;\">::</span><span style=\"color: #dcdcaa;\">getAlias</span><span style=\"color: #d4d4d4;\">(</span><span style=\"color: #ce9178;\">\'@webroot\'</span><span style=\"color: #d4d4d4;\">) </span><span style=\"color: #d4d4d4;\">.</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #ce9178;\">\'/attachments/\'</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">.</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">model</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">fileURL</span><span style=\"color: #d4d4d4;\">);<br></span><span style=\"color: #d4d4d4;\">                    }</span><br><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #6a9955;\">// Generate a unique filename<br></span><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">fileName</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">=</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #ce9178;\">\'prefix_\'</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">.</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #9cdcfe;\">time</span><span style=\"color: #d4d4d4;\">() </span><span style=\"color: #d4d4d4;\">.</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #ce9178;\">\'.\'</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">.</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">model</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">file</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">extension</span><span style=\"color: #d4d4d4;\">;</span><br><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #6a9955;\">// Move the uploaded file to a directory<br></span><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">model</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">file</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #dcdcaa;\">saveAs</span><span style=\"color: #d4d4d4;\">(</span><span style=\"color: #9cdcfe;\">Yii</span><span style=\"color: #d4d4d4;\">::</span><span style=\"color: #dcdcaa;\">getAlias</span><span style=\"color: #d4d4d4;\">(</span><span style=\"color: #ce9178;\">\'@webroot/attachments/\'</span><span style=\"color: #d4d4d4;\">) </span><span style=\"color: #d4d4d4;\">.</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">fileName</span><span style=\"color: #d4d4d4;\">);</span><br><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #6a9955;\">// Save the filename to the model attribute<br></span><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">model</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">fileURL</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">=</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">fileName</span><span style=\"color: #d4d4d4;\">;<br></span><span style=\"color: #d4d4d4;\">                }</span><br><span style=\"color: #d4d4d4;\">                </span><span style=\"color: #c586c0;\">if</span><span style=\"color: #d4d4d4;\"> (</span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">model</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #dcdcaa;\">save</span><span style=\"color: #d4d4d4;\">()) {<br></span><span style=\"color: #d4d4d4;\">                    <br></span><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #c586c0;\">if</span><span style=\"color: #d4d4d4;\">(</span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">StudentID</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">!=</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #569cd6;\">null</span><span style=\"color: #d4d4d4;\">){<br></span><span style=\"color: #d4d4d4;\">                        </span><span style=\"color: #c586c0;\">if</span><span style=\"color: #d4d4d4;\">(</span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">SubmissionModel</span><span style=\"color: #d4d4d4;\">){<br></span><span style=\"color: #d4d4d4;\">                            </span><span style=\"color: #6a9955;\">//$SubmissionModel = new Submission();</span><br><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #6a9955;\">//$SubmissionModel-&gt;submissionDate = date(\'Y-m-d H:m\');<br></span><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">SubmissionModel</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">AssignmentID</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">=</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">model</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">AssignmentID</span><span style=\"color: #d4d4d4;\">;<br></span><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">SubmissionModel</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">AssignmentStatus</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">=</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">Submit</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">?</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #ce9178;\">\'Submitted\'</span><span style=\"color: #d4d4d4;\">:</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #ce9178;\">\'Pending\'</span><span style=\"color: #d4d4d4;\">;<br></span><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #6a9955;\">//$SubmissionModel-&gt;SubmissionStatus = \'Not Marked\';<br></span><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #6a9955;\">//$SubmissionModel-&gt;submissionDate = date(\'Y-m-d H:m\');<br></span><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">SubmissionModel</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">SubmissionContent</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">=</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">model</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">AssignmentContent</span><span style=\"color: #d4d4d4;\">;<br></span><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">SubmissionModel</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">fileURL</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">=</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">model</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">fileURL</span><span style=\"color: #d4d4d4;\">;<br></span><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">SubmissionModel</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">StudentID</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">=</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">StudentID</span><span style=\"color: #d4d4d4;\">;<br></span><span style=\"color: #d4d4d4;\">                        }</span><span style=\"color: #c586c0;\">else</span><span style=\"color: #d4d4d4;\">{<br></span><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">SubmissionModel</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">=</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">new</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #4ec9b0;\">Submission</span><span style=\"color: #d4d4d4;\">();</span><br><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #6a9955;\">//$SubmissionModel-&gt;submissionDate = date(\'Y-m-d H:m\');<br></span><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">SubmissionModel</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">AssignmentID</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">=</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">model</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">AssignmentID</span><span style=\"color: #d4d4d4;\">;<br></span><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">SubmissionModel</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">AssignmentStatus</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">=</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">Submit</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">?</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #ce9178;\">\'Submitted\'</span><span style=\"color: #d4d4d4;\">:</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #ce9178;\">\'Pending\'</span><span style=\"color: #d4d4d4;\">;<br></span><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #6a9955;\">//$SubmissionModel-&gt;SubmissionStatus = \'Not Marked\';<br></span><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #6a9955;\">//$SubmissionModel-&gt;submissionDate = date(\'Y-m-d H:m\');<br></span><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">SubmissionModel</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">SubmissionContent</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">=</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">model</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">AssignmentContent</span><span style=\"color: #d4d4d4;\">;<br></span><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">SubmissionModel</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">fileURL</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">=</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">model</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">fileURL</span><span style=\"color: #d4d4d4;\">;<br></span><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">SubmissionModel</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">StudentID</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">=</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">StudentID</span><span style=\"color: #d4d4d4;\">;<br></span><span style=\"color: #d4d4d4;\">                        }<br></span><span style=\"color: #d4d4d4;\">                        </span><br><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #c586c0;\">if</span><span style=\"color: #d4d4d4;\">(</span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">SubmissionModel</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #dcdcaa;\">save</span><span style=\"color: #d4d4d4;\">()){<br></span><span style=\"color: #d4d4d4;\">                        </span><span style=\"color: #6a9955;\">//$this-&gt;findModel($AssignmentID)-&gt;delete();<br></span><span style=\"color: #d4d4d4;\">                        </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">model</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">AssignmentContent</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">=</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #569cd6;\">null</span><span style=\"color: #d4d4d4;\">;<br></span><span style=\"color: #d4d4d4;\">                        </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">model</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">fileURL</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">=</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #569cd6;\">null</span><span style=\"color: #d4d4d4;\">;</span><br><span style=\"color: #d4d4d4;\">                        </span><span style=\"color: #c586c0;\">if</span><span style=\"color: #d4d4d4;\">(</span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">model</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #dcdcaa;\">save</span><span style=\"color: #d4d4d4;\">()){<br></span><span style=\"color: #d4d4d4;\">                             </span><span style=\"color: #6a9955;\">// Model saved successfully<br></span><span style=\"color: #d4d4d4;\">                            </span><span style=\"color: #9cdcfe;\">Yii</span><span style=\"color: #d4d4d4;\">::</span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">app</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">session</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #dcdcaa;\">setFlash</span><span style=\"color: #d4d4d4;\">(</span><span style=\"color: #ce9178;\">\'success\'</span><span style=\"color: #d4d4d4;\">, </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">Submit</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">?</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #ce9178;\">\'Assignment Submitted Successfully\'</span><span style=\"color: #d4d4d4;\">:</span><span style=\"color: #ce9178;\">\'Successfully Saved Assignment.\'</span><span style=\"color: #d4d4d4;\">);<br></span><span style=\"color: #d4d4d4;\">                            </span><span style=\"color: #c586c0;\">return</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">this</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #dcdcaa;\">redirect</span><span style=\"color: #d4d4d4;\">([</span><span style=\"color: #ce9178;\">\'view\'</span><span style=\"color: #d4d4d4;\">, </span><span style=\"color: #ce9178;\">\'AssignmentID\'</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">=&gt;</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">model</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">AssignmentID</span><span style=\"color: #d4d4d4;\">]);<br></span><span style=\"color: #d4d4d4;\">                        }<br></span><span style=\"color: #d4d4d4;\">                       <br></span><span style=\"color: #d4d4d4;\">                    <br></span><span style=\"color: #d4d4d4;\">                    }</span><span style=\"color: #c586c0;\">else</span><span style=\"color: #d4d4d4;\">{<br></span><span style=\"color: #6a9955;\">// Model saved successfully<br></span><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #9cdcfe;\">Yii</span><span style=\"color: #d4d4d4;\">::</span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">app</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #9cdcfe;\">session</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #dcdcaa;\">setFlash</span><span style=\"color: #d4d4d4;\">(</span><span style=\"color: #ce9178;\">\'error\'</span><span style=\"color: #d4d4d4;\">, </span><span style=\"color: #ce9178;\">\'Failed to Save Assignment.\'</span><span style=\"color: #d4d4d4;\">);<br></span><span style=\"color: #d4d4d4;\">                    </span><span style=\"color: #c586c0;\">return</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">this</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #dcdcaa;\">refresh</span><span style=\"color: #d4d4d4;\">(</span><span style=\"color: #ce9178;\">\'#\'</span><span style=\"color: #d4d4d4;\">);<br></span><span style=\"color: #d4d4d4;\">                    }<br></span><span style=\"color: #d4d4d4;\">                    }<br></span><span style=\"color: #d4d4d4;\">                    <br></span><span style=\"color: #d4d4d4;\">                }<br></span><span style=\"color: #d4d4d4;\">            }<br></span><span style=\"color: #d4d4d4;\">        }</span><br><span style=\"color: #d4d4d4;\">        </span><span style=\"color: #c586c0;\">return</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">this</span><span style=\"color: #d4d4d4;\">-&gt;</span><span style=\"color: #dcdcaa;\">render</span><span style=\"color: #d4d4d4;\">(</span><span style=\"color: #ce9178;\">\'do\'</span><span style=\"color: #d4d4d4;\">, [<br></span><span style=\"color: #d4d4d4;\">            </span><span style=\"color: #ce9178;\">\'model\'</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">=&gt;</span><span style=\"color: #d4d4d4;\"> </span><span style=\"color: #d4d4d4;\">$</span><span style=\"color: #9cdcfe;\">model</span><span style=\"color: #d4d4d4;\">,<br></span><span style=\"color: #d4d4d4;\">        ]);<br></span><span style=\"color: #d4d4d4;\">    }</span></pre></pre></div>', '2024-04-30 18:04:07', NULL, 99, 'Submitted', 'Marked');
INSERT INTO `Submission` (`SubmissionID`, `AssignmentID`, `groupID`, `StudentID`, `SubmissionContent`, `submissionDate`, `fileURL`, `score`, `AssignmentStatus`, `SubmissionStatus`) VALUES
(22, 1, NULL, 12, '<p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p>Surname:&nbsp; &nbsp; &nbsp; &nbsp;LYAMUYA</p><p>Given name:&nbsp; &nbsp;EMANUEL</p><p>Middle name: VENSESLAUS</p><p>Sex: Male</p><p>Marital status: Single</p><p>Date of Birth: 11 November 1999</p><p>Nationality: Tanzanian</p><p><br></p><p>Mobile: +255683366952/+255745144303/+255628234285</p><p>Email: emanuellyamuya52@gmail.com</p><p>&nbsp;To committedly accomplish and being responsible in all the assigned duties and working cooperatively with the other employees to meet the organization’s demand at all&nbsp; levels.</p><p>&nbsp;I am personally interested in learning, adhering to assigned duties, working in team&nbsp; and&nbsp; showing&nbsp; maximum&nbsp; cooperation&nbsp; with&nbsp; employees&nbsp; in&nbsp; the&nbsp; organization&nbsp; and&nbsp; external contributor to the success of the organization, but also self-dependence and supervision which would&nbsp; help&nbsp; me&nbsp; in&nbsp; developing&nbsp; a&nbsp; standalone&nbsp; commitment&nbsp; to&nbsp; accomplish&nbsp; the&nbsp; organization’s objectives hence reaching up the goal.</p><p><br></p><p><br></p><p><br></p><p><br></p><p>1</p><p>2019-2022</p><p>3.7 GPA</p><p>Certificate&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;of</p><p><br></p><p><br></p><p>.</p><p>Sokoine University of Agriculture,</p><p>(upper</p><p>second</p><p>Bachelor&nbsp; degree&nbsp; of science&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;with</p><p><br></p><p><br></p><p>Morogoro, Tanzania</p><p>class)</p><p>education</p><p>(Chemistry</p><p>Biology)</p><p>and</p><p><br></p><p>2</p><p>2017-2019&nbsp; &nbsp; &nbsp;</p><p>DIVISION II of</p><p>Advanced Certificate</p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p>3</p><p><br></p><p><br></p><p><br></p><p><br></p><p>2013-2016</p><p><br></p><p>Macechu secondary school, Tanga city Tanzania.</p><p><br></p><p><br></p><p>points 11</p><p><br></p><p><br></p><p>DIVISION II of</p><p>of Secondary Education</p><p>Examination (ACSEE)</p><p>Certificate</p><p><br></p><p><br></p><p><br></p><p>of</p><p><br></p><p><br></p><p><br></p><p>4</p><p><br></p><p><br></p><p>2006-2012</p><p><br></p><p>&nbsp; Kilai</p><p>primary school, Moshi</p><p>Kilimanjaro Tanzania.</p><p><br></p><p><br></p><p>Primary&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;School Leaving Examination&nbsp; (PSLE)</p><p><br></p><p><br></p><p><br></p><p><br></p><p>~ 1 ~</p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p>o&nbsp; &nbsp;August – October (2022) – Field teacher in chemistry and biology at Rukima secondary school.</p><p>o&nbsp; &nbsp;August – October (2021) – Field teacher in chemistry and biology at Rukima secondary school.</p><p>o&nbsp; &nbsp;June – July (2019) – Field teacher in biology and geography at Rukima Secondary School.</p><p>Duties and responsibilities performed.</p><p>o&nbsp; &nbsp;Lesson preparation and Effective Teaching and presentation.</p><p>o&nbsp; &nbsp;Lesson notes preparation, assignment preparations, tests preparation and result provision</p><p>o&nbsp; &nbsp;Preparation power point slides for presentation in class.&nbsp; o Marking student exercise and exams in time.</p><p>o&nbsp; &nbsp;Supervising daily activities of students including general cleanness of the classrooms and school environment as well. o Monitoring students’ discipline.</p><p>o&nbsp; &nbsp;Cooperating with other staff members to ensure conducive environment for teaching and learning in order to archive academic excellence.</p><p>o&nbsp; &nbsp;Performing various activities as teacher on duet according to the duet roster.&nbsp; o Good preparation of Scheme of work, lesson plan and lesson notes preparation.</p><p>o&nbsp; &nbsp;Attend various school meeting including general staff meeting, (parent and teachers) meeting and (students and teachers) meeting.</p><p>o&nbsp; &nbsp;Attending remedial classes especially after class sessions.</p><p>o&nbsp; &nbsp;Taking extra duties on supervising students on physical activities especially Shamba activities.</p><p>o&nbsp; &nbsp;Cooperating with student in social and sports activities, like having a brief seminar concerning with health and football match.</p><p><br></p><p>I have knowledge on guidance and counselling education with this I do offer the service to my&nbsp; &nbsp; &nbsp;pupils and stuffs. I also have good knowledge on computer application, with this knowledge I do engage well in modern teaching approach with Microsoft word, Microsoft power point and</p><p>Microsoft excel and projectors for presentation of the lesson.</p><p><br></p><p>o&nbsp; &nbsp;Ability to work as a team. o Ability to work in a disciplined manner.&nbsp; o Quick learner and ability to work properly according to my position.</p><p>o&nbsp; &nbsp;Possess excellent verbal and written communication skills.</p><p>o&nbsp; &nbsp;Possess self-confidence.&nbsp; o Able to work independently without or with minimum supervision.&nbsp; o Able to work in challenging environment.</p><p>o&nbsp; &nbsp;Others, customer care skill, interpersonal skill, problem solving skills,&nbsp; time management skill, Communication skill and active listening skill.</p><p><br></p><p>o&nbsp; &nbsp;Microsoft office programs&nbsp; o Ms- word&nbsp; o Ms-Excel&nbsp; o Internet surfing.</p><div><br></div><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p>Surname:       LYAMUYA</p><p>Given name:   EMANUEL</p><p>Middle name: VENSESLAUS</p><p>Sex: Male</p><p>Marital status: Single</p><p>Date of Birth: 11 November 1999</p><p>Nationality: Tanzanian</p><p><br></p><p>Mobile: +255683366952/+255745144303/+255628234285</p><p>Email: emanuellyamuya52@gmail.com</p><p>&nbsp;To committedly accomplish and being responsible in all the assigned duties and working cooperatively with the other employees to meet the organization’s demand at all  levels.</p><p>&nbsp;I am personally interested in learning, adhering to assigned duties, working in team  and  showing  maximum  cooperation  with  employees  in  the  organization  and  external contributor to the success of the organization, but also self-dependence and supervision which would  help  me  in  developing  a  standalone  commitment  to  accomplish  the  organization’s objectives hence reaching up the goal.</p><p><br></p><p><br></p><p><br></p><p><br></p><p>1</p><p>2019-2022</p><p>3.7 GPA</p><p>Certificate                 of</p><p><br></p><p><br></p><p>.</p><p>Sokoine University of Agriculture,</p><p>(upper</p><p>second</p><p>Bachelor  degree  of science               with</p><p><br></p><p><br></p><p>Morogoro, Tanzania</p><p>class)</p><p>education</p><p>(Chemistry</p><p>Biology)</p><p>and</p><p><br></p><p>2</p><p>2017-2019&nbsp; &nbsp; &nbsp;</p><p>DIVISION II of</p><p>Advanced Certificate</p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p>3</p><p><br></p><p><br></p><p><br></p><p><br></p><p>2013-2016</p><p><br></p><p>Macechu secondary school, Tanga city Tanzania.</p><p><br></p><p><br></p><p>points 11</p><p><br></p><p><br></p><p>DIVISION II of</p><p>of Secondary Education</p><p>Examination (ACSEE)</p><p>Certificate</p><p><br></p><p><br></p><p><br></p><p>of</p><p><br></p><p><br></p><p><br></p><p>4</p><p><br></p><p><br></p><p>2006-2012</p><p><br></p><p>&nbsp; Kilai</p><p>primary school, Moshi</p><p>Kilimanjaro Tanzania.</p><p><br></p><p><br></p><p>Primary           School Leaving Examination  (PSLE)</p><p><br></p><p><br></p><p><br></p><p><br></p><p>~ 1 ~</p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p>o   August – October (2022) – Field teacher in chemistry and biology at Rukima secondary school.</p><p>o   August – October (2021) – Field teacher in chemistry and biology at Rukima secondary school.</p><p>o   June – July (2019) – Field teacher in biology and geography at Rukima Secondary School.</p><p>Duties and responsibilities performed.</p><p>o   Lesson preparation and Effective Teaching and presentation.</p><p>o   Lesson notes preparation, assignment preparations, tests preparation and result provision</p><p>o   Preparation power point slides for presentation in class.  o Marking student exercise and exams in time.</p><p>o   Supervising daily activities of students including general cleanness of the classrooms and school environment as well. o Monitoring students’ discipline.</p><p>o   Cooperating with other staff members to ensure conducive environment for teaching and learning in order to archive academic excellence.</p><p>o   Performing various activities as teacher on duet according to the duet roster.  o Good preparation of Scheme of work, lesson plan and lesson notes preparation.</p><p>o   Attend various school meeting including general staff meeting, (parent and teachers) meeting and (students and teachers) meeting.</p><p>o   Attending remedial classes especially after class sessions.</p><p>o   Taking extra duties on supervising students on physical activities especially Shamba activities.</p><p>o   Cooperating with student in social and sports activities, like having a brief seminar concerning with health and football match.</p><p><br></p><p>I have knowledge on guidance and counselling education with this I do offer the service to my     pupils and stuffs. I also have good knowledge on computer application, with this knowledge I do engage well in modern teaching approach with Microsoft word, Microsoft power point and</p><p>Microsoft excel and projectors for presentation of the lesson.</p><p><br></p><p>o   Ability to work as a team. o Ability to work in a disciplined manner.  o Quick learner and ability to work properly according to my position.</p><p>o   Possess excellent verbal and written communication skills.</p><p>o   Possess self-confidence.  o Able to work independently without or with minimum supervision.  o Able to work in challenging environment.</p><p>o   Others, customer care skill, interpersonal skill, problem solving skills,  time management skill, Communication skill and active listening skill.</p><p><br></p><p>o   Microsoft office programs  o Ms- word  o Ms-Excel  o Internet surfing.</p><p><br></p>', '2024-05-01 02:03:54', 'prefix_1714517651.pdf', 45, 'Submitted', 'Marked'),
(23, 9, NULL, 12, '<p><br></p><p>Surname:&nbsp; &nbsp; &nbsp; &nbsp;LYAMUYA</p><p>Given name:&nbsp; &nbsp;EMANUEL</p><p>Middle name: VENSESLAUS</p><p>Sex: Male</p><p>Marital status: Single</p><p>Date of Birth: 11 November 1999</p><p>Nationality: Tanzanian</p><p><br></p><p>Mobile: +255683366952/+255745144303/+255628234285</p><p>Email: emanuellyamuya52@gmail.com</p><p>&nbsp;To committedly accomplish and being responsible in all the assigned duties and working cooperatively with the other employees to meet the organization’s demand at all&nbsp; levels.</p><p>&nbsp;I am personally interested in learning, adhering to assigned duties,&nbsp;</p><p>o&nbsp; &nbsp;August – October (2022) – Field teacher in chemistry and biology at Rukima secondary school.</p><p>o&nbsp; &nbsp;August – October (2021) – Field teacher in chemistry and biology at Rukima secondary school.</p><p>o&nbsp; &nbsp;June – July (2019) – Field teacher in biology and geography at Rukima Secondary School.</p><p>Duties and responsibilities performed.</p><p>o&nbsp; &nbsp;Lesson preparation and Effective Teaching and presentation.</p><p>o&nbsp; &nbsp;Lesson notes preparation, assignment preparations, tests preparation and result provision</p><p>o&nbsp; &nbsp;Preparation power point slides for presentation in class.&nbsp; o Marking student exercise and exams in time.</p><p>o&nbsp; &nbsp;Supervising daily activities of students including general cleanness of the classrooms and school environment as well. o Monitoring students’ discipline.</p><p>o&nbsp; &nbsp;Cooperating with other staff members to ensure conducive environment for teaching and learning in order to archive academic excellence.</p><p>o&nbsp; &nbsp;Performing various activities as teacher on duet according to the duet roster.&nbsp; o Good preparation of Scheme of work, lesson plan and lesson notes preparation.</p><p>o&nbsp; &nbsp;Attend various school meeting including general staff meeting, (parent and teachers) meeting and (students and teachers) meeting.</p><p>o&nbsp; &nbsp;Attending remedial classes especially after class sessions.</p><p>o&nbsp; &nbsp;Taking extra duties on supervising students on physical activities especially Shamba activities.</p><p>o&nbsp; &nbsp;Cooperating with student in social and sports activities, like having a brief seminar concerning with health and football match.</p><p><br></p><p>I have knowledge on guidance and counselling education with this I do offer the service to my&nbsp; &nbsp; &nbsp;pupils and stuffs. I also have good knowledge on computer application, with this knowledge I do engage well in modern teaching approach with Microsoft word, Microsoft power point and</p><p>Microsoft excel and projectors for presentation of the lesson.</p><p><br></p><p>o&nbsp; &nbsp;Ability to work as a team. o Ability to work in a disciplined manner.&nbsp; o Quick learner and ability to work properly according to my position.</p><p>o&nbsp; &nbsp;Possess excellent verbal and written communication skills.</p><p>o&nbsp; &nbsp;Possess self-confidence.&nbsp; o Able to work independently without or with minimum supervision.&nbsp; o Able to work in challenging environment.</p><p>o&nbsp; &nbsp;Others, customer care skill, interpersonal skill, problem solving skills,&nbsp; time management skill, Communication skill and active listening skill.</p><p><br></p><p>o&nbsp; &nbsp;Microsoft office programs&nbsp; o Ms- word&nbsp; o Ms-Excel&nbsp; o Internet surfing.</p><div><br></div>', '2024-05-01 02:05:53', 'prefix_1714518416.png', NULL, 'Submitted', 'Not Marked'),
(24, 1, NULL, 13, '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $SubmissionModel-&gt;AssignmentID = $model-&gt;AssignmentID;</p><div><br></div>', '2024-05-01 01:05:00', NULL, NULL, 'Pending', 'Not Marked'),
(25, 7, NULL, 13, '', '2024-05-01 02:05:00', 'prefix_1714522641.png', NULL, 'Pending', 'Not Marked'),
(26, 10, NULL, 13, '<p>Explain to me&nbsp;</p>', '2024-05-01 12:05:00', NULL, NULL, 'Pending', 'Not Marked');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `UserID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('student','instructor') NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified` tinyint(1) DEFAULT 0,
  `auth_key` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`UserID`, `username`, `password`, `role`, `password_hash`, `password_reset_token`, `verification_token`, `email`, `email_verified`, `auth_key`, `status`, `created_at`, `updated_at`) VALUES
(1, 'JOHCRAZY', '13g40n2%', 'student', '$2y$13$c5bxriVfRk..EkqzrXzNHOsfuqCoL9nuwb3/.HqAzyqWMkWs/LpNK', NULL, 'zkXquaGrzuME79YCiVumpywHBgFgXeJz_1713908837', 'jjuma8165@gmail.com', 0, 'FTnjJZcg6uni7gHUXabRgRYffuuYaa9X', 10, 1713908837, 1713908837),
(3, 'G-KILASI', '13g40n2%', 'instructor', '$2y$13$GVpiwoc9Ou0d2w5aqAjhEun1OY5MM6RYEC0HS.MwDDM8sxD84iTAW', NULL, 'iEo5rSG-MHsQxmGOkxg3Fr-zY3BDM-ay_1713965804', 'gracekilasi5@gmail.com', 0, 'YP7bZJwi7yuCt7o_3UODMNMfKZSzCV0u', 10, 1713965804, 1713965804),
(4, 'JOHCRAZY1', '13g40n2%', 'instructor', '$2y$13$XsKpE3mNz4ahtUvyGRIJdeLgN5WVBf5jEUXhJq2Ozn/Yh3SVkpjz.', NULL, 'HbP0cuYyc7rqFkGliBsP_yHuONhLt5nX_1714092001', 'jjuma81653@gmail.com', 0, 'qGd6R42BQYqxLcAYFhgfQo0FV5YSwGfv', 10, 1714092001, 1714092001),
(5, 'JOHCRAZY2', '13g40n2%', 'student', '$2y$13$O2MrSRVqUTeYWo35RZsMCOAX4ftjwmagsIRC8dJJA/o2lAR7VOBKK', NULL, 'd4fIg_eWD4iJZqnzVGc5EZysmOa-q8zZ_1714092305', 'jjuma8165@egmail.com', 0, '3dybvXpBctryuKCxlhA4bbfHAT0mny6w', 10, 1714092305, 1714092305),
(6, 'JOHCRAZY3', '13g40n2%', 'student', '$2y$13$uCi1MZ2PJd0m3KCJqNbFTuuZ970sqAKJ4mQDhk4RSnarmxbF.VrCG', NULL, '_R75br9PemrNgGtPe4xStPSAWbSJBcBM_1714096670', 'jjuma3@gmail.com', 0, 'PfMCjXx3D6O02p5-Acdn69Un6ikOwkhr', 10, 1714096670, 1714096670),
(7, 'Hello', '13g40n2%', 'student', '$2y$13$qsBpxjTQhSDM3e9zdvQ9X.XFsHAdD40msm3Aq0s7Qo6xBZRBifLLK', NULL, 'SO-M4NyBe8sAa--Uj_R6x_9ECjWhCpR__1714520190', 'Hello@gmail.com', 0, 'cY_9kqN1TqvFaTEo1BxHc9shD6gBsLcE', 10, 1714520190, 1714520190),
(8, 'malibha', '1234567890', 'student', '$2y$13$CMjTBFBcKYN9lmG2Jqy72O1wXn7FO.gyccr7BrvL.XP6nmvqAiElu', NULL, 'P476p6_apcuyRVnmZRuerbLk9Yc64SFP_1714568917', 'elias@gmail.com', 0, 'AzK277QWMyPvv8J6sNVO4ZUKIKoMAxyj', 10, 1714568917, 1714568917);

CREATE TABLE IF NOT EXISTS `Group` (
    `GroupID` INT PRIMARY KEY AUTO_INCREMENT,
    `GroupNO` INT,
    `GroupName` VARCHAR(64),
    `StudentID` INT,
    FOREIGN KEY(`StudentID`) REFERENCES `Student` (`StudentID`),
    `courseCode` VARCHAR(12),
    FOREIGN KEY (`courseCode`) REFERENCES `Course` (`courseCode`),
    `programmeCode` VARCHAR(5),
    FOREIGN KEY (`programmeCode`) REFERENCES `Programme` (`programmeCode`)
);


--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `Assignment`
--
ALTER TABLE `Assignment`
  ADD PRIMARY KEY (`AssignmentID`),
  ADD KEY `courseCode` (`courseCode`);

--
-- Indexes for table `Course`
--
ALTER TABLE `Course`
  ADD UNIQUE KEY `courseCode` (`courseCode`),
  ADD KEY `courseInstructor` (`courseInstructor`),
  ADD KEY `programmeCode` (`programmeCode`);

--
-- Indexes for table `Instructor`
--
ALTER TABLE `Instructor`
  ADD PRIMARY KEY (`InstructorID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `Programme`
--
ALTER TABLE `Programme`
  ADD UNIQUE KEY `programmeCode` (`programmeCode`);

--
-- Indexes for table `Student`
--
ALTER TABLE `Student`
  ADD PRIMARY KEY (`StudentID`),
  ADD UNIQUE KEY `regNo` (`regNo`),
  ADD UNIQUE KEY `emailAddress` (`emailAddress`),
  ADD KEY `userID` (`userID`),
  ADD KEY `programmeCode` (`programmeCode`);

--
-- Indexes for table `Submission`
--
ALTER TABLE `Submission`
  ADD PRIMARY KEY (`SubmissionID`),
  ADD KEY `AssignmentID` (`AssignmentID`),
  ADD KEY `groupID` (`groupID`),
  ADD KEY `StudentID` (`StudentID`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Assignment`
--
ALTER TABLE `Assignment`
  MODIFY `AssignmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;


-- AUTO_INCREMENT for table `Instructor`
--
ALTER TABLE `Instructor`
  MODIFY `InstructorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Student`
--
ALTER TABLE `Student`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `Submission`
--
ALTER TABLE `Submission`
  MODIFY `SubmissionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Assignment`
--
ALTER TABLE `Assignment`
  ADD CONSTRAINT `Assignment_ibfk_1` FOREIGN KEY (`courseCode`) REFERENCES `Course` (`courseCode`);

--
-- Constraints for table `Course`
--
ALTER TABLE `Course`
  ADD CONSTRAINT `Course_ibfk_1` FOREIGN KEY (`courseInstructor`) REFERENCES `Instructor` (`InstructorID`),
  ADD CONSTRAINT `Course_ibfk_2` FOREIGN KEY (`programmeCode`) REFERENCES `Programme` (`programmeCode`);


--
-- Constraints for table `Instructor`
--
ALTER TABLE `Instructor`
  ADD CONSTRAINT `Instructor_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`);

--
-- Constraints for table `Student`
--
ALTER TABLE `Student`
  ADD CONSTRAINT `Student_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `User` (`UserID`),
  ADD CONSTRAINT `Student_ibfk_3` FOREIGN KEY (`programmeCode`) REFERENCES `Programme` (`programmeCode`);

--
-- Constraints for table `Submission`
--
ALTER TABLE `Submission`
  ADD CONSTRAINT `Submission_ibfk_1` FOREIGN KEY (`AssignmentID`) REFERENCES `Assignment` (`AssignmentID`),
  ADD CONSTRAINT `Submission_ibfk_2` FOREIGN KEY (`groupID`) REFERENCES `Group` (`GroupID`),
  ADD CONSTRAINT `Submission_ibfk_3` FOREIGN KEY (`StudentID`) REFERENCES `Student` (`StudentID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
