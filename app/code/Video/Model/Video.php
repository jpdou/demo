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
use Zend\Db\Adapter\Platform\Mysql;

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

    public function getActresses()
    {
        /** @var Actress $actress */
        $actress = $this->objectManager->get(Actress::class);
        $collection = $actress->getCollection();
        $select = $collection->getSelect();

        /** @var ActressVideo $actressVideo */
        $actressVideo = $this->objectManager->get(ActressVideo::class);
        $select->join(
            ['av' => $actressVideo->getTable()],
            'e.id = av.actress_id',
            []
        )->where(['av.video_id' => $this->getId()]);

        $collection->load();

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

    /**
     * @param $identifier
     * @return Video
     */
    public function setIdentifier($identifier)
    {
        return $this->setData('identifier', $identifier);
    }

    public function getOriginHref()
    {
        return $this->getData('origin_href');
    }

    /**
     * @param $href
     * @return Video
     */
    public function setOriginHref($href)
    {
        return $this->setData('origin_href', $href);
    }

    public function getPoster()
    {
        return $this->getData('poster');
    }

    public function getPosterUrl()
    {
        $poster = $this->getPoster() ? : '404.jpg';
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