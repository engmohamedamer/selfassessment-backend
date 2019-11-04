<?php

use yii\db\Migration;

/**
 * Class m191103_135248_SyrvyTypes
 */
class m191103_135248_SyrvyTypes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        SET FOREIGN_KEY_CHECKS=0;

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
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of survey_user_answer
-- ----------------------------
INSERT INTO `survey_user_answer` VALUES ('55', '24', '30', '37', null, 'text input value', null);
INSERT INTO `survey_user_answer` VALUES ('56', '24', '30', '38', null, '74', null);
INSERT INTO `survey_user_answer` VALUES ('57', '24', '30', '39', '75', '1', null);
INSERT INTO `survey_user_answer` VALUES ('58', '24', '30', '39', '76', '0', null);
INSERT INTO `survey_user_answer` VALUES ('59', '24', '30', '40', '77', '2', null);
INSERT INTO `survey_user_answer` VALUES ('60', '24', '30', '40', '78', '3', null);
INSERT INTO `survey_user_answer` VALUES ('61', '24', '30', '40', '79', '4', null);
INSERT INTO `survey_user_answer` VALUES ('62', '24', '30', '40', '80', '4', null);
        
        ");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191103_135248_SyrvyTypes cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191103_135248_SyrvyTypes cannot be reverted.\n";

        return false;
    }
    */
}
