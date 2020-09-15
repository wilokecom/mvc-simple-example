<?php


namespace mvc_simple_example\Controllers;


class RegisterController
{
    public function loadIndex()
    {
        loadView("register/index");
    }
    public function hendleRegister()
    {
        var_dump($_POST);die();
    }
}