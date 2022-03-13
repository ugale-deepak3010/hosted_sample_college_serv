-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2021 at 06:25 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_college_serv`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id` int(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `machine_id` varchar(200) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `name`, `password`, `machine_id`, `active`) VALUES
(18765432, 'Power Administrator', '123', '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `common`
--

CREATE TABLE `common` (
  `dept_name` varchar(100) NOT NULL,
  `MCS_1` int(1) DEFAULT NULL,
  `MCS_2` int(1) DEFAULT NULL,
  `MCS_3` int(1) DEFAULT NULL,
  `MCS_4` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `file_share_manager`
--

CREATE TABLE `file_share_manager` (
  `id` int(10) NOT NULL,
  `file_name` varchar(200) DEFAULT NULL,
  `file_name_uid` varchar(6) DEFAULT NULL,
  `file_extension` varchar(50) DEFAULT NULL,
  `file_size` varchar(100) DEFAULT NULL,
  `subject_id` int(10) DEFAULT NULL,
  `time_stamp` varchar(200) DEFAULT NULL,
  `read_only` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hod`
--

CREATE TABLE `hod` (
  `id` int(5) NOT NULL,
  `department` varchar(300) DEFAULT NULL,
  `alternative_code` varchar(3) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `semester_count` int(2) DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  `machine_id` varchar(100) DEFAULT NULL,
  `force_logout` int(1) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hod`
--

INSERT INTO `hod` (`id`, `department`, `alternative_code`, `password`, `type`, `semester_count`, `active`, `machine_id`, `force_logout`, `name`, `email`, `phone`) VALUES
(10084, 'MCS', '', 'Pass@123', 'individual', 4, NULL, NULL, NULL, 'Deepak Kumar sir', 'ugale.deepak3010@gmail.com', '8975621043');

-- --------------------------------------------------------

--
-- Table structure for table `master_examinition`
--

CREATE TABLE `master_examinition` (
  `id` int(4) NOT NULL,
  `exam_name` varchar(200) DEFAULT NULL,
  `subject_name` varchar(200) DEFAULT NULL,
  `subject_id` int(10) DEFAULT NULL,
  `stop_exam` int(1) DEFAULT NULL,
  `answer_release` int(1) DEFAULT NULL,
  `time_stamp` varchar(500) DEFAULT NULL,
  `delete_selection_table` int(1) DEFAULT NULL,
  `delete_exam_everything` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `master_semester`
--

CREATE TABLE `master_semester` (
  `id` int(11) NOT NULL,
  `department` varchar(200) DEFAULT NULL,
  `semester` int(2) DEFAULT NULL,
  `subject_name` varchar(300) DEFAULT NULL,
  `subject_desc` varchar(1000) DEFAULT NULL,
  `subject_code` varchar(100) DEFAULT NULL,
  `teacher` varchar(500) DEFAULT NULL,
  `teacher_id` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mcs_marks`
--

CREATE TABLE `mcs_marks` (
  `id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(6) NOT NULL,
  `fname` varchar(30) DEFAULT NULL,
  `mname` varchar(30) DEFAULT NULL,
  `lname` varchar(30) DEFAULT NULL,
  `gender` varchar(15) DEFAULT NULL,
  `dob` varchar(100) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `register_time` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `semester` varchar(100) DEFAULT NULL,
  `photo` varchar(2000) DEFAULT NULL,
  `sign` varchar(2000) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `machine_id` varchar(500) DEFAULT NULL,
  `force_logout` int(1) DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  `approve` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_options`
--

CREATE TABLE `student_options` (
  `id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  `machine_id` varchar(300) DEFAULT NULL,
  `force_logout` int(1) DEFAULT NULL,
  `note` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `common`
--
ALTER TABLE `common`
  ADD PRIMARY KEY (`dept_name`);

--
-- Indexes for table `file_share_manager`
--
ALTER TABLE `file_share_manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hod`
--
ALTER TABLE `hod`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `department` (`department`);

--
-- Indexes for table `master_examinition`
--
ALTER TABLE `master_examinition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_semester`
--
ALTER TABLE `master_semester`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mcs_marks`
--
ALTER TABLE `mcs_marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_options`
--
ALTER TABLE `student_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18765433;

--
-- AUTO_INCREMENT for table `file_share_manager`
--
ALTER TABLE `file_share_manager`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `hod`
--
ALTER TABLE `hod`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10085;

--
-- AUTO_INCREMENT for table `master_examinition`
--
ALTER TABLE `master_examinition`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `master_semester`
--
ALTER TABLE `master_semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100149;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1013;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
