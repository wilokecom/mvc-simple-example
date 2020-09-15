<?php

class Request
{
	public static function route()
	{
		return isset($_REQUEST['route']) ? $_REQUEST['route'] : 'home';
	}
}