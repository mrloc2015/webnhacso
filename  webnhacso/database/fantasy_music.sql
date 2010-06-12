-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 10, 2010 at 06:00 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `fantasy_music`
--

-- --------------------------------------------------------

--
-- Table structure for table `banned`
--

CREATE TABLE IF NOT EXISTS `banned` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DateBanned` date DEFAULT NULL,
  `DataUnbanned` date DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `BANNED_USER` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `banned`
--


-- --------------------------------------------------------

--
-- Table structure for table `bit_rate`
--

CREATE TABLE IF NOT EXISTS `bit_rate` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BitRate` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `bit_rate`
--

INSERT INTO `bit_rate` (`ID`, `BitRate`) VALUES
(1, 32),
(2, 64),
(3, 128),
(4, 192),
(5, 256),
(6, 320);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) DEFAULT NULL,
  `SongID` int(11) DEFAULT NULL,
  `CreateDate` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `COMMENT_USER` (`UserID`),
  KEY `COMMENT_SONG` (`SongID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `comment`
--


-- --------------------------------------------------------

--
-- Table structure for table `comment_detail`
--

CREATE TABLE IF NOT EXISTS `comment_detail` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CommentID` int(11) DEFAULT NULL,
  `Content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `CONTENT_COMMENT` (`CommentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `comment_detail`
--


-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Local` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=64 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`ID`, `Local`) VALUES
(1, 'An Giang'),
(2, 'Bà Rịa Vũng Tàu'),
(3, 'Bạc Liêu'),
(4, 'Bắc Cạn'),
(5, 'Bắc Giang'),
(6, 'Bắc Ninh'),
(7, 'Bến Tre'),
(8, 'Bình Dương'),
(9, 'Bình Định'),
(10, 'BÌnh Phước'),
(11, 'Bình Thuận'),
(12, 'Cà Mau'),
(13, 'Cao Bằng'),
(14, 'Cần Thơ'),
(15, 'Đà Nẵng'),
(16, 'Đắc Lắk'),
(17, 'Đắc Nông'),
(18, 'Điện Biên'),
(19, 'Đồng Nai'),
(20, 'Đồng Tháp'),
(21, 'Gia Lai'),
(22, 'Hà Giang'),
(23, 'Hà Nam'),
(24, 'Hà Nội'),
(25, 'Hà Tây'),
(26, 'Hà Tĩnh'),
(27, 'Hải Dương'),
(28, 'Hải Phòng'),
(29, 'Hậu Giang'),
(30, 'Hòa Bình'),
(31, 'Hưng Yên'),
(32, 'Khánh Hòa'),
(33, 'Kiên Giang'),
(34, 'Kon Tum'),
(35, 'Lai Châu'),
(36, 'Lâm Đồng'),
(37, 'Lạng Sơn'),
(38, 'Lào Cai'),
(39, 'Long An'),
(40, 'Nam Định'),
(41, 'Nghệ An'),
(42, 'Ninh Bình'),
(43, 'Ninh Thuận'),
(44, 'Phú Thọ'),
(45, 'Phú Yên'),
(46, 'Quảng Bình'),
(47, 'Quảng Nam'),
(48, 'Quảng Ngãi'),
(49, 'Quảng Trị'),
(50, 'Sóc Trăng'),
(51, 'Sơn La'),
(52, 'Tây Ninh'),
(53, 'Thái Bình'),
(54, 'Thái Nguyên'),
(55, 'Thanh Hóa'),
(56, 'Thừa Thiên Huế'),
(57, 'Tiền Giang'),
(58, 'Thành Phố HCM'),
(59, 'Trà Vinh'),
(60, 'Tuyên Quang'),
(61, 'Vĩnh Long'),
(62, 'Vĩnh Phúc'),
(63, 'Yên Bái');

-- --------------------------------------------------------

--
-- Table structure for table `myweb`
--

CREATE TABLE IF NOT EXISTS `myweb` (
  `WebName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DownloadWaitTime` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `myweb`
--

INSERT INTO `myweb` (`WebName`, `DownloadWaitTime`) VALUES
('anbam.com', 90);

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE IF NOT EXISTS `playlist` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CreateDate` date DEFAULT NULL,
  `ListenCount` int(11) DEFAULT NULL,
  `DownLoadCount` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`ID`, `CreateDate`, `ListenCount`, `DownLoadCount`) VALUES
