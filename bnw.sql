-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 23, 2013 at 11:28 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bnw`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `a_name` varchar(200) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`aid`, `a_name`) VALUES
(26, 'sdfsdf'),
(27, 'sdfdsfdsfdsf');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(2000) NOT NULL,
  `image` varchar(2000) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `image`, `status`, `date`) VALUES
(1, 'sfdsdf', '8_n1.jpg', 1, '2013-08-23 09:40:55'),
(3, 'sdff', '8_n2.jpg', 1, '2013-08-23 10:00:45');

-- --------------------------------------------------------

--
-- Table structure for table `download`
--

CREATE TABLE IF NOT EXISTS `download` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `image` varchar(2000) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `download`
--

INSERT INTO `download` (`id`, `title`, `image`, `status`, `date`) VALUES
(1, 'dsfdsf', '8_n.jpg', 1, '2013-08-23 09:11:19');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `eid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `aid` int(11) NOT NULL,
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`eid`, `title`, `image`, `aid`) VALUES
(1, 'sdfds', 'login_page1.png', 1),
(2, 'my phpto', 'cblordrd.gif', 1),
(3, 'hy', 'login_brand.png', 2),
(10, 'dsfsdfsdf', 'cblordrd2.gif', 4),
(23, 'sdfsdf', 'kh.jpg', 3),
(24, 'dsfdsf', 'my_frnsn.jpg', 9),
(25, 'sdfsd', 'relation_n.jpg', 10),
(27, 'erterte', 'forest-animals-pictures.jpg', 13),
(28, 'dfgdfgdf', 'forest-animals-pictures1.jpg', 14),
(30, 'skdlkjj', '8_n2.jpg', 16),
(31, 'fsdfsd', '8_n3.jpg', 12),
(32, 'dfdsfdsf', '8_n4.jpg', 3),
(33, 'hfghfgh', '8_n5.jpg', 19),
(34, 'dsfdsf', 'my_frnsn1.jpg', 12),
(35, 'sdfsdf', 'my_frnsn2.jpg', 12),
(36, 'sdafsdf', '8_n.jpg', 24),
(38, 'sdfsdsdfsdf', '8_n2.jpg', 26);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `login` varchar(200) NOT NULL,
  `passwd` varchar(200) NOT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `firstname`, `lastname`, `login`, `passwd`) VALUES
