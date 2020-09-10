-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2020 at 02:44 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `personal_driver`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `adminName` varchar(50) NOT NULL,
  `adminPassword` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `adminName`, `adminPassword`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id` int(11) NOT NULL,
  `license` varchar(250) NOT NULL,
  `cost` double NOT NULL,
  `availability` text NOT NULL,
  `drivingLicenseNum` varchar(200) NOT NULL,
  `licenseExpiryYear` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id`, `license`, `cost`, `availability`, `drivingLicenseNum`, `licenseExpiryYear`) VALUES
(6, '17.jpg', 100, 'available', '123abc123', '2021-01-31'),
(7, '18.jpg', 120, 'available', '156a', '2022-06-30'),
(8, '16.jfif', 300, 'available', '3851', '0000-00-00'),
(17, 'internal_img_2.jpg', 120, 'available', '565156', '2022-06-17');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `descrption` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`, `descrption`) VALUES
(1, 'Town', 'Nyarugenge'),
(2, 'Town', 'Nyarugenge'),
(3, 'Kigali Heights, KG 7 Ave', 'Kimihurura'),
(4, 'Kigali Heights, KG 7 Ave', 'Kimihurura');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `adminid` int(11) NOT NULL,
  `date_signup` date NOT NULL,
  `descrption` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `bookdate` datetime NOT NULL,
  `userid` int(11) NOT NULL,
  `driverid` int(11) NOT NULL,
  `descrption` int(11) NOT NULL,
  `duration` datetime NOT NULL,
  `total_cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `bookdate`, `userid`, `driverid`, `descrption`, `duration`, `total_cost`) VALUES
(1, '2020-08-28 06:45:00', 1, 6, 0, '2020-08-29 06:45:00', 2400);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `dob` date NOT NULL,
  `gender` text NOT NULL,
  `password` text NOT NULL,
  `isdelete` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone`, `dob`, `gender`, `password`, `isdelete`) VALUES
(1, 'test12', 'test1@chauffeur.com', '078785163', '2000-01-31', 'Female', 'c4ca4238a0b923820dcc509a6f75849b', 'no'),
(5, 'Test5', 'test@mail.com', '0786465874', '1999-01-31', 'Male', 'c4ca4238a0b923820dcc509a6f75849b', 'no'),
(6, 'Leandre Duterimbere Bajeune', 'leandros@gmail.com', '0731234567', '1980-01-31', 'Male', 'c4ca4238a0b923820dcc509a6f75849b', 'no'),
(7, 'japonais', 'jap@hotmail.com', '0732222221', '1990-08-09', 'Female', 'c4ca4238a0b923820dcc509a6f75849b', 'no'),
(8, 'delete me', 'del@gmail.com', '0784612454', '1990-01-01', 'Female', 'c4ca4238a0b923820dcc509a6f75849b', 'no'),
(14, 'Jean Marie', 'safsd', '0785416128', '2018-04-13', 'Male', 'c4ca4238a0b923820dcc509a6f75849b', 'no'),
(15, 'fiston', 'daniel@gmail.com', '078884558', '2020-03-22', 'Male', '81dc9bdb52d04dc20036dbd8313ed055', 'no'),
(16, 'Adipopo Kwame', 'adokwame@gmail.com', '577541644', '1983-03-04', 'Male', 'c4ca4238a0b923820dcc509a6f75849b', 'no'),
(17, 'Faith Mbatha ', 'faith@gmail.com', '0784563189', '2022-08-31', 'Female', 'c4ca4238a0b923820dcc509a6f75849b', 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD KEY `id` (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adminid` (`adminid`),
  ADD KEY `usersid` (`userid`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `driverid` (`driverid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `driver`
--
ALTER TABLE `driver`
  ADD CONSTRAINT `id` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `adminid` FOREIGN KEY (`adminid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usersid` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `driverid` FOREIGN KEY (`driverid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userid` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
