<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/7
 * Time: 12:29
 */

namespace System\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;

class Db
{
    private $objectManager;

    private $adapter;

    private $select;

    private $sql;

    public function __construct(
        ObjectManager $objectManager,
        Select $select,
        Config $config
    ) {
        $this->objectManager = $objectManager;

        $databaseConfig = $config->getConfig('db');
        $this->adapter = new Adapter($databaseConfig);

        $this->sql = new Sql($this->adapter);

        $this->select = $select;
    }

    /**
     * @return Adapter Adapter
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    public function getSelect()
    {
        return clone $this->select;
    }

    public function insert($table, $columns, $values)
    {
        $insert = $this->sql->insert($table);
        $insert->columns($columns);
        $insert->values($values);
        $stmt = $this->sql->prepareStatementForSqlObject($insert);
        $stmt->execute();
    }

    public function update($table, $set, $where)
    {
        $update = $this->sql->update($table);
        $update->set($set);
        $update->where($where);
        $stmt = $this->sql->prepareStatementForSqlObject($update);
        $stmt->execute();
    }

    public function delete($table, $where)
    {
        $delete = $this->sql->delete($table);
        $delete->where($where);
        $stmt = $this->sql->prepareStatementForSqlObject($delete);
        $stmt->execute();
    }

    /**
     * @param $select
     * @return \Zend\Db\Adapter\Driver\StatementInterface
     */
    public function prepare($select)
    {
        return $this->sql->prepareStatementForSqlObject($select);
    }
}