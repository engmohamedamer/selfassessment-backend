<?php

use yii\db\Migration;

/**
 * Class m191110_140829_media
 */
class m191110_140829_media extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE `media` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `path` varchar(255) NOT NULL,
              `base_url` varchar(255) DEFAULT NULL,
              `type` varchar(255) DEFAULT NULL,
              `size` int(11) DEFAULT NULL,
              `name` varchar(255) DEFAULT NULL,
              `created_at` int(11) DEFAULT NULL,
              `order` int(11) DEFAULT NULL,
              `meta` varchar(255) DEFAULT NULL,
              `deleted_by` varchar(255) DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191110_140829_media cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191110_140829_media cannot be reverted.\n";

        return false;
    }
    */
}
