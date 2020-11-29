-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2020 at 09:10 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinemaplus`
--

-- --------------------------------------------------------

--
-- Table structure for table `movieslogin`
--

CREATE TABLE `movieslogin` (
  `UserId` varchar(100) NOT NULL,
  `LoginDate` date NOT NULL,
  `LoginTime` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `moviesreg`
--

CREATE TABLE `moviesreg` (
  `UserId` varchar(100) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `PhoneNo` varchar(20) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `RegDate` date NOT NULL,
  `RegTime` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `moviesreg`
--

INSERT INTO `moviesreg` (`UserId`, `Username`, `Email`, `PhoneNo`, `Password`, `RegDate`, `RegTime`) VALUES
('AQhJ909709POP-INN', 'Cinemaplus', 'cinemaplus@gmail.com', '0780000000', '53802ed7572d3cad78c662cf72e80516', '2019-09-13', '01:43:38');

-- --------------------------------------------------------

--
-- Table structure for table `movies_payment`
--

CREATE TABLE `movies_payment` (
  `MerchantRequestID` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `MovieId` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `SessionStatus` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `PayDate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `movies_store`
--

CREATE TABLE `movies_store` (
  `MovieId` varchar(100) NOT NULL,
  `OwnerId` varchar(100) NOT NULL,
  `MovieName` varchar(300) NOT NULL,
  `PicPath` varchar(3000) NOT NULL,
  `Movie` varchar(500) NOT NULL,
  `MoviePrice` int(10) UNSIGNED NOT NULL,
  `UploadDate` date NOT NULL,
  `UploadTime` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movies_store`
--

INSERT INTO `movies_store` (`MovieId`, `OwnerId`, `MovieName`, `PicPath`, `Movie`, `MoviePrice`, `UploadDate`, `UploadTime`) VALUES
('146472AsXS', 'AQhJ909709POP-INN', 'Happily Never After', 'Uploaded/Images/happy.jpg', 'https://spearman1-sano1.streaming.media.azure.net/221a0661-acb0-4f7c-be97-1d7cca8e0849/Happily Never After - 2017 Kenya.ism/manifest(format=mpd-time-csf)', 1, '2019-09-13', '01:58:56');

-- --------------------------------------------------------

--
-- Table structure for table `mpesa_c2b_data`
--

CREATE TABLE `mpesa_c2b_data` (
  `Receipt` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Amount` int(11) NOT NULL,
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `TransactionDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mpesa_data`
--

CREATE TABLE `mpesa_data` (
  `MerchantRequestID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `CheckoutRequestID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Receipt` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Amount` int(11) NOT NULL,
  `TransactionDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mpesa_errors`
--

CREATE TABLE `mpesa_errors` (
  `MerchantRequestID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `CheckoutRequestID` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ResultCode` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ResultDesc` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `moviesreg`
--
ALTER TABLE `moviesreg`
  ADD PRIMARY KEY (`UserId`);

--
-- Indexes for table `movies_payment`
--
ALTER TABLE `movies_payment`
  ADD PRIMARY KEY (`MerchantRequestID`);

--
-- Indexes for table `movies_store`
--
ALTER TABLE `movies_store`
  ADD PRIMARY KEY (`MovieId`);

--
-- Indexes for table `mpesa_c2b_data`
--
ALTER TABLE `mpesa_c2b_data`
  ADD PRIMARY KEY (`Receipt`);

--
-- Indexes for table `mpesa_data`
--
ALTER TABLE `mpesa_data`
  ADD PRIMARY KEY (`Receipt`),
  ADD KEY `MerchantRequestID` (`MerchantRequestID`);

--
-- Indexes for table `mpesa_errors`
--
ALTER TABLE `mpesa_errors`
  ADD PRIMARY KEY (`MerchantRequestID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
