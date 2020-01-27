<?php

use yii\db\Migration;

/**
 * Class m191225_125418_survey_selected_sectors
 */
class m191225_125418_survey_selected_sectors extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            -- ----------------------------
            -- Table structure for `survey_selected_sectors`
            -- ----------------------------
            DROP TABLE IF EXISTS `survey_selected_sectors`;
            CREATE TABLE `survey_selected_sectors` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `survey_id` int(10) unsigned DEFAULT NULL,
              `sector_id` int(10) unsigned DEFAULT NULL,
              PRIMARY KEY (`id`),
              KEY `fk_survey_selected_sectors_survey_id` (`survey_id`),
              KEY `fk_survey_selected_sectors_sector_idx` (`sector_id`),
            CONSTRAINT `fk_survey_selected_sectors_survey_id` FOREIGN KEY (`survey_id`) REFERENCES `survey` (`survey_id`) ON DELETE CASCADE ON UPDATE CASCADE,
              CONSTRAINT `fk_survey_selected_sectors_id` FOREIGN KEY (`sector_id`) REFERENCES `organization_structure` (`id`) ON DELETE  cascade ON UPDATE  cascade
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191225_125418_survey_selected_sectors cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191225_125418_survey_selected_sectors cannot be reverted.\n";

        return false;
    }
    */
}
