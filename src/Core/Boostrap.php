<?php
require_once 'Request.php';
require_once 'Router.php';

function loadView($file)
{
	if (file_exists('src/Views/' . $file)) {
		include 'src/Views/' . $file;
	}
}

$route = isset($_REQUEST['route']) ? $_REQUEST['route'] : 'home';

$oRouter = new Router();

$oRouter->setRouter(include 'configs/router.php');
$oRouter->direct($route);