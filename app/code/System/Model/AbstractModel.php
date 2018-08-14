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
    protected $resource;
    protected $objectManager;

    protected $table;

    private $data=[];

    public function __construct(
        ObjectManager $objectManager,
        Resource $resource
    ) {
        $this->resource = $resource;
        $this->objectManager = $objectManager;
    }

    public function load($value, $filed="id", $columns=null)
    {
        $select = $this->resource->getSelect();
        $select->from(['e' => $this->table])
            ->where([$filed => $value])
            ->limit(1);
        if ($columns != null) {
            $select->columns($columns);
        }

        $stmt = $this->resource->prepare($select);

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

    public function getTable()
    {
        return $this->table;
    }

    /**
     * @return Collection
     */
    public function getCollection()
    {
        /** @var Collection $collection */
        $collection = $this->objectManager->create(Collection::class);
        $collection->setEntity($this);
        return $collection;
    }
}