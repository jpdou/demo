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

    /**
     * @var AbstractModel
     */
    private $entity;

    /** @var  Select */
    private $select;

    private $loaded=false;
    private $entities=[];
    private $key=0;

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

    public function load()
    {
        if (!$this->loaded) {
            $stmt = $this->resource->prepare($this->select);

            $results = $stmt->execute();

            foreach ($results as $row) {
                /** @var AbstractModel $entity */
                $entity = clone $this->entity;
                $entity->setData($row);
                $this->entities[] = $entity;
            }
            $this->loaded = true;
        }
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
        return $this->entities[$this->key];
    }

    public function next()
    {
        $this->key++;
    }

    public function key()
    {
        return $this->key;
    }

    public function valid()
    {
        return isset($this->entities[$this->key]);
    }

    public function rewind()
    {
        $this->load();
        reset($this->entities);
    }

    public function getCountSelect()
    {
        $select = $this->resource->getSelect();
        $select->from($this->entity->getTable());
        $select->columns(['count' => 'count(*)'], false);
        return $select;
    }

    public function count()
    {
        $select = $this->getCountSelect();
        $sql = $select->getSqlString();

        $search = ['"count""("*")" AS "count"', '"'];
        $replace = ['count(*)', ''];

        $sql = str_replace($search, $replace, $sql);
        /** @var \Zend\Db\Adapter\Driver\Pdo\Statement $stmt */
        $stmt = $this->resource->getAdapter()->query($sql);
        $results = $stmt->execute();
        $results->next();
        $row = $results->current();
        if (isset($row['count(*)'])) {
            return (int) $row['count(*)'];
        }
        return 0;
    }
}