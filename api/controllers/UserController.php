<?php

namespace api\controllers;

use Yii;
use api\helpers\ResetPassword;
use api\helpers\ResponseHelper;
use api\helpers\SignupForm;
use api\resources\User;
use cheatsheet\Time;
use common\commands\SendEmailCommand;
use common\models\Organization;
use common\models\UserProfile;
use common\models\UserToken;
use organization\models\UserForm;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class UserController extends  RestController
{



    public function actionLogin(){
        $params = \Yii::$app->request->post();
        
        if ($params['locale'] == 'ar') {
            \Yii::$app->language = 'ar';
        }

        $user = User::find()
            ->active()
            ->andWhere(['or', ['username' => $params['identity'] ], ['email' => $params['identity']]])
            ->one();

        if(! $user){
            return ResponseHelper::sendFailedResponse(['INVALID_USERNAME_OR_PASSWORD'=>Yii::t('common','Please Enter Valid Email')]);
        }

        if(! $params['password']){
            return ResponseHelper::sendFailedResponse(['INVALID_USERNAME_OR_PASSWORD'=>Yii::t('common','Please Enter Password')]);
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
            return ResponseHelper::sendFailedResponse(['INVALID_USERNAME_OR_PASSWORD'=>Yii::t('common','Invalid Email or Password')]);
        }
    }

    public function actionSignup(){

        $params = \Yii::$app->request->post();

        if ($params['locale'] == 'ar') {
            \Yii::$app->language = 'ar';
        }

        $organization = Organization::findOne(['slug'=>$params['organization']]);

        if (!$organization) {
            return ResponseHelper::sendFailedResponse(['ORGANIZATION_NOT_FOUND'=>Yii::t('common','Organization Not Found')],401);
        }

        $model = new SignupForm();
        if ($model->load(['SignupForm'=>$params]) && $user = $model->save($organization->id)) {
            $user= User::findOne(['id'=> $user->id]) ;
            $data = ['token'=> $user->access_token, 'profile'=> $user];
            return ResponseHelper::sendSuccessResponse($data);
        }else{
            $errors =  ResponseHelper::customResponseError($model->errors);
            return ResponseHelper::sendFailedResponse($errors,401);
        }
    }

    public function actionVerify(){

    }

    public function actionRequestResetPassword(){
        $params = \Yii::$app->request->post();
        if ($params['locale'] == 'ar') {
            \Yii::$app->language = 'ar';
        }
        $user = User::findOne(['email'=> $params['email']]) ;
        if ($user) {
            $token = UserToken::create($user->id, UserToken::TYPE_PASSWORD_RESET, Time::SECONDS_IN_A_DAY);
            if ($user->save()) {
                return \Yii::$app->commandBus->handle(new SendEmailCommand([
                    'to' => $user->email,
                    'subject' => \Yii::t('frontend', \Yii::t('common','Password Reset')),
                    'view' => 'passwordResetToken',
                    'params' => [
                        'user' => $user,
                        'token' => $token->token
                    ]
                ]));
            }
            return ResponseHelper::sendSuccessResponse(['SEND_EMAIL_SUCCESS'=>\Yii::t('common','Email reset password sent successfully')]);
        }
        return ResponseHelper::sendFailedResponse(['ENTER_EMAIL'=>\Yii::t('common','Email Not Found.')],401);
    }

    public function actionResetPassword(){
        $params = \Yii::$app->request->post();

        if ($params['locale'] == 'ar') {
            \Yii::$app->language = 'ar';
        }
        
        try{
            $model = new ResetPassword($params['token']);
        } catch (InvalidArgumentException $e) {
            return ResponseHelper::sendFailedResponse($e->getMessage());
        }
        if ($model->load(['ResetPassword'=>$params]) && $model->validate() && $model->resetPassword()) {
            return ResponseHelper::sendSuccessResponse(['RESET_PASSWORD_SUCCESS'=>\Yii::t('frontend', 'New password was saved.')]);
        }
        return ResponseHelper::sendFailedResponse($model->getErrors());
    }
}
