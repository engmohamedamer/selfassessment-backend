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
            'mobile'=>function($model){
                return $model->userProfile->mobile ;
            },
            'profile_picture'=>function($model){
                return $model->userProfile->avatar_base_url.$model->userProfile->avatar_path ;
            },
            'bio'=>function($model){
                return $model->userProfile->bio;
            },
            'organization'=>function($model){
                return ['id'=>1,'name'=>'MyOrganization Name'];
            },
        ];
    }


}
