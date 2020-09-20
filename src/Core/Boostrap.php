<?php
require_once "App.php";
require_once "Request.php";
require_once "Router.php";

App::bind('configs/router', include "configs/router.php");
App::bind('configs/app', include "configs/app.php");

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

function isMatchedRoute($route)
{
	return $route === Request::uri();
}

$oRoute = new Router();
$oRoute->setRouter(App::get('configs/router'));
$oRoute->direct(Request::method(), Request::uri());