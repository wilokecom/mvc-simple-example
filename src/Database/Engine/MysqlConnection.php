<?php


namespace Basic\Database\Engine;


use Basic\Core\App;

class MysqlConnection implements IDBConnection
{
	public function connect()
	{
		$oDb = new \mysqli(
			App::get("configs/database")["mysql"]["host"],
			App::get("configs/database")["mysql"]["user"],
			App::get("configs/database")["mysql"]["password"],
			App::get("configs/database")["mysql"]["db"]
		);

		if ($oDb->connect_errno) {
			throw new \Exception("We could not connect to database: " . $oDb->connect_error);
		}

		return $oDb;
	}
}
