<?php

use yii\db\Migration;

/**
 * Class m191225_102406_survey_tag
 */
class m191225_102406_survey_tag extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            SET FOREIGN_KEY_CHECKS=0;
            -- ----------------------------
            -- Table structure for `survey_tag`
            -- ----------------------------
            DROP TABLE IF EXISTS `survey_tag`;
            CREATE TABLE `survey_tag` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `survey_id` int(10) unsigned DEFAULT NULL,
              `tag_id` int(11) DEFAULT NULL,
              `ord` int DEFAULT NULL,
              PRIMARY KEY (`id`),
              KEY `fk_survey_tag_survey_id` (`survey_id`),
              KEY `fk_survey_tag_tag_idx` (`tag_id`),
            CONSTRAINT `fk_survet_tag_survey` FOREIGN KEY (`survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `fk_survey_tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE  cascade ON UPDATE  cascade
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191225_102406_survey_tag cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191225_102406_survey_tag cannot be reverted.\n";

        return false;
    }
    */
}
