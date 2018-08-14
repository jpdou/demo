<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/7
 * Time: 10:31
 */

namespace Video\Model;

use System\Model\AbstractModel;
use System\Model\Config;

/**
 * Class Video
 * @package App\Model
 */
class Video extends AbstractModel
{
    private $config;

    public function __construct(
        Config $config
    ) {
        parent::__construct();
        $this->table = "video";
        $this->config = $config;
    }

    public function getId()
    {
        return $this->getData('id');
    }

    public function getTitle()
    {
        return $this->getData('title');
    }

    public function getIdentifier()
    {
        return $this->getData('identifier');
    }

    public function getOriginHref()
    {
        return $this->getData('origin_href');
    }

    public function getPoster()
    {
        return $this->getData('poster');
    }

    public function getPosterUrl()
    {
        return $this->config->getConfig('directories')['media']. $this->getPoster();
    }

    public function getDate()
    {
        return $this->getData('date');
    }

    public function getUrl()
    {
        return '/video/' . $this->getId();
    }
}