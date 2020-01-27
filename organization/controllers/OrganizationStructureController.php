<?php

namespace organization\controllers;

use Yii;
use common\models\OrganizationStructure;
use organization\controllers\OrganizationBackendController;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * OrganizationStructureController implements the CRUD actions for OrganizationStructure model.
 */
class OrganizationStructureController extends OrganizationBackendController
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

    /**
     * Lists all OrganizationStructure models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => OrganizationStructure::find()->where(['organization_id'=>\Yii::$app->user->identity->userProfile->organization_id ]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
