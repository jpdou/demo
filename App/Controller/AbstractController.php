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
use App\Model\ObjectManager;

abstract class AbstractController
{
    protected $http;
    protected $request;
    protected $objectManager;

    protected $template;

    public function __construct(
        Http $http,
        Request $request
    ) {
        $this->http = $http;
        $this->request = $request;
        $this->objectManager = objectManager::getInstance();
    }

    /**
     * @return string
     */
    public abstract function execute();

    /**
     * @param array $parameters
     * @return string
     */
    protected function renderTemplate($parameters=[])
    {
        $html = '';
        if ($this->template) {
            ob_start();
            if (count($parameters)) {
                extract($parameters, EXTR_SKIP);
            }
            include __BASE_DIR__ . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR . "View" . DIRECTORY_SEPARATOR . $this->template;
            $html = ob_get_clean();
        }
        return $html;
    }
}