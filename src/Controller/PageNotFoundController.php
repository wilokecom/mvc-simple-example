<?php

namespace MVC\Controller;

class PageNotFoundController
{
	public function loadIndex()
	{
		loadView('404/index');
	}
}