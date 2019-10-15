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



        ['class' =>'yii\rest\UrlRule','controller'=>'events'
            ,'only'=>['delete','create','update','index','view','options'],

            'extraPatterns'=>[
                'POST ' => 'create' ,
                'PUT ' => 'update' ,
                'GET <id>' => 'view' ,
                'GET  <id>/<day>' => 'view' ,
                'PUT <id>/<day> ' => 'update' ,
                'GET ' => 'index',
                'DELETE <id>/<day> ' => 'delete',
                'DELETE <id>/<day>/<child_id> ' => 'delete',
            ]

           , 'pluralize'=>false
        ],






        ['class' =>'yii\rest\UrlRule',
            'controller'=>'profile',
            'only'=>['index','update','options'],
            'extraPatterns'=>[
                'PUT update' => 'update' 
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
