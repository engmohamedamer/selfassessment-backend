<?php

use yii\db\Migration;

/**
 * Class m191029_140751_question_type_trans
 */
class m191029_140751_question_type_trans extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            ALTER TABLE `survey_type`
            ADD COLUMN `survey_type_name_ar` varchar(150) NULL AFTER `survey_type_name`,
            ADD COLUMN `survey_type_descr_ar` varchar(150) NULL AFTER `survey_type_descr`,
            ADD COLUMN `status` int NULL,
            ADD COLUMN `sort` int NULL;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191029_140751_question_type_trans cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191029_140751_question_type_trans cannot be reverted.\n";

        return false;
    }
    */
}
