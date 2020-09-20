<?php

class Request
{
	public static function uri()
	{
		$uri = str_replace(App::get('configs/app')['baseDir'], '', trim(parse_url(
			$_SERVER['REQUEST_URI'],
			PHP_URL_PATH
		), '/'));

		return empty($uri) ? 'home' : $uri;
	}

	public static function method()
	{
		return $_SERVER['REQUEST_METHOD'];
	}
}