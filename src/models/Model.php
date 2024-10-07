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

    private function hash(): string
    {
        $fields = get_object_vars($this);

        // Filter attributes with _ prefix
        foreach ($fields as $key => $value) {
            if (strpos($key, '_') === 0) {
                unset($fields[$key]);
                continue;
            }
            if ($value === null) {
                $fields[$key] = "__null__";
            }
        }

        return md5(implode(',', array_values($fields)));
    }

    private function get_object_public_vars(): array
    {
        $fields = get_object_vars($this);

        // Filter attributes with _ prefix
        foreach ($fields as $key => $value) {
            if (strpos($key, '_') === 0) {
                unset($fields[$key]);
                continue;
            }
            
            if ($value !== null) {
                $fields[$key] = addslashes($value);
            }
        }
        

        return $fields;
    }

    public function save(): int
    {
        // Check if the object has been modified
        if ($this->isSaved()) {
            return $this->_id;
        }

        // If the object is present in the database, update it
        if ($this->_id !== null && self::get($this->_id) !== null) {
            $table = $this->getTableName();
            $fields = $this->getFields();
            $values = $this->getValues();

            $keyValuePairs = [];
            foreach (explode(',', $fields) as $key) {
                $key = trim($key);
                $keyValuePairs[] = "$key = :$key";
            }

            $query = $this->_db->prepare("UPDATE $table SET " . implode(',', $keyValuePairs) . " WHERE id = :id");

            $query->execute(['id' => $this->_id, ...$this->get_object_public_vars()]);

            return $this->_id;
        }

        // Otherwise, insert it
        $table = $this->getTableName();
        $fields = $this->getFields();
        $values = $this->getValues();
        $query = $this->_db->prepare("INSERT INTO $table ($fields) VALUES ($values)");

        $query->execute();

        // Set the id of the object
        $this->_id = $this->_db->lastInsertId();

        return $this->_id;
    }

    public function isSaved(): bool
    {
        if ($this->_id === null) {
            return false;
        }

        $obj = self::get($this->_id);

        // Check if the object exists
        if ($obj === null) {
            return false;
        }

        // Check if the object has been modified
        if (!hash_equals($obj->hash(), $this->hash())) {
            return false;
        }

        return true;
    }

    protected function getFields()
    {
        $fields = $this->get_object_public_vars();

        // Filter attributes with null values
        foreach ($fields as $key => $value) {
            if ($value === null) {
                unset($fields[$key]);
            }

        }

        return implode(',', array_keys($fields));
    }

    protected function getValues()
    {
        $fields = $this->get_object_public_vars();

        // Filter attributes with _ prefix
        foreach ($fields as $key => $value) {
            if (strpos($key, '_') === 0) {
                unset($fields[$key]);
            }

            if ($value === null) {
                unset($fields[$key]);
            }
        }

        return "'" . implode("','", array_values($fields)) . "'";
    }

    public static function getTableName()
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

            // Set the db
            $objs[$key]->_db = $db;
        }

        return $objs;
    }

    public final static function getAllBy(string $attr, mixed $value): array
    {
        global $db;
        $query = $db->prepare("SELECT * FROM " . static::getTableName() . " WHERE $attr = :value");
        $query->execute(['value' => $value]);
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

            // Set the db
            $objs[$key]->_db = $db;
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

        // Set the db
        $obj->_db = $db;

        return $obj;
    }

    public function delete()
    {
        static::deleteId($this->_id);
    }

    public final static function get(int $id): ?Model
    {
        return static::getByAttribute('id', $id);
    }

    protected static function deleteId(int $id)
    {
        global $db;
        $query = $db->prepare("DELETE FROM " . static::getTableName() . " WHERE id = :id");
        $query->execute(['id' => $id]);
    }

    /**
     * Compare 2 Model objects
     */
    public function __compareTo(Model $other): int
    {
        return $this->getId() <=> $other->getId();
    }


    public final function getId(): ?int
    {
        return $this->_id;
    }
}
