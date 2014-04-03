-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 26, 2014 at 11:31 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bnw`
--
CREATE DATABASE IF NOT EXISTS `bnw` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bnw`;

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_name` varchar(100) NOT NULL DEFAULT 'Required',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `album_name`) VALUES
(8, 'my album'),
(9, 'bhupendra'),
(10, 'ramji');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL DEFAULT 'Required',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(1, 'asdsa'),
(2, 'asdasdsa'),
(3, 'sadsadasdas'),
(4, 'sadsadasda'),
(5, 'sdfvcv'),
(6, 'fgyhtynvb'),
(7, 'gbgfhncvv');

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
(0, 'header_title', 'Chitwan Gaida Lodge'),
(1, 'header_logo', 'logofinal1.png'),
(2, 'header_description', 'Simplifying your tour'),
(3, 'header_bgcolor', 'FFFFFF'),
(4, 'sidebar_title', 'Quick navigation'),
(5, 'sidebar_description', 'changed by ramu'),
(6, 'sidebar_bgcolor', 'FFFFFF');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `media_name`, `media_type`, `media_association_id`, `media_link`) VALUES
(15, 'hdhfjndlk', 'New_Document.docx', NULL, '0'),
(17, 'sfdoifh', 'whale.jpg', 8, '0'),
(18, 'ssasadsa', 'monkey1.jpg', NULL, '0'),
(19, 'iufhiusd', 'tree2.jpg', NULL, 'http://localhost/bnw/content/images/tree2.jpg'),
(20, 'sajdklas', 'tree1.jpg', 8, '0'),
(21, 'ajkshfjks', 'schema1.jpg', 9, '0'),
(22, 'kcbjksdm.s\\''.c', 'monkey1.jpg', 9, '0');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(100) NOT NULL DEFAULT 'Required',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `menu_name`) VALUES
(4, 'Home Menu'),
(5, 'Sidebar Menu'),
(6, 'Footer Menu');

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
(1, 'siteurl', 'www.BnW.com'),
(2, 'title', 'B&W Dashboard'),
(3, 'keywords', 'cms'),
(4, 'description', 'cloud system'),
(5, 'favicon_icon', 'logofinal3.png');

-- --------------------------------------------------------

--
-- Table structure for table `misc_setting`
--

CREATE TABLE IF NOT EXISTS `misc_setting` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `description` tinyint(1) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `misc_setting`
--

INSERT INTO `misc_setting` (`Id`, `name`, `description`) VALUES
(0, 'show_comment', 0),
(1, 'show_like', 0),
(2, 'show_share', 1);

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
  PRIMARY KEY (`id`),
  KEY `idx_navigation` (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `navigation`
--

INSERT INTO `navigation` (`id`, `navigation_name`, `navigation_link`, `parent_id`, `navigation_type`, `navigation_slug`, `menu_id`) VALUES
(28, 'Why Us', 'page/3', 0, 'page', 'WhyUs', 4),
(29, 'Contact Us', 'page/4', 0, 'page', 'ContactUs', 4),
(30, 'Gallery', 'photos', 0, ' ', 'Gallery', 4),
(31, 'Home', 'page/1', 0, 'page', 'Home', 4),
(32, 'Introduction', 'page/2', 0, 'page', 'Introduction', 4),
(33, 'dsdadasd', 'page/5', 30, 'page', 'dsdadasd', NULL),
(34, 'asdsaddsad', 'page/6', 30, 'page', 'asdsaddsad', NULL),
(35, 'Why Us', 'page/3', 0, 'page', 'WhyUs', NULL),
(36, 'Contact Us', 'page/4', 0, 'page', 'ContactUs', NULL),
(37, 'Contact Us', 'page/4', 0, 'page', 'ContactUs', NULL),
(38, 'dsdadasd', 'page/5', 0, 'page', 'dsdadasd', NULL);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `page_name`, `page_content`, `page_author_id`, `page_date`, `page_summary`, `page_status`, `page_modifed_date`, `page_parent`, `page_order`, `page_type`, `page_tags`, `allow_comment`, `allow_like`, `allow_share`) VALUES
(1, 'Home', 'Parse is the cloud app platform for iOS, Android, JavaScript, Windows 8,\r\n Windows Phone 8, and OS X. Never worry again about setting up your own \r\nservers.<br><br>Every SDK comes bundled with a couple of sample apps. If you want to \r\nlearn how to use all the Facebook Platform features just download and \r\ninstall the SDK and start hacking.<br>', 10, '2014-03-14 04:42:28', 'Parse is the cloud app platform for iOS, Android, JavaScript, Windows 8,\r\n Windows Phone 8, and OS X', '1', '0000-00-00 00:00:00', 0, 0, '0', '0', 0, 0, 0),
(2, 'Introduction', '      Every SDK comes bundled with a couple of sample apps. If you want to \r\nlearn how to use all the Facebook Platform features just download and \r\ninstall the SDK and start hacking.<br>Every SDK comes bundled with a couple of sample apps. If you want to \r\nlearn how to use all the Facebook Platform features just download and \r\ninstall the SDK and start hacking.<br>', 10, '2014-03-14 04:42:49', '      Every SDK comes bundled with a couple of sample apps. If you want to \r\nlearn how to use all th', '0', '0000-00-00 00:00:00', 0, 0, '', '0', 0, 0, 0),
(3, 'Why Us', 'Every SDK comes bundled with a couple of sample apps. If you want to \r\nlearn how to use all the Facebook Platform features just download and \r\ninstall the SDK and start hacking.<br>Every SDK comes bundled with a couple of sample apps. If you want to \r\nlearn how to use all the Facebook Platform features just download and \r\ninstall the SDK and start hacking.<br>Every SDK comes bundled with a couple of sample apps. If you want to \r\nlearn how to use all the Facebook Platform features just download and \r\ninstall the SDK and start hacking.<br>', 10, '2014-03-14 04:44:30', 'Every SDK comes bundled with a couple of sample apps. If you want to \r\nlearn how to use all the Face', '1', '0000-00-00 00:00:00', 0, 0, '0', '0', 0, 0, 0),
(4, 'Contact Us', 'Every SDK comes bundled with a couple of sample apps. If you want to \r\nlearn how to use all the Facebook Platform features just download and \r\ninstall the SDK and start hacking.', 10, '2014-03-14 04:44:49', 'Every SDK comes bundled with a couple of sample apps. If you want to \r\nlearn how to use all the Face', '1', '0000-00-00 00:00:00', 0, 0, '0', '0', 0, 0, 0),
(5, 'dsdadasd', 'dasddsad<br>', 10, '2014-03-18 08:28:40', 'dasddsad<br>', '1', '0000-00-00 00:00:00', 0, 0, '0', '0', 0, 0, 0),
(6, 'asdsaddsad', 'dsadaddds<br>', 10, '2014-03-18 08:28:48', 'dsadaddds<br>', '1', '0000-00-00 00:00:00', 0, 0, '0', '0', 0, 0, 0),
(7, 'sdsadadsdddd', 'asdasdasdsasad<br>', 10, '2014-03-18 08:28:56', 'asdasdasdsasad<br>', '1', '0000-00-00 00:00:00', 0, 0, '0', '0', 0, 0, 0),
(8, 'axsas', 'saxasa<br>', 10, '2014-03-18 08:42:00', 'saxasa<br>', '1', '0000-00-00 00:00:00', 0, 0, '0', '0', 0, 0, 0),
(9, 'ssacdsfrgv', 'bgtrgtgdsfcqw<br>', 10, '2014-03-18 08:42:09', 'bgtrgtgdsfcqw<br>', '1', '0000-00-00 00:00:00', 0, 0, '0', '0', 0, 0, 0);

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
  PRIMARY KEY (`id`),
  KEY `idx_post` (`post_category`),
  KEY `idx_post_0` (`post_author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `post_title`, `post_author_id`, `post_date`, `post_summary`, `post_status`, `comment_status`, `post_modified_date`, `post_tags`, `post_content`, `post_category`, `allow_comment`, `allow_like`, `allow_share`) VALUES
