<?php

addAction('ajax_handle_register', 'handleRegister');
//addAction('ajax_handle_register', 'handleRegister1');
//
function handleRegister($aArgs)
{
	unset($aArgs['action']);
	if (Query::connect()->table('users')->where(['username' => $aArgs['username']])->get()) {
		echo json_encode([
			'status' => 'error',
			'msg'    => sprintf('The user %s is already existed', $aArgs['username'])
		]);
		die;
	}

	echo json_encode([
		'status' => 'success',
		'msg'    => 'The account has been registered succesully'
	]);
	die;
}

//function handleRegister1($aArgs)
//{
//	echo __FUNCTION__;
//	die;
//}
