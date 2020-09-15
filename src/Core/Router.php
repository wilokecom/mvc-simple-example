<?php

namespace mvc_simple_example\core;
class Router
{
    private static $_self = null;
    private static $aRoute = null;

    public static function Load($router)
    {
        if (self::$_self === null) {
            self::$_self = new self();
        }
        $aRoute = self::$_self;
        include $router;
        return self::$_self;
    }

    public static function get($uri, $controller)
    {
        self::$aRoute['GET'][$uri] = $controller;
    }

    public static function post($uri, $controller)
    {
        self::$aRoute['POST'][$uri] = $controller;
    }

    public function dirct($uri, $method)
    {
        if (!$controller = $this->routeIsExist($uri, $method)) {
            echo 'loi uri';
            die();
        } else {
            $oinit = explode('@', self::$aRoute[$method][$uri]);
        }
        $this->callRoute($oinit[0], $oinit[1]);
    }

    public function routeIsExist($uri, $method)
    {
        return array_key_exists($uri, self::$aRoute[$method]) ? self::$aRoute[$method][$uri] : false;
    }

    public function callRoute($controller, $methor, $para = [])
    {
        $oinit = new  $controller;
        call_user_func_array([$oinit, $methor], $para);
    }
}