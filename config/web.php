<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'language' => 'RU-ru',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'main',
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'defaultRoute' => 'main',
        ],
        'driver' => [
            'class' => 'app\modules\driver\Module',
            'defaultRoute' => 'main',
        ],
        'services' => [
            'class' => 'app\modules\services\Module',
            'defaultRoute' => 'service',
        ],
    ],
    'components' => [
        'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
            'siteKey' => '6LcoRTYUAAAAAALZ8uJyASHOiwzY7dB9GVlQAOjw',
            'secret' => '6LcoRTYUAAAAAHBvOLHZON1XnYdbqww8GxeBMZKG',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'DRC2iT7IGsMX-LFt0Nyu_m3PlMvW5rUl',
            'enableCsrfValidation' => true,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['main/index'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'signup' => 'main/signup',
                'login' => 'main/index',
                'admin/main/view-user/<id:\d+>' => 'admin/main/view-user',
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
