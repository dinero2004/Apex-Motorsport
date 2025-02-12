<?php
// Define the session cookie
session_start();

// Include the necessary files
require("../Model/Database.php");
require("../Controller/FormValidator.php");
require("../Model/RegisterModel.php"); // RegisterModel for user creation

// Initialize the FormValidator and RegisterModel
$formValidator = new FormValidator();
$registerModel = new RegisterModel(); 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle form validation
    if ($formValidator->validateForm($_POST)) {
        // Check if username is unique
        if (!$registerModel->isUniqueUsername($formValidator->data['personal_info']['username'])) {
            $formValidator->errors['username'] = "Username is already taken.";
        }

        // Check if email is unique
        if (!$registerModel->isUniqueEmail($formValidator->data['personal_info']['email'])) {
            $formValidator->errors['email'] = "Email is already in use. Please use a different one.";
        }

        // If no errors, create the user
        if (empty($formValidator->errors)) {
            $data = [
                'username' => $formValidator->data['personal_info']['username'],
                'firstname' => $formValidator->data['personal_info']['firstname'],
                'lastname' => $formValidator->data['personal_info']['lastname'],
                'email' => $formValidator->data['personal_info']['email'],
                'password' => password_hash($formValidator->data['personal_info']['password'], PASSWORD_BCRYPT),
                'country' => $formValidator->data['additional_info']['country'],
                'title' => $formValidator->data['additional_info']['title'],
                'comment' => $formValidator->data['additional_info']['comment']
            ];

            // Create the user in the database
            $result = $registerModel->createUser($data);

            if ($result['status']) {
                // Redirect on success
                header("Location: ./confirm.php");
                exit();
            } else {
                $formValidator->errors['general'] = $result['message'];
            }
        }
    }
}
?>
