<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/8
 * Time: 22:20
 */

namespace System\Model;


use System\Controller\AbstractController;
use System\Model\Http\Request;

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
        Config $config,
        Request $request,
        ObjectManager $objectManager
    ) {
        $this->config = $config;
        $this->request = $request;
        $this->objectManager = $objectManager;

        $this->initialize();
    }

    private function initialize()
    {
        $key = $this->request->getControllerKey();
        $controllerClass = $key."Controller";

        $this->controller = $this->objectManager->create($controllerClass);
    }

    public function dispatch()
    {
        return $this->controller->execute();
    }
}