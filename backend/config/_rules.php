<?php
return [
    [
        'controllers' => ['sign-in'],
        'allow' => true,
        'roles' => ['?'],
        'actions' => ['login','reset-password','request-password-reset'],
    ],
    [
        'controllers' => ['sign-in'],
        'allow' => true,
        'roles' => ['@'],
        'actions' => ['logout'],
    ],
    [
        'controllers' => ['site'],
        'allow' => true,
        'roles' => ['?', '@'],
        'actions' => ['error'],
    ],
    [
        'controllers' => ['debug/default'],
        'allow' => true,
        'roles' => ['?'],
    ],
    [
        'controllers' => ['user'],
        'allow' => true,
        'roles' => ['administrator','manager','officialNEoffice'],
    ],
    [
        'controllers' => ['user'],
        'allow' => false,
    ],
       [
        'allow' => true,
        'roles' => ['manager', 'administrator'],
    ],

    /**  *-------------------------------- Moe Admin  --------------------------------------------   **/


    [
        'controllers' => ['helper','site','file'],
        'allow' => true,
        'roles' => ['officialNEoffice'],
    ],

    [
        'controllers' => ['schools','event','event-request','announcement','news','sign-in','timeline-event'],
        'allow' => true,
        'roles' => ['officialNEoffice'],
    ],

    //just for now
    [
        'allow' => true,
        'roles' => ['officialNEoffice'],
    ],




];
?>