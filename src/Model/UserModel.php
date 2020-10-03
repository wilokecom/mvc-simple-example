<?php


namespace MVC\Model;

use MVC\Database\Query;

class UserModel
{
	public static function selectUser()
	{
		$aResult = Query::select("user_id, first_name, email, pass, registrantion_date", "users");
		return $aResult;
	}

	public static function deleteUserId($id)
	{
		Query::delete('users', 'user_id', $id);
	}

	public static function insertUser($value)
	{
		$aColumns = [
			'first_name',
			'last_name',
			'email',
			'pass',
		];
		Query::insert('users', $aColumns, $value);
	}

	// UPDATE users SET pass='113' WHERE user_id=5;
	public static function changeUserId($uid, $newPass)
	{
		$table = 'users';
		$setColumn = 'pass';
		$whereColumn = 'user_id';
		Query::update($table, $setColumn, $newPass, $whereColumn, $uid);
	}
}