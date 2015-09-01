-- phpMyAdmin SQL Dump
-- version 3.3.7
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 08 月 13 日 17:43
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

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
(10, 'Html', 0, 6, '10,6,1'),
(11, 'Css', 0, 6, '11,6,1'),
(12, 'jQuery', 0, 6, '12,6,1'),
(13, 'PHP', 0, 7, '13,7,1'),
(14, 'Java', 0, 7, '14,7,1'),
(15, 'C语言', 0, 7, '15,7,1'),
(16, 'C++', 0, 7, '16,7,1'),
(17, '会计', 0, 2, '17,2'),
(18, 'IOS', 0, 8, '18,8,1'),
(19, '数据处理', 0, 1, '19,1'),
(20, '图像处理', 0, 1, '20,1'),
(21, 'AngularJS', 0, 6, '21,6,1'),
(22, 'Node.js', 0, 6, '22,6,1'),
(23, 'Bootstrap', 0, 6, '23,6,1'),
(24, 'WebApp', 0, 6, '24,6,1'),
(25, '前端工具', 0, 6, '25,6,1'),
(26, 'Linux', 0, 7, '26,7,1'),
(27, 'Python', 0, 7, '27,7,1'),
(28, 'Go', 0, 7, '28,7,1'),
(29, 'Android', 0, 8, '29,8,1'),
(30, 'Cocos2d-x', 0, 8, '30,8,1'),
(31, 'Unity 3D', 0, 8, '31,8,1'),
(32, '算法', 0, 1, '32,1'),
(33, 'MySql', 0, 19, '33,19,1'),
(34, 'MongoDb', 0, 19, '34,19,1'),
(35, 'PhotoShop', 0, 20, '35,20,1'),
(36, 'Maya', 0, 20, '36,20,1'),
(37, '数据结构', 0, 32, '37,32,1'),
(38, '基本算法', 0, 32, '38,32,1'),
(39, 'Git', 0, 7, '39,7,1');

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
  `acticle_click` tinyint(10) unsigned NOT NULL DEFAULT '0',
  `books_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `books_id` (`books_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `book_books_content`
--

