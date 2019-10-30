<?php

namespace api\resources;

use backend\modules\assessment\models\Survey;

class SurveyResource extends Survey
{
    public function fields()
    {
        return [
            'id'=>function($model){
                return $model->survey_id;
            },
            'locale'=>function($model){
                if (\Yii::$app->user->identity->userProfile->locale == 'en-US') {
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
                return $model->survey_time_to_pass;
            },
            'firstPageIsStarted'=>function($model){
                return true;
            },
            'startSurveyText'=>function($model){
                return 'بدء الإستبيان';
            },
            'completedHtml'=>function($model){
                return "<h3 class='mb-4'>شكراً لك تم انهاء الإستبيان بنجاح </h3><h4>للإطلاع على تقرير بإجاباتك في الاستبيان <a href='#'>من هنا</a></h4>";
            },
            'progress'=>function($model){
                return "65";
            },

            'pages'=>function($model){
                $data =[]['questions'];
                foreach ($model->questions as $key => $question) {
                    if ($question->questionType->survey_type_name == 'Single textbox') {
                        $type = 'text'; 
                    }elseif ($question->questionType->survey_type_name == 'One choise of list') {
                        $type = 'radiogroup'; 
                    }elseif ($question->questionType->survey_type_name == 'Multiple choice') {
                        $type = 'checkbox'; 
                    }else{
                        $type = strtolower($question->questionType->survey_type_name); 
                    }

                    $data[]['questions'] = [[
                        'type'=> $type,
                        'name'=>'q-'.$question->survey_question_id,
                        'title'=> $question->survey_question_name,
                    ]];

                    if ($question->survey_question_show_descr == 1 ) {
                        $data[$key]['questions'][0]['description'] = $question->survey_question_descr;
                    }

                    if ($question->survey_question_can_skip == 1 ) {
                        $data[$key]['questions'][0]['isRequired'] = true;
                    }

                    if ($type == 'dropdown' || $type == 'checkbox') {
                        $qAnswer = [];
                        foreach ($question->answers as $value) {
                            $qAnswer[] = ['value'=>$value->survey_answer_points,'text'=> $value->survey_answer_name]; 
                        }
                        $data[$key]['questions'][0]['choices'] = $qAnswer;
                    }

                    if ($type == 'radiogroup') {
                        $qAnswer = [];
                        foreach ($question->answers as $value) {
                            $qAnswer[] = $value->survey_answer_name; 
                        }
                        $data[$key]['questions'][0]['choices'] = $qAnswer;
                    }

                }
                return $data;
            },

        ];
    }


}
