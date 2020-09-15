<?php
namespace mvc_simple_example\Controllers;
class HomeController
{
	public function loadIndex()
	{
		loadView("home/index");
	}
}