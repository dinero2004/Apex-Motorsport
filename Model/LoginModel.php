<?php
require_once ('Database.php');

class LoginModel extends Database {
    
  public function fetchUser(string $username) :array {
    $this->query("SELECT * FROM `users` WHERE username = :username");
    $this->bind("username", $username);
    $this->execute();

    $User = $this->fetch();
    if (!empty($User)) {
      return array(
        'status' => true,
        'data' => $User
      );
    }
    return array(
      'status' => false,
      'data' => []
    );
  }


}
