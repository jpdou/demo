<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/7
 * Time: 10:31
 */

namespace App\Model;


class Video extends AbstractModel implements VideoInterface
{

    public function __construct(
    ) {
        parent::__construct();
        $this->table = "video";
    }
}