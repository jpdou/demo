<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/8
 * Time: 10:29
 */

namespace System\Model;


class User extends AbstractModel
{
    public function __construct(
        ObjectManager $objectManager,
        Resource $resource
    ) {
        parent::__construct($objectManager, $resource);
        $this->table = 'user';
    }
}