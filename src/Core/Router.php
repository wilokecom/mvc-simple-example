<?php


class Router
{
	private $aRouter;

	public function setRouter($router)
	{
		$this->aRouter = $router;

		return $this;
	}

	public function direct($route)
	{
		if (isset($this->aRouter[$route])) {
			$currentRoute = $this->aRouter[$route];

			list($controller, $method) = explode('@', $currentRoute);

			include "src/Controllers/" . $controller . '.php';

			$oCurrentRoute = new $controller;
			$oCurrentRoute->{$method}();
		}
	}
}