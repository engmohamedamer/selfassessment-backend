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

            'elements'=> function($model){
                $data =[];
                foreach ($model->questions as $key => $question) {
                    if ($question->questionType->survey_type_name == 'Single textbox') {
                        $type = 'text'; 
                    }elseif ($question->questionType->survey_type_name == 'One choise of list') {
                        $type = 'radiogroup'; 
                    }else{
                        $type = strtolower($question->questionType->survey_type_name); 
                    }

                    $data[] = [
                        'name'=>'q-'.$question->survey_question_id,
                        'title'=> $question->survey_question_name,
                        'type'=> $type,
                    ];

                    if ($question->survey_question_show_descr == 1 ) {
                        $data[$key]['description'] = $question->survey_question_descr;
                    }

                    if ($question->survey_question_can_skip == 1 ) {
                        $data[$key]['isRequired'] = true;
                    }

                    if ($type == 'dropdown') {
                        $qAnswer = [];
                        foreach ($question->answers as $value) {
                            $qAnswer[] = ['value'=>$value->survey_answer_points,'text'=> $value->survey_answer_name]; 
                        }
                        $data[$key]['choices'] = $qAnswer;
                    }

                    if ($type == 'radiogroup') {
                        $qAnswer = [];
                        foreach ($question->answers as $value) {
                            $qAnswer[] = $value->survey_answer_name; 
                        }
                        $data[$key]['choices'] = $qAnswer;
                    }

                }
                return $data;
            },
            'pages'=>function($model){

                    return [
                            [
                                'name'=>'Page 1',
                                'elements'=>[
                                    [
                                        'type'=>"text",
                                        'name'=>'1',
                                        'title'=>'question one ?'

                                    ],
                                    [
                                        'type'=>"text",
                                        'name'=>'2',
                                        'title'=>'question two ?'

                                    ],

                                    [
                                        'type'=>'dropdown',
                                        'name'=> "El Sham3a",
                                        'title'=>'drop down question three ?',
                                        'description'=>"description for question three .. description .. description  .. description",
                                        'isRequired'=>true,
                                        'choices'=>[
                                            [
                                                'value'=>1,
                                                'text'=>'Bad'
                                            ],
                                            [
                                                'value'=>2,
                                                'text'=>'Good'
                                            ],
                                            [
                                                'value'=>3,
                                                'text'=>'Very Good'
                                            ],
                                            [
                                                'value'=>4,
                                                'text'=>'Excellent'
                                            ],

                                        ]

                                    ],
                                ],
                            ]
                    ];

            }

        ];
    }


}
