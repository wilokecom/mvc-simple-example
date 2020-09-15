<?php
function loadView($file)
{
    if (strpos($file, '.php') === false) {
        $file .= '.php';
    }

    $file = "src/Views/" . $file;
    if (file_exists($file)) {
        include $file;
    }
}
function isMatchedRoute($route) {
    return $route === \mvc_simple_example\core\Request::uri();
}