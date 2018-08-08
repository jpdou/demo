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

/** @var \App\Model\Dispatcher $dispatcher */
$dispatcher = $objectManager->get(\App\Model\Dispatcher::class);
$output = $dispatcher->dispatch();

echo $output;