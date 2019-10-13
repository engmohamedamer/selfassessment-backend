<?php

namespace organization\models\activequery;

/**
 * This is the ActiveQuery class for [[\organization\models\activequery\UserAttachment]].
 *
 * @see \organization\models\activequery\UserAttachment
 */
class UserAttachmentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \organization\models\activequery\UserAttachment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \organization\models\activequery\UserAttachment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
