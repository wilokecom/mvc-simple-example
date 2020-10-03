<?php

namespace MVC\Database;

use MVC\Core\App;

class Connect
{
	private static $self;

	public static function makeConnect()
	{
		if (empty(self::$self)) {
			if (!self::$self = mysqli_connect(
				App::get('config/app')['ConnectDB']['host'],
				App::get('config/app')['ConnectDB']['username'],
				App::get('config/app')['ConnectDB']['password'],
				App::get('config/app')['ConnectDB']['dbname'])
			) {
				echo "Database connect is failed" . mysqli_error(self::$self);
				die();
			}
		}
		return self::$self;
	}

	public function __destruct()
	{
		mysqli_close(self::$self);
	}
}