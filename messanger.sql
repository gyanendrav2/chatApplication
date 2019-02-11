-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2019 at 07:43 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `messanger`
--

-- --------------------------------------------------------

--
-- Table structure for table `profileimg`
--

CREATE TABLE `profileimg` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `relations`
--

CREATE TABLE `relations` (
  `ID` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0-For pending 1-For approved 2-Blocked or deleted',
  `send_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relations`
--

INSERT INTO `relations` (`ID`, `sender`, `receiver`, `status`, `send_time`) VALUES
(118, 69, 67, 1, '2019-01-15 14:32:00'),
(119, 67, 68, 1, '2019-01-15 15:20:52'),
(120, 72, 68, 1, '2019-01-15 15:49:49'),
(121, 72, 67, 1, '2019-01-16 12:57:58'),
(122, 76, 67, 1, '2019-01-16 13:52:32');

-- --------------------------------------------------------

--
-- Table structure for table `usermessages`
--

CREATE TABLE `usermessages` (
  `id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `message` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usermessages`
--

INSERT INTO `usermessages` (`id`, `sender`, `receiver`, `message`, `time`) VALUES
(31, 67, 76, 'hii', '2019-01-17 15:46:00'),
(32, 67, 76, 'hii', '2019-01-17 15:46:14'),
(33, 67, 76, 'hiii', '2019-01-17 15:47:50'),
(34, 67, 76, 'hiii', '2019-01-17 15:47:58'),
(35, 67, 76, 'hiii', '2019-01-17 15:47:59'),
(36, 67, 76, 'hiii', '2019-01-17 15:47:59'),
(37, 67, 76, 'hiii', '2019-01-17 15:47:59'),
(38, 67, 76, 'hiii', '2019-01-17 15:47:59'),
(39, 67, 76, 'hiii', '2019-01-17 15:48:00'),
(40, 67, 76, 'hiii', '2019-01-17 15:48:00'),
(41, 67, 76, 'hiii', '2019-01-17 15:48:00'),
(42, 67, 76, 'hiii', '2019-01-17 15:48:00'),
(43, 67, 76, 'hiii', '2019-01-17 15:48:00'),
(44, 67, 76, 'hiii', '2019-01-17 15:48:00'),
(45, 67, 76, 'hiii', '2019-01-17 15:48:01'),
(46, 67, 76, 'hiii', '2019-01-17 15:48:01'),
(47, 67, 76, 'hiii', '2019-01-17 15:48:02'),
(48, 67, 76, 'hiii', '2019-01-17 15:48:02'),
(49, 67, 76, 'hii', '2019-01-17 15:57:31'),
(50, 67, 76, 'haa bool', '2019-01-17 16:04:27'),
(51, 76, 67, 'haaa', '2019-01-17 16:08:03'),
(52, 67, 76, 'hiii', '2019-01-17 16:20:13'),
(54, 76, 67, 'haa bool sale', '2019-01-23 16:29:13'),
(55, 76, 67, 'haa bool saledfsdf', '2019-01-23 16:50:52'),
(56, 76, 67, 'hello', '2019-02-09 16:28:03'),
(57, 76, 67, 'hello', '2019-02-09 16:28:11'),
(58, 76, 67, 'hello', '2019-02-09 16:28:19'),
(59, 67, 76, 'heloo', '2019-02-09 16:28:54'),
(60, 76, 67, 'hello', '2019-02-09 16:29:28'),
(61, 67, 76, 'heloo', '2019-02-09 16:29:35'),
(62, 67, 76, 'heloo kutt', '2019-02-09 16:29:52'),
(63, 76, 67, 'hey bro', '2019-02-11 05:43:51');

-- --------------------------------------------------------

--
-- Table structure for table `usertable`
--

CREATE TABLE `usertable` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertable`
--

INSERT INTO `usertable` (`id`, `username`, `name`, `password`, `status`, `lastupdate`) VALUES
(67, 'gyanendra', 'gyanendra verma', 'qazqazqaz', 1, '2019-02-09 15:11:46'),
(68, 'prince123', 'prince', 'qazqazqaz', 0, '2019-02-09 14:51:38'),
(69, 'dheeraj12', 'dheeraj', 'qazqazqaz', 0, '2019-01-15 15:21:02'),
(70, 'anurag12', 'anurag', 'qazqazqaz', 0, '2019-01-15 14:15:05'),
(71, 'suman12', 'suman', 'suman123', 0, '2019-01-11 12:23:09'),
(72, 'arti12', 'arti', 'artikushwaha', 0, '2019-01-16 13:52:17'),
(73, 'rohit12', 'rohit', 'rohitAAO', 0, '2019-01-11 12:23:09'),
(74, 'maima121', 'mahimasingh', 'mahimaas', 0, '2019-01-14 09:52:21'),
(75, 'sumangyan', 'suman', 'qazqazqaz', 0, '2019-01-12 08:27:07'),
(76, 'utkarshverma', 'utkarsh', 'qazqazqaz', 1, '2019-01-23 16:04:15'),
(77, 'vikrantsingh', 'vikrant', 'qazqazqaz', 0, '2019-01-14 11:23:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profileimg`
--
ALTER TABLE `profileimg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relations`
--
ALTER TABLE `relations`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `usermessages`
--
ALTER TABLE `usermessages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usertable`
--
ALTER TABLE `usertable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profileimg`
--
ALTER TABLE `profileimg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `relations`
--
ALTER TABLE `relations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `usermessages`
--
ALTER TABLE `usermessages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `usertable`
--
ALTER TABLE `usertable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
