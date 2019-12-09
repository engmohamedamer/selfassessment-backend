<?php

namespace api\controllers;


use api\helpers\ImageHelper;
use api\helpers\ResponseHelper;
use api\resources\SurveyMiniResource;
use api\resources\SurveyReportResource;
use api\resources\SurveyResource;
use api\resources\User;
use backend\models\CorrectiveActionReport;
use backend\modules\assessment\models\SurveyAnswer;
use backend\modules\assessment\models\SurveyQuestion;
use backend\modules\assessment\models\SurveyStat;
use backend\modules\assessment\models\SurveyType;
use backend\modules\assessment\models\SurveyUserAnswer;
use common\models\SurveyUserAnswerAttachments;
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
        $query = SurveyMiniResource::find()->orderBy('survey_id DESC');
        $query->where(['org_id'=>$orgId]);
        $query->where(['survey_is_visible' => 1]);

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
        $user_id = \Yii::$app->user->identity->getId();
        $user= User::findOne(['id'=> $user_id]) ;
        if(! $id) return ResponseHelper::sendFailedResponse(['message'=>"Missing Data"],404);
        $profile=$user->userProfile;

        $surveyObj = SurveyResource::find()->where(['survey_id'=>$id,'survey_is_visible' => 1])->one();
        if(!$surveyObj)  return ResponseHelper::sendFailedResponse(['message'=>'Survey not found'],404);
        $expired_at = time() >= strtotime($surveyObj->survey_expired_at);
        $stats = SurveyStat::findOne(['survey_stat_survey_id'=>$id,'survey_stat_user_id'=> $user_id]);
        
        // if($surveyObj->survey_is_closed || $expired_at || (isset($stats) and $stats->survey_stat_is_done))  return ResponseHelper::sendFailedResponse(['message'=>'Forbidden'],403);
        

        return ResponseHelper::sendSuccessResponse($surveyObj);

    }

    public function actionReport($id)
    {
        $user= User::findOne(['id'=> \Yii::$app->user->identity->getId()]) ;
        if(! $id) return ResponseHelper::sendFailedResponse(['message'=>"Missing Data"],'404');
        $profile=$user->userProfile;

        $surveyObj = SurveyReportResource::findOne(['survey_id'=>$id,'survey_is_visible' => 1]);
        if(!$surveyObj)  return ResponseHelper::sendFailedResponse(['message'=>'Survey not found'],404);
        return ResponseHelper::sendSuccessResponse($surveyObj);

    }

    public function actionCustomReport($id,$user_id)
    {
        $user= User::findOne(['id'=> $user_id]) ;
        if(! $id) return ResponseHelper::sendFailedResponse(['message'=>"Missing Data"],'404');
        $profile=$user->userProfile;
        $_SESSION['userID'] =$user_id;

        $surveyObj = SurveyReportResource::findOne(['survey_id'=>$id]); //,'survey_is_visible' => 1

        if(!$surveyObj)  return ResponseHelper::sendFailedResponse(['message'=>'Survey not found'],404);
        return ResponseHelper::sendSuccessResponse($surveyObj);

    }

    public function actionUpdate($id)
    {
        $user= User::findOne(['id'=> \Yii::$app->user->identity->getId()]) ;
        if(! $id) return ResponseHelper::sendFailedResponse(['message'=>"Missing Data"],404);
        $profile=$user->userProfile;

        $surveyObj = SurveyResource::findOne(['survey_id'=>$id,'survey_is_visible' => 1]);
        if(!$surveyObj)  return ResponseHelper::sendFailedResponse(['message'=>'Survey not found'],404);

        $params = \Yii::$app->request->post();
        if (!isset($params['status'])) $params['status'] = null;
        if (!isset($params['pageNo'])) $params['pageNo'] = null;
        //add survey state
        $survey_done =  $this->CheckState($surveyObj->survey_id,$params['status'],$params['pageNo']);

        if(!$survey_done)  return ResponseHelper::sendFailedResponse(['message'=>'Survey is Completed'],404);

        foreach ($params['answers'] as $key=>$value) {

          if (strstr($key, 'a-')){
            $key=  (int)preg_replace('/\D/ui','',$key);
            $question = $this->findModel($key);
            if ($question->survey_question_attachment_file) {
              SurveyUserAnswerAttachments::deleteAll(['survey_user_answer_attachments_survey_id'=>$question->survey_question_survey_id ,
                   'survey_user_answer_attachments_question_id'=>$question->survey_question_id,
                   'survey_user_answer_attachments_user_id' => \Yii::$app->user->getId()
                   ]);
              foreach ($value as $index => $file) {
                $fileObj= new SurveyUserAnswerAttachments();
                $fileObj->survey_user_answer_attachments_user_id = \Yii::$app->user->identity->getId();
                $fileObj->survey_user_answer_attachments_survey_id = $question->survey_question_survey_id ;
                $fileObj->survey_user_answer_attachments_question_id = $question->survey_question_id ;
                $fileObj->path = $file['content'];
                $fileObj->base_url= ' ';
                $fileObj->name = $file['name'];
                $fileObj->type = $file['type'];
                $fileObj->save();
              }
            }else{
                return ResponseHelper::sendFailedResponse(['message'=>'Forbidden'],403);
            }
          }elseif (strstr($key, 'q-')){
              $key=  (int)preg_replace('/\D/ui','',$key);
              $question = $this->findModel($key);
             //check question type
             if ($question->survey_question_type === SurveyType::TYPE_SLIDER
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

                $userAnswer->survey_user_answer_point = $question->survey_question_point;
                $userAnswer->survey_user_answer_value = $value;
                $userAnswer->save(false);
              }if ($question->survey_question_type === SurveyType::TYPE_DATE_TIME
              ){
                 //handel one answer
                 $userAnswers = $question->userAnswers;
                 $userAnswer = !empty(current($userAnswers)) ? current($userAnswers) : (new SurveyUserAnswer([
                     'survey_user_answer_user_id' => \Yii::$app->user->getId(),
                     'survey_user_answer_survey_id' => $question->survey_question_survey_id,
                     'survey_user_answer_question_id' => $question->survey_question_id,
                 ]));
                $point = 0;

                $answerValue = strtotime($value);
                $from = strtotime($question->answers[0]->survey_answer_name);
                $to = strtotime($question->answers[1]->survey_answer_name);

                if ($answerValue >= $from and $answerValue <= $to) {
                    $point = $question->survey_question_point;
                }
                $userAnswer->survey_user_answer_point = $point;
                $userAnswer->survey_user_answer_value = $value;
                $userAnswer->save(false);
              }elseif ($question->survey_question_type === SurveyType::TYPE_DROPDOWN){
                 $answerPoint = SurveyAnswer::findOne(['survey_answer_id'=>$value]);
                 $userAnswers = $question->userAnswers;
                 $userAnswer = !empty(current($userAnswers)) ? current($userAnswers) : (new SurveyUserAnswer([
                     'survey_user_answer_user_id' => \Yii::$app->user->getId(),
                     'survey_user_answer_survey_id' => $question->survey_question_survey_id,
                     'survey_user_answer_question_id' => $question->survey_question_id,
                 ]));
                if ($answerPoint->correct) {
                    $userAnswer->survey_user_answer_point = $question->survey_question_point;
                 }else{
                    if ($params['status'] == 2) {
                        $this->correctiveActionReport($question,$answerPoint);
                    }
                 }
                $userAnswer->survey_user_answer_answer_id = $value;
                $userAnswer->survey_user_answer_value = $value;
                $userAnswer->save(false);

              }

              if ($question->survey_question_type === SurveyType::TYPE_ONE_OF_LIST
              ){
                // return var_dump($answer);
                 //handel one answer
                $answerPoint = SurveyAnswer::findOne(['survey_answer_id'=>$value]);
                 $userAnswers = $question->userAnswers;
                 $userAnswer = !empty(current($userAnswers)) ? current($userAnswers) : (new SurveyUserAnswer([
                     'survey_user_answer_user_id' => \Yii::$app->user->getId(),
                     'survey_user_answer_survey_id' => $question->survey_question_survey_id,
                     'survey_user_answer_question_id' => $question->survey_question_id,
                 ]));
                 if ($answerPoint->correct) {
                    $userAnswer->survey_user_answer_point = $answerPoint->question->survey_question_point;
                 }else{
                    if ($params['status'] == 2) {
                        $this->correctiveActionReport($question,$answerPoint);
                    }
                 }
                 $userAnswer->survey_user_answer_answer_id = $value;
                 $userAnswer->survey_user_answer_value = $value;
                 $userAnswer->save(false);
              }else if($question->survey_question_type === SurveyType::TYPE_MULTIPLE
                 || $question->survey_question_type === SurveyType::TYPE_MULTIPLE_TEXTBOX
             ) {
                 //delete old answers and add new
                 SurveyUserAnswer::deleteAll(['survey_user_answer_survey_id'=>$question->survey_question_survey_id ,
                     'survey_user_answer_question_id'=>$question->survey_question_id,
                     'survey_user_answer_user_id' => \Yii::$app->user->getId()
                     ]);
                 //save multiple

                 $correctCount = count(SurveyAnswer::find()->where(['survey_answer_question_id'=>$question->survey_question_id,'correct'=>1])->all());
                if ($correctCount) {
                    $point =  $question->survey_question_point / $correctCount;
                }else{
                    $point = 0;
                }
                 // return var_dump($point);
                 foreach ($question->answers as $i => $answer) {
                   $found = in_array($answer->survey_answer_id ,$value);
                    if($found){
                        $userAnswer =  new SurveyUserAnswer();

                            $userAnswer->survey_user_answer_user_id = \Yii::$app->user->getId();
                            $userAnswer->survey_user_answer_survey_id = $question->survey_question_survey_id;
                            $userAnswer->survey_user_answer_question_id = $question->survey_question_id;
                            $userAnswer->survey_user_answer_answer_id = $answer->survey_answer_id;
                            $userAnswer->survey_user_answer_value =1 ;
                            if ($answer->correct) {
                                $userAnswer->survey_user_answer_point = $point;
                            }else{
                                if ($params['status'] == 2) {
                                    $this->correctiveActionReport($question,$answer);
                                }
                            }
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
                            $userAnswer->survey_user_answer_value = $value[$answer->survey_answer_id]['rate'];
                            if ($i == 0) {
                                $userAnswer->survey_user_answer_point = $answer->question->survey_question_point;
                            }

                        $userAnswer->save(false);
                    }

                   }

             }else if($question->survey_question_type === SurveyType::TYPE_FILE) {
                 //save multiple
                if (count($value) > 0 ) {
                    SurveyUserAnswer::deleteAll(['survey_user_answer_survey_id'=>$question->survey_question_survey_id ,
                     'survey_user_answer_question_id'=>$question->survey_question_id,
                     'survey_user_answer_user_id' => \Yii::$app->user->getId()
                   ]);
                   foreach ($value as $k => $file) {
                      $userAnswer =  new SurveyUserAnswer();
                      $userAnswer->survey_user_answer_user_id = \Yii::$app->user->getId();
                      $userAnswer->survey_user_answer_survey_id = $question->survey_question_survey_id;
                      $userAnswer->survey_user_answer_question_id = $question->survey_question_id;
                      $userAnswer->survey_user_answer_value = $file['content'];
                      $userAnswer->survey_user_answer_text = $file['name'];
                      $userAnswer->survey_user_answer_file_type = $file['type'];
                      if ($k == 0) {
                        $userAnswer->survey_user_answer_point = $question->survey_question_point;
                      }
                      $userAnswer->save(false);
                    }
                }
             }//end if
          }

        }//end loap answers


        return ResponseHelper::sendSuccessResponse();

    }

    public function correctiveActionReport($questionObj,$answerObj)
    {
        $user = \Yii::$app->user->identity->userProfile;
        $report = CorrectiveActionReport::findOne(['user_id'=>$user->user_id,'answer_id'=> $answerObj->survey_answer_id]);
        if ($answerObj->survey_answer_show_corrective_action) {
            if (!$report) {
                $report = new CorrectiveActionReport();
                $report->org_id = $user->organization_id;
                $report->user_id = $user->user_id;
                $report->survey_id = $questionObj->survey->survey_id;
                $report->question_id = $questionObj->survey_question_id;
                $report->answer_id = $answerObj->survey_answer_id;
                $report->corrective_action = $answerObj->survey_answer_corrective_action;
                $report->corrective_action_date = $answerObj->corrective_action_date;
                $report->save(false);
            }
        }
    }


    public function actionSurveyStart($surveyId)
    {
        $assignedModel = SurveyStat::getAssignedUserStat(\Yii::$app->user->getId(), $surveyId);
        if (empty($assignedModel)) {
            SurveyStat::assignUser(\Yii::$app->user->getId(), $surveyId);
            $assignedModel = SurveyStat::getAssignedUserStat(\Yii::$app->user->getId(),$surveyId);
            $assignedModel->survey_stat_session_start = date('Y-m-d H:i:s');
            $assignedModel->save(false);
        }

        $assignedModel->survey_stat_session_start = date('Y-m-d H:i:s');
        $assignedModel->save(false);
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

        $start_date = new \DateTime($assignedModel->survey_stat_session_start);
        $since_start = $start_date->diff(new \DateTime(date('Y-m-d H:i:s')));
        $assignedModel->survey_stat_actual_time += ((($since_start->format("%a") * 24) + $since_start->format("%H")) * 60 + $since_start->format("%i")) * 60 + $since_start->format("%s");
        $assignedModel->save(false);

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
