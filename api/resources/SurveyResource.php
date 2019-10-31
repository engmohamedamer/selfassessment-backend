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
                return 'ar';
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
            'firstPageIsStarted'=>function($model){
                return true;
            },
            'startSurveyText'=>function($model){
                return 'بدء الإستبيان';
            },
            'completedHtml'=>function($model){
                return "<h3 class='mb-4'>شكراً لك تم انهاء الإستبيان بنجاح </h3>";
            },
            'progress'=>function($model){
                return "65";
            },

            'status'=>function($model){
                $userSurveyStat =  SurveyStat::find()->where(['survey_stat_user_id'=>$userId,'survey_stat_survey_id'=>$model->survey_id])->one();
                return var_dump($userSurveyStat);
                if (!$userSurveyStat) {
                    return 0;
                }
                return $userSurveyStat->survey_stat_is_done;
            },

            'pageNo'=>function($model){
                $userSurveyStat =  SurveyStat::find()->where(['survey_stat_user_id'=>$userId,'survey_stat_survey_id'=>$model->survey_id])->one();
                if (!$userSurveyStat) {
                    return 0;
                }
                return $userSurveyStat->pageNo;
            },

            'pages'=>function($model){
                $data =[]['questions'];
                $data[]['questions'] = [[
                    'type'=> 'html',
                    'name'=>'q',
                    'html'=>[
                        'ar'=> '<h3>تعليمات هامة</h3><p>تعليمات  '. $model->start_info .' </p>'
                    ]
                ]];
                foreach ($model->questions as $key => $question) {
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

                    $data[]['questions'] = [[
                        'type'=> $type,
                        'name'=>'q-'.$question->survey_question_id,
                        'title'=> $question->survey_question_name,
                    ]];

                    if ($question->survey_question_show_descr == 1 ) {
                        $data[$key+1]['questions'][0]['description'] = $question->survey_question_descr;
                    }

                    if ($question->survey_question_can_skip == 1 ) {
                        $data[$key+1]['questions'][0]['isRequired'] = true;
                    }

                    if ($type == 'dropdown' || $type == 'checkbox' || $type == 'radiogroup') {
                        $qAnswer = [];
                        foreach ($question->answers as $value) {
                            $qAnswer[] = ['value'=>$value->survey_answer_id,'text'=> $value->survey_answer_name];
                        }
                        $data[$key+1]['questions'][0]['choices'] = $qAnswer;
                    }

                    if ($question->questionType->survey_type_name == 'Date/Time') {
                        $data[$key+1]['questions'][0]['inputType'] = 'date';
                    }
                }
                return $data;
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
                $userAnswers =  SurveyUserAnswer::find()->select('*,survey_question.survey_question_type')->joinWith(['question'], true, 'INNER JOIN')->where(['survey_user_answer_user_id'=>$userId,'survey_user_answer_survey_id'=>$model->survey_id])->all();
                $data = [];
                foreach ($userAnswers as $key => $value) {
                    if ($value->question->survey_question_type == SurveyType::TYPE_SINGLE_TEXTBOX) {
                        $data[] = [$value->survey_user_answer_question_id =>$value->survey_user_answer_value];
                    }else{
                        $data[] = [$value->survey_user_answer_question_id =>$value->survey_user_answer_answer_id];

                    }
                }
                return $data;
            }
        ];
    }


}
