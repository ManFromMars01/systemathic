/*
Navicat MySQL Data Transfer

Source Server         : cmaph
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : systemathic

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2013-11-26 15:12:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for eroyaltyadjust
-- ----------------------------
DROP TABLE IF EXISTS `eroyaltyadjust`;
CREATE TABLE `eroyaltyadjust` (
  `AdjustNo` int(11) NOT NULL AUTO_INCREMENT,
  `Date` datetime DEFAULT NULL,
  `CountryID` varchar(3) DEFAULT NULL,
  `BranchID` varchar(10) DEFAULT NULL,
  `AppYear` year(4) DEFAULT NULL,
  `AppMonth` varchar(9) DEFAULT NULL,
  `Amount` decimal(10,0) DEFAULT NULL,
  `Remarks` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`AdjustNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
