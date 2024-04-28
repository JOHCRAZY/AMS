<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                // Add your URL rules here
                'custom-page' => 'site/custom', // Example: maps /custom-page to site/custom
                'POST <controller:\w+>/<action:\w+>' => '<controller>/<action>', // Example: allows POST requests to any controller/action
                // Add more rules as needed
            ],
        ],
    ],
];
