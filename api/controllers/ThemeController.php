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
            'brandPrimColor'=> "rgb(38, 95, 78)",
            'brandSecColor'=> "rgb(38, 95, 78)",
            'brandHTextColor'=>  "#4d5d73",
            'brandPTextColor'=> "#4d5d73",
            'brandBlackColor'=> "#12263f",
            'brandGrayColor'=> "rgb(38, 95, 78)",
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
                'facebook'=>'http://',
                'twitter'=>'http://',
                'linkedin'=>'http://',
                'instagram'=>'http://',
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