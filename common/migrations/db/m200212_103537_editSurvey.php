<?php

use yii\db\Migration;

/**
 * Class m200212_103537_editSurvey
 */
class m200212_103537_editSurvey extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        ALTER TABLE `survey`
ADD COLUMN `admin_enabled`  tinyint NULL DEFAULT 0 COMMENT '0 not enabled   1 enabled and active' AFTER `sector_id`;
        
        ");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200212_103537_editSurvey cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200212_103537_editSurvey cannot be reverted.\n";

        return false;
    }
    */
}
