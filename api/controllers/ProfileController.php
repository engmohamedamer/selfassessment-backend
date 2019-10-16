<?php

namespace api\controllers;

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

        if($profile->save() && $user->save()){
            return ['status'=>1 , 'profile'=>$user ];
        }else{
            return ['status'=>0 , 'message'=>'Invalid Data','errors'=> array_merge($profile->errors,$user->errors) ];
        }
    }


    public function actionImage()
    {
        $params = \Yii::$app->request->post();

        if (empty($params['image'])) {
            return  ['status'=>0, 'message'=>'image required'] ;
        }
        
        $user = User::findOne(['id'=> \Yii::$app->user->identity->getId()])->userProfile;
        $filename = $this->Base64IMageConverter($params['image']);
        $path = \Yii::getAlias('@storageUrl'). '/web/source/'.$upPath;
        $user->avatar_path = 'profile/'.$filename;
        $user->avatar_base_url= $path;
        if(!$user->save(false)){
            return $user->errors;
        }
        return  ['status'=>1, 'profile'=>$user] ;
    }

    public static function Base64IMageConverter($binary , $upPath='profile'){

        $path = \Yii::getAlias('@storage'). '/web/source/'.$upPath;
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $imageName = "img-". (intval(time()) + rand(1,100000) ).".jpeg";

        $directory= $path.'/'.$imageName;


        $entry = base64_decode($binary);
        $image = imagecreatefromstring($entry);

        header ( 'Content-type:image/jpeg' );

        imagejpeg($image, $directory);

        imagedestroy ( $image );

        if(file_exists($directory)){
            return $imageName;
        }else{
            return false;
        }
    }

}