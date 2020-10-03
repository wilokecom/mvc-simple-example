<?php

namespace MVC\Controller;

class HomeController
{
	public function loadIndex()
	{
		loadView('home/index');
	}
}