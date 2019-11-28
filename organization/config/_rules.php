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
        'roles' => ['governmentAdmin','governmentRep'],
    ],
    [
        'controllers' => ['user'],
        'allow' => false,
    ],
    [
        'allow' => true,
           'roles' => ['governmentAdmin','governmentRep'],
    ],



];
?>
