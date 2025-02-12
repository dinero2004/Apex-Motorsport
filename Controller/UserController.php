<?php 
require_once __DIR__ . '/../Model/UserModel.php';

class UserController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new UserModel($db); 
    }

    public function grantAdminRights($userId) {
        // if ($_SESSION['is_admin'] == 1) { // Check if the logged-in user is an admin
            return $this->userModel->updateUserAdminStatus($userId, 1);
        // } else {
        //     throw new Exception("Unauthorized access.");
        // }
    }

    public function revokeAdminRights($userId) {
        // if ($_SESSION['is_admin'] == 1) { // Check if the logged-in user is an admin
            return $this->userModel->updateUserAdminStatus($userId, 0);
        // } else {
        //     throw new Exception("Unauthorized access.");
        // }
    }

    public function getAllUsers() {
        return $this->userModel->getUserList();
    }    

    public function isUserAdmin($userId) {
        // Fetch admin status from the user model
        $isAdmin = $this->userModel->isUserAdmin($userId);
    
        // Return the result
        return $isAdmin;
    }
                 
    public function deleteUser($userId) {
        // Fetch admin status from the user model
        return $this->userModel->deleteUserById($userId);

    }
}
