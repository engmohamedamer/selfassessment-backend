<?php

namespace api\controllers;

use Yii;
use api\helpers\ResponseHelper;
use api\helpers\SignupForm;
use api\resources\User;
use common\models\Organization;
use common\models\UserProfile;
use organization\models\UserForm;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class UserController extends  RestController
{



    public function actionLogin(){
        $params = \Yii::$app->request->post();

        $user = User::find()
            ->active()
            ->andWhere(['or', ['username' => $params['identity'] ], ['email' => $params['identity']]])
            ->one();

        if(! $user){
            return ResponseHelper::sendFailedResponse(['INVALID_USERNAME_OR_PASSWORD'=>'Invalid username or Password - 01']);
        }

        if(! $params['password']){
            return ResponseHelper::sendFailedResponse(['INVALID_USERNAME_OR_PASSWORD'=>'Invalid username or Password - 02']);
        }

        $valid_password = Yii::$app->getSecurity()->validatePassword($params['password'], $user->password_hash);

        if($valid_password){

            //check role
           $roles = ArrayHelper::getColumn( Yii::$app->authManager->getRolesByUser($user->id),'name');
           $currentRole=   array_keys($roles)[0];

           if( $currentRole != \common\models\User::ROLE_USER){
               return ResponseHelper::sendFailedResponse(['INVALID_ROLE'=>'Invalid User Role']);
           }

            $user->access_token = Yii::$app->getSecurity()->generateRandomString(40);
            $user->save(false);
            $data = ['token'=> $user->access_token, 'profile'=> $user ];
            return ResponseHelper::sendSuccessResponse($data);
        }else{
            return ResponseHelper::sendFailedResponse(['INVALID_USERNAME_OR_PASSWORD'=>'Invalid username or Password -03']);
        }
    }

    public function actionSignup($organization){

        $params = \Yii::$app->request->post();
        $organization = Organization::findOne($organization);
        
        if (!$organization) {
            return (new NotFoundHttpException(Yii::t('yii', 'Page not found.')));
        }
         
        $model = new SignupForm();
        if ($model->load(['SignupForm'=>$params]) && $user = $model->save($organization->id)) {
            $user= User::findOne(['id'=> $user->id]) ;
            return ['token'=> $user->access_token, 'profile'=> $user];
        }else{
            return ['status'=>0, 'messages'=>$model->errors];
        }
    }


    public function actionVerify(){

    }
}