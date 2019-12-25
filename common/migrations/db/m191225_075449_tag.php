<?php

use yii\db\Migration;

/**
 * Class m191225_075449_tag
 */
class m191225_075449_tag extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            SET FOREIGN_KEY_CHECKS=0;
            -- ----------------------------
            -- Table structure for `tag`
            -- ----------------------------
            DROP TABLE IF EXISTS `tag`;
            CREATE TABLE `tag` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191225_075449_tag cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191225_075449_tag cannot be reverted.\n";

        return false;
    }
    */
}
