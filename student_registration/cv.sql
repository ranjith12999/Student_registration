-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2020 at 06:07 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cv`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

	CREATE TABLE `branch` (
	  `department` text NOT NULL,
	  `branch` text NOT NULL,
	  `branch_code` int(3) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`department`, `branch`, `branch_code`) VALUES
('Mathematics', 'Integrated CS', 39),
('Mathematics', 'Integrated IT', 42);

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `gender` int(1) NOT NULL,
  `dob` date NOT NULL,
  `rollno` int(10) NOT NULL,
  `branch` int(3) NOT NULL,
  `10th_mark` int(4) NOT NULL,
  `12th_mark` int(4) NOT NULL,
  `cgpa` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`first_name`, `last_name`, `gender`, `dob`, `rollno`, `branch`, `10th_mark`, `12th_mark`) VALUES
('Jayanth', 'S P', 1, '1999-01-13', 2016239007, 35, 484, 1165),
('poorna', 'anand', 1, '1998-07-02', 2016239016, 39, 491, 1097),
('Jayanth', 'S P', 1, '1999-01-01', 2016242007, 42, 484, 1165);

-- --------------------------------------------------------

--
-- Table structure for table `gender_table`
--

CREATE TABLE `gender_table` (
  `gender` text NOT NULL,
  `gender_code` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gender_table`
--

INSERT INTO `gender_table` (`gender`, `gender_code`) VALUES
('male', 1),
('female', 2),
('other', 3);

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `rollno` int(10) NOT NULL,
  `sem` int(2) NOT NULL,
  `credits_earned` int(3) NOT NULL,
  `max_credits` int(2) NOT NULL,
  `gpa` decimal(4,2) NOT NULL,
  `cgpa` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`rollno`, `sem`, `credits_earned`, `max_credits`, `gpa`, `cgpa`) VALUES
(2016242007, 1, 220, 24, '9.17', '9.17'),
(2016242007, 2, 200, 22, '9.09', '9.13'),
(2016242007, 3, 180, 21, '8.57', '8.96'),
(2016242007, 4, 190, 22, '8.64', '8.88'),
(2016242007, 5, 177, 23, '7.70', '8.63'),
(2016242007, 6, 183, 21, '8.71', '8.65'),
(2016242007, 7, 140, 16, '8.75', '8.66'),
(2016239016, 1, 200, 28, '7.14', '7.14'),
(2016239016, 2, 240, 28, '8.57', '7.86'),
(2016239016, 3, 222, 28, '7.93', '7.88'),
(2016239016, 4, 250, 29, '8.62', '8.07'),
(2016239016, 5, 290, 30, '9.67', '8.41'),
(2016239016, 6, 300, 36, '8.33', '8.39'),
(2016239016, 7, 320, 34, '9.41', '8.55'),
(2016239007, 1, 220, 24, '9.17', '9.17'),
(2016239007, 2, 200, 22, '9.09', '9.13'),
(2016239007, 3, 180, 21, '8.57', '8.96'),
(2016239007, 4, 190, 22, '8.64', '8.88'),
(2016239007, 5, 177, 23, '7.70', '8.63'),
(2016239007, 6, 183, 21, '8.71', '8.65'),
(2016239007, 7, 140, 16, '8.75', '8.66');

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

CREATE TABLE `student_details` (
  `rollno` int(10) NOT NULL,
  `gender` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`rollno`, `gender`) VALUES
(2012239030, 1),
(2016239002, 1),
(2016239004, 1),
(2016239006, 1),
(2016239012, 1),
(2016239016, 1),
(2016239019, 1),
(2016239020, 1),
(2016239021, 1),
(2016239024, 1),
(2016239028, 1),
(2016239029, 1),
(2016242006, 1),
(2016242007, 1),
(2016242018, 1),
(2016239001, 2),
(2016239007, 2),
(2016239008, 2),
(2016239009, 2),
(2016239011, 2),
(2016239013, 2),
(2016239014, 2),
(2016239015, 2),
(2016239017, 2),
(2016239022, 2),
(2016239023, 2),
(2016239025, 2),
(2016239026, 2),
(2016239027, 2),
(2016239080, 2),
(2016242003, 2),
(2016242005, 2),
(2016242009, 2),
(2016242010, 2),
(2016242011, 2),
(2016242012, 2),
(2016242013, 2),
(2016242014, 2),
(2016242015, 2),
(2016242016, 2),
(2016242017, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_code`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD UNIQUE KEY `rollno` (`rollno`),
  ADD KEY `branch` (`branch`),
  ADD KEY `gender` (`gender`);

--
-- Indexes for table `gender_table`
--
ALTER TABLE `gender_table`
  ADD PRIMARY KEY (`gender_code`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD KEY `rollno` (`rollno`);

--
-- Indexes for table `student_details`
--
ALTER TABLE `student_details`
  ADD PRIMARY KEY (`rollno`),
  ADD KEY `gender` (`gender`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `details`
--
ALTER TABLE `details`
  ADD CONSTRAINT `details_ibfk_1` FOREIGN KEY (`branch`) REFERENCES `branch` (`branch_code`),
  ADD CONSTRAINT `details_ibfk_2` FOREIGN KEY (`gender`) REFERENCES `gender_table` (`gender_code`),
  ADD CONSTRAINT `details_ibfk_3` FOREIGN KEY (`rollno`) REFERENCES `student_details` (`rollno`);

--
-- Constraints for table `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `marks_ibfk_2` FOREIGN KEY (`rollno`) REFERENCES `details` (`rollno`);

--
-- Constraints for table `student_details`
--
ALTER TABLE `student_details`
  ADD CONSTRAINT `student_details_ibfk_1` FOREIGN KEY (`gender`) REFERENCES `gender_table` (`gender_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
