<?php


class RegisterController
{
	public function loadIndex()
	{
		loadView('register/index.php');
	}

	public function deleteUser()
	{
		$status = Query::connect()->table('users')->delete(['ID' => $_POST['id']]);
		if (!$status) {
			die(Query::connect()->getError());
		}

		redirectTo('register');
	}

	public function handleRegister()
	{
		$aData = $_POST;
		unset($aData['route']);
		$aData['password'] = md5($aData['password']);
		$status = Query::connect()->table('users')->insert($aData);
		if (!$status) {
			die(Query::connect()->getError());
		}

		redirectTo('register');
	}
}
