<?php


namespace Basic\Database;


use Basic\Core\App;

class Sqlite
{
	private static $oInit;
	/**
	 * @var \SQLite3
	 */
	private static $oDb;
	/**
	 * @var string
	 */
	private $where;
	/**
	 * @var array
	 */
	private $aInsertKeys;
	private $orderBy;
	private $error;
	/**
	 * @var array
	 */
	private $aInsertValues;
	private $table;
	private $select = '*';
	private $limit;
	/**
	 * @var \SQLite3Result
	 */
	private $query;

	public function __construct()
	{
		if (!self::$oDb) {
			self::$oDb = new \SQLite3(App::get("configs/database")["sqlite"]["host"], SQLITE3_OPEN_READWRITE);
		}
	}

	public static function connect()
	{
		if (!self::$oInit) {
			self::$oInit = new self();
		}

		return self::$oInit;
	}


	public function table($tblName)
	{
		$this->table = $tblName;
		return $this;
	}

	public function where(array $aWhere)
	{
		$join = "";
		array_walk($aWhere, function ($val, $key) use (&$join) {
			$this->where .= $join . ' ' . sprintf($key . "=" . (is_numeric($val) ? '%d' : '"%s"'), $val);
			$join = "AND";
		});

		return $this;
	}

	public function pluck(array $aPluck)
	{
		$pluck = implode(',', $aPluck);

		$this->select = $pluck;

		return $this;
	}

	public function orderBy($order, $by)
	{
		$this->orderBy = " ORDER BY " . $order . " " . $by;
		return $this;
	}

	public function limit($limit, $offset = 0)
	{
		$this->limit = " LIMIT " . $offset . "," . $limit;
		return $this;
	}

	public function insert(array $aValues)
	{
		array_walk($aValues, function ($val, $key) {
			$this->aInsertKeys[] = $key;
			$this->aInsertValues[] = sprintf(is_numeric($val) ? '%d' : '%s', $val);
		});

		$result = self::$oDb->query("INSERT INTO {$this->table} (" . implode(", ", $this->aInsertKeys) . ") VALUES ('" .
			implode("','", $this->aInsertValues) . "')");

		if (!$result) {
			$this->error = self::$oDb->lastErrorMsg();
			return false;
		}

		return self::$oDb->lastInsertRowID();
	}

	public function getError()
	{
		return $this->error;
	}

	public function update(array $aWhere, $aValues)
	{
		$values = "";
		$concatValue = "";

		array_walk($aValues, function ($val, $key) use (&$values, &$concatValue) {
			$values = sprintf($values . $concatValue . "=" . is_numeric($val) ? '%d' : '%s', $val);
			$concatValue = ", ";
		});

		$where = "";
		$concatWhere = "";
		array_walk($aWhere, function ($val, $key) use (&$where, &$concatWhere) {
			$where = sprintf($where . $concatWhere . "=" . is_numeric($val) ? '%d' : '%s', $val);
			$concatWhere = " AND ";
		});

		return self::$oDb->query("UPDATE " . $this->table . " SET " . $values . " WHERE " . $where);
	}

	public function delete(array $aWhere)
	{
		$where = "";
		$concatWhere = "";
		array_walk($aWhere, function ($val, $key) use (&$where, &$concatWhere) {
			$where = sprintf($where . $concatWhere . $key . "=" . (is_numeric($val) ? '%d' : '%s'), $val);
			$concatWhere = " AND ";
		});

		return self::$oDb->query("DELETE FROM " . $this->table . " WHERE " . $where);
	}

	public function get()
	{
		$sql = "SELECT " . $this->select . " FROM " . $this->table . " ";
		if (!empty($this->where)) {
			$sql .= "WHERE " . $this->where . " ";
		}

		$sql .= $this->orderBy . " " . $this->limit;

		$this->query = self::$oDb->query(trim($sql));

		return $this->query;
	}

	public function orWhere(array $aWhere)
	{
		$whereOr = "";
		$join = "";
		array_walk($aWhere, function ($val, $key) use (&$whereOr, &$join) {
			$whereOr .= $join . ' ' . sprintf($key . "=" . is_numeric($val) ? '%d' : '%s', $val);
			$join = "AND";
		});

		$this->where .= " OR (" . $whereOr . ')';

		return $this;
	}
}
