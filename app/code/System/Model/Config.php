<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/7
 * Time: 17:25
 */

namespace System\Model;


class Config
{
    private $data;

    public function __construct(
        ObjectManager $objectManager
    ) {
        $this->data = include __BASE_DIR__.DS.'app'.DS.'etc'.DS.'config.php';
    }

    public function getConfig($key) {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }
}