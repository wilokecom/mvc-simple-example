<?php


namespace Basic\Database\Engine;


use Basic\Core\App;

class SqliteConnection implements IDBConnection
{
	public function connect()
	{
		return (new \SQLite3(App::get("configs/database")["sqlite"]["host"], SQLITE3_OPEN_READWRITE));
	}
}
