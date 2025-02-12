<?php
require_once __DIR__ . '/../Model/ManufacturerModel.php';

class ManufacturerController {

    private $manufacturerModel;
    private $errorMessages = [];

    public function __construct($db)
    {
        $this->manufacturerModel = new ManufacturerList($db);
    }

    public function getManufacturerNameById(){
        $this->manufacturerModel->getAllManufacturers();
    }


    public function validateManufacturerInput($data)
    {
        $valid = true;

        // Validate Manufacturer Name
        if (empty($data['name'])) {
            $this->errorMessages['name'] = 'Manufacturer name is required.';
            $valid = false;
        }

        // Validate Country
        if (empty($data['country'])) {
            $this->errorMessages['country'] = 'Country is required.';
            $valid = false;
        }

        return $valid;
    }

    private function sanitizeFolderName($name)
    {
        // Replace any special characters with underscores
        return preg_replace('/[^a-zA-Z0-9_\-]/', '_', $name);
    }

    private function ensureDirectoryExists($dir)
    {
        if (!is_dir($dir) && !mkdir($dir, 0755, true)) {
            throw new Exception("Failed to create directory: $dir");
        }
    }
    public function createManufacturerFolder($manufacturerName)
    {
        // Define the base directory
        $baseDir = __DIR__ . '/../assets/images/cars/manufacturers';
        $sanitizedFolderName = $this->sanitizeFolderName($manufacturerName);
        $manufacturerDir = $baseDir . '/' . $sanitizedFolderName;
    
        // Ensure the manufacturer folder exists or create it
        if (!is_dir($manufacturerDir)) {
            if (!mkdir($manufacturerDir, 0755, true)) {
                throw new Exception("Failed to create directory for manufacturer: $manufacturerName");
            }
    
            // Optional: Create the 'models' subfolder
            $modelsSubDir = $manufacturerDir . '/models';
            if (!mkdir($modelsSubDir, 0755, true)) {
                throw new Exception("Failed to create 'models' subfolder in manufacturer directory: $manufacturerName");
            }
    
            // Optional: Log or return success message
            echo "Manufacturer folder with 'models' subfolder created successfully: $modelsSubDir";
        }
    
        return $manufacturerDir;
    }    



    // Method to handle manufacturer form submission
    public function handleManufacturerFormSubmission($data)
    {
        // Step 1: Validate Input
        $valid = $this->validateManufacturerInput($data);

        if (!$valid) {
            return $this->errorMessages; // Return validation errors
        }

        // Step 2: Check if Manufacturer Exists
        if ($this->manufacturerModel->checkManufacturerExists($data['name'])) {
            $this->errorMessages['name'] = 'This manufacturer already exists.';
            return $this->errorMessages;
        }

        // Step 3: Insert Manufacturer
        $result = $this->manufacturerModel->insertNewManufacturer($data);
        if (!$result) {
            return 'An error occurred while adding the manufacturer.';
        }

        // Step 4: Create Manufacturer Folder
        try {
            $this->createManufacturerFolder($data['name']);
            return 'Manufacturer added successfully! Folder created successfully.';
        } catch (Exception $e) {
            // Log the error for debugging
            error_log('Folder creation failed: ' . $e->getMessage());
            return 'Manufacturer added successfully, but folder creation failed: ' . $e->getMessage();
        }
    }

    public function getAllManufacturersForAdmin()
    {
        return $this->manufacturerModel->getAllManufacturers();
    }

     // Delete Manufacturer
     public function deleteManufacturer($manufacturerId)
     {
         return $this->manufacturerModel->deleteManufacturerById($manufacturerId); // Assuming $this->model is the instance of your Manufacturer model
     }
}