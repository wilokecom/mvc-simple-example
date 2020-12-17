<?php


namespace Basic\Database;


use Basic\Core\App;

class Query
{
	private static $oInit;
	private static $oDb;
	private        $_oQuery;
	private        $hasQuery = null;
	private        $aResult  = [];
	/**
	 * @var string
	 */
	private $where;
	private $orderBy;
	private $select = '*';
	/**
	 * @var array
	 */
	private $aInsertKeys;
	private $table;
	private $limit;
	/**
	 * @var array
	 */
	private $aInsertValues;
	private $error;
	/**
	 * @var bool|\mysqli_result|\SQLite3Result
	 */
	private $query;

	public function __construct()
	{
		if (!self::$oInit) {
			if (App::get('configs/database')['dbms'] == 'sqlite') {
				self::$oDb = new \SQLite3(App::get("configs/database")["sqlite"]["host"], SQLITE3_OPEN_READWRITE);
			} else {
				$oDb = new \mysqli(
					App::get("configs/database")["mysql"]["host"],
					App::get("configs/database")["mysql"]["user"],
					App::get("configs/database")["mysql"]["password"],
					App::get("configs/database")["mysql"]["db"]
				);

				if ($oDb->connect_errno) {
					die("We could not connect to database: " . $oDb->connect_error);
				}

				self::$oDb = $oDb;
			}
		}

		return self::$oInit;
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

	public function havePost()
	{
		if ($this->hasQuery === null) {
			$this->hasQuery = !empty($this->_oQuery);
			return $this->hasQuery;
		}

		$this->aResult = $this->_oQuery->fetchArray(SQLITE3_ASSOC);
		return !empty($this->aResult);
	}


	public function thePost()
	{
		global $post;
		$post = (object)$this->aResult;

		return $this;
	}
}
