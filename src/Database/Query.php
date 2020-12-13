<?php


class Query
{
	/**
	 * @var $oDb \mysqli
	 */
	private static $oInit;
	private static $oDb;
	private        $table;
	private        $where;
	private        $select = "*";
	private        $orderBy;
	private        $limit;
	private        $error;
	private        $numRows = 0;
	private        $aResults;
	private        $aInsertKeys;
	private        $aInsertValues;


	/**
	 * @var $query \mysqli_result
	 */
	private $query;

	public function reset()
	{
		$this->table = "";
		$this->select = "*";
		$this->where = "";
		$this->orderBy = "";
		$this->limit = "";
		$this->error = "";
		$this->numRows = 0;
		$this->aResults = [];
		$this->aInsertKeys = [];
		$this->aInsertValues = [];
	}

	public function __construct() {
		if (!self::$oDb) {
			$oDb = new \mysqli(
				\App::get("configs/database")["host"],
				\App::get("configs/database")["user"],
				\App::get("configs/database")["password"],
				\App::get("configs/database")["db"]
			);

			if ($oDb->connect_errno) {
				die("We could not connect to database: " . $oDb->connect_error);
			}

			self::$oDb = $oDb;
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
			$this->error = self::$oDb->error;
			return false;
		}

		return self::$oDb->insert_id;
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

		if (!$this->query) {
			$this->error = "Database access failed: " . self::$oDb->error;
		} else {
			$this->numRows = $this->query->num_rows;
			$this->aResults = $this->query->fetch_all(MYSQLI_ASSOC);

			return $this->aResults;
		}
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
