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
            [['organization_id','brandPrimColor','brandSecColor'], 'required'],
            [['organization_id'], 'integer'],
            [['brandPrimColor', 'brandSecColor', 'brandHTextColor', 'brandPTextColor', 'brandBlackColor', 'brandGrayColor', 'arfont', 'enfont', 'facebook', 'twitter', 'linkedin', 'instagram', 'locale', 'updated_at'], 'string', 'max' => 255],
            [['brandPrimColor', 'brandSecColor', 'brandHTextColor', 'brandPTextColor', 'brandBlackColor', 'brandGrayColor'], 'match', 'pattern' => '/^#([0-9a-f]{6}|[0-9a-f]{3})$/' ,'message'=>Yii::t('common','Enter valid color')],
            
            ['facebook', 'match', 'pattern' => '/^(?:https?:\/\/)?(?:www\.)?facebook\.com\/.(?:(?:\w)*#!\/)?(?:pages\/)?(?:[\w\-]*\/)*([\w\-\.]*)$/' ,'message'=>Yii::t('common','Enter valid facebook link')],
            ['twitter', 'match', 'pattern' => '/^(?:http:\/\/)?(?:www\.)?twitter\.com\/(?:(?:\w)*#!\/)?(?:pages\/)?(?:[\w\-]*\/)*([\w\-]*)$/' ,'message'=>Yii::t('common','Enter valid twitter link')],
            ['instagram', 'match', 'pattern' => '/(?:(?:http|https):\/\/)?(?:www.)?(?:instagram.com|instagr.am)\/([A-Za-z0-9-_]+)/im' ,'message'=>Yii::t('common','Enter valid instagram link')],
            ['linkedin', 'match', 'pattern' => '/^(http(s)?:\/\/)?([\w]+\.)?linkedin\.com\/(pub|in|profile)$/' ,'message'=>Yii::t('common','Enter valid linkedin link')],

        ]);
    }
	
}
