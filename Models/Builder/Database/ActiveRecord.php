<?php

namespace Model\Builder\Database;

use mysqli;

class ActiveRecord
{
    protected static $db;
    protected static array $columnsDB = [];

    public static function setDB(mysqli $db)
    {
        self::$db = $db;
    }

    public static function builderSQL(string $query)
    {
        $mysqliResult = self::$db->query($query);

        $array = [];

        while ($register = $mysqliResult->fetch_assoc()) {
            $array[] = static::createObject($register);
        }

        $mysqliResult->free();

        return $array;
    }

    protected static function createObject(array $register): ActiveRecord
    {
        $object = new static;

        foreach ($register as $key => $value) {
            if (property_exists($object, $key)) {
                $object->$key = $value;
            }
        }

        return $object;
    }

    private function attributes()
    {
        $attributes = [];

        foreach (static::$columnsDB as $column) {
            if ($column === 'id') continue;
            $attributes[$column] = $this->$column;
        }

        return $attributes;
    }

    public function sanitizeAttributes(): array
    {
        $attributes = $this->attributes();

        $sanitized = [];

        foreach ($attributes as $key => $value) {
            $sanitized[$key] = self::$db->escape_string($value);
        }

        return $sanitized;
    }

    public function syncUp(array $arguments = []): void
    {
        foreach ($arguments as $argument => $value) {
            if (property_exists($this, $argument) && !is_null($value)) {
                $this->$argument = $value;
            }
        }
    }
}
