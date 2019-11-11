<?php

use yii\db\Migration;

/**
 * Class m191105_094513_editSurvyTypes
 */
class m191105_094513_editSurvyTypes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `survey_type`
-- ----------------------------
DROP TABLE IF EXISTS `survey_type`;
CREATE TABLE `survey_type` (
  `survey_type_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `survey_type_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_type_name_ar` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_type_descr` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `survey_type_descr_ar` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`survey_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of survey_type
-- ----------------------------
INSERT INTO `survey_type` VALUES ('1', 'Multiple choice', 'خيارات من متعدد', 'Ask your respondent to choose multiple answers from your list of answer choices.', 'امكانيه اختيار اكتر من اجابه', '1', '4');
INSERT INTO `survey_type` VALUES ('2', 'One choise of list', 'خيار واحد من متعدد', 'Ask your respondent to choose one answer from your list of answer choices.', 'اختيار اجابة واحده من مجموعه اجابات', '1', '5');
INSERT INTO `survey_type` VALUES ('3', 'Dropdown', 'خيار واحد من قائمة', 'Provide a dropdown list of answer choices for respondents to choose from.', 'قائمه منسدله لاختيار اجابه واحده', '1', '3');
INSERT INTO `survey_type` VALUES ('4', 'Ranking', 'تصنيف', 'Ask respondents to rank a list of options in the order they prefer using numeric dropdown menus.', 'تقييم مجموعه من الاجابات حسب الافضل', '1', '9');
INSERT INTO `survey_type` VALUES ('5', 'Rating', 'تقييم', 'Ask respondents to rate an item or question by dragging an interactive slider.', 'تقييم من خلال اختيا رنسبه من سليدر',1, '7');
INSERT INTO `survey_type` VALUES ('6', 'Single textbox', 'سؤال نصي', 'Add a single textbox to your survey when you want respondents to write in a short text or numerical answer to your question.', 'اظهار مكان لادخال اجابه نصيه ', '1', '1');
INSERT INTO `survey_type` VALUES ('7', 'Multiple textboxes', 'مربعات النص متعددة', 'Add multiple textboxes to your survey when you want respondents to write in more than one short text or numerical answer to your question.', 'امكانيه ادخال اكتر من اجابه نصية', null, null);
INSERT INTO `survey_type` VALUES ('8', 'Comment box', 'صندوق التعليقات', 'Use the comment or essay box to collect open-ended, written feedback from respondents.', 'امكانيه كتابة تعليق على الاجابة', '1', '2');
INSERT INTO `survey_type` VALUES ('9', 'Date/Time', 'تاريخ / وقت', 'Ask respondents to enter a specific date and/or time.', 'اختيار تاريخ معين', '1', '6');
INSERT INTO `survey_type` VALUES ('10', 'Calendar', 'التقويم', 'Ask respondents to choose better date/time for a meeting.', 'اختيار تاريخ', null, null);
INSERT INTO `survey_type` VALUES ('11', 'File', 'ملف', 'Ask your respondent to attach file answers.', 'اطلب من المستفتى إرفاق الاجابة علي هيئة ملف', '1', '8');
        ");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191105_094513_editSurvyTypes cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191105_094513_editSurvyTypes cannot be reverted.\n";

        return false;
    }
    */
}
