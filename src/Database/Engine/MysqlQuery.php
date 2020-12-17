<?php


namespace Basic\Database\Engine;


class MysqlQuery implements IDBQuery
{
	/**
	 * @var \mysqli_result
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
				$response = $this->query->fetch_array(MYSQLI_NUM);
				break;
			case   'both':
				$response = $this->query->fetch_array(MYSQLI_BOTH);
				break;
			default:
				$response = $this->query->fetch_array(MYSQLI_ASSOC);
				break;
		}

		return $response;
	}
}
