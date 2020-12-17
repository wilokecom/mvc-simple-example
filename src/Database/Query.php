<?php


namespace Basic\Database;


class Query
{
	private $_oQuery;
	private $hasQuery = null;
	private $aResults = [];
	private $aResult  = [];

	public function __construct($oQuery)
	{
		$this->_oQuery = $oQuery;
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
