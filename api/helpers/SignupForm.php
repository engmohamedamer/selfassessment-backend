<?php

namespace api\helpers;

use Yii;
use common\models\User;
use common\models\UserProfile;
use yii\base\Exception;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Create user form
 */
class SignupForm extends Model
{
    public $name;
    public $email;
    public $password;
    public $bio;
    public $mobile;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','password','email','bio','mobile'], 'required'],
            ['name', 'string', 'min' => 2, 'max' => 255],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::class],
            ['password', 'string', 'min' => 6],
            ['mobile', 'match', 'pattern' => '/^(009665|9665|\+9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$/' ,'message'=>Yii::t('common','Enter valid phone')],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('common', 'Username'),
            'email' => Yii::t('common', 'Email'),
            'status' => Yii::t('common', 'Status'),
            'password' => Yii::t('common', 'Password'),
            'name' => Yii::t('common', 'Name'),
            'mobile' => Yii::t('common', 'Mobile'),
        ];
    }

    /**
     * Signs user up.
     * @return User|null the saved model or null if saving fails
     * @throws Exception
     */
    public function save($organization)
    {
        if ($this->validate()) {
            $model = new User();
            $model->username = $this->email;
            $model->email = $this->email;
            $model->status = User::STATUS_ACTIVE;
            if ($this->password) {
                $model->setPassword($this->password);
            }

            if (!$model->save()) {
                throw new Exception('Model not saved');
            }
            $profile = new UserProfile();
        	$profile->firstname = $this->name;
        	$profile->user_id = $model->id;
        	$profile->organization_id = $organization;
        	$profile->mobile = $this->mobile;
        	$profile->bio = $this->bio;
        	$profile->locale = 'ar-AR';
        	$profile->save(false);
            $auth = Yii::$app->authManager;
            $auth->revokeAll($model->getId());
            $auth->assign($auth->getRole(User::ROLE_USER), $model->getId());
            return $model;
        }
        return null;
    }
}