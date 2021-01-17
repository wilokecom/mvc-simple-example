<?php
namespace Basic\Controllers;

use Basic\Core\App;
use Basic\Database\MysqlQuery;
use Basic\Database\SqliteQuery;

class RegisterController
{
	public function loadIndex()
	{
		loadView('register/index.php');
	}

	public function deleteUser()
	{
		$status = MysqlQuery::connect()->table('users')->delete(['ID' => $_POST['id']]);
		if (!$status) {
			die(MysqlQuery::connect()->getError());
		}

		redirectTo('register');
	}

	public function handleRegister()
	{
		$aData = $_POST;
		unset($aData['route']);
		$aData['password'] = md5($aData['password']);

        $oMysql = new \Basic\Database\MysqlConnect();
        $query = $oMysql->connect()->query(
            "INSERT INTO users (ID, username, email, password) VALUES(...)"
        );

		if (App::get('configs/database')['dbms'] == 'mysql') {
			$status = MysqlQuery::connect()->table('users')->insert([
			    'username' => 'x',
                'email' => 'x@gmail.com',
                'password' => md5('x')
            ]);
			if (!$status) {
				die(MysqlQuery::connect()->getError());
			}
		} else {
			$sqliteQuery = SqliteQuery::connect()->table('users')->insert([
				'username' => $_POST['username'],
				'email'    => $_POST['email'],
				'password' => md5($_POST['password'])
			]);
		}

		redirectTo('register');
	}
}
