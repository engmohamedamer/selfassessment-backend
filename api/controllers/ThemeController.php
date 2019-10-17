<?php

namespace api\controllers;

use Yii;
use api\helpers\ResponseHelper;
use common\models\Organization;
use common\models\User;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ThemeController extends RestController
{

    public function  behaviors()
    {
        $behaviors = parent::behaviors();
        // remove authentication filter if there is one
        unset($behaviors['authenticator']);

        if (isset(apache_request_headers()['Authorization'])) {
            $behaviors['authenticator'] = [
                'class' => CompositeAuth::class,
                'authMethods' => [
                    HttpBearerAuth::class,
                ]
            ];
            $behaviors['authenticator']['except'] = ['options'];
        }
        return $behaviors;
    }

    public function actionIndex($id,$locale = null){

        if (\Yii::$app->user->identity) {
            if (\Yii::$app->user->identity->userProfile->locale == 'ar-AR') {
                $locale = 'ar';
            }else{
                $locale = 'en';
            }
        }
        
        $organization = Organization::findOne($id);

        if (!$organization) {
            return ResponseHelper::sendFailedResponse(['ORGANIZATION_NOT_FOUND'=>'Organization not found'],404);
        }

        $theme = $organization->organizationTheme;


        if (!\Yii::$app->user->identity and is_null($locale)) {
            if ($theme->locale == 'ar-AR') {
                $locale = 'ar';
            }else{
                $locale = 'en';
            }
        }

        \Yii::$app->language = $locale; 
        
        $organization = Organization::findOne($id);

        
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

        

        $organizationDate = ['id'=> $organization->id,'name'=> $organization->name,'address'=> $organization->address ,'about'=>'About MyOrganization', 'logo'=> $organization->first_image_base_url . $organization->first_image_path, 'logo_icon'=>$organization->second_image_base_url . $organization->second_image_path,'locale'=> $locale];

        return ['theme_version'=>1,'organization'=>$organizationDate,'colors'=>$colors,'footer'=>$footer];
    }

}