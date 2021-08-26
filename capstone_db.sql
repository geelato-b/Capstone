-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2021 at 08:03 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountabilities`
--

CREATE TABLE `accountabilities` (
  `accbty_id` int(11) NOT NULL,
  `accbty_name` varchar(255) NOT NULL,
  `accbty_desc` varchar(255) NOT NULL,
  `accbty_price` int(128) NOT NULL,
  `accbty_deadline` date NOT NULL COMMENT 'yyyy-mm-dd',
  `status` varchar(128) NOT NULL DEFAULT 'A' COMMENT 'A = Activated\r\nD = Deactivated'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accountabilities`
--

INSERT INTO `accountabilities` (`accbty_id`, `accbty_name`, `accbty_desc`, `accbty_price`, `accbty_deadline`, `status`) VALUES
(1, 'CSC fee', 'Mandatory', 20, '2021-12-12', 'A'),
(2, 'Red cross', 'Mandatory', 20, '2021-12-12', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `fb_id` int(128) NOT NULL,
  `bu_email` varchar(225) NOT NULL,
  `fb_cont` varchar(10000) NOT NULL,
  `date_sent` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(1) NOT NULL DEFAULT 'A',
  `fb_status` varchar(125) NOT NULL DEFAULT 'Unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`fb_id`, `bu_email`, `fb_cont`, `date_sent`, `status`, `fb_status`) VALUES
(1, 'vanyaseven@bicol-u.edu.ph', 'I could say I never dare\r\nTo think about you in that way, but\r\nI would be lyin\'\r\nAnd I pretend I\'m happy for you\r\nWhen you find some dude to take home\r\nBut I won\'t deny that\r\nIn the midst of the crowds\r\nIn the shapes in the clouds\r\nI don\'t see nobody but you\r\nIn my rose-tinted dreams\r\nWrinkled silk on my sheets\r\nI don\'t see nobody but you', '2021-08-22', 'A', 'Mark as Read'),
(2, 'vanyaseven@bicol-u.edu.ph', 'I do the same thing I told you that I never would\r\nI told you I\'d change, even when I knew I never could\r\nKnow that I can\'t find nobody else as good as you\r\nI need you to stay, need you to stay, hey\r\nI do the same thing I told you that I never would\r\nI told you I\'d change even when I knew I never could\r\nKnow that I can\'t find nobody else as good as you\r\nI need you to stay, need you to stay, hey', '2021-08-23', 'A', 'Mark as Read');

-- --------------------------------------------------------

--
-- Table structure for table `gcash`
--

CREATE TABLE `gcash` (
  `gcash_id` int(11) NOT NULL,
  `stud_id` varchar(128) NOT NULL,
  `stud_name` varchar(255) NOT NULL,
  `bu_email` varchar(255) NOT NULL,
  `date_time` date NOT NULL DEFAULT current_timestamp(),
  `accbty_name` varchar(128) NOT NULL,
  `img` varchar(128) NOT NULL,
  `gc_status` varchar(64) NOT NULL DEFAULT 'UC',
  `status` varchar(64) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(50) NOT NULL,
  `stud_id` varchar(50) NOT NULL,
  `stud_name` varchar(255) NOT NULL,
  `stud_program` varchar(128) NOT NULL,
  `stud_year_block` varchar(30) NOT NULL,
  `gender` varchar(11) NOT NULL COMMENT 'M-male, F-female',
  `accbty_id` varchar(11) NOT NULL,
  `accbty_price` int(128) NOT NULL,
  `pymt_rcv_by` varchar(128) NOT NULL,
  `pay_status` varchar(20) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_acc`
--

CREATE TABLE `student_acc` (
  `stud_id` varchar(50) NOT NULL,
  `bu_email` varchar(256) NOT NULL,
  `stud_name` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL,
  `user_type` varchar(11) NOT NULL COMMENT 'S- student, A- Admin',
  `status` varchar(11) NOT NULL COMMENT 'Active or Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_acc`
--

INSERT INTO `student_acc` (`stud_id`, `bu_email`, `stud_name`, `password`, `user_type`, `status`) VALUES
('1969-PC-Admin', 'bicol-u.edu.ph', 'BUPC', 'admin', 'A', 'Active'),
('2018-PC-100000', 'vanyaseven@bicol-u.edu.ph', 'Vanya Seven', 'qwerty123', 'S', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `stud_id` varchar(50) NOT NULL,
  `bu_email` varchar(256) NOT NULL,
  `stud_name` varchar(255) NOT NULL,
  `stud_program` varchar(128) NOT NULL,
  `stud_year_block` varchar(30) NOT NULL,
  `gender` varchar(11) NOT NULL COMMENT 'M-male, F-female',
  `stud_birthdate` date NOT NULL COMMENT 'yyyy-mm-dd',
  `stud_address` varchar(256) NOT NULL COMMENT 'brgy/city/province'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`stud_id`, `bu_email`, `stud_name`, `stud_program`, `stud_year_block`, `gender`, `stud_birthdate`, `stud_address`) VALUES
('2018-PC-100000', 'vanyaseven@bicol-u.edu.ph', 'Vanya Seven', 'BSIT', '4A', 'F', '2000-02-03', 'Dunao, Ligao, Albay');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountabilities`
--
ALTER TABLE `accountabilities`
  ADD PRIMARY KEY (`accbty_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`fb_id`);

--
-- Indexes for table `gcash`
--
ALTER TABLE `gcash`
  ADD PRIMARY KEY (`gcash_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `student_acc`
--
ALTER TABLE `student_acc`
  ADD PRIMARY KEY (`stud_id`);

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`stud_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountabilities`
--
ALTER TABLE `accountabilities`
  MODIFY `accbty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `fb_id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gcash`
--
ALTER TABLE `gcash`
  MODIFY `gcash_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(50) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
