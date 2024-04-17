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
            // send all mails to a file by default.
            //'useFileTransport' => true,
            // You have to set
            //
             'useFileTransport' => false,
            //
            // and configure a transport for the mailer to send real emails.
            //
            // SMTP server example:
            //    'transport' => [
            //        'scheme' => 'smtps',
            //        'host' => 'smtp.elasticemail.com',
            //        'username' => 'jjuma8165@gmail.com',
            //        'password' => '2CE9313BE8B1F6812DA94A07F0CED080F8CC',
            //        'port' => 2525,
            //        'dsn' => 'native://default',
            //    ],
            //
            // 'transport' => [
            //            'scheme' => 'smtps',
            //            'host' => 'smtp.elasticemail.com',
            //            'username' => 'johcrazy.magiha@gmail.com',
            //            'password' => '63D62B8B1F69DD7539CCBDE43A9F3502F76C',
            //            'port' => 2525,
            //            'dsn' => 'native://default',
            //        ],
            // DSN example:
               'transport' => [
                   'dsn' => 'smtp://user:pass@smtp.example.com:25'
            //'dsn' => 'smtp://jjuma8165@gmail.com:2CE9313BE8B1F6812DA94A07F0CED080F8CC@smtp.elasticemail.com:25',
               ],
            
            // See: https://symfony.com/doc/current/mailer.html#using-built-in-transports
            // Or if you use a 3rd party service, see:
            // https://symfony.com/doc/current/mailer.html#using-a-3rd-party-transport
        ],
    ],
];
