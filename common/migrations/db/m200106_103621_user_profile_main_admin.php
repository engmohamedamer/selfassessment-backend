<?php

use yii\db\Migration;

/**
 * Class m200106_103621_user_profile_main_admin
 */
class m200106_103621_user_profile_main_admin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            ALTER TABLE `user_profile` ADD COLUMN `main_admin` tinyint(1) DEFAULT '0';
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200106_103621_user_profile_main_admin cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200106_103621_user_profile_main_admin cannot be reverted.\n";

        return false;
    }
    */
}
