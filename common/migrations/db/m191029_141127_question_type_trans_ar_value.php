<?php

use yii\db\Migration;

/**
 * Class m191029_141127_question_type_trans_ar_value
 */
class m191029_141127_question_type_trans_ar_value extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            UPDATE `survey_type` set `survey_type_name_ar` = 'متعدد الخيارات', status = 1 where survey_type_id = 1; 
            UPDATE `survey_type` set `survey_type_name_ar` = 'خيار واحد من القائمة', status = 1  where survey_type_id = 2; 
            UPDATE `survey_type` set `survey_type_name_ar` = 'اختيار من قائمة' where survey_type_id = 3; 
            UPDATE `survey_type` set `survey_type_name_ar` = 'تصنيف' where survey_type_id = 4; 
            UPDATE `survey_type` set `survey_type_name_ar` = 'Slider' where survey_type_id = 5; 
            UPDATE `survey_type` set `survey_type_name_ar` = 'إضافة نص ألاجابة' , status = 1 where survey_type_id = 6; 
            UPDATE `survey_type` set `survey_type_name_ar` = 'مربعات النص متعددة' where survey_type_id = 7; 
            UPDATE `survey_type` set `survey_type_name_ar` = 'صندوق التعليقات' where survey_type_id = 8; 
            UPDATE `survey_type` set `survey_type_name_ar` = 'تاريخ / وقت' where survey_type_id = 9; 
            UPDATE `survey_type` set `survey_type_name_ar` = 'التقويم' where survey_type_id = 10; 
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191029_141127_question_type_trans_ar_value cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191029_141127_question_type_trans_ar_value cannot be reverted.\n";

        return false;
    }
    */
}
