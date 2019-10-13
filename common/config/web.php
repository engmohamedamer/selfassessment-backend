<?php
$config = [
    'components' => [

        'assetManager' => [
            'class' => yii\web\AssetManager::class,
            'linkAssets' => env('LINK_ASSETS'),
            'appendTimestamp' => YII_ENV_DEV,
            'bundles' => [
                'yii\bootstrap4\BootstrapAsset' => [
                    'sourcePath' => '@npm/bootstrap/dist'
                ],
                'yii\bootstrap4\BootstrapPluginAsset' => [
                    'sourcePath' => '@npm/bootstrap/dist'
                ]
            ],


        ],

    ],
    
    'modules' => [
        'treemanager' =>  [
            'class' => '\kartik\tree\Module',
            // enter other module properties if needed
            // for advanced/personalized configuration
            // (refer module properties available below)
            'i18n' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@common/messages',
                'forceTranslation' => true,
                'fileMap' => [
                    'common' => 'common.php',
                    'backend' => 'backend.php',
                    'frontend' => 'frontend.php',
                    'kvtree' => 'kvtree.php',
                ],
                'on missingTranslation' => [backend\modules\translation\Module::class, 'missingTranslation']
            ],
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
            // see settings on http://demos.krajee.com/datecontrol#module
        ],


    ],

    'params' => [
        'bsDependencyEnabled' => true, // this will not load Bootstrap CSS and JS for all Krajee extensions
        // you need to ensure you load the Bootstrap CSS/JS manually in your view layout before Krajee CSS/JS assets
        //
        // other params settings below
        'bsVersion' => '4.x',
        // 'adminEmail' => 'admin@example.com',

        'icon-framework' => \kartik\icons\Icon::FAS,  // Font Awesome Icon framework
    ],


    'as locale' => [
        'class' => common\behaviors\LocaleBehavior::class,
        'enablePreferredLanguage' => true
    ]
];

if (YII_DEBUG) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => yii\debug\Module::class,
        'allowedIPs' => ['::1', '192.168.33.1', '172.17.42.1', '192.168.99.1', '172.*.0.1'],
    ];
}

if (YII_ENV_DEV) {
    $config['modules']['gii'] = [
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.33.1', '172.17.42.1', '172.17.0.1', '192.168.99.1', '*'],
    ];
}

return $config;
