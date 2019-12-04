<?php

use yii\db\Migration;

/**
 * Class m191204_210614_postTBL
 */
class m191204_210614_postTBL extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        SET FOREIGN_KEY_CHECKS=0;
            -- ----------------------------
            -- Table structure for `post`
            -- ----------------------------
            DROP TABLE IF EXISTS `post`;
            CREATE TABLE `post` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `title` varchar(255) NOT NULL,
              `text` text,
              `status` tinyint(4) DEFAULT NULL,
              `created_at` varchar(255) DEFAULT NULL,
              `updated_at` varchar(255) DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191204_210614_postTBL cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191204_210614_postTBL cannot be reverted.\n";

        return false;
    }
    */
}
