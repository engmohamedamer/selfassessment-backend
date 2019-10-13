<?php

namespace organization\controllers;

use webvimark\behaviors\multilanguage\MultiLanguageHelper;

/**
 * Site controller
 */
class OrganizationController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    public function init()
    {

        MultiLanguageHelper::catchLanguage();
        \Yii::$app->language ='ar';

        parent::init();
    }







//    public function init()
//    {
//        parent::init();
//        \Yii::$app->keyStorage->set('accounting.theme-skin', 'skin-blue');
//
//    }


}
