<?php

namespace api\resources;
use backend\models\CorrectiveActionReport;

class NotificationResource extends CorrectiveActionReport
{
    public function fields()
    {
        return [
            'id',
            'title'=>function($model){
                return $model->survey->survey_name;
            },
            'message'=>function($model){
                return 'لديك إجراء تصحيحي - '.$model->corrective_action .' - يجب الانتهاء منه قبل '. $model->corrective_action_date;
            },
            'status',
            'type'=>function($model){
            	return 'CorrectiveAction';
            },
        ];
    }


}
