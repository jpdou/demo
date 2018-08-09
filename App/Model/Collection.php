<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/8
 * Time: 23:36
 */

namespace App\Model;


use Zend\Db\Sql\Select;

class Collection implements \Iterator
{
    private $resource;

    private $entity;

    private $select;

    public function __construct(
    ) {
        $this->resource = Resource::getInstance();
    }

    public function setEntity(AbstractModel $entity)
    {
        $this->entity = $entity;
        $this->select = $this->resource->getSelect();
        $this->select->from(['e' => $this->entity->getTable()]);
    }

    /**
     * @return Select
     */
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