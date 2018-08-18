<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/7
 * Time: 10:18
 */

define('__BASE_DIR__',  __DIR__);
define('DS', DIRECTORY_SEPARATOR);
require "vendor/autoload.php";

set_include_path(get_include_path(). PATH_SEPARATOR. __BASE_DIR__.DS."app".DS."code");

spl_autoload_register(function ($class) {
    $path = $class. ".php";
    include $path;
});

session_start();
echo session_save_path();
$objectManager = new System\Model\ObjectManager();
/** @var System\Model\ObjectManager $objectManager */
$objectManager = $objectManager->get(\System\Model\ObjectManager::class);

/** @var \System\Model\Dispatcher $dispatcher */
$dispatcher = $objectManager->get(\System\Model\Dispatcher::class);
$output = $dispatcher->dispatch();

echo $output;