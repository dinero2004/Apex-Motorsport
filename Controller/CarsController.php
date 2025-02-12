<?php
// method for fetching models on the cars page 

require('../Model/Database.php');
require('../Model/CarsModel.php');

class CarsController
{
    private $carsModel;

    public function __construct()
    {
        $db_class = new Database();
        $db = $db_class->connect();
        $this->carsModel = new CarsModel($db);
    }

    public function getManufacturers()
    {
        return $this->carsModel->getManufacturers();
    }

    public function getModels($manufacturer_id)
    {
        return $this->carsModel->getModelsByManufacturer($manufacturer_id);
    }

    public function getCarDetails($car_id)
    {
        return $this->carsModel->getCarSpecs($car_id);
    }
}
