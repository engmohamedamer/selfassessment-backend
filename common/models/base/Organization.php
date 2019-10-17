<?php

namespace common\models\base;

use Yii;
use common\models\UserProfile;
use trntv\filekit\behaviors\UploadBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base model class for table "organization".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $business_sector
 * @property string $address
 * @property integer $city_id
 * @property integer $district_id
 * @property string $email
 * @property string $phone
 * @property string $mobile
 * @property string $conatct_name
 * @property string $contact_email
 * @property string $contact_phone
 * @property string $contact_position
 * @property integer $limit_account
 * @property string $first_image_base_url
 * @property string $first_image_path
 * @property string $second_image_base_url
 * @property string $second_image_path
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 */
class Organization extends \yii\db\ActiveRecord
{

    public $first_image;
    public $second_image;

    const STATUS_NOT_ACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public function relationNames()
    {
        return [
            'organizationTheme'
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id', 'district_id', 'limit_account'], 'integer'],
            ['name', 'string', 'max' => 150],
            [['business_sector', 'email', 'conatct_name', 'contact_email', 'contact_position'], 'string', 'max' => 100],
            [['address','slug'], 'string', 'max' => 255],
            [['phone', 'mobile', 'contact_phone'], 'string', 'max' => 20],
            [['first_image','second_image','status'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => date('now'),
            ],
            [
                'class' => UploadBehavior::class,
                'attribute' => 'first_image',
                'pathAttribute' => 'first_image_path',
                'baseUrlAttribute' => 'first_image_base_url',
            ],
            [
                'class' => UploadBehavior::class,
                'attribute' => 'second_image',
                'pathAttribute' => 'second_image_path',
                'baseUrlAttribute' => 'second_image_base_url',
            ],
            'slug' => [
                'class' => SluggableBehavior::class,
                'attribute' => 'name',
                'ensureUnique' => true,
                'immutable' => true
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organization';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'name' => Yii::t('common', 'Name'),
            'business_sector' => Yii::t('common', 'Business Sector'),
            'address' => Yii::t('common', 'Address'),
            'city_id' => Yii::t('common', 'City'),
            'district_id' => Yii::t('common', 'District'),
            'email' => Yii::t('common', 'Email'),
            'phone' => Yii::t('common', 'Phone'),
            'mobile' => Yii::t('common', 'Mobile'),
            'conatct_name' => Yii::t('common', 'Conatct Name'),
            'contact_email' => Yii::t('common', 'Contact Email'),
            'contact_phone' => Yii::t('common', 'Contact Phone'),
            'contact_position' => Yii::t('common', 'Contact Position'),
            'limit_account' => Yii::t('common', 'Limit Account'),
            'first_image' => Yii::t('common', 'First Image'),
            'second_image' => Yii::t('common', 'Second Image'),
            'status' => Yii::t('common', 'Status'),
            'slug'=> Yii::t('common', 'Slug'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(\backend\models\City::className(), ['id' => 'city_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizationTheme()
    {
        return $this->hasOne(\common\models\OrganizationTheme::className(), ['organization_id' => 'id']);
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(\backend\models\District::className(), ['id' => 'district_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManager()
    {
        return $this->hasOne(UserProfile::className(), ['organization_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\OrganizationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\OrganizationQuery(get_called_class());
    }

    /**
     * Returns organization status list
     * @return array|mixed
     */
    public static function status()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('common', 'Active'),
            self::STATUS_NOT_ACTIVE => Yii::t('common', 'Not Active'),
        ];
    }
}
