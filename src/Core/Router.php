<?php

class Router
{
	protected $aRouter;

	public function setRouter($route)
	{
		$this->aRouter = $route;
		return $this;
	}

	public function direct($method, $route)
	{
		if (isset($this->aRouter[$method][$route])) {
			list($controller, $method) = explode('@', $this->aRouter[$method][$route]);

			include 'src/Controllers/' . $controller . '.php';
			$oInit = new $controller;

			$oInit->{$method}();
		} else {
			echo "This route does not exist";
		}
	}
}