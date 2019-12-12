<?php

use yii\db\Migration;

/**
 * Class m191211_155908_user_profile_sector_id
 */
class m191211_155908_user_profile_sector_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(
            "ALTER TABLE `user_profile`
                ADD COLUMN `sector_id` int(11) NOT NULL after `organization_id`"
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191211_155908_user_profile_sector_id cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191211_155908_user_profile_sector_id cannot be reverted.\n";

        return false;
    }
    */
}
