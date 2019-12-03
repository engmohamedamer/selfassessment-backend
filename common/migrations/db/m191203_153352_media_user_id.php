<?php

use yii\db\Migration;

/**
 * Class m191203_153352_media_user_id
 */
class m191203_153352_media_user_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(
            "ALTER TABLE `media`
                ADD COLUMN `user_id` int(11) NOT NULL after `created_at`"
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191203_153352_media_user_id cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191203_153352_media_user_id cannot be reverted.\n";

        return false;
    }
    */
}
