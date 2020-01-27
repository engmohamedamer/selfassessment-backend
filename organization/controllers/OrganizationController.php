<?php

namespace organization\controllers;

use Intervention\Image\ImageManagerStatic;
use common\models\FooterLinks;
use common\models\Organization;
use common\models\OrganizationTheme;
use trntv\filekit\actions\DeleteAction;
use trntv\filekit\actions\UploadAction;

/**
 * Site controller
 */
class OrganizationController extends OrganizationBackendController
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'first-upload' => [
                'class' => UploadAction::class,
                'deleteRoute' => 'first-delete',
                'on afterSave' => function ($event) {
                    // $file = $event->file;
                    // $img = ImageManagerStatic::make($file->read())->resize(90, 50);
                    // $file->put($img->encode());
                }
            ],
            'first-delete' => [
                'class' => DeleteAction::class
            ],
            'second-upload' => [
                'class' => UploadAction::class,
                'deleteRoute' => 'second-delete',
                'on afterSave' => function ($event) {
                    $file = $event->file;
                    $img = ImageManagerStatic::make($file->read())->resize(32, 32);
                    $file->put($img->encode());
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
     * Displays a single Organization model.
     * @param integer $id
     * @return mixed
     */
    public function actionView()
    {
        $id = \Yii::$app->user->identity->userProfile->organization_id;
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Updates an existing Organization model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $id = \Yii::$app->user->identity->userProfile->organization_id;
        $model = $this->findModel($id);
        $theme = OrganizationTheme::findOne(['organization_id'=>$id]);
        $themeFooterLinks = FooterLinks::findOne(['organization_id'=>$id]);
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            if ($themeFooterLinks->load(\Yii::$app->request->post()) && $theme->load(\Yii::$app->request->post()) && $themeFooterLinks->save() && $theme->save()) {
                if ($model->save_exit == 'exit') {
                    return $this->redirect(['view', 'id' => $model->id]);
                }elseif($model->save_exit == 'save'){
                    return $this->render('update', [
                        'model' => $model,
                        'theme' => $theme,
                        'themeFooterLinks' => $themeFooterLinks,
                    ]);
                }
            }
        }
        return $this->render('update', [
            'model' => $model,
            'theme' => $theme,
            'themeFooterLinks' => $themeFooterLinks,
        ]);
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
    public  function actionStructure(){
        return $this->render('structure');
    }
    public  function actionAdmins(){
        return $this->render('admins');
    }
}
