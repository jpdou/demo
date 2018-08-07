<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/7
 * Time: 17:04
 */
return [
    'db' => [
        'driver'   => 'Pdo_Mysql',
        'database' => 'DATABASE',
        'username' => 'USERNAME',
        'password' => 'PASSWORD',
    ],

    'preferences' => [
        'App\Model\VideoInterface' => 'App\Model\Video',
    ]
];