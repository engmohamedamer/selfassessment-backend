<?php

namespace api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ThemeController extends RestController
{
    public function actionIndex(){

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

        $organization = ['id'=>1,'name'=>'MyOrganization Name','about'=>'About MyOrganization'];

        return ['theme_version'=>1,'organization'=>$organization,'colors'=>$colors,'footer'=>$footer,'menu'=>$menu,'images'=>$images];
    }

}