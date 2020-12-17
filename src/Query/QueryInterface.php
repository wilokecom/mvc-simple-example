<?php
namespace Basic\Query;

interface QueryInterface
{
	public function connect();
	public function query();
}
