<?php
/**
 * @var $oRoute MVC\Core\Router
 */
$oRoute->get('home', 'MVC\Controller\HomeController@loadIndex');
$oRoute->get('about', 'MVC\Controller\AboutController@loadIndex');
$oRoute->get('404', 'MVC\Controller\PageNotFoundController@loadIndex');
$oRoute->get('register', 'MVC\Controller\RegisterController@loadIndex');
$oRoute->get('user', 'MVC\Controller\UserController@loadIndex');
$oRoute->post('register', 'MVC\Controller\RegisterController@handleRegister');
$oRoute->post('user/delete', 'MVC\Controller\UserController@deleteUser');
$oRoute->post('user/change', 'MVC\Controller\UserController@changeUser');

