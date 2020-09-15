<?php

/**
 * @var  $aRoute \mvc_simple_example\core\Router
 */
$aRoute->get('home', 'mvc_simple_example\Controllers\HomeController@loadIndex');
$aRoute->get('about', 'mvc_simple_example\Controllers\AboutController@loadIndex');
$aRoute->get('contact', 'mvc_simple_example\Controllers\ContactController@loadIndex');
$aRoute->get('register', 'mvc_simple_example\Controllers\RegisterController@loadIndex');
$aRoute->post('register', 'mvc_simple_example\Controllers\RegisterController@hendleRegister');
