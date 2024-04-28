<?php

return [
    'components' => [
        'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => 'mysql:host=localhost;dbname=tms',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@common/mail',
            
            'useFileTransport' => true,
            // You have to set
            //
            // 'useFileTransport' => false,
            //
            // and configure a transport for the mailer to send real emails.
            //
            // SMTP server example:
            //    'transport' => [
            //        'scheme' => 'smtps',
            //        'host' => 'smtp.elasticemail.com',
            //        'username' => 'johcrazy@gmail.com',
            //        'password' => '',
            //        'port' => 25,
            //        'dsn' => 'native://default',
            //    ],
            
            // 'transport' => [
            //            'scheme' => 'smtps',
            //            'host' => 'smtp.elasticemail.com',
            //            'username' => 'johcrazy@gmail.com',
            //            'password' => `',
            //            'port' => 25,
            //            'dsn' => 'native://default',
            //        ],
            // DSN example:
             //  'transport' => [
             //      'dsn' => 'smtp://user:pass@smtp.example.com:25'
            //'dsn' => 'smtp://jjuma8165@gmail.com:©¥<¥@smtp.elasticemail.com:25',
              // ],
            
            // See: https://symfony.com/doc/current/mailer.html#using-built-in-transports
            // Or if you use a 3rd party service, see:
            // https://symfony.com/doc/current/mailer.html#using-a-3rd-party-transport
        ],
    ],
];
