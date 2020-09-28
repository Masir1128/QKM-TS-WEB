/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : grade

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2020-09-28 18:43:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for category_msg
-- ----------------------------
DROP TABLE IF EXISTS `category_msg`;
CREATE TABLE `category_msg` (
  `Category_Index` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `Category_Name` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`Category_Index`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of category_msg
-- ----------------------------
INSERT INTO `category_msg` VALUES ('1', '通用类');
INSERT INTO `category_msg` VALUES ('2', 'PA机械类');
INSERT INTO `category_msg` VALUES ('3', 'PA软件类');

-- ----------------------------
-- Table structure for category_msg_content
-- ----------------------------
DROP TABLE IF EXISTS `category_msg_content`;
CREATE TABLE `category_msg_content` (
  `Category_Index_ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Category_Index` int(10) DEFAULT NULL,
  `connent` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`Category_Index_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of category_msg_content
-- ----------------------------
INSERT INTO `category_msg_content` VALUES ('1', '1', '电气模块');
INSERT INTO `category_msg_content` VALUES ('2', '1', '机械模块');
INSERT INTO `category_msg_content` VALUES ('3', '1', '通用PLC');
INSERT INTO `category_msg_content` VALUES ('4', '1', '图纸');
INSERT INTO `category_msg_content` VALUES ('5', '1', '万用表');
INSERT INTO `category_msg_content` VALUES ('6', '1', '相机');
INSERT INTO `category_msg_content` VALUES ('7', '2', 'AH机器人PA卡组件拆装');
INSERT INTO `category_msg_content` VALUES ('8', '2', 'AH机器人电机减速机组件拆装');
INSERT INTO `category_msg_content` VALUES ('9', '2', 'AH机器人三轴张紧机构拆装');
INSERT INTO `category_msg_content` VALUES ('10', '2', 'AH机器人丝杆组件拆装');
INSERT INTO `category_msg_content` VALUES ('11', '2', 'AH机器人硬件维护操作');
INSERT INTO `category_msg_content` VALUES ('12', '2', 'AP机器人PA卡组件拆装');
INSERT INTO `category_msg_content` VALUES ('28', '2', 'AP机器人电机减速机组件拆装');
INSERT INTO `category_msg_content` VALUES ('14', '2', 'AP机器人硬件维护操作');
INSERT INTO `category_msg_content` VALUES ('15', '2', 'HS机器人PA卡组件拆装');
INSERT INTO `category_msg_content` VALUES ('16', '2', 'HS机器人电机减速机组件拆装');
INSERT INTO `category_msg_content` VALUES ('17', '2', 'HS机器人丝杆组件拆装');
INSERT INTO `category_msg_content` VALUES ('18', '2', 'HS机器人硬件维护操作考核');
INSERT INTO `category_msg_content` VALUES ('19', '3', 'PV基本使用');
INSERT INTO `category_msg_content` VALUES ('20', '3', 'PV视觉应用开发');
INSERT INTO `category_msg_content` VALUES ('21', '3', '多工具动态分拣');
INSERT INTO `category_msg_content` VALUES ('22', '3', '高精度纠偏');
INSERT INTO `category_msg_content` VALUES ('23', '3', '机器人基本操作');
INSERT INTO `category_msg_content` VALUES ('24', '3', '三菱PLC');
INSERT INTO `category_msg_content` VALUES ('25', '3', '手眼相机');
INSERT INTO `category_msg_content` VALUES ('26', '3', '威纶触摸屏');
INSERT INTO `category_msg_content` VALUES ('27', '3', '硬件IO应用开发');

-- ----------------------------
-- Table structure for common_grade
-- ----------------------------
DROP TABLE IF EXISTS `common_grade`;
CREATE TABLE `common_grade` (
  `common_id` int(2) NOT NULL AUTO_INCREMENT,
  `Name` varchar(10) DEFAULT NULL,
  `Category` varchar(25) DEFAULT NULL,
  `Content` varchar(25) DEFAULT NULL,
  `people` varchar(10) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Grade` double(10,1) DEFAULT NULL,
  PRIMARY KEY (`common_id`)
) ENGINE=MyISAM AUTO_INCREMENT=619 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of common_grade
-- ----------------------------
INSERT INTO `common_grade` VALUES ('130', '黄敬业', 'PA软件类', '硬件IO应用开发', '钟智财', '2019-12-18', '50.0');
INSERT INTO `common_grade` VALUES ('129', '黄敬业', 'PA软件类', 'PV基本使用', '钟智财', '2019-12-26', '100.0');
INSERT INTO `common_grade` VALUES ('128', '黄敬业', 'PA软件类', '机器人基本操作', '马扬', '2019-12-13', '100.0');
INSERT INTO `common_grade` VALUES ('127', '何德雄', 'PA软件类', '威纶触摸屏', '钟智财', '2020-01-02', '100.0');
INSERT INTO `common_grade` VALUES ('126', '何德雄', 'PA软件类', '硬件IO应用开发', '钟智财', '2019-12-30', '87.0');
INSERT INTO `common_grade` VALUES ('125', '何德雄', 'PA软件类', '多工具动态分拣', '钟智财', '2020-01-02', '100.0');
INSERT INTO `common_grade` VALUES ('124', '何德雄', 'PA软件类', '高精度纠偏', '钟智财', '2019-12-31', '90.0');
INSERT INTO `common_grade` VALUES ('123', '何德雄', 'PA软件类', '手眼相机', '钟智财', '2019-12-31', '90.0');
INSERT INTO `common_grade` VALUES ('122', '何德雄', 'PA软件类', '三菱PLC', '钟智财', '2020-01-02', '100.0');
INSERT INTO `common_grade` VALUES ('121', '何德雄', 'PA软件类', '硬件IO应用开发', '钟智财', '2019-12-30', '87.0');
INSERT INTO `common_grade` VALUES ('120', '何德雄', 'PA软件类', 'PV基本使用', '钟智财', '2019-12-30', '100.0');
INSERT INTO `common_grade` VALUES ('119', '何德雄', 'PA软件类', '机器人基本操作', '钟智财', '2019-12-30', '100.0');
INSERT INTO `common_grade` VALUES ('118', '郭钊宏', 'PA软件类', '多工具动态分拣', '钟智财', '2020-01-17', '50.0');
INSERT INTO `common_grade` VALUES ('117', '郭钊宏', 'PA软件类', '高精度纠偏', '马扬', '2020-01-14', '85.0');
INSERT INTO `common_grade` VALUES ('84', '曾双雄', 'PA软件类', 'PV基本使用', '钟智财', '2019-12-17', '95.0');
INSERT INTO `common_grade` VALUES ('85', '曾双雄', 'PA软件类', '硬件IO应用开发', '钟智财', '2019-12-17', '85.0');
INSERT INTO `common_grade` VALUES ('86', '曾双雄', 'PA软件类', 'PV视觉应用开发', '钟智财', '2019-12-19', '100.0');
INSERT INTO `common_grade` VALUES ('87', '曾双雄', 'PA软件类', '三菱PLC', '郭志坚', '2019-12-25', '100.0');
INSERT INTO `common_grade` VALUES ('88', '曾双雄', 'PA软件类', '威纶触摸屏', '钟智财', '2019-12-24', '90.0');
INSERT INTO `common_grade` VALUES ('89', '曾双雄', 'PA软件类', '手眼相机', '郭志坚', '2019-12-25', '80.0');
INSERT INTO `common_grade` VALUES ('90', '曾双雄', 'PA软件类', '高精度纠偏', '钟智财', '2019-12-26', '89.0');
INSERT INTO `common_grade` VALUES ('91', '曾双雄', 'PA软件类', '多工具动态分拣', '马扬', '2020-01-02', '90.0');
INSERT INTO `common_grade` VALUES ('92', '范国华', 'PA软件类', '机器人基本操作', '马扬', '2019-12-26', '100.0');
INSERT INTO `common_grade` VALUES ('93', '范国华', 'PA软件类', 'PV基本使用', '马扬', '2019-12-26', '100.0');
INSERT INTO `common_grade` VALUES ('94', '范国华', 'PA软件类', '硬件IO应用开发', '钟智财', '2019-12-18', '80.0');
INSERT INTO `common_grade` VALUES ('95', '范国华', 'PA软件类', 'PV视觉应用开发', '钟智财', '2019-12-26', '100.0');
INSERT INTO `common_grade` VALUES ('96', '范国华', 'PA软件类', '三菱PLC', '郭志坚', '2019-12-25', '100.0');
INSERT INTO `common_grade` VALUES ('97', '范国华', 'PA软件类', '威纶触摸屏', '钟智财', '2019-12-18', '100.0');
INSERT INTO `common_grade` VALUES ('98', '范国华', 'PA软件类', '手眼相机', '钟智财', '2019-12-26', '100.0');
INSERT INTO `common_grade` VALUES ('99', '范国华', 'PA软件类', '高精度纠偏', '钟智财', '2019-12-30', '82.0');
INSERT INTO `common_grade` VALUES ('100', '范国华', 'PA软件类', '多工具动态分拣', '钟智财', '2019-12-30', '90.0');
INSERT INTO `common_grade` VALUES ('101', '付传波', 'PA软件类', '机器人基本操作', '钟智财', '2019-12-30', '99.0');
INSERT INTO `common_grade` VALUES ('102', '付传波', 'PA软件类', 'PV基本使用', '马扬', '2019-12-30', '90.0');
INSERT INTO `common_grade` VALUES ('103', '付传波', 'PA软件类', '硬件IO应用开发', '钟智财', '2020-01-08', '60.0');
INSERT INTO `common_grade` VALUES ('104', '付传波', 'PA软件类', 'PV视觉应用开发', '郭志坚', '2020-01-09', '95.0');
INSERT INTO `common_grade` VALUES ('105', '付传波', 'PA软件类', '三菱PLC', '马扬', '2020-01-10', '100.0');
INSERT INTO `common_grade` VALUES ('106', '付传波', 'PA软件类', '威纶触摸屏', '钟智财', '2020-01-11', '100.0');
INSERT INTO `common_grade` VALUES ('107', '付传波', 'PA软件类', '手眼相机', '郭志坚', '2020-01-14', '95.0');
INSERT INTO `common_grade` VALUES ('108', '付传波', 'PA软件类', '高精度纠偏', '郭志坚', '2020-01-15', '90.0');
INSERT INTO `common_grade` VALUES ('109', '付传波', 'PA软件类', '多工具动态分拣', '马扬', '2020-01-18', '70.0');
INSERT INTO `common_grade` VALUES ('110', '郭钊宏', 'PA软件类', '机器人基本操作', '钟智财', '2019-12-17', '72.0');
INSERT INTO `common_grade` VALUES ('111', '郭钊宏', 'PA软件类', 'PV基本使用', '钟智财', '2019-12-17', '65.0');
INSERT INTO `common_grade` VALUES ('112', '郭钊宏', 'PA软件类', '硬件IO应用开发', '钟智财', '2019-12-23', '58.0');
INSERT INTO `common_grade` VALUES ('113', '郭钊宏', 'PA软件类', 'PV视觉应用开发', '钟智财', '2019-12-26', '80.0');
INSERT INTO `common_grade` VALUES ('114', '郭钊宏', 'PA软件类', '三菱PLC', '钟智财', '2019-12-26', '85.0');
INSERT INTO `common_grade` VALUES ('115', '郭钊宏', 'PA软件类', '威纶触摸屏', '马扬', '2019-12-30', '100.0');
INSERT INTO `common_grade` VALUES ('116', '郭钊宏', 'PA软件类', '手眼相机', '钟智财', '2020-01-16', '80.0');
INSERT INTO `common_grade` VALUES ('83', '曾双雄', 'PA软件类', '机器人基本操作', '钟智财', '2019-12-17', '93.0');
INSERT INTO `common_grade` VALUES ('131', '黄敬业', 'PA软件类', 'PV视觉应用开发', '钟智财', '2019-12-19', '100.0');
INSERT INTO `common_grade` VALUES ('132', '黄敬业', 'PA软件类', '三菱PLC', '马扬', '2019-12-27', '100.0');
INSERT INTO `common_grade` VALUES ('133', '黄敬业', 'PA软件类', '威纶触摸屏', '钟智财', '2019-12-26', '90.0');
INSERT INTO `common_grade` VALUES ('134', '黄敬业', 'PA软件类', '手眼相机', '马扬', '2020-01-12', '100.0');
INSERT INTO `common_grade` VALUES ('135', '黄敬业', 'PA软件类', '高精度纠偏', '马扬', '2020-01-13', '90.0');
INSERT INTO `common_grade` VALUES ('136', '姜展', 'PA软件类', '机器人基本操作', '钟智财', '2019-12-25', '90.0');
INSERT INTO `common_grade` VALUES ('137', '姜展', 'PA软件类', 'PV基本使用', '钟智财', '2019-12-26', '80.0');
INSERT INTO `common_grade` VALUES ('138', '姜展', 'PA软件类', '硬件IO应用开发', '钟智财', '2019-12-25', '80.0');
INSERT INTO `common_grade` VALUES ('262', '曾双雄', '通用类', '相机', '马扬', '2019-10-09', '55.0');
INSERT INTO `common_grade` VALUES ('261', '曾双雄', '通用类', '万用表', '马扬', '2019-10-09', '78.0');
INSERT INTO `common_grade` VALUES ('141', '姜展', 'PA软件类', '威纶触摸屏', '钟智财', '2020-01-08', '95.0');
INSERT INTO `common_grade` VALUES ('142', '姜展', 'PA软件类', '手眼相机', '钟智财', '2020-01-03', '85.0');
INSERT INTO `common_grade` VALUES ('143', '姜展', 'PA软件类', '高精度纠偏', '马扬', '2020-01-15', '100.0');
INSERT INTO `common_grade` VALUES ('144', '姜展', 'PA软件类', '多工具动态分拣', '马扬', '2020-01-12', '90.0');
INSERT INTO `common_grade` VALUES ('145', '柯伟', 'PA软件类', '机器人基本操作', '钟智财', '2019-12-26', '86.0');
INSERT INTO `common_grade` VALUES ('146', '柯伟', 'PA软件类', 'PV基本使用', '钟智财', '2020-01-16', '90.0');
INSERT INTO `common_grade` VALUES ('150', '冷雄伟', 'PA软件类', '机器人基本操作', '钟智财', '2019-12-23', '100.0');
INSERT INTO `common_grade` VALUES ('148', '柯伟', 'PA软件类', '硬件IO应用开发', '钟智财', '2020-01-17', '80.0');
INSERT INTO `common_grade` VALUES ('149', '柯伟', 'PA软件类', '威纶触摸屏', '钟智财', '2020-01-17', '95.0');
INSERT INTO `common_grade` VALUES ('151', '冷雄伟', 'PA软件类', 'PV基本使用', '钟智财', '2019-12-23', '100.0');
INSERT INTO `common_grade` VALUES ('152', '冷雄伟', 'PA软件类', '硬件IO应用开发', '钟智财', '2019-12-23', '100.0');
INSERT INTO `common_grade` VALUES ('153', '冷雄伟', 'PA软件类', 'PV视觉应用开发', '钟智财', '2019-12-26', '100.0');
INSERT INTO `common_grade` VALUES ('154', '冷雄伟', 'PA软件类', '三菱PLC', '钟智财', '2019-12-24', '95.0');
INSERT INTO `common_grade` VALUES ('155', '冷雄伟', 'PA软件类', '威纶触摸屏', '钟智财', '2019-12-24', '100.0');
INSERT INTO `common_grade` VALUES ('156', '冷雄伟', 'PA软件类', '手眼相机', '钟智财', '2019-12-26', '90.0');
INSERT INTO `common_grade` VALUES ('157', '冷雄伟', 'PA软件类', '高精度纠偏', '钟智财', '2020-01-08', '95.0');
INSERT INTO `common_grade` VALUES ('158', '冷雄伟', 'PA软件类', '多工具动态分拣', '钟智财', '2020-01-11', '100.0');
INSERT INTO `common_grade` VALUES ('159', '李嘉星', 'PA软件类', '机器人基本操作', '钟智财', '2019-12-25', '100.0');
INSERT INTO `common_grade` VALUES ('160', '李嘉星', 'PA软件类', 'PV基本使用', '郭志坚', '2019-12-25', '100.0');
INSERT INTO `common_grade` VALUES ('161', '李嘉星', 'PA软件类', '硬件IO应用开发', '马扬', '2019-12-26', '100.0');
INSERT INTO `common_grade` VALUES ('162', '李嘉星', 'PA软件类', 'PV视觉应用开发', '马扬', '2019-12-26', '100.0');
INSERT INTO `common_grade` VALUES ('163', '李嘉星', 'PA软件类', '三菱PLC', '马扬', '2020-01-18', '90.0');
INSERT INTO `common_grade` VALUES ('164', '李嘉星', 'PA软件类', '威纶触摸屏', '钟智财', '2020-01-03', '80.0');
INSERT INTO `common_grade` VALUES ('165', '李嘉星', 'PA软件类', '手眼相机', '钟智财', '2020-01-04', '90.0');
INSERT INTO `common_grade` VALUES ('166', '李嘉星', 'PA软件类', '高精度纠偏', '钟智财', '2020-01-04', '95.0');
INSERT INTO `common_grade` VALUES ('167', '李嘉星', 'PA软件类', '多工具动态分拣', '郭志坚', '2020-01-14', '100.0');
INSERT INTO `common_grade` VALUES ('168', '李叶波', 'PA软件类', '机器人基本操作', '马扬', '2019-12-26', '100.0');
INSERT INTO `common_grade` VALUES ('169', '李叶波', 'PA软件类', 'PV基本使用', '马扬', '2019-12-26', '80.0');
INSERT INTO `common_grade` VALUES ('170', '李叶波', 'PA软件类', '硬件IO应用开发', '马扬', '2019-12-29', '100.0');
INSERT INTO `common_grade` VALUES ('171', '李叶波', 'PA软件类', 'PV视觉应用开发', '钟智财', '2019-12-29', '85.0');
INSERT INTO `common_grade` VALUES ('178', '李叶波', 'PA软件类', '多工具动态分拣', '郭志坚', '2020-01-16', '80.0');
INSERT INTO `common_grade` VALUES ('173', '李叶波', 'PA软件类', '三菱PLC', '钟智财', '2020-01-04', '80.0');
INSERT INTO `common_grade` VALUES ('174', '李叶波', 'PA软件类', '威纶触摸屏', '钟智财', '2020-01-02', '100.0');
INSERT INTO `common_grade` VALUES ('175', '李叶波', 'PA软件类', '手眼相机', '郭志坚', '2020-01-09', '90.0');
INSERT INTO `common_grade` VALUES ('176', '李叶波', 'PA软件类', '高精度纠偏', '马扬', '2020-01-13', '85.0');
INSERT INTO `common_grade` VALUES ('177', '郭志坚', 'PA软件类', '多工具动态分拣', '郭志坚', '2020-01-16', '80.0');
INSERT INTO `common_grade` VALUES ('179', '梁健港', 'PA软件类', '机器人基本操作', '钟智财', '2019-12-16', '90.0');
INSERT INTO `common_grade` VALUES ('180', '梁健港', 'PA软件类', 'PV基本使用', '钟智财', '2019-12-16', '90.0');
INSERT INTO `common_grade` VALUES ('181', '梁健港', 'PA软件类', '硬件IO应用开发', '钟智财', '2019-12-17', '85.0');
INSERT INTO `common_grade` VALUES ('182', '梁健港', 'PA软件类', 'PV视觉应用开发', '钟智财', '2019-12-20', '100.0');
INSERT INTO `common_grade` VALUES ('183', '梁健港', 'PA软件类', '三菱PLC', '钟智财', '2019-12-23', '100.0');
INSERT INTO `common_grade` VALUES ('184', '梁健港', 'PA软件类', '威纶触摸屏', '钟智财', '2019-12-27', '100.0');
INSERT INTO `common_grade` VALUES ('185', '梁健港', 'PA软件类', '手眼相机', '钟智财', '2019-12-30', '100.0');
INSERT INTO `common_grade` VALUES ('186', '梁健港', 'PA软件类', '高精度纠偏', '马扬', '2020-01-02', '100.0');
INSERT INTO `common_grade` VALUES ('187', '梁健港', 'PA软件类', '多工具动态分拣', '钟智财', '2020-01-06', '92.0');
INSERT INTO `common_grade` VALUES ('188', '梁乐保', 'PA软件类', '机器人基本操作', '钟智财', '2019-12-25', '98.0');
INSERT INTO `common_grade` VALUES ('189', '梁乐保', 'PA软件类', 'PV基本使用', '郭志坚', '2019-12-25', '100.0');
INSERT INTO `common_grade` VALUES ('190', '梁乐保', 'PA软件类', '硬件IO应用开发', '钟智财', '2019-12-24', '95.0');
INSERT INTO `common_grade` VALUES ('191', '梁乐保', 'PA软件类', 'PV视觉应用开发', '郭志坚', '2019-12-25', '100.0');
INSERT INTO `common_grade` VALUES ('192', '梁乐保', 'PA软件类', '三菱PLC', '马扬', '2019-12-26', '95.0');
INSERT INTO `common_grade` VALUES ('193', '梁乐保', 'PA软件类', '威纶触摸屏', '钟智财', '2019-12-26', '93.0');
INSERT INTO `common_grade` VALUES ('194', '梁乐保', 'PA软件类', '手眼相机', '钟智财', '2020-01-06', '90.0');
INSERT INTO `common_grade` VALUES ('195', '梁乐保', 'PA软件类', '高精度纠偏', '钟智财', '2020-01-08', '97.0');
INSERT INTO `common_grade` VALUES ('196', '梁乐保', 'PA软件类', '多功能动态分拣', '钟智财', '2020-01-10', '100.0');
INSERT INTO `common_grade` VALUES ('197', '刘成成', 'PA软件类', 'PV基本使用', '钟智财', '2019-12-30', '100.0');
INSERT INTO `common_grade` VALUES ('206', '刘成成', 'PA软件类', '机器人基本操作', '钟智财', '2019-12-30', '100.0');
INSERT INTO `common_grade` VALUES ('199', '刘成成', 'PA软件类', '硬件IO应用开发', '钟智财', '2019-12-21', '100.0');
INSERT INTO `common_grade` VALUES ('200', '刘成成', 'PA软件类', 'PV视觉应用开发', '钟智财', '2020-01-02', '60.0');
INSERT INTO `common_grade` VALUES ('201', '刘成成', 'PA软件类', 'PV视觉应用开发', '钟智财', '2020-01-02', '85.0');
INSERT INTO `common_grade` VALUES ('202', '刘成成', 'PA软件类', '威纶触摸屏', '钟智财', '2020-01-15', '100.0');
INSERT INTO `common_grade` VALUES ('203', '刘成成', 'PA软件类', '手眼相机', '钟智财', '2020-01-16', '90.0');
INSERT INTO `common_grade` VALUES ('204', '刘成成', 'PA软件类', '高精度纠偏', '钟智财', '2020-01-19', '100.0');
INSERT INTO `common_grade` VALUES ('205', '刘成成', 'PA软件类', '多工具动态分拣', '钟智财', '2020-01-21', '70.0');
INSERT INTO `common_grade` VALUES ('207', '罗喜', 'PA软件类', '机器人基本操作', '钟智财', '2019-12-19', '95.0');
INSERT INTO `common_grade` VALUES ('208', '罗喜', 'PA软件类', 'PV基本使用', '钟智财', '2019-12-20', '90.0');
INSERT INTO `common_grade` VALUES ('209', '罗喜', 'PA软件类', '硬件IO应用开发', '钟智财', '2019-12-20', '55.0');
INSERT INTO `common_grade` VALUES ('210', '罗喜', 'PA软件类', '硬件IO应用开发', '钟智财', '2020-01-06', '95.0');
INSERT INTO `common_grade` VALUES ('211', '罗喜', 'PA软件类', 'PV视觉应用开发', '钟智财', '2019-12-24', '95.0');
INSERT INTO `common_grade` VALUES ('212', '罗喜', 'PA软件类', '三菱PLC', '郭志坚', '2019-12-25', '90.0');
INSERT INTO `common_grade` VALUES ('213', '罗喜', 'PA软件类', '手眼相机', '钟智财', '2019-12-27', '95.0');
INSERT INTO `common_grade` VALUES ('214', '罗喜', 'PA软件类', '高精度纠偏', '郭志坚', '2020-01-06', '100.0');
INSERT INTO `common_grade` VALUES ('215', '罗喜', 'PA软件类', '高精度纠偏', '钟智财', '2020-01-03', '75.0');
INSERT INTO `common_grade` VALUES ('216', '罗喜', 'PA软件类', '多工具动态分拣', '钟智财', '2020-01-08', '85.0');
INSERT INTO `common_grade` VALUES ('217', '罗喜', 'PA软件类', '威纶触摸屏', '钟智财', '2019-12-26', '100.0');
INSERT INTO `common_grade` VALUES ('218', '莫浪', 'PA软件类', '机器人基本操作', '马扬', '2019-12-26', '100.0');
INSERT INTO `common_grade` VALUES ('219', '莫浪', 'PA软件类', 'PV基本使用', '马扬', '2019-12-26', '100.0');
INSERT INTO `common_grade` VALUES ('220', '莫浪', 'PA软件类', '硬件IO应用开发', '马扬', '2019-12-29', '100.0');
INSERT INTO `common_grade` VALUES ('221', '莫浪', 'PA软件类', 'PV视觉应用开发', '郭志坚', '2019-12-26', '100.0');
INSERT INTO `common_grade` VALUES ('222', '莫浪', 'PA软件类', '三菱PLC', '郭志坚', '2020-01-03', '90.0');
INSERT INTO `common_grade` VALUES ('223', '莫浪', 'PA软件类', '威纶触摸屏', '钟智财', '2019-12-31', '100.0');
INSERT INTO `common_grade` VALUES ('224', '莫浪', 'PA软件类', '手眼相机', '钟智财', '2020-01-02', '100.0');
INSERT INTO `common_grade` VALUES ('225', '莫浪', 'PA软件类', '高精度纠偏', '马扬', '2020-01-14', '100.0');
INSERT INTO `common_grade` VALUES ('226', '莫浪', 'PA软件类', '多工具动态分拣', '钟智财', '2019-12-31', '90.0');
INSERT INTO `common_grade` VALUES ('227', '屈民坚', 'PA软件类', '机器人基本操作', '钟智财', '2019-12-16', '90.0');
INSERT INTO `common_grade` VALUES ('228', '屈民坚', 'PA软件类', 'PV基本使用', '钟智财', '2019-12-16', '100.0');
INSERT INTO `common_grade` VALUES ('229', '屈民坚', 'PA软件类', '硬件IO应用开发', '钟智财', '2019-12-16', '90.0');
INSERT INTO `common_grade` VALUES ('230', '屈民坚', 'PA软件类', 'PV视觉应用开发', '钟智财', '2019-12-20', '100.0');
INSERT INTO `common_grade` VALUES ('231', '屈民坚', 'PA软件类', '三菱PLC', '钟智财', '2019-12-18', '100.0');
INSERT INTO `common_grade` VALUES ('232', '屈民坚', 'PA软件类', '威纶触摸屏', '钟智财', '2019-12-17', '100.0');
INSERT INTO `common_grade` VALUES ('233', '屈民坚', 'PA软件类', '手眼相机', '钟智财', '2019-12-23', '95.0');
INSERT INTO `common_grade` VALUES ('234', '屈民坚', 'PA软件类', '高精度纠偏', '郭志坚', '2019-12-25', '100.0');
INSERT INTO `common_grade` VALUES ('235', '屈民坚', 'PA软件类', '多工具动态分拣', '马扬', '2019-12-26', '100.0');
INSERT INTO `common_grade` VALUES ('236', '张孟良', 'PA软件类', '机器人基本操作', '钟智财', '2019-12-19', '93.0');
INSERT INTO `common_grade` VALUES ('237', '张孟良', 'PA软件类', 'PV基本使用', '钟智财', '2019-12-20', '100.0');
INSERT INTO `common_grade` VALUES ('238', '张孟良', 'PA软件类', '硬件IO应用开发', '钟智财', '2019-12-25', '83.0');
INSERT INTO `common_grade` VALUES ('239', '张孟良', 'PA软件类', 'PV视觉应用开发', '郭志坚', '2019-12-25', '100.0');
INSERT INTO `common_grade` VALUES ('240', '张孟良', 'PA软件类', '三菱PLC', '钟智财', '2019-12-29', '80.0');
INSERT INTO `common_grade` VALUES ('585', '周康', 'PA软件类', '机器人基本操作', '马扬', '2019-12-27', '95.0');
INSERT INTO `common_grade` VALUES ('242', '张孟良', 'PA软件类', '手眼相机', '钟智财', '2020-01-04', '55.0');
INSERT INTO `common_grade` VALUES ('243', '张孟良', 'PA软件类', '手眼相机', '马扬', '2020-01-13', '80.0');
INSERT INTO `common_grade` VALUES ('244', '张孟良', 'PA软件类', '高精度纠偏', '钟智财', '2020-01-07', '85.0');
INSERT INTO `common_grade` VALUES ('245', '张孟良', 'PA软件类', '多工具动态分拣', '郭志坚', '2020-01-09', '70.0');
INSERT INTO `common_grade` VALUES ('246', '张孟良', 'PA软件类', '威纶触摸屏', '钟智财', '2019-12-31', '80.0');
INSERT INTO `common_grade` VALUES ('247', '赵天朋', 'PA软件类', '机器人基本操作', '钟智财', '2020-01-08', '100.0');
INSERT INTO `common_grade` VALUES ('248', '赵天朋', 'PA软件类', '机器人基本操作', '钟智财', '2019-12-16', '95.0');
INSERT INTO `common_grade` VALUES ('249', '赵天朋', 'PA软件类', 'PV基本使用', '钟智财', '2019-12-16', '90.0');
INSERT INTO `common_grade` VALUES ('250', '赵天朋', 'PA软件类', '硬件IO应用开发', '钟智财', '2019-12-23', '85.0');
INSERT INTO `common_grade` VALUES ('251', '赵天朋', 'PA软件类', 'PV视觉应用开发', '郭志坚', '2019-12-25', '80.0');
INSERT INTO `common_grade` VALUES ('252', '赵天朋', 'PA软件类', '三菱PLC', '钟智财', '2019-12-26', '95.0');
INSERT INTO `common_grade` VALUES ('253', '赵天朋', 'PA软件类', '威纶触摸屏', '钟智财', '2019-12-31', '100.0');
INSERT INTO `common_grade` VALUES ('255', '赵天朋', 'PA软件类', '手眼相机', '钟智财', '2020-01-07', '100.0');
INSERT INTO `common_grade` VALUES ('256', '赵天朋', 'PA软件类', '高精度纠偏', '钟智财', '2020-01-08', '100.0');
INSERT INTO `common_grade` VALUES ('257', '赵天朋', 'PA软件类', '多工具动态分拣', '郭志坚', '2020-01-13', '100.0');
INSERT INTO `common_grade` VALUES ('259', '周康', 'PA软件类', 'PV基本使用', '马扬', '2020-01-14', '100.0');
INSERT INTO `common_grade` VALUES ('260', '周康', 'PA软件类', '硬件IO应用开发', '马扬', '2020-01-14', '50.0');
INSERT INTO `common_grade` VALUES ('263', '曾双雄', '通用类', '图纸', '马扬', '2019-10-09', '32.5');
INSERT INTO `common_grade` VALUES ('264', '曾双雄', '通用类', '电气模块', '马扬', '2019-10-09', '100.0');
INSERT INTO `common_grade` VALUES ('265', '曾双雄', '通用类', '机械模块', '马扬', '2019-10-09', '94.0');
INSERT INTO `common_grade` VALUES ('266', '范国华', '通用类', '通用PLC', '马扬', '2019-10-10', '45.0');
INSERT INTO `common_grade` VALUES ('267', '范国华', '通用类', '通用PLC', '马扬', '2019-10-12', '100.0');
INSERT INTO `common_grade` VALUES ('268', '范国华', '通用类', '万用表', '马扬', '2019-09-27', '67.0');
INSERT INTO `common_grade` VALUES ('269', '范国华', '通用类', '相机', '马扬', '2019-09-27', '32.0');
INSERT INTO `common_grade` VALUES ('270', '范国华', '通用类', '图纸', '马扬', '2019-10-09', '42.5');
INSERT INTO `common_grade` VALUES ('271', '范国华', '通用类', '电气模块', '马扬', '2019-10-09', '96.0');
INSERT INTO `common_grade` VALUES ('272', '范国华', '通用类', '机械模块', '马扬', '2019-10-09', '88.0');
INSERT INTO `common_grade` VALUES ('273', '付传波', '通用类', '通用PLC', '马扬', '2019-10-23', '100.0');
INSERT INTO `common_grade` VALUES ('274', '付传波', '通用类', '万用表', '马扬', '2019-10-23', '72.0');
INSERT INTO `common_grade` VALUES ('275', '付传波', '通用类', '相机', '马扬', '2019-10-23', '46.0');
INSERT INTO `common_grade` VALUES ('276', '付传波', '通用类', '图纸', '马扬', '2019-10-23', '50.5');
INSERT INTO `common_grade` VALUES ('277', '付传波', '通用类', '电气模块', '马扬', '2019-10-23', '98.0');
INSERT INTO `common_grade` VALUES ('278', '付传波', '通用类', '机械模块', '马扬', '2019-10-23', '97.0');
INSERT INTO `common_grade` VALUES ('279', '何德雄', '通用类', '通用PLC', '马扬', '2020-01-04', '80.0');
INSERT INTO `common_grade` VALUES ('280', '何德雄', '通用类', '相机', '马扬', '2020-01-04', '65.0');
INSERT INTO `common_grade` VALUES ('281', '何德雄', '通用类', '图纸', '马扬', '2020-01-04', '38.0');
INSERT INTO `common_grade` VALUES ('282', '何德雄', '通用类', '万用表', '马扬', '2020-01-04', '69.0');
INSERT INTO `common_grade` VALUES ('283', '黄敬业', '通用类', '通用PLC', '马扬', '2019-10-14', '100.0');
INSERT INTO `common_grade` VALUES ('284', '黄敬业', '通用类', '万用表', '马扬', '2019-09-27', '75.0');
INSERT INTO `common_grade` VALUES ('285', '黄敬业', '通用类', '相机', '马扬', '2019-10-09', '13.0');
INSERT INTO `common_grade` VALUES ('286', '黄敬业', '通用类', '电气模块', '马扬', '2019-10-09', '95.0');
INSERT INTO `common_grade` VALUES ('287', '黄敬业', '通用类', '机械模块', '马扬', '2019-10-09', '100.0');
INSERT INTO `common_grade` VALUES ('288', '姜展', '通用类', '通用PLC', '马扬', '2019-10-11', '70.0');
INSERT INTO `common_grade` VALUES ('289', '姜展', '通用类', '通用PLC', '马扬', '2019-10-14', '70.0');
INSERT INTO `common_grade` VALUES ('290', '姜展', '通用类', '万用表', '马扬', '2019-10-17', '60.0');
INSERT INTO `common_grade` VALUES ('291', '姜展', '通用类', '相机', '马扬', '2019-10-10', '14.0');
INSERT INTO `common_grade` VALUES ('292', '姜展', '通用类', '图纸', '马扬', '2019-10-10', '27.0');
INSERT INTO `common_grade` VALUES ('293', '姜展', '通用类', '电气模块', '马扬', '2019-10-10', '90.0');
INSERT INTO `common_grade` VALUES ('294', '姜展', '通用类', '机械模块', '马扬', '2019-10-10', '100.0');
INSERT INTO `common_grade` VALUES ('295', '柯伟', '通用类', '通用PLC', '马扬', '2019-10-22', '60.0');
INSERT INTO `common_grade` VALUES ('296', '柯伟', '通用类', '万用表', '马扬', '2019-09-27', '56.0');
INSERT INTO `common_grade` VALUES ('297', '柯伟', '通用类', '相机', '马扬', '2019-09-27', '15.0');
INSERT INTO `common_grade` VALUES ('298', '柯伟', '通用类', '图纸', '马扬', '2019-10-09', '17.0');
INSERT INTO `common_grade` VALUES ('299', '冷雄伟', '通用类', '通用PLC', '马扬', '2019-10-16', '100.0');
INSERT INTO `common_grade` VALUES ('300', '冷雄伟', '通用类', '万用表', '马扬', '2019-10-16', '75.0');
INSERT INTO `common_grade` VALUES ('301', '冷雄伟', '通用类', '相机', '马扬', '2019-10-16', '70.0');
INSERT INTO `common_grade` VALUES ('302', '冷雄伟', '通用类', '图纸', '马扬', '2019-10-16', '58.0');
INSERT INTO `common_grade` VALUES ('303', '冷雄伟', '通用类', '电气模块', '马扬', '2019-10-16', '100.0');
INSERT INTO `common_grade` VALUES ('304', '冷雄伟', '通用类', '机械模块', '马扬', '2019-10-16', '100.0');
INSERT INTO `common_grade` VALUES ('305', '李嘉星', '通用类', '通用PLC', '马扬', '2019-10-25', '90.0');
INSERT INTO `common_grade` VALUES ('306', '李嘉星', '通用类', '万用表', '马扬', '2019-10-18', '70.0');
INSERT INTO `common_grade` VALUES ('307', '李嘉星', '通用类', '相机', '马扬', '2019-10-18', '40.0');
INSERT INTO `common_grade` VALUES ('308', '李嘉星', '通用类', '机械模块', '马扬', '2019-10-18', '98.0');
INSERT INTO `common_grade` VALUES ('309', '李嘉星', '通用类', '图纸', '马扬', '2019-10-18', '37.0');
INSERT INTO `common_grade` VALUES ('310', '梁健港', '通用类', '通用PLC', '马扬', '2019-10-14', '100.0');
INSERT INTO `common_grade` VALUES ('311', '梁健港', '通用类', '万用表', '马扬', '2019-10-15', '67.0');
INSERT INTO `common_grade` VALUES ('312', '梁健港', '通用类', '图纸', '马扬', '2019-10-15', '37.0');
INSERT INTO `common_grade` VALUES ('313', '梁健港', '通用类', '图纸', '马扬', '2019-10-15', '58.0');
INSERT INTO `common_grade` VALUES ('314', '梁健港', '通用类', '电气模块', '马扬', '2019-10-15', '92.0');
INSERT INTO `common_grade` VALUES ('315', '梁健港', '通用类', '机械模块', '马扬', '2019-10-15', '87.0');
INSERT INTO `common_grade` VALUES ('316', '梁乐保', '通用类', '通用PLC', '马扬', '2019-10-17', '100.0');
INSERT INTO `common_grade` VALUES ('317', '梁乐保', '通用类', '万用表', '马扬', '2019-10-14', '100.0');
INSERT INTO `common_grade` VALUES ('318', '梁乐保', '通用类', '相机', '马扬', '2019-10-14', '69.0');
INSERT INTO `common_grade` VALUES ('319', '梁乐保', '通用类', '图纸', '马扬', '2019-10-19', '54.0');
INSERT INTO `common_grade` VALUES ('320', '梁乐保', '通用类', '电气模块', '马扬', '2019-10-19', '98.0');
INSERT INTO `common_grade` VALUES ('321', '梁乐保', '通用类', '机械模块', '马扬', '2019-10-19', '100.0');
INSERT INTO `common_grade` VALUES ('322', '刘成成', '通用类', '万用表', '马扬', '2020-01-04', '77.0');
INSERT INTO `common_grade` VALUES ('323', '刘成成', '通用类', '相机', '马扬', '2019-01-04', '35.0');
INSERT INTO `common_grade` VALUES ('324', '刘成成', '通用类', '图纸', '马扬', '2019-01-04', '57.5');
INSERT INTO `common_grade` VALUES ('325', '罗喜', '通用类', '通用PLC', '马扬', '2019-10-11', '100.0');
INSERT INTO `common_grade` VALUES ('326', '罗喜', '通用类', '万用表', '马扬', '2019-09-27', '74.0');
INSERT INTO `common_grade` VALUES ('327', '罗喜', '通用类', '相机', '马扬', '2019-10-16', '60.0');
INSERT INTO `common_grade` VALUES ('328', '罗喜', '通用类', '相机', '马扬', '2019-09-27', '25.0');
INSERT INTO `common_grade` VALUES ('329', '罗喜', '通用类', '图纸', '马扬', '2019-10-09', '62.5');
INSERT INTO `common_grade` VALUES ('330', '罗喜', '通用类', '电气模块', '马扬', '2019-10-09', '100.0');
INSERT INTO `common_grade` VALUES ('331', '罗喜', '通用类', '机械模块', '马扬', '2019-10-09', '97.0');
INSERT INTO `common_grade` VALUES ('332', '莫浪', '通用类', '通用PLC', '马扬', '2019-10-21', '100.0');
INSERT INTO `common_grade` VALUES ('333', '莫浪', '通用类', '万用表', '马扬', '2019-10-21', '93.0');
INSERT INTO `common_grade` VALUES ('334', '莫浪', '通用类', '相机', '马扬', '2019-10-21', '90.0');
INSERT INTO `common_grade` VALUES ('335', '莫浪', '通用类', '图纸', '马扬', '2019-10-21', '91.0');
INSERT INTO `common_grade` VALUES ('336', '莫浪', '通用类', '电气模块', '马扬', '2019-10-21', '87.0');
INSERT INTO `common_grade` VALUES ('337', '莫浪', '通用类', '机械模块', '马扬', '2019-10-21', '100.0');
INSERT INTO `common_grade` VALUES ('338', '屈民坚', '通用类', '通用PLC', '马扬', '2019-10-12', '100.0');
INSERT INTO `common_grade` VALUES ('339', '屈民坚', '通用类', '万用表', '马扬', '2019-10-16', '91.0');
INSERT INTO `common_grade` VALUES ('340', '屈民坚', '通用类', '万用表', '马扬', '2019-09-27', '66.0');
INSERT INTO `common_grade` VALUES ('341', '屈民坚', '通用类', '相机', '马扬', '2019-10-16', '90.0');
INSERT INTO `common_grade` VALUES ('342', '屈民坚', '通用类', '相机', '马扬', '2019-09-27', '46.0');
INSERT INTO `common_grade` VALUES ('343', '屈民坚', '通用类', '图纸', '马扬', '2019-10-16', '96.0');
INSERT INTO `common_grade` VALUES ('344', '屈民坚', '通用类', '图纸', '马扬', '2019-10-09', '53.0');
INSERT INTO `common_grade` VALUES ('345', '屈民坚', '通用类', '电气模块', '马扬', '2019-10-09', '100.0');
INSERT INTO `common_grade` VALUES ('346', '屈民坚', '通用类', '机械模块', '马扬', '2019-10-09', '81.0');
INSERT INTO `common_grade` VALUES ('347', '张孟良', '通用类', '通用PLC', '马扬', '2019-10-14', '85.0');
INSERT INTO `common_grade` VALUES ('348', '张孟良', '通用类', '万用表', '马扬', '2019-09-29', '75.0');
INSERT INTO `common_grade` VALUES ('349', '张孟良', '通用类', '相机', '马扬', '2019-10-18', '65.0');
INSERT INTO `common_grade` VALUES ('350', '张孟良', '通用类', '相机', '马扬', '2019-09-29', '37.0');
INSERT INTO `common_grade` VALUES ('351', '张孟良', '通用类', '图纸', '马扬', '2019-10-09', '61.0');
INSERT INTO `common_grade` VALUES ('352', '张孟良', '通用类', '电气模块', '马扬', '2019-10-09', '95.0');
INSERT INTO `common_grade` VALUES ('353', '张孟良', '通用类', '机械模块', '马扬', '2019-10-09', '97.0');
INSERT INTO `common_grade` VALUES ('354', '赵天朋', '通用类', '通用PLC', '马扬', '2019-10-22', '100.0');
INSERT INTO `common_grade` VALUES ('355', '赵天朋', '通用类', '万用表', '马扬', '2019-10-22', '96.0');
INSERT INTO `common_grade` VALUES ('356', '赵天朋', '通用类', '万用表', '马扬', '2019-10-23', '85.0');
INSERT INTO `common_grade` VALUES ('357', '赵天朋', '通用类', '相机', '马扬', '2019-10-16', '60.0');
INSERT INTO `common_grade` VALUES ('358', '赵天朋', '通用类', '图纸', '马扬', '2019-10-21', '92.5');
INSERT INTO `common_grade` VALUES ('359', '赵天朋', '通用类', '电气模块', '马扬', '2019-10-21', '100.0');
INSERT INTO `common_grade` VALUES ('360', '赵天朋', '通用类', '机械模块', '马扬', '2019-10-21', '100.0');
INSERT INTO `common_grade` VALUES ('361', '黄敬业', '通用类', '图纸', '马扬', '2019-10-09', '69.5');
INSERT INTO `common_grade` VALUES ('365', '曾双雄', 'PA机械类', 'AH机器人电机减速机组件拆装', '马扬', '2019-09-18', '99.0');
INSERT INTO `common_grade` VALUES ('364', '曾双雄', 'PA机械类', 'AH机器人PA卡组件拆装', '马扬', '2019-09-17', '89.5');
INSERT INTO `common_grade` VALUES ('366', '曾双雄', 'PA机械类', 'AH机器人三轴张紧机构拆装', '马扬', '2019-09-18', '100.0');
INSERT INTO `common_grade` VALUES ('367', '曾双雄', 'PA机械类', 'AH机器人丝杆组件拆装', '马扬', '2019-09-18', '99.0');
INSERT INTO `common_grade` VALUES ('368', '曾双雄', 'PA机械类', 'AH机器人硬件维护操作', '马扬', '2019-08-16', '100.0');
INSERT INTO `common_grade` VALUES ('369', '曾双雄', 'PA机械类', 'AP机器人PA卡组件拆装', '马扬', '2019-09-16', '90.0');
INSERT INTO `common_grade` VALUES ('370', '曾双雄', 'PA机械类', 'AP机器人电机减速机组件拆装', '马扬', '2019-09-16', '95.0');
INSERT INTO `common_grade` VALUES ('371', '曾双雄', 'PA机械类', 'AP机器人硬件维护操作', '马扬', '2019-09-17', '100.0');
INSERT INTO `common_grade` VALUES ('372', '曾双雄', 'PA机械类', 'HS机器人电机减速机组件拆装', '马扬', '2019-09-20', '96.0');
INSERT INTO `common_grade` VALUES ('373', '曾双雄', 'PA机械类', 'HS机器人丝杆组件拆装', '马扬', '2019-09-20', '94.0');
INSERT INTO `common_grade` VALUES ('374', '曾双雄', 'PA机械类', 'HS机器人硬件维护操作考核', '马扬', '2019-09-19', '100.0');
INSERT INTO `common_grade` VALUES ('375', '曾双雄', 'PA机械类', 'HS机器人PA卡组件拆装', '马扬', '2019-09-19', '99.0');
INSERT INTO `common_grade` VALUES ('376', '范国华', 'PA机械类', 'AH机器人PA卡组件拆装', '马扬', '2019-08-30', '90.5');
INSERT INTO `common_grade` VALUES ('377', '范国华', 'PA机械类', 'AH机器人电机减速机组件拆装', '马扬', '2019-09-20', '88.0');
INSERT INTO `common_grade` VALUES ('378', '范国华', 'PA机械类', 'AH机器人三轴张紧机构拆装', '马扬', '2019-09-20', '92.0');
INSERT INTO `common_grade` VALUES ('379', '范国华', 'PA机械类', 'AH机器人丝杆组件拆装', '马扬', '2019-09-03', '91.0');
INSERT INTO `common_grade` VALUES ('380', '范国华', 'PA机械类', 'AH机器人硬件维护操作', '马扬', '2019-08-30', '100.0');
INSERT INTO `common_grade` VALUES ('381', '范国华', 'PA机械类', 'AP机器人PA卡组件拆装', '马扬', '2019-09-03', '99.0');
INSERT INTO `common_grade` VALUES ('382', '范国华', 'PA机械类', 'AP机器人电机减速机组件拆装', '马扬', '2019-09-02', '94.0');
INSERT INTO `common_grade` VALUES ('383', '范国华', 'PA机械类', 'AP机器人硬件维护操作', '马扬', '2019-09-02', '97.0');
INSERT INTO `common_grade` VALUES ('384', '范国华', 'PA机械类', 'HS机器人PA卡组件拆装', '马扬', '2019-08-30', '98.0');
INSERT INTO `common_grade` VALUES ('385', '范国华', 'PA机械类', 'HS机器人电机减速机组件拆装', '马扬', '2019-09-21', '98.0');
INSERT INTO `common_grade` VALUES ('388', '范国华', 'PA机械类', 'HS机器人丝杆组件拆装', '马扬', '2019-09-21', '97.0');
INSERT INTO `common_grade` VALUES ('387', '范国华', 'PA机械类', 'HS机器人硬件维护操作考核', '马扬', '2019-09-20', '100.0');
INSERT INTO `common_grade` VALUES ('389', '付传波', 'PA机械类', 'AH机器人PA卡组件拆装', '马扬', '2019-09-25', '83.0');
INSERT INTO `common_grade` VALUES ('390', '付传波', 'PA机械类', 'AH机器人电机减速机组件拆装', '马扬', '2019-09-25', '100.0');
INSERT INTO `common_grade` VALUES ('391', '付传波', 'PA机械类', 'AH机器人丝杆组件拆装', '马扬', '2019-09-24', '98.0');
INSERT INTO `common_grade` VALUES ('392', '付传波', 'PA机械类', 'AH机器人硬件维护操作', '马扬', '2019-09-24', '100.0');
INSERT INTO `common_grade` VALUES ('393', '付传波', 'PA机械类', 'AP机器人PA卡组件拆装', '马扬', '2019-10-09', '92.0');
INSERT INTO `common_grade` VALUES ('394', '付传波', 'PA机械类', 'AP机器人电机减速机组件拆装', '马扬', '2019-10-09', '96.0');
INSERT INTO `common_grade` VALUES ('395', '郭钊宏', 'PA机械类', 'AH机器人PA卡组件拆装', '马扬', '2019-09-18', '82.5');
INSERT INTO `common_grade` VALUES ('396', '郭钊宏', 'PA机械类', 'AH机器人电机减速机组件拆装', '马扬', '2019-09-20', '99.0');
INSERT INTO `common_grade` VALUES ('397', '郭钊宏', 'PA机械类', 'AH机器人三轴张紧机构拆装', '马扬', '2019-09-19', '85.0');
INSERT INTO `common_grade` VALUES ('398', '郭钊宏', 'PA机械类', 'AH机器人丝杆组件拆装', '马扬', '2019-09-20', '71.0');
INSERT INTO `common_grade` VALUES ('399', '郭钊宏', 'PA机械类', 'AH机器人硬件维护操作', '马扬', '2019-09-18', '94.0');
INSERT INTO `common_grade` VALUES ('400', '郭钊宏', 'PA机械类', 'AP机器人PA卡组件拆装', '马扬', '2019-09-18', '79.0');
INSERT INTO `common_grade` VALUES ('401', '郭钊宏', 'PA机械类', 'AP机器人电机减速机组件拆装', '马扬', '2019-09-18', '74.0');
INSERT INTO `common_grade` VALUES ('402', '郭钊宏', 'PA机械类', 'AP机器人硬件维护操作', '马扬', '2019-09-19', '98.0');
INSERT INTO `common_grade` VALUES ('403', '郭钊宏', 'PA机械类', 'HS机器人PA卡组件拆装', '马扬', '2019-09-20', '96.0');
INSERT INTO `common_grade` VALUES ('404', '郭钊宏', 'PA机械类', 'HS机器人电机减速机组件拆装', '马扬', '2019-09-21', '97.0');
INSERT INTO `common_grade` VALUES ('405', '郭钊宏', 'PA机械类', 'HS机器人丝杆组件拆装', '马扬', '2019-09-21', '100.0');
INSERT INTO `common_grade` VALUES ('406', '郭钊宏', 'PA机械类', 'HS机器人硬件维护操作考核', '马扬', '2019-09-20', '100.0');
INSERT INTO `common_grade` VALUES ('407', '何德雄', 'PA机械类', 'AH机器人电机减速机组件拆装', '马扬', '2020-01-03', '98.0');
INSERT INTO `common_grade` VALUES ('408', '何德雄', 'PA机械类', 'AH机器人PA卡组件拆装', '马扬', '2020-01-03', '97.0');
INSERT INTO `common_grade` VALUES ('409', '何德雄', 'PA机械类', 'AH机器人三轴张紧机构拆装', '马扬', '2020-01-03', '100.0');
INSERT INTO `common_grade` VALUES ('410', '何德雄', 'PA机械类', 'AH机器人丝杆组件拆装', '马扬', '2020-01-03', '99.0');
INSERT INTO `common_grade` VALUES ('411', '何德雄', 'PA机械类', 'AH机器人硬件维护操作', '马扬', '2020-01-03', '100.0');
INSERT INTO `common_grade` VALUES ('412', '何德雄', 'PA机械类', 'AP机器人PA卡组件拆装', '马扬', '2020-01-04', '96.0');
INSERT INTO `common_grade` VALUES ('413', '何德雄', 'PA机械类', 'AP机器人电机减速机组件拆装', '马扬', '2020-01-04', '98.0');
INSERT INTO `common_grade` VALUES ('414', '何德雄', 'PA机械类', 'AP机器人硬件维护操作', '马扬', '2020-01-04', '100.0');
INSERT INTO `common_grade` VALUES ('415', '何德雄', 'PA机械类', 'HS机器人PA卡组件拆装', '马扬', '2020-01-03', '97.0');
INSERT INTO `common_grade` VALUES ('416', '何德雄', 'PA机械类', 'HS机器人电机减速机组件拆装', '马扬', '2020-01-03', '98.0');
INSERT INTO `common_grade` VALUES ('417', '何德雄', 'PA机械类', 'HS机器人丝杆组件拆装', '马扬', '2020-01-03', '88.0');
INSERT INTO `common_grade` VALUES ('418', '何德雄', 'PA机械类', 'HS机器人硬件维护操作考核', '马扬', '2020-01-03', '100.0');
INSERT INTO `common_grade` VALUES ('419', '黄敬业', 'PA机械类', 'AH机器人PA卡组件拆装', '马扬', '2019-09-10', '68.0');
INSERT INTO `common_grade` VALUES ('421', '黄敬业', 'PA机械类', 'AH机器人PA卡组件拆装', '马扬', '2019-09-18', '100.0');
INSERT INTO `common_grade` VALUES ('422', '黄敬业', 'PA机械类', 'AH机器人电机减速机组件拆装', '马扬', '2019-09-03', '97.0');
INSERT INTO `common_grade` VALUES ('423', '黄敬业', 'PA机械类', 'AH机器人三轴张紧机构拆装', '马扬', '2019-09-03', '100.0');
INSERT INTO `common_grade` VALUES ('424', '黄敬业', 'PA机械类', 'AH机器人丝杆组件拆装', '马扬', '2019-09-02', '95.0');
INSERT INTO `common_grade` VALUES ('425', '黄敬业', 'PA机械类', 'AH机器人硬件维护操作', '钟智财', '2019-09-02', '100.0');
INSERT INTO `common_grade` VALUES ('426', '黄敬业', 'PA机械类', 'AP机器人PA卡组件拆装', '马扬', '2020-09-02', '98.0');
INSERT INTO `common_grade` VALUES ('427', '黄敬业', 'PA机械类', 'AP机器人电机减速机组件拆装', '马扬', '2019-08-30', '100.0');
INSERT INTO `common_grade` VALUES ('428', '黄敬业', 'PA机械类', 'AP机器人硬件维护操作', '马扬', '2019-08-30', '100.0');
INSERT INTO `common_grade` VALUES ('429', '黄敬业', 'PA机械类', 'HS机器人PA卡组件拆装', '马扬', '2019-08-30', '100.0');
INSERT INTO `common_grade` VALUES ('430', '黄敬业', 'PA机械类', 'HS机器人电机减速机组件拆装', '马扬', '2019-08-28', '79.0');
INSERT INTO `common_grade` VALUES ('431', '黄敬业', 'PA机械类', 'HS机器人丝杆组件拆装', '马扬', '2019-08-27', '85.0');
INSERT INTO `common_grade` VALUES ('432', '黄敬业', 'PA机械类', 'HS机器人硬件维护操作考核', '马扬', '2019-08-27', '100.0');
INSERT INTO `common_grade` VALUES ('433', '姜展', 'PA机械类', 'AH机器人PA卡组件拆装', '马扬', '2019-09-24', '79.0');
INSERT INTO `common_grade` VALUES ('434', '姜展', 'PA机械类', 'AH机器人电机减速机组件拆装', '马扬', '2019-10-12', '93.0');
INSERT INTO `common_grade` VALUES ('435', '姜展', 'PA机械类', 'AH机器人丝杆组件拆装', '马扬', '2019-09-25', '69.0');
INSERT INTO `common_grade` VALUES ('436', '姜展', 'PA机械类', 'AP机器人PA卡组件拆装', '马扬', '2019-10-11', '88.0');
INSERT INTO `common_grade` VALUES ('437', '姜展', 'PA机械类', 'AP机器人电机减速机组件拆装', '马扬', '2019-10-09', '93.0');
INSERT INTO `common_grade` VALUES ('438', '姜展', 'PA机械类', 'AP机器人硬件维护操作', '马扬', '2019-09-24', '87.0');
INSERT INTO `common_grade` VALUES ('439', '柯伟', 'PA机械类', 'AH机器人PA卡组件拆装', '马扬', '2019-09-10', '75.5');
INSERT INTO `common_grade` VALUES ('440', '柯伟', 'PA机械类', 'AH机器人电机减速机组件拆装', '马扬', '2019-09-11', '81.0');
INSERT INTO `common_grade` VALUES ('441', '柯伟', 'PA机械类', 'AH机器人三轴张紧机构拆装', '马扬', '2019-09-06', '95.0');
INSERT INTO `common_grade` VALUES ('442', '柯伟', 'PA机械类', 'AH机器人丝杆组件拆装', '马扬', '2019-09-09', '32.0');
INSERT INTO `common_grade` VALUES ('443', '柯伟', 'PA机械类', 'AH机器人丝杆组件拆装', '马扬', '2019-09-20', '89.0');
INSERT INTO `common_grade` VALUES ('444', '柯伟', 'PA机械类', 'AH机器人硬件维护操作', '马扬', '2019-09-06', '88.0');
INSERT INTO `common_grade` VALUES ('445', '柯伟', 'PA机械类', 'AP机器人PA卡组件拆装', '马扬', '2019-09-12', '72.0');
INSERT INTO `common_grade` VALUES ('446', '柯伟', 'PA机械类', 'AP机器人电机减速机组件拆装', '马扬', '2019-09-17', '82.0');
INSERT INTO `common_grade` VALUES ('447', '柯伟', 'PA机械类', 'AP机器人硬件维护操作', '马扬', '2019-09-10', '86.0');
INSERT INTO `common_grade` VALUES ('448', '柯伟', 'PA机械类', 'HS机器人PA卡组件拆装', '马扬', '2019-09-16', '90.0');
INSERT INTO `common_grade` VALUES ('449', '柯伟', 'PA机械类', 'HS机器人电机减速机组件拆装', '马扬', '2019-09-18', '79.0');
INSERT INTO `common_grade` VALUES ('453', '冷雄伟', 'PA机械类', 'AH机器人PA卡组件拆装', '马扬', '2019-09-05', '99.0');
INSERT INTO `common_grade` VALUES ('451', '柯伟', 'PA机械类', 'HS机器人丝杆组件拆装', '马扬', '2019-09-18', '89.0');
INSERT INTO `common_grade` VALUES ('452', '柯伟', 'PA机械类', 'HS机器人硬件维护操作考核', '马扬', '2019-09-12', '100.0');
INSERT INTO `common_grade` VALUES ('454', '冷雄伟', 'PA机械类', 'AH机器人电机减速机组件拆装', '马扬', '2019-09-06', '100.0');
INSERT INTO `common_grade` VALUES ('466', '李嘉星', 'PA机械类', 'AH机器人PA卡组件拆装', '马扬', '2019-09-20', '75.5');
INSERT INTO `common_grade` VALUES ('456', '冷雄伟', 'PA机械类', 'AH机器人三轴张紧机构拆装', '马扬', '2019-09-03', '100.0');
INSERT INTO `common_grade` VALUES ('457', '冷雄伟', 'PA机械类', 'AH机器人丝杆组件拆装', '马扬', '2019-09-16', '91.0');
INSERT INTO `common_grade` VALUES ('458', '冷雄伟', 'PA机械类', 'AH机器人硬件维护操作', '马扬', '2019-09-30', '100.0');
INSERT INTO `common_grade` VALUES ('459', '冷雄伟', 'PA机械类', 'AP机器人PA卡组件拆装', '马扬', '2019-08-29', '100.0');
INSERT INTO `common_grade` VALUES ('460', '冷雄伟', 'PA机械类', 'AP机器人电机减速机组件拆装', '马扬', '2020-08-30', '100.0');
INSERT INTO `common_grade` VALUES ('461', '冷雄伟', 'PA机械类', 'AP机器人硬件维护操作', '马扬', '2019-08-30', '100.0');
INSERT INTO `common_grade` VALUES ('462', '冷雄伟', 'PA机械类', 'HS机器人PA卡组件拆装', '马扬', '2019-08-29', '92.0');
INSERT INTO `common_grade` VALUES ('463', '冷雄伟', 'PA机械类', 'HS机器人电机减速机组件拆装', '马扬', '2019-09-02', '100.0');
INSERT INTO `common_grade` VALUES ('464', '冷雄伟', 'PA机械类', 'HS机器人丝杆组件拆装', '马扬', '2019-09-02', '89.0');
INSERT INTO `common_grade` VALUES ('465', '冷雄伟', 'PA机械类', 'HS机器人硬件维护操作考核', '马扬', '2019-08-30', '100.0');
INSERT INTO `common_grade` VALUES ('467', '李嘉星', 'PA机械类', 'AH机器人电机减速机组件拆装', '马扬', '2019-09-21', '98.0');
INSERT INTO `common_grade` VALUES ('468', '李嘉星', 'PA机械类', 'AH机器人三轴张紧机构拆装', '马扬', '2019-08-27', '100.0');
INSERT INTO `common_grade` VALUES ('469', '李嘉星', 'PA机械类', 'AH机器人丝杆组件拆装', '马扬', '2019-08-27', '97.0');
INSERT INTO `common_grade` VALUES ('470', '李嘉星', 'PA机械类', 'AH机器人硬件维护操作', '马扬', '2019-08-27', '91.0');
INSERT INTO `common_grade` VALUES ('471', '李嘉星', 'PA机械类', 'AP机器人PA卡组件拆装', '马扬', '2019-09-19', '96.0');
INSERT INTO `common_grade` VALUES ('472', '李嘉星', 'PA机械类', 'AP机器人电机减速机组件拆装', '马扬', '2019-09-19', '96.0');
INSERT INTO `common_grade` VALUES ('473', '李嘉星', 'PA机械类', 'AP机器人硬件维护操作', '马扬', '2019-09-16', '96.0');
INSERT INTO `common_grade` VALUES ('474', '李嘉星', 'PA机械类', 'HS机器人PA卡组件拆装', '马扬', '2019-09-21', '94.0');
INSERT INTO `common_grade` VALUES ('475', '李嘉星', 'PA机械类', 'HS机器人电机减速机组件拆装', '马扬', '2019-09-21', '73.0');
INSERT INTO `common_grade` VALUES ('476', '李嘉星', 'PA机械类', 'HS机器人丝杆组件拆装', '马扬', '2019-09-21', '100.0');
INSERT INTO `common_grade` VALUES ('477', '李嘉星', 'PA机械类', 'HS机器人硬件维护操作考核', '马扬', '2019-09-21', '100.0');
INSERT INTO `common_grade` VALUES ('478', '梁健港', 'PA机械类', 'AH机器人PA卡组件拆装', '马扬', '2019-09-09', '99.0');
INSERT INTO `common_grade` VALUES ('479', '梁健港', 'PA机械类', 'AH机器人电机减速机组件拆装', '马扬', '2019-09-17', '98.0');
INSERT INTO `common_grade` VALUES ('480', '梁健港', 'PA机械类', 'AH机器人三轴张紧机构拆装', '马扬', '2019-09-17', '100.0');
INSERT INTO `common_grade` VALUES ('481', '梁健港', 'PA机械类', 'AH机器人丝杆组件拆装', '马扬', '2019-09-18', '63.0');
INSERT INTO `common_grade` VALUES ('482', '梁健港', 'PA机械类', 'AH机器人硬件维护操作', '马扬', '2019-09-09', '100.0');
INSERT INTO `common_grade` VALUES ('483', '梁健港', 'PA机械类', 'AP机器人PA卡组件拆装', '马扬', '2019-09-10', '100.0');
INSERT INTO `common_grade` VALUES ('484', '梁健港', 'PA机械类', 'AP机器人电机减速机组件拆装', '马扬', '2019-09-11', '88.0');
INSERT INTO `common_grade` VALUES ('485', '梁健港', 'PA机械类', 'AP机器人硬件维护操作', '马扬', '2019-09-10', '83.0');
INSERT INTO `common_grade` VALUES ('486', '梁健港', 'PA机械类', 'HS机器人PA卡组件拆装', '马扬', '2019-09-10', '100.0');
INSERT INTO `common_grade` VALUES ('487', '梁健港', 'PA机械类', 'HS机器人电机减速机组件拆装', '马扬', '2020-08-19', '87.0');
INSERT INTO `common_grade` VALUES ('488', '梁健港', 'PA机械类', 'HS机器人丝杆组件拆装', '马扬', '2019-09-18', '87.0');
INSERT INTO `common_grade` VALUES ('489', '梁健港', 'PA机械类', 'HS机器人硬件维护操作考核', '马扬', '2019-09-11', '100.0');
INSERT INTO `common_grade` VALUES ('490', '梁乐保', 'PA机械类', 'AH机器人PA卡组件拆装', '马扬', '2019-08-28', '100.0');
INSERT INTO `common_grade` VALUES ('491', '梁乐保', 'PA机械类', 'AH机器人电机减速机组件拆装', '马扬', '2019-09-05', '100.0');
INSERT INTO `common_grade` VALUES ('492', '梁乐保', 'PA机械类', 'AH机器人三轴张紧机构拆装', '马扬', '2019-08-12', '100.0');
INSERT INTO `common_grade` VALUES ('493', '梁乐保', 'PA机械类', 'AH机器人丝杆组件拆装', '马扬', '2019-08-12', '92.0');
INSERT INTO `common_grade` VALUES ('502', '梁乐保', 'PA机械类', 'AP机器人电机减速机组件拆装', '马扬', '2019-09-04', '100.0');
INSERT INTO `common_grade` VALUES ('495', '梁乐保', 'PA机械类', 'AH机器人硬件维护操作', '马扬', '2019-08-12', '98.0');
INSERT INTO `common_grade` VALUES ('496', '梁乐保', 'PA机械类', 'AP机器人PA卡组件拆装', '马扬', '2019-08-27', '100.0');
INSERT INTO `common_grade` VALUES ('497', '梁乐保', 'PA机械类', 'AP机器人硬件维护操作', '马扬', '2019-08-27', '100.0');
INSERT INTO `common_grade` VALUES ('498', '梁乐保', 'PA机械类', 'HS机器人PA卡组件拆装', '马扬', '2019-09-04', '100.0');
INSERT INTO `common_grade` VALUES ('499', '梁乐保', 'PA机械类', 'HS机器人电机减速机组件拆装', '马扬', '2019-09-06', '97.0');
INSERT INTO `common_grade` VALUES ('500', '梁乐保', 'PA机械类', 'HS机器人丝杆组件拆装', '马扬', '2019-09-10', '100.0');
INSERT INTO `common_grade` VALUES ('501', '梁乐保', 'PA机械类', 'HS机器人硬件维护操作考核', '马扬', '2019-08-29', '100.0');
INSERT INTO `common_grade` VALUES ('503', '刘成成', 'PA机械类', 'AH机器人PA卡组件拆装', '马扬', '2020-01-10', '87.5');
INSERT INTO `common_grade` VALUES ('504', '刘成成', 'PA机械类', 'AH机器人电机减速机组件拆装', '马扬', '2020-01-10', '86.0');
INSERT INTO `common_grade` VALUES ('505', '刘成成', 'PA机械类', 'AH机器人三轴张紧机构拆装', '马扬', '2020-01-10', '90.0');
INSERT INTO `common_grade` VALUES ('506', '刘成成', 'PA机械类', 'AH机器人丝杆组件拆装', '马扬', '2020-01-10', '90.0');
INSERT INTO `common_grade` VALUES ('507', '刘成成', 'PA机械类', 'AH机器人硬件维护操作', '马扬', '2020-01-10', '90.0');
INSERT INTO `common_grade` VALUES ('508', '刘成成', 'PA机械类', 'AP机器人PA卡组件拆装', '马扬', '2020-01-09', '86.0');
INSERT INTO `common_grade` VALUES ('509', '刘成成', 'PA机械类', 'AP机器人电机减速机组件拆装', '马扬', '2020-01-09', '87.0');
INSERT INTO `common_grade` VALUES ('510', '刘成成', 'PA机械类', 'AP机器人硬件维护操作', '马扬', '2020-01-09', '91.0');
INSERT INTO `common_grade` VALUES ('511', '刘成成', 'PA机械类', 'HS机器人PA卡组件拆装', '马扬', '2020-01-08', '91.0');
INSERT INTO `common_grade` VALUES ('512', '刘成成', 'PA机械类', 'HS机器人电机减速机组件拆装', '马扬', '2020-01-08', '93.0');
INSERT INTO `common_grade` VALUES ('513', '刘成成', 'PA机械类', 'HS机器人丝杆组件拆装', '马扬', '2020-01-08', '90.0');
INSERT INTO `common_grade` VALUES ('514', '刘成成', 'PA机械类', 'HS机器人硬件维护操作考核', '马扬', '2020-01-08', '89.0');
INSERT INTO `common_grade` VALUES ('515', '罗喜', 'PA机械类', 'AH机器人PA卡组件拆装', '马扬', '2019-09-02', '95.0');
INSERT INTO `common_grade` VALUES ('516', '罗喜', 'PA机械类', 'AH机器人电机减速机组件拆装', '马扬', '2019-08-13', '98.0');
INSERT INTO `common_grade` VALUES ('517', '罗喜', 'PA机械类', 'AH机器人三轴张紧机构拆装', '马扬', '2019-08-09', '97.0');
INSERT INTO `common_grade` VALUES ('518', '罗喜', 'PA机械类', 'AH机器人丝杆组件拆装', '马扬', '2019-08-09', '94.0');
INSERT INTO `common_grade` VALUES ('519', '罗喜', 'PA机械类', 'AH机器人硬件维护操作', '马扬', '2019-08-09', '98.0');
INSERT INTO `common_grade` VALUES ('520', '罗喜', 'PA机械类', 'AP机器人PA卡组件拆装', '马扬', '2019-08-13', '91.0');
INSERT INTO `common_grade` VALUES ('521', '罗喜', 'PA机械类', 'AP机器人硬件维护操作', '马扬', '2019-09-02', '99.0');
INSERT INTO `common_grade` VALUES ('522', '罗喜', 'PA机械类', 'AP机器人硬件维护操作', '马扬', '2019-08-09', '98.0');
INSERT INTO `common_grade` VALUES ('523', '罗喜', 'PA机械类', 'HS机器人PA卡组件拆装', '马扬', '2019-09-02', '100.0');
INSERT INTO `common_grade` VALUES ('524', '罗喜', 'PA机械类', 'HS机器人电机减速机组件拆装', '马扬', '2019-09-03', '98.0');
INSERT INTO `common_grade` VALUES ('525', '罗喜', 'PA机械类', 'HS机器人丝杆组件拆装', '马扬', '2019-09-05', '94.0');
INSERT INTO `common_grade` VALUES ('526', '罗喜', 'PA机械类', 'HS机器人硬件维护操作考核', '马扬', '2019-08-09', '100.0');
INSERT INTO `common_grade` VALUES ('527', '莫浪', 'PA机械类', 'AH机器人PA卡组件拆装', '马扬', '2019-09-17', '81.0');
INSERT INTO `common_grade` VALUES ('528', '莫浪', 'PA机械类', 'AH机器人电机减速机组件拆装', '马扬', '2019-09-19', '98.0');
INSERT INTO `common_grade` VALUES ('529', '莫浪', 'PA机械类', 'AH机器人三轴张紧机构拆装', '马扬', '2019-09-19', '100.0');
INSERT INTO `common_grade` VALUES ('530', '莫浪', 'PA机械类', 'AH机器人丝杆组件拆装', '马扬', '2019-09-19', '98.0');
INSERT INTO `common_grade` VALUES ('531', '莫浪', 'PA机械类', 'AH机器人硬件维护操作', '马扬', '2019-09-18', '100.0');
INSERT INTO `common_grade` VALUES ('532', '莫浪', 'PA机械类', 'AP机器人PA卡组件拆装', '马扬', '2019-09-17', '70.0');
INSERT INTO `common_grade` VALUES ('533', '莫浪', 'PA机械类', 'AP机器人电机减速机组件拆装', '马扬', '2019-09-16', '91.0');
INSERT INTO `common_grade` VALUES ('534', '莫浪', 'PA机械类', 'AP机器人硬件维护操作', '马扬', '2019-09-17', '93.0');
INSERT INTO `common_grade` VALUES ('535', '莫浪', 'PA机械类', 'HS机器人PA卡组件拆装', '马扬', '2019-08-28', '94.0');
INSERT INTO `common_grade` VALUES ('536', '莫浪', 'PA机械类', 'HS机器人电机减速机组件拆装', '马扬', '2019-09-20', '98.0');
INSERT INTO `common_grade` VALUES ('537', '莫浪', 'PA机械类', 'HS机器人丝杆组件拆装', '马扬', '2019-09-20', '97.0');
INSERT INTO `common_grade` VALUES ('538', '莫浪', 'PA机械类', 'HS机器人硬件维护操作考核', '马扬', '2019-09-18', '100.0');
INSERT INTO `common_grade` VALUES ('539', '屈民坚', 'PA机械类', 'AH机器人PA卡组件拆装', '马扬', '2019-09-04', '82.5');
INSERT INTO `common_grade` VALUES ('540', '屈民坚', 'PA机械类', 'AH机器人PA卡组件拆装', '马扬', '2019-09-10', '92.0');
INSERT INTO `common_grade` VALUES ('541', '屈民坚', 'PA机械类', 'AH机器人电机减速机组件拆装', '马扬', '2019-09-18', '97.0');
INSERT INTO `common_grade` VALUES ('543', '屈民坚', 'PA机械类', 'AH机器人丝杆组件拆装', '马扬', '2019-09-05', '73.0');
INSERT INTO `common_grade` VALUES ('544', '屈民坚', 'PA机械类', 'AH机器人硬件维护操作', '马扬', '2019-08-29', '100.0');
INSERT INTO `common_grade` VALUES ('545', '屈民坚', 'PA机械类', 'AP机器人PA卡组件拆装', '马扬', '2019-09-03', '96.0');
INSERT INTO `common_grade` VALUES ('546', '屈民坚', 'PA机械类', 'AP机器人电机减速机组件拆装', '马扬', '2019-09-04', '78.0');
INSERT INTO `common_grade` VALUES ('547', '屈民坚', 'PA机械类', 'AP机器人硬件维护操作', '马扬', '2019-09-03', '98.0');
INSERT INTO `common_grade` VALUES ('548', '屈民坚', 'PA机械类', 'HS机器人PA卡组件拆装', '马扬', '2019-08-28', '91.0');
INSERT INTO `common_grade` VALUES ('549', '屈民坚', 'PA机械类', 'HS机器人电机减速机组件拆装', '马扬', '2019-09-19', '69.0');
INSERT INTO `common_grade` VALUES ('550', '屈民坚', 'PA机械类', 'HS机器人丝杆组件拆装', '马扬', '2019-09-19', '77.0');
INSERT INTO `common_grade` VALUES ('556', '张孟良', 'PA机械类', 'AH机器人电机减速机组件拆装', '马扬', '2019-08-28', '100.0');
INSERT INTO `common_grade` VALUES ('555', '张孟良', 'PA机械类', 'AH机器人PA卡组件拆装', '马扬', '2019-08-28', '97.5');
INSERT INTO `common_grade` VALUES ('553', '屈民坚', 'PA机械类', 'AH机器人三轴张紧机构拆装', '马扬', '2019-09-03', '97.0');
INSERT INTO `common_grade` VALUES ('554', '屈民坚', 'PA机械类', 'HS机器人硬件维护操作考核', '马扬', '2019-08-29', '100.0');
INSERT INTO `common_grade` VALUES ('557', '张孟良', 'PA机械类', 'AH机器人三轴张紧机构拆装', '马扬', '2019-08-29', '100.0');
INSERT INTO `common_grade` VALUES ('558', '张孟良', 'PA机械类', 'AH机器人丝杆组件拆装', '马扬', '2019-08-30', '90.0');
INSERT INTO `common_grade` VALUES ('559', '张孟良', 'PA机械类', 'AH机器人硬件维护操作', '马扬', '2019-08-30', '100.0');
INSERT INTO `common_grade` VALUES ('560', '张孟良', 'PA机械类', 'AP机器人PA卡组件拆装', '马扬', '2019-08-30', '92.0');
INSERT INTO `common_grade` VALUES ('561', '张孟良', 'PA机械类', 'AP机器人电机减速机组件拆装', '马扬', '2019-08-30', '100.0');
INSERT INTO `common_grade` VALUES ('562', '张孟良', 'PA机械类', 'AP机器人硬件维护操作', '马扬', '2019-09-03', '99.0');
INSERT INTO `common_grade` VALUES ('563', '张孟良', 'PA机械类', 'HS机器人PA卡组件拆装', '马扬', '2019-09-03', '90.0');
INSERT INTO `common_grade` VALUES ('564', '张孟良', 'PA机械类', 'HS机器人电机减速机组件拆装', '马扬', '2019-09-04', '92.0');
INSERT INTO `common_grade` VALUES ('565', '张孟良', 'PA机械类', 'HS机器人丝杆组件拆装', '马扬', '2019-09-04', '89.0');
INSERT INTO `common_grade` VALUES ('566', '张孟良', 'PA机械类', 'HS机器人硬件维护操作考核', '马扬', '2019-09-09', '100.0');
INSERT INTO `common_grade` VALUES ('567', '赵天朋', 'PA机械类', 'AH机器人PA卡组件拆装', '马扬', '2019-09-06', '100.0');
INSERT INTO `common_grade` VALUES ('568', '赵天朋', 'PA机械类', 'AH机器人电机减速机组件拆装', '马扬', '2019-09-05', '100.0');
INSERT INTO `common_grade` VALUES ('569', '赵天朋', 'PA机械类', 'AH机器人三轴张紧机构拆装', '马扬', '2019-07-03', '99.0');
INSERT INTO `common_grade` VALUES ('570', '赵天朋', 'PA机械类', 'AH机器人丝杆组件拆装', '马扬', '2019-08-28', '100.0');
INSERT INTO `common_grade` VALUES ('571', '赵天朋', 'PA机械类', 'AH机器人硬件维护操作', '马扬', '2019-07-02', '100.0');
INSERT INTO `common_grade` VALUES ('572', '赵天朋', 'PA机械类', 'AP机器人PA卡组件拆装', '马扬', '2019-08-12', '100.0');
INSERT INTO `common_grade` VALUES ('573', '赵天朋', 'PA机械类', 'AP机器人电机减速机组件拆装', '马扬', '2019-08-13', '99.0');
INSERT INTO `common_grade` VALUES ('574', '赵天朋', 'PA机械类', 'AP机器人硬件维护操作', '马扬', '2019-08-12', '100.0');
INSERT INTO `common_grade` VALUES ('575', '赵天朋', 'PA机械类', 'HS机器人PA卡组件拆装', '马扬', '2019-08-27', '99.0');
INSERT INTO `common_grade` VALUES ('576', '赵天朋', 'PA机械类', 'HS机器人电机减速机组件拆装', '马扬', '2019-08-27', '97.0');
INSERT INTO `common_grade` VALUES ('577', '赵天朋', 'PA机械类', 'HS机器人丝杆组件拆装', '马扬', '2019-08-27', '100.0');
INSERT INTO `common_grade` VALUES ('578', '赵天朋', 'PA机械类', 'HS机器人硬件维护操作考核', '马扬', '2019-08-13', '96.0');
INSERT INTO `common_grade` VALUES ('579', '周康', 'PA机械类', 'AH机器人PA卡组件拆装', '马扬', '2019-08-29', '91.0');
INSERT INTO `common_grade` VALUES ('580', '周康', 'PA机械类', 'AH机器人电机减速机组件拆装', '马扬', '2019-09-03', '99.0');
INSERT INTO `common_grade` VALUES ('581', '周康', 'PA机械类', 'AH机器人丝杆组件拆装', '马扬', '2019-08-30', '98.0');
INSERT INTO `common_grade` VALUES ('582', '周康', 'PA机械类', 'AH机器人硬件维护操作', '马扬', '2019-09-02', '92.0');
INSERT INTO `common_grade` VALUES ('583', '姜展', 'PA软件类', 'PV视觉应用开发', '马扬', '2019-12-26', '90.0');

-- ----------------------------
-- Table structure for permission_msg
-- ----------------------------
DROP TABLE IF EXISTS `permission_msg`;
CREATE TABLE `permission_msg` (
  `permission_id` int(11) NOT NULL,
  `permission` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of permission_msg
-- ----------------------------
INSERT INTO `permission_msg` VALUES ('1', '权限设置');
INSERT INTO `permission_msg` VALUES ('2', '操作功能');
INSERT INTO `permission_msg` VALUES ('3', '扩展功能');

-- ----------------------------
-- Table structure for personal_msg
-- ----------------------------
DROP TABLE IF EXISTS `personal_msg`;
CREATE TABLE `personal_msg` (
  `Name_Index` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(10) DEFAULT NULL,
  `Job_Num` int(3) DEFAULT NULL,
  `Tittle` varchar(10) DEFAULT NULL,
  `department` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`Name_Index`)
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of personal_msg
-- ----------------------------
INSERT INTO `personal_msg` VALUES ('50', '范国华', '488', '技术支持工程师', '技术支持部');
INSERT INTO `personal_msg` VALUES ('51', '黄敬业', '405', '技术支持工程师', '技术支持部');
INSERT INTO `personal_msg` VALUES ('49', '曾双雄', '446', '技术支持工程师', '技术支持部');
INSERT INTO `personal_msg` VALUES ('48', '陈诗雨', '183', '技术支持综合管理中心', '技术支持部');
INSERT INTO `personal_msg` VALUES ('47', '张孟良', '459', '技术支持工程师', '技术支持部');
INSERT INTO `personal_msg` VALUES ('46', '谈沛', '207', '技术支持副总监', '技术支持部');
INSERT INTO `personal_msg` VALUES ('45', '付传波', '298', '技术支持工程师', '技术支持部');
INSERT INTO `personal_msg` VALUES ('44', '赵天朋', '127', '技术支持售后组组长', '技术支持部');
INSERT INTO `personal_msg` VALUES ('43', '姜展', '407', '技术支持工程师', '技术支持部');
INSERT INTO `personal_msg` VALUES ('42', '马扬', '242', '技术支持工程师', '技术支持部');
INSERT INTO `personal_msg` VALUES ('41', '李嘉星', '239', '技术支持项目一组组长', '技术支持部');
INSERT INTO `personal_msg` VALUES ('38', '王红', '16', '技术支持总监', '技术支持部');
INSERT INTO `personal_msg` VALUES ('39', '冷雄伟', '598', '技术支持项目二组组长', '技术支持部');
INSERT INTO `personal_msg` VALUES ('40', '罗喜', '382', '技术支持工程师', '技术支持部');
INSERT INTO `personal_msg` VALUES ('52', '屈民坚', '475', '技术支持工程师', '技术支持部');
INSERT INTO `personal_msg` VALUES ('53', '梁健港', '511', '技术支持工程师', '技术支持部');
INSERT INTO `personal_msg` VALUES ('54', '郭志坚', '257', '技术支持工程师', '技术支持部');
INSERT INTO `personal_msg` VALUES ('55', '刘淑君', '164', '技术支持助理', '技术支持部');
INSERT INTO `personal_msg` VALUES ('56', '梁乐保', '80', '技术支持项目三组组长', '技术支持部');
INSERT INTO `personal_msg` VALUES ('57', '钟智财', '373', '技术支持工程师', '技术支持部');
INSERT INTO `personal_msg` VALUES ('58', '郭钊宏', '402', '技术支持工程师', '技术支持部');
INSERT INTO `personal_msg` VALUES ('59', '莫浪', '306', '技术支持工程师', '技术支持部');
INSERT INTO `personal_msg` VALUES ('60', '周康', '689', '技术支持工程师', '技术支持部');
INSERT INTO `personal_msg` VALUES ('61', '柯伟', '714', '技术支持工程师', '技术支持部');
INSERT INTO `personal_msg` VALUES ('62', '李叶波', '772', '技术支持工程师', '技术支持部');
INSERT INTO `personal_msg` VALUES ('63', '何德雄', '301', '华东技术支持组长', '技术支持部');
INSERT INTO `personal_msg` VALUES ('64', '刘成成', '784', '技术支持工程师', '技术支持部');
INSERT INTO `personal_msg` VALUES ('65', '张列洲', '351', '技术支持工程师', '技术支持部');
INSERT INTO `personal_msg` VALUES ('66', '肖志兵', '186', '长沙技术支持组长', '技术支持部');
INSERT INTO `personal_msg` VALUES ('67', '张顺', '302', '技术支持工程师', '技术支持部');
INSERT INTO `personal_msg` VALUES ('68', '屈志强', '424', '技术支持工程师', '技术支持部');
INSERT INTO `personal_msg` VALUES ('69', '陈嘉宁', '821', '技术支持工程师', '技术支持部');
INSERT INTO `personal_msg` VALUES ('70', '黎租貌', '611', '技术支持工程师', '技术支持部');
INSERT INTO `personal_msg` VALUES ('71', '陈润华', '739', '技术支持工程师', '技术支持部');
INSERT INTO `personal_msg` VALUES ('72', '王瑞现', '829', '技术支持工程师', '技术支持部');
INSERT INTO `personal_msg` VALUES ('73', '于焕凡', '726', '技术支持实习生', '技术支持部');
INSERT INTO `personal_msg` VALUES ('74', '唐方铭', '725', '技术支持实习生', '技术支持部');
INSERT INTO `personal_msg` VALUES ('75', '何邦亮', '831', '技术支持实习生', '技术支持部');
INSERT INTO `personal_msg` VALUES ('76', '胡豪', '830', '技术支持实习生', '技术支持部');

-- ----------------------------
-- Table structure for role_msg
-- ----------------------------
DROP TABLE IF EXISTS `role_msg`;
CREATE TABLE `role_msg` (
  `role_id` int(11) NOT NULL,
  `role` varchar(15) NOT NULL,
  `permission` varchar(15) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of role_msg
-- ----------------------------
INSERT INTO `role_msg` VALUES ('1', '超级管理员', '1,2,3');
INSERT INTO `role_msg` VALUES ('2', '管理员', '2');
INSERT INTO `role_msg` VALUES ('3', '操作员', '3');

-- ----------------------------
-- Table structure for tb_login
-- ----------------------------
DROP TABLE IF EXISTS `tb_login`;
CREATE TABLE `tb_login` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `role_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of tb_login
-- ----------------------------
INSERT INTO `tb_login` VALUES ('1', 'qkm', 'abc', '2020-07-29 15:26:37', '1');
INSERT INTO `tb_login` VALUES ('15', 'ghfan', '1234', '2020-08-13 09:50:41', '3');
INSERT INTO `tb_login` VALUES ('5', 'yma', 'abc.123', '2020-08-25 15:26:52', '2');
INSERT INTO `tb_login` VALUES ('10', 'hu', '123', '2020-08-12 15:08:23', '3');
INSERT INTO `tb_login` VALUES ('13', '0164', 'lsj0321007..', '2020-08-12 15:14:17', '2');
INSERT INTO `tb_login` VALUES ('16', '0016', '1234', '2020-08-20 17:27:42', '3');
INSERT INTO `tb_login` VALUES ('17', 'molang', 'molang', '2020-08-26 13:35:17', '3');
INSERT INTO `tb_login` VALUES ('18', '0488', 'abc.123', '2020-08-27 10:56:09', '3');

-- ----------------------------
-- Table structure for upload_log
-- ----------------------------
DROP TABLE IF EXISTS `upload_log`;
CREATE TABLE `upload_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `upload_date` datetime DEFAULT NULL,
  `uploader` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of upload_log
-- ----------------------------
INSERT INTO `upload_log` VALUES ('1', '2020-08-17 09:10:57', '马扬');
INSERT INTO `upload_log` VALUES ('2', '2020-08-18 09:16:49', 'qkm');
INSERT INTO `upload_log` VALUES ('3', '2020-08-18 11:15:37', 'qkm');
INSERT INTO `upload_log` VALUES ('4', '2020-08-18 11:18:40', 'qkm');
