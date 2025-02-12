<?php 
require_once 'Database.php';

class UserModel {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function updateUserAdminStatus($userId, $isAdmin) {
        $query = "UPDATE users SET is_admin = :is_admin WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':is_admin', $isAdmin, PDO::PARAM_INT);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Failed to update user admin status.");
        }
    }

    public function getUserList() {
        try {
            $query = "SELECT id, username, firstname, lastname, email, country, is_admin FROM users";
            $stmt = $this->db->query($query); // Execute the query
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch the results
            return $result; // Return the results
        } catch (PDOException $e) {
            error_log("Error fetching user list: " . $e->getMessage());
            return []; // Return an empty array on error
        }
    }
    
    public function isUserAdmin($userId) {
        // Example query, update table and column names as per your database
        $query = "SELECT is_admin FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Return true if 'is_admin' is set and equals 1
        return !empty($result) && $result['is_admin'] == 1;
    }

       public function deleteUserById($userId)
       {
           try {
   
               $query = "DELETE FROM users WHERE id = :id";
               $stmt = $this->db->prepare($query);
               $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
               return $stmt->execute();
           } catch (PDOException $e) {
               error_log("Error deleting user by ID: " . $e->getMessage());
               return false;
           }
       }
}