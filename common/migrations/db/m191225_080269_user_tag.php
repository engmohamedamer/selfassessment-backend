<?php

use yii\db\Migration;

/**
 * Class m191225_080269_user_tag
 */
class m191225_080269_user_tag extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            SET FOREIGN_KEY_CHECKS=0;
            -- ----------------------------
            -- Table structure for `user_tag`
            -- ----------------------------
            DROP TABLE IF EXISTS `user_tag`;
            CREATE TABLE `user_tag` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `user_id` int(11) DEFAULT NULL,
              `tag_id` int(11) DEFAULT NULL,
              `ord` int DEFAULT NULL,
              PRIMARY KEY (`id`),
              KEY `fk_user_idx` (`user_id`),
              KEY `fk_tag_idx` (`tag_id`),
              CONSTRAINT `fk_tag_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE  cascade ON UPDATE  cascade,
              CONSTRAINT `fk_tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE  cascade ON UPDATE  cascade
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191225_080269_user_tag cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191225_080269_user_tag cannot be reverted.\n";

        return false;
    }
    */
}
