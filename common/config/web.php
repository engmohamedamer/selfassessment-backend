<?php
$config = [
    'components' => [

        'assetManager' => [
            'class' => yii\web\AssetManager::class,
            'linkAssets' => env('LINK_ASSETS'),
            'appendTimestamp' => false , //YII_ENV_DEV,
//            'bundles' => [
//                'yii\bootstrap4\BootstrapAsset' => [
//                    'sourcePath' => '@npm/bootstrap/dist'
//                ],
//                'yii\bootstrap4\BootstrapPluginAsset' => [
//                    'sourcePath' => '@npm/bootstrap/dist'
//                ]
//            ],


        ],

    ],

    'modules' => [
        'treemanager' =>  [
            'class' => '\kartik\tree\Module',
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
        ]

    ],

    'as locale' => [
        'class' => common\behaviors\LocaleBehavior::class,
        'enablePreferredLanguage' => true
    ]
];

if (YII_DEBUG) {
//    $config['bootstrap'][] = 'debug';
//    $config['modules']['debug'] = [
//        'class' => yii\debug\Module::class,
//        'allowedIPs' => ['::1', '192.168.33.1', '172.17.42.1', '192.168.99.1', '172.*.0.1'],
//    ];
}

if (YII_ENV_DEV) {
//    $config['modules']['gii'] = [
//        'allowedIPs' => ['127.0.0.1', '::1', '192.168.33.1', '172.17.42.1', '172.17.0.1', '192.168.99.1', '*'],
//    ];
}

return $config;
