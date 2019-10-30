<?php

namespace api\resources;

use backend\modules\assessment\models\Survey;

class SurveyMiniResource extends Survey
{
    public function fields()
    {
        return [
            'id'=>function($model){
                return $model->survey_id;
            },
            'status'=>function($model){
                   return  rand(0,2);
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
            'remaining_time'=>function($model){
                  return '50';
            }

        ];
    }


}