INSERT INTO `book_books_content` (`id`, `acticle_name`, `key_word`, `acticle_content`, `add_time`, `acticle_click`, `books_id`) VALUES
(15, '介绍', 'Git，CVS，Subversion', '<p>\r\n	<span style="line-height:24px;">&nbsp;&nbsp;&nbsp;&nbsp;Git --</span><span style="line-height:24px;">- The stupid content tracker, 傻瓜内容跟踪器。Linus Torvalds 是这样给我们介绍 Git 的。</span>\r\n</p>\r\n<p>\r\n	<span style="line-height:2;"><img src="/pctushu/editor/attached/image/20150813/20150813171916_39135.png" alt="" width="186" height="200" title="" align="" /><br />\r\n</span> \r\n</p>\r\n<p>\r\n	<span style="line-height:2;"> </span><span style="line-height:2;"> &nbsp;&nbsp;&nbsp;&nbsp;Git 是用于 Linux</span><a target="_blank" href="http://baike.baidu.com/view/1366.htm"><span style="line-height:2;">内核</span></a><span style="line-height:2;">开发的</span><a target="_blank" href="http://baike.baidu.com/view/183136.htm"><span style="line-height:2;">版本控制</span></a><span style="line-height:2;">工具。与常用的版本控制工具 CVS, Subversion 等不同，它采用了分布式版本库的方式，不必服务器端软件支持（wingeddevil</span><span style="line-height:2;">注：这得分是用什么样的服务端，使用http协议或者git协议等不太一样。并且在push和pull的时候和服务器端还是有交互的。），使</span><a target="_blank" href="http://baike.baidu.com/view/60376.htm"><span style="line-height:2;">源代码</span></a><span style="line-height:2;">的发布和交流极其方便。 Git 的速度很快，这对于诸如 Linux kernel 这样的大项目来说自然很重要。 Git 最为出色的是它的合并跟踪（merge tracing）能力。</span> \r\n</p>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	<span style="line-height:2;"> </span><span style="line-height:2;"> &nbsp;&nbsp;&nbsp;&nbsp;实际上</span><a target="_blank" href="http://baike.baidu.com/view/1366.htm"><span style="line-height:2;">内核</span></a><span style="line-height:2;">开发团队决定开始开发和使用 Git 来作为内核开发的版本控制系统的时候，世界开源社群的反对声音不少，最大的理由是 Git 太艰涩难懂，从 Git 的内部工作机制来说，的确是这样。但是随着开发的深入，Git 的正常使用都由一些友好的脚本命令来执行，使 Git 变得非常好用，即使是用来管理我们自己的开发项目，Git 都是一个友好，有力的工具。现在，越来越多的著名项目采用 Git 来管理项目开发.</span> \r\n</div>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	<span style="line-height:2;"> &nbsp;&nbsp;&nbsp;&nbsp;作为开源自由原教旨主义项目，Git 没有对版本库的浏览和修改做任何的权限限制。</span> \r\n</div>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	<span style="line-height:2;"> </span><span style="line-height:2;"> &nbsp;&nbsp;&nbsp;&nbsp;目前GIT已经可以在windows下使用，主要方法有二：msysgit和Cygwin。Cygwin和Linux使用方法类似，Windows版本的GIT提供了友好的GUI(图形界面)，安装后很快可以上手，不在此做大篇幅介绍。</span> \r\n</div>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	<span style="line-height:2;"> </span><span style="line-height:2;"> &nbsp;&nbsp;&nbsp;&nbsp;本文将以 Git 官方文档 Tutorial， core-tutorial 和 Everyday GIT 作为蓝本翻译整理，但是暂时去掉了对 Git 内部工作机制的阐述，力求简明扼要，并加入了作者使用 Git 的过程中的一些心得体会，注意事项，以及更多的例子。建议你最好通过你所使用的 Unix / Linux 发行版的安装包来安装 Git, 你可以在线浏览本文 ，也可以通过下面的命令来得到本文最新的版本库，并且通过后面的学习用 Git 作为工具参加到本文的创作中来。</span> \r\n</div>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	<span style="line-height:2;"> &nbsp;&nbsp;&nbsp;&nbsp;(Snake.Zero 注：以下假设环境为Unix/Linux，本次修正主要是版本问题，git-add git-init-db等命令都改为了类似git add形式的，以免误导新手。)</span> \r\n</div>', 1439457253, 0, 17),
(14, '特点', 'git，分布式，版本控制，git介绍，git分支', '<div class="para" style="margin:15px 0px 5px;">\r\n	&nbsp;&nbsp;&nbsp;&nbsp;分布式相比于集中式的最大区别在于开发者可以提交到本地，每个开发者通过克隆（git clone），在本地机器上拷贝一个完整的Git仓库。\r\n</div>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	从一般开发者的角度来看，git有以下功能：\r\n</div>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	&nbsp;&nbsp;&nbsp;&nbsp;1、从服务器上克隆完整的Git仓库（包括代码和版本信息）到单机上。\r\n</div>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	&nbsp;&nbsp;&nbsp;&nbsp;2、在自己的机器上根据不同的开发目的，创建分支，修改代码。\r\n</div>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	&nbsp;&nbsp;&nbsp;&nbsp;3、在单机上自己创建的分支上提交代码。\r\n</div>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	&nbsp;&nbsp;&nbsp;&nbsp;4、在单机上合并分支。\r\n</div>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	&nbsp;&nbsp;&nbsp;&nbsp;5、把服务器上最新版的代码fetch下来，然后跟自己的主分支合并。\r\n</div>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	&nbsp;&nbsp;&nbsp;&nbsp;6、生成补丁（patch），把补丁发送给主开发者。\r\n</div>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	&nbsp;&nbsp;&nbsp;&nbsp;7、看主开发者的反馈，如果主开发者发现两个一般开发者之间有冲突（他们之间可以合作解决的冲突），就会要求他们先解决冲突，然后再由其中一个人提交。如果主开发者可以自己解决，或者没有冲突，就通过。\r\n</div>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	&nbsp;&nbsp;&nbsp;&nbsp;8、一般开发者之间解决冲突的方法，开发者之间可以使用pull 命令解决冲突，解决完冲突之后再向主开发者提交补丁。\r\n</div>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	从主开发者的角度（假设主开发者不用开发代码）看，git有以下功能：\r\n</div>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	&nbsp;&nbsp;&nbsp;&nbsp;1、查看邮件或者通过其它方式查看一般开发者的提交状态。\r\n</div>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	&nbsp;&nbsp;&nbsp;&nbsp;2、打上补丁，解决冲突（可以自己解决，也可以要求开发者之间解决以后再重新提交，如果是开源项目，还要决定哪些补丁有用，哪些不用）。\r\n</div>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	&nbsp;&nbsp;&nbsp;&nbsp;3、向公共服务器提交结果，然后通知所有开发人员。\r\n</div>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	优点：\r\n</div>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	&nbsp;&nbsp;&nbsp;&nbsp;适合<a target="_blank" href="http://baike.baidu.com/view/2370062.htm">分布式开发</a>，强调个体。\r\n</div>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	&nbsp;&nbsp;&nbsp;&nbsp;公共服务器压力和数据量都不会太大。\r\n</div>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	&nbsp;&nbsp;&nbsp;&nbsp;速度快、灵活。\r\n</div>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	&nbsp;&nbsp;&nbsp;&nbsp;任意两个开发者之间可以很容易的解决冲突。\r\n</div>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	&nbsp;&nbsp;&nbsp;&nbsp;离线工作。\r\n</div>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	缺点：\r\n</div>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	&nbsp;&nbsp;&nbsp;&nbsp;资料少（起码中文资料很少）。\r\n</div>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	&nbsp;&nbsp;&nbsp;&nbsp;学习周期相对而言比较长。\r\n</div>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	&nbsp;&nbsp;&nbsp;&nbsp;不符合常规思维。\r\n</div>\r\n<div class="para" style="margin:15px 0px 5px;">\r\n	&nbsp;&nbsp;&nbsp;&nbsp;代码保密性差，一旦开发者把整个库克隆下来就可以完全公开所有代码和版本信息。\r\n</div>', 1439454224, 0, 17);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `book_books_list`
--

