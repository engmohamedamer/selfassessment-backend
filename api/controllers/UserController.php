<?php

namespace api\controllers;

use Yii;
use api\helpers\ResetPassword;
use api\helpers\ResponseHelper;
use api\helpers\SignupForm;
use api\resources\OrganizationStructureResource;
use api\resources\User;
use cheatsheet\Time;
use common\commands\SendEmailCommand;
use common\models\Organization;
use common\models\OrganizationStructure;
use common\models\UserProfile;
use common\models\UserToken;
use organization\models\UserForm;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class UserController extends  RestController
{

    public function actionLogin(){
        $params = \Yii::$app->request->post();

        if (!isset($params['locale'])) {
            \Yii::$app->language = 'ar';
        }else{
            if ($params['locale'] == 'ar') {
                \Yii::$app->language = 'ar';
            }
        }

    
        $user = User::find()
            ->andWhere(['or', ['username' => $params['identity'] ], ['email' => $params['identity']]])
            ->one();

        if(! $user){
            return ResponseHelper::sendFailedResponse(['INVALID_USERNAME_OR_PASSWORD'=>Yii::t('common','These credentials do not match our records.')],400);
        }


        if(!isset($params['password'])){
            return ResponseHelper::sendFailedResponse(['INVALID_USERNAME_OR_PASSWORD'=>Yii::t('common','These credentials do not match our records.')],400);
        }

        $valid_password = Yii::$app->getSecurity()->validatePassword($params['password'], $user->password_hash);

        if($valid_password){

            $checkIsActive = User::find()->active()->andWhere(['or', ['username' => $params['identity'] ], ['email' => $params['identity']]])->one();
            if(!$checkIsActive){
                return ResponseHelper::sendFailedResponse(['INVALID_USERNAME_OR_PASSWORD'=>Yii::t('common',Yii::t('common','Your account not activated yet'))],401);
            }

            //check role
           $roles = ArrayHelper::getColumn( Yii::$app->authManager->getRolesByUser($user->id),'name');
           $currentRole=   array_keys($roles)[0];

           if( $currentRole != \common\models\User::ROLE_USER){
               return ResponseHelper::sendFailedResponse(['INVALID_ROLE'=>Yii::t('common','You do not have access')],401);
           }

            $user->access_token = Yii::$app->getSecurity()->generateRandomString(40);
            $user->save(false);
            $data = ['token'=> $user->access_token, 'profile'=> $user ];
            return ResponseHelper::sendSuccessResponse($data);
        }else{
            return ResponseHelper::sendFailedResponse(['INVALID_USERNAME_OR_PASSWORD'=>Yii::t('common','These credentials do not match our records.')],400);
        }
    }

    public function actionSignup(){

        $params = \Yii::$app->request->post();
      
        if (!isset($params['locale'])) {
            \Yii::$app->language = 'ar';
        }else{
            if ($params['locale'] == 'ar') {
                \Yii::$app->language = 'ar';
            }else{
                \Yii::$app->language = 'en';
            }
        }

        // return $params['locale'];
        if (!isset($params['organization'])) {
            return ResponseHelper::sendFailedResponse(['ORGANIZATION_NOT_FOUND'=>Yii::t('common','Organization Not Found')],400);
        }

        $organization = Organization::findOne(['slug'=>$params['organization']]);

        if (!$organization) {
            return ResponseHelper::sendFailedResponse(['ORGANIZATION_NOT_FOUND'=>Yii::t('common','Organization Not Found')],400);
        }

        $model = new SignupForm();
        if ($model->load(['SignupForm'=>$params]) && $user = $model->save($organization->id)) {
            $user= User::findOne(['id'=> $user->id]);
            return ResponseHelper::sendSuccessResponse(['message'=>Yii::t('common','Account Created Successfully')]);
        }else{
            $errors =  ResponseHelper::customResponseError($model->errors);
            return ResponseHelper::sendFailedResponse($errors,400);
        }
    }

    public function actionSectors(){
        $organizationStructure = OrganizationStructureResource::find()->where(['lvl'=>0])->addOrderBy('root, lft')->all();
        $data = [];
        foreach ($organizationStructure as $key => $value) {
            $one = OrganizationStructureResource::find()->where(['root'=>$value->id,'lvl'=>1])->andWhere(['!=','id',$value->id])->all();
            $childrenOne = [];
            foreach ($one as $v) {
                $two = OrganizationStructureResource::find()->where(['root'=>$value->id,'lvl'=>2])->andWhere(['!=','id',$value->id])->all();
                $childrenTwo = [];
                foreach ($two as $v2) {
                    $childrenTwo[] = [
                        'id'=> $v2->id,
                        'label'=> $v2->name,
                        'children'=> $childrenOne,
                    ];
                }
                $childrenOne[] = [
                    'id'=> $v->id,
                    'label'=> $v->name,
                    'children'=> $childrenTwo,
                ];
            }
            $data[] = [
                'id'=> $value->id,
                'label'=> $value->name,
                'children'=> $childrenOne,
            ];
        }
        return ResponseHelper::sendSuccessResponse($data);
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
