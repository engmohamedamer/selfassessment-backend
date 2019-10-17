<?php

namespace organization\controllers;

use common\models\Organization;
use common\models\OrganizationTheme;
use webvimark\behaviors\multilanguage\MultiLanguageHelper;

/**
 * Site controller
 */
class OrganizationController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    public function init()
    {

        MultiLanguageHelper::catchLanguage();
        \Yii::$app->language ='ar';

        parent::init();
    }







//    public function init()
//    {
//        parent::init();
//        \Yii::$app->keyStorage->set('accounting.theme-skin', 'skin-blue');
//
//    }

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
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            $theme = OrganizationTheme::findOne(['organization_id'=>$id]);
            if ($theme->load(\Yii::$app->request->post()) && $theme->save()) {
                return $this->redirect(['view']);
            }
        }
        return $this->render('update', [
            'model' => $model,
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
}
