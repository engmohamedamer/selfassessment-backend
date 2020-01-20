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
                return 'لديك إجراء تصحيحي يجب الانتهاء منه';
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
