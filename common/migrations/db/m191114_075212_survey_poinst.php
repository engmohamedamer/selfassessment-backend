<?php

use yii\db\Migration;

/**
 * Class m191114_075212_survey_poinst
 */
class m191114_075212_survey_poinst extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            ALTER TABLE `survey`
            ADD COLUMN `survey_point` int DEFAULT NULL;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191114_075212_survey_poinst cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191114_075212_survey_poinst cannot be reverted.\n";

        return false;
    }
    */
}
