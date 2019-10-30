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
                return "<h3 class='mb-4'>شكراً لك تم انهاء الإستبيان بنجاح </h3><h4>للإطلاع على تقرير بإجاباتك في الاستبيان <a href='#'>من هنا</a></h4>";
            },
            'progress'=>function($model){
                return "65";
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

        ];
    }


}
