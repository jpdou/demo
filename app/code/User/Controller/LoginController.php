<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/18
 * Time: 19:29
 */

namespace User\Controller;


use System\Controller\AbstractController;
use User\Model\User;

class LoginController extends AbstractController
{
    private $user;

    public function __construct(
        \System\Model\Http\Request $request,
        \System\Model\Layout $layout,
        User $user
    ) {
        parent::__construct($request, $layout);
        $this->template = 'login';
        $this->user = $user;
    }

    public function execute()
    {
        if ($this->user->auth()) {
            header('Location: /');
            exit();
        }
        return $this->layout->renderTemplate($this->template);
    }

}