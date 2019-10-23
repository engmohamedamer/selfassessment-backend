<?php

namespace common\models;

use Yii;
use \common\models\base\FooterLinks as BaseFooterLinks;

/**
 * This is the model class for table "footer_links".
 */
class FooterLinks extends BaseFooterLinks
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['created_at', 'updated_at'], 'integer'],
            [['name_link1', 'link1', 'name_link2', 'link2', 'name_link3', 'link3', 'name_link4', 'link4', 'name_link5', 'link5'], 'string', 'max' => 150]
        ]);
    }
	
}
