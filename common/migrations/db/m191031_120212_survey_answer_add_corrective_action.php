<?php

use yii\db\Migration;

/**
 * Class m191031_120212_survey_answer_add_corrective_action
 */
class m191031_120212_survey_answer_add_corrective_action extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            ALTER TABLE `survey_answer`
            ADD COLUMN `survey_answer_show_corrective_action` tinyint(1) DEFAULT '0',
            ADD COLUMN `survey_answer_corrective_action` text COLLATE utf8_unicode_ci;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191031_120212_survey_answer_add_corrective_action cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191031_120212_survey_answer_add_corrective_action cannot be reverted.\n";

        return false;
    }
    */
}
