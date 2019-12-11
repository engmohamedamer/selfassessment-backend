<?php

use yii\db\Migration;

/**
 * Class m191211_140215_organization_structure
 */
class m191211_140215_organization_structure extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            -- ----------------------------
            -- Table structure for `organization_structure`
            -- ----------------------------
            DROP TABLE IF EXISTS `organization_structure`;
            CREATE TABLE `organization_structure` (
              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique tree node identifier',
              `root` int(11) DEFAULT NULL COMMENT 'Tree root identifier',
              `lft` int(11) NOT NULL COMMENT 'Nested set left property',
              `rgt` int(11) NOT NULL COMMENT 'Nested set right property',
              `lvl` smallint(5) NOT NULL COMMENT 'Nested set level / depth',
              `name` varchar(60) NOT NULL COMMENT 'The tree node name / label',
              `icon` varchar(255) DEFAULT NULL COMMENT 'The icon to use for the node',
              `icon_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Icon Type: 1 = CSS Class, 2 = Raw Markup',
              `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is active (will be set to false on deletion)',
              `selected` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is selected/checked by default',
              `disabled` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is enabled',
              `readonly` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is read only (unlike disabled - will allow toolbar actions)',
              `visible` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is visible',
              `collapsed` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is collapsed by default',
              `movable_u` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is movable one position up',
              `movable_d` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is movable one position down',
              `movable_l` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is movable to the left (from sibling to parent)',
              `movable_r` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is movable to the right (from sibling to child)',
              `removable` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether the node is removable (any children below will be moved as siblings before deletion)',
              `removable_all` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Whether the node is removable along with descendants',
              `child_allowed` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Whether to allow adding children to the node',
              PRIMARY KEY (`id`),
              KEY `tbl_tree_NK1` (`root`) USING BTREE,
              KEY `tbl_tree_NK2` (`lft`) USING BTREE,
              KEY `tbl_tree_NK3` (`rgt`) USING BTREE,
              KEY `tbl_tree_NK4` (`lvl`) USING BTREE,
              KEY `tbl_tree_NK5` (`active`) USING BTREE
            ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191211_140215_organization_structure cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191211_140215_organization_structure cannot be reverted.\n";

        return false;
    }
    */
}
