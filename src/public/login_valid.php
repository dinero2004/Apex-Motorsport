<?php
// Include the request.php file to connect to the database
include("../config/request.php");

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // If the user is already logged in, redirect to the homepage
    header("Location: index.php");
    exit();
}

// Initialize the database connection
$db = new Database();
$pdo = $db->connect();

// User class for handling user login
class User {
    private $pdo;
    private $errors = [];

    // Constructor to initialize the database connection
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Method to login a user
    public function login($username, $password) {
        // Prepare SQL to fetch user by username
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // If user exists, verify the password
            if (password_verify($password, $user['password'])) {
                // If login is successful: initialize session variables
                session_start();
                session_regenerate_id(true); // dynamic id

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['success_message'] = "Logged in successfully!";
            
                // Redirect to index.php (home page)
                header("Location: index.php");
                exit();
            } else {
                // Incorrect password
                $this->errors[] = "Incorrect password.";
            }
        } else {
            // Username not found
            $this->errors[] = "Username not found.";
        }
        return false;
    }

    // Method to get any errors
    public function getErrors() {
        return $this->errors;
    }
}

// Handle form submission
$errors = []; // Initialize errors array
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Initialize User object
    $user = new User($pdo);

    // Attempt to log in the user
    if (!$user->login($username, $password)) {
        // Display errors if login failed
        $errors = $user->getErrors();
    }
}


