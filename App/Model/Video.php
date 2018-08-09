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
class Video extends AbstractModel implements VideoInterface
{

    public function __construct(
    ) {
        parent::__construct();
        $this->table = "video";
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
}