-- phpMyAdmin SQL Dump
-- version 3.3.7
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 08 月 07 日 18:04
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
  PRIMARY KEY (`id`),
  KEY `category_name` (`category_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `book_books_category`
--

INSERT INTO `book_books_category` (`id`, `category_name`, `category_sort`, `pid`) VALUES
(1, '计算机', 0, 0),
(2, '经济学', 0, 0),
(3, '英语', 0, 0),
(4, '数学', 0, 0),
(5, '医学', 0, 0),
(6, '前段开发', 0, 1),
(7, '后台开发', 0, 1),
(8, '移动开发', 0, 1),
(9, 'JavaScript', 0, 6),
(10, 'html', 0, 6),
(11, 'css', 0, 6),
(12, 'jquery', 0, 6),
(13, 'php', 0, 7),
(14, 'java', 0, 7),
(15, 'c语言', 0, 7),
(16, 'c++', 0, 7);

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
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `book_books_list`
--


-- --------------------------------------------------------

--
-- 表的结构 `book_content_category`
--

CREATE TABLE IF NOT EXISTS `book_content_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content_category_name` varchar(45) NOT NULL DEFAULT '',
  `pid` tinyint(5) unsigned NOT NULL DEFAULT '0',
  `content_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `content_id` (`content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `book_content_category`
--


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
(7, '214200196@qq.com', '4297f44b13955235245b2497399d7a93', '123123', 1438826839, '', '', 0, '', '0.0.0.0', 0, 0),
(8, '13568946@qq.com', '4297f44b13955235245b2497399d7a93', '123123', 1438827055, '', '', 0, '', '0.0.0.0', 0, 0);
