<?php
function loadView($file = 'home/index'){

	if (strpos($file, '.php') === false) {
		$file .= '.php';
	}

	if (file_exists('src/Views/'.$file)){
		include 'src/Views/' . $file;
	}
}
function isMatchedRoute($route) {
	return Request::uri();
}