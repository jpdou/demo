<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/7
 * Time: 16:27
 */

namespace System\Model;

abstract class AbstractModel
{
    protected $db;
    protected $objectManager;

    protected $table;

    protected $primaryField = 'id';

    protected $data=[];

    public function __construct(
        ObjectManager $objectManager
    ) {
        $this->objectManager = $objectManager;
        /** @var Db $db */
        $db = $this->objectManager->get(Db::class);
        $this->db = $db;
    }

    public function load($value, $filed=null, $columns=null)
    {
        if ($filed == null) {
            $filed = $this->primaryField;
        }

        $select = $this->db->getSelect();
        $select->from(['e' => $this->table])
            ->where([$filed => $value])
            ->limit(1);
        if ($columns != null) {
            $select->columns($columns);
        }

        $stmt = $this->db->prepare($select);

        $results = $stmt->execute();

        foreach ($results as $row) {
            $this->setData($row);
        }
    }

    public function setData($key, $value=null)
    {
        if (is_array($key)) {
            $this->data = $key;
        } elseif (is_string($key)) {
            $this->data[$key] = $value;
        }
        return $this;
    }

    public function getData($key=null)
    {
        if ($key == null) {
            return $this->data;
        } elseif (is_string($key)) {
            return isset($this->data[$key]) ? $this->data[$key] : null;
        }
        return null;
    }

    public function getId()
    {
        return $this->getData($this->primaryField);
    }

    public function getTable()
    {
        return $this->table;
    }

    /**
     * @return Collection
     * @throws \Exception
     */
    public function getCollection()
    {
        if (!$this->getTable()) {
            throw new \Exception('Base table have not define!');
        }
        /** @var Collection $collection */
        $collection = $this->objectManager->create(Collection::class);
        $collection->setEntity($this);
        return $collection;
    }

    public function save()
    {
        $data = $this->getData();
        if ($this->getId()) {   // update
            unset($data[$this->primaryField]);
            $this->db->update($this->table, $data, [$this->primaryField => $this->getId()]);
        } else {    // insert
            $columns = array_keys($data);
            $values = array_values($data);
            $this->db->insert($this->table, $columns, $values);
        }
    }

    public function delete()
    {
        $this->db->delete($this->table, [$this->primaryField => $this->getId()]);
    }
}