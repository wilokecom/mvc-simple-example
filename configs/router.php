<?php
return [
	'GET' => [
    'home'  => 'Basic\Controllers\HomeController@loadIndex',
    'about' => 'Basic\Controllers\AboutController@loadIndex',
    'contact' => 'Basic\Controllers\ContactController@loadIndex',
    'register' => 'Basic\Controllers\RegisterController@loadIndex',
    'sqliteusers' => 'Basic\Controllers\SqliteUserController@fetchUsers',
  ],
  'POST' => [
    'register' => 'Basic\Controllers\RegisterController@handleRegister',
    'ajaxhandler' => 'Basic\Controllers\AjaxController@ajaxHandler',
    'adduser' => 'Basic\Controllers\SqliteUserController@addUser',
    'deleteuser' => 'Basic\Controllers\SqliteUserController@deleteUser',
  ]
];
