<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'AMS-frontend',
    'name' => 'AMS',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'frontend\models\User',
            'enableAutoLogin' => false,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'AMS-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'class' => 'frontend\components\CustomErrorHandler',
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            //'suffix' => '.ams',
              //  'baseUrl' => 'http://ams.eastc',
               // 'hostInfo' => 'http://ams.eastc',
             //   'scriptUrl' => '/index.php',
            'rules' => [
                // Add your URL rules here
                'custom-page' => 'site/custom', // Example: maps /custom-page to site/custom
                'POST <controller:\w+>/<action:\w+>' => '<controller>/<action>', // Example: allows POST requests to any controller/action
                'site/view-file/<filePath:\S+>' => 'site/view-file',
                'site/load-file/<filePath:\S+>' => 'site/load-file',
                // Add more rules as needed
            ],
        ],
    ],
    'params' => $params,
];
