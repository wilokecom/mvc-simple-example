<?php


namespace MVC\Model;

use MVC\Database\Query;

class UserModel
{
	public static function selectUser()
	{
		return Query::table('users')->select(['user_id', 'first_name', 'email', 'pass', 'registrantion_date'])->get('x');
	}

	public static function deleteUserId($id)
	{
		return Query::table('users')->where('user_id', $id)->delete();
	}

	public static function insertUser($first_name, $last_name, $email, $pass)
	{
		return Query::table('users')
			->insert([
				'first_name' => $first_name,
				'last_name'  => $last_name,
				'email'      => $email,
				'pass'       => $pass,
			]);
	}

	public static function changePassUser($uid, $newPass)
	{
		return Query::table('users')
			->update(['pass' => $newPass], ['user_id' => $uid]);
	}


}

