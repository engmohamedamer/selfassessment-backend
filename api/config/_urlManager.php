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

        ['class' =>'yii\rest\UrlRule','controller'=>'user'
            ,'only'=>['login','signup','options']
            ,'extraPatterns'=>[
                'POST create' => 'create',
                'POST login' => 'login',
                'POST signup' => 'signup',

            ]
            , 'pluralize'=>false
        ],
//




        ['class' =>'yii\rest\UrlRule',
            'controller'=>'profile',
            'only'=>['index','update','options'],
            'extraPatterns'=>[
                'GET ' => 'index' ,
                'PUT ' => 'update'
            ],
            'pluralize'=>false
        ],

        ['class' =>'yii\rest\UrlRule',
            'controller'=>'theme',
            'only'=>['index'],
            'extraPatterns'=>[
                'POST <id>/<locale>' => 'index',
                'POST <id>' => 'index' 
            ],
            'pluralize'=>false
        ],


        ['class' => 'yii\rest\UrlRule', 'controller' => 'lookups' ,'pluralize'=>false ,
            'only' => ['list-sports'],

            'extraPatterns'=>[
                'GET list-sports' => 'list-sports',

            ]

        ],




    ]
];
