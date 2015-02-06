<?php

require  __DIR__ . '/../models/UserModel.php';

class UserController
{
    public function viewUser($id)
    {
        $userModel = new UserModel();
        $viewData = $userModel->getUserInfo((int)$id);

        var_dump($viewData);

        return View::getInstance()->render('register', $viewData['data']);
    }

    public function register($name, $bla)
    {
        return View::getInstance()->render('register', array('name' => $name, 'bla' => $bla));
    }
}
