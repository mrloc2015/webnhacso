-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 06, 2010 at 06:08 AM
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
  `DateUnbanned` date DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `BANNED_USER` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `banned`
--


-- --------------------------------------------------------

--
-- Table structure for table `banned_rule`
--

CREATE TABLE IF NOT EXISTS `banned_rule` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Days` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `banned_rule`
--

INSERT INTO `banned_rule` (`ID`, `Days`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 30),
(9, 60),
(10, 90),
(11, 120),
(12, 150),
(13, 180),
(14, 365),
(15, 730),
(16, -1);

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
  `PlayListID` int(11) DEFAULT NULL,
  `CreateDate` date DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `COMMENT_USER` (`UserID`),
  KEY `COMMENT_SONG` (`SongID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

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
  `DownloadWaitTime` int(11) DEFAULT NULL,
  `NumberInPage` int(11) NOT NULL,
  `Intro` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `Banner` varchar(1024) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `myweb`
--

INSERT INTO `myweb` (`WebName`, `DownloadWaitTime`, `NumberInPage`, `Intro`, `Banner`) VALUES
('anbam.com', 90, 20, 'Để dễ dàng hơn cho việc theo dõi các sự kiện mới và các chương trình của Fantasy Music Mời các bạn hãy trở 			thành Fan của Fantasy Music trên Facebook. Từ này về sau, các sự kiện, thông báo, chương trình khuyến mãi tặng quà…. của Fantasy Music sẽ được chính thức thông báo trên blog và Facebook. Trân trọng.', 'images/digital music-banner.jpg');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`ID`, `CreateDate`, `ListenCount`, `DownLoadCount`) VALUES
(1, '2010-07-03', 2, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `playlist_detail`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

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
(11, 'Unknown', NULL),
(13, 'Bức tường', 1),
(14, 'Xuân Mai', 1),
(15, 'Helloween', 3),
(16, 'Bon Jovi', 3),
(17, 'Bryan Adams', 3),
(18, 'Peter Cetera & Juie', 3),
(19, 'SuperStar', 3),
(20, 'The Men', 1),
(21, 'Minh Hằng', 1),
(22, 'Như Quỳnh', 1),
(23, 'Đinh Mạnh Ninh', 1),
(24, 'Nguyễn Hải Phong', 1),
(25, 'Thiên Vương', 1),
(26, 'Hồ Ngọc Hà', 1),
(27, 'Cao Thái Sơn', 1),
(28, 'Lee Seung Ki', 2),
(29, 'SS501', 2),
(30, 'Westlife', 3),
(31, 'Boy zone', 3),
(32, 'Linkin Park', 3),
(33, 'Lưu Bích', 4),
(34, 'Không biết', 4),
(35, 'M2M', 4),
(36, 'Eric Clapton', 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=104 ;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`ID`, `SongName`, `StyleID`, `OwnerID`, `SingerID`, `Writter`, `DateUp`, `ListenCount`, `DownloadCount`, `BitRateID`, `Rate`, `Source`, `Clip`) VALUES
(1, 'Tan biến', 1, 1, 1, 'Nguyễn Hải Phong', '2010-06-01', 1357, 4, 3, 4.25, 'Du_Lieu/BAI_HAT/1/Tan Bien.mp3', 0),
(2, 'Giấc mơ trưa', 1, 1, 2, 'Giáng Son', '2010-06-01', 4749, 3, 3, 5, 'Du_Lieu/BAI_HAT/2/Giac mo trua.mp3', 0),
(3, 'Quê tôi', 1, 1, 2, 'Anh Minh', '2010-06-01', 834, 0, 3, 4, 'Du_Lieu/BAI_HAT/3/Que toi.mp3', 0),
(4, 'Bad day', 7, 1, 5, 'Daniel Powter', '2010-06-01', 2453, 0, 3, 4, 'Du_Lieu/BAI_HAT/4/Bad day.mp3', 0),
(5, 'More than word', 7, 1, 4, 'Unknown', '2010-06-01', 4624, 0, 3, 5, 'Du_Lieu/BAI_HAT/5/More than word.mp3', 0),
(6, '7 years of love', 5, 1, 6, 'Unknown', '2010-06-01', 243, 0, 3, 3.9, 'Du_Lieu/BAI_HAT/6/7 year of love.mp3', 0),
(7, 'Kangoulai', 4, 1, 7, 'Unknown', '2010-06-01', 2355, 0, 3, 4, 'Du_Lieu/BAI_HAT/7/Kangoulai.mp3', 0),
(8, 'Nụ hồng mong manh', 4, 1, 8, 'Unknown', '2010-06-01', 2533, 0, 3, 5, 'Du_Lieu/BAI_HAT/8/Nu hong mong manh.mp3', 0),
(9, 'Haru Haru', 5, 1, 9, 'Unknown', '2010-06-01', 122, 0, 3, 4.2, 'Du_Lieu/BAI_HAT/9/Haru Haru.mp3', 0),
(10, 'No promise', 7, 1, 10, 'Unknown', '2010-06-01', 532, 0, 3, 4, 'Du_Lieu/BAI_HAT/10/No promise.mp3', 0),
(11, 'Thành phố mưa bay', 11, 1, 3, 'Bằng Giang', '2010-06-01', 3554, 0, 3, 4.5, 'Du_Lieu/BAI_HAT/11/Thanh pho mua bay.mp3', 0),
(12, 'Canon In D', 13, 1, 11, 'Unknown', '2010-06-01', 2440, 0, 3, 5, 'Du_Lieu/BAI_HAT/12/Cannon In D.wma', 0),
(13, 'A times for us', 13, 1, 11, 'Unknown', '2010-06-01', 2435, 0, 3, 5, 'Du_Lieu/BAI_HAT/13/A time for us.mp3', 0),
(14, 'Hát mãi khúc quân hành', 10, 1, 11, 'Diệp Minh Tuyền', '2010-06-01', 2463, 0, 3, 4, 'Du_Lieu/BAI_HAT/14/Hat mai khuc quan hanh.mp3', 0),
(15, 'Ngôi sao may mắn', 6, 1, 11, 'Unknown', '2010-06-01', 2343, 0, 3, 4.5, 'Du_Lieu/BAI_HAT/15/Ngoi sao may man.mp3', 0),
(16, 'RAP về khoa học tự nhiên', 2, 1, 11, 'Unknown', '2010-06-01', 2437, 1, 3, 4, 'Du_Lieu/BAI_HAT/16/Rap khoa hoc tu nhien.mp3', 0),
(17, 'Đường đến vinh quang', 8, 1, 13, 'Trần Lập', '2010-06-01', 1235, 0, 3, 4, 'Du_Lieu/BAI_HAT/17/Duong den dinh vinh quang.mp3', 0),
(18, 'Cháu lên ba', 12, 1, 14, 'Unknown', '2010-06-01', 2462, 0, 3, 3.5, 'Du_Lieu/BAI_HAT/18/Chau len ba.mp3', 0),
(19, 'Phong thần', 3, 1, 11, 'Unknown', '2010-06-01', 3524, 0, 3, 3.8, 'Du_Lieu/BAI_HAT/19/Phong than.mp3', 0),
(20, 'Tiểu thuyết tình yêu', 9, 1, 11, 'Unknown', '2010-06-01', 1325, 0, 3, 3, 'Du_Lieu/BAI_HAT/20/Tieu thuyet tinh yeu.mp3', 0),
(21, 'Hạnh phúc bất tận', 1, 1, 26, 'Unknown', '2010-06-02', 3523, 0, 3, 4, 'Du_Lieu/BAI_HAT/21/Hanh phuc bat tan.mp3', 0),
(22, 'Hãy để anh yêu em lần nữa', 1, 1, 20, 'Unknown', '2010-06-02', 1355, 0, 3, 5, 'Du_Lieu/BAI_HAT/22/Hay de anh yeu em lan nua.mp3', 0),
(23, 'Dòng thời gian', 1, 1, 24, 'Nguyễn Hải Phong', '2010-06-02', 3532, 0, 3, 4.5, 'Du_Lieu/BAI_HAT/23/Dong thoi gian.mp3', 0),
(24, 'Bay giữa ngân hà', 1, 1, 11, 'Unknown', '2010-06-02', 3529, 0, 3, 4.5, 'Du_Lieu/BAI_HAT/24/Bay giua ngan ha.mp3', 0),
(25, 'Bài ca tình yêu', 1, 1, 11, 'Unknown', '2010-06-02', 1238, 0, 3, 4, 'Du_Lieu/BAI_HAT/25/Bai ca tinh yeu.mp3', 0),
(26, 'Let''s break up', 5, 1, 28, 'Unknown', '2010-06-02', 2352, 0, 3, 4, 'Du_Lieu/BAI_HAT/26/Let''s break up.mp3', 0),
(27, 'Because I''m stupid', 5, 1, 29, 'Unknown', '2010-06-02', 3512, 0, 3, 3.9, 'Du_Lieu/BAI_HAT/27/Because I''m stupid.mp3', 0),
(28, 'Forever and one', 8, 1, 15, 'Unknown', '2010-06-02', 3423, 0, 3, 4.8, 'Du_Lieu/BAI_HAT/28/Forever and one.mp3', 0),
(29, 'Thời gian', 1, 1, 25, 'Unknown', '2010-06-02', 3215, 0, 3, 4, 'Du_Lieu/BAI_HAT/29/Thoi gian.mp3', 0),
(30, 'Pha lê tím', 1, 1, 27, 'Unknown', '2010-06-02', 4314, 0, 3, 4, 'Du_Lieu/BAI_HAT/30/Pha le tim.mp3', 0),
(31, 'Con đường mưa', 1, 1, 27, 'Unknown', '2010-06-02', 1232, 0, 3, 4, 'Du_Lieu/BAI_HAT/31/Con duong mua.mp3', 0),
(32, 'Còn thương rau đắng mọc sau hè', 11, 1, 22, 'Unknown', '2010-06-02', 3412, 0, 3, 4.5, 'Du_Lieu/BAI_HAT/32/Con thuong rau dang moc sau he.mp3', 0),
(33, 'Một vòng trái đất', 1, 1, 21, 'Unknown', '2010-06-02', 147, 0, 3, 3.5, 'Du_Lieu/BAI_HAT/33/Mot vong trai dat.mp3', 0),
(34, 'Cry on my shouder', 7, 1, 19, 'Unknown', '2010-06-02', 5343, 0, 3, 5, 'Du_Lieu/BAI_HAT/34/Cry on my shouder.mp3', 0),
(35, 'Forever tonight', 7, 1, 18, 'Unknown', '2010-06-02', 3252, 0, 3, 5, 'Du_Lieu/BAI_HAT/35/Forever tonight.mp3', 0),
(36, 'Here I am', 7, 1, 17, 'Unknown', '2010-06-02', 2341, 0, 3, 5, 'Du_Lieu/BAI_HAT/36/Here I am.mp3', 0),
(37, 'Its my life', 8, 1, 16, 'Unknown', '2010-06-02', 2533, 0, 3, 5, 'Du_Lieu/BAI_HAT/37/Its my life.mp3', 0),
(38, 'Windmill', 8, 1, 15, 'Unknown', '2010-06-02', 231, 0, 3, 4.5, 'Du_Lieu/BAI_HAT/38/Windmill.mp3', 0),
(39, 'If I could fly', 8, 1, 15, 'Unknown', '2010-06-02', 2353, 0, 3, 4.5, 'Du_Lieu/BAI_HAT/39/If I could fly.mp3', 0),
(40, 'Have a nice day', 8, 1, 16, 'Unknown', '2010-06-02', 2316, 0, 3, 5, 'Du_Lieu/BAI_HAT/40/Have a nice day.mp3', 0),
(41, 'Season in the son', 7, 1, 30, 'Unknown', '2010-06-02', 2317, 0, 3, 2.875, 'Du_Lieu/BAI_HAT/41/Season in the son.mp3', 0),
(42, 'Miss you', 7, 1, 30, 'Unknown', '2010-06-02', 3213, 0, 3, 4.5, 'Du_Lieu/BAI_HAT/42/Miss you.mp3', 0),
(43, 'Soledad', 7, 1, 30, 'Unknown', '2010-06-02', 1244, 0, 3, 4.2, 'Du_Lieu/BAI_HAT/43/Soledad .mp3', 0),
(44, 'My love', 7, 1, 30, 'Unknown', '2010-06-02', 2427, 4, 3, 4.6, 'Du_Lieu/BAI_HAT/44/My love.mp3', 0),
(45, 'Best of me', 7, 1, 5, 'Unknown', '2010-06-02', 1324, 0, 3, 4, 'Du_Lieu/BAI_HAT/45/Best of me.mp3', 0),
(46, 'Everyday I love you', 7, 1, 31, 'Unknown', '2010-06-02', 2423, 0, 3, 4.8, 'Du_Lieu/BAI_HAT/46/Everyday I love you.wma', 0),
(47, 'All that I need', 7, 1, 31, 'Unknown', '2010-06-02', 3412, 0, 3, 4, 'Du_Lieu/BAI_HAT/47/All that I need.wma', 0),
(48, 'When you say nothing at all', 7, 1, 31, 'Unknown', '2010-06-02', 1332, 0, 3, 4.5, 'Du_Lieu/BAI_HAT/48/When you say nothing at all.mp3', 0),
(49, 'That my goal', 7, 1, 10, 'Unknown', '2010-06-02', 4240, 0, 3, 4.5, 'Du_Lieu/BAI_HAT/49/That my goal.mp3', 0),
(50, 'Until you', 7, 1, 10, 'Unknown', '2010-06-02', 2432, 0, 3, 5, 'Du_Lieu/BAI_HAT/50/Until you.mp3', 0),
(51, 'Here I am', 7, 1, 17, 'Unknown', '2010-06-02', 3424, 0, 3, 5, 'Du_Lieu/BAI_HAT/51/Here I am.mpeg', 1),
(52, 'Heaven', 7, 1, 17, 'Unknown', '2010-06-02', 2124, 0, 3, 4.9, 'Du_Lieu/BAI_HAT/52/Heaven.mpeg', 1),
(53, 'What I''ve done', 7, 1, 32, 'Unknown', '2010-06-02', 353, 0, 3, 4.7, 'Du_Lieu/BAI_HAT/53/What I''ve done.wmv', 1),
(54, 'Song for a lady', 5, 1, 11, 'Unknown', '2010-06-02', 534, 0, 3, 4, 'Du_Lieu/BAI_HAT/54/Song for a lady.mp4', 1),
(55, 'Bắc kinh chào đóng bạn', 4, 1, 11, 'Unknown', '2010-06-02', 327, 1, 3, 4, 'Du_Lieu/BAI_HAT/55/Bac Kinh chao don ban.flv', 1),
(56, 'Thiên Long Bát Bộ', 4, 1, 11, 'Unknown', '2010-06-02', 645, 1, 3, 4, 'Du_Lieu/BAI_HAT/56/Thien Long Bat Bo.avi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `song_style`
--

CREATE TABLE IF NOT EXISTS `song_style` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `StyleName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

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
(14, 'Thể Loại Khác');

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
  `IsBanned` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `USER_STYLE` (`UserStyleID`),
  KEY `USER_PLAYLIST` (`PlayListID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `UserName`, `Pass`, `UserStyleID`, `PlayListID`, `IsDelete`, `IsBanned`) VALUES
(1, 'TakiNT', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`FullName`, `ID`, `UserID`, `Birthday`, `JoinDay`, `Email`, `LocationID`) VALUES
('Squall Taki', 1, 1, '1989-08-14', '2010-07-01', 'taki.lnt@gmail.com', 61);

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
  `SongID` int(11) DEFAULT NULL,
  `SongName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `StyleID` int(11) NOT NULL,
  `OwnerID` int(11) NOT NULL,
  `SingerID` int(11) NOT NULL,
  `Writter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `DateUp` date NOT NULL,
  `BitRateID` int(11) NOT NULL,
  `Rate` int(11) DEFAULT NULL,
  `Source` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `waiting_song`
--


-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

CREATE TABLE IF NOT EXISTS `zone` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ZoneName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `zone`
--

INSERT INTO `zone` (`ID`, `ZoneName`) VALUES
(1, 'Việt Nam'),
(2, 'Châu Á'),
(3, 'Âu Mỹ');
