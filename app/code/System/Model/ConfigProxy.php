<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/13
 * Time: 10:50
 */

namespace System\Model;


class ConfigProxy extends AbstractModel
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct($objectManager);
    }

    public function getConfig($key)
    {

    }
}