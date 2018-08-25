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
use System\Model\ObjectManager;
use System\Model\Db;

/**
 * Class Video
 * @package App\Model
 */
class Video extends AbstractModel
{
    private $config;

    public function __construct(
        ObjectManager $objectManager,
        Db $db,
        Config $config
    ) {
        parent::__construct($objectManager);
        $this->table = "video";
        $this->config = $config;
    }

    public function getSamples()
    {
        /** @var VideoSample $sample */
        $sample = $this->objectManager->create(VideoSample::class);
        $collection = $sample->getCollection();

        $select = $collection->getSelect();
        $select->where("video_id = " . $this->getId());

        return $collection;
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
        $poster = $this->getPoster() ? : 'video/poster/default.jpg';
        return $this->config->getConfig('directories')['media']. $poster;
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