<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/9
 * Time: 22:14
 */

namespace App\Model;


use App\Model\Http\Request;

class Layout
{
    private $request;

    public function __construct(
        Request $request
    ) {
        $this->request = $request;
    }

    /**
     * @param string $template
     * @param array $parameters
     * @return string
     */
    public function renderTemplate($template, $parameters=[])
    {
        $html = '';
        if ($template) {
            ob_start();
            if (count($parameters)) {
                extract($parameters, EXTR_SKIP);
            }
            include __BASE_DIR__ . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR . "View" . DIRECTORY_SEPARATOR . $template;
            $html = ob_get_clean();
        }
        return $html;
    }

    public function getRequest()
    {
        return $this->request;
    }
}