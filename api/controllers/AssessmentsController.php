<?php

namespace api\controllers;


use api\helpers\ResponseHelper;
use api\resources\SurveyMiniResource;
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
        $survey_done =  $this->CheckState($surveyObj->survey_id);

        if(!$survey_done)  return ResponseHelper::sendFailedResponse(['message'=>'Survey is Completed']);

        foreach ($params as $key=>$value) {
            $question = $this->findModel($key);
            //check question type
           if ($question->survey_question_type === SurveyType::TYPE_ONE_OF_LIST
                || $question->survey_question_type === SurveyType::TYPE_DROPDOWN
                || $question->survey_question_type === SurveyType::TYPE_SLIDER
                || $question->survey_question_type === SurveyType::TYPE_SINGLE_TEXTBOX
                || $question->survey_question_type === SurveyType::TYPE_COMMENT_BOX
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
               || $question->survey_question_type === SurveyType::TYPE_RANKING
               || $question->survey_question_type === SurveyType::TYPE_MULTIPLE_TEXTBOX
               || $question->survey_question_type === SurveyType::TYPE_DATE_TIME
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

           }//end if

        }//end loap answers


        return ResponseHelper::sendSuccessResponse();

    }


    public function CheckState($surveyId){
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

    protected function validate(&$question,$post)
    {

        $result = [];

        $answersData = ArrayHelper::getValue($post, "SurveyUserAnswer.{$question->survey_question_id}");
        $userAnswers = $question->userAnswers;

        if (!empty($answersData)) {
            if ($question->survey_question_type === SurveyType::TYPE_MULTIPLE
                || $question->survey_question_type === SurveyType::TYPE_RANKING
                || $question->survey_question_type === SurveyType::TYPE_MULTIPLE_TEXTBOX
                || $question->survey_question_type === SurveyType::TYPE_DATE_TIME
                || $question->survey_question_type === SurveyType::TYPE_CALENDAR
            ) {
                foreach ($question->answers as $i => $answer) {
                    if (!$question->survey->isAccessibleByCurrentUser) {
                        die(['lkj']);
                    }

                    $userAnswer = isset($userAnswers[$answer->survey_answer_id]) ? $userAnswers[$answer->survey_answer_id] : (new SurveyUserAnswer([
                        'survey_user_answer_user_id' => \Yii::$app->user->getId(),
                        'survey_user_answer_survey_id' => $question->survey_question_survey_id,
                        'survey_user_answer_question_id' => $question->survey_question_id,
                        'survey_user_answer_answer_id' => $answer->survey_answer_id
                    ]));
                    if ($userAnswer->load($answersData[$answer->survey_answer_id], '')) {
                        $userAnswer->validate();
                        foreach ($userAnswer->getErrors() as $attribute => $errors) {
                            $result["surveyuseranswer-{$question->survey_question_id}-{$answer->survey_answer_id}-{$attribute}"] = $errors;
                        }
                        $userAnswer->save();
                    }
                }
                $question->refresh();
                $question->validateMultipleAnswer();
                foreach ($question->userAnswers as $userAnswer) {
                    foreach ($userAnswer->getErrors() as $attribute => $errors) {
                        $result["surveyuseranswer-{$question->survey_question_id}-{$userAnswer->survey_user_answer_answer_id}-{$attribute}"] = $errors;
                    }
                }
            } elseif ($question->survey_question_type === SurveyType::TYPE_ONE_OF_LIST
                || $question->survey_question_type === SurveyType::TYPE_DROPDOWN
                || $question->survey_question_type === SurveyType::TYPE_SLIDER
                || $question->survey_question_type === SurveyType::TYPE_SINGLE_TEXTBOX
                || $question->survey_question_type === SurveyType::TYPE_COMMENT_BOX
            ) {
                $userAnswer = !empty(current($userAnswers)) ? current($userAnswers) : (new SurveyUserAnswer([
                    'survey_user_answer_user_id' => \Yii::$app->user->getId(),
                    'survey_user_answer_survey_id' => $question->survey_question_survey_id,
                    'survey_user_answer_question_id' => $question->survey_question_id,
                ]));
                if ($userAnswer->load($answersData, '')) {
                    $userAnswer->validate();
                    foreach ($userAnswer->getErrors() as $attribute => $errors) {
                        $result["surveyuseranswer-{$question->survey_question_id}-{$attribute}"] = $errors;
                    }
                    $userAnswer->save();
                }
            }
        }

        return $result;
    }



}
