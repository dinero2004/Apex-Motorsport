<?php

session_start();

// Check if user is logged in and has admin privileges
$isLoggedIn = isset($_SESSION['auth_status']) && $_SESSION['auth_status'] === true;
$isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;

// Redirect non-logged-in or non-admin users
if (!$isLoggedIn || !$isAdmin) {
    header("Location: ../../views/login.php"); // Redirect to login page
    exit();
}

require_once('../../Controller/UserController.php');

require_once('../../Controller/ManufacturerController.php');
require_once('../../Controller/CarListController.php');


// Initialize variables
$db = new Database();
$dbConnection = $db->connect();
$carController = new CarListController($dbConnection);
$manufacturers = [];

$cars = $carController->getAllCarsForAdmin();

$manufacturersManager = new ManufacturerController($db);
$manufacturers = $manufacturersManager->getManufacturerNameById() ?? [];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car and Manufacturer Management</title>
    <link rel="stylesheet" href="../../assets/css/cms_template.css">
    <link rel="stylesheet" href="../../assets/css/cms_dashboard.css">
    <script src="../../assets/code/cms_template.js" defer></script>
</head>

<body>
    <nav class="top-navigation">
        <div class="nav-branding">
            <h2>CMS Menu</h2>
        </div>
        <ul class="nav-links">
            <li><a href="cms_dashboard.php">Dashboard</a></li>
            <li><a href="cms_cars.php">Cars</a></li>
            <li><a href="cms_manufacturer.php">Manufacturer</a></li>
            <li><a href="cms_users.php">Users</a></li>
        </ul>
    </nav>

    <!-- Toggle Menu -->
    <div class="toggle-menu">
        <button class="button" id="showForm">Add Car</button>
        <button class="button" id="showTable">Edit Table</button>
    </div>

    <!-- Add Car Form -->
    <h1>Manage Cars</h1>
    <div id="addForm" class="form-container active">
        <form method="POST" action="" enctype="multipart/form-data" class="form">
            <input type="hidden" name="action" value="add_car">
            
            <label for="manufacturer_id">Manufacturer:</label>
            <select id="manufacturer_id" name="manufacturer_id" required>
                <option value="">--Select Manufacturer--</option>
                <?php foreach ($manufacturers as $manufacturer): ?>
                    <option value="<?= htmlspecialchars($manufacturer['manufacturer_id']) ?>">
                        <?= htmlspecialchars($manufacturer['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select><br>

            <label for="model_name">Model Name:</label>
            <input type="text" id="model_name" name="model_name" required><br>

            <label for="horsepower">Horsepower:</label>
            <input type="number" id="horsepower" name="horsepower" required><br>

            <label for="engine_type">Engine Type:</label>
            <input type="text" id="engine_type" name="engine_type" required><br>

            <label for="engine_capacity">Engine Capacity:</label>
            <input type="text" id="engine_capacity" name="engine_capacity" required><br>

            <label for="top_speed">Top Speed (km/h):</label>
            <input type="number" id="top_speed" name="top_speed" required><br>

            <label for="price">Price ($):</label>
            <input type="text" id="price" name="price" required><br>

            <label for="weight_kg">Weight (kg):</label>
            <input type="number" id="weight_kg" name="weight_kg" required><br>

            <label for="files">Upload Images:</label>
            <input type="file" name="images[]" id="fileInput" multiple accept="image/*"><br>
            <div class="image-preview" id="imagePreview"></div>
            
            <button class="button" type="submit">Add Car</button>
        </form>
    </div>

    <!-- Edit Table -->
    <div id="editTable" class="form-container">
        <input type="text" id="searchBar" placeholder="Search for model name">
        <table id="modelTable">
            <thead>
                <tr>
                    <th>Car ID</th>
                    <th>Model Name</th>
                    <th>Horsepower</th>
                    <th>Engine Type</th>
                    <th>Engine Capacity</th>
                    <th>Top Speed</th>
                    <th>Price</th>
                    <th>Weight</th>
                    <th>Manufacturer</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($cars) && is_array($cars)): ?>
                    <?php foreach ($cars as $car): ?>
                        <tr>
                            <td><?= htmlspecialchars($car['car_id']) ?></td>
                            <td data-editable data-field="model_name"><?= htmlspecialchars($car['model_name']) ?></td>
                            <td data-editable data-field="horsepower"><?= htmlspecialchars($car['horsepower']) ?></td>
                            <td data-editable data-field="engine_type"><?= htmlspecialchars($car['engine_type']) ?></td>
                            <td data-editable data-field="engine_capacity"><?= htmlspecialchars($car['engine_capacity']) ?></td>
                            <td data-editable data-field="top_speed"><?= htmlspecialchars($car['top_speed']) ?></td>
                            <td data-editable data-field="price"><?= htmlspecialchars($car['price']) ?></td>
                            <td data-editable data-field="weight_kg"><?= htmlspecialchars($car['weight_kg']) ?></td>
                            <td><?= htmlspecialchars($car['manufacturer_name'] ?? 'Unknown') ?></td>
                            <td>
                                <button class="button" type="button" onclick="enableRowEditing(this, <?= $car['car_id'] ?>)">Edit</button>
                                <form method="POST" action="">
                                    <input type="hidden" name="action" value="delete_car">
                                    <input type="hidden" name="car_id" value="<?= $car['car_id'] ?>">
                                    <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete this car?')" class="button">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="10">No cars available.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
