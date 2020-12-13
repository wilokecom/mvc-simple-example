<?php
require_once "App.php";
require_once "Request.php";
require_once "Router.php";
require_once "src/Database/Query.php";
require_once "functions.php";

App::bind('configs/router', include "configs/router.php");
App::bind('configs/app', include "configs/app.php");
App::bind('configs/database', include "configs/database.php");


global $aListCallback;

function doAction($action, ...$aArgs) {
	if (App::getActions($action)) {
		foreach (App::getActions($action) as $callback) {
			//handleRegister
			if (is_callable($callback, true)) {
				call_user_func_array($callback, $aArgs);
			}
		}
	}
}


function addAction($action, $callback) {
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
