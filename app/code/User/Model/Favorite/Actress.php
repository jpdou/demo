<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/26
 * Time: 14:01
 */

namespace User\Model\Favorite;

use System\Model\AbstractModel;
use System\Model\ObjectManager;

class Actress extends AbstractModel
{
    public function __construct(
        ObjectManager $objectManager
    ) {
        parent::__construct($objectManager);
        $this->table = 'user_favorite_actress';
    }

    public function getUserId()
    {
        return $this->getData('user_id');
    }

    /**
     * @param $userId
     * @return Actress
     */
    public function setUserId($userId)
    {
        return $this->setData('user_id', $userId);
    }

    public function getActressId()
    {
        return $this->getData('actress_id');
    }

    /**
     * @param $actressId
     * @return Actress
     */
    public function setActressId($actressId)
    {
        return $this->setData('actress_id', $actressId);
    }
}