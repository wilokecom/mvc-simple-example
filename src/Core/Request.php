<?php
namespace Basic\Core;

class Request
{
	public static function uri()
	{
		if (isset($_REQUEST['route'])) {
			return trim($_REQUEST['route']);
		}

		$uri = trim(str_replace(App::get('configs/app')['baseDir'], '', parse_url(
			$_SERVER['REQUEST_URI'],
			PHP_URL_PATH
		)), '/');

		return empty($uri) ? 'home' : $uri;
	}

	public static function method()
	{
		return $_SERVER['REQUEST_METHOD'];
	}
}
