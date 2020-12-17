<?php
return [
	"mysql" => [
		"host"     => "localhost",
		"db"       => "mvcbasic",
		"user"     => "root",
		"password" => "root"
	],
	"sqlite" => [
		"host" => dirname(dirname(__FILE__)) . '/basic'
	],
	"dbms" => "sqlite"
];
