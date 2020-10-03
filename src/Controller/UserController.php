<?php

namespace MVC\Controller;

use MVC\Model\UserModel;

class UserController
{
	public function loadIndex()
	{
		$aResult = UserModel::selectUser();
		loadView('user/index', $aResult);
	}

	public function deleteUser()
	{
		$uid = ($_REQUEST['uid']);
		UserModel::deleteUserId($uid);
		header("location: " . HomeURL . "user");
		die;
	}

	public function changeUser()
	{
		$uid = $_REQUEST['uid'];
		$newPass = substr(md5($_REQUEST['newPass']), 0,10);
		UserModel::changePassUser($uid, $newPass);
		header("location: " . HomeURL . "user");
		die;
	}
}