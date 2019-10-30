<?php

namespace api\controllers;


use api\helpers\ResponseHelper;
use api\resources\SurveyMiniResource;
use api\resources\SurveyResource;
use api\resources\User;
use backend\modules\assessment\models\SurveyStat;
use yii\data\ActiveDataProvider;
use yii\db\Expression;


class AssessmentsController extends  MyActiveController
{
    public $modelClass = SurveyResource::class;

    public function actions(){
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['view']);
        unset($actions['update']);
        return $actions;
    }

    public function actionIndex(){

        $params= \Yii::$app->request->get();

        $orgId = \Yii::$app->user->identity->userProfile->organization_id;
        if(! $orgId) return ResponseHelper::sendFailedResponse(['message'=>"Missing Data"],'404');

        $query=SurveyMiniResource::find();
        $query->where(['org_id'=>$orgId]);

        $activeData = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => $this->defaultPageSize , // to set default count items on one page
                'pageSize' => $this->pageSize, //to set count items on one page, if not set will be set from defaultPageSize
                'pageSizeLimit' => $this->pageSizeLimit, //to set range for pageSize

            ],
        ]);
        return $activeData;
    }


    public function actionView($id)
    {
        $user= User::findOne(['id'=> \Yii::$app->user->identity->getId()]) ;
        if(! $id) return ResponseHelper::sendFailedResponse(['message'=>"Missing Data"],'404');
        $profile=$user->userProfile;

        $surveyObj = SurveyResource::findOne(['survey_id'=>$id]);

        return ResponseHelper::sendSuccessResponse($surveyObj);

    }


    public function actionUpdate($id)
    {
        $user= User::findOne(['id'=> \Yii::$app->user->identity->getId()]) ;
        if(! $id) return ResponseHelper::sendFailedResponse(['message'=>"Missing Data"],'404');
        $profile=$user->userProfile;

        $surveyObj = SurveyResource::findOne(['survey_id'=>$id]);
        if(!$surveyObj)  return ResponseHelper::sendFailedResponse(['message'=>'Survey not found', 404]);

        $params = \Yii::$app->request->post();

        //add survey state
         $this->CheckState($surveyObj->survey_id);

        foreach ($params as $key=>$value) {
           echo $key;
            print_r($value);

            echo "<br/>";
        }


        die;


        return ResponseHelper::sendSuccessResponse($surveyObj);

    }


    public function CheckState($surveyId){
        $assignedModel = SurveyStat::getAssignedUserStat(\Yii::$app->user->getId(), $surveyId);
        if (empty($assignedModel)) {
            SurveyStat::assignUser(\Yii::$app->user->getId(), $this->surveyId);
            $assignedModel = SurveyStat::getAssignedUserStat(\Yii::$app->user->getId(),$surveyId);
        } else {
//            if ($assignedModel->survey_stat_is_done){
//                return $this->renderClosed();
//            }
        }

        if ($assignedModel->survey_stat_started_at === null) {
            $assignedModel->survey_stat_started_at = new Expression('NOW()');
            $assignedModel->save(false);
        }

        return true;
    }




}
