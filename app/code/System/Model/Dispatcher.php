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
use User\Model\User;

class Dispatcher
{
    private $config;
    private $request;

    private $objectManager;

    private $user;

    /**
     * @var AbstractController
     */
    private $controller;

    function __construct(
        Config $config,
        Request $request,
        ObjectManager $objectManager,
        User $user
    ) {
        $this->config = $config;
        $this->request = $request;
        $this->objectManager = $objectManager;
        $this->user = $user;

        $this->initialize();
    }

    private function initialize()
    {
        $key = $this->request->getControllerKey();
        $authRequire = $this->config->getConfig('auth_require');

        // 检查授权， 授权检查设置默认为 需要
        if (!isset($authRequire[$key]) || (isset($authRequire[$key]) && $authRequire[$key])) {
            if ($this->user->auth() == false) {
                header('Location: /user/login');
                exit();
            }
        }

        $controllerClass = $key."Controller";

        $this->controller = $this->objectManager->create($controllerClass);
    }

    public function dispatch()
    {
        return $this->controller->execute();
    }
}