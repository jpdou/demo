<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/7
 * Time: 12:29
 */

namespace App\Model;

use Zend\Db\Adapter\Adapter;

class Resource
{
    private $adapter;
    private static $instance;

    private function __construct(

    ) {
        $this->adapter = new Adapter([
            'driver'   => 'Pdo_Mysql',
            'database' => 'zend_db_example',
            'username' => 'developer',
            'password' => 'developer-password',
        ]);
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Resource();
        }
        return self::$instance;
    }
}