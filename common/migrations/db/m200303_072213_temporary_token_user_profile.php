<?php

use yii\db\Migration;

/**
 * Class m200303_072213_temporary_token_user_profile
 */
class m200303_072213_temporary_token_user_profile extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        ALTER TABLE `user_profile`
            ADD COLUMN `temporary_token_used` tinyint NULL DEFAULT 0 COMMENT '0 not enabled 1 enabled and active',
            ADD COLUMN `temporary_token` varchar(255) NULL;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200303_072213_temporary_token_user_profile cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200303_072213_temporary_token_user_profile cannot be reverted.\n";

        return false;
    }
    */
}
