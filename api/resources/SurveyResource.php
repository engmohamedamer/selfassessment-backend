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
                return SurveyStat::remainingTime($model,\Yii::$app->user->identity->id) * 60 ;
            },

            'firstPageIsStarted'=>function($model){
                return true;
            },
            'startSurveyText'=>function($model){
                return 'بدء الإستبيان';
            },
            'completedHtml'=>function($model){
                return "<h3 class='mb-4'>جاري حفظ الإستبيان .. </h3>";
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
                $result[] = [
                    'name'=> 'page1',
                    'elements'=>[
                        [
                            'type'=>'html',
                            'name'=>'q',
                            'html'=>[
                                'ar'=> '<h3>تعليمات هامة</h3><p>  '. $model->start_info .' </p>'
                            ]
                        ]
                    ]
                ];
                $assessmentQuestions = array_chunk($model->questions, 5);
                foreach ($assessmentQuestions as $k => $questions) {
                    $data =[];

                    foreach ($questions as $key => $question) {
                        if ($question->questionType->survey_type_name == 'Single textbox') {
                            $type = 'text';
                        }elseif ($question->questionType->survey_type_name == 'One choise of list') {
                            $type = 'radiogroup';
                        }elseif ($question->questionType->survey_type_name == 'Multiple choice') {
                            $type = 'checkbox';
                        }elseif ($question->questionType->survey_type_name == 'Date/Time') {
                            $type = 'text';
                        }elseif ($question->questionType->survey_type_name == 'Ranking') {
                            $type = 'matrixdropdown';
                        }elseif ($question->questionType->survey_type_name == 'Comment box') {
                            $type = 'comment';
                        }else{
                            $type = strtolower($question->questionType->survey_type_name);
                        }

                        $data[$key] = [
                            'type'=> $type,
                            'name'=>'q-'.$question->survey_question_id,
                            'title'=> $question->survey_question_name,
                        ];
                        if ($question->survey_question_show_descr == 1 ) {
                            $data[$key]['description'] = $question->survey_question_descr;
                        }

                        if ($question->survey_question_can_skip == 1 ) {
                            $data[$key]['isRequired'] = false;
                        }else{
                            $data[$key]['isRequired'] = true;

                        }

                        if ($type == 'dropdown' || $type == 'checkbox' || $type == 'radiogroup') {
                            $qAnswer = [];
                            foreach ($question->answers as $value) {
                                $qAnswer[] = ['value'=>$value->survey_answer_id,'text'=> $value->survey_answer_name];
                            }
                            $data[$key]['choices'] = $qAnswer;
                        }

                        if ($question->questionType->survey_type_name == 'Date/Time') {
                            $data[$key]['inputType'] = 'date';
                        }

                        if ($type == 'file') {
                            $data[$key]['storeDataAsText'] = false;
                            $data[$key]['showPreview'] = true;
                            $data[$key]['imageWidth'] = 150;
                            $data[$key]['allowMultiple'] = true;
                            $data[$key]['maxSize'] = 10485760;
                        }

                        if ($type == 'matrixdropdown') {
                            $qAnswer = [];
                            $columns = [];
                            foreach ($question->answers as $index => $value) {
                                $qAnswer[] = ['value'=> $value->survey_answer_id,'text'=> $value->survey_answer_name];
                                $i = $index+1 ;
                                $columns[] = ['value'=> $i,
                                    'text'=> "$i"
                                ];
                            }
                            $data[$key]['columns'] = [[
                                "name"=>"rate",
                                "title"=>$question->survey_question_descr,
                                "choices"=>$columns
                            ]];
                            $data[$key]['rows'] = $qAnswer;
                        }
                    }
                    $result[$k+1] = ['name'=>'page'.($k+2),'elements'=>$data];
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
                        $question->survey_question_type === SurveyType::TYPE_RANKING
                    ){

                        //fetch user answers
                        $userAnswersObj = SurveyUserAnswer::find()->where([
                            'survey_user_answer_user_id'=>$userId,
                            'survey_user_answer_survey_id'=>$model->survey_id,
                            'survey_user_answer_question_id'=>$question->survey_question_id

                        ])->all();
                        if($userAnswersObj){
                            $qAnswer = [];
                            foreach ($userAnswersObj as $item) {
                                    $qAnswer[$item->survey_user_answer_answer_id] = ['rate'=>$item->survey_user_answer_value];
                            }

                            $data['q-'.$question->survey_question_id] = $qAnswer;
                            $qAnswer = [];
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
