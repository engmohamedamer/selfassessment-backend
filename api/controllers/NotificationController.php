<?php

namespace api\controllers;

use api\helpers\ResponseHelper;
use api\resources\NotificationResource;
use yii\web\NotFoundHttpException;

class NotificationController extends  MyActiveController
{
    public $modelClass = NotificationResource::class;

    public function actions(){
        $actions = parent::actions();
        unset($actions['index']);
        // unset($actions['view']);
        // unset($actions['update']);
        // unset($actions['delete']);
        return $actions;
    }

    public function actionIndex(){
    	$notifications = NotificationResource::find()->where(['user_id'=>\Yii::$app->user->identity->getId()])->limit(5)->all();
        return ResponseHelper::sendSuccessResponse($notifications);
    }

}