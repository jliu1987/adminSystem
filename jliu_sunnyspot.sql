-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 14, 2023 at 04:20 PM
-- Server version: 5.7.42
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jliu_sunnyspot`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `staffID` bigint(20) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `mobile` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`staffID`, `userName`, `password`, `firstName`, `lastName`, `address`, `mobile`) VALUES
(1, 'admin', '1c0b76fce779f78f51be339c49445c49', 'wendy', 'liu', '34 mobbs lane', ''),
(2, 'coolBro123', 'e10adc3949ba59abbe56e057f20f883e', 'chris', 'liu', '34 mobbs lane', ''),
(4, 'test', 'e10adc3949ba59abbe56e057f20f883e', 'new', 'man', 'dsf 3', '04212588'),
(5, 'test1', 'e10adc3949ba59abbe56e057f20f883e', 'new1', 'man', 'dsf 3', '04212588'),
(6, 'test2', 'e10adc3949ba59abbe56e057f20f883e', 'new2', 'man', 'dsf 3', '04212588');

-- --------------------------------------------------------

--
-- Table structure for table `cabin`
--

CREATE TABLE `cabin` (
  `cabinID` bigint(20) NOT NULL,
  `cabinType` varchar(150) NOT NULL,
  `cabinDescription` varchar(255) DEFAULT NULL,
  `pricePerNight` bigint(10) NOT NULL,
  `pricePerWeek` decimal(10,2) NOT NULL,
  `photo` varchar(50) DEFAULT 'testCabin.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cabin`
--

INSERT INTO `cabin` (`cabinID`, `cabinType`, `cabinDescription`, `pricePerNight`, `pricePerWeek`, `photo`) VALUES
(1, 'Standard cabin sleeps 4', 'A 2 bedroom cabin with double in main and either double or 2 singles in the second bedroom', 100, 500.00, 'stCabin.jpg'),
(2, 'Standard open plan cabin sleeps 4', 'An open plan cabin with double bed and set of bunks', 120, 600.00, 'stOpenCabin.jpg'),
(3, 'Deluxe cabin sleeps 4', 'A 2 bedroom cabin with queen bed and 2 singles in the second bedroom', 140, 700.00, 'deluxCabin.jpg'),
(4, 'Villa sleeps 4', 'A 2 bedroom cabin with queen bed plus another bedroom with 2 single beds', 150, 750.00, 'villa.jpg'),
(5, 'Spa villa sleeps 4', 'A 2 bedroom cabin with queen bed plus another bedroom with 2 single beds and spa bath', 200, 1000.00, 'spaVilla.jpg'),
(6, 'Grass powered site', 'Powered sites on grass', 40, 200.00, 'grassPower.jpg'),
(7, 'Slab powered ', '       Powered sites with slab', 50, 250.00, 'slabPower.jpg'),
(25, 'update cabin 1', 'update cabin without', 100, 500.00, 'insertCabin1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cabininclusion`
--

CREATE TABLE `cabininclusion` (
  `cabinIncID` bigint(20) NOT NULL,
  `incID` bigint(20) NOT NULL,
  `cabinID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cabininclusion`
--

INSERT INTO `cabininclusion` (`cabinIncID`, `incID`, `cabinID`) VALUES
(1, 1, 1),
(2, 6, 1),
(3, 8, 1),
(4, 2, 2),
(5, 5, 2),
(6, 6, 2),
(7, 8, 2),
(8, 11, 2),
(9, 3, 3),
(10, 4, 3),
(11, 7, 3),
(12, 8, 3),
(13, 10, 3),
(14, 11, 3),
(15, 3, 4),
(16, 4, 4),
(17, 7, 4),
(18, 8, 4),
(19, 9, 4),
(20, 10, 4),
(21, 11, 4),
(22, 3, 5),
(23, 4, 5),
(24, 7, 5),
(25, 8, 5),
(26, 9, 5),
(27, 10, 5),
(28, 11, 5),
(29, 6, 3),
(59, 2, 25),
(60, 4, 25);

-- --------------------------------------------------------

--
-- Table structure for table `inclusion`
--

CREATE TABLE `inclusion` (
  `incID` bigint(20) NOT NULL,
  `incName` varchar(50) NOT NULL,
  `incDetails` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inclusion`
--

INSERT INTO `inclusion` (`incID`, `incName`, `incDetails`) VALUES
(1, '1 bathroom', ''),
(2, '1+ bathroom', '1 bathroom and separate toilet'),
(3, '2 bathroom', ''),
(4, 'Air conditioner', 'Reverse cycle'),
(5, 'Ceiling fans', ''),
(6, 'Bunk bed', ''),
(7, '2 single beds', ''),
(8, 'Double bed', ''),
(9, 'Dishwasher', ''),
(10, 'DVD Player', ''),
(11, 'Hair dryer', '');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `logID` bigint(20) NOT NULL,
  `staffID` bigint(20) NOT NULL,
  `loginDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logoutDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`logID`, `staffID`, `loginDateTime`, `logoutDateTime`) VALUES
(60, 2, '2023-06-14 02:15:01', '2023-06-14 04:09:02'),
(61, 2, '2023-06-14 04:09:01', '2023-06-14 04:09:02'),
(62, 2, '2023-06-14 04:09:04', '2023-06-14 04:09:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`staffID`);

--
-- Indexes for table `cabin`
--
ALTER TABLE `cabin`
  ADD PRIMARY KEY (`cabinID`);

--
-- Indexes for table `cabininclusion`
--
ALTER TABLE `cabininclusion`
  ADD PRIMARY KEY (`cabinIncID`),
  ADD KEY `incID` (`incID`),
  ADD KEY `cabinID` (`cabinID`);

--
-- Indexes for table `inclusion`
--
ALTER TABLE `inclusion`
  ADD PRIMARY KEY (`incID`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`logID`),
  ADD KEY `staffID` (`staffID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `staffID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cabin`
--
ALTER TABLE `cabin`
  MODIFY `cabinID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `cabininclusion`
--
ALTER TABLE `cabininclusion`
  MODIFY `cabinIncID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `inclusion`
--
ALTER TABLE `inclusion`
  MODIFY `incID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `logID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cabininclusion`
--
ALTER TABLE `cabininclusion`
  ADD CONSTRAINT `cabininclusion_ibfk_1` FOREIGN KEY (`incID`) REFERENCES `inclusion` (`incID`),
  ADD CONSTRAINT `cabininclusion_ibfk_2` FOREIGN KEY (`cabinID`) REFERENCES `cabin` (`cabinID`);

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`staffID`) REFERENCES `admin` (`staffID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
