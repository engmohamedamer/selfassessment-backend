/*
Navicat MySQL Data Transfer

Source Server         : Docker_SchoolsSys
Source Server Version : 50724
Source Host           : localhost:13306
Source Database       : selfassest

Target Server Type    : MYSQL
Target Server Version : 50724
File Encoding         : 65001

Date: 2019-10-24 11:16:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `survey`
-- ----------------------------
DROP TABLE IF EXISTS `survey`;
CREATE TABLE `survey` (
  `survey_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `survey_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `survey_updated_at` timestamp NULL DEFAULT NULL,
  `survey_expired_at` timestamp NULL DEFAULT NULL,
  `survey_is_pinned` tinyint(1) DEFAULT '0',
  `survey_is_closed` tinyint(1) DEFAULT '0',
  `survey_tags` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_created_by` int(11) DEFAULT NULL,
  `survey_wallet` int(11) unsigned DEFAULT NULL,
  `survey_status` int(11) unsigned DEFAULT NULL,
  `survey_descr` text COLLATE utf8_unicode_ci,
  `survey_time_to_pass` smallint(6) unsigned DEFAULT NULL,
  `survey_badge_id` int(11) unsigned DEFAULT NULL,
  `survey_is_private` tinyint(1) NOT NULL DEFAULT '0',
  `survey_is_visible` tinyint(1) NOT NULL DEFAULT '0',
  `org_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`survey_id`),
  KEY `fk_survey_created_by_idx` (`survey_created_by`),
  CONSTRAINT `fk_survey_created_by` FOREIGN KEY (`survey_created_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of survey
-- ----------------------------

-- ----------------------------
-- Table structure for `survey_answer`
-- ----------------------------
DROP TABLE IF EXISTS `survey_answer`;
CREATE TABLE `survey_answer` (
  `survey_answer_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `survey_answer_question_id` int(11) unsigned DEFAULT NULL,
  `survey_answer_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_answer_descr` text COLLATE utf8_unicode_ci,
  `survey_answer_class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_answer_comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_answer_sort` int(11) DEFAULT NULL,
  `survey_answer_points` int(11) DEFAULT '0',
  `survey_answer_show_descr` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`survey_answer_id`),
  KEY `fk_survey_answer_to_question_idx` (`survey_answer_question_id`),
  CONSTRAINT `fk_survey_answer_to_question` FOREIGN KEY (`survey_answer_question_id`) REFERENCES `survey_question` (`survey_question_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of survey_answer
-- ----------------------------

-- ----------------------------
-- Table structure for `survey_question`
-- ----------------------------
DROP TABLE IF EXISTS `survey_question`;
CREATE TABLE `survey_question` (
  `survey_question_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `survey_question_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_question_descr` text COLLATE utf8_unicode_ci,
  `survey_question_type` tinyint(3) unsigned DEFAULT NULL,
  `survey_question_survey_id` int(11) unsigned DEFAULT NULL,
  `survey_question_can_skip` tinyint(1) DEFAULT '0',
  `survey_question_show_descr` tinyint(1) DEFAULT '0',
  `survey_question_is_scorable` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`survey_question_id`),
  KEY `fk_survey_question_to_survey_idx` (`survey_question_survey_id`),
  KEY `fk_survey_question_to_type_idx` (`survey_question_type`),
  CONSTRAINT `fk_survey_question_to_survey` FOREIGN KEY (`survey_question_survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_survey_question_to_type` FOREIGN KEY (`survey_question_type`) REFERENCES `survey_type` (`survey_type_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of survey_question
-- ----------------------------

-- ----------------------------
-- Table structure for `survey_restricted_user`
-- ----------------------------
DROP TABLE IF EXISTS `survey_restricted_user`;
CREATE TABLE `survey_restricted_user` (
  `survey_restricted_user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `survey_restricted_user_survey_id` int(11) unsigned NOT NULL,
  `survey_restricted_user_user_id` int(11) NOT NULL,
  PRIMARY KEY (`survey_restricted_user_id`),
  KEY `fk_survey_restricted_user_to_survey` (`survey_restricted_user_survey_id`),
  KEY `fk_survey_restricted_user_to_user` (`survey_restricted_user_user_id`),
  CONSTRAINT `fk_survey_restricted_user_to_survey` FOREIGN KEY (`survey_restricted_user_survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_survey_restricted_user_to_user` FOREIGN KEY (`survey_restricted_user_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of survey_restricted_user
-- ----------------------------

-- ----------------------------
-- Table structure for `survey_stat`
-- ----------------------------
DROP TABLE IF EXISTS `survey_stat`;
CREATE TABLE `survey_stat` (
  `survey_stat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `survey_stat_survey_id` int(11) unsigned DEFAULT NULL,
  `survey_stat_user_id` int(11) DEFAULT NULL,
  `survey_stat_assigned_at` timestamp NULL DEFAULT NULL,
  `survey_stat_started_at` timestamp NULL DEFAULT NULL,
  `survey_stat_updated_at` timestamp NULL DEFAULT NULL,
  `survey_stat_ended_at` timestamp NULL DEFAULT NULL,
  `survey_stat_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_stat_is_done` tinyint(1) DEFAULT '0',
  `survey_stat_hash` char(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`survey_stat_id`),
  UNIQUE KEY `survey_stat_hash_UNIQUE` (`survey_stat_hash`),
  KEY `fk_sas_user_idx` (`survey_stat_user_id`),
  KEY `fk_stat_to_survey_idx` (`survey_stat_survey_id`),
  CONSTRAINT `fk_stat_to_survey` FOREIGN KEY (`survey_stat_survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_stat_to_user` FOREIGN KEY (`survey_stat_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of survey_stat
-- ----------------------------

-- ----------------------------
-- Table structure for `survey_type`
-- ----------------------------
DROP TABLE IF EXISTS `survey_type`;
CREATE TABLE `survey_type` (
  `survey_type_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `survey_type_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_type_descr` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`survey_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of survey_type
-- ----------------------------
INSERT INTO `survey_type` VALUES ('1', 'Multiple choice', 'Ask your respondent to choose multiple answers from your list of answer choices.');
INSERT INTO `survey_type` VALUES ('2', 'One choise of list', 'Ask your respondent to choose one answer from your list of answer choices.');
INSERT INTO `survey_type` VALUES ('3', 'Dropdown', 'Provide a dropdown list of answer choices for respondents to choose from.');
INSERT INTO `survey_type` VALUES ('4', 'Ranking', 'Ask respondents to rank a list of options in the order they prefer using numeric dropdown menus.');
INSERT INTO `survey_type` VALUES ('5', 'Slider', 'Ask respondents to rate an item or question by dragging an interactive slider.');
INSERT INTO `survey_type` VALUES ('6', 'Single textbox', 'Add a single textbox to your survey when you want respondents to write in a short text or numerical answer to your question.');
INSERT INTO `survey_type` VALUES ('7', 'Multiple textboxes', 'Add multiple textboxes to your survey when you want respondents to write in more than one short text or numerical answer to your question.');
INSERT INTO `survey_type` VALUES ('8', 'Comment box', 'Use the comment or essay box to collect open-ended, written feedback from respondents.');
INSERT INTO `survey_type` VALUES ('9', 'Date/Time', 'Ask respondents to enter a specific date and/or time.');
INSERT INTO `survey_type` VALUES ('10', 'Calendar', 'Ask respondents to choose better date/time for a meeting.');

-- ----------------------------
-- Table structure for `survey_user_answer`
-- ----------------------------
DROP TABLE IF EXISTS `survey_user_answer`;
CREATE TABLE `survey_user_answer` (
  `survey_user_answer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `survey_user_answer_user_id` int(11) DEFAULT NULL,
  `survey_user_answer_survey_id` int(11) unsigned DEFAULT NULL,
  `survey_user_answer_question_id` int(11) unsigned DEFAULT NULL,
  `survey_user_answer_answer_id` bigint(20) unsigned DEFAULT NULL,
  `survey_user_answer_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_user_answer_text` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`survey_user_answer_id`),
  KEY `fk_survey_user_answer_answer_idx` (`survey_user_answer_answer_id`),
  KEY `fk_survey_user_answer_user_idx` (`survey_user_answer_user_id`),
  KEY `idx_answer_value` (`survey_user_answer_answer_id`,`survey_user_answer_value`),
  KEY `idx_question_value` (`survey_user_answer_question_id`,`survey_user_answer_value`),
  KEY `ff_idx` (`survey_user_answer_survey_id`),
  KEY `fk_survey_user_answer_question_idx` (`survey_user_answer_question_id`),
  KEY `idx_survey_user_answer_value` (`survey_user_answer_value`),
  CONSTRAINT `fk_survey_user_answer_answer` FOREIGN KEY (`survey_user_answer_answer_id`) REFERENCES `survey_answer` (`survey_answer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_survey_user_answer_question` FOREIGN KEY (`survey_user_answer_question_id`) REFERENCES `survey_question` (`survey_question_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_survey_user_answer_survey` FOREIGN KEY (`survey_user_answer_survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_survey_user_answer_user` FOREIGN KEY (`survey_user_answer_user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of survey_user_answer
-- ----------------------------
