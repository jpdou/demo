<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/8
 * Time: 22:20
 */

namespace App\Model;


use App\Controller\AbstractController;
use App\Model\Http\Request;

class Dispatcher
{
    private $config;
    private $request;

    private $objectManager;

    /**
     * @var AbstractController
     */
    private $controller;

    function __construct(
        Config $config
    ) {
        $this->config = $config;

        $this->objectManager = ObjectManager::getInstance();

        $this->initialize();
    }

    private function initialize()
    {
        $controllerClass = false;
        $parameters = [];

        if (isset($_SERVER["REDIRECT_URL"])) {
            $redirectUrl = ltrim($_SERVER["REDIRECT_URL"], '/');
            var_dump($redirectUrl);

            $routers = $this->config->get('routers');

            foreach ($routers as $key => $router) {
                var_dump($router);
                $matches = [];
                $result = preg_match($router, $redirectUrl, $matches);
                if ($result) {
                    array_shift($matches);  // 丢掉第一个元素
                    while(count($matches) > 0 && count($matches) % 2 == 0) {
                        $parameters[array_shift($matches)] = array_shift($matches);
                    }
                    $controllerClass = "App".DIRECTORY_SEPARATOR."Controller".DIRECTORY_SEPARATOR.$key."Controller";
                    break;
                }
            }
        } else {    // 首页
            $controllerClass = "App".DIRECTORY_SEPARATOR."Controller".DIRECTORY_SEPARATOR.'VideosController';
        }

        if ($controllerClass == false) {
            $controllerClass = "App".DIRECTORY_SEPARATOR."Controller".DIRECTORY_SEPARATOR.'NotFoundController';
        }

        $request = $this->objectManager->create(\App\Model\Http\Request::class, $parameters);

        $this->controller = $this->objectManager->create($controllerClass);
    }

    public function dispatch()
    {
        return $this->controller->execute();
    }
}