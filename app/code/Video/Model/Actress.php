<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/7
 * Time: 12:25
 */

namespace Video\Model;

use System\Model\AbstractModel;
use System\Model\Config;
use System\Model\Db;
use System\Model\ObjectManager;

class Actress extends AbstractModel
{
    private $config;

    public function __construct(
        ObjectManager $objectManager,
        Config $config,
        Db $db
    ) {
        parent::__construct($objectManager);
        $this->table = 'actress';
        $this->config = $config;
    }

    /**
     * @return \System\Model\Collection
     */
    public function getVideos()
    {
        /** @var Video $video */
        $video = $this->objectManager->get(Video::class);
        $collection = $video->getCollection();
        $select = $collection->getSelect();

        $select->join(
            'actress_video',
            'e.id=actress_video.video_id',
            []
        )->where('actress_video.actress_id='. $this->getId());

        return $collection;
    }

    public function getUrl()
    {
        return '/actress/' . $this->getId();
    }

    public function getName()
    {
        return $this->getData('name');
    }

    public function getAvatar()
    {
        return $this->getData('avatar');
    }

    public function getAvatarUrl()
    {
        $avatar = $this->getAvatar() ? : '404.jpg';
        return $this->config->getConfig('directories')['media']. $avatar;
    }

    public function getHomePage()
    {
        return $this->getData('home_page');
    }

    public function getVideoCount()
    {
        return (int) $this->getData('video_count');
    }

    public function getOfficeId()
    {
        return (int) $this->getData('office_id');
    }

    public function getLastUpdated()
    {
        return $this->getData('last_updated');
    }
}