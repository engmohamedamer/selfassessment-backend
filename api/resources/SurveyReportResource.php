<?php

namespace api\resources;

use backend\modules\assessment\models\Survey;
use backend\modules\assessment\models\SurveyStat;
use backend\modules\assessment\models\SurveyType;
use backend\modules\assessment\models\SurveyUserAnswer;

class SurveyReportResource extends Survey
{
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
                $userId = \Yii::$app->user->identity->id;
                $userSurveyStat =  SurveyStat::find()->where(['survey_stat_user_id'=>$userId,'survey_stat_survey_id'=>$model->survey_id])->one();
                if (!$userSurveyStat) {
                    return 0;
                }
                return $userSurveyStat->survey_stat_is_done;
            },

            'generalInfo'=>function($model){
                $userId= \Yii::$app->user->identity->id;
                return [
                    'total_points'=>50,
                    'gained_points'=>25,
                    'progress'=>$this->surveyProgress($model,$userId),
                    'actual_time'=>SurveyStat::actualTime($model->survey_id,$userId),

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
                $userId = \Yii::$app->user->identity->id;
                $data =$result= [];
                //get survey questions then check user answers
                $i=1;
                foreach ($model->questions as  $question) {
                    //echo $question->survey_question_id.'<br>';

                    // has one value
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
                        || $question->survey_question_type === SurveyType::TYPE_RANKING
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
                            $path = \Yii::getAlias('@storageUrl'). '/source/';

                            foreach ($userAnswersObj as $item) {
                                $temp[] = $path.$item->survey_user_answer_value;
                            }
                            $answer = $temp;
                        }
                    }

                    $data = [
                        'qNum'=>$i++,
                        'qText'=>$question->survey_question_name,
                        'qAnswer'=>$answer,
                        'qGainedPoints'=>rand(1,300),
                        'qTotalPoints'=>'300',
                        'qCorrectiveActions'=> $correctiveActions
                    ];
                    $correctiveActions = [];
                    $result [] = $data;
                }


                return $result;
            }
        ];
    }





}
