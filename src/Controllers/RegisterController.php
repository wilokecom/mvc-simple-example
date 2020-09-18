<?php

class RegisterController
{
	public static function loadIndex()
	{
		loadView("register/index");
	}

	public static function handleRegister()
	{
		echo "<pre>";
		var_dump($_POST);
		die;
	}
}