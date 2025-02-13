<?php

require_once('Database.php');

class ManufacturerList
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getManufacturerNameById($manufacturer_id)
    {

        $query = "SELECT name FROM manufacturers WHERE manufacturer_id = :manufacturer_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':manufacturer_id', $manufacturer_id, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch the result and return the name if found
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['name'] : null; // Return the name or null if not found
    }


    // Check if a manufacturer exists
    public function checkManufacturerExists($name)
    {
        try {
            $query = "SELECT 1 FROM Manufacturers WHERE name = :name LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchColumn() !== false; // True if the manufacturer exists
        } catch (PDOException $e) {
            error_log("Error checking manufacturer existence: " . $e->getMessage());
            return false;
        }
    }

    // Insert a new manufacturer
    public function insertNewManufacturer($data)
    {
        try {
            if ($this->checkManufacturerExists($data['name'])) {
                return ['success' => false, 'message' => 'Manufacturer already exists.'];
            }

            $query = "INSERT INTO Manufacturers (name, country) VALUES (:name, :country)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindParam(':country', $data['country'], PDO::PARAM_STR);

            $stmt->execute();
            return ['success' => true, 'message' => 'Manufacturer inserted successfully.'];
        } catch (PDOException $e) {
            error_log("Error inserting manufacturer: " . $e->getMessage());
            return ['success' => false, 'message' => 'Failed to insert manufacturer.'];
        }
    }

    // Fetch all manufacturers
    public function getAllManufacturers()
    {
        try {
            if (!$this->db) {
                throw new Exception("Database connection is null.");
            }

            $query = "SELECT * FROM Manufacturers ORDER BY name ASC";
            $stmt = $this->db->query($query);

            if (!$stmt) {
                throw new Exception("Query execution failed.");
            }

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error fetching manufacturers: " . $e->getMessage());
            return [];
        }
    }

    // Delete a manufacturer by ID
    public function deleteManufacturerById($manufacturerId)
    {
        try {
            $query = "DELETE FROM Manufacturers WHERE manufacturer_id = :manufacturerId";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':manufacturerId', $manufacturerId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error deleting manufacturer by ID: " . $e->getMessage());
            return false;
        }
    }
}

?>