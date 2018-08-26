<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/26
 * Time: 12:14
 */

namespace Video\Model;


use System\Model\AbstractModel;
use System\Model\ObjectManager;

class ActressVideo extends AbstractModel
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct($objectManager);
        $this->table = 'actress_video';
    }
}