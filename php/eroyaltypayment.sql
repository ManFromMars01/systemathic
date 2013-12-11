/*
Navicat MySQL Data Transfer

Source Server         : cmaph
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : systemathic

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2013-11-26 13:44:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for eroyaltypayment
-- ----------------------------
DROP TABLE IF EXISTS `eroyaltypayment`;
CREATE TABLE `eroyaltypayment` (
  `PaymentID` int(11) NOT NULL AUTO_INCREMENT,
  `BillingID` int(11) DEFAULT NULL,
  `PayDate` datetime DEFAULT NULL,
  `PayType` varchar(6) DEFAULT NULL,
  `RemitAmt` decimal(10,0) DEFAULT NULL,
  `ReferenceNo` varchar(30) DEFAULT NULL,
  `DocReference` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`PaymentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