INSERT INTO `book_books_list` (`id`, `books_name`, `books_counts`, `add_time`, `books_face`, `uid`, `category_id`) VALUES
(17, 'Git 教程', 0, 1439453005, '55cc4f4d63943.png', 1, 39);

-- --------------------------------------------------------

--
-- 表的结构 `book_content_category`
--

CREATE TABLE IF NOT EXISTS `book_content_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content_category_name` varchar(45) NOT NULL DEFAULT '',
  `pid` tinyint(5) unsigned NOT NULL DEFAULT '0',
  `level` smallint(2) unsigned NOT NULL DEFAULT '1',
  `bid` int(11) NOT NULL,
  `content_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `content_id` (`content_id`),
  KEY `bid` (`bid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- 转存表中的数据 `book_content_category`
--

INSERT INTO `book_content_category` (`id`, `content_category_name`, `pid`, `level`, `bid`, `content_id`) VALUES
(46, '工作原理', 0, 1, 17, 0),
(45, '介绍', 43, 2, 17, 15),
(44, '特点', 43, 2, 17, 14),
(43, 'Git 介绍', 0, 1, 17, 0);

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
(1, 'longjianwei@163.com', '29fd06e62faa920cbe4b9c62018aa064', 'longjianwei', 1438826739, '', '', 0, '', '', 0, 0),
(2, '214200196@qq.com', '4297f44b13955235245b2497399d7a93', 'admin', 1438826839, '', '', 0, '', '0.0.0.0', 0, 0);
