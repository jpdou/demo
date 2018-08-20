<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/8
 * Time: 10:29
 */

namespace User\Model;

use System\Model\AbstractModel;
use System\Model\Config;
use System\Model\ObjectManager;
use System\Model\Resource;

class User extends AbstractModel
{
    private $config;
    private $authed;

    public function __construct(
        ObjectManager $objectManager,
        Config $config,
        Resource $resource
    ) {
        parent::__construct($objectManager, $resource);
        $this->table = 'user';
        $this->config = $config;

        $this->authed = isset($_SESSION['authed']) && $_SESSION['authed'] == true;
    }

    public function auth()
    {
        if ($this->authed == false) {
            if (isset($_POST['user']) && isset($_POST['password'])) {
                $user = (string) $_POST['user'];
                $password = (string) $_POST['password'];
                $this->load($user, "name");

                if ($this->getId() && $this->validate($password)) {
                    $_SESSION['authed'] = true;
                    $_SESSION['user_id'] = $this->getId();
                }
            }
        }
        return $this->authed;
    }


    private function validate($password)
    {
        $passwordHash = $this->getPasswordHash();
        return strcmp($passwordHash, md5($password)) == 0;
    }

    public function getId()
    {
        return $this->getData('id');
    }

    public function getName()
    {
        return $this->getData('name');
    }

    public function getPasswordHash()
    {
        return $this->getData('password_hash');
    }
}