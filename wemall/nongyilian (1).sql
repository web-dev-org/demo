-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-11-16 12:13:18
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nongyilian`
--

-- --------------------------------------------------------

--
-- 表的结构 `vix_active`
--

CREATE TABLE IF NOT EXISTS `vix_active` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `activeName` varchar(50) NOT NULL,
  `activeType` varchar(50) NOT NULL,
  `activeImg` varchar(255) NOT NULL,
  `activePrice` float(8,2) NOT NULL DEFAULT '0.00',
  `oldPrice` float(8,2) DEFAULT '0.00',
  `startTime` date NOT NULL,
  `endTime` date NOT NULL,
  `cityId` varchar(50) NOT NULL,
  `openFlg` varchar(50) NOT NULL,
  `productId` int(5) DEFAULT NULL,
  `stock` int(10) DEFAULT NULL,
  `lowBuy` int(10) DEFAULT NULL,
  `maxBuy` int(10) DEFAULT NULL,
  `preparFlg` varchar(50) DEFAULT NULL,
  `preparPay` int(10) DEFAULT NULL,
  `info` varchar(20000) DEFAULT NULL,
  `productName` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=161 ;

--
-- 表的结构 `vix_alipay`
--

CREATE TABLE IF NOT EXISTS `vix_alipay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alipayname` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `appid` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `key` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `mchid` varchar(100) DEFAULT NULL,
  `appsecret` varchar(100) NOT NULL,
  `info` varchar(2000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `vix_alipay`
--

INSERT INTO `vix_alipay` (`id`, `alipayname`, `appid`, `key`, `mchid`, `appsecret`, `info`) VALUES
(1, '微信支付', 'wx3adb4404b6a556a8', 'nongyilian2015080611190000000000', '1260349001', '162e5064f64682a15c192dadbad242d0', 'a:8:{s:6:"weixin";s:1:"0";s:8:"alipayid";s:1:"1";s:5:"appid";s:18:"wx3adb4404b6a556a8";s:5:"mchid";s:10:"1260349001";s:3:"key";s:32:"nongyilian2015080611190000000000";s:9:"appsecret";s:32:"162e5064f64682a15c192dadbad242d0";s:5:"daofu";s:1:"1";s:7:"zhanghu";s:1:"0";}');

-- --------------------------------------------------------

--
-- 表的结构 `vix_city`
--

CREATE TABLE IF NOT EXISTS `vix_city` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `tax` varchar(255) DEFAULT NULL,
  `rule` varchar(255) DEFAULT NULL,
  `states` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;


--
-- 表的结构 `vix_info`
--

CREATE TABLE IF NOT EXISTS `vix_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `notification` text NOT NULL,
  `theme` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `vix_info`
--

INSERT INTO `vix_info` (`id`, `name`, `notification`, `theme`) VALUES
(1, '河北管件扣件平台', '欢迎来到河北管件扣件平台', '');

-- --------------------------------------------------------

--
-- 表的结构 `vix_member`
--

CREATE TABLE IF NOT EXISTS `vix_member` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `openid` varchar(50) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `cityid` int(5) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `storename` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `cardnum` varchar(255) DEFAULT NULL,
  `taxname` varchar(50) DEFAULT NULL,
  `buytype` varchar(50) DEFAULT NULL,
  `memlevel` varchar(50) DEFAULT NULL,
  `amt` float(8,2) DEFAULT '0.00',
  `diffstandard` float(8,2) DEFAULT '0.00',
  `nickname` varchar(50) DEFAULT NULL,
  `headImgUrl` varchar(500) DEFAULT NULL,
  `salescode` varchar(50) DEFAULT NULL,
  `pcityid` int(5) DEFAULT NULL,
  `states` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=641 ;

--
-- 表的结构 `vix_menu`
--

