<?php

class CarsModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getManufacturers()
    {
        $query = "SELECT manufacturer_id, name FROM Manufacturers";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getModelsByManufacturer($manufacturer_id)
    {
        $query = "SELECT car_id, model_name FROM Cars WHERE manufacturer_id = :manufacturer_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':manufacturer_id', $manufacturer_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCarSpecs($car_id)
    {
        $query = "SELECT C.model_name, C.horsepower, C.engine_type, C.engine_capacity, 
                         C.top_speed, C.price, C.weight_kg, M.name AS manufacturer_name
                  FROM Cars C
                  JOIN Manufacturers M ON C.manufacturer_id = M.manufacturer_id
                  WHERE C.car_id = :car_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':car_id', $car_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
