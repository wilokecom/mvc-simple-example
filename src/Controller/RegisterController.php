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
		$fname = $_REQUEST['first-name'];
		$lname  = $_REQUEST['last-name'];
		$email  = $_REQUEST['email'];
		$pass = substr(md5($_REQUEST['password']), 0,10);
		UserModel::insertUser($fname, $lname, $email, $pass);
		header("location: " . HomeURL . "user" );
		die;
	}
}