<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/8
 * Time: 11:57
 */

namespace System\Model;


use System\Model\Http\Request;

class Http extends AbstractModel
{
    private $request;

    public function __construct(
        Request $request
    ) {
        parent::__construct();
        $this->request = $request;
    }
}