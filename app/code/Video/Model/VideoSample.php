<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/18
 * Time: 15:31
 */

namespace Video\Model;


use System\Model\AbstractModel;
use System\Model\Config;
use System\Model\ObjectManager;
use System\Model\Resource;

class VideoSample extends AbstractModel
{
    private $config;

    public function __construct(
        ObjectManager $objectManager,
        Resource $resource,
        Config $config
    ) {
        parent::__construct($objectManager);
        $this->table = "video_sample";
        $this->config = $config;
    }

    public function getVideoId()
    {
        return $this->getData('video_id');
    }

    public function getSrc()
    {
        return $this->getData("src");
    }

    public function getUrl()
    {
        return $this->config->getConfig('directories')['media']. $this->getSrc();
    }
}