<?php

use yii\db\Migration;

/**
 * Class m200119_094945_survey_user_answer_not_applicable
 */
class m200119_094945_survey_user_answer_not_applicable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            ALTER TABLE `survey_user_answer` ADD COLUMN `not_applicable` tinyint(1) DEFAULT '0';
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200119_094945_survey_user_answer_not_applicable cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200119_094945_survey_user_answer_not_applicable cannot be reverted.\n";

        return false;
    }
    */
}
