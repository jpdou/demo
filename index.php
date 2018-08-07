<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/7
 * Time: 10:18
 */

require "vendor/autoload.php";

set_include_path(get_include_path(). PATH_SEPARATOR. __DIR__);


spl_autoload_register(function ($class) {
    $path = $class. ".php";
    include $path;
});

use Zend\Di\Injector;
use Zend\Di\Config;
use App\Model;

$injector = new Injector(new Config([
    'preferences' => [
        Model\VideoInterface::class => Model\Video::class,
    ],
]));

$video = $injector->create(Model\Video::class);
var_dump($video);

$actress = $injector->create(Model\Actress::class);
var_dump($actress);

