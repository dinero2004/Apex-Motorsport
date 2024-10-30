<?php
// Define the session cookie
define('SESSIONCOOKIE', 'my_custom_session');
session_name(SESSIONCOOKIE);
session_start();

// Include the database connection script
include("../config/request.php");

class FormValidator {
    public $username = "";
    public $lastname = "";
    public $firstname = "";
    public $email = "";
    public $password = "";
    public $country = "";
    public $comment = "";
    public $title = "";
    public $terms = false;

    public $errors = [];

    public function validateForm($postData) {
        $this->title = $this->sanitizeInput($postData["title"]);
        $this->username = $this->sanitizeInput($postData["username"]);
        $this->lastname = $this->sanitizeInput($postData["last-name"]);
        $this->firstname = $this->sanitizeInput($postData["first-name"]);
        $this->email = $this->sanitizeInput($postData["email"]);
        $this->password = $this->sanitizeInput($postData["password"]);
        $this->country = $this->sanitizeInput($postData["country"]);
        $this->comment = $this->sanitizeInput($postData["comment"]);
        $this->terms = isset($postData["checkbox"]);

        $this->validateTitle();
        $this->validateUsername();
        $this->validateLastname();
        $this->validateFirstname();
        $this->validateEmail();
        $this->validatePassword();
        $this->validateCountry();
        $this->validateTerms();

        return empty($this->errors);
    }

    private function sanitizeInput($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    private function validateTitle() {
        if (empty($this->title)) {
            $this->errors['title'] = "Title is required.";
        }
    }

    private function validateUsername() {
        if (empty($this->username)) {
            $this->errors['username'] = "Username is required.";
        } elseif (strlen($this->username) < 4 || strlen($this->username) > 16) {
            $this->errors['username'] = "Username must be between 4 and 16 characters.";
        } elseif (preg_match('/\s/', $this->username)) {
            $this->errors['username'] = "Username should not contain spaces.";
        }
    }

    private function validateFirstname() {
        if (empty($this->firstname)) {
            $this->errors['firstname'] = "Firstname is required.";
        }
    }

    private function validateLastname() {
        if (empty($this->lastname)) {
            $this->errors['lastname'] = "Lastname is required.";
        }
    }

    private function validateEmail() {
        if (empty($this->email)) {
            $this->errors['email'] = "Email is required.";
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Invalid email format.";
        }
    }

    private function validatePassword() {
        if (empty($this->password)) {
            $this->errors['password'] = "Password is required.";
        } elseif (strlen($this->password) < 8 || !preg_match('/[A-Z]/', $this->password) || !preg_match('/\d/', $this->password) || !preg_match('/[\W]/', $this->password)) {
            $this->errors['password'] = "Password must contain at least 8 characters, one uppercase letter, one number, and one special character.";
        }
    }

    private function validateCountry() {
        if (empty($this->country)) {
            $this->errors['country'] = "Country is required.";
        }
    }

    private function validateTerms() {
        if (!$this->terms) {
            $this->errors['terms'] = "You must accept the terms and conditions.";
        }
    }

    public function getError($field) {
        return isset($this->errors[$field]) ? $this->errors[$field] : '';
    }
}

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // method to check if the username is already taken

    public function uniqueUsername($username) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        return $stmt->fetchColumn() == 0;
    }

    // method to check if the email is already in use

    public function uniqueEmail($email) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetchColumn() == 0;
    }

    public function createUser($username, $lastname, $firstname, $email, $password, $country, $gender, $comment) {
        $stmt = $this->conn->prepare("INSERT INTO users (username, lastname, firstname, email, password, country, gender, comment) 
                                      VALUES (:username, :lastname, :firstname, :email, :password, :country, :gender, :comment)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_BCRYPT));
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':comment', $comment);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}

$database = new Database();
$connection = $database->connect();
$formValidator = new FormValidator();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($formValidator->validateForm($_POST)) {
        $user = new User($connection);

        // Error if username is not unique
        if (!$user->uniqueUsername($formValidator->username)) {
            $formValidator->errors['username'] = "Username is already taken.";
        }
        
        // Error if email is not unique
        if (!$user->uniqueEmail($formValidator->email)) {
            $formValidator->errors['email'] = "Email is already in use. Please use a different one.";
        }

        // If no errors visible create a new user.
        if (empty($formValidator->errors) && $user->createUser(
            $formValidator->username, 
            $formValidator->lastname, 
            $formValidator->firstname, 
            $formValidator->email, 
            $formValidator->password, 
            $formValidator->country, 
            $formValidator->title, 
            $formValidator->comment)) {
            
            // Redirect on success
            header("Location: confirm.php");
            exit();
        } else {
            $formValidator->errors['general'] = "Failed to create the user.";
        }
    }
}
