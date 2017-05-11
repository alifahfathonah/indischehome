-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 11, 2017 at 07:41 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `indischehome`
--

-- --------------------------------------------------------

--
-- Table structure for table `ind_camera`
--

CREATE TABLE `ind_camera` (
  `CameraID` int(11) NOT NULL,
  `Source` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ind_camera`
--

INSERT INTO `ind_camera` (`CameraID`, `Source`) VALUES
(1, '10.19.102.206'),
(2, '10.19.8.9'),
(3, '10.19.39.27'),
(4, '10.19.88.159');

-- --------------------------------------------------------

--
-- Table structure for table `ind_order`
--

CREATE TABLE `ind_order` (
  `OrderID` int(11) NOT NULL,
  `PackageID` int(11) NOT NULL,
  `PaymentID` int(11) NOT NULL,
  `DateCreated` date NOT NULL,
  `DateExpired` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ind_order`
--

INSERT INTO `ind_order` (`OrderID`, `PackageID`, `PaymentID`, `DateCreated`, `DateExpired`) VALUES
(1, 1, 1, '2017-04-26', '2017-05-26'),
(2, 2, 2, '2017-04-23', '2017-05-23'),
(3, 3, 1, '2017-04-24', '2017-05-24');

-- --------------------------------------------------------

--
-- Table structure for table `ind_package`
--

CREATE TABLE `ind_package` (
  `PackageID` int(11) NOT NULL,
  `PackageName` varchar(255) NOT NULL,
  `Price` int(11) NOT NULL,
  `CameraQty` int(11) NOT NULL,
  `Storage` int(11) NOT NULL,
  `Duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ind_package`
--

INSERT INTO `ind_package` (`PackageID`, `PackageName`, `Price`, `CameraQty`, `Storage`, `Duration`) VALUES
(1, 'Bronze', 10, 1, 100, 5),
(2, 'Silver', 20, 2, 500, 15),
(3, 'Gold', 40, 4, 1000, 30);

-- --------------------------------------------------------

--
-- Table structure for table `ind_payment`
--

CREATE TABLE `ind_payment` (
  `PaymentID` int(11) NOT NULL,
  `PaymentName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ind_payment`
--

INSERT INTO `ind_payment` (`PaymentID`, `PaymentName`) VALUES
(1, 'Bank Islam'),
(2, 'CIMB'),
(3, 'Maybank2U');

-- --------------------------------------------------------

--
-- Table structure for table `ind_user`
--

CREATE TABLE `ind_user` (
  `UserID` int(11) NOT NULL,
  `OrderID` int(11) DEFAULT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `UserLevel` enum('admin','user') NOT NULL,
  `Status` varchar(255) NOT NULL,
  `ActivationKey` varchar(255) DEFAULT NULL,
  `Joined` date NOT NULL,
  `ProfilePicture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ind_user`
--

INSERT INTO `ind_user` (`UserID`, `OrderID`, `Username`, `Password`, `Email`, `FullName`, `Address`, `UserLevel`, `Status`, `ActivationKey`, `Joined`, `ProfilePicture`) VALUES
(1, 3, 'rifqi96', 'password', 'rifqi96b@yahoo.com', 'Achmad Rifqi Ruhyattamam', 'Cimone, Tangerang, Indonesia', 'admin', 'active', NULL, '0000-00-00', NULL),
(2, 1, 'rifqi96a', 'password', 'rifqi96@gmail.com', 'Rifqi Ruhyattamam', 'Cimone, Tangerang, Indonesia', 'user', 'active', NULL, '0000-00-00', NULL),
(3, 2, 'rifqi96b', 'password', 'rifqi96a@hotmail.com', 'Rifqi', 'Indonesia', 'user', 'inactive', NULL, '0000-00-00', NULL),
(29, NULL, 'rifqi96c', 'password', 'rifqi96@yahoo.com', 'Rifqi R', 'Cimone, Indonesia', 'user', 'active', 'a50d9d5bbd62bcdc8b07c608dbd038319ab25c71', '2017-05-09', NULL),
(30, 3, 'levi', 'password', 'levihanny_96@hotmail.com', 'Levi Hanny', 'indonesia', 'user', 'active', 'd81d4a6c09e5bff0264c81dc904d6ab62ac2b3b1', '2017-05-11', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ind_camera`
--
ALTER TABLE `ind_camera`
  ADD PRIMARY KEY (`CameraID`);

--
-- Indexes for table `ind_order`
--
ALTER TABLE `ind_order`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `ind_package`
--
ALTER TABLE `ind_package`
  ADD PRIMARY KEY (`PackageID`);

--
-- Indexes for table `ind_payment`
--
ALTER TABLE `ind_payment`
  ADD PRIMARY KEY (`PaymentID`);

--
-- Indexes for table `ind_user`
--
ALTER TABLE `ind_user`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Username`),
  ADD KEY `FK_PackageID` (`OrderID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ind_camera`
--
ALTER TABLE `ind_camera`
  MODIFY `CameraID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ind_package`
--
ALTER TABLE `ind_package`
  MODIFY `PackageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ind_user`
--
ALTER TABLE `ind_user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
