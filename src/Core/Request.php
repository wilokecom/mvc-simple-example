<?php


class Request
{
	public static function uri()
	{
		if(isset($_REQUEST['route'])){
		return str_replace(
			'?route=',
			'',
			$_REQUEST['route']
		);
		}
	}

	public static function method()
	{
		return $_SERVER['REQUEST_METHOD'];
	}
}