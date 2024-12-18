<?php
session_start();

require_once('FormValidator.php');
require_once('../Model/LoginModel.php');

class Login extends FormValidator {
    private $loginModel;

    public function __construct($username, $password) {
        $this->data['personal_info']['username'] = $username;
        $this->data['personal_info']['password'] = $password;

        // Initialize the LoginModel
        $this->loginModel = new LoginModel();
    }

    /**
     * Login method that handles user authentication
     * @param array $data
     * @return array
     */
    public function login(): array {
        // Access the personal info from the data array
        $personalInfo = $this->data['personal_info'];
        
        // Sanitize inputs
        $username = $this->sanitizeInput($personalInfo['username'], '');
        $password = $this->sanitizeInput($personalInfo['password'], 'TEXT');
    
        // Fetch email record from the database
        $emailRecords = $this->loginModel->fetchUser($username);
    
        if ($emailRecords['status']) {
            // Verify password
            if (password_verify($password, $emailRecords['data']['password'])) {
                // Set session status for authentication
                $_SESSION['auth_status'] = true;
                $_SESSION['user_id'] = $emailRecords['data']['id'];
    
                return [
                    'status' => true,
                    'message' => 'Login successful.'
                ];
            } else {
                return [
                    'status' => false,
                    'errors' => ['password' => 'Invalid password.']
                ];
            }
        }
    
        return [
            'status' => false,
            'errors' => ['email' => 'No user found with this email address.']
        ];
    }
    
    }

    if (isset($_SESSION['auth_status'])) {
        // echo  $_SESSION['auth_status'];
        header("Location: ./index.php");
        
    exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST')  {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        $login = new Login($username, $password);
        $result = $login->login();
        if($result ['status'] === true) {
            header("Location: ./index.php");
            exit();
        } 
    }
