<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'src/Core/Boostrap.php';

echo '<br />';

class DB
{
	public        $userName = "Wiloke";
	public static $_self;

	public static function connect()
	{
		if (empty(self::$_self)) {
			self::$_self = new self(); // X
		}

		return self::$_self; // X
	}
}

$oInstanceA = DB::connect();
echo $oInstanceA->userName;
$oInstanceA->userName = "Wiloke PHP";

$oInstanceB = &$oInstanceA;
$oInstanceB->userName = "X";