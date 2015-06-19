-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 19, 2015 at 10:05 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bnw`
--
CREATE DATABASE IF NOT EXISTS `bnw` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bnw`;

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_name` varchar(100) NOT NULL DEFAULT 'Required',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `album_name`) VALUES
(7, 'my album');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL DEFAULT 'Required',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(35, 'category a'),
(36, 'category b'),
(37, 'a'),
(38, 'b'),
(41, 'e'),
(42, 'category c'),
(43, 'abc'),
(44, 'ac');

-- --------------------------------------------------------

--
-- Table structure for table `comment_store`
--

CREATE TABLE IF NOT EXISTS `comment_store` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(200) CHARACTER SET utf8 NOT NULL,
  `comment_association_id` varchar(64) NOT NULL,
  `comment_user_name` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `comment_store`
--

INSERT INTO `comment_store` (`Id`, `comment`, `comment_association_id`, `comment_user_name`) VALUES
(9, 'djasKSJHJDIHIUDSA', 'post/3', ''),
(10, 'djasKSJHJDIHIUDSA', 'post/3', ''),
(11, 'comment', 'view/addcomment', ''),
(12, 'djjkdjudhsufjdaksfoipokwDJICOUJSJA', 'page/2', ''),
(13, 'hi this is a post comment', 'post/3', ''),
(15, 'now the comment is added', 'post/3', ''),
(16, 'now the comment is added', 'post/3', ''),
(17, 'epofojigkosdk[pfs', 'page/3', ' '),
(18, 'now the commenting is easy', 'page/3', ' '),
(19, 'comment is added to page 4', 'page/4', ' '),
(20, 'jewijfowpofiewpoew', 'post/3', ' '),
(21, 'mynew comment', 'post/3', ' '),
(22, 'The last comment', 'post/3', ' '),
(23, 'last added is shown at first', 'post/3', ' '),
(24, 'ramji commented', 'post/3', ' '),
(25, '', 'post/3', ' '),
(26, '', 'post/3', ' '),
(27, 'hdiuhfjhf', 'post/3', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `contact_address`
--

CREATE TABLE IF NOT EXISTS `contact_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_no1` varchar(255) NOT NULL,
  `contact_no2` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `show_form` varchar(255) NOT NULL,
  `show_map` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contact_address`
--

INSERT INTO `contact_address` (`id`, `name`, `address`, `contact_no1`, `contact_no2`, `email`, `show_form`, `show_map`) VALUES
(1, 'Salyani Technologies Pvt. Ltd.', 'Lions Chowk,Narayangarh,Chitwan,Nepal', '056-533977', '', 'info@salyani.com.np', 'showForm', 'showMap');

-- --------------------------------------------------------

--
-- Table structure for table `contact_list`
--

CREATE TABLE IF NOT EXISTS `contact_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `remarks` varchar(1000) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `contact_list`
--

INSERT INTO `contact_list` (`id`, `full_name`, `email`, `remarks`, `type`) VALUES
(1, 'Hom Nath Bagale', 'bhomnath@salyani.com.np', NULL, 'newsletter subs'),
(2, 'Ramji Subedi', 'rsubedi@salyani.com.np', NULL, 'newsletter subs'),
(6, 'sushil shrestha', 'sushilsth21@gmail.com', NULL, 'newsletter subs'),
(16, NULL, 'bhomnath@salyani.com.np', 'Well, this is embrassing!', 'feedback'),
(17, NULL, 'bhomnath@salyani.com.np', 'Well, this is embrassing!', 'feedback'),
(19, 'fagshfdgha', 'dsgahfd', '45645645', 'feedback'),
(20, 'sadsadsa', 'asdsadas', 'asdasdasdas', 'feedback'),
(21, 'sadsadsa', 'asdsadas', 'asdasdasdas', 'feedback'),
(22, 'dfsfsd', 'sdfsdf', 'dfsdfsdfsdfs', 'feedback'),
(23, 'kjhgfhgjyh', 'jfdhtdhgfdg', 'kjbh', 'feedback'),
(24, 'true', 'true', 'true', 'feedback'),
(25, 'true', 'true', 'true', 'feedback'),
(26, 'saddasdsa', 'sadasdas@asd.asd', 'saddsadsadas', 'feedback');

-- --------------------------------------------------------

--
-- Table structure for table `design_setup`
--

CREATE TABLE IF NOT EXISTS `design_setup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `design_setup`
--

