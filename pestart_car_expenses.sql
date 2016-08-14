-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Aug 14, 2016 at 06:30 PM
-- Server version: 5.5.50-38.0-log
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pestart_car_expenses`
--

-- --------------------------------------------------------

--
-- Table structure for table `Cars`
--

CREATE TABLE IF NOT EXISTS `Cars` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) DEFAULT NULL,
  `Brand` varchar(50) DEFAULT NULL,
  `Model` varchar(50) DEFAULT NULL,
  `Year` varchar(5) DEFAULT NULL,
  `Color` varchar(50) DEFAULT NULL,
  `Mileage` int(11) DEFAULT NULL,
  `Fuel_ID` int(11) DEFAULT NULL,
  `Fuel_ID2` int(11) DEFAULT NULL,
  `Notes` mediumtext,
  PRIMARY KEY (`ID`),
  KEY `Fuel_ID` (`Fuel_ID`),
  KEY `Fuel_ID2` (`Fuel_ID2`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `Cars`
--

INSERT INTO `Cars` (`ID`, `UID`, `Brand`, `Model`, `Year`, `Color`, `Mileage`, `Fuel_ID`, `Fuel_ID2`, `Notes`) VALUES
(1, 1, 'BMW', '328i', '1998', 'Silver', 202085, 1, 3, NULL),
(5, 2, 'Wolkswagen', 'Golf2', '1991', 'Ð§ÐµÑ€Ð²ÐµÐ½', 532123, 1, 3, 'Moiata gordos!!!!'),
(6, 7, 'Opel', 'Astra', '1999', 'Ð—ÐµÐ»ÐµÐ½', 215150, 2, NULL, 'Ð—ÐµÐ»ÐµÐ½Ð°Ñ‚Ð° Ð¿Ñ€Ð°ÑˆÐºÐ°'),
(8, 6, 'BMW', '316', '1992', '4erwen', 519731, 2, NULL, 'IAKATA RAOTA'),
(9, 7, 'Mercedes', 'E220', '2006', 'Ð¡Ñ€ÐµÐ±ÑŠÑ€ÐµÐ½', 196000, 1, NULL, 'ÐšÐ¾Ñ€Ð°Ð±'),
(10, 7, 'Wolkswagen', 'Polo', '1998', 'Ð¡Ð¸Ð½', 521010, 1, 3, 'ÐœÐ°Ð»ÐºÐ¸Ñ');

-- --------------------------------------------------------

--
-- Table structure for table `Expense_2014`
--

CREATE TABLE IF NOT EXISTS `Expense_2014` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) DEFAULT NULL,
  `CID` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Mileage` int(11) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL,
  `Expense_ID` int(11) DEFAULT NULL,
  `Fuel_ID` int(11) DEFAULT NULL,
  `Insurance_ID` int(11) DEFAULT NULL,
  `Liters` int(11) DEFAULT NULL,
  `Notes` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Expense_2015`
--

CREATE TABLE IF NOT EXISTS `Expense_2015` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) DEFAULT NULL,
  `CID` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Mileage` int(11) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL,
  `Expense_ID` int(11) DEFAULT NULL,
  `Fuel_ID` int(11) DEFAULT NULL,
  `Insurance_ID` int(11) DEFAULT NULL,
  `Liters` int(11) DEFAULT NULL,
  `Notes` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `Expense_2015`
--

