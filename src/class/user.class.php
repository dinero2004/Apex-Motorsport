<?php

class User {
    private $conn;
    private $errors = [];

    // Constructor to initialize the database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Method to check if the username is already taken
    public function uniqueUsername($username) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        return $stmt->fetchColumn() == 0;
    }

    // Method to check if the email is already in use
    public function uniqueEmail($email) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetchColumn() == 0;
    }

    // Method to create a new user (Sign-Up)
    public function createUser($username, $lastname, $firstname, $email, $password, $country, $gender, $comment) {
        if (!$this->uniqueUsername($username)) {
            $this->errors[] = "Username already taken.";
            return false;
        }
        if (!$this->uniqueEmail($email)) {
            $this->errors[] = "Email already in use.";
            return false;
        }

        $stmt = $this->conn->prepare("INSERT INTO users (username, lastname, firstname, email, password, country, gender, comment) 
                                      VALUES (:username, :lastname, :firstname, :email, :password, :country, :gender, :comment)");
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Binding parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':comment', $comment);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            $this->errors[] = "Error creating user: " . $e->getMessage();
            return false;
        }
    }

    // Method to login a user (Sign-In)

    public function login($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verify the password
            if (password_verify($password, $user['password'])) {
                // If login is successful: initialize session variables
                session_start();
                session_regenerate_id(true); // Dynamic session ID

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['success_message'] = "Logged in successfully!";
                return true;
            } else {
                $this->errors[] = "Incorrect password.";
            }
        } else {
            $this->errors[] = "Username not found.";
        }
        return false;
    }

    // Method to get errors
    public function getErrors() {
        return $this->errors;
    }
}
