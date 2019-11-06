<?php

namespace api\resources;

use backend\modules\assessment\models\Survey;
use backend\modules\assessment\models\SurveyStat;
use backend\modules\assessment\models\SurveyType;
use backend\modules\assessment\models\SurveyUserAnswer;

class SurveyResource extends Survey
{
    public function fields()
    {
        return [
            'id'=>function($model){
                return $model->survey_id;
            },
            'locale'=>function($model){
                $userId = \Yii::$app->user->identity->userProfile;
                if ($userId->locale == 'en-US') {
                    return 'en';
                }else{
                    return 'ar';
                }
            },
            'title'=>function($model){
                return $model->survey_name;
            },
            'description'=>function($model){
                return $model->survey_descr;
            },

            'showProgressBar'=>function($model){
                return 'bottom';
            },
            'showTimerPanel'=>function($model){
                return 'top';
            },
            'maxTimeToFinish'=>function($model){
                return $model->survey_time_to_pass ? $model->survey_time_to_pass * 60 : null ;
            },
            'maxTimeToFinishPage'=>function($model){
                return 10;
            },
            'firstPageIsStarted'=>function($model){
                return false;
            },
            'startSurveyText'=>function($model){
                return 'بدء الإستبيان';
            },
            'completedHtml'=>function($model){
                return "<h3 class='mb-4'>شكراً لك تم انهاء الإستبيان بنجاح </h3>";
            },
            'progress'=>function($model){
                return  Survey::surveyProgress($model,\Yii::$app->user->identity->id);
            },

            'status'=>function($model){
                $userId = \Yii::$app->user->identity->id;
                $userSurveyStat =  SurveyStat::find()->where(['survey_stat_user_id'=>$userId,'survey_stat_survey_id'=>$model->survey_id])->one();
                if (!$userSurveyStat) {
                    return 0;
                }
                return $userSurveyStat->survey_stat_is_done ? 2 : 1;
            },

            'pageNo'=>function($model){
                $userId = \Yii::$app->user->identity->id;
                $userSurveyStat =  SurveyStat::find()->where(['survey_stat_user_id'=>$userId,'survey_stat_survey_id'=>$model->survey_id])->one();
                if (!$userSurveyStat) {
                    return 0;
                }
                return $userSurveyStat->pageNo ?: 0;
            },

            'pages'=>function($model){
                $result = [];
                $assessmentQuestions = array_chunk($model->questions, 5);
                foreach ($assessmentQuestions as $k => $questions) {
                    $data =[];
                    if ($k == 0) {
                        $data[$k] = [
                            'type'=> 'html',
                            'name'=>'q',
                            'html'=>[
                                'ar'=> '<h3>تعليمات هامة</h3><p>  '. $model->start_info .' </p>'
                            ]
                        ];
                    }
                    foreach ($questions as $key => $question) {
                        if ($question->questionType->survey_type_name == 'Single textbox') {
                            $type = 'comment';
                        }elseif ($question->questionType->survey_type_name == 'One choise of list') {
                            $type = 'radiogroup';
                        }elseif ($question->questionType->survey_type_name == 'Multiple choice') {
                            $type = 'checkbox';
                        }elseif ($question->questionType->survey_type_name == 'Date/Time') {
                            $type = 'text';
                        }else{
                            $type = strtolower($question->questionType->survey_type_name);
                        }
                        if ($k > 0) {
                            $key = $key -1;
                        }
                        $data[$key+1] = [
                            'type'=> $type,
                            'name'=>'q-'.$question->survey_question_id,
                            'title'=> $question->survey_question_name,
                        ];
                        if ($question->survey_question_show_descr == 1 ) {
                            $data[$key+1]['description'] = $question->survey_question_descr;
                        }

                        if ($question->survey_question_can_skip == 1 ) {
                            $data[$key+1]['isRequired'] = false;
                        }else{
                            $data[$key+1]['isRequired'] = true;

                        }

                        if ($type == 'dropdown' || $type == 'checkbox' || $type == 'radiogroup') {
                            $qAnswer = [];
                            foreach ($question->answers as $value) {
                                $qAnswer[] = ['value'=>$value->survey_answer_id,'text'=> $value->survey_answer_name];
                            }
                            $data[$key+1]['choices'] = $qAnswer;
                        }

                        if ($question->questionType->survey_type_name == 'Date/Time') {
                            $data[$key+1]['inputType'] = 'date';
                        }

                        if ($type == 'file') {
                            $data[$key+1]['storeDataAsText'] = true;
                            $data[$key+1]['showPreview'] = true;
                            $data[$key+1]['imageWidth'] = 150;
                            $data[$key+1]['maxSize'] = 10485760;
                        }
                    }
                    $result[] = ['name'=>'page'.($k+1),'elements'=>$data];
                }

                return $result;
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
                $data = [];
                //get survey questions then check user answers

                foreach ($model->questions as  $question) {
                    //echo $question->survey_question_id.'<br>';
                    // has one value
                    if ($question->survey_question_type === SurveyType::TYPE_ONE_OF_LIST
                        || $question->survey_question_type === SurveyType::TYPE_DROPDOWN
                        || $question->survey_question_type === SurveyType::TYPE_SLIDER
                        || $question->survey_question_type === SurveyType::TYPE_SINGLE_TEXTBOX
                        || $question->survey_question_type === SurveyType::TYPE_DATE_TIME
                        || $question->survey_question_type === SurveyType::TYPE_COMMENT_BOX
                    ){
                        //fetch user answers
                        $userAnswerObj = SurveyUserAnswer::findOne([
                            'survey_user_answer_user_id'=>$userId,
                            'survey_user_answer_survey_id'=>$model->survey_id,
                            'survey_user_answer_question_id'=>$question->survey_question_id

                        ]);
                        if($userAnswerObj){
                            $data['q-'.$question->survey_question_id] = $userAnswerObj->survey_user_answer_value;

                        }

                    }else if(
                        $question->survey_question_type === SurveyType::TYPE_MULTIPLE
                        || $question->survey_question_type === SurveyType::TYPE_RANKING
                        || $question->survey_question_type === SurveyType::TYPE_MULTIPLE_TEXTBOX
                        || $question->survey_question_type === SurveyType::TYPE_CALENDAR
                    ){

                        //fetch user answers
                        $userAnswersObj = SurveyUserAnswer::find()->where([
                            'survey_user_answer_user_id'=>$userId,
                            'survey_user_answer_survey_id'=>$model->survey_id,
                            'survey_user_answer_question_id'=>$question->survey_question_id

                        ])->all();
                        if($userAnswersObj){
                            foreach ($userAnswersObj as $item) {
                                if($item->survey_user_answer_answer_id && $item->survey_user_answer_value==1) {
                                    $data['q-'.$question->survey_question_id][] = $item->survey_user_answer_answer_id;
                                }

                            }
                        }
                    }else if(
                        $question->survey_question_type === SurveyType::TYPE_FILE
                    ){
                        // return $userId;
                        //fetch user answers
                        $userAnswersObj = SurveyUserAnswer::find()->where([
                            'survey_user_answer_user_id'=>$userId,
                            'survey_user_answer_survey_id'=>$model->survey_id,
                            'survey_user_answer_question_id'=>$question->survey_question_id

                        ])->all();
                        if($userAnswersObj){
                            $path = \Yii::getAlias('@storageUrl'). '/source/';
                            foreach ($userAnswersObj as $item) {

                                $data['q-'.$question->survey_question_id][] = [
                                    'id'=>$item->survey_user_answer_id,
                                    'name'=>$item->survey_user_answer_text,
                                    'content'=>$path.$item->survey_user_answer_value
                                ];
                            }
                        }
                    }
                }


                return $data;
            }
        ];
    }


}
