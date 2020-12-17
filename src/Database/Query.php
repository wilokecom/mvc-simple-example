<?php


namespace Basic\Database;


use Basic\Core\App;
use Basic\Database\Engine\IDBConnection;
use Basic\Database\Engine\IDBQuery;
use Basic\Database\Engine\MysqlConnection;
use Basic\Database\Engine\SqliteConnection;

class Query
{
	private static $oInit;
	private        $oDb;
	/**
	 * @var IDBQuery
	 */
	private $hasQuery = null;
	private $aResult  = [];
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
	 * @var IDBQuery
	 */
	private $oDbQuery;

	public $post;

	public function __construct()
	{
		if (!self::$oInit) {
			if (App::get('configs/database')['dbms'] == 'sqlite') {
				$this->setConnection(new SqliteConnection())->setQuery(new \Basic\Database\Engine\SqliteQuery());
			} else {
				$this->setConnection(new MysqlConnection())->setQuery(new \Basic\Database\Engine\MysqlQuery());
			}
		}

		return self::$oInit;
	}

	private function setConnection(IDBConnection $oDb)
	{
		$this->oDb = $oDb->connect();
		return $this;
	}

	private function setQuery(IDBQuery $oDbQuery)
	{
		$this->oDbQuery = $oDbQuery;

		return $this;
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

		$result = $this->oDb->query("INSERT INTO {$this->table} (" . implode(", ", $this->aInsertKeys) . ") VALUES ('" .
			implode("','", $this->aInsertValues) . "')");

		if (!$result) {
			$this->error = $this->oDb->lastErrorMsg();
			return false;
		}

		return $this->oDb->lastInsertRowID();
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

		return $this->oDb->query("UPDATE " . $this->table . " SET " . $values . " WHERE " . $where);
	}

	public function delete(array $aWhere)
	{
		$where = "";
		$concatWhere = "";
		array_walk($aWhere, function ($val, $key) use (&$where, &$concatWhere) {
			$where = sprintf($where . $concatWhere . $key . "=" . (is_numeric($val) ? '%d' : '%s'), $val);
			$concatWhere = " AND ";
		});

		return $this->oDb->query("DELETE FROM " . $this->table . " WHERE " . $where);
	}

	public function query()
	{
		$sql = "SELECT " . $this->select . " FROM " . $this->table . " ";
		if (!empty($this->where)) {
			$sql .= "WHERE " . $this->where . " ";
		}

		$sql .= $this->orderBy . " " . $this->limit;

		$this->oDbQuery->query($this->oDb, trim($sql));

		return $this;
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

	public function havePost($mode = 'assoc')
	{
		if ($this->hasQuery === null) {
			$this->query();
			$this->hasQuery = !empty($this->oDbQuery->havePosts());
			return $this->hasQuery;
		}

		$this->aResult = $this->oDbQuery->get($mode);
		return !empty($this->aResult);
	}


	public function thePost()
	{
		global $post;
		$this->post = (object)$this->aResult;
		$post = $this->post;
		return $this;
	}
}
