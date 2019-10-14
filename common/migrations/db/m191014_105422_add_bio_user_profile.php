<?php

use yii\db\Migration;

/**
 * Class m191014_105422_add_bio_user_profile
 */
class m191014_105422_add_bio_user_profile extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            ALTER TABLE `user_profile` ADD COLUMN `bio` text DEFAULT NULL;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191014_105422_add_bio_user_profile cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191014_105422_add_bio_user_profile cannot be reverted.\n";

        return false;
    }
    */
}
