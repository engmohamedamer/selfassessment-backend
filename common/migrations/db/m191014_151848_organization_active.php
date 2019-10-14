<?php

use yii\db\Migration;

/**
 * Class m191014_151848_organization_active
 */
class m191014_151848_organization_active extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            ALTER TABLE `organization` ADD COLUMN `status` smallint(6) NOT NULL DEFAULT '1',
            ADD COLUMN `name_en` varchar(150) NOT NULL AFTER `name`;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191014_151848_organization_active cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191014_151848_organization_active cannot be reverted.\n";

        return false;
    }
    */
}
