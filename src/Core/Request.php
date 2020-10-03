<?php

namespace MVC\Core;

class Request
{
	public static function uri()
	{
		return trim($_SERVER['REQUEST_URI'], implode('', App::get('config/app')['RequestURI']));
	}

	public static function method()
	{
		return $_SERVER['REQUEST_METHOD'];
	}
}