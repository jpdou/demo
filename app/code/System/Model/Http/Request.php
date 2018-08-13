<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/8
 * Time: 11:58
 */

namespace System\Model\Http;

class Request
{
    private $parameters;

    public function __construct(
        array $parameters=[]
    ) {
        $this->parameters = $parameters;
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