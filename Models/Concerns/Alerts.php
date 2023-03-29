<?php

namespace Model\Concerns;

trait Alerts 
{
    public static array $alerts = [];

    public static function setAlert(string $type, string $message): void
    {
        static::$alerts[$type][] = $message;
    }

    public static function getAlert(): array
    {
        return static::$alerts;
    }

    public function validate(): array
    {
        static::$alerts = [];

        return static::$alerts;
    }
}