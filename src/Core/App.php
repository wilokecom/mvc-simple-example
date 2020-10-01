<?php


namespace MVC\Core;


class App
{
	private static $aRoute = [];

	public static function bind($key, $val)
	{
		self::$aRoute[$key] = $val;
	}

	public static function get($key)
	{
		return array_key_exists($key, self::$aRoute) ? self::$aRoute[$key] : false;
	}
}