<?php

use yii\db\Migration;

/**
 * Class m200428_103138_SessionTBL
 */
class m200428_103138_SessionTBL extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `session`
-- ----------------------------
DROP TABLE IF EXISTS `session`;
CREATE TABLE `session` (
  `id` char(40) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of session
-- ----------------------------
        ");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200428_103138_SessionTBL cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200428_103138_SessionTBL cannot be reverted.\n";

        return false;
    }
    */
}
