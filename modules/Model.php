<?php

namespace App\modules;

use App\services\DB;

/**
 * Class Model
 * @property string selectName
 */
abstract class Model
{
    protected $db;
    public function __construct()
    {
        $this->db = DB::getInstance();
    }
    /**
     * Возвращает имя таблицы в базе данных
     * @return string
     */
    // метод для получения конкретной записи из бд по ID 
    // 
    public function getOne($id)
    {
        $selectName = $this->selectName;
        $sql = "SELECT * FROM {$selectName} WHERE id=:id";
        return $this->db->find($sql, [':id' => $id]);
    }

    // метод для получение  записей из бд
    public function getAll()
    {
        $selectName = $this->selectName;
        $sql = "SELECT * FROM {$selectName}";
        return $this->db->findAll($sql);
    }
    //Получение записи из БД в виде объекта
    public function getObj()
    {
        $selectName = $this->selectName;
        $sql = "SELECT * FROM {$selectName}";
        return $this->db->qureyObj($sql, static::class);
    }
    // Вставка а БД
    //INSERT INTO `testdatabase`.`goods` (`test1`, `test2`) VALUES ('taddy', '1');
    public function insert()
    {
        foreach ($this as $property => $value) {
            if ($property == 'db' || empty($value) || $property == 'selectName') {
                continue;
            }
            $collums[] = $property;
            $params[":{$property}"] = $value;
        }
        $collumsStr = implode(', ', $collums);
        $selectName = $this->selectName;
        $placeholders = implode(', ', array_keys($params));
        $sql = "INSERT INTO {$selectName} ($collumsStr) VALUES ($placeholders)";
        $this->db->exec($sql, $params);
    }
    public function update()
    {
    }
}
