<?php

namespace api\controllers;

use Yii;
use common\models\Organization;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ThemeController extends RestController
{
    public function actionIndex($id){
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

        $footer = [];
        $menu = [];
        $images = [
            'lightLogo'=> [
                'src'=> $organization->first_image_base_url . $organization->first_image_path,
                'title'=> $organization->name,
            ],
            'darkLogo'=> [
                'src'=> $organization->second_image_base_url . $organization->second_image_path,
                'title'=> $organization->name,
            ],
            'background'=> [
                'src'=> "",
                'title'=> "",
            ],
        ];

        $organizationDate = ['id'=> $organization->id,'name'=> $organization->name ,'about'=>'About MyOrganization'];

        return ['theme_version'=>1,'organization'=>$organizationDate,'colors'=>$colors,'footer'=>$footer,'menu'=>$menu,'images'=>$images];
    }

}