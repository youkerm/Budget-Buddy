-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2016 at 09:59 PM
-- Server version: 5.5.53-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `budgetdash`
--

-- --------------------------------------------------------

--
-- Table structure for table `Accounts`
--

CREATE TABLE IF NOT EXISTS `Accounts` (
  `AccountID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `AccountType` varchar(30) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`AccountID`),
  UNIQUE KEY `AccountID` (`AccountID`),
  KEY `UserID` (`UserID`),
  KEY `AccountID_2` (`AccountID`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=7 ;

--
-- Dumping data for table `Accounts`
--

INSERT INTO `Accounts` (`AccountID`, `UserID`, `AccountType`, `Amount`) VALUES
(2, 5, 'Checkings', '500.00'),
(3, 6, 'Checkings', '500.00'),
(4, 7, 'Arrow', '3.90'),
(5, 8, 'Savings', '40000.00'),
(6, 9, 'Checkings', '10000.00');

-- --------------------------------------------------------

--
-- Table structure for table `Expense`
--

CREATE TABLE IF NOT EXISTS `Expense` (
  `ExpenseID` int(11) NOT NULL AUTO_INCREMENT,
  `AccountID` int(11) NOT NULL,
  `Catagory` int(11) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`ExpenseID`),
  KEY `Catagory` (`Catagory`),
  KEY `ID` (`AccountID`),
  KEY `ExpenseID` (`ExpenseID`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Expense`
--

INSERT INTO `Expense` (`ExpenseID`, `AccountID`, `Catagory`, `Amount`, `Date`) VALUES
(3, 6, 1, '500.00', '2016-11-10'),
(4, 2, 1, '1200.00', '2016-11-09');

-- --------------------------------------------------------

--
-- Table structure for table `ExpenseCatagory`
--

CREATE TABLE IF NOT EXISTS `ExpenseCatagory` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ExpenseCatagory`
--

INSERT INTO `ExpenseCatagory` (`ID`, `name`) VALUES
(1, 'Rent'),
(2, 'Food'),
(3, 'Gas'),
(4, 'Utilities'),
(5, 'Miscellaneous');

-- --------------------------------------------------------

--
-- Table structure for table `Revenue`
--

CREATE TABLE IF NOT EXISTS `Revenue` (
  `Revenue_ID` int(11) NOT NULL AUTO_INCREMENT,
  `AccountID` int(11) NOT NULL,
  `Revenue_Name` varchar(20) NOT NULL,
  `Revenue_Amount` decimal(11,2) NOT NULL,
  `Revenue_Term` int(11) NOT NULL COMMENT '0=One time, 1=Weekly, 2=Biweekly, 3=Monthly',
  PRIMARY KEY (`Revenue_ID`),
  KEY `AccountID` (`AccountID`),
  KEY `Revenue_ID` (`Revenue_ID`),
  KEY `Revenue_ID_2` (`Revenue_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=11 ;

--
-- Dumping data for table `Revenue`
--

INSERT INTO `Revenue` (`Revenue_ID`, `AccountID`, `Revenue_Name`, `Revenue_Amount`, `Revenue_Term`) VALUES
(6, 3, 'Cash', '100.00', 0),
(7, 4, 'Intrest', '25.00', 0),
(8, 5, 'Findings', '85.00', 0),
(9, 6, 'Earnings', '400.00', 0),
(10, 2, 'Miscs', '75.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET latin1 NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 NOT NULL,
  `FirstN` varchar(20) NOT NULL,
  `LastN` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=10 ;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`ID`, `username`, `password`, `FirstN`, `LastN`) VALUES
(2, 'test', 'test', 'test', 'test'),
(3, 'youkergav', '', 'Gavin', 'Youker'),
(4, 'Zaozin', 'Yeaz0geau', 'Greg', 'Stein'),
(5, 'test101', 'test101', 'Mitchell', 'Youker'),
(6, 'jonny', 'm8', 'Jonny', 'Brown'),
(7, 'PlsNotAgain', 'Nooo', 'Three Arrows', 'Borromir'),
(8, 'JCespedes', 'JCespedes', 'Jessica', 'Cespedes'),
(9, 'PJackson', 'test', 'Penelope', 'Jackson');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Accounts`
--
ALTER TABLE `Accounts`
  ADD CONSTRAINT `Accounts_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `User` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Expense`
--
ALTER TABLE `Expense`
  ADD CONSTRAINT `Expense_ibfk_1` FOREIGN KEY (`AccountID`) REFERENCES `Accounts` (`AccountID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Revenue`
--
ALTER TABLE `Revenue`
  ADD CONSTRAINT `Revenue_ibfk_1` FOREIGN KEY (`AccountID`) REFERENCES `Accounts` (`AccountID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
