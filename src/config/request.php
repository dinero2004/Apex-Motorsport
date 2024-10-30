
<?php
class Database {
    // Database connection parameters
    private $db_server = "localhost";
    private $db_user = "root";
    private $db_pass = "root";  
    private $db_name = "apex_motorsport";
    private $charset = "utf8";
    private $pdo;

    // Connect method: Establish a connection to the database
    public function connect() {
        try {
            // PDO Data Source Name (DSN)
            $dsn = "mysql:host=$this->db_server;dbname=$this->db_name;charset=$this->charset";
            
            // Create a new PDO instance
            $this->pdo = new PDO($dsn, $this->db_user, $this->db_pass);

            // Set PDO error mode to exception for better error handling
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Return the PDO instance for further use
            return $this->pdo;

        } catch (PDOException $e) {
            // Handle connection errors
            die("Database connection failed: " . $e->getMessage());
        }
    }

    // Close connection method 
    public function closeConnection() {
        $this->pdo = null;
    }
}
?>
