<?php

use yii\db\Migration;

/**
 * Class m191212_092300_survey_questio_can_ignore
 */
class m191212_092300_survey_questio_can_ignore extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            ALTER TABLE `survey_question`
            ADD COLUMN `survey_question_can_ignore` tinyint(1) DEFAULT '0';
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191212_092300_survey_questio_can_ignore cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191212_092300_survey_questio_can_ignore cannot be reverted.\n";

        return false;
    }
    */
}
