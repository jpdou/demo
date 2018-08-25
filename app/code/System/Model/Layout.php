<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/9
 * Time: 22:14
 */

namespace System\Model;


use System\Model\Http\Request;

class Layout
{
    private $config;
    private $request;

    public function __construct(
        Config $config,
        Request $request
    ) {
        $this->config =$config;
        $this->request = $request;
    }

    /**
     * @param string $template
     * @param array $parameters
     * @return string
     */
    public function renderTemplate($name, $parameters=[])
    {
        $html = '';
        if ($name) {
            if (count($parameters)) {
                extract($parameters, EXTR_SKIP);
            }
            $templates = $this->config->getConfig('templates');
            if (isset($templates[$name])) {
                $template = $templates[$name];
                ob_start();
                include __BASE_DIR__ . DS . "app" . DS . "code" . DS. $template;
                $html = ob_get_clean();
            }
        }
        return $html;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getUrl($url, $query=null)
    {
        $pos = strpos($url, '?');
        $queryStrings = [];

        $_url = $url;
        // 处理 url
        if ($pos !== false) {
            $_url = substr($url, 0, $pos);
        }

        if (is_array($query)) {
            $query = array_merge($_GET, $query);
        }

        if (count($query)) {
            foreach ($query as $key => $value) {
                $queryStrings[] = $key . '=' . $value;
            }
        }

        return $_url . '?' . implode('&', $queryStrings);
    }
}