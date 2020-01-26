<?php

use yii\db\Migration;

/**
 * Class m200126_122249_update_survey_type_comment_box_ar
 */
class m200126_122249_update_survey_type_comment_box_ar extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
         UPDATE `survey_type` SET `survey_type_name_ar` = 'نص كبير' WHERE `survey_type_id` =8 ;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200126_122249_update_survey_type_comment_box_ar cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200126_122249_update_survey_type_comment_box_ar cannot be reverted.\n";

        return false;
    }
    */
}
