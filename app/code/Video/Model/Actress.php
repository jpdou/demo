<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/7
 * Time: 12:25
 */

namespace Video\Model;


use System\Model\AbstractModel;
use System\Model\ObjectManager;

class Actress extends AbstractModel
{
    public function __construct(
        ObjectManager $objectManager,
        Resource $resource
    ) {
        parent::__construct($objectManager);
    }
}