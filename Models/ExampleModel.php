<?php

namespace Model;

use Model\Builder\Model;

class ExampleModel extends Model
{
    protected static string $table = 'example_table';

    protected static array $columnsDB = ['id', 'column1', 'column2'];

    public $id, $column1, $column2;

    public function __construct(array $arguments = [])
    {
        $this->id = $arguments['id'] ?? null;
        $this->column1 = $arguments['column1'] ?? '';
        $this->column2 = $arguments['column2'] ?? '';
    }

    public function validateAlerts()
    {
        if (!$this->column1)
            self::$alerts['error'][] = 'La columna1 del ExampleModel es obligatoria';

        if (!$this->column2)
            self::$alerts['error'][] = 'La columna2 del ExampleModel es obligatoria';

        return self::$alerts;
    }
}
