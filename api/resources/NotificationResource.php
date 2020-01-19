<?php

namespace api\resources;
use common\models\Notification;

class NotificationResource extends Notification
{
    public function fields()
    {
        return [
            'id',
            'title',
            'message',
            'status',
            'type'=>function($model){
            	return $model->module;
            },
        ];
    }


}
