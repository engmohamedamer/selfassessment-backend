<?php

namespace api\resources;

use backend\modules\assessment\models\Survey;
use backend\modules\assessment\models\SurveyStat;
use backend\modules\assessment\models\SurveyType;
use backend\modules\assessment\models\SurveyUserAnswer;
use common\models\SurveyUserAnswerAttachments;

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
                return SurveyStat::remainingTime($model,\Yii::$app->user->identity->id);
            },

            'firstPageIsStarted'=>function($model){
                return true;
            },
            'goNextPageAutomatic'=>function($model){
                return true;
            },
            'showQuestionNumbers'=>function($model){
                return 'off';
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
                    $c = 0;
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
                        }elseif ($question->questionType->survey_type_name == 'Rating') {
                            $type = 'rating';
                        }else{
                            $type = strtolower($question->questionType->survey_type_name);
                        }

                        $data[$c] = [
                            'type'=> $type,
                            'name'=>'q-'.$question->survey_question_id,
                            'title'=> $question->survey_question_name,
                        ];
                        if ($question->survey_question_show_descr == 1 ) {
                            $data[$c]['description'] = $question->survey_question_descr;
                        }

                        if ($question->survey_question_can_skip == 1 ) {
                            $data[$c]['isRequired'] = false;
                        }else{
                            $data[$c]['isRequired'] = true;

                        }

                        if ($type == 'dropdown' || $type == 'checkbox' || $type == 'radiogroup') {
                            $qAnswer = [];
                            foreach ($question->answers as $value) {
                                $qAnswer[] = ['value'=>$value->survey_answer_id,'text'=> $value->survey_answer_name];
                            }
                            $data[$c]['choices'] = $qAnswer;
                        }

                        if ($question->questionType->survey_type_name == 'Date/Time') {
                            $data[$c]['inputType'] = 'date';
                        }

                        if ($type == 'rating') {
                            $data[$c]['rateStep'] = $question->steps;
                            $data[$c]['rateMin'] = $question->answers[0]->survey_answer_name;
                            $data[$c]['rateMax'] = $question->answers[1]->survey_answer_name;
                            $data[$c]['minRateDescription'] = $question->answers[0]->survey_answer_descr;
                            $data[$c]['maxRateDescription'] = $question->answers[1]->survey_answer_descr;
                        }

                        if ($type == 'file') {
                            $data[$c]['storeDataAsText'] = false;
                            $data[$c]['showPreview'] = true;
                            $data[$c]['imageWidth'] = 150;
                            $data[$c]['allowMultiple'] = true;
                            $data[$c]['maxSize'] = 10485760;
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

                            $userId = \Yii::$app->user->identity->userProfile;
                            if ($userId->locale == 'en-US') {
                                $descr = 'Sorting';
                            }else{
                                $descr = 'الترتيب';
                            }
                            $data[$c]['columns'] = [[
                                "name"=>"rate",
                                "title"=>$descr,
                                "choices"=>$columns
                            ]];
                            $data[$c]['rows'] = $qAnswer;
                        }
                        if ($question->survey_question_attachment_file) {
                            $data[$c+1] = [
                                'type'=> "panel",
                                "startWithNewLine"=>false,
                                'elements'=> [
                                    [
                                        'name'=>'f-'.$question->survey_question_id,
                                        'type'=> "boolean",
                                        'label'=> "تريد إرفاق بعض الملفات؟",
                                    ],
                                    [
                                        "name"=> 'a-'.$question->survey_question_id,
                                        "showTitle"=> false,
                                        "type"=>"file",
                                        "title"=>"اختر مرفقات اجابتك",
                                        'storeDataAsText'=> false,
                                        'showPreview'=> true,
                                        'imageWidth'=> 150,
                                        'allowMultiple'=> true,
                                        'maxSize'=> 10485760,
                                        "visibleIf"=>"{f-".$question->survey_question_id."} == true",
                                    ]
                                ],
                            ];
                            $c = $c+2;
                        }else{
                            $c = $c+1;
                        }
                    }
                    $result[$k+1] = ['name'=>'page'.($k+2),'elements'=>$data];
                }

                return $result;
            },
            'answers'=>function($model){
                $userId = \Yii::$app->user->identity->id;
                $data = [];
                //get survey questions then check user answers

                foreach ($model->questions as $key => $question) {
                    // has one value
                    $c = 0;
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
                        //fetch user answers
                        $userAnswersObj = SurveyUserAnswer::find()->where([
                            'survey_user_answer_user_id'=>$userId,
                            'survey_user_answer_survey_id'=>$model->survey_id,
                            'survey_user_answer_question_id'=>$question->survey_question_id

                        ])->all();
                        if($userAnswersObj){
                            foreach ($userAnswersObj as $item) {

                                $data['q-'.$question->survey_question_id][] = [
                                    'id'=>$item->survey_user_answer_id,
                                    'name'=>$item->survey_user_answer_text,
                                    'content'=>$item->survey_user_answer_value,
                                    'type'=>$item->survey_user_answer_file_type
                                ];
                            }
                        }
                    }
                    
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

                    if (count($files) > 0) {
                        $data['a-'.$question->survey_question_id] = $qAttatchments;   
                        $data['f-'.$question->survey_question_id] = true;   
                    }

                } // end questions for loop

                return $data;
            }
        ];
    }


}
