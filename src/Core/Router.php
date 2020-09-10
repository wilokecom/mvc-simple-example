<?php

class Router
{
	protected $aRouter;

	public function setRouter($route)
	{
		$this->aRouter = $route;
	}

	public function direct($route)
	{
		if (isset($this->aRouter[$route])) {
			$pasteController = explode('@', $this->aRouter[$route]);

			include 'src/Controllers/'.$pasteController[0].'.php';
			$oInit = new $pasteController[0];

			$oInit->{$pasteController[1]}();
		} else {
			echo "This route does not exist";
		}
	}
}