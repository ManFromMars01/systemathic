/*
Navicat MySQL Data Transfer

Source Server         : cmaph
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : systemathic

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2013-11-26 16:29:41
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tcountry
-- ----------------------------
DROP TABLE IF EXISTS `tcountry`;
CREATE TABLE `tcountry` (
  `ID` varchar(3) NOT NULL,
  `Description` varchar(30) NOT NULL,
  `Address1` text,
  `Address2` text,
  `Phone` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Contact` varchar(50) DEFAULT NULL,
  `Master` enum('Yes','No') DEFAULT NULL,
  `DiscountType` varchar(1) DEFAULT NULL,
  `ItemDiscRateA` decimal(5,2) DEFAULT NULL,
  `ItemDiscRateB` decimal(5,2) DEFAULT NULL,
  `ItemDiscRateC` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tcountry
-- ----------------------------
INSERT INTO `tcountry` VALUES ('CAN', 'CANADA', 'Canada', 'Canada', '8888888888888', 'canada@cma', 'Mr Canada', 'No', null, null, null, null);
INSERT INTO `tcountry` VALUES ('CN', 'CHINA', 'China', 'Chian', '9999999999', 'china@cma', 'Mr. China', 'No', null, null, null, null);
INSERT INTO `tcountry` VALUES ('MAY', 'MALAYSIA', null, null, '99999999999', 'malaysia@cma', 'Mr. Malaysia', 'No', null, null, null, null);
INSERT INTO `tcountry` VALUES ('PH', 'PHILIPPINES', 'East of Galleria', 'Ortigas Center Pasig City', '999999999999', 'philippines@cma', 'Lito A. Fulay', 'No', null, null, null, null);
INSERT INTO `tcountry` VALUES ('SIG', 'SINGAPORE', 'Singapore', 'Singapore', '777777777777', 'singapore@cma', 'Teacher Teh', 'No', null, null, null, null);
INSERT INTO `tcountry` VALUES ('TAI', 'TAIWAN', 'Taiwan', 'Taiwan', '999999999', 'taiwan@cma', 'Master Tai', 'Yes', null, null, null, null);
INSERT INTO `tcountry` VALUES ('THA', 'THAILAND', 'Thailand', 'Thailand', '99999999999', 'thailand@cma', 'Mr. Thailand', 'No', null, null, null, null);
INSERT INTO `tcountry` VALUES ('USA', 'UNITED STATES OF AMERICA', 'United States of America', 'USA', '999999999999', 'usa@cma', 'Mr. USA', 'No', null, null, null, null);
