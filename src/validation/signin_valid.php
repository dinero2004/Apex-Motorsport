<?php
ob_start(); // Start output buffering

session_start(); // Ensure session_start() is called at the top

require_once("../config/request.php");
require_once("../class/user.class.php");

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // If the user is already logged in, redirect to the homepage
    header("Location: ../views/index.php");
    exit();
}

// Initialize the database connection
$db = new Database();
$pdo = $db->connect();

// Handle form submission
$errors = []; // Initialize errors array

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sanitize the password
    $password = sanitizePassword($password);

    // Initialize User object
    $user = new User($pdo);

    // Attempt to log in the user
    if (!$user->login($username, $password)) {
        // Display errors if login failed
        $errors = $user->getErrors();
    }
}

// Function to sanitize the password
function sanitizePassword($password) {
    // Remove leading/trailing spaces
    $password = trim($password);

    // Encode special characters to prevent XSS
    $password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');

    // Return sanitized password
    return $password;
}