INSERT INTO `Expense_2015` (`ID`, `UID`, `CID`, `Date`, `Mileage`, `Price`, `Expense_ID`, `Fuel_ID`, `Insurance_ID`, `Liters`, `Notes`) VALUES
(26, 1, 1, '2015-06-06', 186154, 29, 1, 3, NULL, 31, NULL),
(27, 1, 1, '2015-06-06', 186155, 52, 1, 3, NULL, 52, NULL),
(28, 1, 1, '2015-06-06', 186157, 40, 1, 3, NULL, 40, NULL),
(29, 1, 1, '2015-06-06', 187823, 46, 1, 3, NULL, 50, NULL),
(30, 1, 1, '2015-06-06', 188162, 50, 1, 3, NULL, 54, NULL),
(31, 1, 1, '2015-06-06', 188620, 42, 1, 3, NULL, 43, NULL),
(32, 1, 1, '2015-06-06', 188881, 40, 1, 3, NULL, 40, NULL),
(33, 1, 1, '2015-06-06', 189626, 44, 1, 3, NULL, 52, NULL),
(34, 1, 1, '2015-06-06', 190000, 39, 1, 3, NULL, 41, NULL),
(35, 1, 1, '2015-06-06', 190532, 47, 1, 3, NULL, 52, NULL),
(36, 1, 1, '2015-06-06', 190722, 21, 1, 3, NULL, 24, NULL),
(37, 1, 1, '2015-06-06', 191122, 47, 1, 3, NULL, 54, NULL),
(38, 1, 1, '2015-08-08', 188162, 20, 1, 1, NULL, 8, NULL),
(39, 1, 1, '2015-08-08', 190346, 50, 1, 1, NULL, 20, NULL),
(40, 1, 1, '2015-08-08', 191122, 30, 1, 1, NULL, 15, NULL),
(41, 1, 1, '2015-06-06', 186155, 175, 4, NULL, NULL, NULL, ''),
(42, 1, 1, '2015-08-08', 186156, 400, 2, NULL, 2, NULL, ''),
(43, 1, 1, '2015-09-10', 186157, 280, 2, NULL, 1, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `Expense_2016`
--

CREATE TABLE IF NOT EXISTS `Expense_2016` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) DEFAULT NULL,
  `CID` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Mileage` int(11) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL,
  `Expense_ID` int(11) DEFAULT NULL,
  `Fuel_ID` int(11) DEFAULT NULL,
  `Insurance_ID` int(11) DEFAULT NULL,
  `Liters` int(11) DEFAULT NULL,
  `Notes` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `Expense_2016`
--

INSERT INTO `Expense_2016` (`ID`, `UID`, `CID`, `Date`, `Mileage`, `Price`, `Expense_ID`, `Fuel_ID`, `Insurance_ID`, `Liters`, `Notes`) VALUES
(1, 1, 1, '2016-01-01', 191300, 1070, 3, NULL, NULL, NULL, 'Ð¡Ð²ÐµÑ‰Ð¸, Ð±Ð¾Ð±Ð¸Ð½Ð¸, Ð´Ñ€.'),
(2, 1, 1, '2016-01-05', 191300, 127, 3, NULL, NULL, NULL, ''),
(3, 1, 1, '2016-01-12', 191300, 50, 1, 1, NULL, 24, ''),
(4, 1, 1, '2016-02-12', 191504, 100, 2, NULL, 2, NULL, ''),
(5, 1, 1, '2016-02-12', 191504, 65, 2, NULL, 1, NULL, ''),
(6, 1, 1, '2016-02-12', 191504, 45, 5, NULL, NULL, NULL, 'Ð“Ð¾Ð´Ð¸ÑˆÐµÐ½ Ð¿Ñ€ÐµÐ³Ð»ÐµÐ´.'),
(7, 1, 1, '2016-08-12', 191504, 97, 5, NULL, NULL, NULL, 'Ð’Ð¸Ð½ÐµÑ‚ÐºÐ°. ÐžÐ±Ð¸Ñ€.'),
(8, 1, 1, '2016-01-12', 191504, 38, 1, 3, NULL, 43, ''),
(9, 1, 1, '2016-08-12', 191967, 140, 3, NULL, NULL, NULL, ''),
(10, 1, 1, '2016-08-12', 192188, 25, 1, 3, NULL, 31, ''),
(11, 1, 1, '2016-08-12', 192544, 33, 1, 3, NULL, 40, ''),
(12, 1, 1, '2016-03-12', 192852, 166, 4, NULL, NULL, NULL, ''),
(13, 1, 1, '2016-08-12', 192928, 38, 1, 3, NULL, 48, ''),
(14, 1, 1, '2016-08-12', 192928, 34, 1, 3, NULL, 41, ''),
(15, 1, 1, '2016-08-12', 193792, 29, 1, 3, NULL, 37, ''),
(16, 1, 1, '2016-08-12', 194271, 42, 1, 3, NULL, 52, ''),
(17, 1, 1, '2016-08-12', 194618, 33, 1, 3, NULL, 40, ''),
(18, 1, 1, '2016-08-12', 194972, 29, 1, 3, NULL, 38, ''),
(19, 1, 1, '2016-08-12', 195385, 67, 2, NULL, 1, NULL, ''),
(20, 1, 1, '2016-08-12', 195385, 107, 2, NULL, 2, NULL, ''),
(21, 1, 1, '2016-08-12', 195385, 42, 1, 3, NULL, 54, ''),
(22, 1, 1, '2016-08-12', 195688, 26, 1, 3, NULL, 34, ''),
(23, 1, 1, '2016-08-12', 196052, 37, 1, 3, NULL, 47, ''),
(24, 1, 1, '2016-08-12', 196768, 35, 1, 3, NULL, 39, ''),
(25, 1, 1, '2016-08-12', 196768, 20, 1, 1, NULL, 10, ''),
(26, 1, 1, '2016-08-12', 197629, 37, 1, 3, NULL, 39, ''),
(27, 1, 1, '2016-08-12', 197772, 26, 1, 3, NULL, 39, ''),
(28, 1, 1, '2016-08-12', 198240, 50, 1, 1, NULL, 26, ''),
(29, 1, 1, '2016-08-12', 198344, 47, 1, 3, NULL, 53, ''),
(30, 1, 1, '2016-08-12', 198344, 60, 3, NULL, NULL, NULL, 'Ð—Ð°Ñ€ÐµÐ¶Ð´Ð°Ð½Ðµ Ñ„Ñ€ÐµÐ¾Ð½ Ð½Ð° ÐºÐ»Ð¸Ð¼Ð°Ñ‚Ð¸Ðº'),
(31, 1, 1, '2016-08-12', 198786, 24, 1, 3, NULL, 30, ''),
(32, 1, 1, '2016-08-12', 199181, 44, 1, 3, NULL, 54, ''),
(33, 1, 1, '2016-08-12', 199181, 870, 3, NULL, NULL, NULL, 'Ð¡Ð¼ÑÐ½Ð° Ð½Ð° Ð³ÑƒÐ¼Ð¸'),
(34, 1, 1, '2016-08-12', 199181, 20, 1, 3, NULL, 30, ''),
(35, 1, 1, '2016-08-12', 199802, 41, 1, 3, NULL, 49, ''),
(36, 1, 1, '2016-08-12', 199802, 64, 2, NULL, 1, NULL, ''),
(37, 1, 1, '2016-08-12', 199802, 100, 2, NULL, 2, NULL, ''),
(38, 1, 1, '2016-08-12', 199802, 105, 3, NULL, NULL, NULL, 'Ð£Ð¿Ð»ÑŠÑ‚Ð½ÐµÐ½Ð¸Ðµ Ð½Ð° Ð¿Ñ€ÐµÐ´Ð½Ð¾ ÑÑ‚ÑŠÐºÐ»Ð¾.'),
(39, 1, 1, '2016-08-12', 200192, 30, 1, 3, NULL, 38, ''),
(40, 1, 1, '2016-08-12', 200541, 41, 1, 3, NULL, 47, ''),
(41, 1, 1, '2016-08-12', 200837, 37, 1, 3, NULL, 45, ''),
(42, 1, 1, '2016-08-12', 201075, 20, 1, 1, NULL, 9, ''),
(43, 1, 1, '2016-08-12', 201075, 34, 1, 3, NULL, 37, ''),
(44, 1, 1, '2016-08-12', 201448, 41, 1, 3, NULL, 51, ''),
(45, 1, 1, '2016-08-12', 201778, 40, 1, 3, NULL, 45, ''),
(46, 1, 1, '2016-08-12', 202085, 38, 1, 3, NULL, 44, ''),
(49, 7, 6, '2016-08-14', 215150, 20, 1, 1, NULL, 8, ''),
(50, 7, 9, '2016-08-14', 196000, 250, 4, NULL, NULL, NULL, ''),
(51, 7, 6, '2016-08-14', 215150, 50, 2, NULL, 1, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `Expense_Types`
--

CREATE TABLE IF NOT EXISTS `Expense_Types` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Expense_Types`
--

