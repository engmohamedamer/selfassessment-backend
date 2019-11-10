<?php

use yii\db\Migration;

/**
 * Class m191110_075927_survey_answer_attachments
 */
class m191110_075927_survey_answer_attachments extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            -- ----------------------------
            -- Table structure for `survey_user_answer_attachments`
            -- ----------------------------
            DROP TABLE IF EXISTS `survey_user_answer_attachments`;
            CREATE TABLE `survey_user_answer_attachments` (
              `survey_user_answer_attachments_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `survey_user_answer_attachments_user_id` int(11) DEFAULT NULL,
              `survey_user_answer_attachments_survey_id` int(11) unsigned DEFAULT NULL,
              `survey_user_answer_attachments_question_id` int(11) unsigned DEFAULT NULL,
              `name` varchar(255) DEFAULT NULL,
              `path` varchar(255) NOT NULL,
              `base_url` varchar(255) DEFAULT NULL,
              `type` varchar(255) DEFAULT NULL,
              `size` int(11) DEFAULT NULL,
              PRIMARY KEY (`survey_user_answer_attachments_id`),
              KEY `fk_survey_user_answer_attachments_user_idx` (`survey_user_answer_attachments_user_id`),
              KEY `idx_question_value` (`survey_user_answer_attachments_question_id`),
              KEY `ff_idx` (`survey_user_answer_attachments_survey_id`),
              KEY `fk_survey_user_answer_attachments_question_idx` (`survey_user_answer_attachments_question_id`),
              CONSTRAINT `fk_survey_user_answer_attachments_question` FOREIGN KEY (`survey_user_answer_attachments_question_id`) REFERENCES `survey_question` (`survey_question_id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `fk_survey_user_answer_attachments_survey` FOREIGN KEY (`survey_user_answer_attachments_survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `fk_survey_user_answer_attachments_user` FOREIGN KEY (`survey_user_answer_attachments_user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191110_075927_survey_answer_attachments cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191110_075927_survey_answer_attachments cannot be reverted.\n";

        return false;
    }
    */
}
