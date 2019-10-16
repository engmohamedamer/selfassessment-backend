<?php

use yii\db\Migration;

/**
 * Class m191016_134353_organization_slug
 */
class m191016_134353_organization_slug extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            ALTER TABLE `organization`
            ADD COLUMN `slug` varchar(150) NOT NULL AFTER `name`;
        ");
    }  

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191016_134353_organization_slug cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191016_134353_organization_slug cannot be reverted.\n";

        return false;
    }
    */
}
