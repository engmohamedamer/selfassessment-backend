<?php

use yii\db\Migration;

/**
 * Class m191017_071630_ThemeTBL
 */
class m191017_071630_ThemeTBL extends Migration
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

Date: 2019-10-17 09:17:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `organization_theme`
-- ----------------------------
DROP TABLE IF EXISTS `organization_theme`;
CREATE TABLE `organization_theme` (
  `organization_id` int(11) NOT NULL,
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
        
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191017_071630_ThemeTBL cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191017_071630_ThemeTBL cannot be reverted.\n";

        return false;
    }
    */
}
