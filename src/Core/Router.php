<?php


class Router
{
	public $aRouter = [];

	public function setRouter($route)
	{
		$this->aRouter = $route;
		return $this;
	}

	public function direct($method, $route)
	{
		if (isset($this->aRouter[$method][$route])) {
			list($controller, $methods) = explode('@', $this->aRouter[$method][$route]);

			include 'src/Controllers/' . $controller . '.php';
			$oPage = new $controller;
			$oPage->{$methods}();
		}
	}

}