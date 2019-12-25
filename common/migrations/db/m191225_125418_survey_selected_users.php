<?php

use yii\db\Migration;

/**
 * Class m191225_125418_survey_selected_users
 */
class m191225_125418_survey_selected_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            SET FOREIGN_KEY_CHECKS=0;
            -- ----------------------------
            -- Table structure for `survey_selected_users`
            -- ----------------------------
            DROP TABLE IF EXISTS `survey_selected_users`;
            CREATE TABLE `survey_selected_users` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `survey_id` int(10) unsigned DEFAULT NULL,
              `user_id` int(11) DEFAULT NULL,
              PRIMARY KEY (`id`),
              KEY `fk_survey_selected_users_survey_id` (`survey_id`),
              KEY `fk_survey_selected_users_user_idx` (`user_id`),
            CONSTRAINT `fk_survey_selected_users_survey_id` FOREIGN KEY (`survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `fk_survey_selected_users_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE  cascade ON UPDATE  cascade
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191225_125418_survey_selected_users cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191225_125418_survey_selected_users cannot be reverted.\n";

        return false;
    }
    */
}
