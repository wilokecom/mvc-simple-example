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

		if (!$sqliteQuery) {
			die("We could not insert the user");
		}

		redirectTo('sqliteusers');
	}

	public function deleteUser()
	{
		$sqliteQuery = Sqlite::connect()->table('users')->delete([
			'ID' => $_POST['ID']
		]);

		if (!$sqliteQuery) {
			die("We could not insert the user");
		}

		redirectTo('sqliteusers');
	}
}