CREATE TABLE IF NOT EXISTS `vix_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;


--
-- 表的结构 `vix_menu_percent`
--

CREATE TABLE IF NOT EXISTS `vix_menu_percent` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `cityid` int(5) NOT NULL,
  `menuid` int(5) NOT NULL,
  `percent` float(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=166 ;


--
-- 表的结构 `vix_order`
--

CREATE TABLE IF NOT EXISTS `vix_order` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `paytype` varchar(50) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL,
  `totalnum` int(10) DEFAULT '0',
  `totalprice` float DEFAULT '0',
  `actualprice` float DEFAULT '0',
  `info` varchar(20000) DEFAULT NULL,
  `buytime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `states` varchar(50) DEFAULT NULL,
  `paystates` varchar(50) DEFAULT NULL,
  `orderid` varchar(255) DEFAULT NULL,
  `sendtime` timestamp NULL DEFAULT NULL,
  `cityid` int(10) DEFAULT NULL,
  `minusAmt` float DEFAULT '0',
  `carfee` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1374 ;

--
-- 表的结构 `vix_product`
--

CREATE TABLE IF NOT EXISTS `vix_product` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `img` varchar(255) NOT NULL,
  `menuid` int(5) NOT NULL,
  `info` varchar(255) NOT NULL,
  `num` int(10) DEFAULT NULL,
  `insertday` int(10) DEFAULT NULL,
  `upday` int(10) DEFAULT NULL,
  `feibiao` varchar(10) DEFAULT NULL,
  `tuijian` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=792 ;

--
-- 表的结构 `vix_product_cart`
--

CREATE TABLE IF NOT EXISTS `vix_product_cart` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `openid` varchar(50) NOT NULL,
  `states` varchar(50) NOT NULL,
  `totalnum` int(10) NOT NULL,
  `price` float(8,2) NOT NULL,
  `info` varchar(20000) DEFAULT NULL,
  `orderid` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1497 ;


--
-- 表的结构 `vix_product_detail`
--

CREATE TABLE IF NOT EXISTS `vix_product_detail` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `productid` int(5) NOT NULL,
  `cityid` int(5) NOT NULL,
  `percent` float(8,2) DEFAULT NULL,
  `bprice` float(8,2) DEFAULT '0.00',
  `vprice` float(8,2) DEFAULT '0.00',
  `num` int(10) DEFAULT '0',
  `lownum` int(10) NOT NULL DEFAULT '0',
  `states` varchar(50) NOT NULL,
  `insertday` int(10) DEFAULT NULL,
  `upday` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1093 ;

--
-- 表的结构 `vix_product_mid`
--