(1, '2010-06-09', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `playlist_detail`
--

CREATE TABLE IF NOT EXISTS `playlist_detail` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PlayListID` int(11) DEFAULT NULL,
  `SongID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `DETAIL_PLAYLIST` (`PlayListID`),
  KEY `PLAYLIST_SONG` (`SongID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `playlist_detail`
--

INSERT INTO `playlist_detail` (`ID`, `PlayListID`, `SongID`) VALUES
(1, 1, 19),
(2, 1, 20);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `rating`
--


-- --------------------------------------------------------

--
-- Table structure for table `singer`
--

CREATE TABLE IF NOT EXISTS `singer` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SingerName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ZoneID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `SINGER_ZONE` (`ZoneID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `singer`
--

INSERT INTO `singer` (`ID`, `SingerName`, `ZoneID`) VALUES
(1, 'M4U Band', 1),
(2, 'Thùy Chi', 1),
(3, 'Chế Linh', 1),
(4, 'Extreme', 3),
(5, 'Daniel Powter', 3),
(6, 'Super Junior', 2),
(7, 'Nhậm Hiền Tề', 2),
(8, 'Diệp Thiếu Vân', 2),
(9, 'BigBang', 2),
(10, 'Shayne Ward', 3),
(11, 'Không Biết', 4),
(13, 'Bức tường', 1),
(14, 'Xuân Mai', 1);

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE IF NOT EXISTS `song` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SongName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `StyleID` int(11) DEFAULT NULL,
  `OwnerID` int(11) DEFAULT NULL,
  `SingerID` int(11) DEFAULT NULL,
  `Writter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateUp` date DEFAULT NULL,
  `ListenCount` int(11) DEFAULT NULL,
  `DownloadCount` int(11) DEFAULT NULL,
  `BitRateID` int(11) DEFAULT NULL,
  `Rate` float DEFAULT NULL,
  `Source` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Clip` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Source` (`Source`),
  KEY `SONG_BITRATE` (`BitRateID`),
  KEY `SONG_STYLE` (`StyleID`),
  KEY `SONG_USER` (`OwnerID`),
  KEY `SONG_SINGER` (`SingerID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`ID`, `SongName`, `StyleID`, `OwnerID`, `SingerID`, `Writter`, `DateUp`, `ListenCount`, `DownloadCount`, `BitRateID`, `Rate`, `Source`, `Clip`) VALUES
(1, 'Tan biến', 1, 1, 1, 'Nguyễn Hải Phong', '2010-06-01', 0, 0, 3, NULL, NULL, 0),
(2, 'Giấc mơ trưa', 1, 1, 2, 'Giáng Son', '2010-06-01', 0, 0, 3, NULL, NULL, 0),
(3, 'Quê tôi', 1, 1, 2, 'Anh Minh', '2010-06-01', 0, 0, 3, NULL, NULL, 0),
(4, 'Bad day', 7, 1, 5, 'Daniel Powter', '2010-06-01', 0, 0, 3, NULL, NULL, 0),
(5, 'More than word', 7, 1, 4, 'Unknown', '2010-06-01', 0, 0, 3, NULL, NULL, 0),
(6, '7 years of love', 5, 1, 6, 'Unknown', '2010-06-01', 0, 0, 3, NULL, NULL, 0),
(7, 'Kangoulai', 4, 1, 7, 'Unknown', '2010-06-01', 0, 0, 3, NULL, NULL, 0),
(8, 'Nụ hồng mong manh', 4, 1, 8, 'Unknown', '2010-06-01', 0, 0, 3, NULL, NULL, 0),
(9, 'Haru Haru', 5, 1, 9, 'Unknown', '2010-06-01', 0, 0, 3, NULL, NULL, 0),
(10, 'No promise', 7, 1, 10, 'Unknown', '2010-06-01', 0, 0, 3, NULL, NULL, 0),
(11, 'Thành phố mưa bay', 11, 2, 3, 'Bằng Giang', '2010-06-01', 0, 0, 3, NULL, NULL, 0),
(12, 'Canon In D', 13, 3, 11, 'Unknown', '2010-06-01', 0, 0, 3, NULL, NULL, 0),
(13, 'A times for us', 13, 3, 11, 'Unknown', '2010-06-01', 0, 0, 3, NULL, NULL, 0),
(14, 'Hát mãi khúc quân hành', 10, 2, 11, 'Diệp Minh Tuyền', '2010-06-01', 0, 0, 3, NULL, NULL, 0),
(15, 'Ngôi sao may mắn', 6, 1, 11, 'Unknown', '2010-06-01', 0, 0, 3, NULL, NULL, 0),
(16, 'RAP về khoa học tự nhiên', 2, 1, 11, 'Unknown', '2010-06-01', 0, 0, 3, NULL, NULL, 0),
(17, 'Đường đến vinh quang', 8, 1, 13, 'Trần Lập', '2010-06-01', 0, 0, 3, NULL, NULL, 0),
(18, 'Con cò bé bé', 12, 1, 14, 'Unknown', '2010-06-01', 0, 0, 3, NULL, NULL, 0),
(19, 'Phong thần', 8, 1, 11, 'Unknown', '2010-06-01', 0, 0, 3, NULL, '01 Chicago - If You Leave Me Now.MP3', 0),
(20, 'Tiểu thuyết tình yêu', 9, 1, 11, 'Unknown', '2010-06-01', 0, 0, 3, NULL, 'Thien Long Bat Bo 01.avi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `song_style`
--

CREATE TABLE IF NOT EXISTS `song_style` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `StyleName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `song_style`
--

INSERT INTO `song_style` (`ID`, `StyleName`) VALUES
(1, 'Nhạc Trẻ'),
(2, 'Nhạc RAP'),
(3, 'Nhạc phim'),
(4, 'Nhạc Hoa'),
(5, 'Nhạc Hàn'),
(6, 'Nhạc Nhật'),
(7, 'Nhạc Anh'),
(8, 'Nhạc Rock'),
(9, 'HipHop'),
(10, 'Nhạc Cách Mạng'),
(11, 'Nhạc Trữ Tình'),
(12, 'Nhạc Thiếu Nhi'),
(13, 'Nhạc Hòa Tấu'),
(14, 'Thể Loại Khác'),
(15, 'Không Biết');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Pass` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserStyleID` int(11) DEFAULT NULL,
  `PlayListID` int(11) DEFAULT NULL,
  `IsDelete` tinyint(1) DEFAULT NULL,
  `IsBaned` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `USER_STYLE` (`UserStyleID`),
  KEY `USER_PLAYLIST` (`PlayListID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `UserName`, `Pass`, `UserStyleID`, `PlayListID`, `IsDelete`, `IsBaned`) VALUES
(1, 'TakiNT', '123456', 1, NULL, 0, 0),
(2, 'sau_con_89', '123456', 2, 1, 0, 0),
(3, 'vuongteo', '123456', 2, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `FullName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) DEFAULT NULL,
  `Birthday` date DEFAULT NULL,
  `JoinDay` date DEFAULT NULL,
  `Email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LocationID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `INFO_LOCATION` (`LocationID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`FullName`, `ID`, `UserID`, `Birthday`, `JoinDay`, `Email`, `LocationID`) VALUES
('Lê Ngọc Tín', 1, 1, '1989-01-15', '2010-05-31', 'taki_lnt@yahoo.com', 61),
('Nguyễn Hải Bình', 2, 2, '1989-02-07', '2010-05-31', 'sau_con_89@yahoo.com', 58),
('Vương Quốc Toàn', 3, 3, '1989-11-08', '2010-05-31', 'vuongtoan_theking@yahoo.com', 58);

-- --------------------------------------------------------

--
-- Table structure for table `user_style`
--

CREATE TABLE IF NOT EXISTS `user_style` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserStyle` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_style`
--

INSERT INTO `user_style` (`ID`, `UserStyle`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `waiting_song`
--

CREATE TABLE IF NOT EXISTS `waiting_song` (
  `SongName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `StyleID` int(11) NOT NULL,
  `OwnerID` int(11) NOT NULL,
  `SingerID` int(11) NOT NULL,
  `Writter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `DateUp` date NOT NULL,
  `BitRateID` int(11) NOT NULL,
  `Source` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `waiting_song`
--

INSERT INTO `waiting_song` (`SongName`, `StyleID`, `OwnerID`, `SingerID`, `Writter`, `DateUp`, `BitRateID`, `Source`) VALUES
('con heo', 15, 1, 11, 'Không Biết', '2010-06-09', 1, 'Chiec La Mua Dong - Luu Bich.wma');

-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

CREATE TABLE IF NOT EXISTS `zone` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ZoneName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `zone`
--

INSERT INTO `zone` (`ID`, `ZoneName`) VALUES
(1, 'Việt Nam'),
(2, 'Châu Á'),
(3, 'Âu Mỹ'),
(4, 'unknow');
