<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/8
 * Time: 11:47
 */

namespace System\Controller;

use System\Model\Http\Request;
use System\Model\Layout;
use System\Model\ObjectManager;

abstract class AbstractController
{
    protected $request;
    protected $objectManager;
    protected $layout;

    protected $template;

    public function __construct(
        Request $request,
        Layout $layout
    ) {
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