INSERT INTO `design_setup` (`id`, `name`, `description`) VALUES
(0, 'header_title', 'BnW - A complete CMS#'),
(1, 'header_logo', 'bnw11.png'),
(2, 'header_description', 'This is header..You can write whatever you want..'),
(3, 'header_bgcolor', NULL),
(4, 'sidebar_title', 'Quick navigation abcdefg'),
(5, 'sidebar_description', 'changed by krishnaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'),
(6, 'sidebar_bgcolor', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `details` text CHARACTER SET utf8 NOT NULL,
  `location` varchar(200) CHARACTER SET utf8 NOT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `insert_date` date NOT NULL,
  `last_modified_date` date DEFAULT NULL,
  `image` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `details`, `location`, `start_date`, `end_date`, `insert_date`, `last_modified_date`, `image`, `type`) VALUES
(7, 'This is my title', '<p>hello my name is krishna.</p>\r\n<p>hello my name is krishna.</p>\r\n<p>hello my name is krishna.</p>\r\n<p>hello my name is krishna.</p>\r\n<p>hello my name is krishna.</p>\r\n<p>hello my name is krishna.</p>\r\n<p>hello my name is krishna.</p>', '', '2015-06-05 07:00:00', NULL, '0000-00-00', NULL, 'fQY7dconnect_to_world.png', 'news'),
(10, 'asdfsaf', '<p style="text-align: center;">dgfthbfh &nbsp;sdafsd fsa sfa<strong> sadf sadf sa fsa fas<em>sa dsa sad fas fsa sa</em></strong></p>', '', '2015-06-16 18:15:00', NULL, '0000-00-00', NULL, '', 'news'),
(14, 'sadf sadfsdaf a', '<p>sfs adfasf sa fsasajk gqwi7ye cmbsa fiu ewf dmnb wif heo8h ol</p>', '', NULL, NULL, '2015-06-18', NULL, NULL, 'news'),
(16, 'new event', '<p>this is new event going to be organized very soon.this is new event going to be organized very soon.this is new event going to be organized very soon.this is new event going to be organized very soon.this is new event going to be organized very soon.this is new event going to be organized very soon.this is new event going to be organized very soon.this is new event going to be organized very soon.this is new event going to be organized very soon.this is new event going to be organized very so</p>', 'Bharatpur', '2015-06-17 18:15:00', NULL, '0000-00-00', '2015-06-19', '', 'event'),
(17, 'sdfgsd', '<p>fgdsgdsfgdsfg</p>', '', '0000-00-00 00:00:00', NULL, '2015-06-18', NULL, '', 'news'),
(18, 'safsa f', '<p>saf saf s fsa f</p>', '', NULL, NULL, '2015-06-18', NULL, NULL, 'news'),
(19, 'sdfg sdfg', '<p>dsgdsfgdsgdsgds</p>', '', NULL, NULL, '2015-06-18', NULL, NULL, 'news'),
(20, 'reyreyt', '<p>reerny rye ryer rd</p>', '', NULL, NULL, '2015-06-18', NULL, NULL, 'news'),
(21, 'Krishna ko news', '<p>asdasdasdas</p>', '', NULL, NULL, '2015-06-19', NULL, NULL, 'news'),
(22, 'krish''s news', '<p>ZSX</p>', '', NULL, NULL, '2015-06-19', NULL, NULL, 'news'),
(23, 'Krishna ko event', '<p>asdas</p>', 'saa', '2015-06-29 18:15:00', NULL, '0000-00-00', NULL, NULL, 'event'),
(24, 'asdf event', '<p>asdas</p>', 'Bharatpur', '2015-06-22 18:15:00', NULL, '2015-06-19', '2015-06-19', '', 'event'),
(25, 'sdfsfdsfd', '<p>srert</p>', '', '2015-06-24 18:15:00', '2015-06-29 18:15:00', '2015-06-19', NULL, NULL, 'event');

