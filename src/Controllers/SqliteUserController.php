<?php


namespace Basic\Controllers;


use Basic\Database\Sqlite;

class SqliteUserController
{
	public function fetchUsers()
	{
		loadView("sqlite/users");
	}

	public function addUser()
	{
		$sqliteQuery = Sqlite::connect()->table('users')->insert([
			'username' => $_POST['username'],
			'email'    => $_POST['email'],
			'password' => md5($_POST['password'])
		]);

		redirectTo('sqliteusers');
	}
}
