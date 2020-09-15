<?php


namespace mvc_simple_example\core;


class App
{
    private static $aRegistry = [];

    public static function bind($key, $val)
    {
        self::$aRegistry[$key] = $val;
    }

    public static function get($key)
    {
        return array_key_exists($key, self::$aRegistry) ? self::$aRegistry[$key] : false;
    }
}