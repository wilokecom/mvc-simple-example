<?php


class RegisterController
{
	public function loadIndex()
	{
		loadView('register/index.php');
	}

	public function handleRegister()
	{
		echo '<pre>';
		var_export($_POST);die;
	}
}