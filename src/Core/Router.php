<?php

namespace MVC\Core;

class Router
{
	private static  $aRoute;
	private static $_self;

	public static function getInstance($route)
	{
		if (empty(self::$_self)) {
			self::$_self = new self();
		}
		$oRoute = self::$_self;
		include $route;
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

	public function direct($method, $uri)
	{
		$route = !array_key_exists($uri, self::$aRoute[$method]) ? self::$aRoute[$method]['404'] :
			self::$aRoute[$method][$uri];
		list($controller, $directMethod) = explode('@', $route);

		$oInit = new $controller;
		call_user_func([$oInit, $directMethod]);
	}
}