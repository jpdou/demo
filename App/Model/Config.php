<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/7
 * Time: 17:25
 */

namespace App\Model;


class Config
{
    private $data;
    public function __construct(

    ) {
        $this->data = require __BASE_DIR__.DIRECTORY_SEPARATOR.'App'.DIRECTORY_SEPARATOR.'etc'.DIRECTORY_SEPARATOR.'config.php';
    }

    public function get($key) {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }
}