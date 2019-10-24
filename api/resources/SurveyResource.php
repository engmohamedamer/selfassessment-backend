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

            'title'=>function($model){
                return $model->survey_name;
            },


            'description'=>function($model){
                return $model->survey_descr;
            },


            'survey_time_to_pass'=>function($model){
                return $model->survey_time_to_pass;
            },

        ];
    }


}
