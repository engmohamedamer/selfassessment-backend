<?php

namespace organization\models\activequery;

/**
 * This is the ActiveQuery class for [[\organization\models\activequery\Tree]].
 *
 * @see \organization\models\activequery\Tree
 */
class TreeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \organization\models\activequery\Tree[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \organization\models\activequery\Tree|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
