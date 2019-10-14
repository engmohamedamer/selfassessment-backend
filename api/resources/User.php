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
            'organization_name'=>function($model){
                return 'MyOrganization Name';
            },
            'organization'=>function($model){
                return ['id'=>1,'name','Organization name'];
            },
            'theme'=> function()
            {
                $colors =[
                    'brandPrimColor'=> "rgb(38, 95, 78)",
                    'brandSecColor'=> "rgb(38, 95, 78)",
                    'brandHTextColor'=>  "#4d5d73",
                    'brandPTextColor'=> "#4d5d73",
                    'brandBlackColor'=> "#12263f",
                    'brandGrayColor'=> "rgb(38, 95, 78)",
                    'arfont'=> "Cairo, sans-serif",
                    'enfont'=> "Roboto, sans-serif",
                ];

                $footer = [];
                $menu = [];
                $images = [
                    'lightLogo'=> [
                        'src'=> "",
                        'title'=> "",
                    ],
                    'darkLogo'=> [
                        'src'=> "",
                        'title'=> "",
                    ],
                    'background'=> [
                        'src'=> "",
                        'title'=> "",
                    ],
                ];
                return ['colors'=>$colors,'footer'=>$footer,'menu'=>$menu,'images'=>$images];
            },

        ];
    }


}
