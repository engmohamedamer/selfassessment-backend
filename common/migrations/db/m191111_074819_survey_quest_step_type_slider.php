<?php

use yii\db\Migration;

/**
 * Class m191111_074819_survey_quest_step_type_slider
 */
class m191111_074819_survey_quest_step_type_slider extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            ALTER TABLE `survey_question`
            ADD COLUMN `steps` int DEFAULT NULL;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191111_074819_survey_quest_step_type_slider cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191111_074819_survey_quest_step_type_slider cannot be reverted.\n";

        return false;
    }
    */
}
