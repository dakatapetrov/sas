<?php

require __DIR__ . '/../../core/Model.php';

class UserModel extends Model
{
    public function getUserInfo($username)
    {
      $username = $this->sanitize($username);


      $query = $this->dbConnection->query(
        'SELECT * FROM users WHERE username="' . $username .'"'
      );

      if($query) {
        $data = $query->fetch_assoc();
        return array('success' => true, 'data' => $data);
      }

      return array('success' => false, 'data' => null);
    }

    public function getUserInfoById($id)
    {
      $id = $this->sanitize($id);


      $query = $this->dbConnection->query(
        'SELECT * FROM users WHERE id="' . $id .'"'
      );

      if($query) {
        $data = $query->fetch_assoc();
        return array('success' => true, 'data' => $data);
      }

      return array('success' => false, 'data' => null);
    }


    public function areCredentialsValid($username, $password)
    {
      $username = $this->sanitize($username);


      $query = $this->dbConnection->query(
        'SELECT * FROM users WHERE username="' . $username .'"'
      );

      if($query) {
        $data = $query->fetch_assoc();
        return $data['password'] == $password;

      } else {
        return false;
      }
    }

    public function getAchievements($id) {
      $id = $this->sanitize($id);


      $query = $this->dbConnection->query(
        'SELECT * FROM students_achievements AS sa INNER JOIN achievements AS a ON sa.achievement_id=a.id WHERE student_id="' . $id .'"'
      );

      echo $this->dbConnection->error;

      if($query) {
        $dataArray = array();
        while ($data = $query->fetch_assoc()) {
          $dataArray[] = $data;
        }
        return array('success' => true, 'data' => $dataArray);
      }

      return array('success' => false, 'data' => null);

    }
}
