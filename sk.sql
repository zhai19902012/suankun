/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50528
Source Host           : localhost:3306
Source Database       : sk

Target Server Type    : MYSQL
Target Server Version : 50528
File Encoding         : 65001

Date: 2016-06-14 12:00:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `cms_article`
-- ----------------------------
DROP TABLE IF EXISTS `cms_article`;
CREATE TABLE `cms_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(300) NOT NULL,
  `content` text,
  `ptime` int(10) unsigned NOT NULL DEFAULT '0',
  `tid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_article
-- ----------------------------
INSERT INTO `cms_article` VALUES ('1', '国际新闻', '自私的防守对方', '1465875936', '1');
INSERT INTO `cms_article` VALUES ('2', '个人专属二维码', '的防守广东省法国', '1465876120', '2');

-- ----------------------------
-- Table structure for `cms_profile`
-- ----------------------------
DROP TABLE IF EXISTS `cms_profile`;
CREATE TABLE `cms_profile` (
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `truename` varchar(100) DEFAULT NULL,
  `age` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `sex` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `edu` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `signed` text,
  `pic` varchar(50) NOT NULL DEFAULT 'default.gif',
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_profile
-- ----------------------------
INSERT INTO `cms_profile` VALUES ('2', '地方', '11', '1', '3', '斯蒂芬', 'default.gif', 'xiaohua4628@163.com', '石桥铺石小路', '13838385438');

-- ----------------------------
-- Table structure for `cms_top`
-- ----------------------------
DROP TABLE IF EXISTS `cms_top`;
CREATE TABLE `cms_top` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_top
-- ----------------------------
INSERT INTO `cms_top` VALUES ('1', '技术');
INSERT INTO `cms_top` VALUES ('2', '活动');

-- ----------------------------
-- Table structure for `cms_user`
-- ----------------------------
DROP TABLE IF EXISTS `cms_user`;
CREATE TABLE `cms_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` char(32) NOT NULL,
  `rtime` int(10) unsigned NOT NULL DEFAULT '0',
  `rip` int(11) NOT NULL DEFAULT '0',
  `ltime` int(10) unsigned NOT NULL DEFAULT '0',
  `lip` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_user
-- ----------------------------
INSERT INTO `cms_user` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '0', '0', '0', '0');
INSERT INTO `cms_user` VALUES ('2', 'admin1', '4297f44b13955235245b2497399d7a93', '1465875857', '0', '0', '0');
