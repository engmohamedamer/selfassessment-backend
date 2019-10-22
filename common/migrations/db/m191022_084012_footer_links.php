<?php

use yii\db\Migration;

/**
 * Class m191022_084012_footer_links
 */
class m191022_084012_footer_links extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            -- ----------------------------
            -- Table structure for `footer_links`
            -- ----------------------------
            DROP TABLE IF EXISTS `footer_links`;
            CREATE TABLE `footer_links` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `organization_id` int(11) DEFAULT NULL,
              `name_link1` varchar(150) DEFAULT NULL,
              `link1` varchar(150) DEFAULT NULL,
              `name_link2` varchar(150) DEFAULT NULL,
              `link2` varchar(150) DEFAULT NULL,
              `name_link3` varchar(150) DEFAULT NULL,
              `link3` varchar(150) DEFAULT NULL,
              `name_link4` varchar(150) DEFAULT NULL,
              `link4` varchar(150) DEFAULT NULL,
              `name_link5` varchar(150) DEFAULT NULL,
              `link5` varchar(150) DEFAULT NULL,
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
        echo "m191022_084012_footer_links cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191022_084012_footer_links cannot be reverted.\n";

        return false;
    }
    */
}
