<?php


namespace Basic\Database\Engine;


class SqliteQuery implements IDBQuery
{
	/**
	 * @var \SQLite3Result
	 */
	protected $query;

	public function query($oDB, $sql)
	{
		$this->query = $oDB->query(trim($sql));

		return $this->query;
	}

	public function havePosts()
	{
		return $this->query;
	}

	public function get($mode = 'assoc')
	{
		$response = null;
		switch ($mode) {
			case   'number':
				$response = $this->query->fetchArray(SQLITE3_NUM);
				break;
			case   'both':
				$response = $this->query->fetchArray(SQLITE3_BOTH);
				break;
			default:
				$response = $this->query->fetchArray(SQLITE3_ASSOC);
				break;
		}

		return $response;
	}
}
