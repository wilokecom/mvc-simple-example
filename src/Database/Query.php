<?php

namespace MVC\Database;

class Query
{
//	private static $dBConnect;
//
//	public function __construct()
//	{
//		$this->dBConnect = Connect::load();
//	}

	public static function select($select, $from, $where = '', $limit = '')
	{
		$que = sprintf("SELECT %s FROM %s ", $select, $from);
		if (!empty($where)) {
			$que .= sprintf(" WHERE %s ", $where);
		}
		if (!empty($limit)) {
			$que .= sprintf(" LIMIT %s ", $limit);
		}
//		$res = resultQuery(self::$dBConnect, $que);
		$res = mysqli_query(Connect::load(), $que);
		if ($res) {
			$aResult = [];
			if ($res->num_rows > 0) {
				while ($aRow = $res->fetch_assoc()) {
					$aResult[] = $aRow;
				}
			}
			return $aResult;
		} else {
			return false;
		}
	}

	public static function delete($from, $where, $isWhere)
	{
		$que = sprintf("delete from %s where %s = %s", $from, $where, $isWhere);
		$res = resultQuery(Connect::load(), $que);
		if (!$res) {
			return false;
		}
		return $res;
	}

	public static function insert($tableName, $aColumn, $aValue)
	{
		$columnName = implode(', ', $aColumn);
		$values = implode('\', \'', $aValue);
		$values = "'" . $values . "'";
		$que = sprintf("INSERT INTO %s (%s) VALUES (%s);", $tableName, $columnName, $values);
		$res = resultQuery(Connect::load(), $que);
		if (!$res) {
			return false;
		}
		return $res;
	}

	// UPDATE users SET pass='113' WHERE user_id=5;
	public static function update($tableName, $setColumn, $setValue, $whereColumn, $whereValue)
	{
		$que = sprintf("UPDATE %s SET %s='%s' WHERE %s='%s';", $tableName, $setColumn, $setValue, $whereColumn,
			$whereValue);
		$res = resultQuery(Connect::load(), $que);
		if (!$res) {
			return false;
		}
		return $res;
	}
}