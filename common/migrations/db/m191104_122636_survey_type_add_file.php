<?php

use yii\db\Migration;

/**
 * Class m191104_122636_survey_type_add_file
 */
class m191104_122636_survey_type_add_file extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            INSERT INTO `survey_type` (survey_type_id,survey_type_name,survey_type_descr,survey_type_name_ar,survey_type_descr_ar,status)VALUES ('11', 'File', 'Ask your respondent to attach file answers.','ملف','اطلب من المستفتى إرفاق الاجابة علي هيئة ملف','1');
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191104_122636_survey_type_add_file cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191104_122636_survey_type_add_file cannot be reverted.\n";

        return false;
    }
    */
}
