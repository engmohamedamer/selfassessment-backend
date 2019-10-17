<?php

namespace common\models;

use Yii;
use \common\models\base\OrganizationTheme as BaseOrganizationTheme;

/**
 * This is the model class for table "organization_theme".
 */
class OrganizationTheme extends BaseOrganizationTheme
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['organization_id'], 'required'],
            [['organization_id'], 'integer'],
            [['brandPrimColor', 'brandSecColor', 'brandHTextColor', 'brandPTextColor', 'brandBlackColor', 'brandGrayColor', 'arfont', 'enfont', 'facebook', 'twitter', 'linkedin', 'instagram', 'locale', 'updated_at'], 'string', 'max' => 255]
        ]);
    }
	
}
