<?php

use yii\db\Migration;

/**
 * Class m191111_095653_survey_question_attachment_file
 */
class m191111_095653_survey_question_attachment_file extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            ALTER TABLE `survey_question`
            ADD COLUMN `survey_question_attachment_file` tinyint(1) DEFAULT '0';
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191111_095653_survey_question_attachment_file cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191111_095653_survey_question_attachment_file cannot be reverted.\n";

        return false;
    }
    */
}
