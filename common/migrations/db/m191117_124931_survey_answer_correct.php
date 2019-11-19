<?php

use yii\db\Migration;

/**
 * Class m191117_124931_survey_answer_correct
 */
class m191117_124931_survey_answer_correct extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            ALTER TABLE `survey_answer`
            ADD COLUMN `correct` tinyint(1) DEFAULT '0';
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191117_124931_survey_answer_correct cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191117_124931_survey_answer_correct cannot be reverted.\n";

        return false;
    }
    */
}
