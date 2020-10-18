<?php

$config = function () {
    return [
        'database'=>[
            'DB_NAME' => 'frameworkless_chat',
            'HOST' => '127.0.0.1',
            'DB_USER' => 'root',
            'DB_PASSWORD' => 'root',
        ],
        'user' => \app\models\User::class,


    ];
};


