<?php

namespace MVC\Database;

class Connect
{
	private static $con;
	public static  $isConnected = false;

	public static function load()
	{
		$aRoute = include 'config/app.php';
		if (self::$isConnected == false) {
			self::$isConnected = true;
			if (!self::$con = mysqli_connect(
				$aRoute['ConnectDB']['host'],
				$aRoute['ConnectDB']['username'],
				$aRoute['ConnectDB']['password'],
				$aRoute['ConnectDB']['dbname'])
			) {
				echo "Mysql connect is failed" . mysqli_error(self::$con);
				die();
			}
		}
		return self::$con;
	}

//	public static function get()
//	{
//		return self::$con;
//		die;
//		if (self::$isConnected == true) {
//			return self::$con;
//		} else {
//			echo "Database is not connect";
//			die();
//		}
//	}

	public function __destruct()
	{
		mysqli_close(self::$con);
		self::$isConnected = false;
	}
}