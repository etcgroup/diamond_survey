-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 07, 2013 at 04:31 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `diamond_survey`
--

-- --------------------------------------------------------

--
-- Table structure for table `likert`
--

CREATE TABLE IF NOT EXISTS `likert` (
  `response_id` int(11) NOT NULL,
  `question` varchar(100) NOT NULL,
  `answer` int(11) NOT NULL,
  UNIQUE KEY `response_id` (`response_id`,`question`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `open_ended`
--

CREATE TABLE IF NOT EXISTS `open_ended` (
  `response_id` int(11) NOT NULL,
  `scenario` int(1) DEFAULT NULL,
  `question` varchar(50) NOT NULL,
  `answer` text NOT NULL,
  UNIQUE KEY `repsonse_id` (`response_id`,`scenario`,`question`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE IF NOT EXISTS `responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mturk_token` varchar(50) NOT NULL,
  `started` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mturk_token` (`mturk_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=106 ;

-- --------------------------------------------------------

--
-- Table structure for table `sorted`
--

CREATE TABLE IF NOT EXISTS `sorted` (
  `response_id` int(11) NOT NULL,
  `question` varchar(100) NOT NULL,
  `item` varchar(100) NOT NULL,
  `order` int(11) NOT NULL,
  UNIQUE KEY `response_id` (`response_id`,`question`,`item`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

CREATE TABLE IF NOT EXISTS `time` (
  `response_id` int(11) NOT NULL,
  `action` varchar(100) NOT NULL,
  `session` int(11) NOT NULL,
  `time` int(11) NOT NULL COMMENT 'in seconds',
  UNIQUE KEY `response_id` (`response_id`,`action`,`session`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
