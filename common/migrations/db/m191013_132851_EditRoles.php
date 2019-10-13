<?php

use yii\db\Migration;

/**
 * Class m191013_132851_EditRoles
 */
class m191013_132851_EditRoles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
INSERT INTO `rbac_auth_item` (`name`, `type`) VALUES ('loginToOrganization', '2');
UPDATE `rbac_auth_item_child` SET `child`='loginToOrganization' WHERE (`parent`='governmentAdmin') AND (`child`='loginToBackend');

UPDATE `rbac_auth_item_child` SET `child`='loginToOrganization' WHERE (`parent`='governmentRep') AND (`child`='loginToBackend');        ");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191013_132851_EditRoles cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191013_132851_EditRoles cannot be reverted.\n";

        return false;
    }
    */
}
