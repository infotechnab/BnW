-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 14, 2013 at 11:26 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`aid`, `a_name`) VALUES
(3, 'sdfdsfdsf'),
(12, 'sdfsdfsdf'),
(17, 'lsdjf;l'),
(18, 'sdjfljsdf'),
(19, 'new album'),
(21, 'sdfsdfsdf'),
(22, 'sdfdsfdsfdsf'),
(23, 'sdfsdfsdf');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

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
(35, 'sdfsdf', 'my_frnsn2.jpg', 12);

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
(1, 'siteurl', 'www.alternativeconceptnepal.com'),
(2, 'title', 'lsjj chaged again sdfsd'),
(3, 'keywords', 'lsjldjflsldjf ljsldjfl sldfjlsdjf'),
(4, 'description', 'jsldjf lls dfljs dlfjlss');

-- --------------------------------------------------------

--
-- Table structure for table `notice_gadget`
--

CREATE TABLE IF NOT EXISTS `notice_gadget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `body` longtext NOT NULL,
  `published_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `page_event`
--

CREATE TABLE IF NOT EXISTS `page_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `body` longtext NOT NULL,
  `image` varchar(200) NOT NULL,
  `published_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `page_event`
--

INSERT INTO `page_event` (`id`, `title`, `body`, `image`, `published_date`, `status`, `type`) VALUES
(1, '', '', '', '2013-08-14 07:17:23', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`sid`, `image`, `title`) VALUES
(3, 'handtree.jpg', 'Use ACON'),
(4, 'comparition.jpg', 'Comparision'),
(5, 'por3018164_2.jpg', 'Steel Doors And Windows'),
(6, 'terasprofiiltooted.jpg', 'Windows');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
