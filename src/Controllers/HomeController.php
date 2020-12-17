<?php
namespace Basic\Controllers;

class HomeController
{
	public function loadIndex()
	{
		loadView("home/index");
	}
}
