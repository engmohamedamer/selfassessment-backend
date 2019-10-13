<?php

use yii\db\Migration;

/**
 * Class m191010_145650_organization
 */
class m191010_145650_organization extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            -- ----------------------------
            -- Table structure for `organization`
            -- ----------------------------
            DROP TABLE IF EXISTS `organization`;
            CREATE TABLE `organization` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(150) DEFAULT NULL,
              `business_sector` varchar(100) DEFAULT NULL,
              `address` varchar(255) DEFAULT NULL,
              `city_id` int(10) unsigned  NULL,
              `district_id` int(10) unsigned  NULL,
              `email` varchar(100) DEFAULT NULL,
              `phone` varchar(20) DEFAULT NULL,
              `mobile` varchar(20) DEFAULT NULL,
              `conatct_name` varchar(100) DEFAULT NULL,
              `contact_email` varchar(100) DEFAULT NULL,
              `contact_phone` varchar(20) DEFAULT NULL,
              `contact_position` varchar(100) DEFAULT NULL,
              `limit_account` int(11) DEFAULT NULL,
              `first_image_base_url` varchar(1024) DEFAULT NULL,
              `first_image_path` varchar(1024) DEFAULT NULL,
              `second_image_base_url` varchar(1024) DEFAULT NULL,
              `second_image_path` varchar(1024) DEFAULT NULL,
              `created_at` int(11) DEFAULT NULL,
              `updated_at` int(11) DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
        ");

        $this->execute("
            ALTER TABLE user_profile 
            add `organization_id` int(11) unsigned  NULL,
            add `position`  varchar(100) DEFAULT NULL,
            add `city_id` int(10) unsigned  NULL,
            add `district_id` int(10) unsigned  NULL,
            add `address`  varchar(100) DEFAULT NULL;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191010_145650_organization cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191010_145650_organization cannot be reverted.\n";

        return false;
    }
    */
}
