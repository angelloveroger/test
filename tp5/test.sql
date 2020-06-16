/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-05-23 17:21:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tp_admin
-- ----------------------------
DROP TABLE IF EXISTS `tp_admin`;
CREATE TABLE `tp_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` varchar(4) NOT NULL DEFAULT '' COMMENT 'salt值',
  `status` tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT '状态 1正常 2禁止登陆',
  `business` varchar(512) NOT NULL DEFAULT '' COMMENT '管理公司ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of tp_admin
-- ----------------------------
INSERT INTO `tp_admin` VALUES ('1', 'roger', '4acf399abcd309cbdde1042dfad12bd4', '8888', '1', '1,3,5');
INSERT INTO `tp_admin` VALUES ('2', 'angel', '4acf399abcd309cbdde1042dfad12bd4', '8888', '1', '');

-- ----------------------------
-- Table structure for tp_business
-- ----------------------------
DROP TABLE IF EXISTS `tp_business`;
CREATE TABLE `tp_business` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(11) unsigned NOT NULL DEFAULT 1 COMMENT '区域id',
  `name` varchar(64) NOT NULL DEFAULT '' COMMENT '商户名',
  `status` tinyint(1) unsigned NOT NULL DEFAULT 1 COMMENT '商户状态 0失效 1有效',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='商户表';

-- ----------------------------
-- Records of tp_business
-- ----------------------------
INSERT INTO `tp_business` VALUES ('1', '1', '宜昌A', '1');
INSERT INTO `tp_business` VALUES ('2', '1', '宜昌B', '1');
INSERT INTO `tp_business` VALUES ('3', '1', '宜昌C', '1');
INSERT INTO `tp_business` VALUES ('4', '1', '宜昌D', '1');
INSERT INTO `tp_business` VALUES ('5', '2', '恩施A', '1');
INSERT INTO `tp_business` VALUES ('6', '2', '恩施B', '1');
INSERT INTO `tp_business` VALUES ('7', '2', '恩施C', '1');

-- ----------------------------
-- Table structure for tp_group
-- ----------------------------
DROP TABLE IF EXISTS `tp_group`;
CREATE TABLE `tp_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `rules` char(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户组表';

-- ----------------------------
-- Records of tp_group
-- ----------------------------
INSERT INTO `tp_group` VALUES ('1', '超管', '1', '1,2');

-- ----------------------------
-- Table structure for tp_group_access
-- ----------------------------
DROP TABLE IF EXISTS `tp_group_access`;
CREATE TABLE `tp_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组明细表';

-- ----------------------------
-- Records of tp_group_access
-- ----------------------------
INSERT INTO `tp_group_access` VALUES ('1', '1');

-- ----------------------------
-- Table structure for tp_rule
-- ----------------------------
DROP TABLE IF EXISTS `tp_rule`;
CREATE TABLE `tp_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `condition` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='规则表';

-- ----------------------------
-- Records of tp_rule
-- ----------------------------
INSERT INTO `tp_rule` VALUES ('1', 'index/index', '后台初始页面', '1', '1', '');
INSERT INTO `tp_rule` VALUES ('2', 'index/user', '用户', '1', '1', '');
