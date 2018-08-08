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
    ],

    'routers' => [
        'Videos' => '#^videos#',
        'Actresses' => '#^actresses#',
        'User/SubscribedActresses' => '#^(user)\/([0-9]*)\/subscribed_actresses#',
        'User/SubscribedVideos' => '#^(user)\/([0-9]*)\/subscribed_videos#',
    ]
];