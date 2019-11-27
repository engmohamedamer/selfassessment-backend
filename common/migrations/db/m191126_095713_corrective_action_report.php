<?php

use yii\db\Migration;

/**
 * Class m191126_095713_corrective_action_report
 */
class m191126_095713_corrective_action_report extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE `corrective_action_report` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `org_id` int(11) DEFAULT NULL,
              `user_id` int(11) DEFAULT NULL,
              `survey_id` int(10) unsigned DEFAULT NULL,
              `question_id` int(10) unsigned DEFAULT NULL,
              `answer_id` bigint(20) unsigned DEFAULT NULL,
              `corrective_action` varchar(255) DEFAULT NULL,
              `corrective_action_date` date DEFAULT NULL,
              `status` tinyint(1) DEFAULT '0',
              `comment` text DEFAULT NULL,
                PRIMARY KEY (`id`),
                KEY `fk_org_id_idx` (`org_id`),
                KEY `fk_user_idx` (`user_id`),
                KEY `ffsurvey_id_idx` (`survey_id`),
                KEY `fk_question_idx` (`question_id`),
                KEY `fk_answer_idx` (`answer_id`),
                CONSTRAINT `fk_corrective_action_report_org_id` FOREIGN KEY (`org_id`) REFERENCES `organization` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
                CONSTRAINT `fk_corrective_action_report_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
                CONSTRAINT `fk_corrective_action_report_survey` FOREIGN KEY (`survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk_corrective_action_report_question` FOREIGN KEY (`question_id`) REFERENCES `survey_question` (`survey_question_id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk_corrective_action_report_answer` FOREIGN KEY (`answer_id`) REFERENCES `survey_answer` (`survey_answer_id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191126_095713_corrective_action_report cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191126_095713_corrective_action_report cannot be reverted.\n";

        return false;
    }
    */
}
