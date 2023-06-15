<?php

namespace App\services;

class DB
{
    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'db' => 'testdatabase',
        'charset' => 'UTF8',
        'user' => 'root',
        'password' => '1234'


    ];
    protected function __construct()
    {
    }
    protected function __clone()
    {
    }
    private static $items;

    public static function getInstance()
    {
        if (empty(static::$items)) {
            static::$items = new static();
        }
        return static::$items;
    }
    protected $connect;

    protected function getConnect()
    {
        if (empty($this->connect)) {
            $this->connect = new \PDO(
                $this->getPrepareDsnString(),
                $this->config['user'],
                $this->config['password'],
            );
            $this->connect->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        return $this->connect;
    }
    private function getPrepareDsnString()
    {
        return sprintf(
            '%s:host=%s; dbname=%s;charset=%s',
            $this->config['driver'],
            $this->config['host'],
            $this->config['db'],
            $this->config['charset'],
        );
    }
    protected function query($sql, $params = [])
    {
        $PDOStatment = $this->getConnect()->prepare($sql);
        $PDOStatment->execute($params);
        return $PDOStatment;
    }
    public function qureyObj($sql, $class, $params = [])
    {
        $PDOStatment = $this->query($sql, $params);
        $PDOStatment->setFetchMode(\PDO::FETCH_CLASS, $class);

        return $PDOStatment->fetchAll();
    }

    public function find(string $sql, $params = [])
    {

        return $this->query($sql, $params)->fetch();
    }
    public function findAll(string $sql)
    {
        return $this->query($sql)->fetchAll();
    }
    public function exec(string $sql, $params = [])
    {
        $this->query($sql, $params);
    }
}
