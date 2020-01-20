<?php

namespace organization\controllers;

use Intervention\Image\ImageManagerStatic;
use Yii;
use common\commands\SendEmailCommand;
use common\models\User;
use common\models\UserProfile;
use common\models\UserToken;
use organization\models\UserForm;
use organization\models\search\UserSearch;
use trntv\filekit\actions\DeleteAction;
use trntv\filekit\actions\UploadAction;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
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



    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->identity->userProfile->main_admin and $_GET['user_role'] == 'governmentAdmin') {
            return $this->redirect(['/']);
        }
        $searchModel = new UserSearch();
        if(isset($_REQUEST['user_role'])){
            Yii::$app->session->set('UserRole',$_REQUEST['user_role']);
        }
        if ($_GET['status'] == 'unactive') {
            $searchModel->status = User::STATUS_NOT_ACTIVE;
        }else{
            $searchModel->status = User::STATUS_ACTIVE;
        }
        $searchModel->user_role = Yii::$app->session->get('UserRole');
        $searchModel->organization_id = Yii::$app->user->identity->userProfile->organization_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->sort = [
            'defaultOrder' => ['id' => SORT_DESC]
        ];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function userCount()
    {
        $searchModel = new UserSearch();
        $searchModel->user_role = User::ROLE_USER;
        $searchModel->organization_id = Yii::$app->user->identity->userProfile->organization_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $dataProvider->count;
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws \yii\base\Exception
     * @throws NotFoundHttpException
     */
    public function actionLogin($id)
    {
        $model = $this->findModel($id);
        $tokenModel = UserToken::create(
            $model->getId(),
            UserToken::TYPE_LOGIN_PASS,
            60
        );

        return $this->redirect(
            Yii::$app->urlManagerFrontend->createAbsoluteUrl(['user/sign-in/login-by-pass', 'token' => $tokenModel->token])
        );
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new UserForm();
        $model->roles = Yii::$app->session->get('UserRole') ? : User::ROLE_USER;
        $profile = new UserProfile();
        $model->setScenario('create');
        $organization = Yii::$app->user->identity->userProfile->organization;
        if ( !$organization->limit_account ||  ( $organization->limit_account and $organization->limit_account >= $this->userCount() ) ) {
            if ($model->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post()) &&  $model->validate()) {
                $model->save();
                $profile->sector_id = $model->sector_id ;

                $organization_id = Yii::$app->user->identity->userProfile->organization_id;
                $user = $this->UpdateUserRelatedTbls($model,$profile,$organization_id)->user;

                Yii::$app->getSession()->setFlash('alert', [
                    'type' =>'success',
                    'body' => \Yii::t('backend', 'Data has been saved Successfully') ,
                    'title' =>'',
                ]);

                return $this->redirect(['index?user_role='.$model->roles]);
            }

            return $this->render('create', [
                'model' => $model,
                'profile' => $profile,
            ]);
        }
        return $this->redirect('/user');
    }

    /**
     * Updates an existing User model.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = new UserForm();
        $model->setModel($this->findModel($id));
        $model->tags = $this->findModel($id)->tags;
        $profile= $model->getModel()->userProfile;
        $model->sector_id =  $profile->sector_id;
        $model->roles = Yii::$app->session->get('UserRole') ? : User::ROLE_USER;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $profile->load(Yii::$app->request->post());
            $profile->sector_id =  $model->sector_id;
            $this->UpdateUserRelatedTbls($model,$profile);
            Yii::$app->getSession()->setFlash('alert', [
                'type' =>'success',
                'body' => \Yii::t('backend', 'Data has been updated Successfully') ,
                'title' =>'',
            ]);

            return $this->redirect(['index?user_role='.$model->roles]);
        }

        return $this->render('update', [
            'model' => $model,
            'profile' => $profile,
        ]);
    }

    public function actionActive($id)
    {
        $model = $this->findModel($id);
        if ($model->status == User::STATUS_NOT_ACTIVE){
            $model->status = User::STATUS_ACTIVE;
            $model->save();

            Yii::$app->commandBus->handle(new SendEmailCommand([
                'to' => $model->email,
                'subject' => \Yii::t('frontend', \Yii::t('common','Active Account')),
                'view' => 'activeUser',
                'params' => [
                    'user' => $model,
                    'organization' => $model->userProfile->organization
                ]
            ]));

            Yii::$app->getSession()->setFlash('alert', [
                'type' =>'success',
                'body' => \Yii::t('backend', 'Data has been updated Successfully') ,
                'title' =>'',
            ]);
        }
        return $this->redirect(['index?user_role=user']);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        Yii::$app->authManager->revokeAll($id);
        $model = $this->findModel($id);
        $this->findModel($id)->delete();
        if ($model->status == User::STATUS_NOT_ACTIVE) {
            return $this->redirect(['index?user_role=user&status=unactive']);
        }
        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function UpdateUserRelatedTbls($model,$profile,$organization_id = null){
        $prof= $model->getModel()->userProfile;
        if(!$prof) {
            $prof = new UserProfile();
            $prof->user_id=$model->getId();
        }
        $prof->firstname = $profile->firstname ;
        $prof->lastname = $profile->lastname ;
        $prof->gender = $profile->gender;
        $prof->locale = $profile->locale;
        $prof->mobile = $profile->mobile;
        $prof->sector_id = $profile->sector_id;
        if ($organization_id) {
            $prof->organization_id = $organization_id;
        }
        $prof->avatar_base_url = isset($profile->picture['base_url']) ? $profile->picture['base_url'] : null;
        $prof->avatar_path= isset($profile->picture['path'])? $profile->picture['path']: null ;

        $prof->save(false);

        return $prof;
    }

}
