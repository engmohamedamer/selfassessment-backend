<?php

namespace backend\models;

use Yii;
use \backend\models\base\City as BaseCity;

/**
 * This is the model class for table "city".
 */
class City extends BaseCity
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['title'], 'required'],
            [['sort'], 'integer'],
            [['ref', 'title', 'slug'], 'string', 'max' => 255]
        ]);
    }
	
}
