<?php
require_once('Database.php');

class RegisterModel extends Database
{

    // Check if username is unique
    public function isUniqueUsername($username)
    {
        $this->query("SELECT username FROM users WHERE username = :username");
        $this->bind("username", $username);
        $result = $this->fetch();

        // Returns true if no rows are found (username is unique)
        return $result === false;
    }

    // Check if email is unique
    public function isUniqueEmail($email)
    {
        $this->query("SELECT email FROM users WHERE email = :email");
        $this->bind("email", $email);
        $result = $this->fetch();

        // Returns true if no rows are found (email is unique)
        return $result === false;
    }

    // Create new user
    public function createUser(array $user)
    {
        $this->query("INSERT INTO users (username, lastname, firstname, email, password, country, title, comment) 
                      VALUES (:username, :firstname, :lastname, :email, :password, :country, :title, :comment)");

        $this->bind("username", $user['username']);
        $this->bind("firstname", $user['firstname']);
        $this->bind("lastname", $user['lastname']);
        $this->bind("email", $user['email']);
        $this->bind("password", $user['password']);
        $this->bind("country", $user['country']);
        $this->bind("title", $user['title']);
        $this->bind("comment", $user['comment']);
        
        if ($this->execute()) {
            return [
                'status' => true,
                'message' => 'User created successfully.'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Failed to create user.'
            ];
        }
    }
}
?>