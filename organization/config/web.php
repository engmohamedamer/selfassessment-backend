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
            'baseUrl' => env('BACKEND_BASE_URL'),
        ],
        'user' => [
            'class' => yii\web\User::class,
            'identityClass' => common\models\User::class,
            'loginUrl' => ['sign-in/login'],
            'enableAutoLogin' => true,
            'as afterLogin' => common\behaviors\LoginTimestampBehavior::class,
        ],

    ],
    'modules' => [
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
