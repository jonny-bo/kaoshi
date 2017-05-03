<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'admins' => ['测试管理员']
            // you will configure your module inside this file
            // or if need different configuration for frontend and backend you may
            // configure in needed configs
        ],
    ],
];
