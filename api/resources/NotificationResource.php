<?php

namespace api\resources;
use backend\models\CorrectiveActionReport;

class NotificationResource extends CorrectiveActionReport
{
    public function fields()
    {
        return [
            'title'=>function($model){
                return $model->survey->survey_name;
            },
            'message'=>function($model){
                // return 'لديك إجراء تصحيحي - '.$model->corrective_action .' - يجب الانتهاء منه قبل '. $model->corrective_action_date;
            },
            'survey_id'=>function($model){
                return $model->survey_id;
            },
            'type'=>function($model){
            	return 'CorrectiveAction';
            },
        ];
    }


}
