<?php
$config = [
    'homeUrl' => Yii::getAlias('@organizationUrl'),
    'controllerNamespace' => 'organization\controllers',
    'defaultRoute' => 'site/dashboard',
    'components' => [
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'request' => [
            'cookieValidationKey' => env('ORGANIZATION_COOKIE_VALIDATION_KEY'),
        ],
        'user' => [
            'class' => yii\web\User::class,
            'identityClass' => common\models\User::class,
            'loginUrl' => ['sign-in/login'],
            'enableAutoLogin' => true,
            // 'as afterLogin' => common\behaviors\LoginTimestampBehavior::class,
        ],

    ],
    'modules' => [

        'assessment' => [
            'class' => 'backend\modules\assessment\Module',
            'params' => [
                'uploadsUrl' =>  Yii::getAlias('@storageUrl').'/source/survey/', // full URL of the folder where the images will be uploaded. //Yii::getAlias('@storageUrl')
                // 'uploadsUrl' => '/uploads/survey/', // or for basic
                'uploadsPath' => '@storage/web/source/survey/', // absolute path to the folder where images will be saved.
                'organization_id'=>  5, //\Yii::$app->user->identity->userProfile->organization_id,
            ],
//            'as access' => [
//                'class' => AccessControl::class,
//                'except' => ['default/done'],
//                'only' => ['default*'],
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'roles' => ['survey'],
//                    ],
//                ],
//            ],
        ],



        'treemanager' =>  [
            'class' => '\kartik\tree\Module',
        ],
        'content' => [
            'class' => backend\modules\content\Module::class,
        ],
        'widget' => [
            'class' => backend\modules\widget\Module::class,
        ],
        'file' => [
            'class' => backend\modules\file\Module::class,
        ],
        'system' => [
            'class' => backend\modules\system\Module::class,
        ],
        'translation' => [
            'class' => backend\modules\translation\Module::class,
        ],
        'rbac' => [
            'class' => backend\modules\rbac\Module::class,
            'defaultRoute' => 'rbac-auth-item/index',
        ],

        'gridview' =>  [
            'class' => '\kartik\grid\Module',
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            'i18n' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@common/messages',
                'forceTranslation' => true
            ]
        ],

        'datecontrol' => [
            'class' => '\kartik\datecontrol\Module',
        ],


    ],
    'as globalAccess' => [
        'class' => common\behaviors\GlobalAccessBehavior::class,
        'rules' => require __DIR__ . '/_rules.php',
    ],

    'params' => [
        //'bsVersion' => '4.x',
        'icon-framework' => \kartik\icons\Icon::FAS,  // Font Awesome Icon framework
    ],


];

if (YII_ENV_DEV) {
    $config['modules']['gii'] = [
        'class' => yii\gii\Module::class,
        'generators' => [
            'crud' => [
                'class' => yii\gii\generators\crud\Generator::class,
                'templates' => [
                    'yii2-starter-kit' => Yii::getAlias('@backend/views/_gii/templates'),
                ],
                'template' => 'yii2-starter-kit',
                'messageCategory' => 'backend',
            ],
        ],
    ];

}

return $config;
