<?php
return [
    //'class' => 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'enableStrictParsing' => true,
    'showScriptName' => false,
    'rules' => [
        ['pattern' => '/', 'route' => 'site/index'],
        ['pattern' => '/site', 'route' => 'site/index'],
        ['pattern' => '/site/index', 'route' => 'site/index'],
        ['pattern' => '/login', 'route' => 'user/login'],
        ['pattern' => '/signup', 'route' => 'user/signup'],
        ['pattern' => '/reset-password', 'route' => 'user/reset-password'],
        ['pattern' => '/request-reset-password', 'route' => 'user/request-reset-password'],
        ['pattern' => '/theme', 'route' => 'theme/index'],
        ['pattern' => '/theme/<slug>/<lang>', 'route' => 'theme/index'],
        ['pattern' => '/assessments/report/<id>', 'route' => 'assessments/report'],
        ['pattern' => '/media/upload', 'route' => 'media/upload'],
        ['pattern' => '/media/delete-file', 'route' => 'media/delete-file'],

        ['class' =>'yii\rest\UrlRule','controller'=>'user'
            ,'only'=>['login','signup','reset-password','request-reset-password','options']
            ,'extraPatterns'=>[
                'POST  signup' => 'signup',
                'POST login' => 'login',
                'POST reset-password'=>'reset-password',
                'POST request-reset-password'=>'request-reset-password',

            ]
            , 'pluralize'=>false
        ],
//

        ['class' =>'yii\rest\UrlRule',
            'controller'=>'assessments',
            'only'=>['index','view','update','delete-file','report','options'],//'update',
            'extraPatterns'=>[
                'GET ' => 'index' ,
                'GET <id>' => 'view' ,
                'GET report/<id>' => 'view' ,
                'PUT ' => 'update',
                'DELETE delete-file' => 'delete-file',
            ],
            'pluralize'=>false
        ],

        ['class' =>'yii\rest\UrlRule',
            'controller'=>'media',
            'only'=>['create','delete-file','upload','options'],//'update',
            'extraPatterns'=>[
                'POST ' => 'create' ,
                'POST upload' => 'upload' ,
                'DELETE delete-file' => 'delete-file',
            ],
            'pluralize'=>false
        ],


        ['class' =>'yii\rest\UrlRule',
            'controller'=>'profile',
            'only'=>['index','update','options'],
            'extraPatterns'=>[
                'GET ' => 'index' ,
                'PUT ' => 'update',
            ],
            'pluralize'=>false
        ],

        ['class' =>'yii\rest\UrlRule',
            'controller'=>'theme',
            'only'=>['index'],
            'extraPatterns'=>[
                'GET ' => 'index'
            ],
            'pluralize'=>false
        ],


        ['class' => 'yii\rest\UrlRule', 'controller' => 'lookups' ,'pluralize'=>false ,
            'only' => ['list-cities','list-districts'],

            'extraPatterns'=>[
                'GET list-cities' => 'list-cities',
                'GET list-districts' => 'list-districts',

            ]

        ],




    ]
];
