<?php

namespace mvc_simple_example\core;
class Request
{
    public static function uri()
    {
        return str_replace(App::get('configs/app')['HomeURL'], '', $_SERVER['REQUEST_URI']);
    }
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

}