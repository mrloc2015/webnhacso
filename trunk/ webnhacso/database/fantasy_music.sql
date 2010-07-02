-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 02, 2010 at 04:51 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `fantasy_music`
--

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SongID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Rate` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `RATING_USER` (`UserID`),
  KEY `RATING_SONG` (`SongID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=58 ;

--
-- Dumping data for table `rating`
--

