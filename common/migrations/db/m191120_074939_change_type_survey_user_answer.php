<?php

use yii\db\Migration;

/**
 * Class m191120_074939_change_type_survey_user_answer
 */
class m191120_074939_change_type_survey_user_answer extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            ALTER TABLE `survey_user_answer`
            MODIFY `survey_user_answer_point` varchar(255) DEFAULT 0;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191120_074939_change_type_survey_user_answer cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191120_074939_change_type_survey_user_answer cannot be reverted.\n";

        return false;
    }
    */
}
