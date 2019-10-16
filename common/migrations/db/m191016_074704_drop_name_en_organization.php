<?php

use yii\db\Migration;

/**
 * Class m191016_074704_drop_name_en_organization
 */
class m191016_074704_drop_name_en_organization extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            ALTER TABLE `organization` drop column `name_en`;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191016_074704_drop_name_en_organization cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191016_074704_drop_name_en_organization cannot be reverted.\n";

        return false;
    }
    */
}
