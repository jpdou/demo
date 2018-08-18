<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/18
 * Time: 21:17
 */

namespace System\Controller;


class NotFoundController extends AbstractController
{
    public function execute()
    {
        return $this->layout->renderTemplate('404');
    }

}