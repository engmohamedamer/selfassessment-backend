<?php

use yii\db\Migration;

/**
 * Class m200302_090807_ssologin_add_columns_to_organization_table
 */
class m200302_090807_ssologin_add_columns_to_organization_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        ALTER TABLE `organization`
            ADD COLUMN `sso_login` tinyint NULL DEFAULT 0 COMMENT '0 not enabled 1 enabled and active',
            ADD COLUMN `authServerUrl` varchar(255) NULL,
            ADD COLUMN `realm` varchar(255) NULL,
            ADD COLUMN `clientId` varchar(255) NULL,
            ADD COLUMN `clientSecret` varchar(255) NULL;
                
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200302_090807_ssologin_add_columns_to_organization_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200302_090807_ssologin_add_columns_to_organization_table cannot be reverted.\n";

        return false;
    }
    */
}
