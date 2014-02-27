
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 26, 2014 at 10:47 PM
-- Server version: 5.1.61
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `u342178811_ps`
--

-- --------------------------------------------------------

--
-- Table structure for table `ComputerScienceProjects`
--

CREATE TABLE IF NOT EXISTS `ComputerScienceProjects` (
  `Title` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Description` text COLLATE utf8_unicode_ci NOT NULL,
  `Skills Required` text COLLATE utf8_unicode_ci NOT NULL,
  `Deadlines` date NOT NULL,
  `Provided Documents` int(11) NOT NULL,
  `Team Size` int(11) NOT NULL,
  `Paid/Unpaid` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `Department` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Title`),
  FULLTEXT KEY `Skills Required` (`Skills Required`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ProfileFormTable`
--

CREATE TABLE IF NOT EXISTS `ProfileFormTable` (
  `ID` int(11) NOT NULL,
  `Name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Skills` text COLLATE utf8_unicode_ci NOT NULL,
  `Education` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Classification` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Major` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Experience` text COLLATE utf8_unicode_ci NOT NULL,
  `Picture` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
