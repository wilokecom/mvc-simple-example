<?php

use Basic\Core\App;
use Basic\Core\Request;
use Basic\Core\Router;
use Basic\Database\SqliteQuery;

require "vendor/autoload.php";

App::bind('configs/router', include "configs/router.php");
App::bind('configs/app', include "configs/app.php");
App::bind('configs/database', include "configs/database.php");

echo '<pre>';
echo 'If else là cách code của những kẻ <strong>chưa đắc đạo</strong> aka <strong> tư duy  Nông Văn Rền</strong>' . '<br />';
echo '<br />';
if (App::get('configs/database')['dbms'] == 'sqlite') {
	echo 'Nếu là sqlite thì: <br />';
	echo '<br />';
	var_export(\Basic\Database\Query::connect()->table('users')->get()->fetchArray(SQLITE3_ASSOC));
} else {
	echo 'Nếu là mysql thì: <br />';
	echo '<br />';
	var_export(\Basic\Database\Query::connect()->table('users')->get()->fetch_assoc());
}

die;

function doAction($action, ...$aArgs)
{
	if (App::getActions($action)) {
		foreach (App::getActions($action) as $callback) {
			//handleRegister
			if (is_callable($callback, true)) {
				call_user_func_array($callback, $aArgs);
			}
		}
	}
}


function addAction($action, $callback)
{
	App::setAction($action, $callback);
}


function loadView($file)
{
	if (strpos($file, '.php') === false) {
		$file .= '.php';
	}

	$file = "src/Views/" . $file;
	if (file_exists($file)) {
		include $file;
	}
}

function redirectTo($to = '/')
{
	header('Location: ' . $to);
	exit;
}

function isMatchedRoute($route)
{
	return $route === Request::uri();
}


$oRoute = new Router();
$oRoute->setRouter(App::get('configs/router'));
$oRoute->direct(Request::method(), Request::uri());
