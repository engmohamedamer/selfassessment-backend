<?php

use yii\db\Migration;

/**
 * Class m191030_092737_survey_info
 */
class m191030_092737_survey_info extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            ALTER TABLE `survey`
            ADD COLUMN `start_info` text;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191030_092737_survey_info cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191030_092737_survey_info cannot be reverted.\n";

        return false;
    }
    */
}
