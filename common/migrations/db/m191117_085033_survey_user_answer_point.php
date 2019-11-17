<?php

use yii\db\Migration;

/**
 * Class m191117_085033_survey_user_answer_point
 */
class m191117_085033_survey_user_answer_point extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            ALTER TABLE `survey_user_answer`
            ADD COLUMN `survey_user_answer_point` int DEFAULT 0;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191117_085033_survey_user_answer_point cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191117_085033_survey_user_answer_point cannot be reverted.\n";

        return false;
    }
    */
}
