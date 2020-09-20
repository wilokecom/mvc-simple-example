<?php


class App
{
	private static $aRepository;

	public static function bind($key, $val)
	{
		self::$aRepository[$key] = $val;
	}

	/**
	 * @param $key
	 * @return mixed|string
	 */
	public static function get($key)
	{
		return array_key_exists($key, self::$aRepository) ? self::$aRepository[$key] : '';
	}
}