-- --------------------------------------------------------

--
-- Table structure for table `gadgets`
--

CREATE TABLE IF NOT EXISTS `gadgets` (
  `gadget_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `textBox` varchar(100) NOT NULL,
  `defaultGadget` text NOT NULL,
  `type` text NOT NULL,
  `display` varchar(200) NOT NULL,
  `setting` text NOT NULL,
  PRIMARY KEY (`gadget_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=234 ;

--
-- Dumping data for table `gadgets`
--

INSERT INTO `gadgets` (`gadget_id`, `name`, `textBox`, `defaultGadget`, `type`, `display`, `setting`) VALUES
(226, 'Social Network', 'textBox', '', '<p>Facebook<br /> Twitter<br /> Linkid<br/> Yahoo Mail</p>\r\n', 'Footer', '');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media_name` varchar(100) NOT NULL DEFAULT 'Required',
  `media_type` text,
  `media_association_id` int(11) DEFAULT NULL,
  `media_link` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_media` (`media_association_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `media_name`, `media_type`, `media_association_id`, `media_link`) VALUES
(21, 'Required', '5581571c542891.53382514.png,5581571c69cbb3.18389309.gif,5581571c', NULL, NULL),
(23, 'Required', '55815fcd5c94a6.20846743.jpg,55815fcd9d3226.26820418.png,55815fcdbf24e7.87275477.jpg', NULL, NULL),
(24, 'werqwerqwer', 'iATx7Screenshot (136).png', 7, '0'),
(25, 'aksjcn', '4X8eYScreenshot (139).png', 7, '0'),
(26, 'gfcghcgfcgf', 'page_sts.PNG', NULL, 'http://192.168.1.16/test/bnw/content/images/page_sts.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(100) NOT NULL DEFAULT 'Required',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `menu_name`) VALUES
(4, 'Home Menu');

-- --------------------------------------------------------

--
-- Table structure for table `meta_data`
--

CREATE TABLE IF NOT EXISTS `meta_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `meta_data`
--

INSERT INTO `meta_data` (`id`, `name`, `value`) VALUES
(1, 'siteurl', 'www.salyani.org'),
(2, 'title', 'BnW - An complete CMS'),
(3, 'keywords', 'BBC'),
(4, 'description', 'Home loan'),
(5, 'favicon_icon', 'favicon.png');

-- --------------------------------------------------------

--
-- Table structure for table `misc_setting`
--

CREATE TABLE IF NOT EXISTS `misc_setting` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `description` varchar(64) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `misc_setting`
--

INSERT INTO `misc_setting` (`Id`, `name`, `description`) VALUES
(0, 'show_comment', '0'),
(1, 'show_like', '1'),
(2, 'show_share', '1'),
(3, 'max_post_to_show', '5'),
(4, 'max_page_to_show', '5'),
(5, 'slide_height', '800'),
(6, 'slide_width', '1380');

-- --------------------------------------------------------

--
-- Table structure for table `navigation`
--

CREATE TABLE IF NOT EXISTS `navigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `navigation_name` varchar(100) NOT NULL DEFAULT 'Required',
  `navigation_link` mediumtext,
  `parent_id` int(11) DEFAULT NULL,
  `navigation_type` varchar(64) DEFAULT NULL,
  `navigation_slug` varchar(64) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `category_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_navigation` (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100146 ;

--
-- Dumping data for table `navigation`
--

INSERT INTO `navigation` (`id`, `navigation_name`, `navigation_link`, `parent_id`, `navigation_type`, `navigation_slug`, `menu_id`, `page_id`, `category_id`) VALUES
(100127, 'my new page', 'page/24', 0, 'page', 'mynewpage', 4, 24, NULL),
(100132, ' hqwiur hqw u"SAF as F"wee"AF"87378as rsdfgsdgsd fs', 'page/29', 0, 'page', 'hqwiurhqwu"SAFasF"wee"AF"87378asrsdfgsdgsdfs', 4, 29, NULL),
(100133, 'category b', 'http://192.168.1.16/test/bnw/view/category/36', 0, 'category', 'categoryb', 4, NULL, NULL),
(100134, ' kamal ', 'http://192.168.1.16/test/bnw/view/page/9', 0, 'page', 'kamal', 4, 9, NULL),
(100135, 'b', 'http://192.168.1.16/test/bnw/view/category/38', 0, 'category', 'b', 4, NULL, NULL),
(100136, 'category a', 'http://192.168.1.16/test/bnw/view/category/35', 100133, 'category', 'categorya', 4, NULL, NULL),
(100137, 'category a', 'http://192.168.1.16/test/bnw/view/category/35', 100133, 'category', 'categorya', 4, NULL, NULL),
(100138, 'category b', 'http://192.168.1.16/test/bnw/view/category/36', 100133, 'category', 'categoryb', 4, NULL, NULL),
(100139, 'category b', 'http://192.168.1.16/test/bnw/view/category/36', 100133, 'category', 'categoryb', 4, NULL, NULL),
(100140, 'titlenav', 'http://192.168.1.16/test/bnw/index.php/dashboard/pages', 100127, '', 'titlenav', 4, NULL, NULL),
(100141, 'Facebook', 'https://www.facebook.com', 0, '', 'Facebook', 4, NULL, NULL),
(100142, 'category b', 'http://192.168.1.16/test/bnw/view/category/36', 100141, 'category', 'categoryb', 4, NULL, NULL),
(100143, 'Test page & sushil fdgh ksdfgsdg', 'page/26', 100137, 'page', 'Testpage&sushilfdghksdfgsdg', 4, 26, NULL),
(100144, 'Hari parsad shrestha', 'page/23', 0, 'page', 'Hariparsadshrestha', 4, 23, NULL),
(100145, 'pagination trackdfh', 'http://localhost/bnw/view/page/6', 100127, 'page', 'paginationtrackdfh', 4, 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(100) NOT NULL DEFAULT 'Required',
  `page_content` text NOT NULL,
  `page_author_id` int(11) NOT NULL,
  `page_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `page_summary` mediumtext,
  `page_status` varchar(100) NOT NULL,
  `page_modifed_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `page_parent` int(11) NOT NULL,
  `page_order` int(11) DEFAULT NULL,
  `page_type` varchar(100) DEFAULT NULL,
  `page_tags` mediumtext,
  `allow_comment` tinyint(1) NOT NULL,
  `allow_like` tinyint(1) NOT NULL,
  `allow_share` tinyint(1) NOT NULL,
  `images` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `page_name`, `page_content`, `page_author_id`, `page_date`, `page_summary`, `page_status`, `page_modifed_date`, `page_parent`, `page_order`, `page_type`, `page_tags`, `allow_comment`, `allow_like`, `allow_share`, `images`) VALUES
(6, 'pagination trackdfh', '<p>sfsfdgsdfgdg</p>', 10, '2015-05-31 10:08:04', '<p>sfsfdgsdfgdg</p>', '1', '2015-06-18 05:27:01', 0, 0, '', '0', 0, 1, 1, '0'),
(9, ' kamal ', '<p>&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;</p>\r\n<p>kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;</p>\r\n<p>kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;</p>\r\n<p>kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;</p>', 10, '2015-05-31 10:19:30', '<p>&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kam', '0', '2015-06-18 03:35:15', 0, 0, '', '0', 0, 1, 1, '0'),
(23, 'Hari parsad shrestha', '<p>Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;</p>\r\n<p>Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;</p>\r\n<p>Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;</p>\r\n<p>Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;</p>', 10, '2015-06-01 07:48:47', '<p>Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nb', '1', '2015-06-18 05:31:53', 0, 0, '', '0', 0, 1, 1, '0'),
(24, 'my new page', '<ul>\r\n<li>&nbsp;wjnkjsc kjw ckjweckj</li>\r\n<li>skjdcnsdkjc</li>\r\n<li>skjdcnksdjcnkjsd</li>\r\n<li>sdncsdnckjsd</li>\r\n<li>skdjcnskdjnj</li>\r\n<li>kjbkjbkjkjkj</li>\r\n<li>kjuknnkjnkj</li>\r\n</ul>\r\n<p>hello k cha khaber</p>\r\n<p>hahhahhaha</p>', 10, '2015-06-02 09:46:50', '<ul>\r\n<li>&nbsp;wjnkjsc kjw ckjweckj</li>\r\n<li>skjdcnsdkjc</li>\r\n<li>skjdcnksdjcnkjsd</li>\r\n<li>sdnc', '0', '2015-06-18 05:12:41', 0, 0, '', '0', 1, 1, 1, 'TPuT8yesno plugin.JPG'),
(26, 'Test page & sushil fdgh ksdfgsdg', '<p><em><strong>I am </strong></em>writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test p<em><strong>age.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;</strong></em></p>', 10, '2015-06-03 06:31:24', '<p><em><strong>I am </strong></em>writing the content for test page.&nbsp;I am writing the content f', '1', '2015-06-18 05:26:40', 0, 0, '', '0', 0, 1, 1, '0'),
(29, ' hqwiur hqw u"SAF as F"wee"AF"87378as rsdfgsdgsd fs', '<p>"jkbkjvbfvbnjkkj kjkjfgkjdfg bkjdbgkjdfjkngjnfdjkf bdkjgbdjfkgkjdkjfgjkbjkbkj"</p>', 10, '2015-06-16 08:05:18', '<p>"jkbkjvbfvbnjkkj kjkjfgkjdfg bkjdbgkjdfjkngjnfdjkf bdkjgbdjfkgkjdkjfgjkbjkbkj"</p>', '1', '2015-06-18 05:31:04', 0, 0, '', '0', 0, 1, 1, '0'),
(32, 'Title naviga', '<div class="stylemin" align="justify"><font size="4" face="Calibri, Verdana, Times New Roman">SER-N is pleased to announce a short-term course on Survey Data Analysis Techniques from May 11-15, 2015. We are organizing this training in collaboration with the Population Studies Center (PSC) of the University of Michigan, USA.</font> <a href="http://isernepal.org.np/news.php?topic=100#news100">More..</a></div>\r\n<p>&nbsp;</p>\r\n<div class="stylemin" align="justify"><span class="style53"><strong><a href="http://isernepal.org.np/news.php?topic=99#news99">Survey Data Analysis Training</a></strong> <br /></span><font size="3" face="Calibri, Verdana, Times New Roman">ISER-N in collaboration with the Survey Research Center of the University of Michigan, USA organized a 5-day training on Survey Data Analysis Techniques from November 24-28, 2014 at its central campus in Fulbari, Chitwan. The goal of this short course </font><a href="http://isernepal.org.np/news.php?topic=99#news99">More..</a></div>\r\n<p>&nbsp;</p>\r\n<div class="stylemin" align="justify"><span class="style53"><strong><a href="http://isernepal.org.np/news.php?topic=98#news98">Announcement: International Training on Survey Data Analysis</a></strong> <br /></span><font face="Calibri, Verdana, Times New Roman"><font size="3">ISER-N is pleased to announce short-term courses on Survey Data Analysis Techniques from November 24-28, 2014. ISER-N is organizing these trainings in collaboration with the Population Studies Center (PSC) of the University of Michigan, USA. </font></font><a href="http://isernepal.org.np/news.php?topic=98#news98">More..</a></div>\r\n<p>&nbsp;</p>\r\n<div class="stylemin" align="justify"><span class="style53"><strong><a href="http://isernepal.org.np/news.php?topic=96#news96">UNFPA Sponsored Training on Survey Data Analysis </a></strong><br /></span><font face="Calibri, Verdana, Times New Roman">ISER-N, in collaboration with the University of Michigan, USA offered a short course on Survey Data Analysis Techniques at its central campus in Fulbari, Chitwan from December 1-5, 2013.</font> <a href="http://isernepal.org.np/news.php?topic=96#news96">More..</a></div>\r\n<p>&nbsp;</p>\r\n<div class="stylemin" align="justify"><span class="style53"><strong><a href="http://isernepal.org.np/news.php?topic=95#news95">Survey Data Analysis Training</a></strong> <br /></span><font size="3" face="Calibri, Verdana, Times New Roman">ISER-N in collaboration with the University of Michigan, USA organized a training on Survey Data Analysis Techniques from November 25-29, 2013 at its central campus in Fulbari, Chitwan. The goal of this training</font> <a href="http://isernepal.org.np/news.php?topic=95#news95">More..</a></div>', 10, '2015-06-18 10:36:09', '<div class="stylemin" align="justify"><font size="4" face="Calibri, Verdana, Times New Roman">SER-N ', '1', '2015-06-19 00:33:52', 0, 0, '', '0', 0, 1, 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_title` mediumtext NOT NULL,
  `post_author_id` int(11) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_summary` mediumtext,
  `post_status` mediumtext NOT NULL,
  `comment_status` tinyint(1) DEFAULT NULL,
  `post_modified_date` date DEFAULT NULL,
  `post_tags` mediumtext,
  `post_content` text NOT NULL,
  `post_category` int(11) NOT NULL,
  `allow_comment` tinyint(1) NOT NULL,
  `allow_like` tinyint(1) NOT NULL,
  `allow_share` tinyint(1) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_post` (`post_category`),
  KEY `idx_post_0` (`post_author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `post_title`, `post_author_id`, `post_date`, `post_summary`, `post_status`, `comment_status`, `post_modified_date`, `post_tags`, `post_content`, `post_category`, `allow_comment`, `allow_like`, `allow_share`, `image`) VALUES
(32, 'post with pic sdfsfs "amrita" ''sapkota''', 0, '2015-06-08 04:55:37', '<p>fhgdfhdfh</p>', '0', NULL, NULL, NULL, '<p>fhgdfhdfh</p>', 0, 0, 0, 0, '1Bnf53jNCyDSC_3004-Optimized.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE IF NOT EXISTS `slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slide_name` varchar(100) NOT NULL DEFAULT 'Required',
  `slide_image` varchar(100) NOT NULL DEFAULT 'Required',
  `slide_content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id`, `slide_name`, `slide_image`, `slide_content`) VALUES
(5, 'Doctor', '1.PNG', 'Home');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL DEFAULT 'Required',
  `user_fname` varchar(100) DEFAULT NULL,
  `user_lname` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_pass` varchar(64) NOT NULL DEFAULT 'Required',
  `user_url` mediumtext,
  `user_registered_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_auth_key` varchar(64) DEFAULT NULL,
  `user_status` varchar(64) DEFAULT NULL,
  `user_type` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `user_fname`, `user_lname`, `user_email`, `user_pass`, `user_url`, `user_registered_date`, `user_auth_key`, `user_status`, `user_type`) VALUES
(10, 'admin', 'hom nath', 'bagale', 'bhomnath@salyani.com.np', '21232f297a57a5a743894a0e4a801fc3', NULL, '2014-03-06 10:01:57', '64L3XB9ID5', '0', 'Administrator'),
(12, 'krishna', 'krishna', 'acharya', 'kacharya@salyani.com.np', 'fcea920f7412b5da7be0cf42b8c93759', NULL, '2015-06-16 08:34:16', NULL, '1', 'Administrator'),
(14, 'amzz', 'Amzz', 'Sharma', 'asapkota@salyani.com.np', '3dc1e4c3bc5b2ae63520627ea44df7fd', NULL, '2015-06-18 07:53:48', NULL, '0', 'Administrator'),
(16, 'Amri', 'Amrita', 'Sharma', 'abc@gmail.com', '74b87337454200d4d33f80c4663dc5e5', NULL, '2015-06-18 08:04:21', NULL, '1', 'Administrator');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `fk_media` FOREIGN KEY (`media_association_id`) REFERENCES `album` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `navigation`
--
ALTER TABLE `navigation`
  ADD CONSTRAINT `fk_navigation_menu` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
