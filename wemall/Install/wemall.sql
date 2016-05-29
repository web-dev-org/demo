-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-08-10 05:11:02
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lvxing`
--

-- --------------------------------------------------------
--
-- 表的结构 都道府等管理`city`
--

CREATE TABLE IF NOT EXISTS `www_city` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `rule` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 表的结构 酒店基本信息 `hotel_info`
--
CREATE TABLE IF NOT EXISTS `www_hotel_info` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `city_id` int(5) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `level` int(5) NOT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `B_flg` int(5) NOT NULL DEFAULT '0',
  `L_flg` int(5) NOT NULL DEFAULT '0',
  `S_flg` int(5) NOT NULL DEFAULT '0',
  `S_price` float(8,2) NOT NULL DEFAULT '0.00',
  `T_price` float(8,2) NOT NULL DEFAULT '0.00',
  `D_price` float(8,2) NOT NULL DEFAULT '0.00',
  `book_times` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 表的结构 导游表  `guide`
--

CREATE TABLE IF NOT EXISTS `www_guide` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `tel` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 表的结构 旅行社管理`agency`
--

CREATE TABLE IF NOT EXISTS `www_agency` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `tax` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 表的结构 旅行社担当管理`agent`
--

CREATE TABLE IF NOT EXISTS `www_agent` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `angency_id` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 表的结构 Bus管理`bus`
--

CREATE TABLE IF NOT EXISTS `www_bus` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(50) NOT NULL,
  `company_tel` varchar(50) DEFAULT NULL,
  `contalts` varchar(50) DEFAULT NULL,
  `contalts_tel` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 用户管理 `admin`
--

CREATE TABLE IF NOT EXISTS `www_admin` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `states` varchar(50) NOT NULL,
  `role` varchar(2000) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- 表的结构 景点管理`viewspot`
--

CREATE TABLE IF NOT EXISTS `www_viewspot` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `cityid` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 表的结构 景点管理`buscompany`
--

CREATE TABLE IF NOT EXISTS `www_buscompany` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `cityid` int(5) NOT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `contanter` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;