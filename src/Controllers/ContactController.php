<?php
namespace mvc_simple_example\Controllers;
class ContactController
{
	public function loadIndex()
	{
		loadView("contact/index");
	}
}