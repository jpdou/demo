<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/8
 * Time: 23:36
 */

namespace System\Model;


use Zend\Db\Sql\Select;
use Zend\Db\Adapter\Platform\Mysql;
use Zend\Db\Sql\Expression;

class Collection implements \Iterator, \Countable
{
    private $db;

    /**
     * @var AbstractModel
     */
    private $entity;

    private $platform;

    /** @var  Select */
    private $select;

    private $countSelect;

    private $loaded=false;
    private $entities=[];
    private $key=0;

    public function __construct(
        \System\Model\db $db,
        Mysql $mysqlPlatform
    ) {
        $this->db = $db;
        $this->platform = $mysqlPlatform;
    }

    public function setEntity(AbstractModel $entity)
    {
        $this->entity = $entity;
        $this->select = $this->db->getSelect();
        $this->select->from(['e' => $this->entity->getTable()]);
    }

    public function load()
    {
        if (!$this->loaded) {
            $stmt = $this->db->prepare($this->select);

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
        if ($this->countSelect == null) {
            $this->countSelect = $this->db->getSelect();
            $this->countSelect->from($this->entity->getTable());
            $this->countSelect->columns(['count' => new Expression('COUNT(*)')], false);
        }
        return $this->countSelect;
    }

    public function count()
    {
        if ($this->loaded) {
            return count($this->entities);
        } else {
            $select = $this->getCountSelect();
            /** @var \Zend\Db\Adapter\Driver\Pdo\Statement $stmt */
            $stmt = $this->db->prepare($select);
            $results = $stmt->execute();
            $results->next();
            $row = $results->current();
            return isset($row['count']) ? (int) $row['count'] : 0;
        }
    }
}