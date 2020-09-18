<?php
include 'Request.php';
include 'Router.php';
include 'Function/function.php';
$aRouter = include 'config/router.php';


$oRoute = new Router();
$oRoute->setRouter($aRouter)->direct(Request::method(),Request::uri());


