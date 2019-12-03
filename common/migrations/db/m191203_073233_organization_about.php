<?php

use yii\db\Migration;

/**
 * Class m191203_073233_organization_about
 */
class m191203_073233_organization_about extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            ALTER TABLE `organization` 
                ADD COLUMN `about` text DEFAULT NULL AFTER `business_sector` ;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191203_073233_organization_about cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191203_073233_organization_about cannot be reverted.\n";

        return false;
    }
    */
}