(1, 'Earn $100 in one day', 10, '2014-03-20 06:05:22', '      Entrepreneurs are a different kind of people. They are never \r\ncompletely satisfied with the n', '0', 2, NULL, '', '      Entrepreneurs are a different kind of people. They are never \r\ncompletely satisfied with the normal, acceptable lifestyle commonly \r\ncalled “successful” by the rest of society. This traditional “success” \r\noften includes a good job, a nice house with a 30-year mortgage, a \r\ncouple of nice cars (on which it’s considered OK to owe a lot of money),\r\n a few weeks of vacation every year from the job you don’t really enjoy,\r\n etc.<br>If you’re reading this blog, you’re probably not content with that kind of success.', 7, 0, 0, 0),
(2, 'how can you freelance', 10, '2014-03-20 06:07:11', 'I’ve been getting a lot of emails lately from people who are looking \r\nto start working for themse', '0', 2, NULL, '', 'I’ve been getting a lot of emails lately from people who are looking \r\nto start working for themselves. &nbsp;Whether it’s a small business on \r\nthe side, or they’re looking to create a full time location independent \r\nbusiness, it’s obvious there’s a lot of entrepreneurial spirit out \r\nthere.<div absolute;="" top:="" -1999px;="" left:="" -1988px;"="" id="stcpDiv">\r\n<p>Along with questions about building a business, I’m asked frequently what business <em>I </em>run.</p>\r\n<p>If we’re going to start getting real about creating a location \r\nindependent income, I’m going to have to build a little bit of \r\ncredibilty.</p>\r\n<p>So here’s what I do:</p>\r\n<h3><em><strong>I’m an SEO Freelancer (for lack of a better term).</strong></em></h3>\r\n<p>For those of you who don’t know what SEO means, it stands for Search \r\nEngine Optimization. Essentially it’s my job to make sure my clients \r\nrank as highly as possible in Google (or other search engines) for the \r\nkey terms that we’ve decided are most important to their success.</p> - \r\nSee more at: \r\nfile:///G:/websites/How to Become an SEO Freelancer in 48 Hours — Location 180 _ Build a Business, Live Anywhere, Achieve Free.</div><div absolute;="" top:="" -1999px;="" left:="" -1988px;"="" id="stcpDiv"><p><br></p><p><br></p><br></div>', 7, 0, 0, 0),
(3, 'Post allowing comment', 10, '2014-03-26 06:35:17', '                  duifhioakfkdopfuijcnydsbc<br>', '0', 2, NULL, '', '                  duifhioakfkdopfuijcnydsbc<br>', 7, 1, 0, 0);

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
(2, 'image', 'whale.jpg', 'Whale'),
(3, 'tree', 'tree.jpg', 'tree'),
(4, 'schema', 'schema.jpg', ''),
(5, 'monkey', 'monkey.jpg', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `user_fname`, `user_lname`, `user_email`, `user_pass`, `user_url`, `user_registered_date`, `user_auth_key`, `user_status`, `user_type`) VALUES
(10, 'admin', 'hom nath', 'bagale', 'bhomnath@salyani.com.np', '21232f297a57a5a743894a0e4a801fc3', NULL, '2014-03-06 10:01:57', '64L3XB9ID5', '1', '0');

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
