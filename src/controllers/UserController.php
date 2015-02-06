<?php

require  __DIR__ . '/../models/UserModel.php';

class UserController
{
    public function viewUser($id)
    {
        $userModel = new UserModel();
        $viewData = $userModel->getUserInfoById((int)$id);
        $data = $viewData['data'];

        if ($data['group'] == 3) {
          $achievementData = $userModel->getAchievements((int)$id);
          if ($achievementData['success']) {
            $aData = $achievementData['data'];
          }
        }

        return View::getInstance()->render('user',
          array('username' => $data['username'],
          'firstName' => $data['first_name'],
          'lastName' => $data['last_name']),
        array('achievements' => $aData));
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
        $userData = $userModel->getUserInfo($username);
        $data = $userData['data'];

      if ($isValid) {
        $_SESSION['userId'] = $data['id'];
        return View::getInstance()->render('ranking', array());
      }

        return View::getInstance()->render('login', array());
    }

    public function logout()
    {
      unset($_SESSION['userId']);

      return View::getInstance()->render('login', array());
    }
}
