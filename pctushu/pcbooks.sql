-- phpMyAdmin SQL Dump
-- version 3.3.7
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 08 月 11 日 17:59
-- 服务器版本: 5.5.40
-- PHP 版本: 5.4.33

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `pcbooks`
--

-- --------------------------------------------------------

--
-- 表的结构 `book_books_category`
--

CREATE TABLE IF NOT EXISTS `book_books_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(45) NOT NULL DEFAULT '',
  `category_sort` tinyint(5) unsigned NOT NULL DEFAULT '0',
  `pid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `pid_path` varchar(20) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `category_name` (`category_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `book_books_category`
--

INSERT INTO `book_books_category` (`id`, `category_name`, `category_sort`, `pid`, `pid_path`) VALUES
(1, '计算机', 0, 0, ',1'),
(2, '财经', 0, 0, ',2'),
(3, '英语', 0, 0, ',3'),
(4, '数学', 0, 0, ',4'),
(5, '医学', 0, 0, ',5'),
(6, '前段开发', 0, 1, '6,1'),
(7, '后台开发', 0, 1, '7,1'),
(8, '移动开发', 0, 1, '8,1'),
(9, 'JavaScript', 0, 6, '9,6,1'),
(10, 'html', 0, 6, '10,6,1'),
(11, 'css', 0, 6, '11,6,1'),
(12, 'jquery', 0, 6, '12,6,1'),
(13, 'php', 0, 7, '13,7,1'),
(14, 'java', 0, 7, '14,7,1'),
(15, 'c语言', 0, 7, '15,7,1'),
(16, 'c++', 0, 7, '16,7,1'),
(17, '会计', 0, 2, '17,2'),
(18, 'ios', 0, 8, '18,8,1');

-- --------------------------------------------------------

--
-- 表的结构 `book_books_content`
--

CREATE TABLE IF NOT EXISTS `book_books_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `acticle_name` varchar(45) NOT NULL DEFAULT '',
  `key_word` varchar(255) NOT NULL DEFAULT '',
  `acticle_content` longtext NOT NULL,
  `add_time` int(10) unsigned NOT NULL DEFAULT '0',
  `books_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `books_id` (`books_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `book_books_content`
--


-- --------------------------------------------------------

--
-- 表的结构 `book_books_list`
--

CREATE TABLE IF NOT EXISTS `book_books_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `books_name` varchar(45) NOT NULL DEFAULT '',
  `books_counts` int(10) unsigned NOT NULL DEFAULT '0',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0',
  `books_face` varchar(60) NOT NULL DEFAULT '',
  `uid` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `books_name` (`books_name`),
  KEY `uid` (`uid`),
  KEY `category_id` (`category_id`),
  FULLTEXT KEY `books_face` (`books_face`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `book_books_list`
--

INSERT INTO `book_books_list` (`id`, `books_name`, `books_counts`, `add_time`, `books_face`, `uid`, `category_id`) VALUES
(1, 'php', 0, 1439012737, '55c6cd0e4c236.jpg', 1, 9),
(2, 'ios', 0, 1439013280, '55c6cd0e4c236.jpg', 1, 8),
(3, 'c++程序设计', 0, 1439014367, '55c6cd0e4c236.jpg', 1, 16),
(4, '离散数学', 0, 1439014451, '55c6cd0e4c236.jpg', 1, 4),
(5, 'larvavel框架', 0, 1439022478, '55c6cd0e4c236.jpg', 1, 13),
(6, '新概念英语', 0, 1439022812, '55c6cd0e4c236.jpg', 7, 3),
(7, 'THINKPHP', 0, 1439049463, '55c6cd0e4c236.jpg', 1, 13),
(8, '高等数学', 0, 1439090838, '55c6cd0e4c236.jpg', 1, 4),
(9, '考研英语', 0, 1439090990, '55c6cd0e4c236.jpg', 1, 3),
(10, 'C语言基础', 0, 1439091229, '55c6cd0e4c236.jpg', 1, 15),
(11, 'android开发', 0, 1439091469, '55c6cd0e4c236.jpg', 1, 8),
(12, '计算机基础', 0, 1439091983, '55c6cd0e4c236.jpg', 1, 8),
(13, 'CSS', 0, 1439093425, '55c6d2b095a82.jpg', 1, 11),
(14, 'git 教程', 0, 1439171276, '55c802cc2480f.jpg', 1, 1),
(15, '会计基础', 0, 1439187288, '55c84157e8189.jpg', 1, 17),
(16, '注册会计（会计）', 0, 1439274836, '55c99753a024e.jpg', 7, 17);

-- --------------------------------------------------------

--
-- 表的结构 `book_content_category`
--

CREATE TABLE IF NOT EXISTS `book_content_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content_category_name` varchar(45) NOT NULL DEFAULT '',
  `pid` tinyint(5) unsigned NOT NULL DEFAULT '0',
  `bid` int(11) NOT NULL,
  `content_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `content_id` (`content_id`),
  KEY `bid` (`bid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `book_content_category`
--

INSERT INTO `book_content_category` (`id`, `content_category_name`, `pid`, `bid`, `content_id`) VALUES
(1, '介绍', 0, 16, 0),
(2, '第一章', 0, 16, 0),
(3, '第二章', 0, 16, 0),
(4, '第三章', 0, 16, 0),
(5, '第四章', 0, 16, 0),
(6, '第五章', 0, 16, 0);

-- --------------------------------------------------------

--
-- 表的结构 `book_follow`
--

CREATE TABLE IF NOT EXISTS `book_follow` (
  `uid` int(10) unsigned NOT NULL,
  `books_id` int(10) unsigned NOT NULL,
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `book_follow`
--


-- --------------------------------------------------------

--
-- 表的结构 `book_user`
--

CREATE TABLE IF NOT EXISTS `book_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL DEFAULT '',
  `passworld` varchar(45) NOT NULL DEFAULT '',
  `name` varchar(45) NOT NULL DEFAULT '',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0',
  `user_face` varchar(60) NOT NULL DEFAULT '',
  `user_work` varchar(30) NOT NULL DEFAULT '',
  `user_experience` int(10) unsigned NOT NULL DEFAULT '0',
  `user_abstract` varchar(150) NOT NULL DEFAULT '',
  `client_id` varchar(45) NOT NULL DEFAULT '',
  `today_visitor` tinyint(5) NOT NULL DEFAULT '0',
  `count_visitor` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `book_user`
--

INSERT INTO `book_user` (`id`, `email`, `passworld`, `name`, `add_time`, `user_face`, `user_work`, `user_experience`, `user_abstract`, `client_id`, `today_visitor`, `count_visitor`) VALUES
(1, 'longjianwei@163.com', '29fd06e62faa920cbe4b9c62018aa064', '龙剑威', 0, '', '', 0, '', '', 0, 0),
(2, 'longjianwei@126.com', '29fd06e62faa920cbe4b9c62018aa064', '龙威', 0, '', '', 0, '', '', 0, 0),
(6, 'longjianwei@hotmail.com3', '38458ad99f11915d7601c42ab5edd4d0', 'long', 1438826268, '', '', 0, '', '0.0.0.0', 0, 0),
(7, '214200196@qq.com', '4297f44b13955235245b2497399d7a93', 'admin', 1438826839, '', '', 0, '', '0.0.0.0', 0, 0),
(8, '13568946@qq.com', '4297f44b13955235245b2497399d7a93', '123123', 1438827055, '', '', 0, '', '0.0.0.0', 0, 0);
