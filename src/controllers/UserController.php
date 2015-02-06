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

    public function login()
    {
      if($_POST) {
        if(isset($_POST['username'])) {
          $username = $_POST['username'];
        } else {
          die("mudafucka");
        }

        if(isset($_POST['password'])) {
          $password = $_POST['password'];
        } else {
          die("mudafucka");
        }
      } else {
        return View::getInstance()->render('login', array());
      }

        $userModel = new UserModel();
        $isValid = $userModel->areCredentialsValid($username, $password);

      if ($isValid) {
        $_SESSION['username'] = $username;
        return View::getInstance()->render('ranking', array());
      }

        return View::getInstance()->render('login', array());
    }

    public function logout()
    {
      unset($_SESSION['username']);

      return View::getInstance()->render('login', array());
    }
}
