<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/8
 * Time: 11:58
 */

namespace App\Model\Http;


use App\Model\AbstractModel;

class Request extends AbstractModel
{
    private $parameters;

    public function __construct(
        array $parameters=[]
    ) {
        parent::__construct();
        $this->parameters = $parameters;
    }
}