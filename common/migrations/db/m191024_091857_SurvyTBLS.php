<?php

use yii\db\Migration;

/**
 * Class m191024_091857_SurvyTBLS
 */
class m191024_091857_SurvyTBLS extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql=file_get_contents(__DIR__ . '/sql/survey.sql');
        $this->execute($sql);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191024_091857_SurvyTBLS cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191024_091857_SurvyTBLS cannot be reverted.\n";

        return false;
    }
    */
}
