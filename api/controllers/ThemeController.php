<?php

namespace api\controllers;

use Yii;
use common\models\Organization;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ThemeController extends RestController
{
    public function actionIndex($id,$locale = 'ar'){

        $organization = Organization::findOne($id);

        if (!$organization) {
            return (new NotFoundHttpException(Yii::t('yii', 'Page not found.')));
        }

        $colors =[
            'brandPrimColor'=> "#1abc9c",
            'brandSecColor'=> "#16a085",
            'brandHTextColor'=>  "#2c3e50",
            'brandPTextColor'=> "#34495e",
            'brandBlackColor'=> "#000",
            'brandGrayColor'=> "#bdc3c7",
            'arfont'=> "Cairo, sans-serif",
            'enfont'=> "Roboto, sans-serif",
        ];

        $footer = [
            'links'=>[
                ['title'=>'Home','href'=>'http://'],
                ['title'=>'About','href'=>'http://'],
                ['title'=>'Contact','href'=>'http://'],
                ['title'=>'Test','href'=>'http://'],
                ['title'=>'Data','href'=>'http://'],
            ],
            'social_media'=>[
                ['title'=>'facebook','href'=>'http://'],
                ['title'=>'twitter','href'=>'http://'],
                ['title'=>'linkedin','href'=>'http://'],
                ['title'=>'instagram','href'=>'http://'],
            ]
        ];

        if ($locale == 'en') {
            $name = $organization->name_en;
        }else{
            $name = $organization->name;
        }
        $organizationDate = ['id'=> $organization->id,'name'=> $name ,'about'=>'About MyOrganization', 'logo'=> $organization->first_image_base_url . $organization->first_image_path, 'logo_icon'=>$organization->second_image_base_url . $organization->second_image_path,'locale'=> $locale];

        return ['theme_version'=>1,'organization'=>$organizationDate,'colors'=>$colors,'footer'=>$footer,'menu'=>$menu,'images'=>$images];
    }

}