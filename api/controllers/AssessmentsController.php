<?php

namespace api\controllers;


use api\helpers\ImageHelper;
use api\helpers\ResponseHelper;
use api\resources\SurveyMiniResource;
use api\resources\SurveyReportResource;
use api\resources\SurveyResource;
use api\resources\User;
use backend\modules\assessment\models\SurveyQuestion;
use backend\modules\assessment\models\SurveyStat;
use backend\modules\assessment\models\SurveyType;
use backend\modules\assessment\models\SurveyUserAnswer;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;


class AssessmentsController extends  MyActiveController
{
    public $modelClass = SurveyResource::class;

    public function actions(){
        $actions = parent::actions();
        unset($actions['index']);
        unset($actions['view']);
        unset($actions['update']);
        unset($actions['delete']);
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

    public function actionReport($id)
    {
        $user= User::findOne(['id'=> \Yii::$app->user->identity->getId()]) ;
        if(! $id) return ResponseHelper::sendFailedResponse(['message'=>"Missing Data"],'404');
        $profile=$user->userProfile;

        $surveyObj = SurveyReportResource::findOne(['survey_id'=>$id]);

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
        $survey_done =  $this->CheckState($surveyObj->survey_id,$params['status'],$params['pageNo']);

        if(!$survey_done)  return ResponseHelper::sendFailedResponse(['message'=>'Survey is Completed']);

        foreach ($params['answers'] as $key=>$value) {
            $key=  (int)preg_replace('/\D/ui','',$key);


            $question = $this->findModel($key);
            //check question type
           if ($question->survey_question_type === SurveyType::TYPE_ONE_OF_LIST
                || $question->survey_question_type === SurveyType::TYPE_DROPDOWN
                || $question->survey_question_type === SurveyType::TYPE_SLIDER
                || $question->survey_question_type === SurveyType::TYPE_SINGLE_TEXTBOX
                || $question->survey_question_type === SurveyType::TYPE_COMMENT_BOX
               || $question->survey_question_type === SurveyType::TYPE_DATE_TIME
            ){
               //handel one answer
               $userAnswers = $question->userAnswers;
               $userAnswer = !empty(current($userAnswers)) ? current($userAnswers) : (new SurveyUserAnswer([
                   'survey_user_answer_user_id' => \Yii::$app->user->getId(),
                   'survey_user_answer_survey_id' => $question->survey_question_survey_id,
                   'survey_user_answer_question_id' => $question->survey_question_id,
               ]));

               $userAnswer->survey_user_answer_value = $value;
               $userAnswer->save(false);
            }else if($question->survey_question_type === SurveyType::TYPE_MULTIPLE
               || $question->survey_question_type === SurveyType::TYPE_MULTIPLE_TEXTBOX
               || $question->survey_question_type === SurveyType::TYPE_CALENDAR
           ) {
               //delete old answers and add new
               SurveyUserAnswer::deleteAll(['survey_user_answer_survey_id'=>$question->survey_question_survey_id ,
                   'survey_user_answer_question_id'=>$question->survey_question_id,
                   'survey_user_answer_user_id' => \Yii::$app->user->getId()
                   ]);
               //save multiple
               foreach ($question->answers as $i => $answer) {
                 $found = in_array($answer->survey_answer_id ,$value);
                  if($found){
                      $userAnswer =  new SurveyUserAnswer();

                          $userAnswer->survey_user_answer_user_id = \Yii::$app->user->getId();
                          $userAnswer->survey_user_answer_survey_id = $question->survey_question_survey_id;
                          $userAnswer->survey_user_answer_question_id = $question->survey_question_id;
                          $userAnswer->survey_user_answer_answer_id = $answer->survey_answer_id;
                          $userAnswer->survey_user_answer_value =1 ;

                      $userAnswer->save(false);
                  }

                 }

           }else if(
              $question->survey_question_type === SurveyType::TYPE_RANKING
           ) {
               //delete old answers and add new
               SurveyUserAnswer::deleteAll(['survey_user_answer_survey_id'=>$question->survey_question_survey_id ,
                   'survey_user_answer_question_id'=>$question->survey_question_id,
                   'survey_user_answer_user_id' => \Yii::$app->user->getId()
                   ]);
               //save multiple
               foreach ($question->answers as $i => $answer) {
                 $ids = array_keys($value);
                 $found = in_array($answer->survey_answer_id ,$ids);
                  if($found){
                      $userAnswer =  new SurveyUserAnswer();

                          $userAnswer->survey_user_answer_user_id = \Yii::$app->user->getId();
                          $userAnswer->survey_user_answer_survey_id = $question->survey_question_survey_id;
                          $userAnswer->survey_user_answer_question_id = $question->survey_question_id;
                          $userAnswer->survey_user_answer_answer_id = $answer->survey_answer_id;
                          $userAnswer->survey_user_answer_value = $value[$answer->survey_answer_id];

                      $userAnswer->save(false);
                  }

                 }

           }else if($question->survey_question_type === SurveyType::TYPE_FILE
           ) {
               //save multiple
              if (count($value) > 0 ) {
                 foreach ($value as $file) {
                    if (!isset($file['id'])) {
                      SurveyUserAnswer::deleteAll(['survey_user_answer_survey_id'=>$question->survey_question_survey_id ,
                       'survey_user_answer_question_id'=>$question->survey_question_id,
                       'survey_user_answer_user_id' => \Yii::$app->user->getId()
                       ]);
                      if(isset($file['type']) && $file['type']  == 'application/pdf' ){
                          $filename = ImageHelper::Base64IPdfConverter($file['content'],'answers');

                      }else{
                          $filename = ImageHelper::Base64IMageConverter($file['content'],'answers');
                      }
                      $userAnswer =  new SurveyUserAnswer();
                      $userAnswer->survey_user_answer_user_id = \Yii::$app->user->getId();
                      $userAnswer->survey_user_answer_survey_id = $question->survey_question_survey_id;
                      $userAnswer->survey_user_answer_question_id = $question->survey_question_id;
                      $userAnswer->survey_user_answer_value = 'answers/'.$filename;
                      $userAnswer->survey_user_answer_text = $file['name'];
                      $userAnswer->save(false);
                    }
                }
              }
           }//end if

        }//end loap answers


        return ResponseHelper::sendSuccessResponse();

    }


    public function CheckState($surveyId,$status = null,$pageNo = 0){
        $assignedModel = SurveyStat::getAssignedUserStat(\Yii::$app->user->getId(), $surveyId);


        if (empty($assignedModel)) {
            SurveyStat::assignUser(\Yii::$app->user->getId(), $surveyId);
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
        $stat = SurveyStat::getAssignedUserStat(\Yii::$app->user->getId(), $surveyId);
        //не работаем с завершенными опросами
        if ($status == 2 && $stat->survey_stat_is_done != 1) {
            $assignedModel->survey_stat_is_done = 1;
            $assignedModel->pageNo = $pageNo;
            $assignedModel->save(false);
        }elseif($status == 1){
            $assignedModel->pageNo = $pageNo;
            $assignedModel->save(false);
        }

        if ($stat->survey_stat_is_done) {
            return false;
        }


        return true;
    }

    protected function findModel($id)
    {
        if (($model = SurveyQuestion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionDeleteFile()
    {
        $params = \Yii::$app->request->post();
        return $params;
    }

}