INSERT INTO `Expense_Types` (`ID`, `Name`) VALUES
(1, 'Fuel'),
(2, 'Insurance'),
(3, 'Maintenance'),
(4, 'Tax'),
(5, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `Fuel_Types`
--

CREATE TABLE IF NOT EXISTS `Fuel_Types` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `Fuel_Types`
--

INSERT INTO `Fuel_Types` (`ID`, `Name`) VALUES
(1, 'Gas'),
(2, 'Diesel'),
(3, 'LPG'),
(4, 'Methane'),
(5, 'Electricity'),
(6, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `Insurance_Types`
--

CREATE TABLE IF NOT EXISTS `Insurance_Types` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `Insurance_Types`
--

INSERT INTO `Insurance_Types` (`ID`, `Name`) VALUES
(1, 'GO'),
(2, 'Kasko'),
(3, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `Group` varchar(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Fname` varchar(120) DEFAULT NULL,
  `Lname` varchar(120) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `Sex` varchar(10) DEFAULT NULL,
  `Notes` mediumtext,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`ID`, `Username`, `Password`, `Group`, `Email`, `Fname`, `Lname`, `City`, `Sex`, `Notes`) VALUES
(1, 'Admin', '$2y$10$hgkmyGrpPTCwgekgqNCgOOTnwdHWD5StseswCRaxYYv6M6ZimVQD2', 'admins', 'petar.stoyanov@gmail.com', 'ÐŸÐµÑ‚ÑŠÑ€', 'Ð¡Ñ‚Ð¾ÑÐ½Ð¾Ð²', 'Ð¡Ð¾Ñ„Ð¸Ñ', 'male', NULL),
(2, 'ivan85', '$2y$10$vmVAhpL44R9.siVX5ElAOOKMFOzI50FsSeVOCRT18iK8Z/Nrlfche', 'users', 'ivan@abv.bg', 'Ð˜Ð²Ð°Ð½', 'Ð˜Ð²Ð°Ð½Ð¾Ð²', 'ÐŸÐµÑ€Ð½Ð¸Ðº', 'male', ''),
(6, 'stamat13', '$2y$10$hgkmyGrpPTCwgekgqNCgOOTnwdHWD5StseswCRaxYYv6M6ZimVQD2', 'users', 'stamat@abv.bg', 'Stamat', 'Stamatov', 'Tutrakan', 'male', ''),
(7, 'nadia3', '$2y$10$GShBkcTqd/Vasc5QfoQZ0OHmsAICcJJ9RT5FrFEYawTn4F2Ix6xPi', 'users', 'nade@abv.bg', 'ÐÐ°Ð´ÐµÐ¶Ð´Ð°', 'ÐšÐ¾ÑÑ‚Ð¾Ð²Ð°', 'Ð¢ÐµÑ‚ÐµÐ²ÐµÐ½', 'female', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Cars`
--
ALTER TABLE `Cars`
  ADD CONSTRAINT `Cars_ibfk_1` FOREIGN KEY (`Fuel_ID`) REFERENCES `Fuel_Types` (`ID`),
  ADD CONSTRAINT `Cars_ibfk_2` FOREIGN KEY (`Fuel_ID2`) REFERENCES `Fuel_Types` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
