<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/24
 * Time: 23:17
 */

namespace User\Model\Favorite;


use System\Model\AbstractModel;
use System\Model\ObjectManager;

class Video extends AbstractModel
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct($objectManager);
        $this->table = 'user_favorite_video';
    }


    public function getId()
    {
        return $this->getData('id');
    }

    public function getUserId()
    {
        return $this->getData('user_id');
    }

    /**
     * @param $userId
     * @return Video
     */
    public function setUserId($userId)
    {
        return $this->setData('user_id', $userId);
    }

    public function getVideoId()
    {
        return $this->getData('video_id');
    }

    /**
     * @param $videoId
     * @return Video
     */
    public function setVideoId($videoId)
    {
        return $this->setData('video_id', $videoId);
    }
}