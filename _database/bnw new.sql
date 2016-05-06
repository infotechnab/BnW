-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2016 at 01:24 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bnw`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `album_name` varchar(100) NOT NULL DEFAULT 'Required'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `album_name`) VALUES
(7, 'my album'),
(10, 'sf');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL DEFAULT 'Required'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(49, 'hvjkghdf'),
(50, '(bhsdgf){');

-- --------------------------------------------------------

--
-- Table structure for table `comment_store`
--

CREATE TABLE `comment_store` (
  `Id` int(11) NOT NULL,
  `comment` varchar(200) CHARACTER SET utf8 NOT NULL,
  `comment_association_id` varchar(64) NOT NULL,
  `comment_user_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `contact_address` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_no1` varchar(255) NOT NULL,
  `contact_no2` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `show_form` varchar(255) NOT NULL,
  `show_map` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_address`
--

INSERT INTO `contact_address` (`id`, `name`, `address`, `contact_no1`, `contact_no2`, `email`, `show_form`, `show_map`) VALUES
(1, 'Salyani Technologies Pvt. Ltd.', 'Lions Chowk,Narayangarh,Chitwan,Nepal', '056-533977', '', 'info@salyani.com.np', 'showForm', 'showMap');

-- --------------------------------------------------------

--
-- Table structure for table `contact_list`
--

CREATE TABLE `contact_list` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `remarks` varchar(1000) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `design_setup` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(500) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `design_setup`
--

