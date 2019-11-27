<?php

use yii\db\Migration;

/**
 * Class m191126_074048_survey_corrective_action_date
 */
class m191126_074048_survey_corrective_action_date extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            ALTER TABLE `survey_answer`
            ADD COLUMN `corrective_action_date` varchar(10) DEFAULT NULL;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191126_074048_survey_corrective_action_date cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191126_074048_survey_corrective_action_date cannot be reverted.\n";

        return false;
    }
    */
}
