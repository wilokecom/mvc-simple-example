<?php
use mvc_simple_example\Core\Request;
use mvc_simple_example\Core\App;
use mvc_simple_example\Core\Router;
require_once 'vendor/autoload.php';
require_once 'Function/function.php';

App::bind('configs/app',require_once 'configs/app.php');
Router::Load('configs/router.php')->dirct(Request::uri(),Request::method());
