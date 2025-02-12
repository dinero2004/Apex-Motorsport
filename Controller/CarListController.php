<?php
// method for the cms cars functionality

require_once __DIR__ . '/../Model/CarListModel.php';
require_once('../../Controller/ManufacturerController.php');

class CarListController
{
    private $carModel;
    private $fileManager;
    private $errorMessages = [];

    public function __construct($db)
    {
        $this->carModel = new CarList($db);
    }

    // Method to validate the input data
       // Method to validate the input data
       public function validateInput($data)
       {
           $valid = true;
   
           // Validation rules
           $fields = [
               'manufacturer_id' => 'Manufacturer is required.',
               'model_name' => 'Model name is required.',
               'horsepower' => 'Horsepower must be a numeric value.',
               'engine_type' => 'Engine type is required.',
               'engine_capacity' => 'Engine capacity should be a valid number (e.g., 5.2).',
               'top_speed' => 'Top speed must be a numeric value.',
               'price' => 'Price must be a valid).',
               'weight_kg' => 'Weight must be a numeric value.'
           ];
   
           foreach ($fields as $field => $errorMessage) {
               if (empty($data[$field]) || ($field !== 'engine_type' && !is_numeric($data[$field]) && $field !== 'price')) {
                   $this->errorMessages[$field] = $errorMessage;
                   $valid = false;
               }
           }
   
           if (!empty($data['price']) && !preg_match('/^\d+(\.\d{2})?$/', $data['price'])) {
               $this->errorMessages['price'] = 'Price must be a valid number (e.g., 400000.00).';
               $valid = false;
           }
   
           return $valid;
       }
    
    // Get all cars for admin
    public function getAllCarsForAdmin()
    {
        return $this->carModel->getAllCars();
    }

    // Delete Car
    public function deleteCar($carId)
    {
        return $this->carModel->deleteCarById($carId);
    }

    // Update Car
    public function updateCar($carId, $data)
    {
        $result = $this->carModel->updateCarModel($carId, $data);
        if ($result) {
            return "Car updated successfully.";
        } else {
            throw new Exception("Failed to update car.");
        }
    }
}