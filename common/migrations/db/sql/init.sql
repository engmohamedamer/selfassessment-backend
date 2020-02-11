/*
Navicat MySQL Data Transfer

Source Server         : Tamkeen_live
Source Server Version : 80019
Source Host           : ----------
Source Database       : tamkeen_selfassessment

Target Server Type    : MYSQL
Target Server Version : 80019
File Encoding         : 65001

Date: 2020-02-05 11:18:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `city`
-- ----------------------------
DROP TABLE IF EXISTS `city`;
CREATE TABLE `city` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ref` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `sort` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of city
-- ----------------------------
INSERT INTO `city` VALUES ('3', 'إدارة التعليم بمحافظة الافلاج', ' الافلاج', null, null);
INSERT INTO `city` VALUES ('4', 'إدارة التعليم بمحافظة البكيرية', ' البكيرية', null, null);
INSERT INTO `city` VALUES ('5', 'إدارة التعليم بمحافظة الخرج', ' الخرج', null, null);
INSERT INTO `city` VALUES ('6', 'إدارة التعليم بمحافظة الدوادمي', ' الدوادمي', null, null);
INSERT INTO `city` VALUES ('7', 'إدارة التعليم بمحافظة الرس', ' الرس', null, null);
INSERT INTO `city` VALUES ('8', 'إدارة التعليم بمحافظة الزلفي', ' الزلفي', null, null);
INSERT INTO `city` VALUES ('9', 'إدارة التعليم بمحافظة العلا', ' العلا', null, null);
INSERT INTO `city` VALUES ('10', 'إدارة التعليم بمحافظة الـغاط', ' الـغاط', null, null);
INSERT INTO `city` VALUES ('11', 'إدارة التعليم بمحافظة القريات', ' القريات', null, null);
INSERT INTO `city` VALUES ('12', 'إدارة التعليم بمحافظة القنفذة', ' القنفذة', null, null);
INSERT INTO `city` VALUES ('13', 'إدارة التعليم بمحافظة القويعية', ' القويعية', null, null);
INSERT INTO `city` VALUES ('14', 'إدارة التعليم بمحافظة الليث', ' الليث', null, null);
INSERT INTO `city` VALUES ('15', 'إدارة التعليم بمحافظة المجمعة', ' المجمعة', null, null);
INSERT INTO `city` VALUES ('16', 'إدارة التعليم بمحافظة المخواة', ' المخواة', null, null);
INSERT INTO `city` VALUES ('17', 'إدارة التعليم بمحافظة المذنب', ' المذنب', null, null);
INSERT INTO `city` VALUES ('18', 'إدارة التعليم بمحافظة بيشة', ' بيشة', null, null);
INSERT INTO `city` VALUES ('19', 'إدارة التعليم بمحافظة حفر الباطن', ' حفر الباطن', null, null);
INSERT INTO `city` VALUES ('20', 'إدارة التعليم بمحافظة شقراء', ' شقراء', null, null);
INSERT INTO `city` VALUES ('21', 'إدارة التعليم بمحافظة صبيا', ' صبيا', null, null);
INSERT INTO `city` VALUES ('22', 'إدارة التعليم بمحافظة عفيف', ' عفيف', null, null);
INSERT INTO `city` VALUES ('23', 'إدارة التعليم بمحافظة عنيزة', ' عنيزة', null, null);
INSERT INTO `city` VALUES ('24', 'إدارة التعليم بمحافظة وادي الدواسر', ' وادي الدواسر', null, null);
INSERT INTO `city` VALUES ('25', 'إدارة التعليم بمحافظة ينبع', ' ينبع', null, null);
INSERT INTO `city` VALUES ('26', 'إدارة التعليم بمحافظتي حوطة بني تميم والحريق', ' حوطة بني تميم والحريق', null, null);
INSERT INTO `city` VALUES ('27', 'الإدارة العامة للتعليم بالمنطقة الشرقية', ' المنطقة الشرقية', null, null);
INSERT INTO `city` VALUES ('28', 'الإدارة العامة للتعليم بمحافظة الاحساء', ' الاحساء', null, null);
INSERT INTO `city` VALUES ('29', 'الإدارة العامة للتعليم بمحافظة الطائف', ' الطائف', null, null);
INSERT INTO `city` VALUES ('30', 'الإدارة العامة للتعليم بمحافظة جدة', ' جدة', null, null);
INSERT INTO `city` VALUES ('31', 'الإدارة العامة للتعليم بمحافظة محايل عسير', ' محايل عسير', null, null);
INSERT INTO `city` VALUES ('32', 'الإدارة العامة للتعليم بمنطقة الباحة', ' الباحة', null, null);
INSERT INTO `city` VALUES ('33', 'الإدارة العامة للتعليم بمنطقة الجوف', ' الجوف', null, null);
INSERT INTO `city` VALUES ('34', 'الإدارة العامة للتعليم بمنطقة الحدود الشمالية', ' الحدود الشمالية', null, null);
INSERT INTO `city` VALUES ('35', 'الإدارة العامة للتعليم بمنطقة الرياض', ' الرياض', null, '1');
INSERT INTO `city` VALUES ('36', 'الإدارة العامة للتعليم بمنطقة القصيم', ' القصيم', null, null);
INSERT INTO `city` VALUES ('37', 'الإدارة العامة للتعليم بمنطقة المدينة المنورة', ' المدينة المنورة', null, null);
INSERT INTO `city` VALUES ('38', 'الإدارة العامة للتعليم بمنطقة تبوك', ' تبوك', null, null);
INSERT INTO `city` VALUES ('39', 'الإدارة العامة للتعليم بمنطقة جازان', ' جازان', null, null);
INSERT INTO `city` VALUES ('40', 'الإدارة العامة للتعليم بمنطقة حائل', ' حائل', null, null);
INSERT INTO `city` VALUES ('41', 'الإدارة العامة للتعليم بمنطقة عسير', ' عسير', null, null);
INSERT INTO `city` VALUES ('42', 'الإدارة العامة للتعليم بمنطقة مكة المكرمة', ' مكة المكرمة', null, null);
INSERT INTO `city` VALUES ('43', 'الإدارة العامة للتعليم بمنطقة نجران', ' نجران', null, null);

-- ----------------------------
-- Table structure for `corrective_action_report`
-- ----------------------------
DROP TABLE IF EXISTS `corrective_action_report`;
CREATE TABLE `corrective_action_report` (
  `id` int NOT NULL AUTO_INCREMENT,
  `org_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `survey_id` int unsigned DEFAULT NULL,
  `question_id` int unsigned DEFAULT NULL,
  `answer_id` bigint unsigned DEFAULT NULL,
  `corrective_action` varchar(255) DEFAULT NULL,
  `corrective_action_date` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `comment` text,
  PRIMARY KEY (`id`),
  KEY `fk_org_id_idx` (`org_id`),
  KEY `fk_user_idx` (`user_id`),
  KEY `ffsurvey_id_idx` (`survey_id`),
  KEY `fk_question_idx` (`question_id`),
  KEY `fk_answer_idx` (`answer_id`),
  CONSTRAINT `corrective_action_report_ibfk_1` FOREIGN KEY (`answer_id`) REFERENCES `survey_answer` (`survey_answer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `corrective_action_report_ibfk_2` FOREIGN KEY (`org_id`) REFERENCES `organization` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `corrective_action_report_ibfk_3` FOREIGN KEY (`question_id`) REFERENCES `survey_question` (`survey_question_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `corrective_action_report_ibfk_4` FOREIGN KEY (`survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `corrective_action_report_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of corrective_action_report
-- ----------------------------

-- ----------------------------
-- Table structure for `district`
-- ----------------------------
DROP TABLE IF EXISTS `district`;
CREATE TABLE `district` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `city_id` int unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`),
  CONSTRAINT `district_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of district
-- ----------------------------
INSERT INTO `district` VALUES ('6', '35', 'اسكان البحرية', null);
INSERT INTO `district` VALUES ('7', '35', 'اسكان طريق الخرج', null);
INSERT INTO `district` VALUES ('8', '35', 'اشبيليا', null);
INSERT INTO `district` VALUES ('9', '35', 'الأندلس', null);
INSERT INTO `district` VALUES ('10', '35', 'الازدهار', null);
INSERT INTO `district` VALUES ('11', '35', 'الامانة', null);
INSERT INTO `district` VALUES ('12', '35', 'البديعة', null);
INSERT INTO `district` VALUES ('13', '35', 'التخصصي', null);
INSERT INTO `district` VALUES ('14', '35', 'التعاون', null);
INSERT INTO `district` VALUES ('15', '35', 'الحزم', null);
INSERT INTO `district` VALUES ('16', '35', 'الحمراء', null);
INSERT INTO `district` VALUES ('17', '35', 'الخالدية', null);
INSERT INTO `district` VALUES ('18', '35', 'الخزامى', null);
INSERT INTO `district` VALUES ('19', '35', 'الخليج', null);
INSERT INTO `district` VALUES ('20', '35', 'الدائد', null);
INSERT INTO `district` VALUES ('21', '35', 'الدار البيضاء', null);
INSERT INTO `district` VALUES ('22', '35', 'الرائد', null);
INSERT INTO `district` VALUES ('23', '35', 'الربوة', null);
INSERT INTO `district` VALUES ('24', '35', 'الربيع', null);
INSERT INTO `district` VALUES ('25', '35', 'الرحاب', null);
INSERT INTO `district` VALUES ('26', '35', 'الرحمانية', null);
INSERT INTO `district` VALUES ('27', '35', 'الرفيعة', null);
INSERT INTO `district` VALUES ('28', '35', 'الرمال', null);
INSERT INTO `district` VALUES ('29', '35', 'الروابي', null);
INSERT INTO `district` VALUES ('30', '35', 'الروضة', null);
INSERT INTO `district` VALUES ('31', '35', 'الريان', null);
INSERT INTO `district` VALUES ('32', '35', 'الزهراء', null);
INSERT INTO `district` VALUES ('33', '35', 'الزهرة', null);
INSERT INTO `district` VALUES ('34', '35', 'السعادة', null);
INSERT INTO `district` VALUES ('35', '35', 'السفارات', null);
INSERT INTO `district` VALUES ('36', '35', 'السلام', null);
INSERT INTO `district` VALUES ('37', '35', 'السلي', null);
INSERT INTO `district` VALUES ('38', '35', 'السليمانية', null);
INSERT INTO `district` VALUES ('39', '35', 'السويدي', null);
INSERT INTO `district` VALUES ('40', '35', 'السويدي الغربي', null);
INSERT INTO `district` VALUES ('41', '35', 'الشرفية', null);
INSERT INTO `district` VALUES ('42', '35', 'الشفا', null);
INSERT INTO `district` VALUES ('43', '35', 'الشهداء', null);
INSERT INTO `district` VALUES ('44', '35', 'الصحافة', null);
INSERT INTO `district` VALUES ('45', '35', 'الصقورية', null);
INSERT INTO `district` VALUES ('46', '35', 'الضباط', null);
INSERT INTO `district` VALUES ('47', '35', 'العارض', null);
INSERT INTO `district` VALUES ('48', '35', 'العريجا', null);
INSERT INTO `district` VALUES ('49', '35', 'العريجاء', null);
INSERT INTO `district` VALUES ('50', '35', 'العريجاء الغربي', null);
INSERT INTO `district` VALUES ('51', '35', 'العريجاء الوسطى', null);
INSERT INTO `district` VALUES ('52', '35', 'العزيزية', null);
INSERT INTO `district` VALUES ('53', '35', 'العقيق', null);
INSERT INTO `district` VALUES ('54', '35', 'العليا', null);
INSERT INTO `district` VALUES ('55', '35', 'الغدير', null);
INSERT INTO `district` VALUES ('56', '35', 'الفاخرية', null);
INSERT INTO `district` VALUES ('57', '35', 'الفلاح', null);
INSERT INTO `district` VALUES ('58', '35', 'الفوطة', null);
INSERT INTO `district` VALUES ('59', '35', 'الفيحاء', null);
INSERT INTO `district` VALUES ('60', '35', 'الفيصلية', null);
INSERT INTO `district` VALUES ('61', '35', 'القادسية', null);
INSERT INTO `district` VALUES ('62', '35', 'القدس', null);
INSERT INTO `district` VALUES ('63', '35', 'القيروان', null);
INSERT INTO `district` VALUES ('64', '35', 'المؤتمرات', null);
INSERT INTO `district` VALUES ('65', '35', 'المحمدية', null);
INSERT INTO `district` VALUES ('66', '35', 'المربع', null);
INSERT INTO `district` VALUES ('67', '35', 'المرسلات', null);
INSERT INTO `district` VALUES ('68', '35', 'المروة', null);
INSERT INTO `district` VALUES ('69', '35', 'المروج', null);
INSERT INTO `district` VALUES ('70', '35', 'المصيف', null);
INSERT INTO `district` VALUES ('71', '35', 'المعذر', null);
INSERT INTO `district` VALUES ('72', '35', 'المعذر الشمالي', null);
INSERT INTO `district` VALUES ('73', '35', 'المعذر الغربي', null);
INSERT INTO `district` VALUES ('74', '35', 'المعيزلية', null);
INSERT INTO `district` VALUES ('75', '35', 'المعيزيلة', null);
INSERT INTO `district` VALUES ('76', '35', 'المغرزات', null);
INSERT INTO `district` VALUES ('77', '35', 'الملز', null);
INSERT INTO `district` VALUES ('78', '35', 'الملقا', null);
INSERT INTO `district` VALUES ('79', '35', 'الملك عبدالله', null);
INSERT INTO `district` VALUES ('80', '35', 'الملك فهد', null);
INSERT INTO `district` VALUES ('81', '35', 'الملك فيصل', null);
INSERT INTO `district` VALUES ('82', '35', 'المنار', null);
INSERT INTO `district` VALUES ('83', '35', 'المنصورة', null);
INSERT INTO `district` VALUES ('84', '35', 'الموسى', null);
INSERT INTO `district` VALUES ('85', '35', 'المونسية', null);
INSERT INTO `district` VALUES ('86', '35', 'الناصرية', null);
INSERT INTO `district` VALUES ('87', '35', 'النخيل', null);
INSERT INTO `district` VALUES ('88', '35', 'النخيل الشرقي', null);
INSERT INTO `district` VALUES ('89', '35', 'النخيل الغربي', null);
INSERT INTO `district` VALUES ('90', '35', 'الندوة', null);
INSERT INTO `district` VALUES ('91', '35', 'الندى', null);
INSERT INTO `district` VALUES ('92', '35', 'النرجس', null);
INSERT INTO `district` VALUES ('93', '35', 'النزهة', null);
INSERT INTO `district` VALUES ('94', '35', 'النسيج', null);
INSERT INTO `district` VALUES ('95', '35', 'النسيم', null);
INSERT INTO `district` VALUES ('96', '35', 'النسيم الشرقي', null);
INSERT INTO `district` VALUES ('97', '35', 'النسيم الغربي', null);
INSERT INTO `district` VALUES ('98', '35', 'النظيم', null);
INSERT INTO `district` VALUES ('99', '35', 'النفل', null);
INSERT INTO `district` VALUES ('100', '35', 'النموذجية', null);
INSERT INTO `district` VALUES ('101', '35', 'النهضة', null);
INSERT INTO `district` VALUES ('102', '35', 'الهدا', null);
INSERT INTO `district` VALUES ('103', '35', 'الواحة', null);
INSERT INTO `district` VALUES ('104', '35', 'الوادي', null);
INSERT INTO `district` VALUES ('105', '35', 'الورود', null);
INSERT INTO `district` VALUES ('106', '35', 'الوشام', null);
INSERT INTO `district` VALUES ('107', '35', 'الياسمين', null);
INSERT INTO `district` VALUES ('108', '35', 'اليرموك', null);
INSERT INTO `district` VALUES ('109', '35', 'اليمامة', null);
INSERT INTO `district` VALUES ('110', '35', 'ام الحمام', null);
INSERT INTO `district` VALUES ('111', '35', 'ام الحمام الشرقي', null);
INSERT INTO `district` VALUES ('112', '35', 'ام الحمام الغربي', null);
INSERT INTO `district` VALUES ('113', '35', 'بدر', null);
INSERT INTO `district` VALUES ('114', '35', 'بني عامر', null);
INSERT INTO `district` VALUES ('115', '35', 'تلال الوصيل', null);
INSERT INTO `district` VALUES ('116', '35', 'جبرة', null);
INSERT INTO `district` VALUES ('117', '35', 'جرير', null);
INSERT INTO `district` VALUES ('118', '35', 'حضار', null);
INSERT INTO `district` VALUES ('119', '35', 'حطين', null);
INSERT INTO `district` VALUES ('120', '35', 'حي الربيع', null);
INSERT INTO `district` VALUES ('121', '35', 'حي شبر1', null);
INSERT INTO `district` VALUES ('122', '35', 'حي لبن', null);
INSERT INTO `district` VALUES ('123', '35', 'زهرة البديعة', null);
INSERT INTO `district` VALUES ('124', '35', 'سلطانة', null);
INSERT INTO `district` VALUES ('125', '35', 'شبرا', null);
INSERT INTO `district` VALUES ('126', '35', 'شرق اشبيلية', null);
INSERT INTO `district` VALUES ('127', '35', 'صلاح الدين', null);
INSERT INTO `district` VALUES ('128', '35', 'طويق', null);
INSERT INTO `district` VALUES ('129', '35', 'ظهرة البديعة', null);
INSERT INTO `district` VALUES ('130', '35', 'ظهرة لبن', null);
INSERT INTO `district` VALUES ('131', '35', 'عتيقة', null);
INSERT INTO `district` VALUES ('132', '35', 'عرقة', null);
INSERT INTO `district` VALUES ('133', '35', 'عليشة', null);
INSERT INTO `district` VALUES ('134', '35', 'غرناطة', null);
INSERT INTO `district` VALUES ('135', '35', 'قرطبة', null);
INSERT INTO `district` VALUES ('136', '35', 'كلية العلوم والدراسات الانسانية برماح', null);
INSERT INTO `district` VALUES ('137', '35', 'لبن', null);
INSERT INTO `district` VALUES ('138', '35', 'مجمع تلال الوصيل', null);
INSERT INTO `district` VALUES ('139', '35', 'مخطط 46', null);
INSERT INTO `district` VALUES ('140', '35', 'مخطط 51', null);
INSERT INTO `district` VALUES ('141', '35', 'منفوحة', null);
INSERT INTO `district` VALUES ('142', '35', 'نمار', null);

-- ----------------------------
-- Table structure for `file_storage_item`
-- ----------------------------
DROP TABLE IF EXISTS `file_storage_item`;
CREATE TABLE `file_storage_item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `component` varchar(255) NOT NULL,
  `base_url` varchar(1024) NOT NULL,
  `path` varchar(1024) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `size` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `upload_ip` varchar(15) DEFAULT NULL,
  `created_at` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of file_storage_item
-- ----------------------------

-- ----------------------------
-- Table structure for `footer_links`
-- ----------------------------
DROP TABLE IF EXISTS `footer_links`;
CREATE TABLE `footer_links` (
  `id` int NOT NULL AUTO_INCREMENT,
  `organization_id` int DEFAULT NULL,
  `name_link1` varchar(150) DEFAULT NULL,
  `link1` varchar(150) DEFAULT NULL,
  `name_link2` varchar(150) DEFAULT NULL,
  `link2` varchar(150) DEFAULT NULL,
  `name_link3` varchar(150) DEFAULT NULL,
  `link3` varchar(150) DEFAULT NULL,
  `name_link4` varchar(150) DEFAULT NULL,
  `link4` varchar(150) DEFAULT NULL,
  `name_link5` varchar(150) DEFAULT NULL,
  `link5` varchar(150) DEFAULT NULL,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `organization_id` (`organization_id`),
  CONSTRAINT `footer_links_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of footer_links
-- ----------------------------

-- ----------------------------
-- Table structure for `key_storage_item`
-- ----------------------------
DROP TABLE IF EXISTS `key_storage_item`;
CREATE TABLE `key_storage_item` (
  `key` varchar(128) NOT NULL,
  `value` text NOT NULL,
  `comment` text,
  `updated_at` int DEFAULT NULL,
  `created_at` int DEFAULT NULL,
  PRIMARY KEY (`key`),
  UNIQUE KEY `idx_key_storage_item_key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of key_storage_item
-- ----------------------------
INSERT INTO `key_storage_item` VALUES ('backend.layout-boxed', '0', null, null, null);
INSERT INTO `key_storage_item` VALUES ('backend.layout-collapsed-sidebar', '0', null, null, null);
INSERT INTO `key_storage_item` VALUES ('backend.layout-fixed', '0', null, null, null);
INSERT INTO `key_storage_item` VALUES ('backend.theme-skin', 'skin-blue', 'skin-blue, skin-black, skin-purple, skin-green, skin-red, skin-yellow', null, null);
INSERT INTO `key_storage_item` VALUES ('frontend.maintenance', 'disabled', 'Set it to \"enabled\" to turn on maintenance mode', null, null);

-- ----------------------------
-- Table structure for `media`
-- ----------------------------
DROP TABLE IF EXISTS `media`;
CREATE TABLE `media` (
  `id` int NOT NULL AUTO_INCREMENT,
  `path` varchar(255) NOT NULL,
  `base_url` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `size` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `order` int DEFAULT NULL,
  `meta` varchar(255) DEFAULT NULL,
  `deleted_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of media
-- ----------------------------

-- ----------------------------
-- Table structure for `notification`
-- ----------------------------
DROP TABLE IF EXISTS `notification`;
CREATE TABLE `notification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `from` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `module` varchar(255) DEFAULT NULL,
  `module_id` int DEFAULT NULL,
  `message` varchar(500) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` tinyint DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fromField` (`from`),
  KEY `UserField` (`user_id`),
  CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of notification
-- ----------------------------

-- ----------------------------
-- Table structure for `organization`
-- ----------------------------
DROP TABLE IF EXISTS `organization`;
CREATE TABLE `organization` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `slug` varchar(150) NOT NULL,
  `business_sector` varchar(100) DEFAULT NULL,
  `about` text,
  `address` varchar(255) DEFAULT NULL,
  `city_id` int unsigned DEFAULT NULL,
  `district_id` int unsigned DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `conatct_name` varchar(100) DEFAULT NULL,
  `contact_email` varchar(100) DEFAULT NULL,
  `contact_phone` varchar(20) DEFAULT NULL,
  `contact_position` varchar(100) DEFAULT NULL,
  `limit_account` int DEFAULT NULL,
  `first_image_base_url` varchar(1024) DEFAULT NULL,
  `first_image_path` varchar(1024) DEFAULT NULL,
  `second_image_base_url` varchar(1024) DEFAULT NULL,
  `second_image_path` varchar(1024) DEFAULT NULL,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  `status` smallint NOT NULL DEFAULT '1',
  `allow_registration` tinyint(1) DEFAULT '0',
  `postalbox` varchar(15) DEFAULT NULL,
  `postalcode` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`),
  KEY `district_id` (`district_id`),
  CONSTRAINT `organization_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `organization_ibfk_2` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of organization
-- ----------------------------

-- ----------------------------
-- Table structure for `organization_structure`
-- ----------------------------
DROP TABLE IF EXISTS `organization_structure`;
CREATE TABLE `organization_structure` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique tree node identifier',
  `root` int DEFAULT NULL COMMENT 'Tree root identifier',
  `lft` int NOT NULL COMMENT 'Nested set left property',
  `rgt` int NOT NULL COMMENT 'Nested set right property',
  `lvl` smallint NOT NULL COMMENT 'Nested set level / depth',
  `name` varchar(60) NOT NULL COMMENT 'The tree node name / label',
  `icon` varchar(255) DEFAULT NULL COMMENT 'The icon to use for the node',
  `icon_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Icon Type: 1 = CSS Class, 2 = Raw Markup',
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is active (will be set to false on deletion)',
  `selected` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is selected/checked by default',
  `disabled` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is enabled',
  `readonly` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is read only (unlike disabled - will allow toolbar actions)',
  `visible` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is visible',
  `collapsed` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is collapsed by default',
  `movable_u` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is movable one position up',
  `movable_d` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is movable one position down',
  `movable_l` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is movable to the left (from sibling to parent)',
  `movable_r` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is movable to the right (from sibling to child)',
  `removable` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is removable (any children below will be moved as siblings before deletion)',
  `removable_all` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is removable along with descendants',
  `child_allowed` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether to allow adding children to the node',
  `organization_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_tree_NK1` (`root`) USING BTREE,
  KEY `tbl_tree_NK2` (`lft`) USING BTREE,
  KEY `tbl_tree_NK3` (`rgt`) USING BTREE,
  KEY `tbl_tree_NK4` (`lvl`) USING BTREE,
  KEY `tbl_tree_NK5` (`active`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of organization_structure
-- ----------------------------

-- ----------------------------
-- Table structure for `organization_theme`
-- ----------------------------
DROP TABLE IF EXISTS `organization_theme`;
CREATE TABLE `organization_theme` (
  `organization_id` int NOT NULL,
  `brandPrimColor` varchar(255) DEFAULT '',
  `brandSecColor` varchar(255) DEFAULT NULL,
  `brandHTextColor` varchar(255) DEFAULT NULL,
  `brandPTextColor` varchar(255) DEFAULT NULL,
  `brandBlackColor` varchar(255) DEFAULT NULL,
  `brandGrayColor` varchar(255) DEFAULT NULL,
  `arfont` varchar(255) DEFAULT NULL,
  `enfont` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `locale` varchar(255) NOT NULL DEFAULT 'ar_AR',
  `updated_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`organization_id`),
  CONSTRAINT `organization_theme_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of organization_theme
-- ----------------------------

-- ----------------------------
-- Table structure for `pages`
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `organization_id` int NOT NULL,
  `name` varchar(150) NOT NULL,
  `link` varchar(150) NOT NULL,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `organization_id` (`organization_id`),
  CONSTRAINT `pages_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pages
-- ----------------------------

-- ----------------------------
-- Table structure for `rbac_auth_assignment`
-- ----------------------------
DROP TABLE IF EXISTS `rbac_auth_assignment`;
CREATE TABLE `rbac_auth_assignment` (
  `item_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `rbac_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of rbac_auth_assignment
-- ----------------------------
INSERT INTO `rbac_auth_assignment` VALUES ('administrator', '1', '1552385505');
INSERT INTO `rbac_auth_assignment` VALUES ('administrator', '4', '1552385505');
INSERT INTO `rbac_auth_assignment` VALUES ('manager', '2', '1580369390');
INSERT INTO `rbac_auth_assignment` VALUES ('user', '3', '1552385505');

-- ----------------------------
-- Table structure for `rbac_auth_item`
-- ----------------------------
DROP TABLE IF EXISTS `rbac_auth_item`;
CREATE TABLE `rbac_auth_item` (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `rbac_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `rbac_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of rbac_auth_item
-- ----------------------------
INSERT INTO `rbac_auth_item` VALUES ('administrator', '1', 'مدير عام', null, null, '1552385505', '1552385505');
INSERT INTO `rbac_auth_item` VALUES ('editOwnModel', '2', null, 'ownModelRule', null, '1552385505', '1552385505');
INSERT INTO `rbac_auth_item` VALUES ('governmentAdmin', '1', null, null, null, null, null);
INSERT INTO `rbac_auth_item` VALUES ('governmentRep', '1', null, null, null, null, null);
INSERT INTO `rbac_auth_item` VALUES ('loginToBackend', '2', null, null, null, '1552385505', '1552385505');
INSERT INTO `rbac_auth_item` VALUES ('loginToOrganization', '2', null, null, null, null, null);
INSERT INTO `rbac_auth_item` VALUES ('manager', '1', 'مدير ', null, null, '1552385505', '1552385505');
INSERT INTO `rbac_auth_item` VALUES ('user', '1', null, null, null, '1552385505', '1552385505');

-- ----------------------------
-- Table structure for `rbac_auth_item_child`
-- ----------------------------
DROP TABLE IF EXISTS `rbac_auth_item_child`;
CREATE TABLE `rbac_auth_item_child` (
  `parent` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `rbac_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rbac_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of rbac_auth_item_child
-- ----------------------------
INSERT INTO `rbac_auth_item_child` VALUES ('user', 'editOwnModel');
INSERT INTO `rbac_auth_item_child` VALUES ('administrator', 'loginToBackend');
INSERT INTO `rbac_auth_item_child` VALUES ('manager', 'loginToBackend');
INSERT INTO `rbac_auth_item_child` VALUES ('governmentAdmin', 'loginToOrganization');
INSERT INTO `rbac_auth_item_child` VALUES ('governmentRep', 'loginToOrganization');
INSERT INTO `rbac_auth_item_child` VALUES ('administrator', 'manager');
INSERT INTO `rbac_auth_item_child` VALUES ('administrator', 'user');
INSERT INTO `rbac_auth_item_child` VALUES ('manager', 'user');

-- ----------------------------
-- Table structure for `rbac_auth_rule`
-- ----------------------------
DROP TABLE IF EXISTS `rbac_auth_rule`;
CREATE TABLE `rbac_auth_rule` (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of rbac_auth_rule
-- ----------------------------
INSERT INTO `rbac_auth_rule` VALUES ('ownModelRule', 0x4F3A32393A22636F6D6D6F6E5C726261635C72756C655C4F776E4D6F64656C52756C65223A333A7B733A343A226E616D65223B733A31323A226F776E4D6F64656C52756C65223B733A393A22637265617465644174223B693A313535323338353530353B733A393A22757064617465644174223B693A313535323338353530353B7D, '1552385505', '1552385505');

-- ----------------------------
-- Table structure for `survey`
-- ----------------------------
DROP TABLE IF EXISTS `survey`;
CREATE TABLE `survey` (
  `survey_id` int unsigned NOT NULL AUTO_INCREMENT,
  `survey_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `survey_updated_at` timestamp NULL DEFAULT NULL,
  `survey_expired_at` timestamp NULL DEFAULT NULL,
  `survey_is_pinned` tinyint(1) DEFAULT '0',
  `survey_is_closed` tinyint(1) DEFAULT '0',
  `survey_tags` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_created_by` int DEFAULT NULL,
  `survey_wallet` int unsigned DEFAULT NULL,
  `survey_status` int unsigned DEFAULT NULL,
  `survey_descr` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `survey_time_to_pass` smallint unsigned DEFAULT NULL,
  `survey_badge_id` int unsigned DEFAULT NULL,
  `survey_is_private` tinyint(1) NOT NULL DEFAULT '0',
  `survey_is_visible` tinyint(1) NOT NULL DEFAULT '0',
  `org_id` int unsigned DEFAULT NULL,
  `start_info` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `survey_point` int DEFAULT NULL,
  `sector_id` int DEFAULT NULL,
  PRIMARY KEY (`survey_id`),
  KEY `fk_survey_created_by_idx` (`survey_created_by`),
  CONSTRAINT `survey_ibfk_1` FOREIGN KEY (`survey_created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of survey
-- ----------------------------

-- ----------------------------
-- Table structure for `survey_answer`
-- ----------------------------
DROP TABLE IF EXISTS `survey_answer`;
CREATE TABLE `survey_answer` (
  `survey_answer_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `survey_answer_question_id` int unsigned DEFAULT NULL,
  `survey_answer_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_answer_descr` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `survey_answer_class` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_answer_comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_answer_sort` int DEFAULT NULL,
  `survey_answer_points` int DEFAULT '0',
  `survey_answer_show_descr` tinyint(1) DEFAULT '0',
  `survey_answer_show_corrective_action` tinyint(1) DEFAULT '0',
  `survey_answer_corrective_action` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `correct` tinyint(1) DEFAULT '0',
  `corrective_action_date` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`survey_answer_id`),
  KEY `fk_survey_answer_to_question_idx` (`survey_answer_question_id`),
  CONSTRAINT `survey_answer_ibfk_1` FOREIGN KEY (`survey_answer_question_id`) REFERENCES `survey_question` (`survey_question_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of survey_answer
-- ----------------------------

-- ----------------------------
-- Table structure for `survey_degree_level`
-- ----------------------------
DROP TABLE IF EXISTS `survey_degree_level`;
CREATE TABLE `survey_degree_level` (
  `survey_degree_level_id` int NOT NULL AUTO_INCREMENT,
  `survey_degree_level_survey_id` int unsigned DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `from` int DEFAULT NULL,
  `to` int DEFAULT NULL,
  PRIMARY KEY (`survey_degree_level_id`),
  KEY `fk_survey_degree_level_survey_idx` (`survey_degree_level_survey_id`),
  CONSTRAINT `survey_degree_level_ibfk_1` FOREIGN KEY (`survey_degree_level_survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of survey_degree_level
-- ----------------------------

-- ----------------------------
-- Table structure for `survey_question`
-- ----------------------------
DROP TABLE IF EXISTS `survey_question`;
CREATE TABLE `survey_question` (
  `survey_question_id` int unsigned NOT NULL AUTO_INCREMENT,
  `survey_question_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_question_descr` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `survey_question_type` tinyint unsigned DEFAULT NULL,
  `survey_question_survey_id` int unsigned DEFAULT NULL,
  `survey_question_can_skip` tinyint(1) DEFAULT '0',
  `survey_question_show_descr` tinyint(1) DEFAULT '0',
  `survey_question_is_scorable` tinyint(1) DEFAULT '0',
  `steps` int DEFAULT NULL,
  `survey_question_attachment_file` tinyint(1) DEFAULT '0',
  `survey_question_point` int DEFAULT NULL,
  `survey_question_can_ignore` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`survey_question_id`),
  KEY `fk_survey_question_to_survey_idx` (`survey_question_survey_id`),
  KEY `fk_survey_question_to_type_idx` (`survey_question_type`),
  CONSTRAINT `survey_question_ibfk_1` FOREIGN KEY (`survey_question_survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `survey_question_ibfk_2` FOREIGN KEY (`survey_question_type`) REFERENCES `survey_type` (`survey_type_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of survey_question
-- ----------------------------

-- ----------------------------
-- Table structure for `survey_restricted_user`
-- ----------------------------
DROP TABLE IF EXISTS `survey_restricted_user`;
CREATE TABLE `survey_restricted_user` (
  `survey_restricted_user_id` int unsigned NOT NULL AUTO_INCREMENT,
  `survey_restricted_user_survey_id` int unsigned NOT NULL,
  `survey_restricted_user_user_id` int NOT NULL,
  PRIMARY KEY (`survey_restricted_user_id`),
  KEY `fk_survey_restricted_user_to_survey` (`survey_restricted_user_survey_id`),
  KEY `fk_survey_restricted_user_to_user` (`survey_restricted_user_user_id`),
  CONSTRAINT `survey_restricted_user_ibfk_1` FOREIGN KEY (`survey_restricted_user_survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `survey_restricted_user_ibfk_2` FOREIGN KEY (`survey_restricted_user_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of survey_restricted_user
-- ----------------------------

-- ----------------------------
-- Table structure for `survey_selected_sectors`
-- ----------------------------
DROP TABLE IF EXISTS `survey_selected_sectors`;
CREATE TABLE `survey_selected_sectors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `survey_id` int unsigned DEFAULT NULL,
  `sector_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_survey_selected_sectors_survey_id` (`survey_id`),
  KEY `fk_survey_selected_sectors_sector_idx` (`sector_id`),
  CONSTRAINT `fk_survey_selected_sectors_id` FOREIGN KEY (`sector_id`) REFERENCES `organization_structure` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_survey_selected_sectors_survey_id` FOREIGN KEY (`survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of survey_selected_sectors
-- ----------------------------

-- ----------------------------
-- Table structure for `survey_selected_users`
-- ----------------------------
DROP TABLE IF EXISTS `survey_selected_users`;
CREATE TABLE `survey_selected_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `survey_id` int unsigned DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_survey_selected_users_survey_id` (`survey_id`),
  KEY `fk_survey_selected_users_user_idx` (`user_id`),
  CONSTRAINT `fk_survey_selected_users_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_survey_selected_users_survey_id` FOREIGN KEY (`survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of survey_selected_users
-- ----------------------------

-- ----------------------------
-- Table structure for `survey_stat`
-- ----------------------------
DROP TABLE IF EXISTS `survey_stat`;
CREATE TABLE `survey_stat` (
  `survey_stat_id` int unsigned NOT NULL AUTO_INCREMENT,
  `survey_stat_survey_id` int unsigned DEFAULT NULL,
  `survey_stat_user_id` int DEFAULT NULL,
  `survey_stat_assigned_at` timestamp NULL DEFAULT NULL,
  `survey_stat_started_at` timestamp NULL DEFAULT NULL,
  `survey_stat_updated_at` timestamp NULL DEFAULT NULL,
  `survey_stat_ended_at` timestamp NULL DEFAULT NULL,
  `survey_stat_session_start` timestamp NULL DEFAULT NULL,
  `survey_stat_actual_time` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_stat_ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_stat_is_done` tinyint(1) DEFAULT '0',
  `survey_stat_hash` char(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `pageNo` int DEFAULT NULL,
  PRIMARY KEY (`survey_stat_id`),
  UNIQUE KEY `survey_stat_hash_UNIQUE` (`survey_stat_hash`),
  KEY `fk_sas_user_idx` (`survey_stat_user_id`),
  KEY `fk_stat_to_survey_idx` (`survey_stat_survey_id`),
  CONSTRAINT `survey_stat_ibfk_1` FOREIGN KEY (`survey_stat_survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `survey_stat_ibfk_2` FOREIGN KEY (`survey_stat_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of survey_stat
-- ----------------------------

-- ----------------------------
-- Table structure for `survey_tag`
-- ----------------------------
DROP TABLE IF EXISTS `survey_tag`;
CREATE TABLE `survey_tag` (
  `id` int NOT NULL AUTO_INCREMENT,
  `survey_id` int unsigned DEFAULT NULL,
  `tag_id` int DEFAULT NULL,
  `ord` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_survey_tag_survey_id` (`survey_id`),
  KEY `fk_survey_tag_tag_idx` (`tag_id`),
  CONSTRAINT `fk_survet_tag_survey` FOREIGN KEY (`survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_survey_tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of survey_tag
-- ----------------------------

-- ----------------------------
-- Table structure for `survey_type`
-- ----------------------------
DROP TABLE IF EXISTS `survey_type`;
CREATE TABLE `survey_type` (
  `survey_type_id` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `survey_type_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_type_name_ar` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_type_descr` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_type_descr_ar` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `sort` int DEFAULT NULL,
  PRIMARY KEY (`survey_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of survey_type
-- ----------------------------
INSERT INTO `survey_type` VALUES ('1', 'Multiple choice', 'خيارات من متعدد', 'Ask your respondent to choose multiple answers from your list of answer choices.', 'امكانيه اختيار اكتر من اجابه', '1', '4');
INSERT INTO `survey_type` VALUES ('2', 'One choise of list', 'خيار واحد من متعدد', 'Ask your respondent to choose one answer from your list of answer choices.', 'اختيار اجابة واحده من مجموعه اجابات', '1', '5');
INSERT INTO `survey_type` VALUES ('3', 'Dropdown', 'خيار واحد من قائمة', 'Provide a dropdown list of answer choices for respondents to choose from.', 'قائمه منسدله لاختيار اجابه واحده', '1', '3');
INSERT INTO `survey_type` VALUES ('4', 'Ranking', 'تصنيف', 'Ask respondents to rank a list of options in the order they prefer using numeric dropdown menus.', 'تقييم مجموعه من الاجابات حسب الافضل', '1', '9');
INSERT INTO `survey_type` VALUES ('5', 'Rating', 'تقييم', 'Ask respondents to rate an item or question by dragging an interactive slider.', 'تقييم من خلال اختيا رنسبه من سليدر', '1', '7');
INSERT INTO `survey_type` VALUES ('6', 'Single textbox', 'سؤال نصي', 'Add a single textbox to your survey when you want respondents to write in a short text or numerical answer to your question.', 'اظهار مكان لادخال اجابه نصيه ', '1', '1');
INSERT INTO `survey_type` VALUES ('7', 'Multiple textboxes', 'مربعات النص متعددة', 'Add multiple textboxes to your survey when you want respondents to write in more than one short text or numerical answer to your question.', 'امكانيه ادخال اكتر من اجابه نصية', null, null);
INSERT INTO `survey_type` VALUES ('8', 'Comment box', 'نص كبير', 'Use the comment or essay box to collect open-ended, written feedback from respondents.', 'امكانيه كتابة تعليق على الاجابة', '1', '2');
INSERT INTO `survey_type` VALUES ('9', 'Date/Time', 'تاريخ / وقت', 'Ask respondents to enter a specific date and/or time.', 'اختيار تاريخ معين', '1', '6');
INSERT INTO `survey_type` VALUES ('10', 'Calendar', 'التقويم', 'Ask respondents to choose better date/time for a meeting.', 'اختيار تاريخ', null, null);
INSERT INTO `survey_type` VALUES ('11', 'File', 'ملف', 'Ask your respondent to attach file answers.', 'اطلب من المستفتى إرفاق الاجابة علي هيئة ملف', '1', '8');

-- ----------------------------
-- Table structure for `survey_user_answer`
-- ----------------------------
DROP TABLE IF EXISTS `survey_user_answer`;
CREATE TABLE `survey_user_answer` (
  `survey_user_answer_id` int unsigned NOT NULL AUTO_INCREMENT,
  `survey_user_answer_user_id` int DEFAULT NULL,
  `survey_user_answer_survey_id` int unsigned DEFAULT NULL,
  `survey_user_answer_question_id` int unsigned DEFAULT NULL,
  `survey_user_answer_answer_id` bigint unsigned DEFAULT NULL,
  `survey_user_answer_value` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_user_answer_text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `survey_user_answer_file_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_user_answer_point` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '0',
  `not_applicable` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`survey_user_answer_id`),
  KEY `fk_survey_user_answer_answer_idx` (`survey_user_answer_answer_id`),
  KEY `fk_survey_user_answer_user_idx` (`survey_user_answer_user_id`),
  KEY `idx_answer_value` (`survey_user_answer_answer_id`,`survey_user_answer_value`),
  KEY `idx_question_value` (`survey_user_answer_question_id`,`survey_user_answer_value`),
  KEY `ff_idx` (`survey_user_answer_survey_id`),
  KEY `fk_survey_user_answer_question_idx` (`survey_user_answer_question_id`),
  KEY `idx_survey_user_answer_value` (`survey_user_answer_value`),
  CONSTRAINT `survey_user_answer_ibfk_1` FOREIGN KEY (`survey_user_answer_answer_id`) REFERENCES `survey_answer` (`survey_answer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `survey_user_answer_ibfk_2` FOREIGN KEY (`survey_user_answer_question_id`) REFERENCES `survey_question` (`survey_question_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `survey_user_answer_ibfk_3` FOREIGN KEY (`survey_user_answer_survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `survey_user_answer_ibfk_4` FOREIGN KEY (`survey_user_answer_user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of survey_user_answer
-- ----------------------------

-- ----------------------------
-- Table structure for `survey_user_answer_attachments`
-- ----------------------------
DROP TABLE IF EXISTS `survey_user_answer_attachments`;
CREATE TABLE `survey_user_answer_attachments` (
  `survey_user_answer_attachments_id` int unsigned NOT NULL AUTO_INCREMENT,
  `survey_user_answer_attachments_user_id` int DEFAULT NULL,
  `survey_user_answer_attachments_survey_id` int unsigned DEFAULT NULL,
  `survey_user_answer_attachments_question_id` int unsigned DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `base_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` int DEFAULT NULL,
  PRIMARY KEY (`survey_user_answer_attachments_id`),
  KEY `fk_survey_user_answer_attachments_user_idx` (`survey_user_answer_attachments_user_id`),
  KEY `idx_question_value` (`survey_user_answer_attachments_question_id`),
  KEY `ff_idx` (`survey_user_answer_attachments_survey_id`),
  KEY `fk_survey_user_answer_attachments_question_idx` (`survey_user_answer_attachments_question_id`),
  CONSTRAINT `survey_user_answer_attachments_ibfk_1` FOREIGN KEY (`survey_user_answer_attachments_question_id`) REFERENCES `survey_question` (`survey_question_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `survey_user_answer_attachments_ibfk_2` FOREIGN KEY (`survey_user_answer_attachments_survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `survey_user_answer_attachments_ibfk_3` FOREIGN KEY (`survey_user_answer_attachments_user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of survey_user_answer_attachments
-- ----------------------------

-- ----------------------------
-- Table structure for `system_db_migration`
-- ----------------------------
DROP TABLE IF EXISTS `system_db_migration`;
CREATE TABLE `system_db_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- ----------------------------
-- Records of system_db_migration
-- ----------------------------

-- ----------------------------
-- Table structure for `system_log`
-- ----------------------------
DROP TABLE IF EXISTS `system_log`;
CREATE TABLE `system_log` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `level` int DEFAULT NULL,
  `category` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `log_time` double DEFAULT NULL,
  `prefix` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `idx_log_level` (`level`),
  KEY `idx_log_category` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of system_log
-- ----------------------------
-- ----------------------------
-- Table structure for `system_rbac_migration`
-- ----------------------------
DROP TABLE IF EXISTS `system_rbac_migration`;
CREATE TABLE `system_rbac_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of system_rbac_migration
-- ----------------------------
INSERT INTO `system_rbac_migration` VALUES ('m000000_000000_base', '1552385503');
INSERT INTO `system_rbac_migration` VALUES ('m150625_214101_roles', '1552385505');
INSERT INTO `system_rbac_migration` VALUES ('m150625_215624_init_permissions', '1552385505');
INSERT INTO `system_rbac_migration` VALUES ('m151223_074604_edit_own_model', '1552385505');

-- ----------------------------
-- Table structure for `tag`
-- ----------------------------
DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tag
-- ----------------------------

-- ----------------------------
-- Table structure for `timeline_event`
-- ----------------------------
DROP TABLE IF EXISTS `timeline_event`;
CREATE TABLE `timeline_event` (
  `id` int NOT NULL AUTO_INCREMENT,
  `application` varchar(64) NOT NULL,
  `category` varchar(64) NOT NULL,
  `event` varchar(64) NOT NULL,
  `data` text,
  `created_at` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of timeline_event
-- ----------------------------
INSERT INTO `timeline_event` VALUES ('41', 'backend', 'user', 'signup', '{\"public_identity\":\"test@test.com\",\"user_id\":4,\"created_at\":1580303660}', '1580303660');
INSERT INTO `timeline_event` VALUES ('42', 'backend', 'user', 'signup', '{\"public_identity\":\"mu.ahmed-c@tamkeentech.com\",\"user_id\":5,\"created_at\":1580306638}', '1580306638');
INSERT INTO `timeline_event` VALUES ('43', 'backend', 'user', 'signup', '{\"public_identity\":\"mu.ahmed-c@tamkeentech.com\",\"user_id\":6,\"created_at\":1580369981}', '1580369981');
INSERT INTO `timeline_event` VALUES ('44', 'backend', 'user', 'signup', '{\"public_identity\":\"mu.ahmed-c@tamkeentech.sa\",\"user_id\":7,\"created_at\":1580371690}', '1580371690');

-- ----------------------------
-- Table structure for `translations_with_string`
-- ----------------------------
DROP TABLE IF EXISTS `translations_with_string`;
CREATE TABLE `translations_with_string` (
  `id` int NOT NULL AUTO_INCREMENT,
  `table_name` varchar(100) NOT NULL,
  `model_id` int NOT NULL,
  `attribute` varchar(100) NOT NULL,
  `lang` varchar(6) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `attribute` (`attribute`),
  KEY `table_name` (`table_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of translations_with_string
-- ----------------------------

-- ----------------------------
-- Table structure for `translations_with_text`
-- ----------------------------
DROP TABLE IF EXISTS `translations_with_text`;
CREATE TABLE `translations_with_text` (
  `id` int NOT NULL AUTO_INCREMENT,
  `table_name` varchar(100) NOT NULL,
  `model_id` int NOT NULL,
  `attribute` varchar(100) NOT NULL,
  `lang` varchar(6) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `attribute` (`attribute`),
  KEY `table_name` (`table_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of translations_with_text
-- ----------------------------

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(32) DEFAULT NULL,
  `auth_key` varchar(32) NOT NULL,
  `access_token` text,
  `password_hash` varchar(255) NOT NULL,
  `oauth_client` varchar(255) DEFAULT NULL,
  `oauth_client_user_id` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint NOT NULL DEFAULT '2',
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  `logged_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'superadmin', 'Chl2wTf1lcFvgHzjy_d7o3T79cBGBTGj', 'foGDvBiPRrk8MkemGZyZCAudcdxTUtY-HjFW_PlR', '$2y$13$Ij0Bjtsnv/9D7uoHZ7p4leQl7JJHezG0Ugr9woqz68y8y0XE2Zn3a', null, null, 'webmaster@example.com', '2', '1552385275', '1552385275', '1569225691');
INSERT INTO `user` VALUES ('2', 'manager', 'm64KHrNPyf7q1slLz0x9Rlqx6fbmfY4M', 'bkVRGck5Lf1dC2xF9jequ5qPg67o0lpZAGyVAAJE', '$2y$13$RoksEVwYtitm.xjsQw0zp.iSI/T051q2aNW4/gAffylbPq4LqlpCS', null, null, 'admin@sahl.tech', '2', '1552385276', '1580894283', '1580894383');
INSERT INTO `user` VALUES ('3', 'user', 'IgC3yV60pa5oIbrtahAEEUgQAbJDfzz9', '__yC5eEfXr6yYM8EuTweBqjxU92ZD6vdrLCc-GdC', '$2y$13$9V/G9ZtHZl5NWM5NwZGRmeogHQDBrfpavhbMYlRl1kBb7J0wXN2Jm', null, null, 'user@example.com', '2', '1552385276', '1552385276', null);
INSERT INTO `user` VALUES ('4', 'tamkeen-superadmin', 'Chl2wTf1lcFvgHzjy_d7o3T79cBGBTGj', 'foGDvBiPRrk8MkemGZyZCAudcdxTUtY-HjFW_PlR', '$2y$13$Ij0Bjtsnv/9D7uoHZ7p4leQl7JJHezG0Ugr9woqz68y8y0XE2Zn3a', null, null, 'webmaster@example.com', '2', '1552385275', '1552385275', '1569225691');

-- ----------------------------
-- Table structure for `user_attachment`
-- ----------------------------
DROP TABLE IF EXISTS `user_attachment`;
CREATE TABLE `user_attachment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `path` varchar(255) NOT NULL,
  `base_url` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `size` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` int DEFAULT NULL,
  `order` int DEFAULT NULL,
  `meta` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_attachment` (`user_id`),
  CONSTRAINT `user_attachment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_attachment
-- ----------------------------

-- ----------------------------
-- Table structure for `user_profile`
-- ----------------------------
DROP TABLE IF EXISTS `user_profile`;
CREATE TABLE `user_profile` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `avatar_path` varchar(255) DEFAULT NULL,
  `avatar_base_url` varchar(255) DEFAULT NULL,
  `locale` varchar(32) NOT NULL,
  `activity` varchar(100) DEFAULT NULL,
  `job` varchar(100) DEFAULT NULL,
  `specialization_id` int unsigned NOT NULL DEFAULT '0',
  `nationality_id` int unsigned NOT NULL DEFAULT '0',
  `draft` tinyint(1) NOT NULL DEFAULT '0',
  `gender` smallint DEFAULT NULL,
  `school_id` int DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `device_token` varchar(200) DEFAULT NULL,
  `active` tinyint DEFAULT '0',
  `organization_id` int unsigned DEFAULT NULL,
  `sector_id` int NOT NULL,
  `position` varchar(100) DEFAULT NULL,
  `city_id` int unsigned DEFAULT NULL,
  `district_id` int unsigned DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `bio` text,
  `main_admin` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`user_id`),
  CONSTRAINT `user_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_profile
-- ----------------------------
INSERT INTO `user_profile` VALUES ('1', 'John', null, 'Doe', null, null, 'ar-AR', null, null, '0', '0', '0', null, null, null, null, '0', null, '0', null, null, null, null, null, '0');
INSERT INTO `user_profile` VALUES ('2', 'المدير العام', '', '', null, null, 'ar-AR', null, null, '0', '0', '0', '1', null, '0594949779', null, '0', null, '0', null, null, null, null, null, '0');
INSERT INTO `user_profile` VALUES ('3', null, null, null, null, null, 'ar-AR', null, null, '0', '0', '0', null, null, null, null, '0', null, '0', null, null, null, null, null, '0');
INSERT INTO `user_profile` VALUES ('4', 'Tamkeen', null, 'Superadmin', null, null, 'ar-AR', null, null, '0', '0', '0', null, null, null, null, '0', null, '0', null, null, null, null, null, '0');


-- ----------------------------
-- Table structure for `user_tag`
-- ----------------------------
DROP TABLE IF EXISTS `user_tag`;
CREATE TABLE `user_tag` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `tag_id` int DEFAULT NULL,
  `ord` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_idx` (`user_id`),
  KEY `fk_tag_idx` (`tag_id`),
  CONSTRAINT `fk_tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tag_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_tag
-- ----------------------------

-- ----------------------------
-- Table structure for `user_token`
-- ----------------------------
DROP TABLE IF EXISTS `user_token`;
CREATE TABLE `user_token` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `token` varchar(40) NOT NULL,
  `expire_at` int DEFAULT NULL,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_token
-- ----------------------------
