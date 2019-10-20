<?php
namespace organization\controllers;

use Intervention\Image\ImageManagerStatic;
use Yii;
use common\models\FirebaseAuth;
use organization\models\AccountForm;
use organization\models\LoginForm;
use organization\models\PasswordResetRequestForm;
use organization\models\ResetPasswordForm;
use trntv\filekit\actions\DeleteAction;
use trntv\filekit\actions\UploadAction;
use yii\filters\VerbFilter;
use yii\imagine\Image;
use yii\web\Controller;

class SignInController extends OrganizationController
{

    public $defaultAction = 'login';


    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post']
                ]
            ]
        ];
    }

    public function actions()
    {
        return [
            'avatar-upload' => [
                'class' => UploadAction::class,
                'deleteRoute' => 'avatar-delete',
                'on afterSave' => function ($event) {
                    /* @var $file \League\Flysystem\File */
                    $file = $event->file;
                    $img = ImageManagerStatic::make($file->read())->fit(215, 215);
                    $file->put($img->encode());
                }
            ],
            'avatar-delete' => [
                'class' => DeleteAction::class
            ]
        ];
    }


    public function actionLogin()
    {
        $this->layout = 'base';
        \Yii::$app->language = 'ar'; 

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionProfile()
    {
        $model = Yii::$app->user->identity->userProfile;
        if ($model->load($_POST) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'options' => ['class' => 'alert-success'],
                'body' => Yii::t('backend', 'Your profile has been successfully saved', [], $model->locale)
            ]);
            return $this->refresh();
        }
        return $this->render('profile', ['model' => $model]);
    }

    public function actionAccount()
    {
        $user = Yii::$app->user->identity;
        $model = new AccountForm();
        $model->username = $user->username;
        $model->email = $user->email;
        if ($model->load($_POST) && $model->validate()) {
            $user->username = $model->username;
            $user->email = $model->email;
            if ($model->password) {
                $user->setPassword($model->password);
            }
            $user->save();
            Yii::$app->session->setFlash('alert', [
                'options' => ['class' => 'alert-success'],
                'body' => Yii::t('backend', 'Your account has been successfully saved')
            ]);
            return $this->refresh();
        }
        return $this->render('account', ['model' => $model]);
    }

    /**
     * @return string|Response
     */
    public function actionRequestPasswordReset()
    {
        $this->layout = 'base';
        \Yii::$app->language = 'ar';

        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success',Yii::t('frontend', 'Check your email for further instructions.') );
                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error',Yii::t('frontend', 'Sorry, we are unable to reset password for email provided.') );
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * @param $token
     * @return string|Response
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        $this->layout = 'base';
        \Yii::$app->language = 'ar';

        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {

            Yii::$app->getSession()->setFlash('success',Yii::t('frontend', 'New password was saved.') );
            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
