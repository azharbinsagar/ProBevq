-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 10, 2021 at 06:19 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bevq`
--

-- --------------------------------------------------------

--
-- Table structure for table `homedelivery`
--

DROP TABLE IF EXISTS `homedelivery`;
CREATE TABLE IF NOT EXISTS `homedelivery` (
  `hid` int(5) NOT NULL AUTO_INCREMENT,
  `sid` int(5) NOT NULL,
  `pname` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` bigint(12) NOT NULL,
  `address` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `pincode` bigint(12) NOT NULL,
  `status` int(5) NOT NULL,
  PRIMARY KEY (`hid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `homedelivery`
--

INSERT INTO `homedelivery` (`hid`, `sid`, `pname`, `name`, `phone`, `address`, `district`, `pincode`, `status`) VALUES
(8, 5, 'MC Dowells', 'Azhar', 9495927099, 'Jubail Tower', 'Pathanamthitta', 689645, 1);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `locid` int(5) NOT NULL AUTO_INCREMENT,
  `locname` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`locid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `login_id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` smallint(3) NOT NULL,
  PRIMARY KEY (`login_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `username`, `password`, `type`) VALUES
(1, 'admin', '$2y$10$id1hQbjfcwsSN6Dlu/BbAuVgNPcj6..ly65v6TRs7XnXpVYwkGHGy', 0),
(17, 'azhar@yahoo.com', '$2y$10$SrqL4Rtp.vb6.n5vGsFRnO.KBDxD1nxdL5LRXUpBNUk.Wbtv.Huoa', 1),
(15, 'Arjungodzarjun@gmail.com', '$2y$10$id1hQbjfcwsSN6Dlu/BbAuVgNPcj6..ly65v6TRs7XnXpVYwkGHGy', 2),
(16, 'Mrunwontedarjun@gmail.com', '$2y$10$w077wUYDfUlxTRUGSLcv0e80ob6GGwPpKewzDqsSafYv1P28TXMiq', 1);

-- --------------------------------------------------------

--
-- Table structure for table `outlet`
--

DROP TABLE IF EXISTS `outlet`;
CREATE TABLE IF NOT EXISTS `outlet` (
  `sid` int(5) NOT NULL AUTO_INCREMENT,
  `shopname` varchar(50) NOT NULL,
  `licnumber` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  `pincode` int(11) NOT NULL,
  `phone` bigint(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outlet`
--

INSERT INTO `outlet` (`sid`, `shopname`, `licnumber`, `location`, `pincode`, `phone`, `email`) VALUES
(5, 'Consumerfed PTA', 'KL/12/2020/MP', 'Pathanamthitta', 689647, 9207245270, 'Arjungodzarjun@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `outletpurchase`
--

DROP TABLE IF EXISTS `outletpurchase`;
CREATE TABLE IF NOT EXISTS `outletpurchase` (
  `opid` int(5) NOT NULL AUTO_INCREMENT,
  `sid` int(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` bigint(12) NOT NULL,
  `date` datetime DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`opid`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outletpurchase`
--

INSERT INTO `outletpurchase` (`opid`, `sid`, `name`, `phone`, `date`, `status`) VALUES
(23, 5, 'Azhar', 9495927099, '2021-01-09 17:05:28', 1),
(24, 5, 'Azhar', 9495927099, '2021-01-10 11:46:58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `pid` int(5) NOT NULL AUTO_INCREMENT,
  `sid` int(5) NOT NULL,
  `pname` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `cat` varchar(100) NOT NULL,
  `stock` bigint(5) NOT NULL,
  `amount` bigint(5) NOT NULL,
  `img` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `sid`, `pname`, `qty`, `cat`, `stock`, `amount`, `img`) VALUES
(3, 5, 'MH', '1', 'Brandy', 10, 750, 1),
(4, 5, 'MC Dowells', 'Full', 'Rum', 1, 850, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(12) NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `name`, `email`, `phone`) VALUES
(10, 'Arjun', 'Mrunwontedarjun@gmail.com', 7025708440),
(11, 'Azhar', 'azhar@yahoo.com', 9495927099);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