(1, 'bnw', 'bnw', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `parmalink` varchar(1000) NOT NULL,
  `listing` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `link` varchar(1000) NOT NULL,
  `is_single` tinyint(1) NOT NULL,
  `p_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `title`, `parmalink`, `listing`, `order`, `link`, `is_single`, `p_id`) VALUES
(1, 'Home', 'home', 0, 1, 'sfsdfsdf', 1, 1),
(2, 'About us', 'about-us', 0, 2, '', 0, 5),
(3, 'Introduction', 'introduction', 5, 2, '', 0, 6),
(4, 'Mission', 'mission', 5, 1, '', 0, 7),
(5, 'Contact', '', 0, 1, '', 0, 8),
(6, 'contact', 'jdlsfj', 3, 1, 'sjkldfj', 0, 9),
(18, 'sdfdsfasdf', '', 3, 0, '', 0, 30),
(19, 'sdff', '', 3, 0, '', 0, 31),
(20, 'sdff', '', 3, 0, '', 0, 32);

-- --------------------------------------------------------

--
-- Table structure for table `meta_data`
--

CREATE TABLE IF NOT EXISTS `meta_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `value` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `meta_data`
--

INSERT INTO `meta_data` (`id`, `name`, `value`) VALUES
(1, 'siteurl', 'www.BnW.com'),
(2, 'title', 'B&W'),
(3, 'keywords', 'cms'),
(4, 'description', 'cms');

-- --------------------------------------------------------

--
-- Table structure for table `notice_gadget`
--

CREATE TABLE IF NOT EXISTS `notice_gadget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `body` longtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL,
  `type` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `notice_gadget`
--

INSERT INTO `notice_gadget` (`id`, `title`, `body`, `date`, `status`, `type`) VALUES
(1, 'sdfdf', 'sadfdfsf', '2013-08-19 11:27:02', 1, ''),
(2, 'sdfsdsdfsdf', 'sdfsdfsdf', '2013-08-19 11:28:23', 1, ''),
(3, 'sdafsdf', 'adsfsdf', '2013-08-19 11:30:01', 1, ''),
(4, 'sdff', 'sadfsdf', '2013-08-20 06:31:28', 1, ''),
(5, 'sdfadf', 'sadfadf', '2013-08-20 06:31:41', 1, ''),
(6, 'new notice', 'lfdkgjflgj', '2013-08-22 06:48:47', 1, 'notice'),
(7, 'gad', 'sadf', '2013-08-22 06:57:24', 1, ''),
(8, 'gadgets', 'dffg', '2013-08-22 07:00:14', 1, '0'),
(9, 'last', 'asdfsaf', '2013-08-22 07:02:20', 1, 'gadgets'),
(10, 'sdfdsfdsf', 'dsffdf', '2013-08-22 07:02:10', 1, 'gadgets'),
(11, 'sssssssssssss', 'sssssssssssssssssss', '2013-08-22 07:10:26', 1, 'notice'),
(12, 'new page', 'lsdfjdsfl', '2013-08-23 09:37:32', 1, 'gadgets');

-- --------------------------------------------------------

--
-- Table structure for table `page_event`
--

CREATE TABLE IF NOT EXISTS `page_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `body` longtext NOT NULL,
  `image` varchar(200) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `page_event`
--

INSERT INTO `page_event` (`id`, `title`, `body`, `image`, `date`, `status`, `type`) VALUES
(1, 'dfsgfg', 'dsfgdfgfg', '', '2013-08-20 07:01:26', '1', 'page'),
(2, 'dfsgdfg', 'dsgdfg', '', '2013-08-19 07:28:12', '1', ''),
(3, 'sdff', 'asdfdf', 'door-alarms.jpg', '2013-08-20 07:01:35', '1', 'page'),
(4, 'lghdfklgh', 'kdshfkljsdhf', '', '2013-08-19 07:51:26', '1', ''),
(5, 'sdfdsf', 'dfsgdlkfg', 'about_us.jpg', '2013-08-20 07:01:47', '1', 'page'),
(7, 'sdfsdsdfsdf', 'asdfsdf', '', '2013-08-19 08:17:55', '1', ''),
(8, 'sdfdf', 'asdfdfsd', '', '2013-08-20 07:01:57', '1', 'page'),
(9, 'last', 'sd;lfjs', '8_n.jpg', '2013-08-19 11:23:41', '1', ''),
(10, 'dsfsdfsd', 'dasfsdfsdf', '', '2013-08-20 07:02:07', '1', 'page'),
(11, 'add new page', 'sadf', 'DSC03742.jpg', '2013-08-20 05:40:25', '1', ''),
(12, 'sdfsdsdfsdf', 'sadfdfsdaf', 'DSC03739.jpg', '2013-08-20 07:02:16', '1', 'page'),
(13, 'menu', ';sadfjgj', '', '2013-08-20 07:40:28', '1', ''),
(14, 'new abc', 'sdffsdf', '', '2013-08-20 07:41:05', '1', ''),
(15, 'dsff', 'sdf', '', '2013-08-20 10:51:15', '1', 'page'),
(16, 'new page', '`dsfgjkdfg', '', '2013-08-20 10:51:40', '1', 'page'),
(17, 'sadfsdf', 'sdfdf', '', '2013-08-20 10:56:58', '1', ''),
(18, 'new event 2 ', 'dlsfj', '8_n2.jpg', '2013-08-20 10:58:11', '1', 'event'),
(19, 'new event', 'lskfjd', 'flower_n.jpg', '2013-08-22 05:50:37', '1', 'event'),
(20, 'add menu', 'sdfdf', '', '2013-08-20 11:02:07', '1', 'page'),
(22, 'last event', 'asdfsdff', 'canon_logo.jpg', '2013-08-22 05:51:07', '1', 'event'),
(23, 'pagination test', 'dfkladsjf', '', '2013-08-22 08:30:30', '1', 'page'),
(24, 'page', 'sdlf', '', '2013-08-22 08:31:09', '1', 'page'),
(25, 'FGDSGD', 'DFGDFGDFGD', '', '2013-08-22 10:06:14', '1', 'page'),
(26, 'XDBVGDFG', 'sdgdsgs', '', '2013-08-22 10:06:53', '1', 'page'),
(27, 'sdfsdf', 'sdfsdfsdf', '', '2013-08-22 10:11:31', '1', 'page'),
(28, 'sdfsdf', 'sdfsdfsdf', '', '2013-08-22 10:12:26', '1', 'page'),
(29, 'sdfsdf', 'sdfsdfsdf', '', '2013-08-22 10:13:21', '1', 'page'),
(30, 'sdfdsfasdf', 'sdff', '', '2013-08-22 10:22:09', '1', 'page'),
(31, 'sdff', 'sdfsdfdsf', '', '2013-08-22 10:29:22', '1', 'page'),
(32, 'sdff', 'sdfdfdsfsdf', '', '2013-08-22 10:30:02', '1', 'page');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`sid`, `image`, `title`) VALUES
(3, 'handtree.jpg', 'Use ACON'),
(4, 'comparition.jpg', 'Comparision'),
(5, 'por3018164_2.jpg', 'Steel Doors And Windows'),
(6, 'terasprofiiltooted.jpg', 'Windows'),
(7, 'DSC03734.jpg', 'sadff'),
(8, 'canon-logo.jpg', 'yuiuiu'),
(9, 'canon.png', 'sdfsdfdsfdf');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
