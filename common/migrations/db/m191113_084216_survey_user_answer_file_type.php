<?php

use yii\db\Migration;

/**
 * Class m191113_084216_survey_user_answer_file_type
 */
class m191113_084216_survey_user_answer_file_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            ALTER TABLE `survey_user_answer`
            ADD COLUMN `survey_user_answer_file_type` varchar(255) DEFAULT NULL;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191113_084216_survey_user_answer_file_type cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191113_084216_survey_user_answer_file_type cannot be reverted.\n";

        return false;
    }
    */
}
