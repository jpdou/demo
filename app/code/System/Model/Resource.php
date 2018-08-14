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

class Resource
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

    /**
     * @param $select
     * @return \Zend\Db\Adapter\Driver\StatementInterface
     */
    public function prepare($select)
    {
        return $this->sql->prepareStatementForSqlObject($select);
    }
}