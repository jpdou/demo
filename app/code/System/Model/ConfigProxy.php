<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2018/8/13
 * Time: 10:50
 */

namespace System\Model;


class ConfigProxy extends AbstractModel
{
    private $config;

    private $records = [];

    public function __construct(
        ObjectManager $objectManager,
        Db $db,
        Config $config
    ) {
        parent::__construct($objectManager);

        $this->config = $config;
        $this->table = 'config';
    }

    public function getConfig($key)
    {
        if (!isset($this->records[$key])) {
            $this->load($key, 'key');
            $this->records[$key] = $this->getData('id') ? $this->getData('value') : "";
        }
        return $this->records[$key];
    }

    public function getConfigAsInt($key)
    {
        return (int) $this->getConfig($key);
    }

    public function getConfigAsFloat($key) {
        return (float) $this->getConfig($key);
    }

    public function getConfigAsArray($key, $delimiter=",")
    {
        return explode($delimiter, $this->getConfig($key));
    }

    public function getConfigAsJsonArray($key)
    {
        return json_decode($this->getConfig($key), true);
    }
}