<?php
session_start();

require_once(__DIR__ . '/FormValidator.php');
require_once __DIR__ . '/../Model/LoginModel.php';
require_once __DIR__ . '/UserController.php';
require_once __DIR__ . '/../Model/Database.php';
class Login extends FormValidator {
    private $loginModel;
    private $userController;

    public function __construct($username, $password, $dbConnection) {
        $this->data['personal_info']['username'] = $username;
        $this->data['personal_info']['password'] = $password;

        // Initialize the LoginModel and UserController
        $this->loginModel = new LoginModel();
    
        $this->userController = new UserController($dbConnection);
    }

    /**
     * 
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

                // Check if the user is an admin
                $_SESSION['is_admin'] = $this->userController->isUserAdmin($emailRecords['data']['id']);

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

// Redirect if the user is already logged in
if (isset($_SESSION['auth_status'])) {
    header("Location: ./index.php");
    exit();
}

// Handle POST request for login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('../Model/Database.php'); // Ensure database connection
    $db = new Database();
    $dbConnection = $db->connect();

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $login = new Login($username, $password, $dbConnection);
    $result = $login->login();

    if ($result['status'] === true) {
        // Redirect to index if login is successful
        header("Location: ./index.php");
        exit();
    } else {
        // Handle login errors
        $errorMessages = $result['errors'];
    }
}
