<?php

namespace backend\controllers;

use Yii;
use backend\models\UserForm;
use common\models\FooterLinks;
use common\models\Organization;
use common\models\OrganizationSearch;
use common\models\OrganizationTheme;
use common\models\User;
use common\models\UserProfile;
use trntv\filekit\actions\DeleteAction;
use trntv\filekit\actions\UploadAction;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * OrganizationController implements the CRUD actions for Organization model.
 */
class OrganizationController extends BackendController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'first-upload' => [
                'class' => UploadAction::class,
                'deleteRoute' => 'first-delete',
                'on afterSave' => function ($event) {
                }
            ],
            'first-delete' => [
                'class' => DeleteAction::class
            ],
            'second-upload' => [
                'class' => UploadAction::class,
                'deleteRoute' => 'second-delete',
                'on afterSave' => function ($event) {
                }
            ],
            'second-delete' => [
                'class' => DeleteAction::class
            ],
            'avatar-upload' => [
                'class' => UploadAction::class,
                'deleteRoute' => 'avatar-delete',
                'on afterSave' => function ($event) {
                }
            ],
            'avatar-delete' => [
                'class' => DeleteAction::class
            ]
        ];
    }

    /**
     * Lists all Organization models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrganizationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Organization model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Organization model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model   = new Organization();
        $user    = new UserForm();
        $user->roles = User::ROLE_GOVERNMENT_ADMIN; 
        $user->status = User::STATUS_ACTIVE;
        $profile = new UserProfile();
        $theme = new OrganizationTheme();
        $themeFooterLinks = new FooterLinks();

        $user->setScenario('create');

        if ($model->load(Yii::$app->request->post()) &&  
            $user->load(Yii::$app->request->post()) && 
            $profile->load(Yii::$app->request->post()) && 
            $theme->load(Yii::$app->request->post()) && 
            $themeFooterLinks->load(Yii::$app->request->post()) && 
            $theme->validate() && $themeFooterLinks->validate() &&
            $model->validate() && $user->validate() 
        ) {
            $model->save();
            $user->save();
            $profile->load(Yii::$app->request->post());
            $this->UpdateUserRelatedTbls($user,$profile,$model->id);

            $theme->organization_id = $model->id;
            $themeFooterLinks->organization_id = $model->id;
            
            if($themeFooterLinks->save() && $theme->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
        return var_dump($theme->errors,$themeFooterLinks->errors);
            }
            
        }
        // return var_dump($model->errors,$user->errors,$profile->errors,$theme->errors,$themeFooterLinks->errors);
        // return var_dump($model,$user,$profile,$theme,$themeFooterLinks);

        return $this->render('create', [
            'model' => $model,
            'user' => $user,
            'profile' => $profile,
            'theme'=> $theme,
            'themeFooterLinks'=> $themeFooterLinks
        ]);

    }

    /**
     * Updates an existing Organization model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        // return var_dump(Yii::$app->request->post(), $model->load(Yii::$app->request->post()));

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $theme = OrganizationTheme::findOne(['organization_id'=>$id]);
            $themeFooterLinks = FooterLinks::findOne(['organization_id'=>$id]);
            if (!$themeFooterLinks) {
                $themeFooterLinks = new FooterLinks();
                $themeFooterLinks->organization_id = $id;
            }
            if ($themeFooterLinks->load(\Yii::$app->request->post()) && $theme->load(\Yii::$app->request->post()) && $themeFooterLinks->save() && $theme->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Organization model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }

    
    /**
     * Finds the Organization model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Organization the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Organization::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('common', 'The requested page does not exist.'));
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
            $prof->user_id = $model->getId();
        }
        $prof->locale= 'ar-AR';
        $prof->firstname = $profile->firstname ;
        $prof->lastname = $profile->lastname ;
        $prof->gender = $profile->gender;
        $prof->avatar_base_url = isset($profile->picture['base_url']) ? $profile->picture['base_url'] : null;
        $prof->avatar_path = isset($profile->picture['path'])? $profile->picture['path']: null ;
        $prof->organization_id = $organization_id;
        $prof->save(false);

        return $prof;
    }


    public function actionManager($id)
    {
        $this->layout='base';

        $model = new UserForm();
        $model->setModel(User::findOne($id));
        $model->roles = User::ROLE_GOVERNMENT_ADMIN; 
        $profile= $model->getModel()->userProfile;
        $saved = false;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $profile->load(Yii::$app->request->post());
            $this->UpdateUserRelatedTbls($model,$profile,$profile->organization_id);
            $saved = true;
        }else{
            // return var_dump($model->errors);
        }

        return $this->render('manager', [
            'model' => $model,
            'profile' => $profile,
            'saved'=> $saved
        ]);
    }
}
