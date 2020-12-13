<?php


class App
{
	private static $aRepository;
	private static $aActions;

	public static function setAction($action, $callback) {
		self::$aActions[$action][] = $callback;
//		[
//			'ajax_handle_register' => [
//				0 => 'handleRegister'
//			]
//		]
		return true;
	}

	public static function getActions($action) {
		return isset(self::$aActions[$action]) ? self::$aActions[$action] : [];
	}

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
