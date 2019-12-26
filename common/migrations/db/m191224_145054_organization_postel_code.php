<?php

use yii\db\Migration;

/**
 * Class m191224_145054_organization_postel_code
 */
class m191224_145054_organization_postel_code extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            ALTER TABLE `organization`
            ADD COLUMN `postalbox` varchar(15) DEFAULT NULL,
            ADD COLUMN `postalcode` varchar(15) DEFAULT NULL;
        ");
    }   

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191224_145054_organization_postel_code cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191224_145054_organization_postel_code cannot be reverted.\n";

        return false;
    }
    */
}
