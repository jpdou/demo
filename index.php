<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/7
 * Time: 10:18
 */

define('__BASE_DIR__',  __DIR__);

require "vendor/autoload.php";

set_include_path(get_include_path(). PATH_SEPARATOR. __BASE_DIR__);

spl_autoload_register(function ($class) {
    $path = $class. ".php";
    include $path;
});

$config = new App\Model\Config();
$objectManager = new App\Model\ObjectManager($config);
echo "<pre>";

$redirectUrl = ltrim($_SERVER["REDIRECT_URL"], '/');
var_dump($redirectUrl);
$parameters = [];
$routers = [
    'Videos' => '#^videos#',
    'Actresses' => '#^actresses#',
    'User/SubscribedActresses' => '#^(user)\/([0-9]*)\/subscribed_actresses#',
    'User/SubscribedVideos' => '#^(user)\/([0-9]*)\/subscribed_videos#',
];

$controller = false;

foreach ($routers as $key => $router) {
    var_dump($router);
    $matches = [];
    $result = preg_match($router, $redirectUrl, $matches);
    if ($result) {
        print_r($matches);
        array_shift($matches);
        while(count($matches) > 0 && count($matches) % 2 == 0) {
            $parameters[array_shift($matches)] = array_shift($matches);
        }

        $request = $objectManager->create(\App\Model\Http\Request::class, $parameters);

        /** @var \App\Controller\AbstractController $controller */
        $controller = $objectManager->create("App".DIRECTORY_SEPARATOR."Controller".DIRECTORY_SEPARATOR.$key);
        break;
    }
}

if ($controller) {
    echo get_class($controller);
}


// all videos -- /videos

// all actress -- /actresses

// my subscribed actress /user/{uid}/subscribed_actresses

// my subscribed videos /user/{uid}/subscribed_videos
