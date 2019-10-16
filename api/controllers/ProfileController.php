<?php

namespace api\controllers;

use api\helpers\ImageHelper;
use api\helpers\ResponseHelper;
use api\resources\User;


class ProfileController extends  MyActiveController
{
    public $modelClass = User::class;

    public function actions(){
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['update']);
        return $actions;
    }

    public function actionIndex(){
        $params = \Yii::$app->request->post();
        $user= User::findOne(['id'=> \Yii::$app->user->identity->getId()]) ;

        return  ['status'=>1, 'profile'=>$user] ;
    }

    public function actionUpdate(){
        $params = \Yii::$app->request->post();

        $user = User::findOne(['id'=> \Yii::$app->user->identity->getId()]) ;
        $user->setScenario(\common\models\User::SCENARIO_VALIDATE);
        $profile = $user->userProfile;

        if (isset($params['firstname'])) $profile->firstname = $params['firstname'] ;
        if (isset($params['lastname'])) $profile->lastname = $params['lastname'] ;
        if (isset($params['bio'])) $profile->bio= $params['bio'] ;
        if (isset($params['device_token'])) $profile->device_token= $params['device_token'] ;
        if (isset($params['email'])) $user->email= $params['email'] ;
        if (isset($params['password'])) $user->setPassword($params['password']);

        if(isset($params['mobile'])){
            $profile->mobile = $params['mobile'];
        }

        if (isset($params['image']) and !empty($params['image'])) {
            $userProfile = User::findOne(['id'=> \Yii::$app->user->identity->getId()])->userProfile;
            $filename = ImageHelper::Base64IMageConverter($params['image'],'profile');
            $path = \Yii::getAlias('@storageUrl'). '/source/';
            $userProfile->avatar_path = 'profile/'.$filename;
            $userProfile->avatar_base_url= $path;
            $userProfile->save(false);
        }

        if($profile->save() && $user->save()){
            $user = User::findOne(['id'=> \Yii::$app->user->identity->getId()]) ;
            return ['status'=>1 , 'profile'=>$user ];
        }else{
            return ['status'=>0 , 'message'=>'Invalid Data','errors'=> array_merge($profile->errors,$user->errors) ];
        }
    }
}