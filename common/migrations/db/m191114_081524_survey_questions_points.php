<?php

use yii\db\Migration;

/**
 * Class m191114_081524_survey_questions_points
 */
class m191114_081524_survey_questions_points extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            ALTER TABLE `survey_question`
            ADD COLUMN `survey_question_point` int DEFAULT NULL;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191114_081524_survey_questions_points cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191114_081524_survey_questions_points cannot be reverted.\n";

        return false;
    }
    */
}
