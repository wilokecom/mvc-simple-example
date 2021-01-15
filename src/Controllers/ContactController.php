<?php
namespace Basic\Controllers;

use Basic\Database\Engine\MysqlConnection;

class ContactController
{
	public function loadIndex()
	{
		loadView("contact/index");
	}
}
