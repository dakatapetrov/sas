<?php

class UserController
{
    public function register($name, $bla)
    {
        return View::getInstance()->render('register', array('name' => $name, 'bla' => $bla));
    }
}
