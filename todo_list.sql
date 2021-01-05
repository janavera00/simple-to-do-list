-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2021 at 08:37 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todo_list`
--

-- --------------------------------------------------------

--
-- Table structure for table `subtask`
--

CREATE TABLE `subtask` (
  `subtaskno` int(11) NOT NULL,
  `mainTask` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subtask`
--

INSERT INTO `subtask` (`subtaskno`, `mainTask`, `name`, `date`, `status`) VALUES
(1, 1, 'Programming', '2020-12-17', 0),
(2, 1, 'Database', '2020-12-17', 0),
(3, 3, 'Morning', '2020-12-28', 1),
(4, 4, 'breakfast', '2020-12-28', 0),
(5, 4, 'lunch', '2020-12-28', 0),
(6, 5, 'Database', '2020-12-28', 0),
(7, 5, 'Method', '2020-12-28', 0),
(14, 10, 'ok', '2021-01-05', 1),
(15, 11, 'Eat', '2021-01-05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `taskno` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`taskno`, `name`, `date`, `status`) VALUES
(1, 'Study', '2020-12-17', 0),
(2, 'Shower', '2020-12-17', 0),
(3, 'Be Lazy', '2020-12-28', 1),
(4, 'Eat', '2020-12-28', 0),
(5, 'Study', '2020-12-28', 0),
(10, 'Sleep', '2021-01-05', 1),
(11, 'Be Lazy', '2021-01-05', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subtask`
--
ALTER TABLE `subtask`
  ADD PRIMARY KEY (`subtaskno`),
  ADD KEY `MainTask` (`mainTask`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`taskno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subtask`
--
ALTER TABLE `subtask`
  MODIFY `subtaskno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `taskno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `subtask`
--
ALTER TABLE `subtask`
  ADD CONSTRAINT `MainTask` FOREIGN KEY (`mainTask`) REFERENCES `task` (`taskno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
