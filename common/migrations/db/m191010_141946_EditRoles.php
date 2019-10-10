<?php

use yii\db\Migration;

/**
 * Class m191010_141946_EditRoles
 */
class m191010_141946_EditRoles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        
        INSERT INTO `rbac_auth_item` (`name`, `type`) VALUES ('governmentAdmin', '1');
INSERT INTO `rbac_auth_item` (`name`, `type`) VALUES ('governmentRep', '1');
INSERT INTO `rbac_auth_item_child` (`parent`, `child`) VALUES ('governmentAdmin', 'loginToBackend');
INSERT INTO `rbac_auth_item_child` (`parent`, `child`) VALUES ('governmentRep', 'loginToBackend');
UPDATE `rbac_auth_item` SET `description`='مسؤلى فرعى للمؤسسة', `created_at`='1552385505', `updated_at`='1552385505' WHERE (`name`='governmentRep')
UPDATE `rbac_auth_item` SET `description`='مسؤلى المؤسسة', `created_at`='1552385505', `updated_at`='1552385505' WHERE (`name`='governmentAdmin')
        ");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191010_141946_EditRoles cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191010_141946_EditRoles cannot be reverted.\n";

        return false;
    }
    */
}
