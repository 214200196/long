-- phpMyAdmin SQL Dump
-- version 3.3.7
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2012 年 06 月 02 日 04:05
-- 服务器版本: 5.0.90
-- PHP 版本: 5.2.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `q4222`
--

-- --------------------------------------------------------

--
-- 表的结构 `pwn_advs_duilian`
--

CREATE TABLE IF NOT EXISTS `pwn_advs_duilian` (
  `id` int(4) NOT NULL auto_increment,
  `groupname` char(200) NOT NULL,
  `src` char(100) NOT NULL default '',
  `src2` char(100) NOT NULL default '',
  `url` char(200) NOT NULL default '',
  `url2` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `pwn_advs_duilian`
--


-- --------------------------------------------------------

--
-- 表的结构 `pwn_advs_lb`
--

CREATE TABLE IF NOT EXISTS `pwn_advs_lb` (
  `id` int(20) NOT NULL auto_increment,
  `groupid` int(5) NOT NULL default '1',
  `title` char(100) NOT NULL default '',
  `src` char(100) NOT NULL default '',
  `src1` char(255) NOT NULL,
  `url` char(100) NOT NULL default '',
  `xuhao` int(5) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=45 ;

--
-- 转存表中的数据 `pwn_advs_lb`
--


-- --------------------------------------------------------

--
-- 表的结构 `pwn_advs_lbgroup`
--

CREATE TABLE IF NOT EXISTS `pwn_advs_lbgroup` (
  `id` int(3) NOT NULL auto_increment,
  `groupname` varchar(50) NOT NULL default '',
  `xuhao` int(5) NOT NULL default '0',
  `moveable` int(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `pwn_advs_lbgroup`
--

INSERT INTO `pwn_advs_lbgroup` (`id`, `groupname`, `xuhao`, `moveable`) VALUES
(1, '默认轮播广告组', 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_advs_link`
--

CREATE TABLE IF NOT EXISTS `pwn_advs_link` (
  `id` int(12) NOT NULL auto_increment,
  `groupid` int(5) NOT NULL default '0',
  `name` varchar(200) NOT NULL default '',
  `url` varchar(200) NOT NULL default '',
  `xuhao` int(5) NOT NULL default '0',
  `type` varchar(20) NOT NULL default '',
  `src` varchar(100) NOT NULL default '',
  `cl` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- 转存表中的数据 `pwn_advs_link`
--

INSERT INTO `pwn_advs_link` (`id`, `groupid`, `name`, `url`, `xuhao`, `type`, `src`, `cl`) VALUES
(56, 1, '2', 'http://www.baidu.com', 0, '', 'advs/pics/20100105/1262680791.gif', 0),
(57, 1, '2', 'http://www.baidu.com', 0, '', 'advs/pics/20100105/1262680800.gif', 0),
(58, 1, '2', 'http://www.baidu.com', 0, '', 'advs/pics/20100105/1262680854.gif', 0),
(59, 1, '2', 'http://www.baidu.com', 0, '', 'advs/pics/20100106/1262763267.gif', 0),
(60, 1, '2', 'http://www.baidu.com', 0, '', 'advs/pics/20100106/1262763295.gif', 0);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_advs_linkgroup`
--

CREATE TABLE IF NOT EXISTS `pwn_advs_linkgroup` (
  `id` int(3) NOT NULL auto_increment,
  `groupname` varchar(50) NOT NULL default '',
  `xuhao` int(5) NOT NULL default '0',
  `moveable` int(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `pwn_advs_linkgroup`
--

INSERT INTO `pwn_advs_linkgroup` (`id`, `groupname`, `xuhao`, `moveable`) VALUES
(1, '默认友情链接组', 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_advs_logo`
--

CREATE TABLE IF NOT EXISTS `pwn_advs_logo` (
  `id` int(4) NOT NULL auto_increment,
  `groupname` char(200) NOT NULL,
  `src` char(100) NOT NULL default '',
  `url` char(200) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `pwn_advs_logo`
--

INSERT INTO `pwn_advs_logo` (`id`, `groupname`, `src`, `url`) VALUES
(1, '网站标志一', 'advs/pics/20100805/1280978420.jpg', '#');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_advs_movi`
--

CREATE TABLE IF NOT EXISTS `pwn_advs_movi` (
  `id` int(4) NOT NULL auto_increment,
  `groupname` char(200) NOT NULL,
  `src` char(100) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `pwn_advs_movi`
--

INSERT INTO `pwn_advs_movi` (`id`, `groupname`, `src`) VALUES
(1, '视频广告测试一', 'http://vhead.blog.sina.com.cn/player/outer_player.swf?auto=1&vid=16205152&uid=1504617052');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_advs_pic`
--

CREATE TABLE IF NOT EXISTS `pwn_advs_pic` (
  `id` int(4) NOT NULL auto_increment,
  `groupname` char(200) NOT NULL,
  `src` char(100) NOT NULL default '',
  `url` char(200) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `pwn_advs_pic`
--

INSERT INTO `pwn_advs_pic` (`id`, `groupname`, `src`, `url`) VALUES
(1, '测试图片广告', 'advs/pics/20091126/1259213779.gif', 'http://www.try.com');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_advs_pop`
--

CREATE TABLE IF NOT EXISTS `pwn_advs_pop` (
  `id` int(12) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `body` text,
  `ifpop` int(1) NOT NULL default '0',
  `popwidth` int(10) default NULL,
  `popheight` int(10) default NULL,
  `popleft` int(10) default NULL,
  `poptop` int(10) default NULL,
  `poptoolbar` int(1) default NULL,
  `popmenubar` int(1) default NULL,
  `popstatus` int(1) default NULL,
  `poplocation` int(1) default NULL,
  `popscrollbars` varchar(50) default NULL,
  `popresizable` int(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `pwn_advs_pop`
--

INSERT INTO `pwn_advs_pop` (`id`, `title`, `body`, `ifpop`, `popwidth`, `popheight`, `popleft`, `poptop`, `poptoolbar`, `popmenubar`, `popstatus`, `poplocation`, `popscrollbars`, `popresizable`) VALUES
(1, '弹出窗口', '窗口内容 ', 0, 400, 300, 0, 0, 0, 0, 0, 0, 'auto', 0);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_advs_text`
--

CREATE TABLE IF NOT EXISTS `pwn_advs_text` (
  `id` int(4) NOT NULL auto_increment,
  `groupname` char(200) NOT NULL,
  `text` char(200) NOT NULL default '',
  `url` char(200) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `pwn_advs_text`
--

INSERT INTO `pwn_advs_text` (`id`, `groupname`, `text`, `url`) VALUES
(1, '促销广告一', '本季特大优惠活动开始啦qq', 'http://www.com');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_base_admin`
--

CREATE TABLE IF NOT EXISTS `pwn_base_admin` (
  `id` int(6) NOT NULL auto_increment,
  `user` varchar(30) NOT NULL default '',
  `password` varchar(50) NOT NULL default '',
  `name` varchar(50) NOT NULL default '',
  `job` varchar(50) NOT NULL,
  `jobid` varchar(20) NOT NULL,
  `moveable` int(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `pwn_base_admin`
--

INSERT INTO `pwn_base_admin` (`id`, `user`, `password`, `name`, `job`, `jobid`, `moveable`) VALUES
(3, 'admin', '202cb962ac59075b964b07152d234b70', '管理员', '管理员', 'A001', 0);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_base_adminauth`
--

CREATE TABLE IF NOT EXISTS `pwn_base_adminauth` (
  `id` int(6) NOT NULL auto_increment,
  `coltype` varchar(30) NOT NULL,
  `auth` int(5) NOT NULL default '0',
  `name` char(50) NOT NULL default '',
  `intro` char(255) NOT NULL default '',
  `xuhao` int(10) NOT NULL default '0',
  `pid` int(10) NOT NULL default '0',
  `pname` char(20) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=236 ;

--
-- 转存表中的数据 `pwn_base_adminauth`
--

INSERT INTO `pwn_base_adminauth` (`id`, `coltype`, `auth`, `name`, `intro`, `xuhao`, `pid`, `pname`) VALUES
(69, 'advs', 91, '网站标志管理', '', 1, 2, ''),
(17, 'advs', 95, '网站广告管理', '', 5, 2, ''),
(30, 'advs', 96, '友情链接管理', '', 4, 7, ''),
(1, 'base', 1, '网站参数设置', '', 1, 0, ''),
(2, 'base', 2, '修改管理密码', '', 2, 0, ''),
(3, 'base', 3, '管理账户维护', '', 3, 0, ''),
(5, 'base', 5, '网站排版设置', '', 5, 0, ''),
(66, 'base', 6, '模块插件管理', '', 6, 0, ''),
(67, 'base', 7, '软件升级更新', '', 7, 0, ''),
(114, 'job', 225, '应聘表单设置', '', 7, 22, ''),
(113, 'job', 224, '企业人才库查询', '', 4, 22, ''),
(112, 'job', 223, '求职申请处理', '', 3, 22, ''),
(111, 'job', 222, '招聘职位管理', '', 2, 22, ''),
(110, 'job', 221, '招聘职位发布', '', 1, 22, ''),
(6, 'menu', 11, '导航菜单设置', '', 1, 1, ''),
(38, 'news', 120, '文章模块参数设置', '', 0, 12, ''),
(39, 'news', 121, '文章分类', '', 1, 12, ''),
(13, 'news', 122, '文章管理', '', 2, 12, ''),
(12, 'news', 123, '文章专题设置', '', 3, 12, ''),
(40, 'news', 125, '文章发布', '', 5, 12, ''),
(41, 'news', 126, '文章修改', '', 6, 12, ''),
(43, 'page', 301, '网页分组和管理', '', 1, 30, ''),
(27, 'tools', 81, '访问统计系统', '', 1, 7, ''),
(29, 'tools', 82, '投票调查系统', '', 3, 7, ''),
(72, 'base', 8, '管理菜单设置', '', 8, 0, ''),
(87, 'base', 9, '模块安装卸载', '', 9, 0, ''),
(88, 'photo', 150, '图片模块参数设置', '', 0, 15, ''),
(89, 'photo', 151, '图片分类', '', 1, 15, ''),
(90, 'photo', 152, '图片管理', '', 2, 15, ''),
(91, 'photo', 153, '图片专题设置', '', 3, 15, ''),
(92, 'photo', 155, '图片发布', '', 5, 15, ''),
(93, 'photo', 156, '图片修改', '', 6, 15, ''),
(132, 'tools', 83, '图片投票系统', '', 3, 7, ''),
(133, 'tools', 84, 'QQ客服系统', '', 4, 7, ''),
(134, 'tools', 85, '51客服系统', '', 5, 7, ''),
(135, 'tools', 86, '51la统计系统', '', 6, 7, ''),
(136, 'tools', 87, '移动短信留言', '', 7, 7, ''),
(218, 'feedback', 212, '反馈留言管理', '', 3, 21, ''),
(217, 'feedback', 211, '反馈表单设置', '', 1, 21, ''),
(235, 'product', 186, '产品修改', '', 6, 15, ''),
(234, 'product', 185, '产品发布', '', 5, 15, ''),
(233, 'product', 183, '产品专题设置', '', 3, 15, ''),
(232, 'product', 182, '产品管理', '', 2, 15, ''),
(231, 'product', 181, '产品分类', '', 1, 15, ''),
(230, 'product', 180, '产品模块参数设置', '', 0, 15, '');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_base_adminmenu`
--

CREATE TABLE IF NOT EXISTS `pwn_base_adminmenu` (
  `id` int(6) NOT NULL auto_increment,
  `pid` int(6) NOT NULL default '0',
  `menu` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  `xuhao` int(5) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- 转存表中的数据 `pwn_base_adminmenu`
--

INSERT INTO `pwn_base_adminmenu` (`id`, `pid`, `menu`, `url`, `xuhao`) VALUES
(1, 0, '栏目菜单设置', 'menu/admin/menu.php?groupid=1', 1),
(2, 0, '公司简介修改', 'page/admin/page_edit.php?id=1&groupid=1', 3),
(6, 0, '联系方式修改', 'page/admin/page_edit.php?id=64&groupid=22', 6),
(8, 0, '公司产品管理', 'product/admin/product_con.php', 7),
(11, 0, '新闻动态管理', 'news/admin/news_con.php', 8),
(15, 0, '上传网站标志', 'advs/admin/advs_logo_modi.php?id=1', 2),
(18, 0, '荣誉证书管理', 'photo/admin/photo_con.php?pid=8', 11),
(23, 0, '招聘职位管理', 'job/admin/job.php', 17),
(24, 0, '发布招聘职位', 'job/admin/jobadd.php', 19),
(26, 0, '经理致辞修改', 'page/admin/page_edit.php?id=111&groupid=1', 4),
(28, 0, '信息反馈管理', 'feedback/admin/feedback.php', 15);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_base_adminrights`
--

CREATE TABLE IF NOT EXISTS `pwn_base_adminrights` (
  `id` int(50) NOT NULL auto_increment,
  `auth` char(20) default NULL,
  `user` char(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3858 ;

--
-- 转存表中的数据 `pwn_base_adminrights`
--

INSERT INTO `pwn_base_adminrights` (`id`, `auth`, `user`) VALUES
(3857, '230', 'admin'),
(3856, '231', 'admin'),
(3855, '70', 'admin'),
(3854, '70', 'admin'),
(3853, '69', 'admin'),
(3852, '68', 'admin'),
(3851, '67', 'admin'),
(3850, '66', 'admin'),
(3849, '65', 'admin'),
(3848, '64', 'admin'),
(3847, '63', 'admin'),
(3846, '62', 'admin'),
(3845, '61', 'admin'),
(3844, '60', 'admin'),
(3843, '59', 'admin'),
(3842, '58', 'admin'),
(3841, '57', 'admin'),
(3840, '56', 'admin'),
(3839, '55', 'admin'),
(3838, '54', 'admin'),
(3837, '53', 'admin'),
(3836, '52', 'admin'),
(3835, '51', 'admin'),
(3834, '50', 'admin'),
(3833, '180', 'admin'),
(3832, '181', 'admin'),
(3831, '182', 'admin'),
(3830, '183', 'admin'),
(3829, '185', 'admin'),
(3828, '186', 'admin'),
(3827, '211', 'admin'),
(3826, '212', 'admin'),
(3825, '87', 'admin'),
(3824, '86', 'admin'),
(3823, '85', 'admin'),
(3822, '84', 'admin'),
(3821, '83', 'admin'),
(3820, '156', 'admin'),
(3819, '155', 'admin'),
(3818, '153', 'admin'),
(3817, '152', 'admin'),
(3816, '151', 'admin'),
(3815, '150', 'admin'),
(3814, '9', 'admin'),
(3813, '8', 'admin'),
(3812, '82', 'admin'),
(3811, '81', 'admin'),
(3810, '301', 'admin'),
(3809, '126', 'admin'),
(3808, '125', 'admin'),
(3807, '123', 'admin'),
(3806, '122', 'admin'),
(3805, '121', 'admin'),
(3804, '120', 'admin'),
(3803, '11', 'admin'),
(3802, '221', 'admin'),
(3801, '222', 'admin'),
(3800, '223', 'admin'),
(3799, '224', 'admin'),
(3798, '225', 'admin'),
(3797, '7', 'admin'),
(3796, '6', 'admin'),
(3795, '5', 'admin'),
(3794, '3', 'admin'),
(3793, '2', 'admin'),
(3792, '1', 'admin'),
(3791, '96', 'admin'),
(3790, '95', 'admin'),
(3789, '91', 'admin');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_base_border`
--

CREATE TABLE IF NOT EXISTS `pwn_base_border` (
  `id` int(12) NOT NULL auto_increment,
  `bordertype` varchar(10) NOT NULL default 'border',
  `tempid` char(8) NOT NULL default '',
  `tempname` varchar(50) NOT NULL default '边框模板',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=255 ;

--
-- 转存表中的数据 `pwn_base_border`
--

INSERT INTO `pwn_base_border` (`id`, `bordertype`, `tempid`, `tempname`) VALUES
(1, 'border', '001', '可选颜色边框模板'),
(12, 'border', '012', '可选颜色边框模板(浅色调)'),
(15, 'border', '015', '可选颜色边框模板'),
(16, 'border', '016', '可选颜色边框模板'),
(18, 'border', '018', '可选颜色边框模板'),
(41, 'border', '512', '无标题栏圆角边框模版'),
(47, 'lable', '201', '标签切换边框模板,浅蓝简约型'),
(48, 'lable', '051', '可选颜色,标签切换边框模板,带总标题'),
(51, 'lable', '204', '标签切换边框模板,浅灰简约,带总标题栏'),
(63, 'border', '500', '条幅边框,无标题栏，搜索条登录框等专用'),
(85, 'border', '526', '条状背景边框(搜索、当前位置提示条专用)'),
(87, 'border', '613', '创意边框'),
(88, 'border', '614', '创意边框'),
(245, 'border', '784', '新闻动态'),
(252, 'border', '780', '关于我们'),
(241, 'border', '781', '产品展示'),
(242, 'border', '782', '公司简介'),
(247, 'border', '783', '产品分类'),
(215, 'lable', '205', '绿色标签边框'),
(218, 'border', '787', '联系我们'),
(224, 'border', '788', '带背景位置条'),
(249, 'border', '785', '技术支持'),
(238, 'border', '786', '产品搜索'),
(239, 'border', '789', '新闻搜索'),
(253, 'border', '790', '栏目导航'),
(254, 'border', '791', '营销网络');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_base_coltype`
--

CREATE TABLE IF NOT EXISTS `pwn_base_coltype` (
  `id` int(12) NOT NULL auto_increment,
  `coltype` varchar(30) NOT NULL default '',
  `colname` varchar(50) NOT NULL default '',
  `sname` varchar(30) NOT NULL,
  `ifadmin` int(1) NOT NULL default '1',
  `ifchannel` int(1) NOT NULL default '0',
  `ifpubplus` int(1) NOT NULL default '1',
  `moveable` int(1) NOT NULL default '0',
  `installed` int(1) NOT NULL default '1',
  `classtbl` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=208 ;

--
-- 转存表中的数据 `pwn_base_coltype`
--

INSERT INTO `pwn_base_coltype` (`id`, `coltype`, `colname`, `sname`, `ifadmin`, `ifchannel`, `ifpubplus`, `moveable`, `installed`, `classtbl`) VALUES
(1, 'base', '基础模块', '基础', 0, 0, 0, 0, 1, ''),
(2, 'diy', '自定内容', '自定义', 0, 0, 1, 0, 1, ''),
(3, 'menu', '导航菜单', '菜单', 1, 0, 1, 0, 1, ''),
(5, 'index', '首页模块', '首页', 0, 1, 0, 0, 1, ''),
(20, 'page', '网页模块', '网页', 1, 0, 1, 0, 1, ''),
(21, 'news', '文章模块', '文章', 1, 1, 1, 1, 1, '_news_cat'),
(22, 'product', '产品展示', '产品', 1, 1, 1, 1, 1, '_product_cat'),
(26, 'photo', '图片模块', '图片', 1, 1, 1, 1, 1, '_photo_cat'),
(109, 'job', '企业招聘', '招聘', 1, 1, 1, 1, 1, ''),
(97, 'search', '全站搜索', '搜索', 0, 0, 1, 0, 1, ''),
(123, 'advs', '网站广告', '广告', 1, 0, 1, 0, 1, ''),
(122, 'tools', '辅助工具', '工具', 1, 0, 1, 0, 1, ''),
(100, 'effect', '素材特效', '特效', 0, 0, 1, 0, 1, ''),
(121, 'feedback', '留言反馈', '反馈', 1, 1, 1, 1, 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_base_config`
--

CREATE TABLE IF NOT EXISTS `pwn_base_config` (
  `xuhao` int(3) NOT NULL default '0',
  `vname` varchar(50) NOT NULL default '',
  `settype` varchar(30) NOT NULL default 'input',
  `colwidth` varchar(3) NOT NULL default '30',
  `variable` varchar(32) NOT NULL default '',
  `value` text NOT NULL,
  `intro` text NOT NULL,
  PRIMARY KEY  (`variable`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pwn_base_config`
--

INSERT INTO `pwn_base_config` (`xuhao`, `vname`, `settype`, `colwidth`, `variable`, `value`, `intro`) VALUES
(1, '网站名称', 'input', '30', 'SiteName', '农业科技公司0912rm.taobao.com', '用于在网页标题、导航栏处显示'),
(2, '网站网址', 'input', '30', 'SiteHttp', 'http://127.0.0.1/', '网站的实际访问网址,末尾加“/”'),
(4, '服务邮箱', 'input', '30', 'SiteEmail', 'service@mydomain.com', '在发送系统邮件时作为发件人邮件'),
(5, '邮件转发方式', 'ownersys', '1', 'ownersys', '0', 'LINUX/UNIX服务器一般可使用内置邮件系统转发邮件；WINDOWS服务器建议使用外部SMTP邮箱转发，并设置以下SMTP邮箱参数'),
(6, 'SMTP服务器', 'input', '30', 'owner_m_smtp', 'mail.mydomain.com', ''),
(7, 'SMTP邮箱用户', 'input', '30', 'owner_m_user', 'alex@mydomain.com', ''),
(8, 'SMTP邮箱密码', 'input', '30', 'owner_m_pass', '123456', ''),
(5, 'SMTP转发邮箱', 'input', '30', 'owner_m_mail', 'alex@mydomain.com', ''),
(9, 'SMTP身份验证', 'YN', '10', 'owner_m_check', '1', ''),
(10, '是否生成并使用静态HTML网页', 'YN', '10', 'CatchOpen', '0', ''),
(11, 'HTML静态网页更新时间(秒)', 'input', '8', 'CatchTime', '3600', '超过此时间访问静态页面时，重新生成静态页并刷新页面'),
(3, '软件授权用户账号', 'input', '30', 'phpwebUser', '0912rm.taobao.com', '在本软件安装、升级或使用其他服务时所采用的软件授权用户登录帐号'),
(99, '安全校验码', 'code', '30', 'safecode', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_base_pageset`
--

CREATE TABLE IF NOT EXISTS `pwn_base_pageset` (
  `id` int(12) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `coltype` varchar(50) NOT NULL default '',
  `pagename` varchar(50) NOT NULL default '',
  `th` int(5) NOT NULL default '200',
  `ch` int(5) NOT NULL default '500',
  `bh` int(5) NOT NULL default '200',
  `pagetitle` varchar(255) NOT NULL default '',
  `metakey` varchar(255) NOT NULL default '',
  `metacon` text NOT NULL,
  `bgcolor` varchar(100) NOT NULL,
  `bgimage` varchar(100) NOT NULL,
  `bgposition` varchar(20) NOT NULL,
  `bgrepeat` varchar(20) NOT NULL default 'repeat',
  `bgatt` varchar(10) NOT NULL default 'scroll',
  `containwidth` int(5) NOT NULL default '900',
  `containbg` varchar(100) NOT NULL default '#ffffff',
  `containimg` varchar(100) NOT NULL,
  `containmargin` int(2) NOT NULL default '0',
  `containpadding` int(2) NOT NULL default '10',
  `containcenter` char(10) NOT NULL default 'auto',
  `topbg` varchar(100) NOT NULL default 'transparent',
  `topwidth` char(10) NOT NULL default '900',
  `contentbg` varchar(100) NOT NULL default 'transparent',
  `contentwidth` char(10) NOT NULL default '900',
  `contentmargin` int(2) NOT NULL default '10',
  `bottombg` varchar(100) NOT NULL default 'transparent',
  `bottomwidth` char(10) NOT NULL default '900',
  `buildhtml` varchar(12) NOT NULL default '0',
  `xuhao` int(5) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=607 ;

--
-- 转存表中的数据 `pwn_base_pageset`
--

INSERT INTO `pwn_base_pageset` (`id`, `name`, `coltype`, `pagename`, `th`, `ch`, `bh`, `pagetitle`, `metakey`, `metacon`, `bgcolor`, `bgimage`, `bgposition`, `bgrepeat`, `bgatt`, `containwidth`, `containbg`, `containimg`, `containmargin`, `containpadding`, `containcenter`, `topbg`, `topwidth`, `contentbg`, `contentwidth`, `contentmargin`, `bottombg`, `bottomwidth`, `buildhtml`, `xuhao`) VALUES
(126, '友情链接', 'advs', 'link', 204, 436, 221, '', '友情链接', '友情链接', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', '0', 0),
(327, '招聘职位详情', 'job', 'detail', 204, 939, 221, '', '0', '0', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', 'id', 3),
(1, '首页', 'index', 'index', 202, 588, 219, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', 'index', 1),
(208, '文章发布', 'member', 'newsfabu', 292, 760, 42, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', '0', 8),
(209, '文章管理', 'member', 'newsgl', 292, 216, 42, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', '0', 9),
(210, '文章修改', 'member', 'newsmodify', 130, 785, 33, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', '0', 10),
(228, '文章分类', 'member', 'newscat', 292, 216, 42, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', '0', 9),
(2, '文章检索', 'news', 'query', 204, 589, 221, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', 'catid', 2),
(3, '文章正文', 'news', 'detail', 204, 376, 221, '', '0', '0', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', 'id', 3),
(33, '频道首页', 'news', 'main', 204, 539, 221, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', 'index', 0),
(129, '内容页', 'page', 'html', 202, 434, 219, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', 'id', 1),
(16, '全站搜索', 'search', 'search', 204, 930, 221, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', '0', 2),
(247, '会员文章', 'news', 'membernews', 130, 420, 33, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', '0', 12),
(353, '典当检索', 'news', 'querydd', 328, 585, 104, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', 'catid', 2),
(593, '董事长致词', 'page', 'html_words', 202, 434, 219, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', '0', 0),
(592, '产品分类', 'member', 'productcat', 147, 267, 150, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', '0', 9),
(590, '产品发布', 'member', 'productfabu', 164, 435, 152, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', '0', 0),
(591, '产品修改', 'member', 'productmodify', 164, 493, 152, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', '0', 0),
(589, '产品管理', 'member', 'productgl', 162, 267, 150, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', '0', 1),
(588, '会员产品', 'product', 'memberproduct', 164, 290, 152, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', '0', 12),
(289, '图文频道首页', 'photo', 'main', 204, 469, 221, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', 'index', 1),
(290, '图片查询', 'photo', 'query', 204, 469, 221, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', 'catid', 2),
(291, '图片详情', 'photo', 'detail', 204, 436, 221, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', 'id', 3),
(292, '会员图片', 'photo', 'memberphoto', 164, 290, 152, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', '0', 12),
(293, '图片管理', 'member', 'photogl', 162, 267, 150, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', '0', 1),
(294, '图片发布', 'member', 'photofabu', 164, 435, 152, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', '0', 0),
(295, '图片修改', 'member', 'photomodify', 164, 493, 152, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', '0', 0),
(296, '图片分类', 'member', 'photocat', 147, 267, 150, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', '0', 9),
(313, '经营范围', 'page', 'html_honor', 204, 469, 221, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', '0', 0),
(310, '分组首页', 'page', 'html_main', 200, 500, 200, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', '0', 0),
(326, '招聘职位查询', 'job', 'main', 204, 442, 221, '企业招聘', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', 'index', 2),
(312, '公司简介', 'page', 'html_company', 204, 581, 221, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', '0', 0),
(430, '典当正文', 'news', 'detailsrv', 328, 519, 104, '', '0', '0', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', 'id', 4),
(483, '投诉建议', 'page', 'contact_message', 204, 589, 221, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', '0', 0),
(460, '联系我们', 'page', 'contact', 202, 374, 219, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', 'id', 0),
(461, '联系我们', 'page', 'contact_main', 200, 500, 200, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', '0', 0),
(462, '联系方式', 'page', 'contact_contact', 204, 436, 221, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', '0', 0),
(585, '产品频道首页', 'product', 'main', 204, 455, 221, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', 'index', 1),
(586, '产品查询', 'product', 'query', 202, 453, 219, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', 'catid', 2),
(587, '产品详情', 'product', 'detail', 204, 448, 221, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', 'id', 3),
(489, '领导致辞', 'page', 'html_culture', 202, 434, 219, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', '0', 0),
(556, '留言反馈', 'feedback', 'main', 204, 589, 221, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', '0', 1),
(605, '营销网络', 'page', 'contact_sales', 202, 418, 219, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', '0', 0),
(606, '研发中心', 'page', 'html_research', 202, 434, 219, '', '', '', '#003869', 'none', '0% 0%', 'repeat', 'scroll', 1002, 'none transparent scroll repeat 0% 0%', '', 0, 0, 'auto', 'none transparent scroll repeat 0% 0%', '900', '#ffffff', '900', 0, 'url(effect/source/bg/cbg.jpg)', '900', '0', 0);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_base_pagetemp`
--

CREATE TABLE IF NOT EXISTS `pwn_base_pagetemp` (
  `id` int(12) NOT NULL auto_increment,
  `tempname` varchar(50) NOT NULL,
  `bgcolor` varchar(100) NOT NULL,
  `bgimage` varchar(100) NOT NULL,
  `bgposition` varchar(20) NOT NULL,
  `bgrepeat` varchar(20) NOT NULL default 'repeat',
  `bgatt` varchar(10) NOT NULL default 'scroll',
  `containwidth` int(5) NOT NULL default '900',
  `containbg` varchar(100) NOT NULL default '#ffffff',
  `containimg` varchar(100) NOT NULL,
  `containmargin` int(2) NOT NULL default '0',
  `containpadding` int(2) NOT NULL default '10',
  `containcenter` char(10) NOT NULL default 'auto',
  `topbg` varchar(100) NOT NULL default 'transparent',
  `topwidth` char(10) NOT NULL default '900',
  `contentbg` varchar(100) NOT NULL default 'transparent',
  `contentwidth` char(10) NOT NULL default '900',
  `contentmargin` int(2) NOT NULL default '10',
  `bottombg` varchar(100) NOT NULL default 'transparent',
  `bottomwidth` char(10) NOT NULL default '900',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- 转存表中的数据 `pwn_base_pagetemp`
--


-- --------------------------------------------------------

--
-- 表的结构 `pwn_base_plus`
--

CREATE TABLE IF NOT EXISTS `pwn_base_plus` (
  `id` int(12) NOT NULL auto_increment,
  `coltype` varchar(30) NOT NULL,
  `pluslable` varchar(100) default '0',
  `plusname` varchar(50) NOT NULL,
  `plustype` varchar(50) default '0',
  `pluslocat` varchar(50) default '0',
  `tempname` varchar(100) NOT NULL default '0',
  `tempcolor` varchar(2) NOT NULL,
  `showborder` char(20) NOT NULL default '0',
  `bordercolor` varchar(7) NOT NULL default '#dddddd',
  `borderwidth` int(2) NOT NULL default '1',
  `borderstyle` varchar(10) NOT NULL default 'solid',
  `borderlable` varchar(150) NOT NULL,
  `borderroll` varchar(10) NOT NULL,
  `showbar` varchar(10) NOT NULL default 'none',
  `barbg` varchar(10) NOT NULL default '#cccccc',
  `barcolor` varchar(10) NOT NULL default '#ffffff',
  `backgroundcolor` varchar(7) NOT NULL default '#ffffff',
  `morelink` varchar(100) NOT NULL default 'http://',
  `width` int(5) NOT NULL default '100',
  `height` int(5) NOT NULL default '100',
  `top` int(5) NOT NULL default '0',
  `left` int(5) NOT NULL default '0',
  `zindex` int(2) NOT NULL default '99',
  `padding` int(11) NOT NULL default '0',
  `shownums` int(10) NOT NULL default '0',
  `ord` varchar(100) NOT NULL default 'id',
  `sc` varchar(10) NOT NULL default 'desc',
  `showtj` int(5) NOT NULL default '0',
  `cutword` int(20) default '0',
  `target` varchar(30) default '0',
  `catid` int(100) NOT NULL default '0',
  `cutbody` int(5) NOT NULL default '0',
  `picw` int(3) NOT NULL default '100',
  `pich` int(3) NOT NULL default '100',
  `fittype` char(10) NOT NULL default 'fill',
  `title` varchar(100) NOT NULL,
  `body` text,
  `pic` varchar(255) NOT NULL,
  `piclink` char(255) NOT NULL default '-1',
  `attach` varchar(255) NOT NULL,
  `movi` varchar(255) NOT NULL,
  `sourceurl` varchar(30) NOT NULL,
  `word` char(255) NOT NULL,
  `word1` char(255) NOT NULL,
  `word2` char(255) NOT NULL,
  `word3` char(255) NOT NULL default '',
  `word4` char(255) NOT NULL default '',
  `text` text NOT NULL,
  `text1` text NOT NULL,
  `code` text NOT NULL,
  `link` varchar(255) NOT NULL,
  `link1` char(255) NOT NULL default '',
  `link2` char(255) NOT NULL default '',
  `link3` char(255) NOT NULL,
  `link4` char(255) NOT NULL,
  `tags` char(30) NOT NULL,
  `groupid` varchar(20) NOT NULL default '',
  `projid` varchar(20) NOT NULL default '',
  `modno` int(3) NOT NULL default '0',
  `setglobal` int(5) NOT NULL default '0',
  `overflow` varchar(20) NOT NULL default 'hidden',
  `bodyzone` varchar(10) NOT NULL default 'content',
  `display` char(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20604 ;

--
-- 转存表中的数据 `pwn_base_plus`
--

INSERT INTO `pwn_base_plus` (`id`, `coltype`, `pluslable`, `plusname`, `plustype`, `pluslocat`, `tempname`, `tempcolor`, `showborder`, `bordercolor`, `borderwidth`, `borderstyle`, `borderlable`, `borderroll`, `showbar`, `barbg`, `barcolor`, `backgroundcolor`, `morelink`, `width`, `height`, `top`, `left`, `zindex`, `padding`, `shownums`, `ord`, `sc`, `showtj`, `cutword`, `target`, `catid`, `cutbody`, `picw`, `pich`, `fittype`, `title`, `body`, `pic`, `piclink`, `attach`, `movi`, `sourceurl`, `word`, `word1`, `word2`, `word3`, `word4`, `text`, `text1`, `code`, `link`, `link1`, `link2`, `link3`, `link4`, `tags`, `groupid`, `projid`, `modno`, `setglobal`, `overflow`, `bodyzone`, `display`) VALUES
(4072, 'news', 'modMemberNewsQuery', '会员文章检索', 'news', 'membernews', 'tpl_newsquery.htm', '-1', 'K001', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 780, 383, 35, 0, 90, 10, 20, 'id', 'desc', 0, 30, '_self', 0, -1, -1, -1, 'fill', '会员文章', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(4071, 'news', 'modNewsNavPath', '当前位置提示条', 'news', 'membernews', 'tpl_navpath.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 650, 30, 15, 234, 14, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '当前位置', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(4070, 'advs', 'modLogo', '网站标志', 'news', 'membernews', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 308, 64, 21, 17, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(4067, 'menu', 'modBottomMenu', '底部菜单（一级）', 'news', 'membernews', 'tpl_bottommenu_1.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 327, 20, 31, 313, 4, 0, 10, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注栏目', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '', 1, 0, 'hidden', 'bottom', 'block'),
(4066, 'diy', 'modButtomInfo', '底部信息编辑区', 'news', 'membernews', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 67, 0, 10, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(10813, 'menu', 'modBottomMenu', '底部菜单（一级）', 'index', 'index', 'tpl_bottommenu_1.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 24, 122, 0, 5, 0, 10, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注栏目', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '', 1, 0, 'hidden', 'bottom', 'block'),
(4103, 'diy', 'modHeadPic', '头部自定义效果图', 'news', 'membernews', 'tpl_headpic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 900, 286, 129, 0, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20090508/1241762139.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(4115, 'diy', 'modHeadPic', '头部自定义效果图', 'photo', 'memberphoto', 'tpl_headpic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 900, 286, 129, 0, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20090508/1241762139.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(5106, 'menu', 'modMainMenu', '一级导航菜单', 'photo', 'memberphoto', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 950, 35, 96, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(6812, 'search', 'modSearchForm', '全站搜索表单', 'news', 'querytech', 'tpl_searchform_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 221, 32, 47, 741, 4, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '全站搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(6811, 'diy', 'modPic', '图片/FLASH', 'news', 'querytech', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 898, 66, 12, 0, 1, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '图片', '-1 ', 'diy/pics/20091211/1260497184.gif', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 12, 0, 'hidden', 'bottom', 'block'),
(6388, 'news', 'modNewsClassTech', '技术一级分类', 'news', 'querytech', 'tpl_newsclasstech.htm', '-1', 'A779', '#dddddd', 1, 'solid', '', 'click', 'block', '#cccccc', '#fff', '#fff', '-1', 201, 159, 10, 0, 11, 0, -1, 'id', 'desc', 0, -1, '_self', 78, -1, -1, -1, 'fill', '技术分类', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(6381, 'diy', 'modColorZone', '空白色块', 'news', 'querytech', 'tpl_colorzone.htm', '-1', 'A778', '#e10000', 1, 'solid', '', 'click', 'none', '', '', '#e10000', '-1', 685, 50, 14, 215, 9, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(6807, 'effect', 'modSetHomePageCyrano', '设为首页加入收藏', 'news', 'querytech', 'tpl_sethomepage_cyrano.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 218, 38, 0, 663, 8, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '设为首页加入收藏', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(5094, 'menu', 'modMainMenu', '一级导航菜单', 'news', 'membernews', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 950, 35, 96, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(6809, 'diy', 'modPic', '图片/FLASH', 'news', 'querytech', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 190, 46, 26, 23, 12, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '图片', '-1 ', 'diy/pics/20091209/1260348247.gif', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 7, 0, 'hidden', 'bottom', 'block'),
(5122, 'menu', 'modMainMenu', '一级导航菜单', 'page', 'html_main', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 950, 35, 96, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(6390, 'news', 'modNewsNavPathTech', '技术位置提示条', 'news', 'querytech', 'tpl_navpathtech.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 650, 30, 17, 235, 15, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '当前位置', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(15783, 'news', 'modNewsSearchForm', '文章搜索表单', 'news', 'querydd', 'tpl_news_search_dolphin.htm', '-1', 'A781', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 219, 167, 224, 0, 9, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '新闻搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(15782, 'menu', 'modBottomMenu', '底部菜单（一级）', 'news', 'querydd', 'tpl_bottommenu_1.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 327, 20, 29, 471, 4, 0, 10, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注栏目', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '', 1, 0, 'hidden', 'bottom', 'block'),
(15781, 'diy', 'modPic', '图片/FLASH', 'news', 'querydd', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 727, 46, 0, 223, 1, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '图片', '-1 ', 'diy/pics/20100211/1265865269.gif', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 2, 0, 'hidden', 'content', 'block'),
(6389, 'news', 'modNewsQuery', '文章翻页检索', 'news', 'querytech', 'tpl_newsquery.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 676, 169, 71, 221, 13, 0, 20, 'id', 'desc', 0, 30, '_self', 0, -1, -1, -1, 'fill', '文章检索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(20286, 'diy', 'modPic', '图片/FLASH', 'index', 'index', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 241, 0, 0, 1, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20101122/1290404782.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 14, 0, 'hidden', 'content', 'block'),
(6810, 'diy', 'modButtomInfo', '底部信息编辑区', 'news', 'querytech', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 67, 0, 10, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(15780, 'diy', 'modHeadTraFlashCyrano', '自定义透明FLASH', 'news', 'querydd', 'tpl_headtraflash_cyrano.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 950, 188, 138, 0, 8, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100118/1263787860.swf', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(6374, 'diy', 'modText', '多行文字', 'news', 'querytech', 'tpl_text.htm', '-1', 'A783', '#dddddd', 1, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 190, 216, 284, 14, 6, 8, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '联系我们', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '地 址：杭州市莫山路2168号\r\n电 话：0573-98765432\r\n联系人：杨军(经理)\r\n手 机：15887654321\r\n网 址：www.aaaa.com\r\n邮 箱：bos@mail.com\r\n邮 编：300009', '-1', '-1', '', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(6808, 'menu', 'modMainMenu', '一级导航菜单', 'news', 'querytech', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 950, 35, 96, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(6806, 'diy', 'modPic', '图片/FLASH', 'news', 'querytech', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 900, 279, 113, 0, 4, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '图片', '-1 ', 'diy/pics/20091209/1260346089.gif', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 2, 0, 'hidden', 'top', 'block'),
(6805, 'diy', 'modPic', '图片/FLASH', 'news', 'querytech', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 300, 27, 0, 600, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '图片', '-1 ', 'diy/pics/20091209/1260345289.gif', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 4, 0, 'hidden', 'top', 'block'),
(8087, 'diy', 'modMailLogin', '企业邮箱登录接口', 'page', 'html_main', 'tpl_mail_login.htm', '-1', 'A778', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 189, 183, 22, 22, 15, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '企业邮箱登录', '-1 ', '-1', '-1', '-1', '-1', '-1', '企业邮局后缀', '表单用户名名称', '表单密码名称', '表单邮局后缀名称', '-1', '-1', '-1', '-1', 'http://企业邮局登录提交地址/', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(15779, 'diy', 'modButtomInfo', '底部信息编辑区', 'news', 'querydd', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 67, 0, 10, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(15778, 'advs', 'modLogo', '网站标志', 'news', 'querydd', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 181, 42, 21, 7, 5, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(15784, 'news', 'modNewsQueryDD', '茶叶资讯翻页检索', 'news', 'querydd', 'tpl_newsquery_dd.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 650, 500, 83, 260, 90, 0, 20, 'id', 'desc', 0, 30, '_self', 0, -1, -1, -1, 'fill', '茶叶资讯检索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(15776, 'effect', 'modSetHomePageCyrano', '设为首页加入收藏', 'news', 'querydd', 'tpl_sethomepage_cyrano.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 182, 31, 36, 764, 7, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '设为首页加入收藏', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(15777, 'menu', 'modMainMenu', '一级导航菜单', 'news', 'querydd', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 950, 57, 80, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(15774, 'diy', 'modPic', '图片/FLASH', 'news', 'querydd', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 950, 92, 10, 0, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '图片', '-1 ', 'diy/pics/20100114/1263450840.gif', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(6813, 'advs', 'modLogo', '网站标志', 'news', 'querytech', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 308, 64, 21, 17, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(8080, 'diy', 'modMailLogin', '企业邮箱登录接口', 'photo', 'memberphoto', 'tpl_mail_login.htm', '-1', 'A778', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 189, 183, 22, 22, 15, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '企业邮箱登录', '-1 ', '-1', '-1', '-1', '-1', '-1', '企业邮局后缀', '表单用户名名称', '表单密码名称', '表单邮局后缀名称', '-1', '-1', '-1', '-1', 'http://企业邮局登录提交地址/', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(20381, 'news', 'modNewsClass', '文章一级分类', 'news', 'query', 'tpl_newsclass_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 100, 200, 279, 85, 90, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(8069, 'diy', 'modMailLogin', '企业邮箱登录接口', 'news', 'querytech', 'tpl_mail_login.htm', '-1', 'A778', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 189, 183, 22, 22, 15, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '企业邮箱登录', '-1 ', '-1', '-1', '-1', '-1', '-1', '企业邮局后缀', '表单用户名名称', '表单密码名称', '表单邮局后缀名称', '-1', '-1', '-1', '-1', 'http://企业邮局登录提交地址/', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(13053, 'diy', 'modHeadTraFlashCyrano', '自定义透明FLASH', 'news', 'membernews', 'tpl_headtraflash_cyrano.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 950, 219, 132, 0, 12, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100118/1263787860.swf', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(8067, 'diy', 'modMailLogin', '企业邮箱登录接口', 'news', 'membernews', 'tpl_mail_login.htm', '-1', 'A778', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 189, 183, 22, 22, 15, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '企业邮箱登录', '-1 ', '-1', '-1', '-1', '-1', '-1', '企业邮局后缀', '表单用户名名称', '表单密码名称', '表单邮局后缀名称', '-1', '-1', '-1', '-1', 'http://企业邮局登录提交地址/', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(10806, 'advs', 'modLogo', '网站标志', 'index', 'index', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 481, 85, 25, 13, 6, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(10807, 'diy', 'modButtomInfo', '底部信息编辑区', 'index', 'index', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 150, 0, 9, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20395, 'news', 'modNewsContent', '文章正文', 'news', 'detail', 'tpl_newscontent.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 652, 283, 87, 279, 90, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(20394, 'news', 'modNewsNavPath', '当前位置提示条', 'news', 'detail', 'tpl_navpath.htm', '-1', 'A788', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 686, 30, 29, 264, 9, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '当前位置', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(20392, 'menu', 'modMainMenu', '一级导航菜单', 'news', 'detail', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 700, 37, 165, 262, 7, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(18174, 'menu', 'modMainMenu', '一级导航菜单', 'index', 'index', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 700, 37, 165, 262, 11, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(10801, 'diy', 'modPic', '图片/FLASH', 'index', 'index', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 219, 0, 0, 4, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100706/1278393227.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(15795, 'menu', 'modBottomMenu', '底部菜单（一级）', 'news', 'detailsrv', 'tpl_bottommenu_1.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 327, 20, 29, 471, 4, 0, 10, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注栏目', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '', 1, 0, 'hidden', 'bottom', 'block'),
(15796, 'news', 'modNewsSearchForm', '文章搜索表单', 'news', 'detailsrv', 'tpl_news_search_dolphin.htm', '-1', 'A781', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 219, 167, 226, 0, 9, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '新闻搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(15794, 'diy', 'modButtomInfo', '底部信息编辑区', 'news', 'detailsrv', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 67, 0, 10, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(15793, 'diy', 'modHeadTraFlashCyrano', '自定义透明FLASH', 'news', 'detailsrv', 'tpl_headtraflash_cyrano.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 950, 188, 138, 0, 8, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100118/1263787860.swf', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(20379, 'search', 'modSearchForm', '全站搜索表单', 'news', 'query', 'tpl_searchform_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 240, 37, 83, 729, 8, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '全站搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(20378, 'menu', 'modBottomMenu', '底部菜单（一级）', 'news', 'query', 'tpl_bottommenu_1.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 24, 122, 0, 4, 0, 10, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注栏目', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '', 1, 0, 'hidden', 'bottom', 'block'),
(20390, 'diy', 'modPic', '图片/FLASH', 'news', 'detail', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 219, 0, 0, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100706/1278393227.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20391, 'advs', 'modLogo', '网站标志', 'news', 'detail', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 481, 85, 25, 13, 5, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20389, 'diy', 'modButtomInfo', '底部信息编辑区', 'news', 'detail', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 150, 0, 6, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20588, 'photo', 'modPhotoNavPath', '当前位置提示条', 'photo', 'main', 'tpl_navpath.htm', '-1', 'A788', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 686, 30, 29, 264, 10, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '当前位置', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(20589, 'menu', 'modBottomMenu', '底部菜单（一级）', 'photo', 'main', 'tpl_bottommenu_1.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 24, 122, 0, 4, 0, 10, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注栏目', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '', 1, 0, 'hidden', 'bottom', 'block'),
(20590, 'search', 'modSearchForm', '全站搜索表单', 'photo', 'main', 'tpl_searchform_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 240, 37, 83, 729, 8, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '全站搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(20503, 'menu', 'modBottomMenu', '底部菜单（一级）', 'page', 'contact_sales', 'tpl_bottommenu_1.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 24, 122, 0, 4, 0, 10, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注栏目', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '', 1, 0, 'hidden', 'bottom', 'block'),
(20504, 'page', 'modPageNavPath', '当前位置提示条', 'page', 'contact_sales', 'tpl_navpath.htm', '-1', 'A788', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 686, 30, 29, 264, 10, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '当前位置', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(20505, 'page', 'modPageContent', '网页内容详情', 'page', 'contact_sales', 'tpl_page_content.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 652, 331, 87, 279, 9, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '内容标题', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(20369, 'page', 'modPageNavPath', '当前位置提示条', 'page', 'html', 'tpl_navpath.htm', '-1', 'A788', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 686, 30, 29, 264, 10, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '当前位置', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(20368, 'search', 'modSearchForm', '全站搜索表单', 'page', 'html', 'tpl_searchform_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 240, 37, 83, 729, 8, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '全站搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(13067, 'diy', 'modHeadTraFlashCyrano', '自定义透明FLASH', 'photo', 'memberphoto', 'tpl_headtraflash_cyrano.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 950, 219, 132, 0, 12, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100118/1263787860.swf', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(13073, 'diy', 'modHeadTraFlashCyrano', '自定义透明FLASH', 'page', 'html_main', 'tpl_headtraflash_cyrano.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 950, 219, 132, 0, 12, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100118/1263787860.swf', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(15792, 'diy', 'modPic', '图片/FLASH', 'news', 'detailsrv', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 727, 46, 0, 223, 1, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '图片', '-1 ', 'diy/pics/20100211/1265865269.gif', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 2, 0, 'hidden', 'content', 'block'),
(13082, 'diy', 'modHeadTraFlashCyrano', '自定义透明FLASH', 'page', 'contact_main', 'tpl_headtraflash_cyrano.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 950, 219, 132, 0, 12, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100118/1263787860.swf', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(20494, 'feedback', 'modFeedBackSmallForm', '全站留言表单', 'page', 'contact_message', 'tpl_feedback_smallform.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 652, 500, 87, 279, 90, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'visible', 'content', 'block'),
(20482, 'page', 'modPageNavPath', '当前位置提示条', 'page', 'contact_contact', 'tpl_navpath.htm', '-1', 'A788', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 686, 30, 29, 264, 10, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '当前位置', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(20480, 'menu', 'modBottomMenu', '底部菜单（一级）', 'page', 'contact_contact', 'tpl_bottommenu_1.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 24, 122, 0, 4, 0, 10, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注栏目', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '', 1, 0, 'hidden', 'bottom', 'block'),
(20481, 'search', 'modSearchForm', '全站搜索表单', 'page', 'contact_contact', 'tpl_searchform_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 240, 37, 83, 729, 8, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '全站搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(20601, 'menu', 'modBottomMenu', '底部菜单（一级）', 'photo', 'query', 'tpl_bottommenu_1.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 24, 122, 0, 4, 0, 10, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注栏目', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '', 1, 0, 'hidden', 'bottom', 'block'),
(20602, 'search', 'modSearchForm', '全站搜索表单', 'photo', 'query', 'tpl_searchform_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 240, 37, 83, 729, 8, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '全站搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(20364, 'diy', 'modButtomInfo', '底部信息编辑区', 'page', 'html', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 150, 0, 6, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20365, 'diy', 'modPic', '图片/FLASH', 'page', 'html', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', 'http://', 1002, 241, 0, 0, 1, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20101122/1290415246.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 12, 0, 'hidden', 'content', 'block'),
(20366, 'diy', 'modPic', '图片/FLASH', 'page', 'html', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 202, 0, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100623/1277259339.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 11, 0, 'hidden', 'top', 'block'),
(20367, 'menu', 'modBottomMenu', '底部菜单（一级）', 'page', 'html', 'tpl_bottommenu_1.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 24, 122, 0, 4, 0, 10, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注栏目', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '', 1, 0, 'hidden', 'bottom', 'block'),
(20377, 'diy', 'modPic', '图片/FLASH', 'news', 'query', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 202, 0, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100623/1277259339.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 11, 0, 'hidden', 'top', 'block'),
(20376, 'diy', 'modPic', '图片/FLASH', 'news', 'query', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', 'http://', 1002, 241, 0, 0, 1, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20101122/1290415246.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 12, 0, 'hidden', 'content', 'block'),
(20375, 'diy', 'modButtomInfo', '底部信息编辑区', 'news', 'query', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 150, 0, 6, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20374, 'diy', 'modPic', '图片/FLASH', 'news', 'query', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 219, 0, 0, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100706/1278393227.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20372, 'advs', 'modLogo', '网站标志', 'news', 'query', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 481, 85, 25, 13, 5, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20373, 'menu', 'modMainMenu', '一级导航菜单', 'news', 'query', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 700, 37, 165, 262, 7, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20363, 'diy', 'modPic', '图片/FLASH', 'page', 'html', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 219, 0, 0, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100706/1278393227.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20382, 'news', 'modNewsQuery', '文章翻页检索', 'news', 'query', 'tpl_newsquery.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 652, 500, 87, 279, 90, 0, 10, 'id', 'desc', 0, 30, '_self', 0, -1, -1, -1, 'fill', '文章检索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(20383, 'news', 'modNewsNavPath', '当前位置提示条', 'news', 'query', 'tpl_navpath.htm', '-1', 'A788', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 686, 30, 29, 264, 90, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '当前位置', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(20388, 'diy', 'modPic', '图片/FLASH', 'news', 'detail', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', 'http://', 1002, 241, 0, 0, 1, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20101122/1290415246.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 12, 0, 'hidden', 'content', 'block'),
(20387, 'diy', 'modPic', '图片/FLASH', 'news', 'detail', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 202, 0, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100623/1277259339.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 11, 0, 'hidden', 'top', 'block'),
(20386, 'menu', 'modBottomMenu', '底部菜单（一级）', 'news', 'detail', 'tpl_bottommenu_1.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 24, 122, 0, 4, 0, 10, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注栏目', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '', 1, 0, 'hidden', 'bottom', 'block'),
(20385, 'search', 'modSearchForm', '全站搜索表单', 'news', 'detail', 'tpl_searchform_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 240, 37, 83, 729, 8, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '全站搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(20384, 'news', 'modNewsClass', '文章一级分类', 'news', 'detail', 'tpl_newsclass_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 100, 95, 279, 85, 10, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(15797, 'news', 'modNewsContentSrv', '茶叶资讯正文', 'news', 'detailsrv', 'tpl_newscontent_srv.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 650, 434, 83, 260, 90, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '茶叶资讯正文', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(15791, 'advs', 'modLogo', '网站标志', 'news', 'detailsrv', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 181, 42, 21, 7, 5, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20491, 'menu', 'modBottomMenu', '底部菜单（一级）', 'page', 'contact_message', 'tpl_bottommenu_1.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 24, 122, 0, 4, 0, 10, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注栏目', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '', 1, 0, 'hidden', 'bottom', 'block'),
(20492, 'page', 'modPageNavPath', '当前位置提示条', 'page', 'contact_message', 'tpl_navpath.htm', '-1', 'A788', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 686, 30, 29, 264, 10, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '当前位置', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(20489, 'diy', 'modPic', '图片/FLASH', 'page', 'contact_message', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', 'http://', 1002, 241, 0, 0, 1, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20101122/1290415246.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 12, 0, 'hidden', 'content', 'block'),
(20490, 'search', 'modSearchForm', '全站搜索表单', 'page', 'contact_message', 'tpl_searchform_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 240, 37, 83, 729, 8, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '全站搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(18180, 'news', 'modNewsList', '文章列表', 'index', 'index', 'tpl_newslist_time_1.htm', '-1', 'A784', '', 0, 'solid', '', 'click', 'none', '', '', '', '{#RP#}news/class/?86.html', 333, 160, 420, 258, 7, 0, 5, 'id', 'desc', 0, 22, '_self', 86, 50, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', '0', 14, 0, 'hidden', 'content', 'block'),
(18185, 'product', 'modProductList', '自选产品列表', 'index', 'index', 'tpl_productlist_roll.htm', '-1', 'A781', '', 0, 'solid', '', 'click', 'none', '', '', '', '{#RP#}product/class/', 706, 170, 224, 258, 12, 0, 6, 'id', 'desc', 0, 12, '_self', 0, 30, 130, 98, 'auto', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', '0', 1, 0, 'hidden', 'content', 'block'),
(19014, 'diy', 'modPic', '图片/FLASH', 'index', 'index', 'tpl_pic.htm', '-1', 'A791', '', 0, 'solid', '', 'click', 'none', '', '', '', '{#RP#}page/contact/sales.php', 187, 185, 28, 777, 10, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100706/1278382316.jpg', '{#RP#}page/contact/sales.php', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 12, 0, 'hidden', 'content', 'block'),
(15772, 'news', 'modNewsNavPath', '当前位置提示条', 'news', 'querydd', 'tpl_navpath.htm', '-1', 'A782', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 673, 30, 25, 251, 10, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '当前位置', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(20587, 'diy', 'modPic', '图片/FLASH', 'photo', 'main', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', 'http://', 1002, 241, 0, 0, 1, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20101122/1290415246.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 12, 0, 'hidden', 'content', 'block'),
(20586, 'diy', 'modPic', '图片/FLASH', 'photo', 'main', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 202, 0, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100623/1277259339.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 11, 0, 'hidden', 'top', 'block'),
(20584, 'diy', 'modPic', '图片/FLASH', 'photo', 'main', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 219, 0, 0, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100706/1278393227.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block');
INSERT INTO `pwn_base_plus` (`id`, `coltype`, `pluslable`, `plusname`, `plustype`, `pluslocat`, `tempname`, `tempcolor`, `showborder`, `bordercolor`, `borderwidth`, `borderstyle`, `borderlable`, `borderroll`, `showbar`, `barbg`, `barcolor`, `backgroundcolor`, `morelink`, `width`, `height`, `top`, `left`, `zindex`, `padding`, `shownums`, `ord`, `sc`, `showtj`, `cutword`, `target`, `catid`, `cutbody`, `picw`, `pich`, `fittype`, `title`, `body`, `pic`, `piclink`, `attach`, `movi`, `sourceurl`, `word`, `word1`, `word2`, `word3`, `word4`, `text`, `text1`, `code`, `link`, `link1`, `link2`, `link3`, `link4`, `tags`, `groupid`, `projid`, `modno`, `setglobal`, `overflow`, `bodyzone`, `display`) VALUES
(20585, 'diy', 'modButtomInfo', '底部信息编辑区', 'photo', 'main', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 150, 0, 6, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20600, 'photo', 'modPhotoNavPath', '当前位置提示条', 'photo', 'query', 'tpl_navpath.htm', '-1', 'A788', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 686, 30, 29, 264, 10, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '当前位置', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(20599, 'diy', 'modPic', '图片/FLASH', 'photo', 'query', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', 'http://', 1002, 241, 0, 0, 1, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20101122/1290415246.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 12, 0, 'hidden', 'content', 'block'),
(20598, 'diy', 'modPic', '图片/FLASH', 'photo', 'query', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 202, 0, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100623/1277259339.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 11, 0, 'hidden', 'top', 'block'),
(20596, 'diy', 'modPic', '图片/FLASH', 'photo', 'query', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 219, 0, 0, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100706/1278393227.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20597, 'diy', 'modButtomInfo', '底部信息编辑区', 'photo', 'query', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 150, 0, 6, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20345, 'menu', 'modBottomMenu', '底部菜单（一级）', 'page', 'html_culture', 'tpl_bottommenu_1.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 24, 122, 0, 4, 0, 10, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注栏目', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '', 1, 0, 'hidden', 'bottom', 'block'),
(20346, 'search', 'modSearchForm', '全站搜索表单', 'page', 'html_culture', 'tpl_searchform_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 240, 37, 83, 729, 8, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '全站搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(20347, 'page', 'modPageNavPath', '当前位置提示条', 'page', 'html_culture', 'tpl_navpath.htm', '-1', 'A788', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 686, 30, 29, 264, 10, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '当前位置', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(20336, 'photo', 'modPhotoGlobalQuery', '全站翻页图片列表', 'page', 'html_honor', 'tpl_photo_query.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 680, 380, 87, 279, 90, 0, 10, 'id', 'desc', 0, 12, '_self', 0, -1, 150, 110, 'auto', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', '0', 1, 0, 'visible', 'content', 'block'),
(20333, 'menu', 'modBottomMenu', '底部菜单（一级）', 'page', 'html_honor', 'tpl_bottommenu_1.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 24, 122, 0, 4, 0, 10, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注栏目', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '', 1, 0, 'hidden', 'bottom', 'block'),
(20334, 'search', 'modSearchForm', '全站搜索表单', 'page', 'html_honor', 'tpl_searchform_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 240, 37, 83, 729, 8, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '全站搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(20335, 'page', 'modPageNavPath', '当前位置提示条', 'page', 'html_honor', 'tpl_navpath.htm', '-1', 'A788', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 686, 30, 29, 264, 10, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '当前位置', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(20332, 'diy', 'modPic', '图片/FLASH', 'page', 'html_honor', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 202, 0, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100623/1277259339.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 11, 0, 'hidden', 'top', 'block'),
(20331, 'diy', 'modPic', '图片/FLASH', 'page', 'html_honor', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', 'http://', 1002, 241, 0, 0, 1, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20101122/1290415246.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 12, 0, 'hidden', 'content', 'block'),
(18569, 'diy', 'modEdit', 'HTML编辑区', 'index', 'index', 'tpl_edit.htm', '-1', 'A782', '#dddddd', 1, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '{#RP#}page/html/company.php', 474, 190, 28, 258, 8, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '<div style="PADDING-TOP: 14px"><img style="PADDING-RIGHT: 22px; FLOAT: left" border=0 alt="" src="[ROOTPATH]index/pics/20100805/201008051281000039640.jpg" /><span style="PADDING-LEFT: 3px; FONT: 12px/22px simsun; COLOR: #505050; PADDING-TOP: 0px">&nbsp;&nbsp;&nbsp;杭州某某农业科技开发有限公司始创于1992年，是一家集科研、生产、销售、技术服务于一体的规模化专业型农业科技公司。公司本着“科技为民所用”的原则，致力于农业科技成果的转化和推广，在研发具有自主知识产权产品的同时，以亚洲为中心，积极引进和筛选来自世界各地的优质产品资源。目前，公司拥有子公司四个，经营着大田作物种子、蔬菜种子和</span></div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 3, 0, 'hidden', 'content', 'block'),
(20478, 'diy', 'modPic', '图片/FLASH', 'page', 'contact_contact', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', 'http://', 1002, 241, 0, 0, 1, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20101122/1290415246.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 12, 0, 'hidden', 'content', 'block'),
(20479, 'diy', 'modPic', '图片/FLASH', 'page', 'contact_contact', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 202, 0, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100623/1277259339.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 11, 0, 'hidden', 'top', 'block'),
(20477, 'diy', 'modButtomInfo', '底部信息编辑区', 'page', 'contact_contact', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 150, 0, 6, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(15789, 'effect', 'modSetHomePageCyrano', '设为首页加入收藏', 'news', 'detailsrv', 'tpl_sethomepage_cyrano.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 182, 31, 36, 764, 7, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '设为首页加入收藏', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(15788, 'menu', 'modMainMenu', '一级导航菜单', 'news', 'detailsrv', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 950, 57, 80, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(15787, 'diy', 'modPic', '图片/FLASH', 'news', 'detailsrv', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 950, 92, 10, 0, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '图片', '-1 ', 'diy/pics/20100114/1263450840.gif', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(15786, 'news', 'modNewsNavPath', '当前位置提示条', 'news', 'detailsrv', 'tpl_navpath.htm', '-1', 'A782', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 673, 30, 25, 251, 10, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '当前位置', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(15785, 'news', 'modNewsClassDD', '茶叶资讯一级分类', 'news', 'detailsrv', 'tpl_newsclass_dd.htm', '-1', 'A781', '#dddddd', 1, 'solid', '', 'click', 'block', '#cccccc', '#fff', '#fff', '-1', 219, 214, 0, 0, 11, 0, -1, 'id', 'desc', 0, -1, '_self', 95, -1, -1, -1, 'fill', '栏目导航', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(20488, 'diy', 'modButtomInfo', '底部信息编辑区', 'page', 'contact_message', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 150, 0, 6, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20516, 'page', 'modPageContent', '网页内容详情', 'page', 'contact', 'tpl_page_content.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 652, 260, 87, 279, 9, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '内容标题', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(20514, 'menu', 'modBottomMenu', '底部菜单（一级）', 'page', 'contact', 'tpl_bottommenu_1.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 24, 122, 0, 4, 0, 10, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注栏目', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '', 1, 0, 'hidden', 'bottom', 'block'),
(20515, 'page', 'modPageNavPath', '当前位置提示条', 'page', 'contact', 'tpl_navpath.htm', '-1', 'A788', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 686, 30, 29, 264, 10, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '当前位置', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(20513, 'search', 'modSearchForm', '全站搜索表单', 'page', 'contact', 'tpl_searchform_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 240, 37, 83, 729, 8, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '全站搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(20512, 'diy', 'modPic', '图片/FLASH', 'page', 'contact', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', 'http://', 1002, 241, 0, 0, 1, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20101122/1290415246.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 12, 0, 'hidden', 'content', 'block'),
(20511, 'diy', 'modButtomInfo', '底部信息编辑区', 'page', 'contact', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 150, 0, 6, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20566, 'search', 'modSearchNavPath', '当前位置提示条', 'search', 'search', 'tpl_navpath.htm', '-1', 'A788', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 686, 30, 29, 264, 90, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '当前位置', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(20563, 'search', 'modSearchForm', '全站搜索表单', 'search', 'search', 'tpl_searchform_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 240, 37, 83, 729, 8, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '全站搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(20562, 'menu', 'modBottomMenu', '底部菜单（一级）', 'search', 'search', 'tpl_bottommenu_1.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 24, 122, 0, 4, 0, 10, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注栏目', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '', 1, 0, 'hidden', 'bottom', 'block'),
(20361, 'advs', 'modLogo', '网站标志', 'page', 'html', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 481, 85, 25, 13, 5, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20362, 'menu', 'modMainMenu', '一级导航菜单', 'page', 'html', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 700, 37, 165, 262, 7, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20360, 'page', 'modPageTitleMenu', '网页标题(菜单)', 'page', 'html', 'tpl_page_menu_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 100, 155, 279, 85, 11, 0, 10, 'id', 'desc', 0, 12, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'visible', 'content', 'block'),
(20359, 'page', 'modPageContent', '网页内容详情', 'page', 'html', 'tpl_page_content.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 652, 340, 87, 279, 9, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '内容标题', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(15773, 'news', 'modNewsClassDD', '茶叶资讯一级分类', 'news', 'querydd', 'tpl_newsclass_dd.htm', '-1', 'A781', '#dddddd', 1, 'solid', '', 'click', 'block', '#cccccc', '#fff', '#fff', '-1', 219, 214, 0, 0, 12, 0, -1, 'id', 'desc', 0, -1, '_self', 95, -1, -1, -1, 'fill', '栏目导航', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(20502, 'search', 'modSearchForm', '全站搜索表单', 'page', 'contact_sales', 'tpl_searchform_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 240, 37, 83, 729, 8, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '全站搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(20501, 'diy', 'modPic', '图片/FLASH', 'page', 'contact_sales', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', 'http://', 1002, 241, 0, 0, 1, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20101122/1290415246.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 12, 0, 'hidden', 'content', 'block'),
(20500, 'diy', 'modButtomInfo', '底部信息编辑区', 'page', 'contact_sales', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 150, 0, 6, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20499, 'diy', 'modPic', '图片/FLASH', 'page', 'contact_sales', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 202, 0, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100623/1277259339.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 11, 0, 'hidden', 'top', 'block'),
(20312, 'page', 'modPageContent', '网页内容详情', 'page', 'html_company', 'tpl_page_content.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 652, 340, 87, 279, 9, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '内容标题', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(20406, 'news', 'modNewsNavPath', '当前位置提示条', 'news', 'main', 'tpl_navpath.htm', '-1', 'A788', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 686, 30, 29, 264, 9, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '当前位置', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(20407, 'news', 'modNewsGlobalQuery', '全站翻页文章列表', 'news', 'main', 'tpl_newsquery.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 652, 450, 87, 279, 90, 0, 10, 'id', 'desc', 0, 30, '_self', 0, 50, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', '0', 1, 0, 'visible', 'content', 'block'),
(20404, 'menu', 'modMainMenu', '一级导航菜单', 'news', 'main', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 700, 37, 165, 262, 7, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20403, 'advs', 'modLogo', '网站标志', 'news', 'main', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 481, 85, 25, 13, 5, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20402, 'diy', 'modPic', '图片/FLASH', 'news', 'main', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 219, 0, 0, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100706/1278393227.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20401, 'diy', 'modButtomInfo', '底部信息编辑区', 'news', 'main', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 150, 0, 6, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20400, 'diy', 'modPic', '图片/FLASH', 'news', 'main', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', 'http://', 1002, 241, 0, 0, 1, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20101122/1290415246.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 12, 0, 'hidden', 'content', 'block'),
(20399, 'diy', 'modPic', '图片/FLASH', 'news', 'main', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 202, 0, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100623/1277259339.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 11, 0, 'hidden', 'top', 'block'),
(20330, 'diy', 'modButtomInfo', '底部信息编辑区', 'page', 'html_honor', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 150, 0, 6, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20329, 'diy', 'modPic', '图片/FLASH', 'page', 'html_honor', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 219, 0, 0, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100706/1278393227.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20327, 'advs', 'modLogo', '网站标志', 'page', 'html_honor', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 481, 85, 25, 13, 5, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20328, 'menu', 'modMainMenu', '一级导航菜单', 'page', 'html_honor', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 700, 37, 165, 262, 7, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20326, 'page', 'modPageTitleMenu', '网页标题(菜单)', 'page', 'html_honor', 'tpl_page_menu_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 100, 155, 279, 85, 11, 0, 10, 'id', 'desc', 0, 12, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'visible', 'content', 'block'),
(20576, 'search', 'modSearchForm', '全站搜索表单', 'photo', 'detail', 'tpl_searchform_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 240, 37, 83, 729, 8, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '全站搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(20579, 'photo', 'modPhotoNavPath', '当前位置提示条', 'photo', 'detail', 'tpl_navpath.htm', '-1', 'A788', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 686, 30, 29, 264, 90, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '当前位置', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(20575, 'menu', 'modBottomMenu', '底部菜单（一级）', 'photo', 'detail', 'tpl_bottommenu_1.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 24, 122, 0, 4, 0, 10, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注栏目', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '', 1, 0, 'hidden', 'bottom', 'block'),
(20561, 'diy', 'modPic', '图片/FLASH', 'search', 'search', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 202, 0, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100623/1277259339.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 11, 0, 'hidden', 'top', 'block'),
(20559, 'diy', 'modButtomInfo', '底部信息编辑区', 'search', 'search', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 150, 0, 6, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20560, 'diy', 'modPic', '图片/FLASH', 'search', 'search', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', 'http://', 1002, 241, 0, 0, 1, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20101122/1290415246.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 12, 0, 'hidden', 'content', 'block'),
(20322, 'menu', 'modBottomMenu', '底部菜单（一级）', 'page', 'html_words', 'tpl_bottommenu_1.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 24, 122, 0, 4, 0, 10, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注栏目', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '', 1, 0, 'hidden', 'bottom', 'block'),
(20323, 'search', 'modSearchForm', '全站搜索表单', 'page', 'html_words', 'tpl_searchform_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 240, 37, 83, 729, 8, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '全站搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(20324, 'page', 'modPageNavPath', '当前位置提示条', 'page', 'html_words', 'tpl_navpath.htm', '-1', 'A788', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 686, 30, 29, 264, 10, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '当前位置', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(20321, 'diy', 'modPic', '图片/FLASH', 'page', 'html_words', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 202, 0, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100623/1277259339.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 11, 0, 'hidden', 'top', 'block'),
(20320, 'diy', 'modPic', '图片/FLASH', 'page', 'html_words', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', 'http://', 1002, 241, 0, 0, 1, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20101122/1290415246.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 12, 0, 'hidden', 'content', 'block'),
(20319, 'diy', 'modButtomInfo', '底部信息编辑区', 'page', 'html_words', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 150, 0, 6, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20318, 'diy', 'modPic', '图片/FLASH', 'page', 'html_words', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 219, 0, 0, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100706/1278393227.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20316, 'advs', 'modLogo', '网站标志', 'page', 'html_words', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 481, 85, 25, 13, 5, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20317, 'menu', 'modMainMenu', '一级导航菜单', 'page', 'html_words', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 700, 37, 165, 262, 7, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20432, 'product', 'modProductClass', '产品分类（列表）', 'product', 'detail', 'tpl_productclass_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 100, 125, 279, 85, 10, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(20430, 'diy', 'modPic', '图片/FLASH', 'product', 'detail', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 202, 0, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100623/1277259339.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 11, 0, 'hidden', 'top', 'block'),
(20431, 'search', 'modSearchForm', '全站搜索表单', 'product', 'detail', 'tpl_searchform_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 240, 37, 83, 729, 8, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '全站搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(20429, 'menu', 'modBottomMenu', '底部菜单（一级）', 'product', 'detail', 'tpl_bottommenu_1.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 24, 122, 0, 4, 0, 10, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注栏目', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '', 1, 0, 'hidden', 'bottom', 'block'),
(20287, 'diy', 'modPic', '图片/FLASH', 'index', 'index', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', 'http://', 199, 72, 429, 20, 15, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20101122/1290410418.jpg', '{#RP#}page/contact/contact.php', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 15, 0, 'hidden', 'content', 'block'),
(20458, 'job', 'modJobQuery', '职位翻页检索', 'job', 'main', 'tpl_jobquery.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 652, 353, 87, 279, 90, 0, 10, 'id', 'desc', 0, 30, '_self', 0, 100, -1, -1, 'fill', '职位查询', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(20455, 'search', 'modSearchForm', '全站搜索表单', 'job', 'main', 'tpl_searchform_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 240, 37, 83, 729, 8, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '全站搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(20454, 'menu', 'modBottomMenu', '底部菜单（一级）', 'job', 'main', 'tpl_bottommenu_1.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 24, 122, 0, 4, 0, 10, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注栏目', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '', 1, 0, 'hidden', 'bottom', 'block'),
(20453, 'diy', 'modPic', '图片/FLASH', 'job', 'main', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 202, 0, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100623/1277259339.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 11, 0, 'hidden', 'top', 'block'),
(20452, 'diy', 'modPic', '图片/FLASH', 'job', 'main', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', 'http://', 1002, 241, 0, 0, 1, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20101122/1290415246.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 12, 0, 'hidden', 'content', 'block'),
(20476, 'diy', 'modPic', '图片/FLASH', 'page', 'contact_contact', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 219, 0, 0, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100706/1278393227.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20474, 'advs', 'modLogo', '网站标志', 'page', 'contact_contact', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 481, 85, 25, 13, 5, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20475, 'menu', 'modMainMenu', '一级导航菜单', 'page', 'contact_contact', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 700, 37, 165, 262, 7, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20473, 'page', 'modPageTitleMenu', '网页标题(菜单)', 'page', 'contact_contact', 'tpl_page_menu_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 100, 155, 279, 85, 11, 0, 10, 'id', 'desc', 0, 12, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '22', '', 1, 0, 'visible', 'content', 'block'),
(20472, 'page', 'modPageContent', '网页内容详情', 'page', 'contact_contact', 'tpl_page_content.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 652, 260, 87, 279, 9, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '内容标题', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(20428, 'diy', 'modPic', '图片/FLASH', 'product', 'detail', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', 'http://', 1002, 241, 0, 0, 1, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20101122/1290415246.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 12, 0, 'hidden', 'content', 'block'),
(20487, 'diy', 'modPic', '图片/FLASH', 'page', 'contact_message', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 202, 0, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100623/1277259339.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 11, 0, 'hidden', 'top', 'block'),
(20485, 'advs', 'modLogo', '网站标志', 'page', 'contact_message', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 481, 85, 25, 13, 5, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20486, 'diy', 'modPic', '图片/FLASH', 'page', 'contact_message', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 219, 0, 0, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100706/1278393227.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20427, 'diy', 'modButtomInfo', '底部信息编辑区', 'product', 'detail', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 150, 0, 6, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20426, 'diy', 'modPic', '图片/FLASH', 'product', 'detail', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 219, 0, 0, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100706/1278393227.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20425, 'advs', 'modLogo', '网站标志', 'product', 'detail', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 481, 85, 25, 13, 5, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20433, 'product', 'modProductContent', '产品详情', 'product', 'detail', 'tpl_product_content.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 652, 359, 87, 279, 90, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '产品详情', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(20424, 'menu', 'modMainMenu', '一级导航菜单', 'product', 'detail', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 700, 37, 165, 262, 7, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20497, 'advs', 'modLogo', '网站标志', 'page', 'contact_sales', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 481, 85, 25, 13, 5, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20498, 'diy', 'modPic', '图片/FLASH', 'page', 'contact_sales', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 219, 0, 0, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100706/1278393227.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20496, 'menu', 'modMainMenu', '一级导航菜单', 'page', 'contact_sales', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 700, 37, 165, 262, 7, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20495, 'page', 'modPageTitleMenu', '网页标题(菜单)', 'page', 'contact_sales', 'tpl_page_menu_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 100, 95, 279, 85, 11, 0, 10, 'id', 'desc', 0, 12, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '22', '', 1, 0, 'visible', 'content', 'block'),
(20450, 'diy', 'modPic', '图片/FLASH', 'job', 'main', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 219, 0, 0, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100706/1278393227.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20451, 'diy', 'modButtomInfo', '底部信息编辑区', 'job', 'main', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 150, 0, 6, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20313, 'page', 'modPageTitleMenu', '网页标题(菜单)', 'page', 'html_company', 'tpl_page_menu_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 100, 300, 279, 85, 90, 0, 10, 'id', 'desc', 0, 12, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'visible', 'content', 'block'),
(20510, 'diy', 'modPic', '图片/FLASH', 'page', 'contact', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 202, 0, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100623/1277259339.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 11, 0, 'hidden', 'top', 'block'),
(20508, 'advs', 'modLogo', '网站标志', 'page', 'contact', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 481, 85, 25, 13, 5, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20509, 'diy', 'modPic', '图片/FLASH', 'page', 'contact', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 219, 0, 0, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100706/1278393227.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20507, 'menu', 'modMainMenu', '一级导航菜单', 'page', 'contact', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 700, 37, 165, 262, 7, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block');
INSERT INTO `pwn_base_plus` (`id`, `coltype`, `pluslable`, `plusname`, `plustype`, `pluslocat`, `tempname`, `tempcolor`, `showborder`, `bordercolor`, `borderwidth`, `borderstyle`, `borderlable`, `borderroll`, `showbar`, `barbg`, `barcolor`, `backgroundcolor`, `morelink`, `width`, `height`, `top`, `left`, `zindex`, `padding`, `shownums`, `ord`, `sc`, `showtj`, `cutword`, `target`, `catid`, `cutbody`, `picw`, `pich`, `fittype`, `title`, `body`, `pic`, `piclink`, `attach`, `movi`, `sourceurl`, `word`, `word1`, `word2`, `word3`, `word4`, `text`, `text1`, `code`, `link`, `link1`, `link2`, `link3`, `link4`, `tags`, `groupid`, `projid`, `modno`, `setglobal`, `overflow`, `bodyzone`, `display`) VALUES
(20550, 'search', 'modSearchForm', '全站搜索表单', 'advs', 'link', 'tpl_searchform_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 240, 37, 83, 729, 8, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '全站搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(20553, 'advs', 'modLinkNavPath', '当前位置提示条', 'advs', 'link', 'tpl_navpath.htm', '-1', 'A788', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 686, 30, 29, 264, 90, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '当前位置', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(20549, 'menu', 'modBottomMenu', '底部菜单（一级）', 'advs', 'link', 'tpl_bottommenu_1.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 24, 122, 0, 4, 0, 10, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注栏目', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '', 1, 0, 'hidden', 'bottom', 'block'),
(20548, 'diy', 'modPic', '图片/FLASH', 'advs', 'link', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 202, 0, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100623/1277259339.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 11, 0, 'hidden', 'top', 'block'),
(20546, 'diy', 'modButtomInfo', '底部信息编辑区', 'advs', 'link', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 150, 0, 6, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20547, 'diy', 'modPic', '图片/FLASH', 'advs', 'link', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', 'http://', 1002, 241, 0, 0, 1, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20101122/1290415246.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 12, 0, 'hidden', 'content', 'block'),
(20555, 'page', 'modPageTitleMenu', '网页标题(菜单)', 'search', 'search', 'tpl_page_menu_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 100, 155, 279, 85, 9, 0, 10, 'id', 'desc', 0, 12, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'visible', 'content', 'block'),
(20556, 'advs', 'modLogo', '网站标志', 'search', 'search', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 481, 85, 25, 13, 5, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20557, 'menu', 'modMainMenu', '一级导航菜单', 'search', 'search', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 700, 37, 165, 262, 7, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20558, 'diy', 'modPic', '图片/FLASH', 'search', 'search', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 219, 0, 0, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100706/1278393227.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20471, 'job', 'modJobForm', '应聘申请表单', 'job', 'detail', 'tpl_job_form.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'block', '#f5f5f5', '', '', '-1', 652, 837, 100, 279, 90, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '应聘申请', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(20468, 'page', 'modPageTitleMenu', '网页标题(菜单)', 'job', 'detail', 'tpl_page_menu_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 100, 155, 279, 85, 9, 0, 10, 'id', 'desc', 0, 12, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'visible', 'content', 'block'),
(20469, 'job', 'modJobNavPath', '当前位置提示条', 'job', 'detail', 'tpl_navpath.htm', '-1', 'A788', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 686, 30, 29, 264, 10, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '当前位置', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(20467, 'menu', 'modMainMenu', '一级导航菜单', 'job', 'detail', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 700, 37, 165, 262, 7, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20466, 'advs', 'modLogo', '网站标志', 'job', 'detail', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 481, 85, 25, 13, 5, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20465, 'diy', 'modButtomInfo', '底部信息编辑区', 'job', 'detail', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 150, 0, 6, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20464, 'diy', 'modPic', '图片/FLASH', 'job', 'detail', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 219, 0, 0, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100706/1278393227.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20463, 'diy', 'modPic', '图片/FLASH', 'job', 'detail', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', 'http://', 1002, 241, 0, 0, 1, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20101122/1290415246.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 12, 0, 'hidden', 'content', 'block'),
(20574, 'diy', 'modPic', '图片/FLASH', 'photo', 'detail', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 202, 0, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100623/1277259339.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 11, 0, 'hidden', 'top', 'block'),
(20573, 'diy', 'modPic', '图片/FLASH', 'photo', 'detail', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', 'http://', 1002, 241, 0, 0, 1, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20101122/1290415246.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 12, 0, 'hidden', 'content', 'block'),
(20571, 'diy', 'modPic', '图片/FLASH', 'photo', 'detail', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 219, 0, 0, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100706/1278393227.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20572, 'diy', 'modButtomInfo', '底部信息编辑区', 'photo', 'detail', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 150, 0, 6, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20570, 'menu', 'modMainMenu', '一级导航菜单', 'photo', 'detail', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 700, 37, 165, 262, 7, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20569, 'advs', 'modLogo', '网站标志', 'photo', 'detail', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 481, 85, 25, 13, 5, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20583, 'menu', 'modMainMenu', '一级导航菜单', 'photo', 'main', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 700, 37, 165, 262, 7, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20582, 'advs', 'modLogo', '网站标志', 'photo', 'main', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 481, 85, 25, 13, 5, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20595, 'menu', 'modMainMenu', '一级导航菜单', 'photo', 'query', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 700, 37, 165, 262, 7, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20594, 'advs', 'modLogo', '网站标志', 'photo', 'query', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 481, 85, 25, 13, 5, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20343, 'diy', 'modPic', '图片/FLASH', 'page', 'html_culture', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', 'http://', 1002, 241, 0, 0, 1, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20101122/1290415246.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 12, 0, 'hidden', 'content', 'block'),
(20344, 'diy', 'modPic', '图片/FLASH', 'page', 'html_culture', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 202, 0, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100623/1277259339.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 11, 0, 'hidden', 'top', 'block'),
(20342, 'diy', 'modButtomInfo', '底部信息编辑区', 'page', 'html_culture', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 150, 0, 6, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20341, 'diy', 'modPic', '图片/FLASH', 'page', 'html_culture', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 219, 0, 0, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100706/1278393227.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20339, 'advs', 'modLogo', '网站标志', 'page', 'html_culture', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 481, 85, 25, 13, 5, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20340, 'menu', 'modMainMenu', '一级导航菜单', 'page', 'html_culture', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 700, 37, 165, 262, 7, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20338, 'page', 'modPageTitleMenu', '网页标题(菜单)', 'page', 'html_culture', 'tpl_page_menu_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 100, 155, 279, 85, 11, 0, 10, 'id', 'desc', 0, 12, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'visible', 'content', 'block'),
(20337, 'page', 'modPageContent', '网页内容详情', 'page', 'html_culture', 'tpl_page_content.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 652, 160, 87, 279, 9, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '内容标题', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(20315, 'page', 'modPageTitleMenu', '网页标题(菜单)', 'page', 'html_words', 'tpl_page_menu_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 100, 155, 279, 85, 11, 0, 10, 'id', 'desc', 0, 12, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'visible', 'content', 'block'),
(20314, 'page', 'modPageContent', '网页内容详情', 'page', 'html_words', 'tpl_page_content.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 652, 200, 87, 279, 9, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '内容标题', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(18566, 'diy', 'modPic', '图片/FLASH', 'index', 'index', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 202, 0, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100623/1277259339.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 11, 0, 'hidden', 'top', 'block'),
(20593, 'page', 'modPageTitleMenu', '网页标题(菜单)', 'photo', 'query', 'tpl_page_menu_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 100, 155, 279, 85, 9, 0, 10, 'id', 'desc', 0, 12, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'visible', 'content', 'block'),
(20421, 'product', 'modProductQuery', '产品检索搜索', 'product', 'query', 'tpl_product_query_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 681, 366, 87, 279, 9, 0, 20, 'id', 'desc', 0, 30, '_self', 0, 30, 140, 105, 'auto', '产品检索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(20420, 'product', 'modProductNavPath', '当前位置提示条', 'product', 'query', 'tpl_navpath.htm', '-1', 'A788', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 686, 30, 29, 264, 10, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '当前位置', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(20416, 'menu', 'modMainMenu', '一级导航菜单', 'product', 'query', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 700, 37, 165, 262, 7, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20415, 'advs', 'modLogo', '网站标志', 'product', 'query', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 481, 85, 25, 13, 5, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20581, 'page', 'modPageTitleMenu', '网页标题(菜单)', 'photo', 'main', 'tpl_page_menu_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 100, 155, 279, 85, 9, 0, 10, 'id', 'desc', 0, 12, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'visible', 'content', 'block'),
(20568, 'page', 'modPageTitleMenu', '网页标题(菜单)', 'photo', 'detail', 'tpl_page_menu_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 100, 155, 279, 85, 9, 0, 10, 'id', 'desc', 0, 12, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'visible', 'content', 'block'),
(20591, 'photo', 'modPhotoGlobalQuery', '全站翻页图片列表', 'photo', 'main', 'tpl_photo_query.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 681, 380, 87, 279, 90, 0, 10, 'id', 'desc', 0, 12, '_self', 0, -1, 150, 110, 'auto', '最新图片', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', '0', 1, 0, 'visible', 'content', 'block'),
(20423, 'product', 'modProductNavPath', '当前位置提示条', 'product', 'detail', 'tpl_navpath.htm', '-1', 'A788', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 686, 30, 29, 264, 9, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '当前位置', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(20444, 'product', 'modProductClass', '产品分类（列表）', 'product', 'main', 'tpl_productclass_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 100, 125, 279, 85, 10, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(20442, 'diy', 'modPic', '图片/FLASH', 'product', 'main', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 202, 0, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100623/1277259339.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 11, 0, 'hidden', 'top', 'block'),
(20443, 'search', 'modSearchForm', '全站搜索表单', 'product', 'main', 'tpl_searchform_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 240, 37, 83, 729, 8, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '全站搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(20441, 'menu', 'modBottomMenu', '底部菜单（一级）', 'product', 'main', 'tpl_bottommenu_1.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 24, 122, 0, 4, 0, 10, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注栏目', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '', 1, 0, 'hidden', 'bottom', 'block'),
(20440, 'diy', 'modPic', '图片/FLASH', 'product', 'main', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', 'http://', 1002, 241, 0, 0, 1, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20101122/1290415246.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 12, 0, 'hidden', 'content', 'block'),
(20439, 'diy', 'modButtomInfo', '底部信息编辑区', 'product', 'main', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 150, 0, 6, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20438, 'diy', 'modPic', '图片/FLASH', 'product', 'main', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 219, 0, 0, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100706/1278393227.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20437, 'advs', 'modLogo', '网站标志', 'product', 'main', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 481, 85, 25, 13, 5, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20445, 'product', 'modProductGlobalQuery', '全站翻页产品列表', 'product', 'main', 'tpl_product_query_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 680, 366, 87, 279, 90, 0, 10, 'id', 'desc', 0, 12, '_self', 0, 50, 140, 105, 'auto', '最新产品', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', '0', 1, 0, 'visible', 'content', 'block'),
(20436, 'menu', 'modMainMenu', '一级导航菜单', 'product', 'main', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 700, 37, 165, 262, 7, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20435, 'product', 'modProductNavPath', '当前位置提示条', 'product', 'main', 'tpl_navpath.htm', '-1', 'A788', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 686, 30, 29, 264, 9, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '当前位置', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(20396, 'news', 'modNewsClass', '文章一级分类', 'news', 'main', 'tpl_newsclass_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 100, 95, 279, 85, 10, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(20397, 'search', 'modSearchForm', '全站搜索表单', 'news', 'main', 'tpl_searchform_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 240, 37, 83, 729, 8, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '全站搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(20398, 'menu', 'modBottomMenu', '底部菜单（一级）', 'news', 'main', 'tpl_bottommenu_1.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 24, 122, 0, 4, 0, 10, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注栏目', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '', 1, 0, 'hidden', 'bottom', 'block'),
(19497, 'news', 'modNewsList', '文章列表', 'index', 'index', 'tpl_newslist_time_1.htm', '-1', 'A785', '#dddddd', 1, 'solid', '', 'click', 'block', '#cccccc', '#fff', '#fff', '{#RP#}news/class/?114.html', 333, 168, 420, 640, 13, 0, 5, 'id', 'desc', 0, 22, '_self', 114, 50, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', '0', 15, 0, 'visible', 'content', 'block'),
(19015, 'diy', 'modPic', '图片/FLASH', 'index', 'index', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', 'http://', 163, 39, 260, 32, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100706/1278382945.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 13, 0, 'hidden', 'content', 'block'),
(20529, 'feedback', 'modFeedBackSmallForm', '全站留言表单', 'feedback', 'main', 'tpl_feedback_smallform.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 652, 500, 87, 279, 90, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '给我留言', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'visible', 'content', 'block'),
(20414, 'diy', 'modPic', '图片/FLASH', 'product', 'query', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 219, 0, 0, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100706/1278393227.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(19901, 'diy', 'modEdit', 'HTML编辑区', 'index', 'index', 'tpl_edit.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', 'http://', 181, 121, 305, 32, 14, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '联系方式', '<div style="FONT: 12px/18px simsun; COLOR: #5c5c5c">地&nbsp; 址：杭州市莫山南路868号<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 汽车南站旁<br />电&nbsp; 话：0571-98765432<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 0571-98765432<br />传&nbsp; 真：0571-98765430<br />邮&nbsp; 箱：boss@mail.com</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 4, 0, 'hidden', 'content', 'block'),
(20288, 'diy', 'modPic', '图片/FLASH', 'index', 'index', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', 'http://', 199, 72, 505, 20, 16, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20101122/1290410495.jpg', '{#RP#}page/contact/message.php', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 16, 0, 'hidden', 'content', 'block'),
(20528, 'feedback', 'modFeedBackNavPath', '当前位置提示条', 'feedback', 'main', 'tpl_navpath.htm', '-1', 'A788', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 686, 30, 29, 264, 90, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '当前位置', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(20448, 'advs', 'modLogo', '网站标志', 'job', 'main', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 481, 85, 25, 13, 5, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20449, 'menu', 'modMainMenu', '一级导航菜单', 'job', 'main', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 700, 37, 165, 262, 7, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20447, 'page', 'modPageTitleMenu', '网页标题(菜单)', 'job', 'main', 'tpl_page_menu_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 100, 155, 279, 85, 9, 0, 10, 'id', 'desc', 0, 12, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'visible', 'content', 'block'),
(20457, 'job', 'modJobNavPath', '当前位置提示条', 'job', 'main', 'tpl_navpath.htm', '-1', 'A788', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 686, 30, 29, 264, 90, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '当前位置', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(20462, 'diy', 'modPic', '图片/FLASH', 'job', 'detail', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 202, 0, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100623/1277259339.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 11, 0, 'hidden', 'top', 'block'),
(20461, 'menu', 'modBottomMenu', '底部菜单（一级）', 'job', 'detail', 'tpl_bottommenu_1.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 24, 122, 0, 4, 0, 10, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注栏目', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '', 1, 0, 'hidden', 'bottom', 'block'),
(20460, 'search', 'modSearchForm', '全站搜索表单', 'job', 'detail', 'tpl_searchform_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 240, 37, 83, 729, 8, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '全站搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(20470, 'job', 'modJobContent', '职位信息详情', 'job', 'detail', 'tpl_jobcontent.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 652, 411, 87, 279, 90, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '职位信息', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(20484, 'menu', 'modMainMenu', '一级导航菜单', 'page', 'contact_message', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 700, 37, 165, 262, 7, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20506, 'page', 'modPageTitleMenu', '网页标题(菜单)', 'page', 'contact', 'tpl_page_menu_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 100, 95, 279, 85, 11, 0, 10, 'id', 'desc', 0, 12, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '22', '', 1, 0, 'visible', 'content', 'block'),
(20578, 'photo', 'modPhotoContent', '图片详情', 'photo', 'detail', 'tpl_photo_content.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 652, 328, 87, 279, 90, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '图片详情', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(20545, 'diy', 'modPic', '图片/FLASH', 'advs', 'link', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 219, 0, 0, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100706/1278393227.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20544, 'menu', 'modMainMenu', '一级导航菜单', 'advs', 'link', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 700, 37, 165, 262, 7, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20543, 'advs', 'modLogo', '网站标志', 'advs', 'link', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 481, 85, 25, 13, 5, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20542, 'page', 'modPageTitleMenu', '网页标题(菜单)', 'advs', 'link', 'tpl_page_menu_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 100, 155, 279, 85, 9, 0, 10, 'id', 'desc', 0, 12, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'visible', 'content', 'block'),
(20308, 'advs', 'modLogo', '网站标志', 'page', 'html_company', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 481, 85, 25, 13, 5, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20307, 'menu', 'modMainMenu', '一级导航菜单', 'page', 'html_company', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 700, 37, 165, 262, 7, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20294, 'diy', 'modPic', '图片/FLASH', 'page', 'html_company', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 219, 0, 0, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100706/1278393227.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20292, 'diy', 'modButtomInfo', '底部信息编辑区', 'page', 'html_company', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 150, 0, 6, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20310, 'diy', 'modPic', '图片/FLASH', 'page', 'html_company', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', 'http://', 1002, 241, 0, 0, 1, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20101122/1290415246.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 12, 0, 'hidden', 'content', 'block'),
(20306, 'diy', 'modPic', '图片/FLASH', 'page', 'html_company', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 202, 0, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100623/1277259339.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 11, 0, 'hidden', 'top', 'block'),
(20289, 'menu', 'modBottomMenu', '底部菜单（一级）', 'page', 'html_company', 'tpl_bottommenu_1.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 24, 122, 0, 4, 0, 10, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注栏目', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '', 1, 0, 'hidden', 'bottom', 'block'),
(20552, 'advs', 'modLinkPic', '图片友情链接', 'advs', 'link', 'tpl_linkpic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '{#RP#}advs/link/', 652, 100, 87, 279, 90, 0, 6, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '友情链接', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'visible', 'content', 'block'),
(20565, 'search', 'modSearch', '全站搜索结果', 'search', 'search', 'tpl_search.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 652, 841, 87, 279, 90, 0, -1, 'id', 'desc', 0, 30, '_self', 0, -1, -1, -1, 'fill', '全站搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(20413, 'diy', 'modButtomInfo', '底部信息编辑区', 'product', 'query', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 150, 0, 6, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20412, 'diy', 'modPic', '图片/FLASH', 'product', 'query', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', 'http://', 1002, 241, 0, 0, 1, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20101122/1290415246.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 12, 0, 'hidden', 'content', 'block'),
(20483, 'page', 'modPageTitleMenu', '网页标题(菜单)', 'page', 'contact_message', 'tpl_page_menu_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 100, 95, 279, 85, 11, 0, 10, 'id', 'desc', 0, 12, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '22', '', 1, 0, 'visible', 'content', 'block'),
(20410, 'menu', 'modBottomMenu', '底部菜单（一级）', 'product', 'query', 'tpl_bottommenu_1.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 24, 122, 0, 4, 0, 10, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注栏目', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '', 1, 0, 'hidden', 'bottom', 'block'),
(20411, 'diy', 'modPic', '图片/FLASH', 'product', 'query', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 202, 0, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100623/1277259339.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 11, 0, 'hidden', 'top', 'block'),
(20409, 'search', 'modSearchForm', '全站搜索表单', 'product', 'query', 'tpl_searchform_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 240, 37, 83, 729, 8, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '全站搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(20419, 'product', 'modProductClass', '产品分类（列表）', 'product', 'query', 'tpl_productclass_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 100, 125, 279, 85, 11, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(20603, 'photo', 'modPhotoQuery', '图片检索搜索', 'photo', 'query', 'tpl_photo_query.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 680, 380, 87, 279, 11, 0, 20, 'id', 'desc', 0, 30, '_self', 0, -1, 150, 110, 'auto', '图片检索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(20517, 'page', 'modPageTitleMenu', '网页标题(菜单)', 'feedback', 'main', 'tpl_page_menu_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 100, 95, 279, 85, 9, 0, 10, 'id', 'desc', 0, 12, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '22', '', 1, 0, 'visible', 'content', 'block'),
(20518, 'menu', 'modMainMenu', '一级导航菜单', 'feedback', 'main', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 700, 37, 165, 262, 7, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20519, 'advs', 'modLogo', '网站标志', 'feedback', 'main', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 481, 85, 25, 13, 5, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20520, 'diy', 'modPic', '图片/FLASH', 'feedback', 'main', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 219, 0, 0, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100706/1278393227.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20521, 'diy', 'modPic', '图片/FLASH', 'feedback', 'main', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 202, 0, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100623/1277259339.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 11, 0, 'hidden', 'top', 'block'),
(20522, 'diy', 'modButtomInfo', '底部信息编辑区', 'feedback', 'main', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 150, 0, 6, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20523, 'diy', 'modPic', '图片/FLASH', 'feedback', 'main', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', 'http://', 1002, 241, 0, 0, 1, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20101122/1290415246.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 12, 0, 'hidden', 'content', 'block'),
(20524, 'search', 'modSearchForm', '全站搜索表单', 'feedback', 'main', 'tpl_searchform_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 240, 37, 83, 729, 8, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '全站搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(20525, 'menu', 'modBottomMenu', '底部菜单（一级）', 'feedback', 'main', 'tpl_bottommenu_1.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 24, 122, 0, 4, 0, 10, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注栏目', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '', 1, 0, 'hidden', 'bottom', 'block');
INSERT INTO `pwn_base_plus` (`id`, `coltype`, `pluslable`, `plusname`, `plustype`, `pluslocat`, `tempname`, `tempcolor`, `showborder`, `bordercolor`, `borderwidth`, `borderstyle`, `borderlable`, `borderroll`, `showbar`, `barbg`, `barcolor`, `backgroundcolor`, `morelink`, `width`, `height`, `top`, `left`, `zindex`, `padding`, `shownums`, `ord`, `sc`, `showtj`, `cutword`, `target`, `catid`, `cutbody`, `picw`, `pich`, `fittype`, `title`, `body`, `pic`, `piclink`, `attach`, `movi`, `sourceurl`, `word`, `word1`, `word2`, `word3`, `word4`, `text`, `text1`, `code`, `link`, `link1`, `link2`, `link3`, `link4`, `tags`, `groupid`, `projid`, `modno`, `setglobal`, `overflow`, `bodyzone`, `display`) VALUES
(20357, 'search', 'modSearchForm', '全站搜索表单', 'page', 'html_research', 'tpl_searchform_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 240, 37, 83, 729, 8, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '全站搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(20358, 'page', 'modPageNavPath', '当前位置提示条', 'page', 'html_research', 'tpl_navpath.htm', '-1', 'A788', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 686, 30, 29, 264, 10, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '当前位置', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block'),
(20356, 'menu', 'modBottomMenu', '底部菜单（一级）', 'page', 'html_research', 'tpl_bottommenu_1.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 24, 122, 0, 4, 0, 10, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注栏目', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '', 1, 0, 'hidden', 'bottom', 'block'),
(20355, 'diy', 'modPic', '图片/FLASH', 'page', 'html_research', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 202, 0, 0, 2, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100623/1277259339.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 11, 0, 'hidden', 'top', 'block'),
(20354, 'diy', 'modPic', '图片/FLASH', 'page', 'html_research', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', 'http://', 1002, 241, 0, 0, 1, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20101122/1290415246.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 12, 0, 'hidden', 'content', 'block'),
(20348, 'page', 'modPageContent', '网页内容详情', 'page', 'html_research', 'tpl_page_content.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 652, 160, 87, 279, 9, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '内容标题', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'visible', 'content', 'block'),
(20349, 'page', 'modPageTitleMenu', '网页标题(菜单)', 'page', 'html_research', 'tpl_page_menu_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 100, 155, 279, 85, 11, 0, 10, 'id', 'desc', 0, 12, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'visible', 'content', 'block'),
(20350, 'advs', 'modLogo', '网站标志', 'page', 'html_research', 'tpl_logo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 481, 85, 25, 13, 5, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20351, 'menu', 'modMainMenu', '一级导航菜单', 'page', 'html_research', 'tpl_mainmenu_dolphin.htm', 'A', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 700, 37, 165, 262, 7, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '导航菜单', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '', 1, 0, 'hidden', 'top', 'block'),
(20352, 'diy', 'modPic', '图片/FLASH', 'page', 'html_research', 'tpl_pic.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 219, 0, 0, 3, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '', '-1 ', 'diy/pics/20100706/1278393227.jpg', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20353, 'diy', 'modButtomInfo', '底部信息编辑区', 'page', 'html_research', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 1002, 31, 150, 0, 6, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '脚注信息', '<div style="TEXT-ALIGN: center; LINE-HEIGHT: 24px; MARGIN: 0px; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; COLOR: #fff">版权所有 Copyright(C)2009-2010 杭州市某某农业科技公司</div>', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'bottom', 'block'),
(20305, 'search', 'modSearchForm', '全站搜索表单', 'index', 'index', 'tpl_searchform_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 240, 37, 83, 729, 17, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '全站搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(20309, 'search', 'modSearchForm', '全站搜索表单', 'page', 'html_company', 'tpl_searchform_dolphin.htm', '-1', '1000', '', 0, 'solid', '', 'click', 'none', '', '', '', '-1', 240, 37, 83, 729, 8, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '全站搜索', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'top', 'block'),
(20311, 'page', 'modPageNavPath', '当前位置提示条', 'page', 'html_company', 'tpl_navpath.htm', '-1', 'A788', '#dddddd', 0, 'solid', '', 'click', 'none', '#cccccc', '#fff', '#fff', '-1', 686, 30, 29, 264, 10, 0, -1, 'id', 'desc', 0, -1, '_self', 0, -1, -1, -1, 'fill', '当前位置', '-1 ', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '', 1, 0, 'hidden', 'content', 'block');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_base_plusdefault`
--

CREATE TABLE IF NOT EXISTS `pwn_base_plusdefault` (
  `id` int(12) NOT NULL auto_increment,
  `coltype` varchar(30) NOT NULL,
  `pluslable` varchar(100) default '0',
  `plusname` char(100) NOT NULL default '',
  `plustype` varchar(50) default '0',
  `pluslocat` varchar(50) default '0',
  `tempname` varchar(100) NOT NULL default '0',
  `tempcolor` varchar(2) NOT NULL default '-1',
  `showborder` char(20) NOT NULL default '1000',
  `bordercolor` varchar(7) NOT NULL default '#4682b4',
  `borderwidth` int(2) NOT NULL default '1',
  `borderstyle` varchar(10) NOT NULL default 'solid',
  `borderlable` varchar(150) NOT NULL,
  `borderroll` varchar(10) NOT NULL,
  `showbar` varchar(10) NOT NULL default 'none',
  `barbg` varchar(10) NOT NULL default '#4682b4',
  `barcolor` varchar(10) NOT NULL default '#fff',
  `backgroundcolor` varchar(7) NOT NULL default '#fff',
  `morelink` varchar(100) NOT NULL default 'http://',
  `width` int(5) NOT NULL default '100',
  `height` int(5) NOT NULL default '100',
  `top` int(5) NOT NULL default '0',
  `left` int(5) NOT NULL default '0',
  `zindex` int(2) NOT NULL default '99',
  `padding` int(11) NOT NULL default '0',
  `shownums` int(10) NOT NULL default '-1',
  `ord` varchar(100) NOT NULL default '-1',
  `sc` varchar(10) NOT NULL default '-1',
  `showtj` int(5) NOT NULL default '-1',
  `cutword` int(20) NOT NULL default '-1',
  `target` varchar(30) NOT NULL default '-1',
  `catid` int(10) NOT NULL default '-1',
  `cutbody` int(5) NOT NULL default '-1',
  `picw` int(3) NOT NULL default '-1',
  `pich` int(3) NOT NULL default '-1',
  `fittype` varchar(10) NOT NULL default '-1',
  `title` varchar(100) NOT NULL default '',
  `body` text,
  `pic` varchar(255) NOT NULL default '-1',
  `piclink` char(255) NOT NULL default '-1',
  `attach` varchar(255) NOT NULL default '-1',
  `movi` varchar(255) NOT NULL default '-1',
  `sourceurl` varchar(20) NOT NULL default '-1',
  `word` varchar(255) NOT NULL default '-1',
  `word1` varchar(255) NOT NULL default '-1',
  `word2` varchar(255) NOT NULL default '-1',
  `word3` char(255) NOT NULL default '-1',
  `word4` char(255) NOT NULL default '-1',
  `text` text NOT NULL,
  `text1` text NOT NULL,
  `code` text NOT NULL,
  `link` varchar(255) NOT NULL default '-1',
  `link1` char(255) NOT NULL default '-1',
  `link2` char(255) NOT NULL default '-1',
  `link3` char(255) NOT NULL default '-1',
  `link4` char(255) NOT NULL default '-1',
  `tags` varchar(30) NOT NULL default '-1',
  `groupid` varchar(20) NOT NULL default '-1',
  `projid` varchar(20) NOT NULL default '-1',
  `moveable` int(1) NOT NULL default '1',
  `classtbl` varchar(30) NOT NULL default '',
  `grouptbl` varchar(50) NOT NULL,
  `projtbl` varchar(50) NOT NULL,
  `setglobal` int(5) NOT NULL default '-1',
  `overflow` varchar(20) NOT NULL default 'hidden',
  `bodyzone` varchar(10) NOT NULL default 'content',
  `display` varchar(10) NOT NULL default 'block',
  `ifmul` int(1) NOT NULL default '1',
  `ifrefresh` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=496 ;

--
-- 转存表中的数据 `pwn_base_plusdefault`
--

INSERT INTO `pwn_base_plusdefault` (`id`, `coltype`, `pluslable`, `plusname`, `plustype`, `pluslocat`, `tempname`, `tempcolor`, `showborder`, `bordercolor`, `borderwidth`, `borderstyle`, `borderlable`, `borderroll`, `showbar`, `barbg`, `barcolor`, `backgroundcolor`, `morelink`, `width`, `height`, `top`, `left`, `zindex`, `padding`, `shownums`, `ord`, `sc`, `showtj`, `cutword`, `target`, `catid`, `cutbody`, `picw`, `pich`, `fittype`, `title`, `body`, `pic`, `piclink`, `attach`, `movi`, `sourceurl`, `word`, `word1`, `word2`, `word3`, `word4`, `text`, `text1`, `code`, `link`, `link1`, `link2`, `link3`, `link4`, `tags`, `groupid`, `projid`, `moveable`, `classtbl`, `grouptbl`, `projtbl`, `setglobal`, `overflow`, `bodyzone`, `display`, `ifmul`, `ifrefresh`) VALUES
(17, 'advs', 'modLogo', '网站标志', 'all', 'all', 'tpl_logo.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 150, 60, 20, 20, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '网站标志', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '-1', 1, '', '_advs_logo', '', 1, 'hidden', 'top', 'block', 0, 0),
(25, 'advs', 'modLinkPic', '图片友情链接', 'all', 'all', 'tpl_linkpic.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '{#RP#}advs/link/', 650, 100, 0, 0, 90, 10, 6, '-1', '-1', -1, -1, '_self', -1, -1, -1, -1, '-1', '友情链接', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '-1', 1, '', '_advs_linkgroup', '', -1, 'hidden', 'content', 'block', 1, 0),
(26, 'advs', 'modLinkText', '文字友情链接', 'all', 'all', 'tpl_link.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '{#RP#}advs/link/', 650, 100, 0, 0, 90, 10, 12, '-1', '-1', -1, -1, '_self', -1, -1, -1, -1, '-1', '友情链接', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '-1', 1, '', '_advs_linkgroup', '', -1, 'hidden', 'content', 'block', 1, 0),
(31, 'advs', 'modAdvsLb', '图片轮播广告', 'all', 'all', 'tpl_advslb.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 320, 280, 200, 200, 90, 0, 5, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '轮播广告', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '-1', 1, '', '_advs_lbgroup', '', -1, 'hidden', 'content', 'block', 0, 1),
(32, 'advs', 'modAdvsPic', '页内图片广告', 'all', 'all', 'tpl_advspic.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 565, 95, 0, 0, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '广告位', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '-1', 1, '', '_advs_pic', '', -1, 'hidden', 'content', 'block', 1, 0),
(34, 'advs', 'modAdvsText', '文字广告（静态）', 'all', 'all', 'tpl_advstext.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 200, 30, 200, 200, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '广告位', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '-1', 1, '', '_advs_text', '', -1, 'hidden', 'content', 'block', 1, 0),
(35, 'advs', 'modAdvsMovi', 'FLASH视频广告', 'all', 'all', 'tpl_movi.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 300, 300, 200, 200, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '视频播放', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '-1', 1, '', '_advs_movi', '', -1, 'hidden', 'content', 'block', 1, 0),
(48, 'advs', 'modAdvsFloat', '图片广告（飘动）', 'all', 'all', 'tpl_advs_float.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 100, 100, 0, 0, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '广告位', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '-1', 1, '', '_advs_pic', '', -1, 'hidden', 'bodyex', 'block', 0, 1),
(49, 'advs', 'modAdvsDuilian', '对联广告', 'all', 'all', 'tpl_advs_duilian.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 100, 220, 130, 6, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '广告位', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '-1', 1, '', '_advs_duilian', '', -1, 'hidden', 'bodyex', 'block', 0, 1),
(50, 'advs', 'modAdvsZimu', '文字广告（字幕）', 'all', 'all', 'tpl_advszimu.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 200, 30, 200, 200, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '广告位', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '-1', 1, '', '_advs_text', '', -1, 'hidden', 'content', 'block', 1, 0),
(51, 'advs', 'modAdvsFixed', '图片广告（悬浮）', 'all', 'all', 'tpl_advs_fixed.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 100, 100, 350, 0, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '广告位', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '2', '-1', 1, '', '_advs_pic', '', -1, 'hidden', 'bodyex', 'block', 0, 0),
(61, 'advs', 'modLinkNavPath', '当前位置提示条', 'advs', 'link', 'tpl_navpath.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 650, 30, 0, 200, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '当前位置', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(89, 'advs', 'modAdvsCode', '广告代码', 'all', 'all', 'tpl_advscode.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '#fff', '-1', 250, 250, 0, 0, 99, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '广告位', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '请在此插入广告代码', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 1),
(18, 'comment', 'modCommentSearchForm', '点评搜索表单', 'comment', 'all', 'tpl_comment_searchform.htm', '-1', 'A500', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 650, 30, 0, 200, 90, 3, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '点评搜索', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_comment_cat', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(21, 'comment', 'modCommentList', '最新点评（列表）', 'all', 'all', 'tpl_commentlist.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '{#RP#}comment/class/index.php', 300, 200, 0, 0, 90, 12, 5, '-1', '-1', 0, 12, '_self', 0, -1, -1, -1, '-1', '最新点评', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_comment_cat', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(22, 'comment', 'modCommentQuery', '点评检索', 'comment', 'query', 'tpl_comment_query.htm', '-1', '1000', '#def', 1, 'solid', '', '', 'none', '#def', '#fff', '#fff', '-1', 750, 300, 35, 0, 90, 0, 20, '-1', '-1', -1, 30, '_self', -1, -1, -1, -1, '-1', '点评检索', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_news_cat', '', '', -1, 'visible', 'content', 'block', 0, 0),
(23, 'comment', 'modCommentClass', '点评分类', 'all', 'all', 'tpl_comment_class.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 200, 200, 200, 200, 90, 12, -1, '-1', '-1', -1, -1, '_self', -1, -1, -1, -1, '-1', '点评分类', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_news_cat', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(24, 'comment', 'modCommentContent', '点评详情', 'comment', 'detail', 'tpl_comment_content.htm', '-1', '1000', '#def', 0, 'solid', '', '', 'none', '#def', '#fff', '#fff', '-1', 750, 500, 35, 0, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '点评详情', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_comment_cat', '', '', -1, 'visible', 'content', 'block', 0, 0),
(56, 'comment', 'modCommentNavPath', '当前位置提示条', 'comment', 'all', 'tpl_navpath.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 650, 30, 0, 200, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '当前位置', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_comment_cat', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(151, 'comment', 'modMemberCommentList', '会员最新点评', 'member', 'homepage', 'tpl_membercommentlist.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '{#RP#}comment/class/index.php?mid={#mid#}', 380, 170, 0, 0, 90, 12, 5, '-1', '-1', 0, 20, '_self', -1, -1, -1, -1, '-1', '我的点评', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(164, 'comment', 'modCommentHot30', '本月点评点击榜', 'all', 'all', 'tpl_comment_hotlist.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '{#RP#}comment/class/index.php?myord=cl', 300, 200, 0, 0, 90, 12, 10, '-1', '-1', 0, 12, '_self', 0, -1, -1, -1, '-1', '本月点击榜', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_comment_cat', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(165, 'comment', 'modCommentHot7', '本周点评点击榜', 'all', 'all', 'tpl_comment_hotlist.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '{#RP#}comment/class/index.php?myord=cl', 300, 200, 0, 0, 90, 12, 10, '-1', '-1', 0, 12, '_self', 0, -1, -1, -1, '-1', '本周点击榜', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_comment_cat', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(166, 'comment', 'modCommentRq30', '本月点评人气榜', 'all', 'all', 'tpl_comment_hotlist.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '{#RP#}comment/class/index.php?myord=backcount', 300, 200, 0, 0, 90, 12, 10, '-1', '-1', 0, 12, '_self', 0, -1, -1, -1, '-1', '本月人气榜', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_comment_cat', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(167, 'comment', 'modCommentRq7', '本周点评人气榜', 'all', 'all', 'tpl_comment_hotlist.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '{#RP#}comment/class/index.php?myord=backcount', 300, 200, 0, 0, 90, 12, 10, '-1', '-1', 0, 12, '_self', 0, -1, -1, -1, '-1', '本周人气榜', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_comment_cat', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(9, 'diy', 'modEdit', 'HTML编辑区', 'all', 'all', 'tpl_edit.htm', '-1', '1000', '#dddddd', 1, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', 'http://', 200, 200, 0, 0, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '自定内容', '请输入内容', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_news_cat', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(27, 'diy', 'modButtomInfo', '底部信息编辑区', 'all', 'all', 'tpl_bottominfo.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '#fff', '-1', 900, 120, 30, 0, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '脚注信息', '请输入内容', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_news_cat', '', '', 1, 'hidden', 'bottom', 'block', 0, 0),
(47, 'diy', 'modText', '多行文字', 'all', 'all', 'tpl_text.htm', '-1', '1000', '#dddddd', 1, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 200, 200, 0, 0, 90, 12, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '多行文字', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '请输入自定义文字', '-1', '-1', '', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(53, 'diy', 'modPic', '图片/FLASH', 'all', 'all', 'tpl_pic.htm', '-1', '1000', '#dddddd', 1, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', 'http://', 300, 200, 0, 0, 90, 5, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '图片', '-1', '', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(74, 'diy', 'modWords', '单行文字', 'all', 'all', 'tpl_words.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 200, 50, 0, 0, 99, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '单行文字', '-1', '-1', '-1', '-1', '-1', '-1', '请输入文字', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(75, 'diy', 'modPicWordText', '图片+标题+介绍', 'all', 'all', 'tpl_picwordtext.htm', '-1', '1000', '#dddddd', 1, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', 'http://', 250, 90, 30, 300, 99, 5, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, 100, '-1', '自定图文', '-1', '', 'http://', '-1', '-1', '-1', '请输入标题文字', '-1', '-1', '-1', '-1', '请输入介绍文字', '-1', '-1', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(76, 'diy', 'modPicWord', '图片+标题', 'all', 'all', 'tpl_picword.htm', '-1', '1000', '#dddddd', 1, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', 'http://', 200, 250, 0, 0, 99, 5, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '自定图文', '-1', '', 'http://', '-1', '-1', '-1', '请输入标题', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(184, 'news', 'modNewsPicMemo', '文章图片+标题+摘要', 'all', 'all', 'tpl_newspicmemo.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', 'http://', 300, 320, 0, 0, 99, 5, 3, 'id|dtime|uptime|prop1|prop2|cl|xuhao', 'desc', 0, 12, '_self', 0, 35, 80, 80, 'fill', '图片新闻', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '-1', '0', 1, '_news_cat', '', '_news_proj', -1, 'hidden', 'content', 'block', 1, 0),
(86, 'diy', 'modPlusBorder', '空白边框', 'all', 'all', 'tpl_plusborder.htm', '-1', '1000', '#dddddd', 1, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', 'http://', 300, 300, 0, 0, 1, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '空白边框', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(87, 'diy', 'modColorZone', '空白色块', 'all', 'all', 'tpl_colorzone.htm', '-1', '1000', '#e10000', 1, 'solid', '', '', 'none', '', '', '#e10000', '-1', 200, 200, 30, 30, 1, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(63, 'effect', 'modJIanFan', '动态简繁转换', 'all', 'all', 'tpl_jianfan.htm', '-1', '1000', '#dddddd', 1, 'solid', '', '', 'none', '#cccccc', '#fff', '', '-1', 150, 50, 30, 700, 99, 5, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '简繁转换', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', 1, 'hidden', 'top', 'block', 0, 0),
(64, 'effect', 'modNowDate', '当前日期时间', 'all', 'all', 'tpl_nowdate.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '', '', '', '-1', 200, 30, 10, 600, 99, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '当前日期时间', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', 1, 'hidden', 'content', 'block', 0, 0),
(65, 'effect', 'modMouseClock', '鼠标时钟特效', 'all', 'all', 'tpl_mouseclock.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 150, 150, 300, 10, 99, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '特效', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'bodyex', 'block', 0, 1),
(6, 'index', 'modIndexNavPath', '当前位置提示条', 'index', 'index', 'tpl_navpath.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 650, 30, 0, 200, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '当前位置', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(30, 'member', 'modLoginForm', '会员登录表单', 'all', 'all', 'tpl_loginform.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 200, 180, 0, 0, 90, 12, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '会员登录', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_news_cat', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(37, 'member', 'modMemberReg', '会员注册', 'member', 'reg', 'tpl_reg.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '#fff', '-1', 750, 390, 0, 0, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '会员注册', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(43, 'member', 'modMemberLogin', '会员登录表单(大)', 'member', 'login', 'tpl_member_login.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '#fff', '-1', 650, 300, 0, 0, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '会员登录', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_news_cat', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(45, 'member', 'modResetPass', '重设密码向导', 'member', 'lostpass', 'tpl_resetpass.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 500, 250, 0, 0, 90, 30, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '重设密码', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_news_cat', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(57, 'member', 'modMemberNavPath', '当前位置提示条', 'member', 'all', 'tpl_navpath.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 700, 30, 0, 200, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '当前位置', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(103, 'member', 'modMemberInfo', '会员登录信息', 'member', 'main', 'tpl_memberinfo.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 300, 250, 0, 0, 99, 12, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '会员登录信息', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(104, 'member', 'modMemberNotice', '会员公告(列表)', 'member', 'main', 'tpl_member_notice.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 700, 200, 0, 0, 99, 12, 5, '-1', '-1', -1, 25, '_self', -1, -1, -1, -1, '-1', '会员公告', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(106, 'member', 'modMemberAccount', '登录账号设置表单', 'member', 'account', 'tpl_member_account.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 700, 200, 0, 0, 99, 20, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '登录帐号设置', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(107, 'member', 'modMemberPerson', '头像签名设置表单', 'member', 'person', 'tpl_member_person.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 700, 390, 0, 0, 99, 20, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '头像签名设置', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(108, 'member', 'modMemberDetail', '个人资料修改表单', 'member', 'detail', 'tpl_member_detail.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 700, 500, 0, 0, 99, 20, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '个人资料修改', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(109, 'member', 'modMemberContact', '联系信息设置表单', 'member', 'contact', 'tpl_member_contact.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 700, 390, 0, 0, 99, 20, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '联系信息设置', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(110, 'member', 'modMemberNoticeContent', '会员公告详情', 'member', 'notice', 'tpl_member_notice_content.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 700, 300, 0, 0, 99, 20, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '会员公告', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(139, 'member', 'modMemberFav', '我的收藏夹', 'member', 'fav', 'tpl_member_fav.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 700, 350, 0, 0, 99, 5, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '我的收藏夹', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(140, 'member', 'modMemberFriends', '我的好友', 'member', 'friends', 'tpl_member_friends.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 700, 350, 0, 0, 99, 5, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '我的好友', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(141, 'member', 'modMemberComment', '我的点评', 'member', 'comment', 'tpl_member_comment.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 700, 350, 0, 0, 99, 5, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '我的点评', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(142, 'member', 'modMemberMsn', '我的站内短信', 'member', 'msn', 'tpl_member_msn.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 700, 350, 0, 0, 99, 5, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '我的站内短信', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(147, 'member', 'modMemberCentInfo', '会员积分信息', 'member', 'main', 'tpl_centinfo.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 300, 200, 0, 0, 99, 12, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '会员积分', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(148, 'member', 'modMemberCentLog', '会员积分查询', 'member', 'membercent', 'tpl_member_centlog.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 700, 300, 0, 0, 99, 5, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '我的积分', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(153, 'member', 'modMemberIntro', '会员简介', 'member', 'homepage', 'tpl_member_intro.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 500, 200, 0, 0, 99, 12, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '会员简介', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(154, 'member', 'modMemberHomeInfo', '会员信息', 'member', 'homepage', 'tpl_member_homeinfo.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 500, 210, 0, 0, 99, 12, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '会员信息', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(14, 'menu', 'modChannelMenu', '二级导航菜单', 'all', 'all', 'tpl_channelmenu.htm', 'A', '1000', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 900, 65, 120, 0, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '导航菜单', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '-1', 1, '', '_menu_group', '', 1, 'hidden', 'top', 'block', 0, 0),
(16, 'menu', 'modBottomMenu', '底部菜单（一级）', 'all', 'all', 'tpl_bottommenu.htm', 'A', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 900, 28, 0, 0, 90, 0, 10, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '脚注栏目', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '3', '-1', 1, '', '_menu_group', '', 1, 'hidden', 'bottom', 'block', 0, 0),
(67, 'menu', 'modDropDownMenu', '二级下拉菜单', 'all', 'all', 'tpl_dropdownmenu.htm', 'A', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 900, 28, 100, 0, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '导航菜单', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '-1', 1, '', '_menu_group', '', 1, 'hidden', 'top', 'block', 0, 0),
(66, 'menu', 'modTopMenu', '顶部菜单(一级)', 'all', 'all', 'tpl_topmenu.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 350, 30, 5, 500, 90, 0, 10, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '顶部菜单', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '2', '-1', 1, '', '_menu_group', '', 1, 'hidden', 'top', 'block', 0, 0),
(68, 'menu', 'modMainMenu', '一级导航菜单', 'all', 'all', 'tpl_mainmenu.htm', 'A', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 900, 30, 100, 0, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '导航菜单', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '-1', 1, '', '_menu_group', '', 1, 'hidden', 'top', 'block', 0, 0),
(115, 'menu', 'modTreeMenu', '树形导航菜单', 'all', 'all', 'tpl_treemenu.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 190, 200, 0, 0, 99, 12, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '导航菜单', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '-1', 1, '', '_menu_group', '', 1, 'visible', 'content', 'block', 0, 1),
(116, 'menu', 'modMemberMenu', '会员功能菜单', 'member', 'all', 'tpl_qqmenu.htm', 'A', '1000', '#def', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 190, 200, 0, 0, 99, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '会员中心', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 1),
(1, 'news', 'modNewsQuery', '文章翻页检索', 'news', 'query', 'tpl_newsquery.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 600, 500, 30, 200, 90, 10, 20, '-1', '-1', -1, 30, '_self', -1, -1, -1, -1, '-1', '文章检索', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_news_cat', '', '', -1, 'visible', 'content', 'block', 0, 0),
(2, 'news', 'modNewsClass', '文章一级分类', 'all', 'all', 'tpl_newsclass.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 200, 200, 0, 0, 90, 12, -1, '-1', '-1', 0, -1, '_self', 0, -1, -1, -1, '-1', '文章分类', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_news_cat', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(3, 'news', 'modNewsTreeClass', '文章分类（树形）', 'all', 'all', 'tpl_classtree.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 200, 200, 200, 200, 90, 12, -1, '-1', '-1', 0, -1, '_self', 0, -1, -1, -1, '-1', '文章分类', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_news_cat', '', '', -1, 'hidden', 'content', 'block', 0, 1),
(4, 'news', 'modNewsProjList', '相关文章(同专题)', 'news', 'detail', 'tpl_newslist.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', 'http://', 200, 200, 0, 0, 90, 12, 5, '-1', '-1', 0, 12, '_self', 0, -1, -1, -1, '-1', '相关文章', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_news_cat', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(5, 'news', 'modNewsAuthorList', '相关文章(同发布人)', 'news', 'detail', 'tpl_newslist.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', 'http://', 200, 200, 0, 0, 90, 12, 5, '-1', '-1', 0, 12, '_self', 0, -1, -1, -1, '-1', '相关文章', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_news_cat', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(7, 'news', 'modNewsClassFc', '文章逐级分类', 'news', 'query', 'tpl_newsclass.htm', '-1', 'A001', '', 0, 'solid', '', '', 'none', '', '', '#fff', '-1', 200, 200, 0, 0, 90, 12, 99, '-1', '-1', 0, -1, '_self', -1, -1, -1, -1, '-1', '文章分类', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(8, 'news', 'modNewsList', '文章列表', 'all', 'all', 'tpl_newslist.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '{#RP#}news/class/', 200, 200, 0, 0, 90, 10, 5, 'id|dtime|uptime|prop1|prop2|cl|xuhao', 'desc', 0, 12, '_self', 0, 50, -1, -1, '-1', '最新文章', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '-1', '0', 1, '_news_cat', '', '_news_proj', -1, 'hidden', 'content', 'block', 1, 0),
(12, 'news', 'modNewsContent', '文章正文', 'news', 'detail', 'tpl_newscontent.htm', '-1', '1000', '#dddddd', 1, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 630, 300, 30, 0, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '文章正文', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_news_cat', '', '', -1, 'visible', 'content', 'block', 0, 0),
(13, 'news', 'modNewsSearchForm', '文章搜索表单', 'news', 'all', 'tpl_news_searchform.htm', '-1', 'A500', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 650, 30, 0, 0, 90, 3, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '文章搜索', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_news_cat', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(20, 'news', 'modNewsComment', '文章点评', 'news', 'detail', 'tpl_news_comment.htm', '-1', '1000', '#dddddd', 1, 'solid', '', '', 'none', '', '', '#fff', 'http://', 630, 300, 300, 0, 90, 1, 5, '-1', '-1', -1, 20, '_self', -1, 120, -1, -1, '-1', '文章评论', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(55, 'news', 'modNewsNavPath', '当前位置提示条', 'news', 'all', 'tpl_navpath.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 650, 30, 0, 200, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '当前位置', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_news_cat', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(72, 'news', 'modNewsProject', '文章专题名称列表', 'all', 'all', 'tpl_newsproj.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', 'http://', 200, 200, 0, 0, 90, 12, -1, '-1', '-1', -1, 12, '_self', -1, -1, -1, -1, '-1', '最新专题', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(82, 'news', 'modNewsPic', '文章图片+标题', 'all', 'all', 'tpl_newspic.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', 'http://', 200, 300, 0, 0, 99, 5, 4, 'id|dtime|uptime|prop1|prop2|cl|xuhao', 'desc', 0, 6, '_self', 0, -1, 160, 120, 'fill', '图片新闻', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '-1', '0', 1, '_news_cat', '', '_news_proj', -1, 'hidden', 'content', 'block', 1, 0),
(88, 'news', 'modNewsHot', '文章人气榜', 'all', 'all', 'tpl_newshot.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '{#RP#}news/class/index.php?myord=cl', 200, 280, 0, 0, 90, 10, 10, '-1', '-1', 0, 12, '_self', 0, -1, -1, -1, '-1', '文章人气榜', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '-1', '0', 1, '_news_cat', '', '_news_proj', -1, 'hidden', 'content', 'block', 1, 0),
(112, 'news', 'modNewsFabu', '文章发布表单', 'member', 'newsfabu', 'tpl_news_fabu.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 700, 700, 0, 0, 99, 20, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '文章发布', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(113, 'news', 'modNewsGl', '文章管理', 'member', 'newsgl', 'tpl_news_gl.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 700, 700, 0, 0, 99, 5, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '文章管理', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(114, 'news', 'modNewsModify', '文章修改表单', 'member', 'newsmodify', 'tpl_news_modify.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 700, 700, 0, 0, 99, 20, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '文章修改', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(136, 'news', 'modNewsMyCat', '文章分类管理', 'member', 'newscat', 'tpl_news_mycat.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 700, 300, 0, 0, 99, 5, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '文章分类管理', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(149, 'news', 'modMemberNewsList', '会员最新文章', 'member', 'homepage', 'tpl_newslist.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '{#RP#}news/membernews.php?mid={#mid#}', 380, 170, 0, 0, 90, 10, 5, 'id|dtime|uptime|prop1|prop2|cl', 'desc', 0, 20, '_self', -1, -1, -1, -1, '-1', '我的文章', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(155, 'news', 'modMemberNewsClass', '会员文章分类', 'news', 'membernews', 'tpl_membernews_class.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 200, 180, 0, 0, 99, 12, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '文章分类', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(156, 'news', 'modMemberNewsQuery', '会员文章检索', 'news', 'membernews', 'tpl_newsquery.htm', '-1', 'A010', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 680, 300, 30, 220, 90, 10, 20, '-1', '-1', -1, 30, '_self', -1, -1, -1, -1, '-1', '会员文章', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(157, 'news', 'modMemberNewsSearchForm', '会员文章搜索', 'news', 'membernews', 'tpl_membernews_searchform.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 200, 175, 0, 0, 99, 15, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '文章搜索', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(58, 'page', 'modPageNavPath', '当前位置提示条', 'page', 'all', 'tpl_navpath.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 650, 30, 0, 200, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '当前位置', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(62, 'page', 'modPageContent', '网页内容详情', 'page', 'all', 'tpl_page_content.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 650, 350, 30, 220, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '内容标题', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(70, 'page', 'modPageTitleList', '网页标题(列表)', 'all', 'all', 'tpl_pagelist.htm', '-1', '1000', '#dddddd', 1, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', 'http://', 200, 300, 0, 0, 90, 10, 10, '-1', '-1', -1, 12, '_self', -1, -1, -1, -1, '-1', '内容标题列表', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '-1', 1, '', '_page_group', '', -1, 'hidden', 'content', 'block', 0, 0),
(71, 'page', 'modPageContentFy', '网页内容翻页', 'page', 'all', 'tpl_page_fy.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 650, 50, 30, 220, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '翻页', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(73, 'page', 'modPageTitleMenu', '网页标题(菜单)', 'all', 'all', 'tpl_page_titlemenu.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 200, 300, 0, 0, 90, 0, 10, '-1', '-1', -1, 12, '_self', -1, -1, -1, -1, '-1', '内容标题菜单', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '-1', 1, '', '_page_group', '', -1, 'hidden', 'content', 'block', 0, 0),
(29, 'search', 'modSearch', '全站搜索结果', 'search', 'search', 'tpl_search.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 900, 600, 30, 0, 90, 0, -1, '-1', '-1', -1, 30, '_self', -1, -1, -1, -1, '-1', '全站搜索', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(46, 'search', 'modSearchForm', '全站搜索表单', 'all', 'all', 'tpl_searchform.htm', '-1', 'A500', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 900, 30, 0, 0, 90, 3, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '全站搜索', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(59, 'search', 'modSearchNavPath', '当前位置提示条', 'search', 'all', 'tpl_navpath.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 650, 30, 0, 200, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '当前位置', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(28, 'tools', 'modShowCount', '访问统计', 'all', 'all', 'tpl_showcount.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 150, 30, 100, 300, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '访问统计', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_news_cat', '', '', 1, 'hidden', 'bottom', 'block', 0, 0),
(54, 'tools', 'modVote', '投票调查', 'all', 'all', 'tpl_vote.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 200, 250, 200, 200, 90, 5, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '投票调查', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '-1', 1, '', '_tools_pollindex', '', -1, 'hidden', 'content', 'block', 0, 0),
(169, 'news', 'modNewsHot30', '本月文章人气榜', 'all', 'all', 'tpl_newshot.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '{#RP#}news/class/index.php?myord=cl', 200, 280, 0, 0, 90, 10, 10, '-1', '-1', 0, 12, '_self', 0, -1, -1, -1, '-1', '本月人气榜', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '-1', '0', 1, '_news_cat', '', '_news_proj', -1, 'hidden', 'content', 'block', 1, 0),
(172, 'news', 'modNewsSameTagList', '相关文章(同标签)', 'news', 'detail', 'tpl_newslist.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', 'http://', 200, 200, 0, 0, 90, 12, 5, '-1', '-1', 0, 12, '_self', 0, -1, -1, -1, '-1', '相关文章', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_news_cat', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(176, 'diy', 'modDiyMovi', 'FLASH视频', 'all', 'all', 'tpl_diymovi.htm', '-1', '1000', '#dddddd', 1, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 300, 300, 0, 0, 99, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '视频', '-1', '-1', '-1', '-1', '请输入FLASH视频来源网址', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(175, 'advs', 'modLinkOpt', '下拉式友情链接', 'all', 'all', 'tpl_linkopt.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '{#RP#}advs/link/', 200, 50, 0, 0, 90, 10, 12, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '友情链接', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '-1', 1, '', '_advs_linkgroup', '', -1, 'hidden', 'content', 'block', 1, 0),
(204, 'member', 'modMemberRank3', '会员悬赏榜(积分三)', 'all', 'all', 'tpl_memberrank.htm', '-1', 'A001', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 200, 250, 0, 0, 99, 12, 10, '-1', '-1', -1, -1, '_self', -1, -1, -1, -1, '-1', '会员悬赏榜', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(205, 'member', 'modMemberRank4', '会员金币榜(积分四)', 'all', 'all', 'tpl_memberrank.htm', '-1', 'A001', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 200, 250, 0, 0, 99, 12, 10, '-1', '-1', -1, -1, '_self', -1, -1, -1, -1, '-1', '会员金币榜', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(206, 'member', 'modMemberRank5', '消费积分榜(积分五)', 'all', 'all', 'tpl_memberrank.htm', '-1', 'A001', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 200, 250, 0, 0, 99, 12, 10, '-1', '-1', -1, -1, '_self', -1, -1, -1, -1, '-1', '消费积分榜', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(207, 'member', 'modMemberTags', '会员推荐(标签)', 'all', 'all', 'tpl_membertags.htm', '-1', 'A001', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 200, 250, 0, 0, 99, 12, 2, '-1', '-1', -1, -1, '_self', -1, -1, 70, 70, '-1', '会员推荐', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0);
INSERT INTO `pwn_base_plusdefault` (`id`, `coltype`, `pluslable`, `plusname`, `plustype`, `pluslocat`, `tempname`, `tempcolor`, `showborder`, `bordercolor`, `borderwidth`, `borderstyle`, `borderlable`, `borderroll`, `showbar`, `barbg`, `barcolor`, `backgroundcolor`, `morelink`, `width`, `height`, `top`, `left`, `zindex`, `padding`, `shownums`, `ord`, `sc`, `showtj`, `cutword`, `target`, `catid`, `cutbody`, `picw`, `pich`, `fittype`, `title`, `body`, `pic`, `piclink`, `attach`, `movi`, `sourceurl`, `word`, `word1`, `word2`, `word3`, `word4`, `text`, `text1`, `code`, `link`, `link1`, `link2`, `link3`, `link4`, `tags`, `groupid`, `projid`, `moveable`, `classtbl`, `grouptbl`, `projtbl`, `setglobal`, `overflow`, `bodyzone`, `display`, `ifmul`, `ifrefresh`) VALUES
(203, 'member', 'modMemberRank2', '会员人气榜(积分二)', 'all', 'all', 'tpl_memberrank.htm', '-1', 'A001', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 200, 250, 0, 0, 99, 12, 10, '-1', '-1', -1, -1, '_self', -1, -1, -1, -1, '-1', '会员人气榜', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(202, 'member', 'modMemberRank1', '会员经验榜(积分一)', 'all', 'all', 'tpl_memberrank.htm', '-1', 'A001', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 200, 250, 0, 0, 99, 12, 10, '-1', '-1', -1, -1, '_self', -1, -1, -1, -1, '-1', '会员经验榜', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(182, 'diy', 'modWordTT', '标题+链接组', 'all', 'all', 'tpl_wordtt.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', 'http://', 300, 70, 0, 0, 99, 10, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '今日头条', '-1', '-1', '-1', '-1', '-1', '-1', '请输入头条标题文字', '自定义链接文字一', '自定义链接文字二', '自定义链接文字三', '自定义链接文字四', '-1', '-1', '-1', 'http://', 'http://', 'http://', 'http://', 'http://', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(183, 'diy', 'modWordText', '标题+介绍', 'all', 'all', 'tpl_wordtext.htm', '-1', '1000', '#dddddd', 1, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', 'http://', 300, 100, 0, 0, 99, 10, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '插件标题', '-1', '-1', '-1', '-1', '-1', '-1', '请输入标题文字', '-1', '-1', '-1', '-1', '请输入介绍文字', '-1', '-1', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(187, 'news', 'modNewsPicRollx3', '三图轮播特效', 'all', 'all', 'tpl_newspicrollx3.htm', 'A', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#dddddd', '#fff', '#fff', '-1', 700, 270, 0, 200, 99, 0, -1, '-1', '-1', 0, 12, '_self', 0, 25, -1, -1, '-1', '图片新闻', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '-1', '0', 1, '_news_cat', '', '_news_proj', -1, 'hidden', 'content', 'block', 0, 1),
(189, 'diy', 'modPicWords', '图片+标题组', 'all', 'all', 'tpl_picwordx5.htm', '-1', '1000', '#dddddd', 1, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', 'http://', 300, 120, 0, 0, 99, 5, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, 100, '-1', '自定图文', '-1', '', 'http://', '-1', '-1', '-1', '请输入标题', '请输入标题', '请输入标题', '请输入标题', '请输入标题', '-1', '-1', '-1', 'http://', 'http://', 'http://', 'http://', 'http://', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(190, 'effect', 'modButtonSource', '按钮素材', 'all', 'all', 'tpl_picsource.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 200, 80, 0, 0, 99, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '按钮素材', '-1', '-1', '-1', '-1', '-1', 'button/01.gif', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(191, 'effect', 'modIconSource', '图标素材', 'all', 'all', 'tpl_picsource.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 50, 50, 0, 0, 99, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '图标素材', '-1', '-1', '-1', '-1', '-1', 'icon/01.gif', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(193, 'effect', 'modSmallIcon', '小图标素材', 'all', 'all', 'tpl_smallicon.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 50, 50, 0, 0, 99, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '图标素材', '-1', '-1', '-1', '-1', '-1', 'smallicon/1.gif', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(198, 'effect', 'modBgSource', '背景图片素材', 'all', 'all', 'tpl_bgsource.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 100, 100, 0, 0, 99, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '背景素材', '-1', '-1', '-1', '-1', '-1', 'bg/1.gif', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(195, 'effect', 'modSourceCoolLine', '分割线装饰素材', 'all', 'all', 'tpl_picsource.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 300, 100, 0, 0, 99, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '分割线素材', '-1', '-1', '-1', '-1', '-1', 'coolline/1.png', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(196, 'effect', 'modCartonSource', '其他图片素材', 'all', 'all', 'tpl_picsource.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 200, 200, 0, 0, 99, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '卡通图片', '-1', '-1', '-1', '-1', '-1', 'carton/1.png', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(200, 'diy', 'modGroupLable', '标签切换边框', 'all', 'all', 'tpl_plusborder.htm', '-1', 'A201', '', 0, 'solid', '', '', 'none', '', '#fff', '#fff', 'http://', 300, 300, 0, 0, 0, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '自动标签', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(210, 'diy', 'modBgSound', '网页背景音乐(mid)', 'all', 'all', 'tpl_bgsound.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 100, 50, 350, 0, -1, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '背景音乐', '-1', '-1', '-1', '', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'bodyex', 'block', 0, 1),
(211, 'news', 'modNewsSameClass', '文章同级分类', 'news', 'query', 'tpl_newsclass.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 200, 200, 0, 0, 90, 12, -1, '-1', '-1', 0, -1, '_self', -1, -1, -1, -1, '-1', '文章分类', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(214, 'diy', 'modHeadPic', '头部自定义效果图', 'all', 'all', 'tpl_headpic.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 900, 150, 0, 0, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '图片', '-1', '', 'http://', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', 1, 'hidden', 'top', 'block', 0, 0),
(219, 'diy', 'modDiyTemp', '自定义模版', 'all', 'all', 'tpl_diy.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 300, 300, 0, 0, 99, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '自定模版', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(220, 'news', 'modNewsTwoClass', '文章二级分类', 'all', 'all', 'tpl_newstwoclass.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 200, 300, 0, 0, 90, 12, -1, '-1', '-1', 0, -1, '_self', 0, -1, -1, -1, '-1', '文章分类', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_news_cat', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(494, 'product', 'modProductGlobalQuery', '全站翻页产品列表', 'all', 'all', 'tpl_product_query.htm', '-1', 'A001', '', 1, 'solid', '', '', 'block', '', '', '#fff', '-1', 650, 350, 0, 0, 90, 15, 10, 'id|dtime|uptime|prop1|prop2|cl', 'desc', 0, 12, '_self', 0, 50, 180, 160, 'fill', '最新产品', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '-1', '0', 1, '_product_cat', '', '_product_proj', -1, 'visible', 'content', 'block', 0, 0),
(493, 'product', 'modProductTwoClass', '产品二级分类', 'all', 'all', 'tpl_producttwoclass.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 200, 300, 0, 0, 90, 12, -1, '-1', '-1', 0, -1, '_self', 0, -1, -1, -1, '-1', '产品分类', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_product_cat', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(492, 'product', 'modProductCarousel', '产品图片旋转特效', 'all', 'all', 'tpl_productcarousel_cyrano.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#dddddd', '#fff', '#fff', '-1', 600, 225, 0, 200, 99, 0, -1, '-1', '-1', 0, -1, '_self', 0, -1, 180, 180, '-1', '产品图片特效', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '-1', '0', 1, '_product_cat', '', '_product_proj', -1, 'hidden', 'content', 'block', 0, 1),
(491, 'product', 'modProductSameClass', '产品同级分类', 'product', 'query', 'tpl_productclass.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 200, 200, 0, 0, 90, 12, -1, '-1', '-1', 0, -1, '_self', -1, -1, -1, -1, '-1', '产品分类', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(490, 'product', 'modProductRollx3', '产品三图轮播特效', 'all', 'all', 'tpl_productrollx3.htm', 'A', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#dddddd', '#fff', '#fff', '-1', 700, 270, 0, 200, 99, 0, -1, '-1', '-1', 0, 12, '_self', 0, 25, -1, -1, '-1', '产品图片特效', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '-1', '0', 1, '_product_cat', '', '_product_proj', -1, 'hidden', 'content', 'block', 0, 1),
(489, 'product', 'modProductSameTagList', '相关产品(同标签)', 'product', 'detail', 'tpl_productpic.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', 'http://', 200, 300, 0, 0, 90, 10, 6, '-1', '-1', 0, 12, '_self', 0, -1, 100, 100, 'fill', '相关产品', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_product_cat', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(488, 'product', 'modProductAuthorList', '相关产品(同发布人)', 'product', 'detail', 'tpl_productpic.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', 'http://', 200, 300, 0, 0, 90, 10, 6, '-1', '-1', 0, 12, '_self', 0, -1, 100, 100, 'fill', '相关产品', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_product_cat', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(487, 'product', 'modMemberProductSearchForm', '会员产品搜索', 'product', 'memberproduct', 'tpl_memberproduct_searchform.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 200, 175, 0, 0, 99, 15, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '产品搜索', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(486, 'product', 'modMemberProductQuery', '会员产品检索', 'product', 'memberproduct', 'tpl_product_query.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 650, 350, 0, 220, 99, 0, 20, '-1', '-1', -1, -1, '-1', -1, -1, 120, 120, 'fill', '产品检索', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 1),
(485, 'product', 'modMemberProductClass', '会员产品分类', 'product', 'memberproduct', 'tpl_memberproduct_class.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 200, 200, 0, 0, 99, 12, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '产品分类', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(484, 'product', 'modMemberProductPic', '会员最新产品', 'member', 'homepage', 'tpl_productpic.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '{#RP#}product/memberproduct.php?mid={#mid#}', 500, 200, 0, 0, 90, 10, 10, 'id|dtime|uptime|prop1|prop2|cl', 'desc', 0, 7, '_self', -1, -1, 120, 120, 'fill', '我的产品', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(483, 'product', 'modProductMyCat', '产品分类管理', 'member', 'productcat', 'tpl_product_mycat.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 700, 300, 0, 0, 99, 5, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '产品分类管理', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(482, 'product', 'modProductModify', '产品修改表单', 'member', 'productmodify', 'tpl_product_modify.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 700, 700, 0, 0, 99, 20, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '产品修改', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(481, 'product', 'modProductGl', '产品管理', 'member', 'productgl', 'tpl_product_gl.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 700, 700, 0, 0, 99, 5, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '产品管理', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(480, 'product', 'modProductFabu', '产品发布表单', 'member', 'productfabu', 'tpl_product_fabu.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 700, 700, 0, 0, 99, 20, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '产品发布', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(479, 'product', 'modProductComment', '产品点评', 'product', 'detail', 'tpl_product_comment.htm', '-1', '1000', '#dddddd', 1, 'solid', '', '', 'none', '', '', '#fff', 'http://', 650, 350, 350, 0, 90, 1, 5, '-1', '-1', -1, 20, '_self', -1, 120, -1, -1, '-1', '产品评论', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(478, 'product', 'modProductClassFc', '产品逐级分类', 'product', 'query', 'tpl_productclass.htm', '-1', 'A001', '', 0, 'solid', '', '', 'none', '', '#fff', '#fff', '-1', 200, 200, 0, 0, 90, 12, 99, '-1', '-1', 0, -1, '_self', -1, -1, -1, -1, '-1', '产品分类', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(477, 'product', 'modProductProjList', '相关产品(同专题)', 'product', 'detail', 'tpl_productpic.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', 'http://', 200, 300, 0, 0, 90, 10, 6, '-1', '-1', 0, 12, '_self', 0, -1, 100, 100, 'fill', '相关产品', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_product_cat', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(476, 'product', 'modProductProject', '产品专题（列表）', 'all', 'all', 'tpl_productproj.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', 'http://', 200, 200, 0, 0, 90, 12, -1, '-1', '-1', -1, 12, '_self', -1, -1, -1, -1, '-1', '最新专题', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(475, 'product', 'modProductNavPath', '当前位置提示条', 'product', 'all', 'tpl_navpath.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 650, 30, 0, 200, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '当前位置', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_product_cat', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(246, 'menu', 'modVMenu', '竖式导航菜单', 'all', 'all', 'tpl_vmenu.htm', 'A', '1000', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 200, 300, 0, 0, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '导航菜单', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '-1', 1, '', '_menu_group', '', 1, 'hidden', 'content', 'block', 0, 0),
(247, 'menu', 'modMVMenu', '手风琴式二级菜单', 'all', 'all', 'tpl_mvmenu.htm', 'A', '1000', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 180, 200, 0, 0, 99, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '导航菜单', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '-1', 1, '', '_menu_group', '', -1, 'visible', 'content', 'block', 0, 1),
(439, 'news', 'modNewsPicLb', '文章图片轮播', 'all', 'all', 'tpl_newspiclb_dolphin.htm', '-1', '1000', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', 'http://', 400, 300, 0, 0, 99, 5, 4, 'id|dtime|uptime|prop1|prop2|cl|xuhao', 'desc', 0, -1, '_self', 0, -1, 160, 120, '-1', '图片新闻', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '-1', '0', 1, '_news_cat', '', '_news_proj', -1, 'hidden', 'content', 'block', 1, 0),
(256, 'photo', 'modPhotoQuery', '图片检索搜索', 'photo', 'query', 'tpl_photo_query.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 680, 500, 30, 200, 90, 5, 20, '-1', '-1', -1, 30, '_self', -1, -1, 120, 120, 'fill', '图片检索', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_photo_cat', '', '', -1, 'visible', 'content', 'block', 0, 1),
(257, 'photo', 'modPhotoContent', '图片详情', 'photo', 'detail', 'tpl_photo_content.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 650, 300, 30, 0, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '图片详情', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_photo_cat', '', '', -1, 'visible', 'content', 'block', 0, 0),
(258, 'photo', 'modPhotoClass', '图片分类（列表）', 'all', 'all', 'tpl_photoclass.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 200, 200, 0, 0, 90, 12, -1, '-1', '-1', 0, -1, '_self', 0, -1, -1, -1, '-1', '图片分类', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_photo_cat', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(259, 'photo', 'modPhotoPic', '图片+名称', 'all', 'all', 'tpl_photopic.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '{#RP#}photo/class/', 620, 200, 0, 0, 90, 10, 5, 'id|dtime|uptime|prop1|prop2|cl', 'desc', 0, 12, '_self', 0, -1, 100, 100, 'fill', '最新图片', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '-1', '0', 1, '_photo_cat', '', '_photo_proj', -1, 'hidden', 'content', 'block', 1, 0),
(260, 'photo', 'modPhotoSearchForm', '图片搜索表单', 'photo', 'all', 'tpl_photo_searchform.htm', '-1', 'A500', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 650, 30, 0, 200, 90, 3, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '图片搜索', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_photo_cat', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(261, 'photo', 'modPhotoNavPath', '当前位置提示条', 'photo', 'all', 'tpl_navpath.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 650, 30, 0, 200, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '当前位置', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_photo_cat', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(262, 'photo', 'modPhotoProject', '图片专题（列表）', 'all', 'all', 'tpl_photoproj.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', 'http://', 200, 200, 0, 0, 90, 12, -1, '-1', '-1', -1, 12, '_self', -1, -1, -1, -1, '-1', '最新专题', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(263, 'photo', 'modPhotoProjList', '相关图片(同专题)', 'photo', 'detail', 'tpl_photopic.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', 'http://', 200, 300, 0, 0, 90, 10, 6, '-1', '-1', 0, 12, '_self', 0, -1, 100, 100, 'fill', '相关图片', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_photo_cat', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(264, 'photo', 'modPhotoClassFc', '图片逐级分类', 'photo', 'query', 'tpl_photoclass.htm', '-1', 'A001', '', 0, 'solid', '', '', 'none', '', '#fff', '#fff', '-1', 200, 200, 0, 0, 90, 12, 99, '-1', '-1', 0, -1, '_self', -1, -1, -1, -1, '-1', '图片分类', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(265, 'photo', 'modPhotoHot', '图片人气榜', 'all', 'all', 'tpl_photohot.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '{#RP#}photo/class/index.php?myord=cl', 200, 280, 0, 0, 90, 10, 10, '-1', '-1', 0, 12, '_self', 0, -1, -1, -1, '-1', '图片人气榜', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '-1', '0', 1, '_photo_cat', '', '_photo_proj', -1, 'hidden', 'content', 'block', 1, 0),
(266, 'photo', 'modPhotoComment', '图片点评', 'photo', 'detail', 'tpl_photo_comment.htm', '-1', '1000', '#dddddd', 1, 'solid', '', '', 'none', '', '', '#fff', 'http://', 650, 350, 350, 0, 90, 1, 5, '-1', '-1', -1, 20, '_self', -1, 120, -1, -1, '-1', '图片评论', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(267, 'photo', 'modPhotoFabu', '图片发布表单', 'member', 'photofabu', 'tpl_photo_fabu.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 700, 700, 0, 0, 99, 20, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '图片发布', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(268, 'photo', 'modPhotoGl', '图片管理', 'member', 'photogl', 'tpl_photo_gl.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 700, 700, 0, 0, 99, 5, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '图片管理', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(269, 'photo', 'modPhotoModify', '图片修改表单', 'member', 'photomodify', 'tpl_photo_modify.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 700, 700, 0, 0, 99, 20, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '图片修改', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(270, 'photo', 'modPhotoMyCat', '图片分类管理', 'member', 'photocat', 'tpl_photo_mycat.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 700, 300, 0, 0, 99, 5, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '图片分类管理', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(271, 'photo', 'modMemberPhotoPic', '会员最新图片', 'member', 'homepage', 'tpl_photopic.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '{#RP#}photo/memberphoto.php?mid={#mid#}', 500, 200, 0, 0, 90, 10, 10, 'id|dtime|uptime|prop1|prop2|cl', 'desc', 0, 7, '_self', -1, -1, 120, 120, 'fill', '我的图片', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(272, 'photo', 'modMemberPhotoClass', '会员图片分类', 'photo', 'memberphoto', 'tpl_memberphoto_class.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 200, 200, 0, 0, 99, 12, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '图片分类', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(273, 'photo', 'modMemberPhotoQuery', '会员图片检索', 'photo', 'memberphoto', 'tpl_photo_query.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 650, 350, 0, 220, 99, 0, 20, '-1', '-1', -1, -1, '-1', -1, -1, 120, 120, 'fill', '图片检索', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 1),
(274, 'photo', 'modMemberPhotoSearchForm', '会员图片搜索', 'photo', 'memberphoto', 'tpl_memberphoto_searchform.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 200, 175, 0, 0, 99, 15, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '图片搜索', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(275, 'photo', 'modPhotoHot30', '本月图片人气榜', 'all', 'all', 'tpl_photohot.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '{#RP#}photo/class/index.php?myord=cl', 200, 280, 0, 0, 90, 10, 10, '-1', '-1', 0, 12, '_self', 0, -1, -1, -1, '-1', '本月人气榜', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '-1', '0', 1, '_photo_cat', '', '_photo_proj', -1, 'hidden', 'content', 'block', 1, 0),
(276, 'photo', 'modPhotoAuthorList', '相关图片(同发布人)', 'photo', 'detail', 'tpl_photopic.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', 'http://', 200, 300, 0, 0, 90, 10, 6, '-1', '-1', 0, 12, '_self', 0, -1, 100, 100, 'fill', '相关图片', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_photo_cat', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(277, 'photo', 'modPhotoSameTagList', '相关图片(同标签)', 'photo', 'detail', 'tpl_photopic.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', 'http://', 200, 300, 0, 0, 90, 10, 6, '-1', '-1', 0, 12, '_self', 0, -1, 100, 100, 'fill', '相关图片', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_photo_cat', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(278, 'photo', 'modPhotoPicMemo', '图片+名称+介绍', 'all', 'all', 'tpl_photopicmemo.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '{#RP#}photo/class/', 300, 350, 0, 0, 90, 10, 3, 'id|dtime|uptime|prop1|prop2|cl', 'desc', 0, 12, '_self', 0, 30, 80, 80, 'fill', '最新图片', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '-1', '0', 1, '_photo_cat', '', '_photo_proj', -1, 'hidden', 'content', 'block', 1, 0),
(279, 'photo', 'modPhotoRollx3', '三图轮播特效', 'all', 'all', 'tpl_photorollx3.htm', 'A', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#dddddd', '#fff', '#fff', '-1', 700, 270, 0, 200, 99, 0, -1, '-1', '-1', 0, 12, '_self', 0, 25, -1, -1, '-1', '图片特效', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '-1', '0', 1, '_photo_cat', '', '_photo_proj', -1, 'hidden', 'content', 'block', 0, 1),
(280, 'photo', 'modPhotoSameClass', '图片同级分类', 'photo', 'query', 'tpl_photoclass.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 200, 200, 0, 0, 90, 12, -1, '-1', '-1', 0, -1, '_self', -1, -1, -1, -1, '-1', '图片分类', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(281, 'photo', 'modPhotoCarousel', '图片旋转显示特效', 'all', 'all', 'tpl_photocarousel_cyrano.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#dddddd', '#fff', '#fff', '-1', 140, 225, 0, 200, 99, 0, -1, '-1', '-1', 0, -1, '_self', 0, -1, -1, -1, '-1', '图片特效', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '-1', '0', 1, '_photo_cat', '', '_photo_proj', -1, 'hidden', 'content', 'block', 0, 1),
(282, 'photo', 'modPhotoTwoClass', '图片二级分类', 'all', 'all', 'tpl_phototwoclass.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 200, 300, 0, 0, 90, 12, -1, '-1', '-1', 0, -1, '_self', 0, -1, -1, -1, '-1', '图片分类', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_photo_cat', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(325, 'job', 'modJobSearchForm', '职位搜索表单', 'job', 'all', 'tpl_job_searchform.htm', '-1', 'A500', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 650, 30, 0, 0, 90, 3, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '职位搜索', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(324, 'job', 'modJobContent', '职位信息详情', 'job', 'detail', 'tpl_jobcontent.htm', '-1', '1000', '#dddddd', 1, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 630, 300, 30, 0, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '职位信息', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(323, 'job', 'modJobList', '最新职位列表', 'all', 'all', 'tpl_joblist.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '{#RP#}job/', 200, 200, 0, 0, 90, 12, 5, '-1', '-1', -1, 12, '_self', -1, -1, -1, -1, '-1', '最新职位', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(322, 'job', 'modJobQuery', '职位翻页检索', 'all', 'all', 'tpl_jobquery.htm', '-1', 'A001', '', 0, 'solid', '', '', 'none', '', '', '#ffffff', '-1', 650, 350, 0, 0, 90, 15, 10, '-1', '-1', -1, 30, '_self', -1, 100, -1, -1, '-1', '职位查询', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(314, 'page', 'modPagePicList', '标题+摘要+主题图', 'all', 'all', 'tpl_page_piclist.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 650, 300, 0, 0, 90, 0, 10, '-1', '-1', -1, 15, '_self', -1, 50, 120, 90, 'fill', '', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '-1', 1, '', '_page_group', '', -1, 'hidden', 'content', 'block', 0, 0),
(315, 'news', 'modNewsGlobalQuery', '全站翻页文章列表', 'all', 'all', 'tpl_newsquery.htm', '-1', 'A001', '', 1, 'solid', '', '', 'block', '', '', '#fff', '-1', 650, 350, 0, 0, 90, 15, 10, 'id|dtime|uptime|prop1|prop2|cl|xuhao', 'desc', 0, 20, '_self', 0, 50, -1, -1, '-1', '最新文章', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '-1', '0', 1, '_news_cat', '', '_news_proj', -1, 'visible', 'content', 'block', 0, 0),
(474, 'product', 'modProductSearchForm', '产品搜索表单', 'product', 'all', 'tpl_product_searchform.htm', '-1', 'A500', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 650, 30, 0, 200, 90, 3, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '产品搜索', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_product_cat', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(473, 'product', 'modProductList', '自选产品列表', 'all', 'all', 'tpl_productlist.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '{#RP#}product/class/', 300, 350, 0, 0, 90, 10, 5, 'id|dtime|uptime|prop1|prop2|cl', 'desc', 0, 12, '_self', 0, 30, 80, 80, 'fill', '最新产品', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '-1', '0', 1, '_product_cat', '', '_product_proj', -1, 'hidden', 'content', 'block', 1, 0),
(318, 'photo', 'modPhotoGlobalQuery', '全站翻页图片列表', 'all', 'all', 'tpl_photo_query.htm', '-1', 'A001', '', 1, 'solid', '', '', 'block', '', '', '#fff', '-1', 650, 350, 0, 0, 90, 15, 10, 'id|dtime|uptime|prop1|prop2|cl', 'desc', 0, 12, '_self', 0, -1, 180, 160, 'fill', '最新图片', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '', '-1', '0', 1, '_photo_cat', '', '_photo_proj', -1, 'visible', 'content', 'block', 0, 0),
(326, 'job', 'modJobNavPath', '当前位置提示条', 'job', 'all', 'tpl_navpath.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 650, 30, 0, 200, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '当前位置', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(327, 'job', 'modJobForm', '应聘申请表单', 'job', 'detail', 'tpl_job_form.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#f5f5f5', '#505050', '#fff', '-1', 650, 500, 0, 0, 99, 20, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '应聘申请', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(328, 'tools', 'modToolsPhotoPollQuery', '图片投票翻页检索', 'all', 'all', 'tpl_tools_photopoll_query.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 680, 500, 30, 200, 90, 5, 20, 'id|uptime|votes', '-1', -1, 30, '-1', 0, -1, 80, 80, 'fill', '图片投票检索', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_tools_photopollindex', '', '', -1, 'visible', 'content', 'block', 0, 1),
(329, 'tools', 'modToolsQqCs', 'QQ客服', 'all', 'all', 'tpl_tools_qqcs.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 120, 300, 100, 20, 90, 0, -1, '-1', '-1', 0, -1, '-1', -1, -1, -1, -1, '-1', 'QQ客服', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', 1, 'hidden', 'content', 'block', 0, 0),
(330, 'tools', 'modToolsWyCs', '51客服', 'all', 'all', 'tpl_tools_wycs.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 300, 120, 100, 0, 90, 0, -1, '-1', '-1', 0, -1, '-1', -1, -1, -1, -1, '-1', '51客服', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', 1, 'hidden', 'content', 'block', 0, 0),
(331, 'tools', 'modToolsStatistics', '统计代码插件', 'all', 'all', 'tpl_tools_statistics.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 30, 30, 50, 400, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '统计代码', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'bottom', 'block', 0, 0),
(332, 'tools', 'modToolsYdCs', '移动短信留言', 'all', 'all', 'tpl_tools_ydcs.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 400, 350, 100, 0, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '移动短信留言板', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', 1, 'hidden', 'content', 'block', 0, 0),
(333, 'member', 'modMemberPayList', '会员付款记录', 'member', 'paylist', 'tpl_member_paylist.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 700, 300, 0, 0, 99, 5, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '付款记录', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(334, 'member', 'modMemberBuyList', '会员消费记录', 'member', 'buylist', 'tpl_member_buylist.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 700, 300, 0, 0, 99, 5, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '消费记录', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(335, 'diy', 'modDiyHeadTraFlash', '头部自定义透明FLASH', 'all', 'all', 'tpl_diyheadtraflash.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 900, 150, 0, 0, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '', '-1', '', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', 1, 'hidden', 'top', 'block', 0, 0),
(336, 'diy', 'modHeadTraFlashCyrano', '自定义透明FLASH', 'all', 'all', 'tpl_headtraflash_cyrano.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 900, 150, 0, 0, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '', '-1', '', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', 1, 'hidden', 'top', 'block', 0, 0),
(338, 'effect', 'modSetHomePageCyrano', '设为首页加入收藏', 'all', 'all', 'tpl_sethomepage_cyrano.htm', '-1', '1000', '#dddddd', 1, 'solid', '', '', 'none', '#cccccc', '#fff', '', '-1', 150, 50, 30, 700, 90, 5, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '设为首页加入收藏', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', 1, 'hidden', 'top', 'block', 0, 0),
(373, 'advs', 'modAdvsHeadLb', '头部图片轮播', 'all', 'all', 'tpl_advsheadlb.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 900, 200, 0, 0, 90, 0, 5, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '-1', 1, '', '_advs_lbgroup', '', 1, 'hidden', 'top', 'block', 0, 1),
(472, 'product', 'modProductClass', '产品分类（列表）', 'all', 'all', 'tpl_productclass.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 200, 200, 0, 0, 90, 12, -1, '-1', '-1', 0, -1, '_self', 0, -1, -1, -1, '-1', '产品分类', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_product_cat', '', '', -1, 'hidden', 'content', 'block', 1, 0),
(442, 'feedback', 'modFeedBackSmallForm', '全站留言表单', 'all', 'all', 'tpl_feedback_smallform.htm', '-1', 'A001', '', 1, 'solid', '', '', 'none', '', '', '', '-1', 650, 500, 0, 0, 90, 10, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '给我留言', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '-1', 1, '', '_feedback_group', '', 1, 'hidden', 'content', 'block', 0, 0),
(441, 'feedback', 'modFeedBackForm', '留言反馈表单', 'feedback', 'all', 'tpl_feedback_form.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 650, 500, 50, 220, 90, 20, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '留言反馈', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '-1', 1, '', '_feedback_group', '', -1, 'visible', 'content', 'block', 0, 0),
(440, 'feedback', 'modFeedBackNavPath', '当前位置提示条', 'feedback', 'all', 'tpl_navpath.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 650, 30, 0, 200, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '当前位置', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'hidden', 'content', 'block', 0, 0),
(471, 'product', 'modProductContent', '产品详情', 'product', 'detail', 'tpl_product_content.htm', '-1', '1000', '', 0, 'solid', '', '', 'none', '', '', '', '-1', 650, 300, 30, 0, 90, 0, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '产品详情', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_product_cat', '', '', -1, 'visible', 'content', 'block', 0, 0),
(470, 'product', 'modProductQuery', '产品检索搜索', 'product', 'query', 'tpl_product_query.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 680, 500, 30, 200, 90, 5, 20, '-1', '-1', -1, 30, '_self', -1, 30, 120, 120, 'fill', '产品检索', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '_product_cat', '', '', -1, 'visible', 'content', 'block', 0, 1),
(433, 'member', 'modMemberOnlinePay', '帐户在线充值', 'member', 'onlinepay', 'tpl_member_onlinepay.htm', '-1', 'A001', '#dddddd', 1, 'solid', '', '', 'block', '#cccccc', '#fff', '#fff', '-1', 700, 300, 0, 0, 99, 5, -1, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '帐户在线充值', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', 1, '', '', '', -1, 'visible', 'content', 'block', 0, 0),
(438, 'advs', 'modClassicAdvsLb', '经典图片轮播广告', 'all', 'all', 'tpl_advslb_classic.htm', '-1', '1000', '#dddddd', 0, 'solid', '', '', 'none', '#cccccc', '#fff', '#fff', '-1', 320, 280, 0, 0, 90, 0, 5, '-1', '-1', -1, -1, '-1', -1, -1, -1, -1, '-1', '轮播广告', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '-1', '1', '-1', 1, '', '_advs_lbgroup', '', -1, 'hidden', 'content', 'block', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_base_plusplan`
--

CREATE TABLE IF NOT EXISTS `pwn_base_plusplan` (
  `id` int(12) NOT NULL auto_increment,
  `planid` int(6) NOT NULL default '0',
  `coltype` varchar(30) NOT NULL,
  `pluslable` varchar(100) default '0',
  `plusname` varchar(50) NOT NULL,
  `plustype` varchar(50) default '0',
  `pluslocat` varchar(50) default '0',
  `tempname` varchar(100) NOT NULL default '0',
  `tempcolor` varchar(2) NOT NULL,
  `showborder` char(20) NOT NULL default '0',
  `bordercolor` varchar(7) NOT NULL default '#dddddd',
  `borderwidth` int(2) NOT NULL default '1',
  `borderstyle` varchar(10) NOT NULL default 'solid',
  `borderlable` varchar(150) NOT NULL,
  `borderroll` varchar(10) NOT NULL,
  `showbar` varchar(10) NOT NULL default 'none',
  `barbg` varchar(10) NOT NULL default '#cccccc',
  `barcolor` varchar(10) NOT NULL default '#ffffff',
  `backgroundcolor` varchar(7) NOT NULL default '#ffffff',
  `morelink` varchar(100) NOT NULL default 'http://',
  `width` int(5) NOT NULL default '100',
  `height` int(5) NOT NULL default '100',
  `top` int(5) NOT NULL default '0',
  `left` int(5) NOT NULL default '0',
  `zindex` int(2) NOT NULL default '99',
  `padding` int(11) NOT NULL default '0',
  `shownums` int(10) NOT NULL default '0',
  `ord` varchar(100) NOT NULL default 'id',
  `sc` varchar(10) NOT NULL default 'desc',
  `showtj` int(5) NOT NULL default '0',
  `cutword` int(20) default '0',
  `target` varchar(30) default '0',
  `catid` int(100) NOT NULL default '0',
  `cutbody` int(5) NOT NULL default '0',
  `picw` int(3) NOT NULL default '100',
  `pich` int(3) NOT NULL default '100',
  `fittype` char(10) NOT NULL default 'fill',
  `title` varchar(100) NOT NULL,
  `body` text,
  `pic` varchar(255) NOT NULL,
  `piclink` char(255) NOT NULL default '-1',
  `attach` varchar(255) NOT NULL,
  `movi` varchar(255) NOT NULL,
  `sourceurl` varchar(30) NOT NULL,
  `word` char(255) NOT NULL,
  `word1` char(255) NOT NULL,
  `word2` char(255) NOT NULL,
  `word3` char(255) NOT NULL default '',
  `word4` char(255) NOT NULL default '',
  `text` text NOT NULL,
  `text1` text NOT NULL,
  `code` text NOT NULL,
  `link` varchar(255) NOT NULL,
  `link1` char(255) NOT NULL default '',
  `link2` char(255) NOT NULL default '',
  `link3` char(255) NOT NULL,
  `link4` char(255) NOT NULL,
  `tags` char(30) NOT NULL,
  `groupid` varchar(20) NOT NULL default '',
  `projid` varchar(20) NOT NULL default '',
  `modno` int(3) NOT NULL default '0',
  `setglobal` int(5) NOT NULL default '0',
  `overflow` varchar(20) NOT NULL default 'hidden',
  `bodyzone` varchar(10) NOT NULL default 'content',
  `display` char(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5454 ;

--
-- 转存表中的数据 `pwn_base_plusplan`
--


-- --------------------------------------------------------

--
-- 表的结构 `pwn_base_plusplanid`
--

CREATE TABLE IF NOT EXISTS `pwn_base_plusplanid` (
  `id` int(6) NOT NULL auto_increment,
  `planname` varchar(50) NOT NULL default '',
  `plustype` varchar(50) NOT NULL default '',
  `pluslocat` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=443 ;

--
-- 转存表中的数据 `pwn_base_plusplanid`
--


-- --------------------------------------------------------

--
-- 表的结构 `pwn_base_plustemp`
--

CREATE TABLE IF NOT EXISTS `pwn_base_plustemp` (
  `id` int(12) NOT NULL auto_increment,
  `pluslable` char(30) NOT NULL default '',
  `cname` char(30) NOT NULL,
  `tempname` char(30) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=503 ;

--
-- 转存表中的数据 `pwn_base_plustemp`
--

INSERT INTO `pwn_base_plustemp` (`id`, `pluslable`, `cname`, `tempname`) VALUES
(201, 'modLoginForm', '横式会员登录表单，请选用专用边框(如500号边框)', 'tpl_loginform_h.htm'),
(67, 'modMemberNewsList', '标题+时间', 'tpl_newslist_time.htm'),
(68, 'modMemberNewsList', '标题+摘要', 'tpl_newslist_memo.htm'),
(87, 'modMemberNewsQuery', '文章翻页检索,标题+摘要', 'tpl_newsquery_memo.htm'),
(88, 'modMemberNewsQuery', '文章翻页检索,标题+时间,带表头', 'tpl_newsquery_cap.htm'),
(89, 'modNewsAuthorList', '标题+时间', 'tpl_newslist_time.htm'),
(90, 'modNewsAuthorList', '类别+标题', 'tpl_newslist_cat.htm'),
(91, 'modNewsAuthorList', '标题+摘要', 'tpl_newslist_memo.htm'),
(92, 'modNewsAuthorList', '标题+作者', 'tpl_newslist_author.htm'),
(103, 'modNewsContent', '仿新闻门户正文风格', 'tpl_newscontent_portal.htm'),
(16, 'modNewsHot', '标题+图标风格2', 'tpl_newshot2.htm'),
(58, 'modNewsHot', '标题+时间', 'tpl_newshot_time.htm'),
(59, 'modNewsHot', '标题+作者', 'tpl_newshot_author.htm'),
(60, 'modNewsHot', '标题+图标风格3', 'tpl_newshot3.htm'),
(61, 'modNewsHot', '标题+图标风格4', 'tpl_newshot4.htm'),
(102, 'modNewsHot', '标题+点击数', 'tpl_newshot_cl.htm'),
(62, 'modNewsHot30', '标题+图标风格2', 'tpl_newshot2.htm'),
(63, 'modNewsHot30', '标题+时间', 'tpl_newshot_time.htm'),
(64, 'modNewsHot30', '标题+作者', 'tpl_newshot_author.htm'),
(65, 'modNewsHot30', '标题+图标风格3', 'tpl_newshot3.htm'),
(66, 'modNewsHot30', '标题+图标风格4', 'tpl_newshot4.htm'),
(101, 'modNewsHot30', '标题+点击数', 'tpl_newshot_cl.htm'),
(2, 'modNewsList', '标题+时间', 'tpl_newslist_time.htm'),
(3, 'modNewsList', '类别+标题', 'tpl_newslist_cat.htm'),
(57, 'modNewsList', '标题+参数列1,2,3', 'tpl_newslist_prop3.htm'),
(56, 'modNewsList', '标题+参数列1,2', 'tpl_newslist_prop2.htm'),
(55, 'modNewsList', '标题+参数列1', 'tpl_newslist_prop1.htm'),
(42, 'modNewsList', '标题+摘要', 'tpl_newslist_memo.htm'),
(41, 'modNewsList', '标题+作者', 'tpl_newslist_author.htm'),
(198, 'modNewsPicMemo', '图片+标题+两个参数列', 'tpl_newspicprop_2.htm'),
(84, 'modNewsPicMemo', '图片+标题+三个参数列', 'tpl_newspicprop.htm'),
(93, 'modNewsProjList', '标题+时间', 'tpl_newslist_time.htm'),
(94, 'modNewsProjList', '类别+标题', 'tpl_newslist_cat.htm'),
(95, 'modNewsProjList', '标题+摘要', 'tpl_newslist_memo.htm'),
(96, 'modNewsProjList', '标题+作者', 'tpl_newslist_author.htm'),
(10, 'modNewsQuery', '文章翻页检索,标题+摘要', 'tpl_newsquery_memo.htm'),
(86, 'modNewsQuery', '文章翻页检索,标题+时间,带表头', 'tpl_newsquery_cap.htm'),
(97, 'modNewsSameTagList', '标题+时间', 'tpl_newslist_time.htm'),
(98, 'modNewsSameTagList', '类别+标题', 'tpl_newslist_cat.htm'),
(99, 'modNewsSameTagList', '标题+摘要', 'tpl_newslist_memo.htm'),
(100, 'modNewsSameTagList', '标题+作者', 'tpl_newslist_author.htm'),
(277, 'modText', '白色文字', 'tpl_text_2.htm'),
(48, 'modPicWords', '图片+四行标题', 'tpl_picwordx4.htm'),
(46, 'modPicWords', '图片+两行标题', 'tpl_picwordx2.htm'),
(49, 'modPicWords', '图片+三行标题', 'tpl_picwordx3.htm'),
(18, 'modText', '从右到左竖写', 'tpl_text_1.htm'),
(45, 'modWordTT', '标题+4组链接', 'tpl_wordttx4.htm'),
(44, 'modWordTT', '标题+3组链接', 'tpl_wordttx3.htm'),
(43, 'modWordTT', '标题+2组链接', 'tpl_wordttx2.htm'),
(202, 'modNewsSearchForm', '竖式搜索表单', 'tpl_news_searchform_h.htm'),
(205, 'modCommentSearchForm', '竖式搜索表单', 'tpl_comment_searchform_h.htm'),
(206, 'modSearchForm', '竖式搜索表单', 'tpl_searchform_h.htm'),
(207, 'modButtomInfo', '灰色渐变背景', 'tpl_bottominfo_1.htm'),
(208, 'modMemberTags', '头像+三组积分+推荐标签3', 'tpl_membertags_1.htm'),
(209, 'modMemberTags', '头像+推荐标签3', 'tpl_membertags_2.htm'),
(210, 'modMemberRank1', '小头像+昵称+积分', 'tpl_memberrank_head.htm'),
(211, 'modMemberRank2', '小头像+昵称+积分', 'tpl_memberrank_head.htm'),
(212, 'modMemberRank3', '小头像+昵称+积分', 'tpl_memberrank_head.htm'),
(213, 'modMemberRank4', '小头像+昵称+积分', 'tpl_memberrank_head.htm'),
(214, 'modMemberRank5', '小头像+昵称+积分', 'tpl_memberrank_head.htm'),
(215, 'modHeadTraFlash', '移动竖条', 'tpl_flash2.htm'),
(216, 'modHeadTraFlash', '光球光芒时隐时现', 'tpl_flash3.htm'),
(217, 'modHeadTraFlash', '米字星光', 'tpl_flash4.htm'),
(221, 'modBgSound', '显示播放器', 'tpl_bgsound_show.htm'),
(222, 'modFormGroup', '列表式', 'tpl_formgroup_list.htm'),
(223, 'modNewsList', '标题+时间(微软雅黑,14px)', 'tpl_newslist_time_big.htm'),
(450, 'modPhotoPic', '图片名称列表', 'tpl_photopic_title.htm'),
(496, 'modProductGlobalQuery', '图片 名称 介绍(图片居左)', 'tpl_product_query_dolphin.htm'),
(488, 'modProductClass', '产品分类', 'tpl_productclass_dolphin.htm'),
(487, 'modNewsPicMemo', '标题 简介', 'tpl_newspicmemo_title.htm'),
(485, 'modProductContent', '会员互动型产品详情风格', 'tpl_product_content_1.htm'),
(484, 'modProductQuery', '产品名称+图片+参数列(文字在图下方，每行产品数自动)', 'tpl_product_query_6.htm'),
(483, 'modProductQuery', '产品名称+图片+参数列(每行三个产品)', 'tpl_product_query_5.htm'),
(482, 'modProductQuery', '产品名称+图片+简介(每行三个产品)', 'tpl_product_query_4.htm'),
(481, 'modProductQuery', '产品名称+图片+简介+参数列(每行两个产品)', 'tpl_product_query_3.htm'),
(266, 'modBottomMenu', '底部菜单之纯文字菜单模板', 'tpl_bottommenu_1.htm'),
(267, 'modNewsList', '双列文章标题模板', 'tpl_newslist_mul.htm'),
(304, 'modSearchForm', '简单搜索表单', 'tpl_searchform_simple.htm'),
(271, 'modCommentContent', '留言问答风格', 'tpl_comment_content_pw.htm'),
(273, 'modNewsList', '标题 时间（反白）', 'tpl_newslist_time_white.htm'),
(275, 'modWordText', '标题和介绍白色文字模板', 'tpl_wordtext_1_cr.htm'),
(279, 'modPicWordText', '图片标题文字环绕', 'tpl_picwordtext_2.htm'),
(281, 'modPhotoHot', '排行榜样式二', 'tpl_photohot2.htm'),
(282, 'modPhotoContent', '浅蓝淡雅风格', 'tpl_photo_content_blue.htm'),
(283, 'modPhotoHot', '标题+时间', 'tpl_photohot_time.htm'),
(284, 'modPhotoHot', '标题+作者', 'tpl_photohot_author.htm'),
(285, 'modPhotoHot', '标题+点击数', 'tpl_photohot_cl.htm'),
(286, 'modPhotoHot30', '排行榜样式二', 'tpl_photohot2.htm'),
(287, 'modPhotoHot30', '标题+时间', 'tpl_photohot_time.htm'),
(288, 'modPhotoHot30', '标题+作者', 'tpl_photohot_author.htm'),
(289, 'modPhotoHot30', '标题+点击数', 'tpl_photohot_cl.htm'),
(290, 'modPhotoPicMemo', '图片+名称+三个参数列', 'tpl_photopicprop.htm'),
(291, 'modPhotoPicMemo', '图片+名称+两个参数列', 'tpl_photopicprop_2.htm'),
(292, 'modPhotoSearchForm', '竖式搜索表单', 'tpl_photo_searchform_h.htm'),
(293, 'modPhotoTwoClass', '图片二级分类紧凑型风格', 'tpl_phototwoclass_1.htm'),
(480, 'modProductQuery', '产品名称+图片+参数列(每行两个产品)', 'tpl_product_query_2.htm'),
(438, 'modPagePicList', '图片 标题 摘要,每行三个', 'tpl_page_piclist_2.htm'),
(380, 'modNewsClass', '新闻分类', 'tpl_newsclass_dolphin.htm'),
(306, 'modNewsClass', '分类菜单', 'tpl_newsclass_menu.htm'),
(479, 'modProductQuery', '产品名称+图片+简介(每行两个产品)', 'tpl_product_query_1.htm'),
(478, 'modProductList', '产品名称+图片+参数列(文字在图下方，每行产品数自动)', 'tpl_productlist_6.htm'),
(494, 'modProductSearchForm', '自绘搜索', 'tpl_product_search_dolphin.htm'),
(477, 'modProductList', '产品名称+图片+参数列(每行三个产品)', 'tpl_productlist_5.htm'),
(476, 'modProductList', '产品名称+图片+简介(每行三个产品)', 'tpl_productlist_4.htm'),
(501, 'modProductList', '点击滑动', 'tpl_productlist_roll.htm'),
(379, 'modNewsSearchForm', '新闻搜索', 'tpl_news_search_dolphin.htm'),
(387, 'modMainMenu', '主题菜单', 'tpl_mainmenu_dolphin.htm'),
(389, 'modPageTitleMenu', '网页分类', 'tpl_page_menu_dolphin.htm'),
(396, 'modJobList', '职位名称无人数', 'tpl_joblist_1.htm'),
(397, 'modDropDownMenu', '黑色下拉菜单', 'tpl_dropdownmenu_dolphin.htm'),
(475, 'modProductList', '产品名称+图片+简介+参数列(每行两个产品)', 'tpl_productlist_3.htm'),
(402, 'modChannelMenu', '二级跟随菜单', 'tpl_channelmenu_6.htm'),
(474, 'modProductList', '产品名称+图片+参数列(每行两个产品)', 'tpl_productlist_2.htm'),
(436, 'modMemberMenu', '圆角按钮仿QQ菜单模板', 'tpl_qqmenu_1.htm'),
(443, 'modFeedBackSmallForm', '小型留言表单(适合放在左右侧)', 'tpl_feedback_smallform1.htm'),
(440, 'modLoginForm', '不带重设密码', 'tpl_loginform_dolphin.htm'),
(473, 'modProductList', '产品名称+图片+简介(每行两个产品)', 'tpl_productlist_1.htm'),
(457, 'modMemberMenu', '化妆品会员菜单', 'tpl_qqmenu_2.htm'),
(445, 'modCommentSearchForm', '绿色点评搜索', 'tpl_comment_search_dolphin.htm'),
(446, 'modCommentClass', '绿色分类', 'tpl_comment_class_dolphin.htm'),
(472, 'modProductTwoClass', '产品二级分类紧凑型风格', 'tpl_producttwoclass_1.htm'),
(455, 'modPhotoClass', '分类菜单', 'tpl_photoclass_dolphin.htm'),
(454, 'modPhotoSearchForm', '自绘搜索表单', 'tpl_photo_search_dolphin.htm'),
(471, 'modProductSearchForm', '竖式搜索表单', 'tpl_product_searchform_h.htm'),
(492, 'modSearchForm', '顶部搜索', 'tpl_searchform_dolphin.htm'),
(497, 'modPageTitleList', '首页列表', 'tpl_pagelist_1.htm'),
(498, 'modProductQuery', '图片 标题(图片居上)', 'tpl_product_query_dolphin.htm'),
(500, 'modProductClass', '内页产品分类', 'tpl_productclass_dolphin_1.htm'),
(502, 'modNewsList', '自定义模版', 'tpl_newslist_time_1.htm');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_base_version`
--

CREATE TABLE IF NOT EXISTS `pwn_base_version` (
  `version` varchar(30) NOT NULL default '',
  `release` int(8) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pwn_base_version`
--

INSERT INTO `pwn_base_version` (`version`, `release`) VALUES
('1.0.0', 20090215),
('1.1.0', 20090320),
('1.1.1', 20090326),
('1.1.2', 20090327),
('1.1.3', 20090328),
('1.1.4', 20090401),
('1.1.5', 20090402),
('1.1.6', 20090412),
('1.1.7', 20090418),
('1.1.8', 20090419),
('1.1.9', 20090420),
('1.1.10', 20090421),
('1.2.0', 20090428),
('1.2.1', 20090504),
('1.2.2', 20090508),
('1.2.3', 20090514),
('1.2.4', 20090612),
('1.2.5', 20090615),
('1.2.6', 20090624),
('1.3.17', 20091010),
('1.3.16', 20091009),
('1.3.15', 20090912),
('1.3.12', 20090909),
('1.3.11', 20090908),
('1.3.9', 20090906),
('1.3.5', 20090902),
('1.3.3', 20090831),
('1.3.2', 20090830),
('1.2.9', 20090802),
('1.2.8', 20090801),
('1.2.7', 20090728),
('1.3.1', 20090829),
('1.3.0', 20090828),
('1.2.12', 20090820),
('1.2.11', 20090804),
('1.3.18', 20091112),
('1.2.10', 20090803),
('1.3.4', 20090901),
('1.3.19', 20100623),
('1.4.0', 20100830),
('1.4.1', 20100920),
('1.4.3', 20100925),
('1.5.0', 20111209),
('', 20120407),
('', 20120407),
('', 20120410),
('', 20120410),
('', 20120411),
('', 20120411),
('', 20120412),
('', 20120412);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_comment`
--

CREATE TABLE IF NOT EXISTS `pwn_comment` (
  `id` int(20) NOT NULL auto_increment,
  `pid` int(20) NOT NULL default '0',
  `catid` int(11) NOT NULL default '0',
  `rid` int(20) NOT NULL default '0',
  `contype` varchar(30) NOT NULL default 'comment',
  `pname` varchar(100) NOT NULL default '',
  `title` varchar(200) NOT NULL default '',
  `body` text,
  `pj1` int(1) NOT NULL default '3',
  `pj2` int(1) NOT NULL default '3',
  `pj3` int(1) NOT NULL default '3',
  `dtime` int(11) NOT NULL default '0',
  `uptime` int(11) NOT NULL default '0',
  `ip` varchar(16) NOT NULL default '',
  `iffb` int(1) NOT NULL default '0',
  `tuijian` int(1) NOT NULL default '0',
  `cl` int(10) NOT NULL default '0',
  `lastname` varchar(50) NOT NULL default '',
  `lastmemberid` int(12) NOT NULL default '0',
  `backcount` int(12) NOT NULL default '0',
  `picsrc` varchar(255) NOT NULL default '',
  `xuhao` int(5) NOT NULL default '0',
  `memberid` int(20) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=520 ;

--
-- 转存表中的数据 `pwn_comment`
--

INSERT INTO `pwn_comment` (`id`, `pid`, `catid`, `rid`, `contype`, `pname`, `title`, `body`, `pj1`, `pj2`, `pj3`, `dtime`, `uptime`, `ip`, `iffb`, `tuijian`, `cl`, `lastname`, `lastmemberid`, `backcount`, `picsrc`, `xuhao`, `memberid`) VALUES
(514, 0, 109, 0, 'comment', '游客', '产品咨询', 'sss', 3, 3, 3, 1238224685, 1238224685, '127.0.0.1', 1, 0, 37, '游客', -1, 0, '', 1, -1),
(519, 0, 109, 14, 'comment', '游客', '产品咨询', '产品咨询', 3, 3, 3, 1270531063, 1270531063, '192.168.1.123', 1, 0, 4, '游客', -1, 0, '', 1, -1);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_comment_cat`
--

CREATE TABLE IF NOT EXISTS `pwn_comment_cat` (
  `catid` int(12) NOT NULL auto_increment,
  `pid` int(6) NOT NULL default '0',
  `cat` varchar(50) NOT NULL default '',
  `catpath` varchar(255) NOT NULL,
  `coltype` varchar(30) NOT NULL default '',
  `xuhao` int(4) NOT NULL default '0',
  `moveable` int(1) NOT NULL default '0',
  `ifbbs` int(1) NOT NULL default '1',
  `ifshow` int(1) NOT NULL default '1',
  PRIMARY KEY  (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=112 ;

--
-- 转存表中的数据 `pwn_comment_cat`
--

INSERT INTO `pwn_comment_cat` (`catid`, `pid`, `cat`, `catpath`, `coltype`, `xuhao`, `moveable`, `ifbbs`, `ifshow`) VALUES
(1, 0, '文章评论', '0001:', 'news', 0, 0, 0, 0),
(109, 0, '产品咨询', '0109:', 'comment', 1, 1, 1, 1),
(4, 0, '产品点评', '0004:', 'product', 4, 0, 0, 1),
(110, 0, '知识问答', '0110:', 'comment', 2, 1, 1, 0),
(111, 0, '用户茶座', '0111:', 'comment', 7, 1, 0, 0),
(2, 0, '图片点评', '0002:', 'photo', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_comment_config`
--

CREATE TABLE IF NOT EXISTS `pwn_comment_config` (
  `xuhao` int(3) NOT NULL default '0',
  `vname` varchar(50) NOT NULL default '',
  `settype` varchar(30) NOT NULL default 'input',
  `colwidth` varchar(3) NOT NULL default '30',
  `variable` varchar(32) NOT NULL default '',
  `value` text NOT NULL,
  `intro` text NOT NULL,
  PRIMARY KEY  (`variable`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pwn_comment_config`
--

INSERT INTO `pwn_comment_config` (`xuhao`, `vname`, `settype`, `colwidth`, `variable`, `value`, `intro`) VALUES
(5, '匿名点评是否审核', 'YN', '30', 'noMembercheck', '0', '匿名发表、回复点评时是否审核'),
(7, '点评图片上传尺寸限制(Byte)', 'input', '30', 'EditPicLimit', '204800', '发表点评时，编辑器内上传图片大小的限制'),
(6, '未登录时是否允许上传图片', 'YN', '30', 'NoMemberUpPic', '0', '未登录会员时,是否允许在编辑器内上传图片(备注:会员登录后发表点评是否可以上传图片，在会员权限中设置)'),
(1, '模块频道名称', 'input', '30', 'ChannelName', '客户点评', '本模块对应的频道名称，如“网友点评”；用于显示在网页标题、当前位置提示条等处'),
(2, '是否在当前位置提示条显示模块频道名称', 'YN', '30', 'ChannelNameInNav', '1', '是否在当前位置提示条显示模块频道名称'),
(8, '点评关键词过滤', 'textarea', '30', 'KeywordDeny', '', '点评禁止的词语，多个以逗号分割');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_feedback`
--

CREATE TABLE IF NOT EXISTS `pwn_feedback` (
  `id` int(3) NOT NULL auto_increment,
  `groupid` int(5) NOT NULL default '0',
  `field_caption` varchar(200) NOT NULL default '',
  `field_type` int(1) NOT NULL default '0',
  `field_size` int(5) NOT NULL default '0',
  `field_name` varchar(200) NOT NULL default '',
  `field_value` varchar(255) NOT NULL default '',
  `field_null` int(1) NOT NULL default '0',
  `value_repeat` int(1) NOT NULL default '0',
  `field_intro` varchar(255) NOT NULL default '',
  `use_field` int(1) NOT NULL default '0',
  `moveable` int(1) NOT NULL default '0',
  `xuhao` int(3) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1565 ;

--
-- 转存表中的数据 `pwn_feedback`
--

INSERT INTO `pwn_feedback` (`id`, `groupid`, `field_caption`, `field_type`, `field_size`, `field_name`, `field_value`, `field_null`, `value_repeat`, `field_intro`, `use_field`, `moveable`, `xuhao`) VALUES
(1, 0, '留言标题', 1, 399, 'title', '', 1, 1, '', 1, 1, 1),
(2, 0, '留言内容', 2, 399, 'content', '', 0, 1, '', 1, 0, 2),
(3, 0, '您的姓名', 1, 399, 'name', '', 0, 1, '', 0, 0, 3),
(5, 0, '联系电话', 1, 399, 'tel', '', 0, 1, '', 0, 0, 5),
(6, 0, '联系地址', 1, 399, 'address', '', 0, 1, '', 0, 0, 6),
(7, 0, '电子邮件', 1, 399, 'email', '', 0, 1, '', 0, 0, 7),
(8, 0, '网址URL', 1, 399, 'url', '', 0, 1, '', 0, 0, 8),
(9, 0, 'QQ号码', 1, 399, 'qq', '', 0, 1, '', 0, 0, 9),
(10, 0, '公司名称', 1, 399, 'company', '', 0, 1, '', 0, 0, 10),
(11, 0, '公司地址', 1, 399, 'company_address', '', 0, 1, '', 0, 0, 11),
(4, 0, '性　　别', 5, 399, 'sex', '男;女', 0, 1, '', 0, 0, 4),
(12, 0, '邮政编码', 1, 399, 'zip', '', 0, 1, '', 0, 0, 12),
(13, 0, '传真号码', 1, 399, 'fax', '', 0, 1, '', 0, 0, 13),
(14, 0, '产品编号', 1, 399, 'products_id', '', 0, 1, '', 0, 0, 14),
(15, 0, '产品名称', 1, 399, 'products_name', '', 0, 1, '', 0, 0, 15),
(16, 0, '订购数量', 1, 399, 'products_num', '', 0, 1, '', 0, 0, 16),
(19, 0, '自定义一', 5, 399, 'custom1', '100;200;300;400;500', 0, 1, '', 0, 0, 17),
(18, 0, '自定义二', 5, 399, 'custom2', '100;200;300;400;500', 0, 1, '', 0, 0, 18),
(17, 0, '自定义三', 5, 399, 'custom3', '100;200;300;400;500', 0, 1, '', 0, 0, 19),
(20, 0, '自定义四', 1, 399, 'custom4', '', 0, 1, '', 0, 0, 20),
(21, 0, '自定义五', 1, 399, 'custom5', '', 0, 1, '', 0, 0, 21),
(22, 0, '自定义六', 1, 399, 'custom6', '', 0, 1, '', 0, 0, 22),
(23, 0, '自定义七', 1, 399, 'custom7', '', 0, 1, '', 0, 0, 23),
(1145, 1, '自定义二', 5, 399, 'custom2', '100;200;300;400;500', 0, 1, '', 0, 0, 18),
(1146, 1, '自定义三', 5, 399, 'custom3', '100;200;300;400;500', 0, 1, '', 0, 0, 19),
(1147, 1, '自定义四', 1, 399, 'custom4', '', 0, 1, '', 0, 0, 20),
(1148, 1, '自定义五', 1, 399, 'custom5', '', 0, 1, '', 0, 0, 21),
(1149, 1, '自定义六', 1, 399, 'custom6', '', 0, 1, '', 0, 0, 22),
(1150, 1, '自定义七', 1, 399, 'custom7', '', 0, 1, '', 0, 0, 23),
(1143, 1, '订购数量', 1, 399, 'products_num', '', 0, 1, '', 0, 0, 16),
(1144, 1, '自定义一', 5, 399, 'custom1', '100;200;300;400;500', 0, 1, '', 0, 0, 17),
(1142, 1, '产品名称', 1, 399, 'products_name', '', 0, 1, '', 0, 0, 15),
(1141, 1, '产品编号', 1, 399, 'products_id', '', 0, 1, '', 0, 0, 14),
(1140, 1, '传真号码', 1, 399, 'fax', '', 0, 1, '', 0, 0, 13),
(1139, 1, '邮政编码', 1, 399, 'zip', '', 0, 1, '', 0, 0, 12),
(1138, 1, '性别称谓', 5, 399, 'sex', '先生;女士', 0, 1, '', 0, 0, 9),
(1136, 1, '客户名称', 1, 399, 'company', '', 1, 1, '', 1, 0, 3),
(1137, 1, '公司地址', 1, 399, 'company_address', '', 0, 1, '', 0, 0, 11),
(1135, 1, 'QQ/MSN', 1, 399, 'qq', '', 0, 1, '', 1, 0, 9),
(1134, 1, '网址URL', 1, 399, 'url', '', 0, 1, '', 0, 0, 8),
(1133, 1, '电子邮件', 1, 399, 'email', '', 0, 1, '', 0, 0, 7),
(1132, 1, '联系地址', 1, 399, 'address', '', 0, 1, '', 0, 0, 6),
(1131, 1, '联系电话', 1, 399, 'tel', '', 1, 1, '', 1, 0, 5),
(1130, 1, '联 系 人', 1, 399, 'name', '', 0, 1, '', 1, 0, 4),
(1129, 1, '留言内容', 2, 399, 'content', '', 1, 1, '', 1, 0, 2),
(1128, 1, '留言主题', 1, 399, 'title', '', 1, 1, '', 1, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_feedback_group`
--

CREATE TABLE IF NOT EXISTS `pwn_feedback_group` (
  `id` int(3) NOT NULL auto_increment,
  `groupname` varchar(50) NOT NULL default '',
  `xuhao` int(5) NOT NULL default '0',
  `moveable` int(1) NOT NULL default '1',
  `ifano` int(11) NOT NULL default '0',
  `allowmembertype` varchar(255) NOT NULL,
  `allowfeedback` char(255) NOT NULL,
  `intro` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `pwn_feedback_group`
--

INSERT INTO `pwn_feedback_group` (`id`, `groupname`, `xuhao`, `moveable`, `ifano`, `allowmembertype`, `allowfeedback`, `intro`) VALUES
(1, '信息反馈', 1, 0, 1, '|26|', '|3|', '信息反馈');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_feedback_info`
--

CREATE TABLE IF NOT EXISTS `pwn_feedback_info` (
  `id` int(12) NOT NULL auto_increment,
  `groupid` int(5) NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `content` text NOT NULL,
  `name` varchar(200) NOT NULL default '',
  `sex` varchar(10) NOT NULL default '',
  `tel` varchar(100) NOT NULL default '',
  `address` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `qq` varchar(20) NOT NULL default '',
  `company` varchar(255) NOT NULL default '',
  `company_address` varchar(255) NOT NULL default '',
  `zip` varchar(6) NOT NULL default '',
  `fax` varchar(20) NOT NULL default '',
  `products_id` varchar(100) NOT NULL default '',
  `products_name` varchar(200) NOT NULL default '',
  `products_num` varchar(9) NOT NULL default '',
  `custom1` text NOT NULL,
  `custom2` text NOT NULL,
  `custom3` text NOT NULL,
  `custom4` text NOT NULL,
  `custom5` text NOT NULL,
  `custom6` text NOT NULL,
  `custom7` text NOT NULL,
  `ip` varchar(20) NOT NULL default '',
  `time` int(11) NOT NULL default '0',
  `uptime` int(11) NOT NULL default '0',
  `memberid` int(12) NOT NULL default '0',
  `stat` int(2) NOT NULL default '0',
  `adminid` int(5) NOT NULL default '0',
  `coadminid` int(5) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=170 ;

--
-- 转存表中的数据 `pwn_feedback_info`
--


-- --------------------------------------------------------

--
-- 表的结构 `pwn_job`
--

CREATE TABLE IF NOT EXISTS `pwn_job` (
  `id` int(12) NOT NULL auto_increment,
  `jobname` varchar(255) NOT NULL default '',
  `jobtype` varchar(20) NOT NULL default '',
  `experience` varchar(100) NOT NULL default '',
  `education` varchar(50) NOT NULL default '',
  `langneed` varchar(50) NOT NULL default '',
  `langlevel` varchar(50) NOT NULL default '',
  `pnums` int(5) NOT NULL default '0',
  `jobaddr` varchar(200) NOT NULL default '',
  `jobintro` text,
  `jobrequest` text NOT NULL,
  `jobstat` int(1) NOT NULL default '0',
  `contact` varchar(50) NOT NULL default '',
  `tel` varchar(50) NOT NULL default '',
  `email` varchar(200) NOT NULL default '',
  `dtime` int(11) default '0',
  `uptime` int(11) default '0',
  `endtime` int(11) default '0',
  `xuhao` int(5) default '0',
  `cl` int(20) NOT NULL default '0',
  `tj` int(1) NOT NULL default '0',
  `iffb` int(1) default '0',
  `contype` varchar(20) NOT NULL default 'job',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `pwn_job`
--

INSERT INTO `pwn_job` (`id`, `jobname`, `jobtype`, `experience`, `education`, `langneed`, `langlevel`, `pnums`, `jobaddr`, `jobintro`, `jobrequest`, `jobstat`, `contact`, `tel`, `email`, `dtime`, `uptime`, `endtime`, `xuhao`, `cl`, `tj`, `iffb`, `contype`) VALUES
(1, '华东区销售经理', '全职', '3年以上', '本科', '', '', 1, '上海', '本公司即将设立上海办事处，招聘华东区销售经理一名，负责拓展华东地区业务', '具有良好的销售和团队管理理念\r\n三年以上销售工作经验，一年以上销售经理经验\r\n工作责任心强，能承受较大的工作压力', 1, '华海', '021-87654321', 'huahai@mycompany.com', 1242621303, 1242621303, 0, 0, 0, 0, 1, 'job'),
(2, '华东区销售经理', '全职', '3年以上', '本科', '', '', 1, '上海', '本公司即将设立上海办事处，招聘华东区销售经理一名，负责拓展华东地区业务', '具有良好的销售和团队管理理念\r\n三年以上销售工作经验，一年以上销售经理经验\r\n工作责任心强，能承受较大的工作压力', 1, '华海', '021-87654321', 'huahai@mycompany.com', 1242621306, 1242621306, 0, 0, 4, 0, 1, 'job'),
(3, '华东区销售经理', '全职', '3年以上', '本科', '', '', 1, '上海', '本公司即将设立上海办事处，招聘华东区销售经理一名，负责拓展华东地区业务', '具有良好的销售和团队管理理念\r\n三年以上销售工作经验，一年以上销售经理经验\r\n工作责任心强，能承受较大的工作压力', 1, '华海', '021-87654321', 'huahai@mycompany.com', 1242621308, 1242621308, 0, 0, 48, 0, 1, 'job'),
(4, '华东区销售经理', '全职', '3年以上', '本科', '', '', 1, '上海', '本公司即将设立上海办事处，招聘华东区销售经理一名，负责拓展华东地区业务', '具有良好的销售和团队管理理念三年以上销售工作经验，一年以上销售经理经验工作责任心强，能承受较大的工作压力', 1, '华海', '021-87654321', 'huahai@mycompany.com', 1260151088, 1260151088, 0, 0, 6, 0, 1, 'job'),
(5, '总会计师', '全职', '3年以上', '本科', '', '', 1, '上海', '本公司即将设立上海办事处，招聘华东区销售经理一名，负责拓展华东地区业务 ', '具有良好的销售和团队管理理念三年以上销售工作经验，一年以上销售经理经验工作责任心强，能承受较大的工作压力', 1, '华海', '021-87654321', 'huahai@mycompany.com', 1260151113, 1263782134, 0, 0, 178, 0, 1, 'job'),
(7, '华东业务总监', '全职', '3年以上', '本科', '', '', 1, '上海', '本公司即将设立上海办事处，招聘华东区销售经理一名，负责拓展华东地区业务 ', '具有良好的销售和团队管理理念三年以上销售工作经验，一年以上销售经理经验工作责任心强，能承受较大的工作压力', 1, '华海', '021-87654321', 'huahai@mycompany.com', 1260151165, 1263782119, 0, 0, 82, 0, 1, 'job');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_job_form`
--

CREATE TABLE IF NOT EXISTS `pwn_job_form` (
  `id` int(3) NOT NULL auto_increment,
  `field_caption` varchar(200) NOT NULL default '',
  `field_type` int(1) NOT NULL default '0',
  `field_size` int(5) NOT NULL default '0',
  `field_name` varchar(200) NOT NULL default '',
  `field_value` varchar(255) NOT NULL default '',
  `field_null` int(1) NOT NULL default '0',
  `value_repeat` int(1) NOT NULL default '0',
  `field_intro` varchar(255) NOT NULL default '',
  `use_field` int(1) NOT NULL default '0',
  `moveable` int(1) NOT NULL default '0',
  `xuhao` int(3) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- 转存表中的数据 `pwn_job_form`
--

INSERT INTO `pwn_job_form` (`id`, `field_caption`, `field_type`, `field_size`, `field_name`, `field_value`, `field_null`, `value_repeat`, `field_intro`, `use_field`, `moveable`, `xuhao`) VALUES
(1, '姓　　名', 1, 200, 'title', '', 1, 1, '', 1, 1, 1),
(2, '教育经历', 2, 399, 'content', '', 1, 1, '', 1, 0, 14),
(3, '出生日期', 1, 200, 'name', '', 1, 1, '', 1, 0, 3),
(4, '性　　别', 5, 50, 'sex', '男;女', 1, 1, '', 1, 0, 2),
(5, '联系电话', 1, 200, 'tel', '', 1, 1, '', 1, 0, 9),
(6, '通信地址', 1, 300, 'address', '', 1, 1, '', 1, 0, 11),
(7, '电子邮箱', 1, 300, 'email', '', 1, 1, '', 1, 0, 12),
(8, '博客/主页', 1, 399, 'url', '', 0, 1, '', 0, 0, 18),
(9, 'QQ/MSN', 1, 399, 'qq', '', 0, 1, '', 0, 0, 19),
(10, '毕业院校', 1, 300, 'company', '', 1, 1, '', 1, 0, 5),
(11, '最高学历', 1, 200, 'company_address', '', 1, 1, '', 1, 0, 6),
(12, '邮政编码', 1, 399, 'zip', '', 0, 1, '', 0, 0, 19),
(13, '手机号码', 1, 200, 'fax', '', 0, 1, '', 1, 0, 10),
(14, '毕业专业', 1, 200, 'products_id', '', 1, 1, '', 1, 0, 7),
(15, '毕业时间', 1, 200, 'products_name', '', 1, 1, '', 1, 0, 8),
(16, '专业特长', 1, 399, 'products_num', '', 1, 1, '', 1, 0, 13),
(19, '婚姻状况', 5, 200, 'custom1', '未婚;已婚', 1, 1, '', 1, 0, 4),
(18, '工作经历', 2, 399, 'custom2', '', 1, 1, '', 1, 0, 15),
(17, '自定义三', 5, 399, 'custom3', '100;200;300;400;500', 0, 1, '', 0, 0, 19),
(20, '自定义四', 1, 399, 'custom4', '', 0, 1, '', 0, 0, 20),
(21, '自定义五', 1, 399, 'custom5', '', 0, 1, '', 0, 0, 21),
(22, '自定义六', 1, 399, 'custom6', '', 0, 1, '', 0, 0, 22),
(23, '自定义七', 1, 399, 'custom7', '', 0, 1, '', 0, 0, 23);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_job_telent`
--

CREATE TABLE IF NOT EXISTS `pwn_job_telent` (
  `id` int(12) NOT NULL auto_increment,
  `jobid` int(6) NOT NULL default '0',
  `jobname` char(200) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `content` text NOT NULL,
  `name` varchar(200) NOT NULL default '',
  `sex` varchar(10) NOT NULL default '',
  `tel` varchar(100) NOT NULL default '',
  `address` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `qq` varchar(20) NOT NULL default '',
  `company` varchar(255) NOT NULL default '',
  `company_address` varchar(255) NOT NULL default '',
  `zip` varchar(6) NOT NULL default '',
  `fax` varchar(20) NOT NULL default '',
  `products_id` varchar(100) NOT NULL default '',
  `products_name` varchar(200) NOT NULL default '',
  `products_num` varchar(9) NOT NULL default '',
  `custom1` text NOT NULL,
  `custom2` text NOT NULL,
  `custom3` text NOT NULL,
  `custom4` text NOT NULL,
  `custom5` text NOT NULL,
  `custom6` text NOT NULL,
  `custom7` text NOT NULL,
  `fileurl` varchar(200) NOT NULL default '',
  `ip` varchar(20) NOT NULL default '',
  `time` int(11) NOT NULL default '0',
  `uptime` int(11) NOT NULL default '0',
  `stat` int(2) NOT NULL default '0',
  `fav` int(2) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `pwn_job_telent`
--


-- --------------------------------------------------------

--
-- 表的结构 `pwn_member`
--

CREATE TABLE IF NOT EXISTS `pwn_member` (
  `memberid` int(12) NOT NULL auto_increment,
  `membertypeid` int(3) NOT NULL default '0',
  `membergroupid` int(3) NOT NULL default '0',
  `user` varchar(30) NOT NULL default '',
  `password` varchar(50) NOT NULL default '',
  `name` varchar(255) NOT NULL default '',
  `company` varchar(100) NOT NULL,
  `sex` varchar(20) NOT NULL default '',
  `birthday` int(8) NOT NULL default '0',
  `zoneid` int(10) NOT NULL default '0',
  `catid` int(10) NOT NULL default '0',
  `addr` varchar(255) NOT NULL default '',
  `tel` varchar(255) NOT NULL default '',
  `mov` varchar(255) NOT NULL default '',
  `postcode` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `url` varchar(255) NOT NULL default 'http://',
  `passtype` varchar(255) NOT NULL default '',
  `passcode` varchar(255) NOT NULL default '',
  `qq` varchar(100) NOT NULL default '',
  `msn` varchar(100) NOT NULL default '',
  `maillist` int(1) NOT NULL default '0',
  `bz` text,
  `pname` varchar(30) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `memberface` varchar(100) NOT NULL,
  `nowface` varchar(50) NOT NULL,
  `checked` int(1) NOT NULL default '0',
  `rz` int(1) NOT NULL default '0',
  `tags` varchar(255) NOT NULL,
  `regtime` int(11) NOT NULL default '0',
  `exptime` int(11) NOT NULL default '0',
  `account` decimal(12,2) NOT NULL default '0.00',
  `paytotal` decimal(12,2) NOT NULL default '0.00',
  `buytotal` decimal(12,2) NOT NULL default '0.00',
  `cent1` int(10) NOT NULL default '0',
  `cent2` int(10) NOT NULL default '0',
  `cent3` int(10) NOT NULL default '0',
  `cent4` int(10) NOT NULL default '0',
  `cent5` int(10) NOT NULL default '0',
  `ip` varchar(26) NOT NULL default '',
  `logincount` int(20) NOT NULL default '0',
  `logintime` int(11) NOT NULL default '0',
  `loginip` varchar(50) NOT NULL default '',
  `salesname` varchar(30) NOT NULL,
  PRIMARY KEY  (`memberid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=160 ;

--
-- 转存表中的数据 `pwn_member`
--

INSERT INTO `pwn_member` (`memberid`, `membertypeid`, `membergroupid`, `user`, `password`, `name`, `company`, `sex`, `birthday`, `zoneid`, `catid`, `addr`, `tel`, `mov`, `postcode`, `email`, `url`, `passtype`, `passcode`, `qq`, `msn`, `maillist`, `bz`, `pname`, `signature`, `memberface`, `nowface`, `checked`, `rz`, `tags`, `regtime`, `exptime`, `account`, `paytotal`, `buytotal`, `cent1`, `cent2`, `cent3`, `cent4`, `cent5`, `ip`, `logincount`, `logintime`, `loginip`, `salesname`) VALUES
(155, 26, 1, 'aaaaaa', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', '1212313', '', '1', 19020101, 1, 0, '', '12313123', '123123123', '', 'aaaaaa@fe.com', 'http://', '身份证', '', '', '', 0, '', 'aaaaaa', '', '', '1', 1, 0, '', 1263777411, 0, 395884.00, 396014.00, 130.00, 51, 0, 0, 0, 100, '192.168.1.123', 32, 1270792279, '192.168.1.123', ''),
(159, 26, 1, 'bbbbbb', '875f26fdb1cecf20ceb4ca028263dec6', '', '', '1', 19020101, 1, 0, '', '', '', '', 'aaaaaa@fe.com', 'http://', '身份证', '', '', '', 0, '', 'bbbbbb', '', '', '1', 1, 0, '', 1265693976, 0, 0.00, 0.00, 0.00, 10, 0, 0, 0, 0, '192.168.1.123', 1, 1265693976, '192.168.1.123', '');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_member_buylist`
--

CREATE TABLE IF NOT EXISTS `pwn_member_buylist` (
  `id` int(12) NOT NULL auto_increment,
  `buyfrom` varchar(50) NOT NULL default '',
  `memberid` int(12) NOT NULL default '0',
  `orderid` int(12) NOT NULL default '0',
  `payid` int(12) NOT NULL default '0',
  `paytype` varchar(50) NOT NULL default '0',
  `payhb` varchar(30) NOT NULL default '',
  `payhl` decimal(12,4) NOT NULL default '0.0000',
  `paytotal` decimal(12,2) NOT NULL default '0.00',
  `daytime` int(11) NOT NULL default '0',
  `ip` varchar(20) NOT NULL default '',
  `OrderNo` varchar(30) NOT NULL default '',
  `logname` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `pwn_member_buylist`
--

INSERT INTO `pwn_member_buylist` (`id`, `buyfrom`, `memberid`, `orderid`, `payid`, `paytype`, `payhb`, `payhl`, `paytotal`, `daytime`, `ip`, `OrderNo`, `logname`) VALUES
(1, '网上购物', 155, 1, 2, '送货上门收款', '', 0.0000, 396014.00, 1265618662, '192.168.1.123', '100001', '管理员'),
(2, '网上购物', 155, 1, 0, '订单退款', '', 0.0000, -396014.00, 1265704645, '192.168.1.123', '100001', '管理员'),
(3, '网上购物', 155, 5, 0, '会员帐户扣款', '', 0.0000, 130.00, 1270788483, '192.168.1.123', '100005', 'aaaaaa');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_member_cat`
--

CREATE TABLE IF NOT EXISTS `pwn_member_cat` (
  `catid` int(12) NOT NULL auto_increment,
  `pid` int(12) NOT NULL default '0',
  `cat` char(100) NOT NULL default '',
  `xuhao` int(4) NOT NULL default '0',
  `catpath` char(255) NOT NULL default '',
  `nums` int(20) NOT NULL default '0',
  PRIMARY KEY  (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pwn_member_cat`
--


-- --------------------------------------------------------

--
-- 表的结构 `pwn_member_centlog`
--

CREATE TABLE IF NOT EXISTS `pwn_member_centlog` (
  `id` int(8) NOT NULL auto_increment,
  `memberid` int(12) NOT NULL default '0',
  `event` int(5) NOT NULL default '0',
  `dtime` int(11) NOT NULL default '0',
  `cent1` int(10) NOT NULL default '0',
  `cent2` int(10) NOT NULL default '0',
  `cent3` int(10) NOT NULL default '0',
  `cent4` int(10) NOT NULL default '0',
  `cent5` int(10) NOT NULL default '0',
  `memo` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- 转存表中的数据 `pwn_member_centlog`
--

INSERT INTO `pwn_member_centlog` (`id`, `memberid`, `event`, `dtime`, `cent1`, `cent2`, `cent3`, `cent4`, `cent5`, `memo`) VALUES
(1, 153, 111, 1237648810, 10, 0, 0, 0, 0, ''),
(2, 153, 131, 1237648965, 5, 0, 0, 0, 0, ''),
(3, 153, 181, 1237650958, 10, 0, 0, 0, 0, ''),
(4, 150, 114, 1237711955, 1, 0, 0, 0, 0, ''),
(5, 150, 114, 1237781183, 1, 0, 0, 0, 0, ''),
(6, 150, 114, 1238228910, 1, 0, 0, 0, 0, ''),
(7, 150, 121, 1238230484, 10, 0, 0, 0, 0, ''),
(8, 150, 114, 1238260989, 1, 0, 0, 0, 0, ''),
(9, 154, 111, 1238290627, 10, 0, 0, 0, 0, ''),
(10, 150, 114, 1238424185, 1, 0, 0, 0, 0, ''),
(11, 150, 114, 1238426835, 1, 0, 0, 0, 0, ''),
(12, 150, 114, 1238427138, 1, 0, 0, 0, 0, ''),
(13, 150, 114, 1238896776, 1, 0, 0, 0, 0, ''),
(14, 150, 114, 1238897444, 1, 0, 0, 0, 0, ''),
(15, 150, 131, 1238898529, 5, 0, 0, 0, 0, ''),
(16, 150, 114, 1241752690, 1, 0, 0, 0, 0, ''),
(17, 150, 114, 1241932574, 1, 0, 0, 0, 0, ''),
(18, 155, 111, 1263777411, 10, 0, 0, 0, 0, ''),
(19, 155, 114, 1263782293, 1, 0, 0, 0, 0, ''),
(20, 156, 111, 1263784268, 10, 0, 0, 0, 0, ''),
(21, 155, 114, 1263784798, 1, 0, 0, 0, 0, ''),
(22, 155, 114, 1263784950, 1, 0, 0, 0, 0, ''),
(23, 155, 114, 1263796175, 1, 0, 0, 0, 0, ''),
(24, 155, 114, 1263868613, 1, 0, 0, 0, 0, ''),
(25, 155, 114, 1263949775, 1, 0, 0, 0, 0, ''),
(26, 155, 114, 1264064484, 1, 0, 0, 0, 0, ''),
(27, 155, 114, 1264122821, 1, 0, 0, 0, 0, ''),
(28, 155, 114, 1264123406, 1, 0, 0, 0, 0, ''),
(29, 157, 111, 1264123627, 10, 0, 0, 0, 0, ''),
(30, 158, 111, 1264124145, 10, 0, 0, 0, 0, ''),
(31, 155, 114, 1264124271, 1, 0, 0, 0, 0, ''),
(32, 155, 114, 1264124729, 1, 0, 0, 0, 0, ''),
(33, 155, 114, 1264125477, 1, 0, 0, 0, 0, ''),
(34, 155, 114, 1264136329, 1, 0, 0, 0, 0, ''),
(35, 155, 114, 1265613760, 1, 0, 0, 0, 0, ''),
(36, 155, 114, 1265614046, 1, 0, 0, 0, 0, ''),
(37, 155, 114, 1265618217, 1, 0, 0, 0, 0, ''),
(38, 155, 0, 1265618662, 0, 0, 0, 0, 360000, '后台订单付款确认'),
(39, 155, 114, 1265691509, 1, 0, 0, 0, 0, ''),
(40, 155, 114, 1265693022, 1, 0, 0, 0, 0, ''),
(41, 159, 111, 1265693976, 10, 0, 0, 0, 0, ''),
(42, 155, 114, 1265694865, 1, 0, 0, 0, 0, ''),
(43, 155, 114, 1265694937, 1, 0, 0, 0, 0, ''),
(44, 155, 114, 1265701029, 1, 0, 0, 0, 0, ''),
(45, 155, 114, 1265701369, 1, 0, 0, 0, 0, ''),
(46, 155, 114, 1265703369, 1, 0, 0, 0, 0, ''),
(47, 155, 0, 1265704645, 0, 0, 0, 0, -360000, '订单退款'),
(48, 155, 114, 1265878375, 1, 0, 0, 0, 0, ''),
(49, 155, 114, 1266712980, 1, 0, 0, 0, 0, ''),
(50, 155, 114, 1270535523, 1, 0, 0, 0, 0, ''),
(51, 155, 114, 1270535603, 1, 0, 0, 0, 0, ''),
(52, 155, 114, 1270788449, 1, 0, 0, 0, 0, ''),
(53, 155, 0, 1270788483, 0, 0, 0, 0, 100, '订单付款'),
(54, 155, 313, 1270788483, 10, 0, 0, 0, 0, ''),
(55, 155, 114, 1270789820, 1, 0, 0, 0, 0, ''),
(56, 155, 114, 1270790245, 1, 0, 0, 0, 0, ''),
(57, 155, 114, 1270792279, 1, 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_member_centrule`
--

CREATE TABLE IF NOT EXISTS `pwn_member_centrule` (
  `id` int(8) NOT NULL auto_increment,
  `coltype` varchar(30) NOT NULL,
  `name` char(100) NOT NULL default '',
  `event` int(5) NOT NULL default '0',
  `cent1` int(10) NOT NULL default '0',
  `cent2` int(10) NOT NULL default '0',
  `cent3` int(10) NOT NULL default '0',
  `cent4` int(10) NOT NULL default '0',
  `cent5` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

--
-- 转存表中的数据 `pwn_member_centrule`
--

INSERT INTO `pwn_member_centrule` (`id`, `coltype`, `name`, `event`, `cent1`, `cent2`, `cent3`, `cent4`, `cent5`) VALUES
(1, 'member', '新会员注册', 111, 10, 0, 0, 0, 0),
(6, 'member', '加好友', 112, 1, 0, 0, 0, 0),
(7, 'member', '发站内短信', 113, 1, 0, 0, 0, 0),
(21, 'member', '会员登录', 114, 1, 0, 0, 0, 0),
(2, 'news', '发布文章', 121, 10, 0, 0, 0, 0),
(9, 'news', '文章被支持', 122, 0, 1, 0, 0, 0),
(10, 'news', '文章被反对', 123, 0, -1, 0, 0, 0),
(22, 'news', '文章被版主推荐', 124, 20, 0, 0, 0, 0),
(23, 'news', '文章被版主删除并扣分', 125, -20, 0, 0, 0, 0),
(61, 'product', '发布产品', 181, 10, 0, 0, 0, 0),
(35, 'photo', '发布图片', 151, 10, 0, 0, 0, 0),
(36, 'photo', '图片被支持', 152, 0, 1, 0, 0, 0),
(37, 'photo', '图片被反对', 153, 0, -1, 0, 0, 0),
(38, 'photo', '图片被版主推荐', 154, 20, 0, 0, 0, 0),
(39, 'photo', '图片被版主删除并扣分', 155, -20, 0, 0, 0, 0),
(64, 'product', '产品被版主推荐', 184, 20, 0, 0, 0, 0),
(63, 'product', '产品被反对', 183, 0, -1, 0, 0, 0),
(62, 'product', '产品被支持', 182, 0, 1, 0, 0, 0),
(65, 'product', '产品被版主删除并扣分', 185, -20, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_member_centset`
--

CREATE TABLE IF NOT EXISTS `pwn_member_centset` (
  `id` int(8) NOT NULL auto_increment,
  `centname1` char(50) NOT NULL,
  `centname2` char(50) NOT NULL,
  `centname3` char(50) NOT NULL,
  `centname4` char(50) NOT NULL,
  `centname5` char(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `pwn_member_centset`
--

INSERT INTO `pwn_member_centset` (`id`, `centname1`, `centname2`, `centname3`, `centname4`, `centname5`) VALUES
(1, '经验', '人气', '悬赏', '金币', '消费');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_member_config`
--

CREATE TABLE IF NOT EXISTS `pwn_member_config` (
  `xuhao` int(3) NOT NULL default '0',
  `vname` varchar(50) NOT NULL default '',
  `settype` varchar(30) NOT NULL default 'input',
  `colwidth` varchar(3) NOT NULL default '30',
  `variable` varchar(32) NOT NULL default '',
  `value` text NOT NULL,
  `intro` text NOT NULL,
  PRIMARY KEY  (`variable`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pwn_member_config`
--

INSERT INTO `pwn_member_config` (`xuhao`, `vname`, `settype`, `colwidth`, `variable`, `value`, `intro`) VALUES
(1, '模块频道名称', 'input', '30', 'ChannelName', '会员中心', '本模块对应的频道名称；用于显示在当前位置提示条等处'),
(2, '是否在当前位置提示条显示模块频道名称', 'YN', '30', 'ChannelNameInNav', '1', '是否在当前位置提示条显示模块频道名称'),
(3, '会员网名昵称是否允许重复', 'YN', '1', 'DblPname', '1', '会员注册和修改资料时校验网名昵称是否允许重复'),
(4, 'UCenter 会员接口是否启用', 'YN', '1', 'UC_OPEN', '0', 'UCenter会员接口包括会员注册、会员登录接口；启用本接口前请先上传UCenter会员接口程序'),
(5, 'UCenter 应用 ID', 'input', '30', 'UC_APPID', '2', '该值为PHPWEB在 UCenter 的应用 ID，请填写你在UCenter将PHPWEB添加应用后实际获得的应用ID'),
(6, 'UCenter 通信密钥', 'input', '30', 'UC_KEY', 'PWUC2009', '通信密钥用于在 UCenter 和 PHPWEB 之间传输信息的加密，可包含任何字母及数字，请在 UCenter 与 PHPWEB 设置完全相同的通讯密钥，以确保两套系统能够正常通信'),
(7, 'UCenter 访问地址', 'input', '30', 'UC_API', 'http://discuz.phpweb.net/uc_server', '您的 UCenter 访问地址，不正确的设置可能导致网站功能异常，请小心修改。格式: http://www.sitename.com/uc_server (最后不要加''/'')'),
(7, 'UCenter IP 地址', 'input', '30', 'UC_IP', '', '如果您的服务器无法通过域名访问 UCenter，可以输入 UCenter 服务器的 IP 地址'),
(8, 'UCenter 数据库服务器', 'input', '30', 'UC_DBHOST', 'localhost', '可以是本地也可以是远程数据库服务器，如果 MySQL 端口不是默认的 3306，请填写如下形式：127.0.0.1:6033'),
(9, 'UCenter 数据库用户名', 'input', '30', 'UC_DBUSER', 'root', ''),
(10, 'UCenter 数据库密码', 'input', '30', 'UC_DBPW', '123456', ''),
(12, 'UCenter 数据库名', 'input', '30', 'UC_DBNAME', 'dbdiscuz', ''),
(13, 'UCenter 数据表前缀', 'input', '30', 'UC_DBTABLEPRE', 'cdb_uc_', '请填入您的UCenter数据表前缀，注意格式正确；如果是直接安装UCENTER，表前缀是一个“_”，如果是和discuz!一起安装的，则是带两个“_”的完整前缀'),
(14, 'UCenter 数据库编码', 'input', '30', 'UC_DBCHARSET', 'utf8', 'UCenter的数据库编码'),
(15, 'UCenter 的字符集', 'input', '30', 'UC_CHARSET', 'utf-8', ''),
(17, 'UCenter 用户自动激活时对应的会员类型', 'MTYPE', '30', 'UC_MEMBERTYPEID', '26', '用户登录时，在UCenter通过验证的用户（来自其他应用的用户），如果本系统没有该会员，自动增加会员时对应的会员类型');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_member_defaultrights`
--

CREATE TABLE IF NOT EXISTS `pwn_member_defaultrights` (
  `id` int(12) NOT NULL auto_increment,
  `membertypeid` int(12) NOT NULL default '0',
  `secureid` int(12) NOT NULL default '0',
  `securetype` char(100) NOT NULL default '',
  `secureset` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=519 ;

--
-- 转存表中的数据 `pwn_member_defaultrights`
--

INSERT INTO `pwn_member_defaultrights` (`id`, `membertypeid`, `secureid`, `securetype`, `secureset`) VALUES
(518, 26, 193, 'func', '0'),
(517, 26, 191, 'func', '0'),
(516, 26, 190, 'func', '0'),
(515, 26, 127, 'func', '0'),
(514, 26, 126, 'class', ''),
(513, 26, 123, 'func', '0'),
(512, 26, 122, 'func', '0'),
(511, 26, 121, 'func', '0'),
(510, 26, 114, 'func', '0'),
(509, 26, 113, 'func', '0'),
(508, 26, 112, 'func', '0'),
(507, 26, 111, 'func', '0'),
(506, 26, 101, 'con', '1');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_member_fav`
--

CREATE TABLE IF NOT EXISTS `pwn_member_fav` (
  `id` int(12) NOT NULL auto_increment,
  `memberid` int(12) NOT NULL default '0',
  `title` varchar(200) NOT NULL default '',
  `url` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- 转存表中的数据 `pwn_member_fav`
--


-- --------------------------------------------------------

--
-- 表的结构 `pwn_member_friends`
--

CREATE TABLE IF NOT EXISTS `pwn_member_friends` (
  `id` int(12) NOT NULL auto_increment,
  `memberid` int(12) NOT NULL default '0',
  `fid` int(12) NOT NULL default '0',
  `fgroup` char(30) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pwn_member_friends`
--


-- --------------------------------------------------------

--
-- 表的结构 `pwn_member_group`
--

CREATE TABLE IF NOT EXISTS `pwn_member_group` (
  `id` int(6) NOT NULL auto_increment,
  `membergroup` varchar(30) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `pwn_member_group`
--

INSERT INTO `pwn_member_group` (`id`, `membergroup`) VALUES
(1, '个人'),
(2, '企业');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_member_msn`
--

CREATE TABLE IF NOT EXISTS `pwn_member_msn` (
  `id` int(12) NOT NULL auto_increment,
  `tomemberid` int(12) NOT NULL default '0',
  `frommemberid` int(12) NOT NULL default '0',
  `body` text NOT NULL,
  `dtime` int(11) NOT NULL default '0',
  `iflook` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `pwn_member_msn`
--

INSERT INTO `pwn_member_msn` (`id`, `tomemberid`, `frommemberid`, `body`, `dtime`, `iflook`) VALUES
(2, 154, 0, 'sssssss,您好!\r\n\r\n感谢您在本站注册!\r\n\r\n会员名: sssssss\r\n密码: sssss\r\n\r\n网址:http://', 1238290626, 0),
(3, 155, 0, 'aaaaaa,您好!\r\n\r\n感谢您在本站注册!\r\n\r\n会员名: aaaaaa\r\n密码: aaaaaa\r\n\r\n网址:http://', 1263777411, 1),
(4, 156, 0, 'xxxxxx,您好!\r\n\r\n感谢您在本站注册!\r\n\r\n会员名: xxxxxx\r\n密码: xxxxxx\r\n\r\n网址:http://', 1263784268, 0),
(5, 157, 0, 'bbbbbb,您好!\r\n\r\n感谢您在本站注册!\r\n\r\n会员名: bbbbbb\r\n密码: bbbbbb\r\n\r\n网址:http://', 1264123627, 0),
(6, 158, 0, 'bbbbbb,您好!\r\n\r\n感谢您在本站注册!\r\n\r\n会员名: bbbbbb\r\n密码: bbbbbb\r\n\r\n网址:http://', 1264124145, 0),
(7, 159, 0, 'bbbbbb,您好!\r\n\r\n感谢您在本站注册!\r\n\r\n会员名: bbbbbb\r\n密码: bbbbbb\r\n\r\n网址:http://', 1265693976, 1);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_member_notice`
--

CREATE TABLE IF NOT EXISTS `pwn_member_notice` (
  `id` int(12) NOT NULL auto_increment,
  `membertypeid` int(20) default NULL,
  `title` varchar(255) default NULL,
  `body` text,
  `dtime` int(11) default NULL,
  `xuhao` int(5) default NULL,
  `cl` int(20) default NULL,
  `ifnew` int(1) default NULL,
  `ifred` int(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `pwn_member_notice`
--

INSERT INTO `pwn_member_notice` (`id`, `membertypeid`, `title`, `body`, `dtime`, `xuhao`, `cl`, `ifnew`, `ifred`) VALUES
(1, 0, '这是测试的一条会员公告', '这是测试的一条会员公告', 1220596305, 0, 2, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_member_nums`
--

CREATE TABLE IF NOT EXISTS `pwn_member_nums` (
  `id` int(12) NOT NULL auto_increment,
  `memberid` int(50) default NULL,
  `secureid` int(50) default NULL,
  `nums` int(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pwn_member_nums`
--


-- --------------------------------------------------------

--
-- 表的结构 `pwn_member_onlinepay`
--

CREATE TABLE IF NOT EXISTS `pwn_member_onlinepay` (
  `id` int(11) NOT NULL auto_increment,
  `memberid` int(20) NOT NULL default '0',
  `payid` int(11) NOT NULL default '0',
  `paytype` char(30) NOT NULL default '',
  `paytotal` decimal(10,2) NOT NULL default '0.00',
  `ifpay` int(1) NOT NULL default '0',
  `addtime` int(11) NOT NULL default '0',
  `backtime` int(11) NOT NULL default '0',
  `ip` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `pwn_member_onlinepay`
--

INSERT INTO `pwn_member_onlinepay` (`id`, `memberid`, `payid`, `paytype`, `paytotal`, `ifpay`, `addtime`, `backtime`, `ip`) VALUES
(1, 156, 1, '支付宝', 1.00, 0, 1263868579, 0, '192.168.1.18'),
(2, 155, 1, '支付宝', 1.00, 0, 1265701509, 0, '192.168.1.18');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_member_pay`
--

CREATE TABLE IF NOT EXISTS `pwn_member_pay` (
  `id` int(11) NOT NULL auto_increment,
  `memberid` int(20) NOT NULL default '0',
  `payid` int(11) NOT NULL default '0',
  `payhb` varchar(30) NOT NULL default '',
  `payhl` decimal(12,4) NOT NULL default '0.0000',
  `oof` decimal(12,2) NOT NULL default '0.00',
  `method` varchar(200) NOT NULL default '',
  `type` varchar(50) NOT NULL default '',
  `addtime` int(11) NOT NULL default '0',
  `fpnum` varchar(100) NOT NULL default '',
  `memo` varchar(255) NOT NULL default '',
  `ip` varchar(20) NOT NULL default '',
  `logname` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `pwn_member_pay`
--

INSERT INTO `pwn_member_pay` (`id`, `memberid`, `payid`, `payhb`, `payhl`, `oof`, `method`, `type`, `addtime`, `fpnum`, `memo`, `ip`, `logname`) VALUES
(1, 155, 2, '', 0.0000, 396014.00, '送货上门收款', '收款确认', 1265618662, '', '', '192.168.1.123', '管理员');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_member_paycenter`
--

CREATE TABLE IF NOT EXISTS `pwn_member_paycenter` (
  `id` int(11) NOT NULL auto_increment,
  `pcenter` varchar(100) NOT NULL default '',
  `pcentertype` int(2) NOT NULL default '0',
  `pcenteruser` varchar(100) NOT NULL default '',
  `pcenterkey` text,
  `key1` text,
  `key2` text,
  `hbtype` varchar(255) NOT NULL default '',
  `postfile` varchar(100) NOT NULL default '',
  `recfile` varchar(100) NOT NULL default '',
  `ifuse` int(1) NOT NULL default '0',
  `ifback` int(1) NOT NULL default '0',
  `intro` text,
  `xuhao` int(5) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `pwn_member_paycenter`
--

INSERT INTO `pwn_member_paycenter` (`id`, `pcenter`, `pcentertype`, `pcenteruser`, `pcenterkey`, `key1`, `key2`, `hbtype`, `postfile`, `recfile`, `ifuse`, `ifback`, `intro`, `xuhao`) VALUES
(1, '支付宝', 1, '2088002053153634', '9fkjby5pbzscg61vil4pf6xwlp8b9w6d', 'wangjinmin1982@126.com', '', 'alipay_db', 'alipay_db_post.php', 'alipay_db_rec.php', 1, 1, '支付宝担保交易', 0),
(2, '送货上门收款', 0, '', '', '', '', '', '', '', 1, 1, '限本地送货上门收款', 1);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_member_regstep`
--

CREATE TABLE IF NOT EXISTS `pwn_member_regstep` (
  `id` int(8) NOT NULL auto_increment,
  `membertypeid` int(5) NOT NULL default '0',
  `regstep` varchar(30) NOT NULL,
  `stepname` varchar(50) NOT NULL,
  `xuhao` int(2) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=73 ;

--
-- 转存表中的数据 `pwn_member_regstep`
--

INSERT INTO `pwn_member_regstep` (`id`, `membertypeid`, `regstep`, `stepname`, `xuhao`) VALUES
(1, 0, 'person', '头像签名设置', 1),
(2, 0, 'detail', '会员资料设置', 2),
(3, 0, 'contact', '填写联系信息', 3),
(72, 26, 'contact', '填写联系信息', 3),
(71, 26, 'detail', '会员资料设置', 2),
(70, 26, 'person', '头像签名设置', 1);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_member_rights`
--

CREATE TABLE IF NOT EXISTS `pwn_member_rights` (
  `id` int(12) NOT NULL auto_increment,
  `memberid` int(12) NOT NULL default '0',
  `secureid` int(12) NOT NULL default '0',
  `securetype` char(100) NOT NULL,
  `secureset` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4718 ;

--
-- 转存表中的数据 `pwn_member_rights`
--

INSERT INTO `pwn_member_rights` (`id`, `memberid`, `secureid`, `securetype`, `secureset`) VALUES
(4653, 155, 133, 'func', '0'),
(4654, 155, 132, 'func', '0'),
(4655, 155, 127, 'func', '0'),
(4656, 155, 131, 'func', '0'),
(4657, 155, 126, 'class', ':1:2:'),
(4658, 155, 123, 'func', '0'),
(4659, 155, 122, 'func', '0'),
(4660, 155, 121, 'func', '0'),
(4661, 155, 114, 'func', '0'),
(4662, 155, 101, 'con', '1'),
(4663, 155, 111, 'func', '0'),
(4664, 155, 112, 'func', '0'),
(4665, 155, 113, 'func', '0'),
(4705, 159, 133, 'func', '0'),
(4706, 159, 132, 'func', '0'),
(4707, 159, 127, 'func', '0'),
(4708, 159, 131, 'func', '0'),
(4709, 159, 126, 'class', ':1:2:'),
(4710, 159, 123, 'func', '0'),
(4711, 159, 122, 'func', '0'),
(4712, 159, 121, 'func', '0'),
(4713, 159, 114, 'func', '0'),
(4714, 159, 101, 'con', '1'),
(4715, 159, 111, 'func', '0'),
(4716, 159, 112, 'func', '0'),
(4717, 159, 113, 'func', '0');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_member_secure`
--

CREATE TABLE IF NOT EXISTS `pwn_member_secure` (
  `id` int(12) NOT NULL auto_increment,
  `coltype` varchar(30) NOT NULL,
  `securename` char(100) NOT NULL default '',
  `securetype` char(30) NOT NULL default '',
  `xuhao` int(12) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=195 ;

--
-- 转存表中的数据 `pwn_member_secure`
--

INSERT INTO `pwn_member_secure` (`id`, `coltype`, `securename`, `securetype`, `xuhao`) VALUES
(101, 'base', '内容阅读权限级别', 'con', 1),
(111, 'member', '会员登录帐号设置', 'func', 2),
(112, 'member', '会员头像签名设置', 'func', 3),
(113, 'member', '会员个人资料修改', 'func', 4),
(114, 'member', '会员联系信息修改', 'func', 5),
(121, 'news', '文章发布权限', 'func', 6),
(122, 'news', '文章修改权限', 'func', 7),
(123, 'news', '文章发布/修改免审核权限', 'func', 8),
(124, 'news', '文章图片上传权限', 'func', 5),
(125, 'news', '文章附件上传权限', 'func', 8),
(126, 'news', '文章公共分类投稿授权', 'class', 12),
(127, 'news', '文章自定义分类权限', 'func', 9),
(129, 'news', '文章版主权限(推荐/删除)', 'banzhu', 9),
(151, 'photo', '图片发布权限', 'func', 6),
(152, 'photo', '图片修改权限', 'func', 7),
(153, 'photo', '图片发布/修改免审核权限', 'func', 8),
(156, 'photo', '图片公共分类投稿授权', 'class', 11),
(157, 'photo', '图片自定义分类权限', 'func', 9),
(159, 'photo', '图片版主权限(推荐/删除)', 'banzhu', 9),
(186, 'product', '会员产品公共分类发布授权', 'class', 11),
(184, 'product', '会员产品介绍编辑器图片上传权限', 'func', 9),
(183, 'product', '会员产品发布/修改免审核权限', 'func', 8),
(182, 'product', '会员产品修改权限', 'func', 7),
(181, 'product', '会员产品发布权限', 'func', 6),
(187, 'product', '会员产品自定义分类权限', 'func', 9),
(189, 'product', '产品版主管理权限(推荐/删除)', 'banzhu', 9);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_member_type`
--

CREATE TABLE IF NOT EXISTS `pwn_member_type` (
  `membertypeid` int(6) NOT NULL auto_increment,
  `membertype` varchar(100) default NULL,
  `membergroupid` int(3) NOT NULL default '0',
  `ifcanreg` int(1) default NULL,
  `ifchecked` int(1) default NULL,
  `regxy` text,
  `regmail` text,
  `expday` int(8) default NULL,
  `startcent` int(20) default NULL,
  `endcent` int(20) default NULL,
  `menugroupid` int(5) NOT NULL default '4',
  PRIMARY KEY  (`membertypeid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- 转存表中的数据 `pwn_member_type`
--

INSERT INTO `pwn_member_type` (`membertypeid`, `membertype`, `membergroupid`, `ifcanreg`, `ifchecked`, `regxy`, `regmail`, `expday`, `startcent`, `endcent`, `menugroupid`) VALUES
(26, '会员', 1, 1, 1, '会员注册协议\r\n\r\n1.\r\n2.\r\n3.\r\n4.\r\n5.\r\n', '{#user#},您好!\r\n\r\n感谢您在本站注册!\r\n\r\n会员名: {#user#}\r\n密码: {#password#}\r\n\r\n网址:http://', 0, 0, 0, 58);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_member_zone`
--

CREATE TABLE IF NOT EXISTS `pwn_member_zone` (
  `catid` int(12) NOT NULL auto_increment,
  `pid` int(12) default NULL,
  `cat` char(50) default NULL,
  `xuhao` int(4) default NULL,
  `catpath` char(255) default NULL,
  PRIMARY KEY  (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- 转存表中的数据 `pwn_member_zone`
--

INSERT INTO `pwn_member_zone` (`catid`, `pid`, `cat`, `xuhao`, `catpath`) VALUES
(1, 0, '北京', 1, '0001:'),
(2, 0, '上海', 2, '0002:'),
(3, 0, '天津', 3, '0003:'),
(4, 0, '重庆', 4, '0004:'),
(5, 0, '浙江', 5, '0005:'),
(6, 0, '江苏', 6, '0006:'),
(7, 0, '广东', 7, '0007:'),
(8, 5, '杭州', 1, '0005:0008:'),
(9, 5, '嘉兴', 2, '0005:0009:'),
(10, 6, '南京', 1, '0006:0010:'),
(11, 6, '苏州', 2, '0006:0011:'),
(12, 7, '广州', 1, '0007:0012:'),
(13, 7, '深圳', 2, '0007:0013:'),
(21, 5, '宁波', 3, '0005:0021:'),
(26, 5, '舟山', 8, '0005:0026:'),
(25, 5, '金华', 7, '0005:0025:'),
(23, 5, '温州', 5, '0005:0023:'),
(22, 5, '湖州', 4, '0005:0022:'),
(24, 5, '台州', 6, '0005:0024:');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_menu`
--

CREATE TABLE IF NOT EXISTS `pwn_menu` (
  `id` int(12) NOT NULL auto_increment,
  `groupid` int(6) NOT NULL default '1',
  `pid` int(6) NOT NULL default '0',
  `menu` varchar(50) NOT NULL default '',
  `linktype` int(1) NOT NULL default '1',
  `coltype` varchar(30) NOT NULL default '',
  `folder` varchar(100) NOT NULL,
  `url` varchar(200) NOT NULL default '',
  `ifshow` int(1) NOT NULL default '0',
  `xuhao` int(4) NOT NULL default '0',
  `target` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=400 ;

--
-- 转存表中的数据 `pwn_menu`
--

INSERT INTO `pwn_menu` (`id`, `groupid`, `pid`, `menu`, `linktype`, `coltype`, `folder`, `url`, `ifshow`, `xuhao`, `target`) VALUES
(3, 1, 0, '产品中心', 1, '', 'product/class/', 'http://ssss.com', 1, 4, '_self'),
(80, 1, 0, '公司简介', 1, '', 'page/html/company.php', 'http://', 1, 2, '_self'),
(83, 1, 0, '网站首页', 0, 'index', '', 'http://', 1, 1, '_self'),
(152, 3, 0, '关于我们', 1, '', 'page/html/company.php', 'http://', 1, 1, '_self'),
(153, 3, 0, '联系方式', 1, '', 'page/contact/contact.php', 'http://', 1, 2, '_self'),
(317, 3, 0, '友情链接', 1, '', 'advs/link/', 'http://', 1, 13, '_self'),
(335, 1, 0, '技术专栏', 1, '', 'news/class/?114.html', 'http://', 1, 6, '_self'),
(357, 3, 0, '信息反馈', 1, '', 'page/contact/message.php', 'http://', 1, 3, '_self'),
(373, 1, 0, '联系我们', 1, '', 'page/contact/contact.php', 'http://', 1, 8, '_self'),
(388, 1, 0, '人才招聘', 0, 'job', '', 'http://', 1, 7, '_self'),
(389, 3, 0, '人才招聘', 0, 'job', '', 'http://', 1, 6, '_self'),
(390, 1, 0, '新闻资讯', 1, '', 'news/class/', 'http://', 1, 3, '_self');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_menu_group`
--

CREATE TABLE IF NOT EXISTS `pwn_menu_group` (
  `id` int(3) NOT NULL auto_increment,
  `groupname` varchar(50) NOT NULL default '',
  `xuhao` int(5) NOT NULL default '0',
  `moveable` int(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- 转存表中的数据 `pwn_menu_group`
--

INSERT INTO `pwn_menu_group` (`id`, `groupname`, `xuhao`, `moveable`) VALUES
(1, '频道导航菜单', 1, 0),
(2, '顶部导航菜单', 2, 0),
(3, '底部导航菜单', 3, 0);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_news_cat`
--

CREATE TABLE IF NOT EXISTS `pwn_news_cat` (
  `catid` int(12) NOT NULL auto_increment,
  `pid` int(12) NOT NULL default '0',
  `cat` char(100) NOT NULL default '',
  `xuhao` int(12) NOT NULL default '0',
  `catpath` char(255) NOT NULL default '',
  `nums` int(20) NOT NULL default '0',
  `tj` int(1) NOT NULL default '0',
  `ifchannel` int(1) NOT NULL default '0',
  PRIMARY KEY  (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=115 ;

--
-- 转存表中的数据 `pwn_news_cat`
--

INSERT INTO `pwn_news_cat` (`catid`, `pid`, `cat`, `xuhao`, `catpath`, `nums`, `tj`, `ifchannel`) VALUES
(86, 0, '公司新闻', 2, '0086:', 0, 0, 0),
(95, 0, '行业动态', 3, '0095:', 0, 0, 0),
(114, 0, '技术专栏', 4, '0114:', 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_news_con`
--

CREATE TABLE IF NOT EXISTS `pwn_news_con` (
  `id` int(12) NOT NULL auto_increment,
  `catid` int(12) NOT NULL default '0',
  `catpath` varchar(255) NOT NULL default '',
  `pcatid` int(12) NOT NULL default '0',
  `contype` varchar(20) NOT NULL default 'news',
  `title` varchar(255) NOT NULL default '',
  `body` text,
  `dtime` int(11) default '0',
  `xuhao` int(5) default '0',
  `cl` int(20) default NULL,
  `tj` int(1) default NULL,
  `iffb` int(1) default '0',
  `ifbold` int(1) default '0',
  `ifred` varchar(20) default NULL,
  `type` varchar(30) NOT NULL default '',
  `src` varchar(150) NOT NULL default '',
  `uptime` int(11) default '0',
  `author` varchar(100) default NULL,
  `source` varchar(100) default NULL,
  `memberid` varchar(100) default NULL,
  `proj` varchar(255) NOT NULL default '',
  `secure` int(11) NOT NULL default '0',
  `memo` text NOT NULL,
  `prop1` char(255) NOT NULL default '',
  `prop2` char(255) NOT NULL default '',
  `prop3` char(255) NOT NULL default '',
  `prop4` char(255) NOT NULL default '',
  `prop5` char(255) NOT NULL default '',
  `prop6` char(255) NOT NULL default '',
  `prop7` char(255) NOT NULL default '',
  `prop8` char(255) NOT NULL default '',
  `prop9` char(255) NOT NULL default '',
  `prop10` char(255) NOT NULL default '',
  `prop11` char(255) NOT NULL default '',
  `prop12` char(255) NOT NULL default '',
  `prop13` char(255) NOT NULL default '',
  `prop14` char(255) NOT NULL default '',
  `prop15` char(255) NOT NULL default '',
  `prop16` char(255) NOT NULL default '',
  `prop17` char(255) NOT NULL default '',
  `prop18` char(255) NOT NULL default '',
  `prop19` char(255) NOT NULL default '',
  `prop20` char(255) NOT NULL default '',
  `fileurl` varchar(100) NOT NULL,
  `tourl` varchar(255) NOT NULL,
  `downcount` int(10) NOT NULL default '0',
  `tags` varchar(255) NOT NULL,
  `zhichi` int(5) NOT NULL default '0',
  `fandui` int(5) NOT NULL default '0',
  `tplog` text NOT NULL,
  `downcentid` int(1) NOT NULL default '1',
  `downcent` int(5) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=431 ;

--
-- 转存表中的数据 `pwn_news_con`
--

INSERT INTO `pwn_news_con` (`id`, `catid`, `catpath`, `pcatid`, `contype`, `title`, `body`, `dtime`, `xuhao`, `cl`, `tj`, `iffb`, `ifbold`, `ifred`, `type`, `src`, `uptime`, `author`, `source`, `memberid`, `proj`, `secure`, `memo`, `prop1`, `prop2`, `prop3`, `prop4`, `prop5`, `prop6`, `prop7`, `prop8`, `prop9`, `prop10`, `prop11`, `prop12`, `prop13`, `prop14`, `prop15`, `prop16`, `prop17`, `prop18`, `prop19`, `prop20`, `fileurl`, `tourl`, `downcount`, `tags`, `zhichi`, `fandui`, `tplog`, `downcentid`, `downcent`) VALUES
(321, 86, '0086:', 0, 'news', '全面实施国际质量管理和质量保证体系司全面国际质量管理和质量保证体系', '<p>公司全面实施ISO9000、2000国际质量管理和质量保证体系</p>\r\n<p>公司全面实施ISO9000、2000国际质量管理和质量保证体系</p>\r\n<p>公司全面实施ISO9000、2000国际质量管理和质量保证体系</p>\r\n<p>公司全面实施ISO9000、2000国际质量管理和质量保证体系</p>\r\n<p>公司全面实施ISO9000、2000国际质量管理和质量保证体系</p>\r\n<p>公司全面实施ISO9000、2000国际质量管理和质量保证体系</p>\r\n<p>公司全面实施ISO9000、2000国际质量管理和质量保证体系</p>', 1260424795, 0, 13, 0, 1, 0, '0', 'gif', '', 1270196017, '管理员', '', '0', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'http://', '', 0, '', 0, 0, '', 1, 0),
(418, 114, '0114:', 0, 'news', '油菜花角期管理抓三防', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 油菜花角期管理抓三防油菜花角期管理抓三防油菜花角期管理抓三防油菜花角期管理抓三防油菜花角期管理抓三防油菜花角期管理抓三防油菜花角期管理抓三防油菜花角期管理抓三防油菜花角期管理抓三防', 1270695166, 0, 8, 0, 1, 0, '0', 'gif', '', 1281000690, '管理员', '', '0', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'http://', '', 0, '', 0, 0, '', 1, 0),
(428, 114, '0114:', 0, 'news', '菜花角期管理抓三防油菜花角期管理抓三防', '油菜花角期管理抓三防油菜花角期管理抓三防油菜花角期管理抓三防油菜花角期管理抓三防油菜花角期管理抓三防油菜花角期管理抓三防油菜花角期管理抓三防油菜花角期管理抓三防油菜花角期管理抓三防油菜花角期管理抓三防油菜花角期管理抓三防', 1281000729, 0, 4, 0, 1, 0, '0', 'gif', '', 1281000729, '管理员', '', '0', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'http://', '', 0, '', 0, 0, '', 1, 0),
(409, 86, '0086:', 0, 'news', '形势下中国种业面临的问题与对策', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 新形势下中国种业面临的问题与对策新形势下中国种业面临的问题与对策新形势下中国种业面临的问题与对策', 1270537870, 0, 7, 1, 1, 0, '0', 'gif', '', 1281000488, '管理员', '', '0', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'http://', '', 0, '', 0, 0, '', 1, 0),
(412, 86, '0086:', 0, 'news', '玉米新品种——东玉3号', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 玉米新品种——东玉3号玉米新品种——东玉3号玉米新品种——东玉3号玉米新品种——东玉3号玉米新品种——东玉3号玉米新品种——东玉3号玉米新品种——东玉3号', 1270538097, 0, 0, 0, 1, 0, '0', 'gif', '', 1281000523, '管理员', '', '0', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'http://', '', 0, '', 0, 0, '', 1, 0),
(423, 114, '0114:', 0, 'news', '秋西红柿病虫害管理技巧秋西红柿病虫害管理技巧', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 秋西红柿病虫害管理技巧秋西红柿病虫害管理技巧秋西红柿病虫害管理技巧秋西红柿病虫害管理技巧秋西红柿病虫害管理技巧秋西红柿病虫害管理技巧秋西红柿病虫害管理技巧秋西红柿病虫害管理技巧 ', 1272423779, 0, 6, 0, 1, 0, '0', 'gif', '', 1281000742, '管理员', '', '0', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'http://', '', 0, '', 0, 0, '', 1, 0),
(426, 114, '0114:', 0, 'news', '如何正确高效的使用冲施肥', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 如何正确高效的使用冲施肥如何正确高效的使用冲施肥如何正确高效的使用冲施肥如何正确高效的使用冲施肥如何正确高效的使用冲施肥如何正确高效的使用冲施肥如何正确高效的使用冲施肥如何正确高效的使用冲施肥', 1272424058, 0, 8, 0, 1, 0, '0', 'gif', '', 1281000644, '管理员', '', '0', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'http://', '', 0, '', 0, 0, '', 1, 0),
(427, 86, '0086:', 0, 'news', '新形势下中国种业面临的问题与对策', '新形势下中国种业面临的问题与对策新形势下中国种业面临的问题与对策新形势下中国种业面临的问题与对策新形势下中国种业面临的问题与对策', 1277344344, 0, 15, 0, 1, 0, '0', 'gif', '', 1281000467, '管理员', '', '0', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'http://', '', 0, '', 0, 0, '', 1, 0),
(429, 86, '0086:', 0, 'news', '形势下中国种业面临的问题与对策', '形势下中国种业面临的问题与对策形势下中国种业面临的问题与对策形势下中国种业面临的问题与对策形势下中国种业面临的问题与对策形势下中国种业面临的问题与对策形势下中国种业面临的问题与对策形势下中国种业面临的问题与对策形势下中国种业面临的问题与对策形势下中国种业面临的问题与对策形势下中国种业面临的问题与对策形势下中国种业面临的问题与对策形势下中国种业面临的问题与对策', 1290140840, 0, 2, 0, 1, 0, '0', 'gif', '', 1290140840, '管理员', '', '0', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'http://', 'http://', 0, '', 0, 0, '', 1, 0),
(430, 114, '0114:', 0, 'news', '西红柿病虫害管理技巧秋西红柿病虫害管理技巧', '西红柿病虫害管理技巧秋西红柿病虫害管理技巧西红柿病虫害管理技巧秋西红柿病虫害管理技巧西红柿病虫害管理技巧秋西红柿病虫害管理技巧西红柿病虫害管理技巧秋西红柿病虫害管理技巧西红柿病虫害管理技巧秋西红柿病虫害管理技巧西红柿病虫害管理技巧秋西红柿病虫害管理技巧', 1290140856, 0, 5, 0, 1, 0, '0', 'gif', '', 1290140856, '管理员', '', '0', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'http://', 'http://', 0, '', 0, 0, '', 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_news_config`
--

CREATE TABLE IF NOT EXISTS `pwn_news_config` (
  `xuhao` int(3) NOT NULL default '0',
  `vname` varchar(50) NOT NULL default '',
  `settype` varchar(30) NOT NULL default 'input',
  `colwidth` varchar(3) NOT NULL default '30',
  `variable` varchar(32) NOT NULL default '',
  `value` text NOT NULL,
  `intro` text NOT NULL,
  PRIMARY KEY  (`variable`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pwn_news_config`
--

INSERT INTO `pwn_news_config` (`xuhao`, `vname`, `settype`, `colwidth`, `variable`, `value`, `intro`) VALUES
(5, '文章主题图片上传尺寸限制(Byte)', 'input', '30', 'PicSizeLimit', '256000', '会员发布文章上传主题图片时,单个图片尺寸的限制'),
(6, '文章编辑器图片上传限制(Byte)', 'input', '30', 'EditPicLimit', '512000', '会员发布文章时,在编辑器内上传图片,单个图片的尺寸限制'),
(1, '模块频道名称', 'input', '30', 'ChannelName', '新闻中心', '本模块对应的频道名称，如“新闻中心”；用于显示在网页标题、当前位置提示条等处'),
(2, '是否在当前位置提示条显示模块频道名称', 'YN', '30', 'ChannelNameInNav', '1', '是否在当前位置提示条显示模块频道名称'),
(7, '附件上传大小限制', 'input', '30', 'FileSizeLimit', '1024000', '会员发布文章上传附件时,允许上传附件的文件大小;但最高设置不能超过2M '),
(8, '会员发布文章关键词过滤', 'textarea', '30', 'KeywordDeny', '', '会员发布文章时禁止的词语，多个以逗号分割');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_news_downlog`
--

CREATE TABLE IF NOT EXISTS `pwn_news_downlog` (
  `id` int(12) NOT NULL auto_increment,
  `newsid` int(12) NOT NULL default '0',
  `memberid` int(12) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pwn_news_downlog`
--


-- --------------------------------------------------------

--
-- 表的结构 `pwn_news_pages`
--

CREATE TABLE IF NOT EXISTS `pwn_news_pages` (
  `id` int(12) NOT NULL auto_increment,
  `newsid` int(12) NOT NULL default '0',
  `body` text NOT NULL,
  `xuhao` int(5) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=112 ;

--
-- 转存表中的数据 `pwn_news_pages`
--


-- --------------------------------------------------------

--
-- 表的结构 `pwn_news_pcat`
--

CREATE TABLE IF NOT EXISTS `pwn_news_pcat` (
  `catid` int(12) NOT NULL auto_increment,
  `memberid` int(12) NOT NULL default '0',
  `pid` int(12) NOT NULL default '0',
  `cat` char(100) NOT NULL default '',
  `xuhao` int(12) NOT NULL default '0',
  `catpath` char(255) NOT NULL default '',
  PRIMARY KEY  (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `pwn_news_pcat`
--

INSERT INTO `pwn_news_pcat` (`catid`, `memberid`, `pid`, `cat`, `xuhao`, `catpath`) VALUES
(2, 150, 0, '新增分类', 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_news_proj`
--

CREATE TABLE IF NOT EXISTS `pwn_news_proj` (
  `id` int(12) NOT NULL auto_increment,
  `project` varchar(100) default NULL,
  `folder` varchar(30) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- 转存表中的数据 `pwn_news_proj`
--


-- --------------------------------------------------------

--
-- 表的结构 `pwn_news_prop`
--

CREATE TABLE IF NOT EXISTS `pwn_news_prop` (
  `id` int(20) NOT NULL auto_increment,
  `catid` int(20) NOT NULL default '0',
  `propname` char(30) default NULL,
  `xuhao` int(20) default NULL,
  PRIMARY KEY  (`id`),
  KEY `xuhao` (`xuhao`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pwn_news_prop`
--


-- --------------------------------------------------------

--
-- 表的结构 `pwn_page`
--

CREATE TABLE IF NOT EXISTS `pwn_page` (
  `id` int(12) NOT NULL auto_increment,
  `groupid` int(6) NOT NULL default '1',
  `title` varchar(200) NOT NULL default '',
  `body` text NOT NULL,
  `xuhao` int(4) NOT NULL default '0',
  `src` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  `memo` text NOT NULL,
  `pagefolder` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=121 ;

--
-- 转存表中的数据 `pwn_page`
--

INSERT INTO `pwn_page` (`id`, `groupid`, `title`, `body`, `xuhao`, `src`, `url`, `memo`, `pagefolder`) VALUES
(1, 1, '公司简介', '<img style="PADDING-RIGHT: 20px; FLOAT: left;padding-bottom:10px;" alt="" src="[ROOTPATH]page/pics/20100806/201008061281055683531.jpg" border=0 />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;某某农业科技开发有限公司始创于1992年，是一家集科研、生产、销售、技术服务于一体的规模化专业型农业科技公司。公司本着“科技为民所用”的原则，致力于农业科技成果的转化和推广，在研发具有自主知识产权产品的同时，以亚洲为中心，积极引进和筛选来自世界各地的优质产品资源。目前，公司拥有子公司四个，经营着大田作物种子、蔬菜种子和农化产品三块业务，在企业经营管理上实行董事会领导下的总经理负责制。按照现代企业制度的要求，坚持有利于科研、有利于生产、有利于销售的“三个有利于”原则；在管理机构的设置上则坚持减少层次、职责分明、提高效率的原则。<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 项目的建设、生产/销售等完全实行自主经营、自负盈亏、风险与业绩挂钩，与市场经济相适应的经营管理机制，建立起了灵活、机动的企业管理体系。为了使企业能够持续、健康、稳定地发展，公司将所获利润的较大部分投入到了产品研发之中，在自主研发与合作开发的理念指导下，与国内众多大专院校、科研机构及企业有着密切地交流及技术往来，并建立了科研试验基地160多亩。公司有着稳定的种子生产基地、严格的试验筛选及生产加工流程。销售方面，公司经过多年的探索和创新，开发出了一套惠及各方利益的市场运作方案，建立起了1100余个销售服务网点，使公司及产品在当地都形成了良好的口碑。 作为一名发展势头强劲的农业科技新贵，公司正以快速而稳健的步伐走在种子行业的前沿，并逐步向集团化公司过渡。我们坚信：在全体同仁的共同努力下，公司的明天会更美好，一定能够在农业的腾飞中大放异彩！ ', 1, '', '', '', 'company'),
(11, 1, '荣誉证书', '<p>&nbsp;</p>', 3, '', '', '', 'honor'),
(73, 22, '信息反馈', '', 3, '', '', '', 'message'),
(64, 22, '联系方式', '地 址：杭州市莫干山路2168号<br />电 话：0571-98765432<br />联系人：杨军(经理)<br />手 机：15887654321<br />网址：www.aaaa.com<br />邮 箱：bos@mail.com<br />地 址：杭州市莫干山路2168号<br />电 话：0571-98765432<br />联系人：杨军(经理)<br />手 机：15887654321<br />网址：www.aaaa.com<br />邮 箱：bos@mail.com<br />邮 编：300009', 1, '', '', '', 'contact'),
(76, 1, '企业文化', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 公司企业文化我们的使命：真诚与科技的紧密结合推动农业发展。我们的愿景：通过学习与交流始终处于行业前沿。我们的核心价值观：从顾客满意中获利，从顾客进步中成长。我们的服务理念： 倾至真至诚之心、完尽善尽美之事。公司企业文化我们的使命：真诚与科技的紧密结合推动农业发展。我们的愿景：通过学习与交流始终处于行业前沿。我们的核心价值观：从顾客满意中获利，从顾客进步中成长。我们的服务理念： 倾至真至诚之心、完尽善尽美之事。公司企业文化我们的使命：真诚与科技的紧密结合推动农业发展。我们的愿景：通过学习与交流始终处于行业前沿。我们的核心价值观：从顾客满意中获利，从顾客进步中成长。我们的服务理念： 倾至真至诚之心、完尽善尽美之事。公司企业文化我们的使命：真诚与科技的紧密结合推动农业发展。我们的愿景：通过学习与交流始终处于行业前沿。我们的核心价值观：从顾客满意中获利，从顾客进步中成长。我们的服务理念： 倾至真至诚之心、完尽善尽美之事。', 5, '', '', '', 'culture'),
(111, 1, '经理致辞', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 新老朋友们，我们能在这有限的空间相见，是我们的缘分，承您的关爱来到本站，我代表公司全体员工向您表示最热烈的欢迎！某某农业，如一轮朝阳，升腾于彩云之东。从开始创业时的步履维艰到今天的种业新贵，农业正以健康而快速的步伐向种业的领先位置迈进。忆往昔创业之艰，展今朝丰盛之美。我们深深铭记各级领导、种业同仁的大力支持和殷切关怀；深深感激广大用户的充分信任和高度肯定，使农业成为一个拥有良好形象与核心竞争力的农业品牌，这一切来之不易！“人生需执着才能恒久生辉、事业要用心方可丰盛光华”。公司的成长和进步源于这种精神，也正是这种精神使春喜经受住了风雨的磨励，在市场中披荆斩棘，不断壮大；在竞争中锐意进取，创新升华。目前，公司已逐步成为集科研、生产、销售、技术服务于一体的具有一定规模的规范化、专业型的农业科技公司，时刻以现代企业先进的管理及营销理念武装自己，通过与同行找差距、向优秀的同行学习，我们不断地成长、不断地进步！展望未来，我们充满信心，一个充溢着诚信，一个以造福民众与己任的品牌将恒久屹立与彩云之东，并不断地向更广阔的空间扩展。衷心希望能和更多的朋友真诚交流、共谋发展！！', 2, '', '', '', 'words'),
(119, 22, '营销网络', '<img alt="" style="padding-left:40px;" src="[ROOTPATH]page/pics/20100806/201008061281055128734.gif" border=0 /> ', 4, '', '', '', 'sales'),
(120, 1, '研发中心', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 目前，公司拥有子公司四个，经营着大田作物种子、蔬菜种子和农化产品三块业务，在企业经营管理上实行董事会领导下的总经理负责制。按照现代企业制度的要求，坚持有利于科研、有利于生产、有利于销售的“三个有利于”原则；在管理机构的设置上则坚持减少层次、职责分明、提高效率的原则。 项目的建设、生产/销售等完全实行自主经营、自负盈亏、风险与业绩挂钩，与市场经济相适应的经营管理机制，建立起了灵活、机动的企业管理体系。为了使企业能够持续、健康、稳定地发展，公司将所获利润的较大部分投入到了产品研发之中，在自主研发与合作开发的理念指导下，与国内众多大专院校、科研机构及企业有着密切地交流及技术往来，并建立了科研试验基地160多亩。公司有着稳定的种子生产基地、严格的试验筛选及生产加工流程。销售方面，公司经过多年的探索和创新，开发出了一套惠及各方利益的市场运作方案，建立起了1100余个销售服务网点，使公司及产品在当地都形成了良好的口碑。', 6, '', '', '', 'research');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_page_group`
--

CREATE TABLE IF NOT EXISTS `pwn_page_group` (
  `id` int(3) NOT NULL auto_increment,
  `groupname` varchar(50) NOT NULL default '',
  `xuhao` int(5) NOT NULL default '0',
  `moveable` int(1) NOT NULL default '1',
  `folder` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=38 ;

--
-- 转存表中的数据 `pwn_page_group`
--

INSERT INTO `pwn_page_group` (`id`, `groupname`, `xuhao`, `moveable`, `folder`) VALUES
(1, '公司简介', 1, 0, 'html'),
(22, '联系我们', 1, 1, 'contact');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_photo_cat`
--

CREATE TABLE IF NOT EXISTS `pwn_photo_cat` (
  `catid` int(12) NOT NULL auto_increment,
  `pid` int(12) default NULL,
  `cat` char(100) default NULL,
  `xuhao` int(12) default NULL,
  `catpath` char(255) default NULL,
  `nums` int(20) default NULL,
  `tj` int(1) NOT NULL default '0',
  `ifchannel` int(1) NOT NULL default '0',
  PRIMARY KEY  (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `pwn_photo_cat`
--

INSERT INTO `pwn_photo_cat` (`catid`, `pid`, `cat`, `xuhao`, `catpath`, `nums`, `tj`, `ifchannel`) VALUES
(8, 0, '荣誉证书', 5, '0008:', 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_photo_con`
--

CREATE TABLE IF NOT EXISTS `pwn_photo_con` (
  `id` int(12) NOT NULL auto_increment,
  `catid` int(12) NOT NULL default '0',
  `catpath` varchar(255) NOT NULL default '',
  `pcatid` int(12) NOT NULL default '0',
  `contype` varchar(20) NOT NULL default 'photo',
  `title` varchar(255) NOT NULL default '',
  `body` text,
  `dtime` int(11) default '0',
  `xuhao` int(5) default '0',
  `cl` int(20) default NULL,
  `tj` int(1) default NULL,
  `iffb` int(1) default '0',
  `ifbold` int(1) default '0',
  `ifred` varchar(20) default NULL,
  `type` varchar(30) NOT NULL default '',
  `src` varchar(150) NOT NULL default '',
  `uptime` int(11) default '0',
  `author` varchar(100) default NULL,
  `source` varchar(100) default NULL,
  `memberid` varchar(100) default NULL,
  `proj` varchar(255) NOT NULL default '',
  `secure` int(11) NOT NULL default '0',
  `memo` text NOT NULL,
  `prop1` char(255) NOT NULL default '',
  `prop2` char(255) NOT NULL default '',
  `prop3` char(255) NOT NULL default '',
  `prop4` char(255) NOT NULL default '',
  `prop5` char(255) NOT NULL default '',
  `prop6` char(255) NOT NULL default '',
  `prop7` char(255) NOT NULL default '',
  `prop8` char(255) NOT NULL default '',
  `prop9` char(255) NOT NULL default '',
  `prop10` char(255) NOT NULL default '',
  `prop11` char(255) NOT NULL default '',
  `prop12` char(255) NOT NULL default '',
  `prop13` char(255) NOT NULL default '',
  `prop14` char(255) NOT NULL default '',
  `prop15` char(255) NOT NULL default '',
  `prop16` char(255) NOT NULL default '',
  `prop17` char(255) NOT NULL default '',
  `prop18` char(255) NOT NULL default '',
  `prop19` char(255) NOT NULL default '',
  `prop20` char(255) NOT NULL default '',
  `tags` varchar(255) NOT NULL,
  `zhichi` int(5) NOT NULL default '0',
  `fandui` int(5) NOT NULL default '0',
  `tplog` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=68 ;

--
-- 转存表中的数据 `pwn_photo_con`
--

INSERT INTO `pwn_photo_con` (`id`, `catid`, `catpath`, `pcatid`, `contype`, `title`, `body`, `dtime`, `xuhao`, `cl`, `tj`, `iffb`, `ifbold`, `ifred`, `type`, `src`, `uptime`, `author`, `source`, `memberid`, `proj`, `secure`, `memo`, `prop1`, `prop2`, `prop3`, `prop4`, `prop5`, `prop6`, `prop7`, `prop8`, `prop9`, `prop10`, `prop11`, `prop12`, `prop13`, `prop14`, `prop15`, `prop16`, `prop17`, `prop18`, `prop19`, `prop20`, `tags`, `zhichi`, `fandui`, `tplog`) VALUES
(32, 8, '0008:', 0, 'photo', '三优三信单位', '', 1262855311, 0, 0, 0, 1, 0, '0', 'gif', 'photo/pics/20100107/1262855311.gif', 1265678744, '管理员', '', '0', '', 0, '三优三信单位', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, ''),
(33, 8, '0008:', 0, 'photo', '质量认证', '', 1262855322, 0, 1, 0, 1, 0, '0', 'gif', 'photo/pics/20100107/1262855322.gif', 1270537222, '管理员', '', '0', '', 0, '商会单位', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, ''),
(41, 8, '0008:', 0, 'photo', '三优三信单位', '', 1263189185, 0, 3, 0, 1, 0, '0', 'gif', 'photo/pics/20100111/1263189185.gif', 1265678732, '管理员', '', '0', '', 0, '三优三信单位', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, ''),
(42, 8, '0008:', 0, 'photo', '商会单位', '', 1263189198, 0, 4, 0, 1, 0, '0', 'gif', 'photo/pics/20100111/1263189198.gif', 1265678779, '管理员', '', '0', '', 0, '商会单位', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, ''),
(43, 8, '0008:', 0, 'photo', '三优三信单位', '', 1263189228, 0, 12, 0, 1, 0, '0', 'gif', 'photo/pics/20100111/1263189228.gif', 1265678754, '管理员', '', '0', '', 0, '三优三信单位', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, ''),
(44, 8, '0008:', 0, 'photo', '商会单位', '', 1263189240, 0, 171, 0, 1, 0, '0', 'gif', 'photo/pics/20100111/1263189240.gif', 1265678792, '管理员', '', '0', '', 0, '商会单位', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_photo_config`
--

CREATE TABLE IF NOT EXISTS `pwn_photo_config` (
  `xuhao` int(3) NOT NULL default '0',
  `vname` varchar(50) NOT NULL default '',
  `settype` varchar(30) NOT NULL default 'input',
  `colwidth` varchar(3) NOT NULL default '30',
  `variable` varchar(32) NOT NULL default '',
  `value` text NOT NULL,
  `intro` text NOT NULL,
  PRIMARY KEY  (`variable`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pwn_photo_config`
--

INSERT INTO `pwn_photo_config` (`xuhao`, `vname`, `settype`, `colwidth`, `variable`, `value`, `intro`) VALUES
(1, '模块频道名称', 'input', '30', 'ChannelName', '企业图库', '本模块对应的频道名称，如“图片展示”；用于显示在网页标题、当前位置提示条等处'),
(2, '是否在当前位置提示条显示模块频道名称', 'YN', '30', 'ChannelNameInNav', '1', '是否在当前位置提示条显示模块频道名称'),
(5, '会员上传图片尺寸限制(Byte)', 'input', '30', 'PicSizeLimit', '256000', '会员上传图片时,单个图片尺寸的限制');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_photo_pages`
--

CREATE TABLE IF NOT EXISTS `pwn_photo_pages` (
  `id` int(12) NOT NULL auto_increment,
  `photoid` int(12) NOT NULL default '0',
  `src` varchar(150) NOT NULL default '',
  `xuhao` int(5) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pwn_photo_pages`
--


-- --------------------------------------------------------

--
-- 表的结构 `pwn_photo_pcat`
--

CREATE TABLE IF NOT EXISTS `pwn_photo_pcat` (
  `catid` int(12) NOT NULL auto_increment,
  `memberid` int(12) NOT NULL default '0',
  `pid` int(12) NOT NULL default '0',
  `cat` char(100) NOT NULL default '',
  `xuhao` int(12) NOT NULL default '0',
  `catpath` char(255) NOT NULL default '',
  PRIMARY KEY  (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pwn_photo_pcat`
--


-- --------------------------------------------------------

--
-- 表的结构 `pwn_photo_proj`
--

CREATE TABLE IF NOT EXISTS `pwn_photo_proj` (
  `id` int(12) NOT NULL auto_increment,
  `project` varchar(100) default NULL,
  `folder` varchar(30) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pwn_photo_proj`
--


-- --------------------------------------------------------

--
-- 表的结构 `pwn_photo_prop`
--

CREATE TABLE IF NOT EXISTS `pwn_photo_prop` (
  `id` int(20) NOT NULL auto_increment,
  `catid` int(20) NOT NULL default '0',
  `propname` char(30) default NULL,
  `xuhao` int(20) default NULL,
  PRIMARY KEY  (`id`),
  KEY `xuhao` (`xuhao`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pwn_photo_prop`
--


-- --------------------------------------------------------

--
-- 表的结构 `pwn_product_cat`
--

CREATE TABLE IF NOT EXISTS `pwn_product_cat` (
  `catid` int(12) NOT NULL auto_increment,
  `pid` int(12) default NULL,
  `cat` char(100) default NULL,
  `xuhao` int(12) default NULL,
  `catpath` char(255) default NULL,
  `nums` int(20) default NULL,
  `tj` int(1) NOT NULL default '0',
  `ifchannel` int(1) NOT NULL default '0',
  PRIMARY KEY  (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `pwn_product_cat`
--

INSERT INTO `pwn_product_cat` (`catid`, `pid`, `cat`, `xuhao`, `catpath`, `nums`, `tj`, `ifchannel`) VALUES
(1, 0, '大田作物', 1, '0001:', 0, 0, 0),
(2, 0, '蔬菜瓜果', 2, '0002:', 0, 0, 0),
(3, 0, '农化产品', 3, '0003:', 0, 0, 0),
(4, 0, '其他产品', 4, '0004:', 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_product_con`
--

CREATE TABLE IF NOT EXISTS `pwn_product_con` (
  `id` int(12) NOT NULL auto_increment,
  `catid` int(12) NOT NULL default '0',
  `catpath` varchar(255) NOT NULL default '',
  `pcatid` int(12) NOT NULL default '0',
  `contype` varchar(20) NOT NULL default 'product',
  `title` varchar(255) NOT NULL default '',
  `body` text,
  `dtime` int(11) default '0',
  `xuhao` int(5) default '0',
  `cl` int(20) default NULL,
  `tj` int(1) default NULL,
  `iffb` int(1) default '0',
  `ifbold` int(1) default '0',
  `ifred` varchar(20) default NULL,
  `type` varchar(30) NOT NULL default '',
  `src` varchar(150) NOT NULL default '',
  `uptime` int(11) default '0',
  `author` varchar(100) default NULL,
  `source` varchar(100) default NULL,
  `memberid` varchar(100) default NULL,
  `proj` varchar(255) NOT NULL default '',
  `secure` int(11) NOT NULL default '0',
  `memo` text NOT NULL,
  `prop1` char(255) NOT NULL default '',
  `prop2` char(255) NOT NULL default '',
  `prop3` char(255) NOT NULL default '',
  `prop4` char(255) NOT NULL default '',
  `prop5` char(255) NOT NULL default '',
  `prop6` char(255) NOT NULL default '',
  `prop7` char(255) NOT NULL default '',
  `prop8` char(255) NOT NULL default '',
  `prop9` char(255) NOT NULL default '',
  `prop10` char(255) NOT NULL default '',
  `prop11` char(255) NOT NULL default '',
  `prop12` char(255) NOT NULL default '',
  `prop13` char(255) NOT NULL default '',
  `prop14` char(255) NOT NULL default '',
  `prop15` char(255) NOT NULL default '',
  `prop16` char(255) NOT NULL default '',
  `prop17` char(255) NOT NULL default '',
  `prop18` char(255) NOT NULL default '',
  `prop19` char(255) NOT NULL default '',
  `prop20` char(255) NOT NULL default '',
  `tags` varchar(255) NOT NULL,
  `zhichi` int(5) NOT NULL default '0',
  `fandui` int(5) NOT NULL default '0',
  `tplog` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `pwn_product_con`
--

INSERT INTO `pwn_product_con` (`id`, `catid`, `catpath`, `pcatid`, `contype`, `title`, `body`, `dtime`, `xuhao`, `cl`, `tj`, `iffb`, `ifbold`, `ifred`, `type`, `src`, `uptime`, `author`, `source`, `memberid`, `proj`, `secure`, `memo`, `prop1`, `prop2`, `prop3`, `prop4`, `prop5`, `prop6`, `prop7`, `prop8`, `prop9`, `prop10`, `prop11`, `prop12`, `prop13`, `prop14`, `prop15`, `prop16`, `prop17`, `prop18`, `prop19`, `prop20`, `tags`, `zhichi`, `fandui`, `tplog`) VALUES
(1, 1, '0001:', 0, 'product', '三农88', '三农88', 1272261050, 0, 1, 0, 1, 0, '0', 'gif', 'product/pics/20100428/1272418721.jpg', 1281055284, '管理员', '', '0', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, ''),
(2, 1, '0001:', 0, 'product', '三农88', '三农88三农88三农88三农88三农88三农88三农88三农88三农88三农88三农88三农88三农88三农88三农88三农88', 1272356328, 0, 22, 0, 1, 0, '0', 'gif', 'product/pics/20100806/1281055333.jpg', 1281055333, '管理员', '', '0', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, ''),
(3, 1, '0001:', 0, 'product', '玉米', '三农88三农88三农88三农88三农88三农88三农88三农88三农88三农88三农88三农88三农88三农88三农88三农88三农88三农88 ', 1272419191, 0, 7, 0, 1, 0, '0', 'gif', 'product/pics/20100428/1272419191.jpg', 1290140971, '管理员', '', '0', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, ''),
(5, 1, '0001:', 0, 'product', '青菜', '三农88三农88三农88三农88三农88三农88三农88三农88三农88三农88三农88三农88', 1272419557, 0, 3, 0, 1, 0, '0', 'gif', 'product/pics/20100428/1272419557.jpg', 1281055273, '管理员', '', '0', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, ''),
(6, 2, '0002:', 0, 'product', '三农88', '三农88三农88三农88三农88三农88三农88三农88三农88三农88三农88', 1272419628, 0, 14, 0, 1, 0, '0', 'gif', 'product/pics/20100428/1272419628.jpg', 1281055256, '管理员', '', '0', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, ''),
(7, 1, '0001:', 0, 'product', '三农88', '三农88三农88三农88三农88', 1272419691, 0, 13, 0, 1, 0, '0', 'gif', 'product/pics/20100428/1272419691.jpg', 1281055237, '管理员', '', '0', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_product_config`
--

CREATE TABLE IF NOT EXISTS `pwn_product_config` (
  `xuhao` int(3) NOT NULL default '0',
  `vname` varchar(50) NOT NULL default '',
  `settype` varchar(30) NOT NULL default 'input',
  `colwidth` varchar(3) NOT NULL default '30',
  `variable` varchar(32) NOT NULL default '',
  `value` text NOT NULL,
  `intro` text NOT NULL,
  PRIMARY KEY  (`variable`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `pwn_product_config`
--

INSERT INTO `pwn_product_config` (`xuhao`, `vname`, `settype`, `colwidth`, `variable`, `value`, `intro`) VALUES
(1, '模块频道名称', 'input', '30', 'ChannelName', '公司产品', '本模块对应的频道名称，如“产品展示”；用于显示在网页标题、当前位置提示条等处'),
(2, '是否在当前位置提示条显示模块频道名称', 'YN', '30', 'ChannelNameInNav', '1', '是否在当前位置提示条显示模块频道名称'),
(5, '会员上传产品图片尺寸限制(Byte)', 'input', '30', 'PicSizeLimit', '256000', '会员上传产品图片时,单个图片尺寸的限制'),
(6, '产品介绍编辑器图片上传限制(Byte)', 'input', '30', 'EditPicLimit', '512000', '会员发布产品时,在编辑器内上传图片,单个图片的尺寸限制');

-- --------------------------------------------------------

--
-- 表的结构 `pwn_product_pages`
--

CREATE TABLE IF NOT EXISTS `pwn_product_pages` (
  `id` int(12) NOT NULL auto_increment,
  `productid` int(12) NOT NULL default '0',
  `src` varchar(150) NOT NULL default '',
  `xuhao` int(5) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pwn_product_pages`
--


-- --------------------------------------------------------

--
-- 表的结构 `pwn_product_pcat`
--

CREATE TABLE IF NOT EXISTS `pwn_product_pcat` (
  `catid` int(12) NOT NULL auto_increment,
  `memberid` int(12) NOT NULL default '0',
  `pid` int(12) NOT NULL default '0',
  `cat` char(100) NOT NULL default '',
  `xuhao` int(12) NOT NULL default '0',
  `catpath` char(255) NOT NULL default '',
  PRIMARY KEY  (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pwn_product_pcat`
--


-- --------------------------------------------------------

--
-- 表的结构 `pwn_product_proj`
--

CREATE TABLE IF NOT EXISTS `pwn_product_proj` (
  `id` int(12) NOT NULL auto_increment,
  `project` varchar(100) default NULL,
  `folder` varchar(30) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pwn_product_proj`
--


-- --------------------------------------------------------

--
-- 表的结构 `pwn_product_prop`
--

CREATE TABLE IF NOT EXISTS `pwn_product_prop` (
  `id` int(20) NOT NULL auto_increment,
  `catid` int(20) NOT NULL default '0',
  `propname` char(30) default NULL,
  `xuhao` int(20) default NULL,
  PRIMARY KEY  (`id`),
  KEY `xuhao` (`xuhao`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pwn_product_prop`
--


-- --------------------------------------------------------

--
-- 表的结构 `pwn_tools_code`
--

CREATE TABLE IF NOT EXISTS `pwn_tools_code` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `cat` varchar(100) NOT NULL,
  `groupid` int(11) NOT NULL default '0',
  `groupname` varchar(100) NOT NULL,
  `qq` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `memo` varchar(255) NOT NULL,
  `code` text NOT NULL,
  `xuhao` int(11) NOT NULL default '0',
  `iffb` int(1) NOT NULL default '1',
  `tj` int(1) NOT NULL default '0',
  `dtime` int(11) NOT NULL default '0',
  `uptime` int(11) NOT NULL default '0',
  `author` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `pwn_tools_code`
--

INSERT INTO `pwn_tools_code` (`id`, `cat`, `groupid`, `groupname`, `qq`, `name`, `position`, `tel`, `phone`, `memo`, `code`, `xuhao`, `iffb`, `tj`, `dtime`, `uptime`, `author`) VALUES
(19, '', 0, 'dd_yuyue', '', '王先生', 'tools/pics/20100119/1263866986.jpg', '0571', '15912345678', '', '当品要求', 0, 1, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_tools_photopolldata`
--

CREATE TABLE IF NOT EXISTS `pwn_tools_photopolldata` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `poll_id` int(11) NOT NULL default '0',
  `title` varchar(255) NOT NULL,
  `body` text,
  `iffb` int(1) NOT NULL default '0',
  `tj` int(1) default NULL,
  `secure` int(11) NOT NULL default '0',
  `dtime` int(11) NOT NULL default '0',
  `uptime` int(11) NOT NULL default '0',
  `author` varchar(100) default NULL,
  `type` varchar(30) NOT NULL,
  `src` varchar(150) NOT NULL,
  `color` varchar(20) NOT NULL default '',
  `votes` int(14) NOT NULL default '0',
  `votesinfo1` text NOT NULL,
  `votesinfo2` text NOT NULL,
  `votesinfo3` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pwn_tools_photopolldata`
--


-- --------------------------------------------------------

--
-- 表的结构 `pwn_tools_photopollindex`
--

CREATE TABLE IF NOT EXISTS `pwn_tools_photopollindex` (
  `id` int(11) NOT NULL auto_increment,
  `catid` int(12) NOT NULL,
  `catpath` char(255) default NULL,
  `cat` varchar(100) NOT NULL,
  `groupname` varchar(100) NOT NULL default '',
  `timestamp` int(11) NOT NULL default '0',
  `status` smallint(2) NOT NULL default '0',
  `exp_time` int(11) NOT NULL default '0',
  `expire` smallint(2) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `pwn_tools_photopollindex`
--


-- --------------------------------------------------------

--
-- 表的结构 `pwn_tools_pollconfig`
--

CREATE TABLE IF NOT EXISTS `pwn_tools_pollconfig` (
  `config_id` smallint(5) unsigned NOT NULL auto_increment,
  `img_height` int(5) NOT NULL default '0',
  `img_length` int(5) NOT NULL default '0',
  `vodinfo` varchar(225) NOT NULL default '0',
  `def_options` smallint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`config_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `pwn_tools_pollconfig`
--

INSERT INTO `pwn_tools_pollconfig` (`config_id`, `img_height`, `img_length`, `vodinfo`, `def_options`) VALUES
(1, 20, 10, '对不起,您已经投过票了', 10);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_tools_polldata`
--

CREATE TABLE IF NOT EXISTS `pwn_tools_polldata` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `poll_id` int(11) NOT NULL default '0',
  `option_id` int(11) NOT NULL default '0',
  `option_text` varchar(200) NOT NULL default '',
  `color` varchar(20) NOT NULL default '',
  `votes` int(14) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- 转存表中的数据 `pwn_tools_polldata`
--

INSERT INTO `pwn_tools_polldata` (`id`, `poll_id`, `option_id`, `option_text`, `color`, `votes`) VALUES
(17, 8, 5, '喜欢', 'aqua', 0),
(16, 8, 4, '一般', 'aqua', 0),
(13, 8, 1, '很好', 'aqua', 1),
(14, 8, 2, '不好', 'aqua', 0),
(15, 8, 3, '很差', 'aqua', 0);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_tools_pollindex`
--

CREATE TABLE IF NOT EXISTS `pwn_tools_pollindex` (
  `id` int(11) NOT NULL auto_increment,
  `groupname` varchar(100) NOT NULL default '',
  `timestamp` int(11) NOT NULL default '0',
  `status` smallint(2) NOT NULL default '0',
  `exp_time` int(11) NOT NULL default '0',
  `expire` smallint(2) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `pwn_tools_pollindex`
--

INSERT INTO `pwn_tools_pollindex` (`id`, `groupname`, `timestamp`, `status`, `exp_time`, `expire`) VALUES
(8, '这个软件你感觉怎么样？', 1223209351, 1, 1225801351, 0);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_tools_statbase`
--

CREATE TABLE IF NOT EXISTS `pwn_tools_statbase` (
  `id` int(8) NOT NULL auto_increment,
  `ShowCountType` int(1) default NULL,
  `ShowCountSize` int(1) default NULL,
  `ShowCount` int(1) default NULL,
  `ShowCountStat` int(1) default NULL,
  `starttime` int(11) default NULL,
  `CountIpExp` int(3) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `pwn_tools_statbase`
--

INSERT INTO `pwn_tools_statbase` (`id`, `ShowCountType`, `ShowCountSize`, `ShowCount`, `ShowCountStat`, `starttime`, `CountIpExp`) VALUES
(1, 2, 8, 2, 0, 1234728185, 5);

-- --------------------------------------------------------

--
-- 表的结构 `pwn_tools_statcome`
--

CREATE TABLE IF NOT EXISTS `pwn_tools_statcome` (
  `id` int(12) NOT NULL auto_increment,
  `url` varchar(255) NOT NULL default '',
  `count` int(5) NOT NULL default '0',
  `begingtime` int(11) NOT NULL default '0',
  `lasttime` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `pwn_tools_statcome`
--


-- --------------------------------------------------------

--
-- 表的结构 `pwn_tools_statcount`
--

CREATE TABLE IF NOT EXISTS `pwn_tools_statcount` (
  `id` int(21) NOT NULL auto_increment,
  `ip` varchar(17) NOT NULL default '',
  `os` varchar(40) NOT NULL default '',
  `browse` varchar(30) NOT NULL default '',
  `urlform` varchar(255) NOT NULL default '',
  `time` int(11) NOT NULL default '0',
  `nowpage` varchar(255) default NULL,
  `member` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16307 ;

--
-- 转存表中的数据 `pwn_tools_statcount`
--


-- --------------------------------------------------------

--
-- 表的结构 `pwn_tools_statdate`
--

CREATE TABLE IF NOT EXISTS `pwn_tools_statdate` (
  `id` int(2) NOT NULL auto_increment,
  `1th_day` int(5) NOT NULL default '0',
  `2th_day` int(5) NOT NULL default '0',
  `3th_day` int(5) NOT NULL default '0',
  `4th_day` int(5) NOT NULL default '0',
  `5th_day` int(5) NOT NULL default '0',
  `6th_day` int(5) NOT NULL default '0',
  `7th_day` int(5) NOT NULL default '0',
  `8th_day` int(5) NOT NULL default '0',
  `9th_day` int(5) NOT NULL default '0',
  `10th_day` int(5) NOT NULL default '0',
  `11th_day` int(5) NOT NULL default '0',
  `12th_day` int(5) NOT NULL default '0',
  `13th_day` int(5) NOT NULL default '0',
  `14th_day` int(5) NOT NULL default '0',
  `15th_day` int(5) NOT NULL default '0',
  `16th_day` int(5) NOT NULL default '0',
  `17th_day` int(5) NOT NULL default '0',
  `18th_day` int(5) NOT NULL default '0',
  `19th_day` int(5) NOT NULL default '0',
  `20th_day` int(5) NOT NULL default '0',
  `21th_day` int(5) NOT NULL default '0',
  `22th_day` int(5) NOT NULL default '0',
  `23th_day` int(5) NOT NULL default '0',
  `24th_day` int(5) NOT NULL default '0',
  `25th_day` int(5) NOT NULL default '0',
  `26th_day` int(5) NOT NULL default '0',
  `27th_day` int(5) NOT NULL default '0',
  `28th_day` int(5) NOT NULL default '0',
  `29th_day` int(5) NOT NULL default '0',
  `30th_day` int(5) NOT NULL default '0',
  `31th_day` int(5) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `pwn_tools_statdate`
--

INSERT INTO `pwn_tools_statdate` (`id`, `1th_day`, `2th_day`, `3th_day`, `4th_day`, `5th_day`, `6th_day`, `7th_day`, `8th_day`, `9th_day`, `10th_day`, `11th_day`, `12th_day`, `13th_day`, `14th_day`, `15th_day`, `16th_day`, `17th_day`, `18th_day`, `19th_day`, `20th_day`, `21th_day`, `22th_day`, `23th_day`, `24th_day`, `25th_day`, `26th_day`, `27th_day`, `28th_day`, `29th_day`, `30th_day`, `31th_day`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
