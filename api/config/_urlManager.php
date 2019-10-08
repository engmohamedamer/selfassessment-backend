<?php
return [
    //'class' => 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'enableStrictParsing' => true,
    'showScriptName' => false,
    'rules' => [


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



        ['class' =>'yii\rest\UrlRule','controller'=>'user'
            ,'only'=>['login','signup','verify','options']
            ,'extraPatterns'=> [
                'POST signup' => 'signup',
                'POST login' => 'login',
                'POST verify' => 'verify',
            ]
            , 'pluralize'=>false
        ],

        ['class' =>'yii\rest\UrlRule','controller'=>'profile'
            ,'only'=>['index','update','options']
            ,'extraPatterns'=>['POST update' => 'update' ]
            , 'pluralize'=>false
        ],


        ['class' => 'yii\rest\UrlRule', 'controller' => 'lookups' ,'pluralize'=>false ,
            'only' => ['list-sports'],

            'extraPatterns'=>[
                'GET list-sports' => 'list-sports',

            ]

        ],




    ]
];
