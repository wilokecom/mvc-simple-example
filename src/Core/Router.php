<?php
namespace Basic\Core;

class Router
{
	private $aRouter;

	public function setRouter($router)
	{
		$this->aRouter = $router;
		return $this;
	}

	public function direct($method, $route)
	{
		if (isset($this->aRouter[$method][$route])) {
			list($controller, $method) = explode('@', $this->aRouter[$method][$route]);

			$oInit = new $controller;

			$oInit->{$method}();
		} else {
			echo "This route does not exist";
		}
	}
}
