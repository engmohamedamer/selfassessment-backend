<?php

use yii\db\Migration;

/**
 * Class m191031_100123_survey_stat_add_pageNo
 */
class m191031_100123_survey_stat_add_pageNo extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            ALTER TABLE `survey_stat`
            ADD COLUMN `pageNo` int DEFAULT NULL;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191031_100123_survey_stat_add_pageNo cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191031_100123_survey_stat_add_pageNo cannot be reverted.\n";

        return false;
    }
    */
}
