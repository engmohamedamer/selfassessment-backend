<?php

namespace api\controllers;

use api\helpers\ResponseHelper;
use api\resources\SportsResource;
use yii\rest\ActiveController;

class LookupsController extends  ActiveController
{
    public $modelClass = SportsResource::class;

    public function actionListSports(){

        $goals = SportsResource::find()->where(['status'=>1])->all();
        return ResponseHelper::sendSuccessResponse($goals);
    }


}