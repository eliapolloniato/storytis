<?php

$db = require __DIR__ . "/../db/db.php";

abstract class Model
{
    protected $_db;
    protected $_id;

    public function __construct()
    {
        global $db;
        $this->_db = $db;
    }

    public function save()
    {
        $table = $this->getTableName();
        $fields = $this->getFields();
        $values = $this->getValues();
        $query = $this->_db->prepare("INSERT INTO $table ($fields) VALUES ($values)");
        $query->execute();
    }

    protected function getFields()
    {
        $fields = get_object_vars($this);

        // Filter attributes with _ prefix
        foreach ($fields as $key => $value) {
            if (strpos($key, '_') === 0) {
                unset($fields[$key]);
            }
        }

        return implode(',', array_keys($fields));
    }

    protected function getValues()
    {
        $fields = get_object_vars($this);

        // Filter attributes with _ prefix
        foreach ($fields as $key => $value) {
            if (strpos($key, '_') === 0) {
                unset($fields[$key]);
            }
        }

        return "'" . implode("','", array_values($fields)) . "'";
    }

    public final static function getTableName()
    {
        return get_called_class() . "s";
    }

    public final static function getAll()
    {
        global $db;
        $query = $db->prepare("SELECT * FROM " . static::getTableName());
        $query->execute();
        $res = $query->fetchAll(PDO::FETCH_ASSOC);

        // Create new objects from the called class
        $objs = [];
        foreach ($res as $key => $value) {
            // Get constructor parameters
            $reflection = new ReflectionClass(static::class);

            // Create a new object
            $objs[$key] = $reflection->newInstanceWithoutConstructor();

            // Set the attributes of the object
            foreach ($value as $k => $v) {
                $objs[$key]->$k = $v;
            }

            // Set the id of the object
            $objs[$key]->_id = $value['id'];
        }

        return $objs;
    }

    protected static function getByAttribute(string $attr, mixed $value): ?Model
    {
        global $db;
        $query = $db->prepare("SELECT * FROM " . static::getTableName() . " WHERE $attr = :value");
        $query->execute(['value' => $value]);
        $res = $query->fetch(PDO::FETCH_ASSOC);

        if (!$res) {
            return null;
        }

        // Get constructor parameters
        $reflection = new ReflectionClass(static::class);

        // Create a new object
        $obj = $reflection->newInstanceWithoutConstructor();

        // Set the attributes of the object
        foreach ($res as $k => $v) {
            if ($k !== 'id')
                $obj->$k = $v;
        }

        // Set the id of the object
        $obj->_id = $res['id'];

        return $obj;
    }

    public final static function get(int $id): ?Model
    {
        return static::getByAttribute('id', $id);
    }

    protected static function delete(int $id)
    {
        global $db;
        $query = $db->prepare("DELETE FROM " . static::getTableName() . " WHERE id = :id");
        $query->execute(['id' => $id]);
    }
}
