<?php

namespace common\models;

use backend\models\Schools;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_profile".
 *
 * @property integer $user_id
 * @property integer $locale
 * @property string $firstname
 * @property string $middlename
 * @property string $lastname
 * @property string $picture
 * @property string $avatar
 * @property string $avatar_path
 * @property string $avatar_base_url
 * @property integer $gender
 * @property string $device_token
 *
 * @property User $user
 */
class UserProfile extends ActiveRecord
{
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    const STATUS_DRAFT = 1;
    const STATUS_ACTIVE = 2;

    const SCENARIO_VALIDATE = 'validate';
    /**
     * @var
     */
    public $picture;
    public $full_name;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_profile}}';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'picture' => [
                'class' => UploadBehavior::class,
                'attribute' => 'picture',
                'pathAttribute' => 'avatar_path',
                'baseUrlAttribute' => 'avatar_base_url'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id','firstname'], 'required'],
            [['user_id', 'gender','school_id','draft'], 'integer'],
            [['gender'], 'in', 'range' => [NULL, self::GENDER_FEMALE, self::GENDER_MALE]],
            [['firstname', 'middlename', 'lastname', 'avatar_path', 'avatar_base_url','mobile','device_token'], 'string', 'max' => 255],
            ['locale', 'default', 'value' => Yii::$app->language],
            ['locale', 'in', 'range' => array_keys(Yii::$app->params['availableLocales'])],
            [['picture','nationality_id','specialization_id','job','activity','active'], 'safe'],
            [['nationality_id','specialization_id','job','activity','mobile'],'required', 'on'=>self::SCENARIO_VALIDATE],
            ['firstname','required','message' => 'full_name يجب ادخاله', 'on'=>self::SCENARIO_VALIDATE],
            [['nationality_id','specialization_id'],'integer','min'=>1,'on'=>self::SCENARIO_VALIDATE],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('common', 'User ID'),
            'firstname' => Yii::t('common', 'Firstname'),
            'middlename' => Yii::t('common', 'Middlename'),
            'lastname' => Yii::t('common', 'Lastname'),
            'locale' => Yii::t('common', 'Locale'),
            'picture' => Yii::t('common', 'Picture'),
            'gender' => Yii::t('common', 'Gender'),
            'school_id'=> Yii::t('common', 'School Admin'),
            'mobile'=> Yii::t('common', 'Mobile'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }


    public function getSchool()
    {
        return $this->hasOne(Schools::class, ['owner_id' => 'user_id']);
    }

    public function getMySchool()
    {
        return $this->hasOne(Schools::class, ['id' => 'school_id']);
    }


    /**
     * @return null|string
     */
    public function getFullName()
    {
        if ($this->firstname || $this->lastname) {
            return implode(' ', [$this->firstname, $this->lastname]);
        }
        return null;
    }


    /**
     * @param null $default
     * @return bool|null|string
     */
    public function getAvatar($default = null)
    {
        return $this->avatar_path
            ? Yii::getAlias($this->avatar_base_url . '/' . $this->avatar_path)
            : $default;
    }


    public static function ListNationalities()
    {
        return [
            [
                "id"=>1,
                "label"=>"سعودي"
            ],
            [
                "id"=>2,
                "label"=>"مصري"
            ],
            [
                "id"=>3,
                "label"=>"لبناني"
            ],
            [
                "id"=>4,
                "label"=>"باكستاني"
            ],
            [
                "id"=>5,
                "label"=>"هندي"
            ],
            [
                "id"=>5,
                "label"=>"بنغالي"
            ],
        ];
    }

    public static function ListSpecialization()
    {
        return [
            [
                "id"=>1,
                "label"=>"لغة انجليزية"
            ],
            [
                "id"=>2,
                "label"=>"رياضيات ابتدائي"
            ],
            [
                "id"=>3,
                "label"=>"دراسات اجتماعية"
            ],
            [
                "id"=>4,
                "label"=>"لغة عربية"
            ],
            [
                "id"=>5,
                "label"=>"معلم فصل"
            ],
            [
                "id"=>5,
                "label"=>"رياض اطفال"
            ],
        ];
    }
    
}
