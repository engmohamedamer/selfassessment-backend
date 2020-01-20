<?php

use yii\db\Migration;

/**
 * Class m200119_120007_notification
 */
class m200119_120007_notification extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE `notification` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `from` int(11) DEFAULT NULL,
                `user_id` int(11) NOT NULL,
                `module` varchar(255) DEFAULT NULL,
                `module_id` int(11) DEFAULT NULL,
                `message` varchar(500) NOT NULL,
                `title` varchar(255) DEFAULT NULL,
                `status` tinyint(4) DEFAULT NULL,
                `created_at` datetime DEFAULT NULL,
                `updated_at` datetime DEFAULT NULL,
                PRIMARY KEY (`id`),
                KEY `fromField` (`from`),
                KEY `UserField` (`user_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200119_120007_notification cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200119_120007_notification cannot be reverted.\n";

        return false;
    }
    */
}
