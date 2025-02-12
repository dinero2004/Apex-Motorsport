<?php
require_once('Database.php');

class CarList
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // ------------------ Car Methods ------------------

    // Check if a car model already exists
    public function checkCarExists($modelName)
    {
        try {
            $query = "SELECT 1 FROM Cars WHERE model_name = :model_name LIMIT 1";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':model_name', $modelName, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchColumn() !== false; // True if the car exists
        } catch (PDOException $e) {
            error_log("Error checking car existence: " . $e->getMessage());
            return false;
        }
    }

    // Insert a new car
    public function insertNewCar($data)
    {
        try {
            if ($this->checkCarExists($data['model_name'])) {
                return ['success' => false, 'message' => 'Car model already exists.'];
            }

            $query = "INSERT INTO Cars (model_name, horsepower, engine_type, engine_capacity, top_speed, price, weight_kg, manufacturer_id) 
                      VALUES (:model_name, :horsepower, :engine_type, :engine_capacity, :top_speed, :price, :weight_kg, :manufacturer_id)";
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':model_name', $data['model_name'], PDO::PARAM_STR);
            $stmt->bindParam(':horsepower', $data['horsepower'], PDO::PARAM_INT);
            $stmt->bindParam(':engine_type', $data['engine_type'], PDO::PARAM_STR);
            $stmt->bindParam(':engine_capacity', $data['engine_capacity'], PDO::PARAM_STR);
            $stmt->bindParam(':top_speed', $data['top_speed'], PDO::PARAM_INT);
            $stmt->bindParam(':price', $data['price'], PDO::PARAM_STR);
            $stmt->bindParam(':weight_kg', $data['weight_kg'], PDO::PARAM_INT);
            $stmt->bindParam(':manufacturer_id', $data['manufacturer_id'], PDO::PARAM_INT);

            $stmt->execute();
            return ['success' => true, 'message' => 'Car model inserted successfully.'];
        } catch (PDOException $e) {
            error_log("Error inserting new car: " . $e->getMessage());
            return ['success' => false, 'message' => 'Failed to insert car model.'];
        }
    }

    // Fetch all cars
    public function getAllCars()
    {
        try {
            $query = "SELECT 
                        C.car_id, C.model_name, C.horsepower, C.engine_type, 
                        C.engine_capacity, C.top_speed, C.price, C.weight_kg, 
                        M.name AS manufacturer_name, M.country 
                      FROM Cars C 
                      JOIN Manufacturers M ON C.manufacturer_id = M.manufacturer_id
                      ORDER BY M.name ASC";
            $stmt = $this->db->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching all cars: " . $e->getMessage());
            return [];
        }
    }

    // Delete a car by ID
    public function deleteCarById($carId)
    {
        try {
            $query = "DELETE FROM Cars WHERE car_id = :carId";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':carId', $carId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error deleting car by ID: " . $e->getMessage());
            return false;
        }
    }

     // Update a car's details
     public function updateCarModel($car_id, $data)
     {
         $stmt = $this->db->prepare("
             UPDATE cars 
             SET model_name = ?, horsepower = ?, engine_type = ?, engine_capacity = ?, top_speed = ?, price = ?, weight_kg = ? 
             WHERE car_id = ?
         ");
         return $stmt->execute([
             $data['model_name'],
             $data['horsepower'],
             $data['engine_type'],
             $data['engine_capacity'],
             $data['top_speed'],
             $data['price'],
             $data['weight_kg'],
             $car_id
         ]);
     }
 
}
