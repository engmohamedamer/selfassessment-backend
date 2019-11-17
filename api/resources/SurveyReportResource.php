<?php

namespace api\resources;

use backend\modules\assessment\models\Survey;
use backend\modules\assessment\models\SurveyStat;
use backend\modules\assessment\models\SurveyType;
use backend\modules\assessment\models\SurveyUserAnswer;
use common\models\SurveyUserAnswerAttachments;

class SurveyReportResource extends Survey
{

   public  function getUserId(){

//       if(\Yii::$app->user->can('governmentRep')){
//
//       }

       if(isset($_SESSION['userID'])){
           return $_SESSION['userID'];

       }
       return \Yii::$app->user->identity->id;
   }

    public function fields()
    {
        return [
            'id'=>function($model){
                return $model->survey_id;
            },
            'locale'=>function($model){
                return 'ar';
            },
            'title'=>function($model){
                return $model->survey_name;
            },
            'description'=>function($model){
                return $model->survey_descr;
            },


            'status'=>function($model){
                $userId = $this->userId;
                $userSurveyStat =  SurveyStat::find()->where(['survey_stat_user_id'=>$userId,'survey_stat_survey_id'=>$model->survey_id])->one();
                if (!$userSurveyStat) {
                    return 0;
                }
                return $userSurveyStat->survey_stat_is_done;
            },

            'generalInfo'=>function($model){
                $userId= $this->userId;
                $time = SurveyStat::actualTime($model->survey_id,$userId);
                $survey_end_at = date("Y-m-d",strtotime((SurveyStat::find(['survey_stat_user_id'=>$userId,'survey_stat_user_id'=>$model->survey_id])->one())->survey_stat_updated_at));

                $gained_points =  \Yii::$app->db->createCommand('SELECT sum(survey_user_answer_point) as gained_points from survey_user_answer where survey_user_answer_user_id = '. \Yii::$app->user->getId() .' and survey_user_answer_survey_id ='.$model->survey_id )->queryScalar();
                return [
                    'survey_created_at'=>date("Y-m-d",strtotime($model->survey_created_at)),
                    'survey_expired_at'=>date("Y-m-d",strtotime($model->survey_expired_at)),
                    'survey_end_at'=>$survey_end_at,
                    'survey_number'=>$model->survey_id .'/'. date("Y",strtotime($model->survey_created_at)) ,
                    'survey_time_to_pass'=> $model->survey_time_to_pass,
                    'survey_question_number'=> count($model->questions),
                    'survey_corrective_number'=>rand(1,10),
                    'total_points'=> $model->survey_point,
                    'gained_points'=>$gained_points,
                    'progress'=>$this->surveyProgress($model,$userId),
                    'actual_time'=> $time,
                ];

            },
            'answers'=>function($model){

                /*
                {
                   "44": [
                      93,
                      94
                   ],
                    "47": "Amer test"
                }
                */
                $userId =$this->userId;
                $data =$result= [];
                //get survey questions then check user answers
                $i=1;
                foreach ($model->questions as  $question) {
                    //echo $question->survey_question_id.'<br>';
                    // has one value
                    $type = null;

                    if ( $question->survey_question_type === SurveyType::TYPE_SLIDER
                        || $question->survey_question_type === SurveyType::TYPE_SINGLE_TEXTBOX
                        || $question->survey_question_type === SurveyType::TYPE_DATE_TIME
                        || $question->survey_question_type === SurveyType::TYPE_COMMENT_BOX
                    ){
                        $temp=[];
                        $correctiveActions= [];
                        //fetch user answers
                        $userAnswerObj = SurveyUserAnswer::findOne([
                            'survey_user_answer_user_id'=>$userId,
                            'survey_user_answer_survey_id'=>$model->survey_id,
                            'survey_user_answer_question_id'=>$question->survey_question_id

                        ]);
                        if($userAnswerObj){
                            $answer = $userAnswerObj->survey_user_answer_value;

                        }

                    }else if($question->survey_question_type === SurveyType::TYPE_ONE_OF_LIST
                        || $question->survey_question_type === SurveyType::TYPE_DROPDOWN
                    ){
                        $temp=[];
                        $correctiveActions= [];
                        //fetch user answers
                        $userAnswerObj = SurveyUserAnswer::findOne([
                            'survey_user_answer_user_id'=>$userId,
                            'survey_user_answer_survey_id'=>$model->survey_id,
                            'survey_user_answer_question_id'=>$question->survey_question_id

                        ]);
                        if($userAnswerObj){
                            $answer = $userAnswerObj->surveyUserAnswerValueAnswer->survey_answer_name;
                            $correctiveActions = $userAnswerObj->surveyUserAnswerValueAnswer->survey_answer_corrective_action;


                        }

                    }else if(
                        $question->survey_question_type === SurveyType::TYPE_MULTIPLE
                        || $question->survey_question_type === SurveyType::TYPE_MULTIPLE_TEXTBOX
                        || $question->survey_question_type === SurveyType::TYPE_CALENDAR
                    ){
                        $temp=[];
                        $correctiveActions= [];

                        //fetch user answers
                        $userAnswersObj = SurveyUserAnswer::find()->where([
                            'survey_user_answer_user_id'=>$userId,
                            'survey_user_answer_survey_id'=>$model->survey_id,
                            'survey_user_answer_question_id'=>$question->survey_question_id

                        ])->all();
                        if($userAnswersObj){
                            $temp=[];
                            $correctiveAction= [];
                            foreach ($userAnswersObj as $item) {
                                if($item->survey_user_answer_answer_id && $item->survey_user_answer_value==1) {
                                    $temp[] = $item->surveyUserAnswerAnswer->survey_answer_name;
                                    $correctiveAction[] = $item->surveyUserAnswerAnswer->survey_answer_corrective_action;
                                }

                            }

                            $answer = $temp;
                            $correctiveActions = $correctiveAction;

                        }


                    }else if(
                        $question->survey_question_type === SurveyType::TYPE_RANKING
                    ){
                        $temp=[];
                        $correctiveActions= [];

                        //fetch user answers
                        $userAnswersObj = SurveyUserAnswer::find()->where([
                            'survey_user_answer_user_id'=>$userId,
                            'survey_user_answer_survey_id'=>$model->survey_id,
                            'survey_user_answer_question_id'=>$question->survey_question_id

                        ])->all();
                        if($userAnswersObj){
                            $temp=[];
                            $correctiveAction= [];
                            foreach ($userAnswersObj as $item) {
                                if($item->survey_user_answer_answer_id) {
                                    $temp[] = $item->surveyUserAnswerAnswer->survey_answer_name
                                    . ": " . $item->survey_user_answer_value;
                                }

                            }

                            $answer = $temp;
                        }


                    }else if(
                        $question->survey_question_type === SurveyType::TYPE_FILE
                    ){
                        $temp=[];
                        $correctiveActions= [];
                        //fetch user answers
                        $userAnswersObj = SurveyUserAnswer::find()->where([
                            'survey_user_answer_user_id'=>$userId,
                            'survey_user_answer_survey_id'=>$model->survey_id,
                            'survey_user_answer_question_id'=>$question->survey_question_id

                        ])->all();
                        // return var_dump($userAnswersObj);
                        if($userAnswersObj){
                            foreach ($userAnswersObj as $item) {
                                $temp[] = [
                                    'id'=>$item->survey_user_answer_id,
                                    'name'=>$item->survey_user_answer_text,
                                    'content'=>$item->survey_user_answer_value
                                ];
                            }
                            $answer = $temp;
                        }
                    }

                    $type  = $question->questionType->survey_type_name;
                    $qAttatchments = [];
                    $files = SurveyUserAnswerAttachments::findAll(['survey_user_answer_attachments_survey_id'=>$question->survey_question_survey_id ,
                       'survey_user_answer_attachments_question_id'=>$question->survey_question_id,
                       'survey_user_answer_attachments_user_id' => \Yii::$app->user->getId()
                       ]);
                    foreach ($files as $key => $file) {
                        $qAttatchments[] = [
                            'type'=>$file->type,
                            'content'=>$file->path,
                            'name'=>$file->name
                        ];
                    }
                    $data = [
                        'qNum'=>$i++,
                        'qText'=>$question->survey_question_name,
                        'qAnswer'=>$answer,
                        'qGainedPoints'=>rand(1,300),
                        'qTotalPoints'=>'300',
                        'qCorrectiveActions'=> $correctiveActions,
                        'qType'=>$type,
                        'qAttatchments'=> $qAttatchments
                    ];
                    $correctiveActions = [];
                    $qAttatchments = [];
                    $answer = null;
                    $result [] = $data;
                }


                return $result;
            }
        ];
    }





}
