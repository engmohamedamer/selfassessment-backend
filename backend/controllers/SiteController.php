<?php

namespace backend\controllers;

use Yii;
use backend\models\Event;
use backend\models\EventBeneficiary;
use backend\models\EventField;
use backend\models\EventRequest;
use backend\models\EventSelectedBeneficary;
use backend\models\News;
use backend\models\NewsStatus;
use backend\models\SchoolCategory;
use backend\models\SchoolGender;
use backend\models\Schools;

/**
 * Site controller
 */
class SiteController extends BackendController
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

    public function beforeAction($action)
    {
        $this->layout = Yii::$app->user->isGuest || !Yii::$app->user->can('loginToBackend') ? 'base' : 'common';

        return parent::beforeAction($action);
    }


    public function actionDashboard(){

        return $this->render('dashboard');  //,compact()
    }

}
