<?php
// Define the session cookie
define('SESSIONCOOKIE', 'my_custom_session');
session_name(SESSIONCOOKIE);
session_start();

// Include the database connection script
require("../config/request.php");
require("../class/user.class.php");
require("../class/formValidator.class.php");

// Array holding variables with posted values or set to an empty string
$formData = [
    'title' => isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '',
    'username' => isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '',
    'firstName' => isset($_POST['first-name']) ? htmlspecialchars($_POST['first-name']) : '',
    'lastName' => isset($_POST['last-name']) ? htmlspecialchars($_POST['last-name']) : '',
    'email' => isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '',
    'country' => isset($_POST['country']) ? htmlspecialchars($_POST['country']) : '',
    'comment' => isset($_POST['comment']) ? htmlspecialchars($_POST['comment']) : '',
    'terms' => isset($_POST['checkbox']) ? 'checked' : ''
];

// Example of accessing variables from the array
// echo $formData['title'];
// echo $formData['email'];

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
