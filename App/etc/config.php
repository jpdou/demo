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
        'database' => 'jeasy_cms_db',
        'username' => 'root',
        'password' => 'toor',
    ],

    'preferences' => [
        'App\Model\VideoInterface' => 'App\Model\Video',
    ]
];