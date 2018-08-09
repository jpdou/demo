<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/7
 * Time: 10:31
 */

namespace App\Model;

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

    public function getTitle()
    {
        return $this->getData('title');
    }

    public function getIdentifier()
    {
        return $this->getData('identifier');
    }

    public function getHref()
    {
        return $this->getData('href');
    }

    public function getPoster()
    {
        return $this->getData('poster');
    }

    public function getPosterUrl()
    {
        return $this->config->get('directories')['media']. $this->getPoster();
    }

    public function getDate()
    {
        return $this->getData('date');
    }
}