CREATE TABLE IF NOT EXISTS `vix_product_mid` (
  `username` varchar(50) NOT NULL,
  `check` varchar(50) NOT NULL,
  `id` int(5) NOT NULL,
  `cityid` int(5) NOT NULL,
  `menuid` int(5) NOT NULL,
  `percent` float(8,2) NOT NULL DEFAULT '0.00',
  `bprice` float(8,2) NOT NULL DEFAULT '0.00',
  `vprice` float(8,2) NOT NULL DEFAULT '0.00',
  `nprice` float(8,2) NOT NULL DEFAULT '0.00',
  `amt` float(8,2) NOT NULL DEFAULT '0.00',
  `name` varchar(50) NOT NULL,
  `cityname` varchar(50) NOT NULL,
  `productname` varchar(50) NOT NULL,
  `menu` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `vix_sales_code`
--

CREATE TABLE IF NOT EXISTS `vix_sales_code` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `staffName` varchar(50) NOT NULL,
  `states` varchar(50) NOT NULL,
  `salesCode` varchar(10) NOT NULL,
  `cityid` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;


--
-- 表的结构 `vix_user`
--

CREATE TABLE IF NOT EXISTS `vix_user` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `cityid` int(5) NOT NULL,
  `states` varchar(50) NOT NULL,
  `role` varchar(2000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `vix_user`
--

INSERT INTO `vix_user` (`id`, `username`, `password`, `cityid`, `states`, `role`) VALUES
(11, 'liuhaibo', '259d98e966ff584d62d4c1e678a082e8', 0, '0', 'a:13:{s:3:"set";s:1:"1";s:4:"menu";s:1:"0";s:4:"city";s:1:"0";s:11:"cityPercent";s:1:"0";s:7:"product";s:1:"0";s:5:"price";s:1:"0";s:7:"confirm";s:1:"0";s:5:"order";s:1:"0";s:6:"member";s:1:"0";s:6:"weixin";s:1:"1";s:4:"user";s:1:"0";s:6:"active";s:1:"0";s:9:"salesCode";s:1:"0";}'),
(3, 'WangJun', 'bf496ba17e4b3a5e742af84dd1f112a6', 1, '0', 'a:15:{s:3:"set";s:1:"1";s:4:"menu";s:1:"1";s:4:"city";s:1:"1";s:11:"cityPercent";s:1:"1";s:7:"product";s:1:"1";s:5:"price";s:1:"1";s:7:"confirm";s:1:"1";s:5:"order";s:1:"1";s:6:"member";s:1:"1";s:6:"weixin";s:1:"1";s:4:"user";s:1:"1";s:6:"active";s:1:"1";s:9:"salesCode";s:1:"1";s:5:"count";s:1:"1";s:9:"countSale";s:1:"1";}');

-- --------------------------------------------------------

--
-- 表的结构 `vix_wxconfig`
--

CREATE TABLE IF NOT EXISTS `vix_wxconfig` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `num` text NOT NULL,
  `token` text NOT NULL,
  `appid` text NOT NULL,
  `appsecret` text NOT NULL,
  `encodingaeskey` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `vix_wxconfig`
--

INSERT INTO `vix_wxconfig` (`id`, `num`, `token`, `appid`, `appsecret`, `encodingaeskey`) VALUES
(1, 'NongYiLian', 'beijingshengxianxiadan', 'wx3adb4404b6a556a8', '162e5064f64682a15c192dadbad242d0', 'Vk3vdtoPs9vplIHNVlStFDbtujxmll4TOCBpG9mmq25');

-- --------------------------------------------------------

--
-- 表的结构 `vix_wxmenu`
--

CREATE TABLE IF NOT EXISTS `vix_wxmenu` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) DEFAULT NULL,
  `name` varchar(10) NOT NULL,
  `key` varchar(200) NOT NULL,
  `url` varchar(300) NOT NULL,
  `pid` int(5) NOT NULL DEFAULT '0',
  `listorder` varchar(5) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `vix_wxmenu`
--

INSERT INTO `vix_wxmenu` (`id`, `type`, `name`, `key`, `url`, `pid`, `listorder`, `status`) VALUES
(6, 'view', '商品订购', '', 'http://nongyilian.cn/index.php?g=App&m=Index&a=index', 0, '1', 1),
(7, 'view', '订单管理', '', 'http://nongyilian.cn/index.php?g=App&m=Member&a=myOrder', 0, '2', 1),
(8, 'view', '农易联', '', '', 0, '3', 1),
(9, 'view', '常见问题', '', 'http://nongyilian.cn/aboutWe/question.html', 8, '6', 1),
(11, 'view', '关于我们', '', 'http://nongyilian.cn/aboutWe/introduce.html', 8, '8', 1),
(12, 'view', '售后服务', '', 'http://nongyilian.cn/aboutWe/service.html', 8, '9', 1),
(13, 'view', '使用手册', '', 'http://nongyilian.cn/aboutWe/use.html', 8, '7', 1);

-- --------------------------------------------------------

--
-- 表的结构 `vix_wxmessage`
--

CREATE TABLE IF NOT EXISTS `vix_wxmessage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `picurl` text NOT NULL,
  `url` text NOT NULL,
  `key` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
