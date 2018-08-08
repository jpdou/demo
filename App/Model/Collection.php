<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/8
 * Time: 23:36
 */

namespace App\Model;


class Collection implements \Iterator
{
    private $resource;

    private $entity;

    private $select;

    public function __construct(
        AbstractModel $entity
    ) {
        $this->resource = Resource::getInstance();

        $this->entity = $entity;

        $this->select = $this->resource->getSelect();
        $this->select->from(['e' => $this->entity->getTable()]);
    }

    public function getSelect()
    {
        return $this->select;
    }

    public function current()
    {
        // TODO: Implement current() method.
    }

    public function next()
    {
        // TODO: Implement next() method.
    }

    public function key()
    {
        // TODO: Implement key() method.
    }

    public function valid()
    {
        // TODO: Implement valid() method.
    }

    public function rewind()
    {
        // TODO: Implement rewind() method.
    }
}