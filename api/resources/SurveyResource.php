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
            'progress'=>function($model){
                return "65";
            },
            'title'=>function($model){
                return $model->survey_name;
            },

            'description'=>function($model){
                return $model->survey_descr;
            },

            'survey_time_to_pass'=>function($model){
                return $model->survey_time_to_pass;
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
                                        'name'=>3,
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
