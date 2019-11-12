<?php
/**
 * Created by PhpStorm.
 * User: engamer
 * Date: 04/02/19
 * Time: 10:03 ص
 */

namespace api\controllers;

use webvimark\behaviors\multilanguage\MultiLanguageHelper;
use yii\data\ActiveDataProvider;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

/**
 * Class ArticleController
 * @author Eugene Terentev <eugene@terentev.net>
 */
class MyActiveController extends ActiveController
{

    public $defaultPageSize= 5; // 20
    public $pageSize= 5;  // 50
    public $pageSizeLimit= [1,200];


    public static function allowedDomains()
    {
        return [
            '*',                        // star allows all domains
            'http://selfassest.localhost',
        ];
    }


    public function init()
    {
        if(! \Yii::$app->user->isGuest){
            MultiLanguageHelper::catchLanguage();
            if(\Yii::$app->user->identity->userProfile->locale == 'ar-AR'){
                \Yii::$app->language = 'ar';
            }else{
                \Yii::$app->language = 'en';
            }
        }

        // \Yii::$app->language = 'ar'; //\Yii::$app->user->identity->userProfile->locale;

        parent::init();
    }


    public function  behaviors()
    {
        $behaviors = parent::behaviors();
        // remove authentication filter if there is one
        unset($behaviors['authenticator']);

        // add CORS filter before authentication
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => self::allowedDomains(),
                'Access-Control-Request-Method' => ['*'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];


        // Put in a bearer auth authentication filter
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::class,
            'authMethods' => [
                HttpBearerAuth::class,
            ]
        ];
        // avoid authentication on CORS-pre-flight requests (HTTP OPTIONS method)
        $behaviors['authenticator']['except'] = ['options'];
        return $behaviors;
    }



    public function actions(){
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex(){

        $params= \Yii::$app->request->get();

        $query= $this->modelClass::find();

        $activeData = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'defaultPageSize' => $this->defaultPageSize , // to set default count items on one page
                'pageSize' => $this->pageSize, //to set count items on one page, if not set will be set from defaultPageSize
                'pageSizeLimit' => $this->pageSizeLimit, //to set range for pageSize

            ],
        ]);
        return $activeData;
    }


    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];


}

