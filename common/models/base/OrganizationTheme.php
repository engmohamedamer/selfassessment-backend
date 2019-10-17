<?php

namespace common\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "organization_theme".
 *
 * @property integer $organization_id
 * @property string $brandPrimColor
 * @property string $brandSecColor
 * @property string $brandHTextColor
 * @property string $brandPTextColor
 * @property string $brandBlackColor
 * @property string $brandGrayColor
 * @property string $arfont
 * @property string $enfont
 * @property string $facebook
 * @property string $twitter
 * @property string $linkedin
 * @property string $instagram
 * @property string $locale
 * @property string $updated_at
 *
 * @property \common\models\Organization $organization
 */
class OrganizationTheme extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;


    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'organization'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['organization_id'], 'required'],
            [['organization_id'], 'integer'],
            [['brandPrimColor', 'brandSecColor', 'brandHTextColor', 'brandPTextColor', 'brandBlackColor', 'brandGrayColor', 'arfont', 'enfont', 'facebook', 'twitter', 'linkedin', 'instagram', 'locale', 'updated_at'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organization_theme';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'organization_id' => Yii::t('app', 'Organization ID'),
            'brandPrimColor' => Yii::t('app', 'Brand Prim Color'),
            'brandSecColor' => Yii::t('app', 'Brand Sec Color'),
            'brandHTextColor' => Yii::t('app', 'Brand H Text Color'),
            'brandPTextColor' => Yii::t('app', 'Brand P Text Color'),
            'brandBlackColor' => Yii::t('app', 'Brand Black Color'),
            'brandGrayColor' => Yii::t('app', 'Brand Gray Color'),
            'arfont' => Yii::t('app', 'Arfont'),
            'enfont' => Yii::t('app', 'Enfont'),
            'facebook' => Yii::t('app', 'Facebook'),
            'twitter' => Yii::t('app', 'Twitter'),
            'linkedin' => Yii::t('app', 'Linkedin'),
            'instagram' => Yii::t('app', 'Instagram'),
            'locale' => Yii::t('app', 'Locale'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(\common\models\Organization::className(), ['id' => 'organization_id']);
    }
    
    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => false,
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }


    /**
     * @inheritdoc
     * @return \common\models\query\OrganizationThemeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\OrganizationThemeQuery(get_called_class());
    }
}
