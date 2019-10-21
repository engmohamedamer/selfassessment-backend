<?php

use yii\db\Migration;

/**
 * Class m191021_101937_pages_table
 */
class m191021_101937_pages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            -- ----------------------------
            -- Table structure for `pages`
            -- ----------------------------
            DROP TABLE IF EXISTS `pages`;
            CREATE TABLE `pages` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `organization_id` int(11) NOT NULL,
              `name` varchar(150) NOT NULL,
              `link` varchar(150) NOT NULL,
              `created_at` int(11) DEFAULT NULL,
              `updated_at` int(11) DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191021_101937_pages_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191021_101937_pages_table cannot be reverted.\n";

        return false;
    }
    */
}
