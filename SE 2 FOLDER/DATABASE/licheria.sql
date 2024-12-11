-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2024 at 01:32 PM
-- Server version: 5.6.26
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `licheria`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `official_id` int(11) NOT NULL,
  `official_name` varchar(100) NOT NULL,
  `official_info` varchar(100) NOT NULL,
  `official_contact` varchar(15) NOT NULL,
  `official_photo` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`official_id`, `official_name`, `official_info`, `official_contact`, `official_photo`) VALUES
(1, 'Chinee Ann Manzon', 'Barangay Kapitan', '0912 345 6789', 'chinee.jpg'),
(2, 'Jane Smith', 'Barangay Kagawad', '123456', 'kagawad.jpg'),
(3, 'Sakuragi', 'Barangay Tanod', '09123456789', 'sakuragi.jpg'),
(4, 'John Doe', 'Barangay Tanod', '0999 888 7777', 'tanod.jpg'),
(5, 'Taylor Sheesh', 'Barangay Tanod', '123789', 'sheesh.jpg'),
(6, 'Kuya Burstfade', 'BRQT Leader', '0919 991 911', 'burst.jpg'),
(7, 'Lebron James', 'BRQT', '0969 143 1433', 'lebron.jpg'),
(8, 'Ross Rizal', 'BRQT', '143 6969 35', 'ross.jpg'),
(9, 'Sam Smith', 'BRQT', '12345678876', 'sam.jpg'),
(10, 'Naruto', 'BRQT', 'GAGIBUSHIN123', 'naruto.jpg'),
(11, 'Alden Richards', 'BRQT', '0949 426 6702', 'alden.jpg'),
(12, 'Donald Trump', 'BRQT', '0942 888 3456', 'trump.jpg'),
(13, 'Tom', 'Barangay Tanod', '01331122', 'tom.jpg'),
(14, 'Efren Bata Reyes', 'Barangay Kagawad', '555 666 777', 'efren.jpg'),
(15, 'Anya Taylor Joy', 'Barangay Kagawad', '09143 143 1433', 'anya.jpg'),
(16, 'Blade', 'Barangay Kagawad', '0999 888 7765', 'blade.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`admin_id`, `username`, `password`) VALUES
(1, 'chinee', 'chinee'),
(2, 'user', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `reminder`
--

CREATE TABLE IF NOT EXISTS `reminder` (
  `reminder_id` int(11) NOT NULL,
  `reminder_title` varchar(100) NOT NULL,
  `reminder_content` varchar(1024) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reminder`
--

INSERT INTO `reminder` (`reminder_id`, `reminder_title`, `reminder_content`) VALUES
(1, 'Sa Classroom May Batas', 'Bawal Lumabas.'),
(2, 'Reminder 101', 'Pag maiksi ang kumot patay na ang kabayo.'),
(3, 'k', 'k'),
(4, '', ''),
(5, '', ''),
(6, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`official_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `reminder`
--
ALTER TABLE `reminder`
  ADD PRIMARY KEY (`reminder_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `official_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `reminder`
--
ALTER TABLE `reminder`
  MODIFY `reminder_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
