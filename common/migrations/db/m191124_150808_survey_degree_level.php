<?php

use yii\db\Migration;

/**
 * Class m191124_150808_survey_degree_level
 */
class m191124_150808_survey_degree_level extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE `survey_degree_level` (
              `survey_degree_level_id` int(11) NOT NULL AUTO_INCREMENT,
              `survey_degree_level_survey_id` int(11) unsigned DEFAULT NULL,
              `title` varchar(255) DEFAULT NULL,
              `from` int(11) DEFAULT NULL,
              `to` int(11) DEFAULT NULL,
              PRIMARY KEY (`survey_degree_level_id`),
              KEY `fk_survey_degree_level_survey_idx` (`survey_degree_level_survey_id`),
              CONSTRAINT `fk_survey_degree_level_survey_id` FOREIGN KEY (`survey_degree_level_survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191124_150808_survey_degree_level cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191124_150808_survey_degree_level cannot be reverted.\n";

        return false;
    }
    */
}
