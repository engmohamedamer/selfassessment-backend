<?php
namespace organization\controllers;
use Yii;
use webvimark\behaviors\multilanguage\MultiLanguageHelper;

class OrganizationBackendController extends \yii\web\Controller
{

	public function init()
    {
        MultiLanguageHelper::catchLanguage();
        if(\Yii::$app->user->identity->userProfile->locale == 'ar-AR'){
            \Yii::$app->language = 'ar';
        }else{
            \Yii::$app->language = 'en';
        }
        parent::init();
    }
}
