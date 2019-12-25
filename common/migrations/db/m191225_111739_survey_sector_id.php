<?php

use yii\db\Migration;

/**
 * Class m191225_111739_survey_sector_id
 */
class m191225_111739_survey_sector_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            ALTER TABLE `survey`
            ADD COLUMN `sector_id` int DEFAULT NULL;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191225_111739_survey_sector_id cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191225_111739_survey_sector_id cannot be reverted.\n";

        return false;
    }
    */
}
