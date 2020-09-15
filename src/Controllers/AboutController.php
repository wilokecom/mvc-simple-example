<?php

namespace mvc_simple_example\Controllers;
class AboutController
{
	public function loadIndex()
	{
		loadView("about/index");
	}
}