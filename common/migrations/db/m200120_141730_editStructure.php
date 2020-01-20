<?php

use yii\db\Migration;

/**
 * Class m200120_141730_editStructure
 */
class m200120_141730_editStructure extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        ALTER TABLE `organization_structure`
ADD COLUMN `organization_id`  int UNSIGNED NULL AFTER `child_allowed`;
        ");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200120_141730_editStructure cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200120_141730_editStructure cannot be reverted.\n";

        return false;
    }
    */
}
