<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/8
 * Time: 10:29
 */

namespace App\Model;


class User extends AbstractModel
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'user';
    }
}