<?php

use yii\db\Migration;

/**
 * Class m191017_093417_translateTBL
 */
class m191017_093417_translateTBL extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        /*
Navicat MySQL Data Transfer

Source Server         : Docker_SchoolsSys
Source Server Version : 50724
Source Host           : localhost:13306
Source Database       : selfassest

Target Server Type    : MYSQL
Target Server Version : 50724
File Encoding         : 65001

Date: 2019-10-17 09:57:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `translations_with_string`
-- ----------------------------
DROP TABLE IF EXISTS `translations_with_string`;
CREATE TABLE `translations_with_string` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(100) NOT NULL,
  `model_id` int(11) NOT NULL,
  `attribute` varchar(100) NOT NULL,
  `lang` varchar(6) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `attribute` (`attribute`),
  KEY `table_name` (`table_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of translations_with_string
-- ----------------------------

-- ----------------------------
-- Table structure for `translations_with_text`
-- ----------------------------
DROP TABLE IF EXISTS `translations_with_text`;
CREATE TABLE `translations_with_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(100) NOT NULL,
  `model_id` int(11) NOT NULL,
  `attribute` varchar(100) NOT NULL,
  `lang` varchar(6) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `attribute` (`attribute`),
  KEY `table_name` (`table_name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of translations_with_text
-- ----------------------------
        ");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191017_093417_translateTBL cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191017_093417_translateTBL cannot be reverted.\n";

        return false;
    }
    */
}
