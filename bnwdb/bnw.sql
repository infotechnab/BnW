-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 09, 2014 at 06:55 AM
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_name` varchar(100) NOT NULL DEFAULT 'Required',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `album_name`) VALUES
(1, 'my album'),
(20, 'asdf'),
(21, 'my album'),
(22, 'asdf'),
(23, 'asdf'),
(24, 'myyyyyy'),
(25, 'my n only my');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL DEFAULT 'Required',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(5, 'cate'),
(6, 'cataa'),
(7, 'cataaaa'),
(8, 'cataaaaaaaaa');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `media_name` varchar(100) NOT NULL DEFAULT 'Required',
  `media_type` varchar(64) DEFAULT 'Required',
  `media_association_id` int(11) DEFAULT NULL,
  `media_link` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_media` (`media_association_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `media_name`, `media_type`, `media_association_id`, `media_link`) VALUES
(10, 'photos', 'photo', 1, 'www.salyani.com.np'),
(12, 'my media', 'video', 1, 'www.youtube.com'),
(24, 'screenshots', 'photo', 1, 'aaa');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(100) NOT NULL DEFAULT 'Required',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `menu_name`) VALUES
(1, 'asdf');

-- --------------------------------------------------------

--
-- Table structure for table `meta_data`
--

CREATE TABLE IF NOT EXISTS `meta_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

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
-- Table structure for table `navigation`
--

CREATE TABLE IF NOT EXISTS `navigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `navigation_name` varchar(100) NOT NULL DEFAULT 'Required',
  `navigation_link` mediumtext,
  `parent_id` int(11) DEFAULT NULL,
  `navigation_type` varchar(64) DEFAULT NULL,
  `navigatoin_slug` varchar(64) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_navigation` (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`id`),
  KEY `idx_page` (`page_author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `page_name`, `page_content`, `page_author_id`, `page_date`, `page_summary`, `page_status`, `page_modifed_date`, `page_parent`, `page_order`, `page_type`, `page_tags`) VALUES
(32, 'why us', 'This section deals with why we are for u<br>', 0, '2014-01-31 09:21:25', 'the summary goes here', '0', '0000-00-00 00:00:00', 0, 0, '', '0'),
(34, 'home page', '      Hi this is a homepage<br>', 0, '2014-02-03 04:33:09', 'Summary of home page goes here.\r\n', '0', '0000-00-00 00:00:00', 0, 0, '', '0'),
(35, 'blog', 'this is my blog<br>', 0, '2014-02-05 05:40:54', 'saas', '1', '0000-00-00 00:00:00', 0, 0, '0', '0');

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
  PRIMARY KEY (`id`),
  KEY `idx_post` (`post_category`),
  KEY `idx_post_0` (`post_author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id`, `slide_name`, `slide_image`, `slide_content`) VALUES
(3, 'my slide', 'flag2.png', 'this is a flag'),
(8, 'ljskdlkfj', 'Facebook-Like-Button.png', 'like '),
(9, 'my food', 'food110.jpg', '');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `user_fname`, `user_lname`, `user_email`, `user_pass`, `user_url`, `user_registered_date`, `user_auth_key`, `user_status`) VALUES
(1, 'admin', 'Salyani ', 'Technologies ', 'info@salyani.com', '098f6bcd4621d373cade4e832627b4f6', 'salyani.com.np', '2014-01-30 05:04:49', NULL, '1'),
(8, 'user', 'use', 'this', 'user@user.com', 'ee11cbb19052e40b07aac0ca060c23ee', NULL, '2014-02-04 05:55:50', NULL, '1'),
(9, 'salyani', 'Salyani ', 'Tech ', 'info@gmail.com', 'b35315ceeff01c26661273932aec860d', NULL, '2014-02-05 05:02:50', NULL, '1');

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

--
-- Constraints for table `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `fk_page_user` FOREIGN KEY (`page_author_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_post_category` FOREIGN KEY (`post_category`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_post_user` FOREIGN KEY (`post_author_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
