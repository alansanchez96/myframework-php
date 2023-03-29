<?php

namespace Model\Builder;

use Model\Concerns\Alerts;
use Model\Builder\Database\ActiveRecord;

class Model extends ActiveRecord
{
    use Alerts;

    protected static string $table = '';

    public function save(int $id = null)
    {
        if (isset($id)) {
            return $this->update($id);
        } else {
            return $this->create();
        }
    }

    public static function all()
    {
        $query = "SELECT * FROM " . static::$table;

        return parent::builderSQL($query);
    }

    public static function find(int $id)
    {
        $query = "SELECT * FROM " . static::$table  . " WHERE id = " . $id;

        $result = parent::builderSQL($query);

        return array_shift($result);
    }

    public static function get(int $limit)
    {
        $query = "SELECT * FROM " . static::$table . " LIMIT " . $limit;

        $result = parent::builderSQL($query);

        return array_shift($result);
    }

    public function create()
    {
        $attributes = $this->sanitizeAttributes();

        $query = " INSERT INTO " . static::$table . " ( ";
        $query .= join(', ', array_keys($attributes));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($attributes));
        $query .= " ') ";

        $result = self::$db->query($query);

        return [
            'result' =>  $result,
            'id' => self::$db->insert_id
        ];
    }

    public function update(int $id)
    {
        $attributes = $this->sanitizeAttributes();

        $values = [];

        foreach ($attributes as $attribute => $value) {
            $values[] = "{$attribute}='{$value}'";
        }

        $query = "UPDATE " . static::$table . " SET ";
        $query .=  join(', ', $values);
        $query .= " WHERE id = '" . self::$db->escape_string($id) . "' ";
        $query .= " LIMIT 1 ";

        return self::$db->query($query);
    }

    public function delete(int $id)
    {
        $query = "DELETE FROM "  . static::$table . " WHERE id = " . self::$db->escape_string($id) . " LIMIT 1";

        return self::$db->query($query);
    }
}
