/*
Navicat MySQL Data Transfer

Source Server         : cmaph
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : systemathic

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2013-11-26 16:29:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for thitems
-- ----------------------------
DROP TABLE IF EXISTS `thitems`;
CREATE TABLE `thitems` (
  `CountryID` varchar(3) DEFAULT NULL,
  `BranchID` varchar(10) DEFAULT NULL,
  `ItemNo` varchar(20) DEFAULT NULL,
  `Sku` varchar(10) NOT NULL,
  `CatID` varchar(5) DEFAULT NULL,
  `SubCatID` varchar(5) DEFAULT NULL,
  `Color` int(11) DEFAULT NULL,
  `Size` int(11) DEFAULT NULL,
  `ManufacturerID` int(11) DEFAULT NULL,
  `DeptID` int(11) DEFAULT NULL,
  `LocationID` int(11) DEFAULT NULL,
  `IssuUntMea` int(11) DEFAULT NULL,
  `DiscountCategory` varchar(1) DEFAULT NULL,
  `IssuUntCost` decimal(14,4) DEFAULT NULL,
  `PurUntCost` decimal(14,4) DEFAULT NULL,
  `LstOrderCost` decimal(14,4) DEFAULT NULL,
  `StdCost` decimal(14,4) DEFAULT NULL,
  `ReOrderPT` decimal(9,2) DEFAULT NULL,
  `ReOrderQty` decimal(9,2) DEFAULT NULL,
  `LastPurVdrID` int(11) DEFAULT NULL,
  `ReOrderReq` varchar(1) DEFAULT NULL,
  `QtyOnHand` decimal(9,2) DEFAULT NULL,
  `QtyOnOrder` decimal(9,2) DEFAULT NULL,
  PRIMARY KEY (`Sku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
