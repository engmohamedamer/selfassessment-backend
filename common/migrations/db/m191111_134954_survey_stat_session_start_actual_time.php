<?php

use yii\db\Migration;

/**
 * Class m191111_134954_survey_stat_session_start_actual_time
 */
class m191111_134954_survey_stat_session_start_actual_time extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            ALTER TABLE `survey_stat`
            ADD COLUMN `survey_stat_session_start` timestamp NULL DEFAULT NULL AFTER `survey_stat_ended_at`,
            ADD COLUMN `survey_stat_actual_time` varchar(255) DEFAULT NULL AFTER `survey_stat_session_start`;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191111_134954_survey_stat_session_start_actual_time cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191111_134954_survey_stat_session_start_actual_time cannot be reverted.\n";

        return false;
    }
    */
}
