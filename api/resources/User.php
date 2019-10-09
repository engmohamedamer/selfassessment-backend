<?php

namespace api\resources;

class User extends \common\models\User
{
    public function fields()
    {
        return [
            'id'=>function($model){
                 return $model->id;
              },
            'email',
            'firstname'=>function($model){
                return $model->userProfile->firstname ;
            },
            'lastname'=>function($model){
                return $model->userProfile->lastname ;
            },

        ];
    }


}
