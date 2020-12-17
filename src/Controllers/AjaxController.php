<?php
namespace Basic\Controllers;

class AjaxController
{
	public function ajaxHandler()
	{
//		echo '<pre>';
//		var_export($_POST);die;
		parse_str($_POST['data'], $aData);
//		unset($aData['action']);
//		if (Query::connect()->table('users')->where(['username' => $aData['username']])->get()) {
//			echo json_encode([
//				'status' => 'error',
//				'msg'    => sprintf('The user %s is already existed', $aData['username'])
//			]);
//			die;
//		}
////
//		$aData['password'] = md5($aData['password']);
//		$status = Query::connect()->table('users')->insert($aData);
//		var_export($status);die;
//		if (!$status) {
//			die(Query::connect()->getError());
//		}


//		parse_str($_POST['data'], $aData);
//		echo '<pre>';
		doAction('ajax_handle_'.$_POST['action'], $aData);
	}
}
