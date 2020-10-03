<?php

namespace MVC\Database;

class Query extends Connect
{
	private static $_self;
	private        $table;
	private        $where;
	private        $whatColumn;
	private        $limit;
	private        $whereConcat;

	public function reset()
	{
		$this->where = '';
		$this->whatColumn = '*';
		$this->limit = '';
		return $this;
	}

	public static function table($table)
	{
		if (!self::$_self) {
			self::$_self = new self();
		}
		self::$_self->reset();
		self::$_self->table = $table;
		return self::$_self;
	}

	public function select($what)
	{
		$this->whatColumn = implode(', ', $what);
		return $this;
	}

	public function where($key, $operatorOrValue = '', $maybeValue = '')
	{
		if (empty($maybeValue)) {
			$value = $operatorOrValue;
			$operator = "=";
		} else {
			$value = $maybeValue;
			$operator = $operatorOrValue;
		}
		$value = is_numeric($value) ? $value : "'$value'";
		if ($this->where) {
			$this->where .= $this->whereConcat . self::makeConnect()->real_escape_string($key) . $operator . $value;
		} else {
			$this->where .= self::makeConnect()->real_escape_string($key) . $operator . $value;
		}
		return $this;
	}

	public function orWhere($key, $operatorOrValue = '', $maybeValue = '')
	{
		$this->whereConcat = ' OR ';
		return $this->where($key, $operatorOrValue, $maybeValue);
	}

	public function andWhere($key, $operatorOrValue = '', $maybeValue = '')
	{
		$this->whereConcat = ' AND ';
		return $this->where($key, $operatorOrValue, $maybeValue);
	}


	public function get($default = false)
	{
		$que = sprintf("SELECT %s FROM %s ", $this->whatColumn, $this->table);
		if ($this->where) {
			$que .= sprintf(" WHERE %s ", $this->where);
		}
		if ($this->limit) {
			$que .= sprintf(" LIMIT %s ", $this->limit);
		}
		$res = self::makeConnect()->query($que);
		if ($res) {
			$aResult = [];
			if ($res->num_rows > 0) {
				while ($aRow = $res->fetch_assoc()) {
					$aResult[] = $aRow;
				}
			}
			return $aResult;
		} else {
			return $default;
		}
	}

	public function delete()
	{
		$que = sprintf(" DELETE FROM %s WHERE %s", $this->table, $this->where);
		$res = resultQuery(Connect::makeConnect(), $que);
		if (!$res) {
			return false;
		}
		return $res;
	}

	public function insert($aInit)
	{
		$aColumn = array_keys($aInit);
		$aValue = array_values($aInit);
		$columnName = implode(', ', $aColumn);
		$values = "'" . implode('\', \'', $aValue) . "'";

		echo $que = sprintf("INSERT INTO %s (%s) VALUES (%s);", $this->table, $columnName, $values);
		$res = resultQuery(Connect::makeConnect(), $que);

		if (!$res) {
			return false;
		}
		return $res;
	}

	public function update($aSet, $aWhere)
	{
		$set = '';
		$where = '';
		foreach ($aSet as $key => $value) {
			$set = $key . "='" . $value . "',";
		}
		foreach ($aWhere as $key => $value) {
			$where = $key . "='" . $value . "',";
		}
		$set = rtrim($set, ',');
		$where = rtrim($where, ',');

		$que = sprintf("UPDATE %s SET %s WHERE %s;", $this->table, $set, $where);
		$res = resultQuery(Connect::makeConnect(), $que);
		if (!$res) {
			return false;
		}
		return $res;
	}
}