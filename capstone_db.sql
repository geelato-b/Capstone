-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2021 at 06:19 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone_db`
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
  `status` varchar(128) NOT NULL DEFAULT 'NYP' COMMENT 'P-paid,\r\nNYP-not yet paid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accountabilities`
--

INSERT INTO `accountabilities` (`accbty_id`, `accbty_name`, `accbty_desc`, `accbty_price`, `accbty_deadline`, `status`) VALUES
(1, 'CSC Fee', 'Mandatory for 1st Sem', 20, '2021-11-28', 'NYP');

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
('1969-PC-Admin', 'bicol-u.edu.ph', 'BUPC', 'admin000', 'A', 'Active'),
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
  MODIFY `accbty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(50) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
