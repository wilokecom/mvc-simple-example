<?php

namespace MVC\Controller;

use MVC\Model\UserModel;

class RegisterController
{
	public function loadIndex()
	{
		loadView('register/index');
	}

	public function handleRegister()
	{
		$aValue = $_REQUEST;
		UserModel::insertUser($aValue);
		header("location: " . HomeURL . "user" );
		die;
	}
}