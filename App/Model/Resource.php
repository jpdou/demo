<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/7
 * Time: 12:29
 */

namespace App\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;

class Resource
{
    private $adapter;

    private $select;

    private $sql;

    private static $instance;

    private function __construct(
        ObjectManager $objectManager,
        Select $select,
        Config $config
    ) {
        $databaseConfig = $config->get('db');
        $this->adapter = new Adapter($databaseConfig);

        $this->sql = new Sql($this->adapter);

        $this->select = $select;
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            $objectManager = ObjectManager::getInstance();
            $select = $objectManager->get(Select::class);
            $config = $objectManager->get(Config::class);
            self::$instance = new Resource($objectManager, $select, $config);
        }
        return self::$instance;
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
        return $this->select;
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