<?php
require_once "Request.php";
require_once "Router.php";
$aRouter = include "configs/routers.php";

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

function isMatchedRoute($route) {
	return $route === Request::route();
}

$oRoute = new Router();
$oRoute->setRouter($aRouter)->direct(Request::route());
$oRouter->direct(Request::method(), Request::uri());