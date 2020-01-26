<?php

use yii\db\Migration;

/**
 * Class m200126_123033_organization_allow_registeration
 */
class m200126_123033_organization_allow_registeration extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        ALTER TABLE `organization`
            ADD COLUMN `allow_registration`  tinyint(1)  DEFAULT 0 AFTER `status`;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200126_123033_organization_allow_registeration cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200126_123033_organization_allow_registeration cannot be reverted.\n";

        return false;
    }
    */
}
