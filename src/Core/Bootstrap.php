<?php

namespace MVC\Core;

define('HomeURL', 'http://mvc.huy.com/');

use MVC\Core\Request;
use MVC\Core\Router;
use MVC\Core\App;
use MVC\Database\Connect;
use MVC\Database\Query;
use MVC\Model\UserModel;

include "function/function.php";


App::bind('config/app', require_once 'config/app.php');
Router::getInstance('config/router.php')->direct(Request::method(), Request::uri());