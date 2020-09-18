<?php
return [
	'home'     => 'HomeController@loadIndex',
	'about'    => 'AboutController@loadIndex',
	'contact'  => 'ContactController@loadIndex',
	'register' => 'RegisterController@loadIndex',

	'GET'  => [
		'home'     => 'HomeController@loadIndex',
		'about'    => 'AboutController@loadIndex',
		'contact'  => 'ContactController@loadIndex',
		'register' => 'RegisterController@loadIndex',
	],
	'POST' => [
		'register' => 'RegisterController@handleRegister',
	],
];