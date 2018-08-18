<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/8
 * Time: 11:58
 */

namespace System\Model\Http;

use System\Model\Config;

class Request
{
    private $config;

    private $parameters;

    private $controllerKey;

    public function __construct(
        Config $config
    ) {
        $this->config = $config;
        $this->initialize();
    }

    private function initialize()
    {
        $parameters = [];

        $url = isset($_SERVER["REDIRECT_URL"]) ? ltrim($_SERVER["REDIRECT_URL"], '/') : 'videos';

        $routers = $this->config->getConfig('routers');

        foreach ($routers as $key => $router) {
            $matches = [];
            $result = preg_match($router, $url, $matches);
            if ($result) {
                array_shift($matches);  // 丢掉第一个元素
                while(count($matches) > 0 && count($matches) % 2 == 0) {
                    $parameters[array_shift($matches)] = array_shift($matches);
                }
                $this->controllerKey = $key;
                $this->parameters = $parameters;
                break;
            }
        }

        if ($this->controllerKey == null) {
            $this->controllerKey = 'NotFound';
        }
    }

    /**
     * @return string
     */
    public function getControllerKey()
    {
        return $this->controllerKey;
    }

    public function get($key, $default=null)
    {
        if (isset($_POST[$key])) {
            return (string) $_POST[$key];
        }

        if (isset($_GET[$key])) {
            return (string) $_GET[$key];
        }

        if (isset($this->parameters[$key])) {
            return (string) $this->parameters[$key];
        }

        return $default;
    }
}