<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/7
 * Time: 17:08
 */

namespace System\Model;

use Zend\Di\Injector;

class ObjectManager
{
    static private $instance;

    private $injector;

    public function __construct(
    ) {
        $this->injector = new Injector(new \Zend\Di\Config([
        ]));;

        if (self::$instance == null) {
            self::$instance = $this;
        }
    }

    public static function getInstance()
    {
        return self::$instance;
    }

    public function get($name)
    {
        return $this->injector->getContainer()->get($name);
    }

    public function create($name, array $parameters = [])
    {
        return $this->injector->create($name, $parameters);
    }
}