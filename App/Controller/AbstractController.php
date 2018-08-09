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
use App\Model\Layout;
use App\Model\ObjectManager;

abstract class AbstractController
{
    protected $http;
    protected $request;
    protected $objectManager;
    protected $layout;

    protected $template;

    public function __construct(
        Http $http,
        Request $request,
        Layout $layout
    ) {
        $this->http = $http;
        $this->request = $request;
        $this->layout = $layout;
        $this->objectManager = objectManager::getInstance();
    }

    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return string
     */
    public abstract function execute();


}