<?php

$config = [
    'components' => [
            'db' => [
                'class' => 'yii\db\Connection',
                'dsn' => env('TEST_DB_DSN'),
                'username' => env('TEST_DB_USERNAME') , //'root',
                'password' => env('TEST_DB_PASSWORD'),
                'charset' => 'utf8',
            ],
        ]
];

return $config ;
?>
