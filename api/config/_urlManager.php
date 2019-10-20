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
        ['pattern' => '/theme', 'route' => 'theme/index'],
        ['pattern' => '/theme/<slug>/<lang>', 'route' => 'theme/index'],

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
