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
        'database' => 'crawler',
        'username' => 'root',
        'password' => 'toor',
    ],

    'preferences' => [

    ],

    'routers' => [
        'Videos' => '#^videos#',
        'Actresses' => '#^actresses#',
        'User/SubscribedActresses' => '#^(user)\/([0-9]*)\/subscribed_actresses#',
        'User/SubscribedVideos' => '#^(user)\/([0-9]*)\/subscribed_videos#',
    ],

    'directories' => [
        'media' => '/media/'
    ]
];