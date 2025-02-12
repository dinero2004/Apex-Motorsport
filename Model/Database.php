<?php
class Database {
    // Database connection parameters
    private $db_server = "localhost";
    private $db_user = "root";
    private $db_pass = "root";  
    private $db_name = "apex_motorsport";
    private $charset = "utf8";
    private $pdo = null;
    private $dbStmt; 

    // Connect method: Establish a connection to the database
    public function connect() {
        if ($this->pdo === null) {
            try {
                // PDO Data Source Name (DSN)
                $dsn = "mysql:host=$this->db_server;dbname=$this->db_name;charset=$this->charset";
                
                // Create a new PDO instance
                $this->pdo = new PDO($dsn, $this->db_user, $this->db_pass);
                
                // Set PDO error mode to exception for better error handling
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                // Handle connection errors
                die("Database connection failed: " . $e->getMessage());
            }
        }
        return $this->pdo;
    }

    // Prepare and execute a query
    public function query($query) {
        $this->dbStmt = $this->connect()->prepare($query);
    }
    
    // Bind parameters to the prepared statement
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            // Set the type based on the value
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }
        // Bind the parameter
        $this->dbStmt->bindValue($param, $value, $type);
    }
    
    // Execute the prepared statement
    public function execute() {
        if ($this->dbStmt->execute()) {
            return true;
        } else {
            // Handle the error (you can log it or throw exceptions)
            throw new Exception("Database query failed: " . implode(", ", $this->dbStmt->errorInfo()));
        }
    }
    
    // Fetch one result
    public function fetch() {
        $this->execute();  // Execute the query
        return $this->dbStmt->fetch(PDO::FETCH_ASSOC);  // Fetch one row
    }
    
    // Fetch all results
    public function fetchAll() {
        $this->execute();  // Execute the query
        return $this->dbStmt->fetchAll(PDO::FETCH_ASSOC);  // Fetch all rows
    }

    // Close connection method 
    public function closeConnection() {
        $this->pdo = null;  // Close the PDO connection
    }
}

