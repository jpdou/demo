<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/8
 * Time: 11:47
 */

namespace App\Controller;


use App\Model\Http;
use App\Model\Http\Request;

abstract class AbstractController
{
    protected $http;
    protected $request;

    protected $template;

    public function __construct(
        Http $http,
        Request $request
    ) {
        $this->http = $http;
        $this->request = $request;
    }

    public function render()
    {
        return $this->_renderTemplate();
    }

    protected function _renderTemplate()
    {
        $html = '';
        if ($this->template) {
            ob_start();
            include $this->template;
            $html = ob_get_clean();
        }
        return $html;
    }
}