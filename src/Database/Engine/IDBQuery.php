<?php


namespace Basic\Database\Engine;


interface IDBQuery
{
	public function query($oDB, $sql);

	public function havePosts();

	public function get($mode = 'assoc');
}