INSERT INTO `design_setup` (`id`, `name`, `description`) VALUES
(0, 'header_title', 'BnW - A complete CMS#'),
(1, 'header_logo', 'bnw1.png'),
(2, 'header_description', 'This is header..You can write whatever you want..'),
(3, 'header_bgcolor', NULL),
(4, 'sidebar_title', 'Quick navigation abcdefg'),
(5, 'sidebar_description', 'changed by krishnaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'),
(6, 'sidebar_bgcolor', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `details` text CHARACTER SET utf8 NOT NULL,
  `location` varchar(200) CHARACTER SET utf8 NOT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `insert_date` date NOT NULL,
  `last_modified_date` date DEFAULT NULL,
  `image` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `seo_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `details`, `location`, `start_date`, `end_date`, `insert_date`, `last_modified_date`, `image`, `type`, `seo_title`) VALUES
(16, 'new event', '<p>this is new event going to be organized very soon.this is new event going to be organized very soon.this is new event going to be organized very soon.this is new event going to be organized very soon.this is new event going to be organized very soon.this is new event going to be organized very soon.this is new event going to be organized very soon.this is new event going to be organized very soon.this is new event going to be organized very soon.this is new event going to be organized very so</p>', 'Bharatpur', '2015-06-17 18:15:00', NULL, '0000-00-00', '2015-06-19', '', 'event', ''),
(21, 'Krishna ko news', '<p>asdasdasdas</p>', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-19', '2015-06-19', '', 'news', ''),
(23, 'Krishna ko event', '<p>asdas</p>', 'saa', '2015-06-29 18:15:00', NULL, '0000-00-00', NULL, NULL, 'event', ''),
(30, 'event', '', '', NULL, NULL, '2015-06-21', NULL, NULL, 'news', ''),
(31, 'vdgashfsahg', '<p>fghfsahgfdhgasdsa</p>', '', NULL, NULL, '2015-09-28', NULL, NULL, 'news', '');

-- --------------------------------------------------------

--
-- Table structure for table `gadgets`
--

CREATE TABLE `gadgets` (
  `gadget_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `textBox` varchar(100) NOT NULL,
  `defaultGadget` text NOT NULL,
  `type` text NOT NULL,
  `display` varchar(200) NOT NULL,
  `setting` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gadgets`
--

INSERT INTO `gadgets` (`gadget_id`, `name`, `textBox`, `defaultGadget`, `type`, `display`, `setting`) VALUES
(226, 'Social Network', 'textBox', '', '<p>Facebook<br /> Twitter<br /> Linkid<br/> Yahoo Mail</p>\r\n', 'Footer', '');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempt`
--

CREATE TABLE `login_attempt` (
  `id` int(255) UNSIGNED NOT NULL,
  `attempt` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_attempt`
--

INSERT INTO `login_attempt` (`id`, `attempt`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempt_list`
--

CREATE TABLE `login_attempt_list` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_attempts` int(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `last_attempt_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_attempt_list`
--

INSERT INTO `login_attempt_list` (`id`, `name`, `user_attempts`, `ip_address`, `last_attempt_date`) VALUES
(1, 'asdfsdasf', 47, '::1', '2016-04-28 13:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `media_name` varchar(100) NOT NULL DEFAULT 'Required',
  `media_type` text,
  `media_association_id` int(11) DEFAULT NULL,
  `media_link` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `media_name`, `media_type`, `media_association_id`, `media_link`) VALUES
(21, 'Required', '5581571c542891.53382514.png\r\n', NULL, NULL),
(23, 'Required', '55815fcd5c94a6.20846743.jpg', NULL, NULL),
(24, 'werqwerqwer', 'iATx7Screenshot (136).png', 10, '0'),
(42, 'asdfsafd', 'url.jpg', NULL, 'http://localhost/bnw/content/images/url.jpg'),
(46, 'Required', '55890a94da8ce3.98961789.jpg', NULL, NULL),
(52, 'sadfsafsasadf', 'hgignore_global.gif', NULL, 'http://localhost/bnw/content/images/hgignore_global.gif');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `menu_name` varchar(100) NOT NULL DEFAULT 'Required'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `menu_name`) VALUES
(4, 'Home Menu');

-- --------------------------------------------------------

--
-- Table structure for table `meta_data`
--

CREATE TABLE `meta_data` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meta_data`
--

INSERT INTO `meta_data` (`id`, `name`, `value`) VALUES
(1, 'siteurl', 'www.salyani.org'),
(2, 'title', 'BnW - An complete CMS'),
(3, 'keywords', 'BBC'),
(4, 'description', 'Home loan'),
(5, 'favicon_icon', 'favicon.ico');

-- --------------------------------------------------------

--
-- Table structure for table `misc_setting`
--

CREATE TABLE `misc_setting` (
  `Id` int(11) NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `description` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `misc_setting`
--

INSERT INTO `misc_setting` (`Id`, `name`, `description`) VALUES
(0, 'show_comment', '1'),
(1, 'show_like', '1'),
(2, 'show_share', '0'),
(3, 'max_post_to_show', '5'),
(4, 'max_page_to_show', '5'),
(5, 'slide_height', '900'),
(6, 'slide_width', '1380');

-- --------------------------------------------------------

--
-- Table structure for table `navigation`
--

CREATE TABLE `navigation` (
  `id` int(11) NOT NULL,
  `navigation_name` varchar(100) NOT NULL DEFAULT 'Required',
  `navigation_link` mediumtext,
  `parent_id` int(11) DEFAULT NULL,
  `navigation_type` varchar(64) DEFAULT NULL,
  `navigation_slug` varchar(64) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `category_id` varchar(255) DEFAULT NULL,
  `post_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `page_name` varchar(100) NOT NULL DEFAULT 'Required',
  `page_content` text NOT NULL,
  `page_author_id` int(11) NOT NULL,
  `page_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `page_summary` mediumtext,
  `page_status` varchar(100) DEFAULT NULL,
  `page_modifed_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `page_parent` int(11) DEFAULT NULL,
  `page_order` int(11) DEFAULT NULL,
  `page_type` varchar(100) DEFAULT NULL,
  `page_tags` mediumtext,
  `allow_comment` tinyint(1) DEFAULT NULL,
  `allow_like` tinyint(1) DEFAULT NULL,
  `allow_share` tinyint(1) DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `seo_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `page_name`, `page_content`, `page_author_id`, `page_date`, `page_summary`, `page_status`, `page_modifed_date`, `page_parent`, `page_order`, `page_type`, `page_tags`, `allow_comment`, `allow_like`, `allow_share`, `images`, `seo_title`) VALUES
(6, 'pagination trackdfh', '<p>sfsfdgsdfgdg</p>', 10, '2015-05-31 10:08:04', '<p>sfsfdgsdfgdg</p>', '1', '2015-06-19 04:44:25', 0, 0, '', '0', 0, 1, 1, '0', ''),
(9, ' kamal ', '<p>&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;</p>\r\n<p>kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;</p>\r\n<p>kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;</p>\r\n<p>kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;</p>', 10, '2015-05-31 10:19:30', '<p>&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kamal&nbsp;kam', '0', '2015-06-18 03:35:15', 0, 0, '', '0', 0, 1, 1, '0', ''),
(23, 'Hari parsad ', '<p>Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;</p>\r\n<p>Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;</p>\r\n<p>Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;</p>\r\n<p>Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;</p>', 10, '2015-06-01 07:48:47', '<p>Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nbsp;Hari&nb', '1', '2015-06-19 05:11:26', 0, 0, '', '0', 0, 1, 1, '0', ''),
(24, 'my new page', '<ul>\r\n<li>&nbsp;wjnkjsc kjw ckjweckj</li>\r\n<li>skjdcnsdkjc</li>\r\n<li>skjdcnksdjcnkjsd</li>\r\n<li>sdncsdnckjsd</li>\r\n<li>skdjcnskdjnj</li>\r\n<li>kjbkjbkjkjkj</li>\r\n<li>kjuknnkjnkj</li>\r\n</ul>\r\n<p>hello k cha khaber</p>\r\n<p>hahhahhaha</p>', 10, '2015-06-02 09:46:50', '<ul>\r\n<li>&nbsp;wjnkjsc kjw ckjweckj</li>\r\n<li>skjdcnsdkjc</li>\r\n<li>skjdcnksdjcnkjsd</li>\r\n<li>sdnc', '0', '2015-06-18 05:12:41', 0, 0, '', '0', 1, 1, 1, 'TPuT8yesno plugin.JPG', ''),
(26, 'Test page & sushil fdgh ksdfgsdg', '<p><em><strong>I am </strong></em>writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test p<em><strong>age.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;I am writing the content for test page.&nbsp;</strong></em></p>', 10, '2015-06-03 06:31:24', '<p><em><strong>I am </strong></em>writing the content for test page.&nbsp;I am writing the content f', '1', '2015-06-18 05:26:40', 0, 0, '', '0', 0, 1, 1, '0', ''),
(29, ' hqwiur hqw u"SAF as F"wee"AF"87378as rsdfgsdgsd fs', '<p>"jkbkjvbfvbnjkkj kjkjfgkjdfg bkjdbgkjdfjkngjnfdjkf bdkjgbdjfkgkjdkjfgjkbjkbkj"</p>', 10, '2015-06-16 08:05:18', '<p>"jkbkjvbfvbnjkkj kjkjfgkjdfg bkjdbgkjdfjkngjnfdjkf bdkjgbdjfkgkjdkjfgjkbjkbkj"</p>', '1', '2015-06-18 05:31:04', 0, 0, '', '0', 0, 1, 1, '0', ''),
(33, '& fhgfsh', '<p>gsdjkvkjhdv hsdkjhkjhdvk kjhskjhdvkjhsd</p>', 10, '2015-06-19 10:44:25', '<p>gsdjkvkjhdv hsdkjhkjhdvk kjhskjhdvkjhsd</p>', '1', '2015-06-19 04:59:25', 0, 0, '0', '0', 0, 1, 1, '', ''),
(34, 'fghffgfhg', '<p>jhjhghjj hhjgjhj&nbsp;</p>', 10, '2015-06-19 11:11:40', '<p>jhjhghjj hhjgjhj&nbsp;</p>', '1', '2015-06-19 05:26:40', 0, 0, '0', '0', 0, 1, 1, '', ''),
(35, 'testing', '<p>ghfghdiufhgiu jdfkjghdkjhf djkhfjkhfdk jdkfhguihd</p>', 10, '2015-06-19 11:12:02', '<p>ghfghdiufhgiu jdfkjghdkjhf djkhfjkhfdk jdkfhguihd</p>', '1', '2015-06-19 05:27:02', 0, 0, '0', '0', 0, 1, 1, '', ''),
(36, 'pages', '<p>hhgskhkhkfg iuhdigh iuhdgh</p>', 10, '2015-06-19 11:12:30', '<p>hhgskhkhkfg iuhdigh iuhdgh</p>', '1', '2015-06-19 05:27:30', 0, 0, '0', '0', 0, 1, 1, '', ''),
(37, 'abc', '<p>body &nbsp;body&nbsp;body vvbody&nbsp;body&nbsp;body vbody&nbsp;</p>', 10, '2015-06-19 11:13:41', '<p>body &nbsp;body&nbsp;body vvbody&nbsp;body&nbsp;body vbody&nbsp;</p>', '0', '2015-06-21 01:03:12', 0, 0, '', '0', 0, 1, 1, 'hofBn4QLPtevnt_img.PNG', ''),
(38, 'jpgggggg', '<p>kskjvjvskjdvkjhskjhd hbfvbsjkv hfbh jvlksj.</p>\r\n<ul  circle;">\r\n<li>hgkhkghhd</li>\r\n<li>jhdfkjghfjdk</li>\r\n<li>kdhfglkhfd</li>\r\n<li>hsdkghkldfh</li>\r\n<li>dsfhfdh</li>\r\n<li>kjkjhk</li>\r\n</ul>', 10, '2015-06-19 11:14:05', '<p>kskjvjvskjdvkjhskjhd hbfvbsjkv hfbh jvlksj.</p>\r\n<ul  circle;">\r\n<li>hgkhkghhd</li>\r\n<li>jhdfkjgh', '1', '2015-06-19 05:33:20', 0, 0, '', '0', 0, 1, 1, '0', ''),
(39, 'title', '<p>hfjgkhkjghkjsf dhgkjhfdkjg jhdkjfhgkjf</p>', 10, '2015-06-19 11:14:32', '<p>hfjgkhkjghkjsf dhgkjhfdkjg jhdkjfhgkjf</p>', '1', '2015-06-19 05:29:32', 0, 0, '0', '0', 0, 1, 1, '', ''),
(43, 'krishna', '<p>gsjhgfjdsfkjhd</p>', 10, '2015-06-19 11:16:29', '<p>gsjhgfjdsfkjhd</p>', '1', '2015-06-19 05:31:29', 0, 0, '0', '0', 0, 1, 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `post_title` mediumtext NOT NULL,
  `post_author_id` int(11) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_summary` mediumtext,
  `post_status` mediumtext,
  `comment_status` tinyint(1) DEFAULT NULL,
  `post_modified_date` date DEFAULT NULL,
  `post_tags` mediumtext,
  `post_content` text NOT NULL,
  `post_category` varchar(255) DEFAULT NULL,
  `allow_comment` tinyint(1) DEFAULT NULL,
  `allow_like` tinyint(1) DEFAULT NULL,
  `allow_share` tinyint(1) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `seo_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `post_title`, `post_author_id`, `post_date`, `post_summary`, `post_status`, `comment_status`, `post_modified_date`, `post_tags`, `post_content`, `post_category`, `allow_comment`, `allow_like`, `allow_share`, `image`, `seo_title`) VALUES
(55, 'New Post ', 0, '2015-06-21 07:31:11', '<p>My Post.. jbkjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjbbbbbbbbbjjkkkkkkkkkkkkkkkkkkkkkkkk</p>', '0', NULL, NULL, NULL, '<p>My Post.. jbkjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjbbbbbbbbbjjkkkkkkkkkkkkkkkkkkkkkkkk</p>', '45', 0, 0, 0, '5c95ilatest bnw.PNG', ''),
(56, 'gdsjhgfsdjhg', 0, '2015-09-28 08:07:48', '<p>jhgfdsjhgfjhsdgjfsd</p>', NULL, NULL, NULL, NULL, '<p>jhgfdsjhgfjhsdgjfsd</p>', '0', 0, 0, 0, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `slide_name` varchar(100) NOT NULL DEFAULT 'Required',
  `slide_image` varchar(100) NOT NULL DEFAULT 'Required',
  `slide_content` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id`, `slide_name`, `slide_image`, `slide_content`) VALUES
(7, 'home', 'BLDHM026.JPG', 'This is home.'),
(8, 'Mobile', 'a3price.PNG', 'A3 vs A5'),
(9, '"3"', 'images_(1).png', 'This is image no "3"..'),
(10, '4', 'inspiring-quotes-positive-thinking-2-600x512.jpg', 'This is image 4...Inspiring  Quotes for life..'),
(11, 'Image 5', 'o-POSITIVE-THINKING-facebook.jpg', 'My Positive Thinking'),
(12, 'Study In japan', '1.JapanStudy_1.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL DEFAULT 'Required',
  `user_fname` varchar(100) DEFAULT NULL,
  `user_lname` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_pass` varchar(64) NOT NULL DEFAULT 'Required',
  `user_url` mediumtext,
  `user_registered_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_auth_key` varchar(64) DEFAULT NULL,
  `user_status` varchar(64) DEFAULT NULL,
  `user_type` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `user_fname`, `user_lname`, `user_email`, `user_pass`, `user_url`, `user_registered_date`, `user_auth_key`, `user_status`, `user_type`) VALUES
(10, 'admin', 'hom nath', 'bagale', 'bhomnath@salyani.com.np', '21232f297a57a5a743894a0e4a801fc3', NULL, '2014-03-06 10:01:57', 'VREG6H85C1', '1', 'Administrator'),
(11, 'sanoj', 'sda', 'asdff', 'sanojsth42@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, '2016-04-23 14:40:13', '8VINE4RZ7X', '1', 'Administrator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_store`
--
ALTER TABLE `comment_store`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `contact_address`
--
ALTER TABLE `contact_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_list`
--
ALTER TABLE `contact_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `design_setup`
--
ALTER TABLE `design_setup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gadgets`
--
ALTER TABLE `gadgets`
  ADD PRIMARY KEY (`gadget_id`);

--
-- Indexes for table `login_attempt`
--
ALTER TABLE `login_attempt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempt_list`
--
ALTER TABLE `login_attempt_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_media` (`media_association_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meta_data`
--
ALTER TABLE `meta_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `misc_setting`
--
ALTER TABLE `misc_setting`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `navigation`
--
ALTER TABLE `navigation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_navigation` (`menu_id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_post` (`post_category`),
  ADD KEY `idx_post_0` (`post_author_id`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `comment_store`
--
ALTER TABLE `comment_store`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `contact_address`
--
ALTER TABLE `contact_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `contact_list`
--
ALTER TABLE `contact_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `design_setup`
--
ALTER TABLE `design_setup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `gadgets`
--
ALTER TABLE `gadgets`
  MODIFY `gadget_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;
--
-- AUTO_INCREMENT for table `login_attempt_list`
--
ALTER TABLE `login_attempt_list`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `meta_data`
--
ALTER TABLE `meta_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `misc_setting`
--
ALTER TABLE `misc_setting`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `navigation`
--
ALTER TABLE `navigation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
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
