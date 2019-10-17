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

        $theme = $organization->organizationTheme;
        $colors =[
            'brandPrimColor'=> $theme->brandPrimColor,
            'brandSecColor'=> $theme->brandSecColor,
            'brandHTextColor'=>  $theme->brandHTextColor,
            'brandPTextColor'=> $theme->brandPTextColor,
            'brandBlackColor'=> $theme->brandBlackColor,
            'brandGrayColor'=> $theme->brandGrayColor,
            'arfont'=> $theme->arfont,
            'enfont'=> $theme->enfont,
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
                ['title'=>'facebook','href'=>$theme->facebook],
                ['title'=>'twitter','href'=>$theme->twitter],
                ['title'=>'linkedin','href'=>$theme->linkedin],
                ['title'=>'instagram','href'=>$theme->instagram],
            ]
        ];

        $organizationDate = ['id'=> $organization->id,'name'=> $organization->name ,'about'=>'About MyOrganization', 'logo'=> $organization->first_image_base_url . $organization->first_image_path, 'logo_icon'=>$organization->second_image_base_url . $organization->second_image_path,'locale'=> $theme->locale];

        return ['theme_version'=>1,'organization'=>$organizationDate,'colors'=>$colors,'footer'=>$footer,'menu'=>$menu,'images'=>$images];
    }

}