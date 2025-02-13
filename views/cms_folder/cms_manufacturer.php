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

// Initialize Database and Controller
$db = new Database();
$dbConnection = $db->connect();
$carController = new ManufacturerController($dbConnection);

$message = ''; 
$errorMessages = []; 

// Fetch all manufacturers for admin view
$manufacturers = $carController->getAllManufacturersForAdmin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';
    $errorMessages = []; // Reset error messages on form submission
    $message = ''; // Reset message on form submission

    try {
        switch ($action) {
            case 'add_manufacturer':
                // Handle manufacturer addition
                $manufacturerData = [
                    'name' => $_POST['name'] ?? '',
                    'country' => $_POST['country'] ?? '',
                ];

                // Validate manufacturer data
                if (empty(trim($manufacturerData['name'])) || empty(trim($manufacturerData['country']))) {
                    throw new Exception("Manufacturer name and country are required.");
                }

                // Add manufacturer data to the database
                $message = $carController->handleManufacturerFormSubmission($manufacturerData);
                break;

            case 'delete_manufacturer':
                // Handle manufacturer deletion
                $manufacturerId = $_POST['manufacturer_id'] ?? '';
                if (empty(trim($manufacturerId))) {
                    throw new Exception("Manufacturer ID is required for deletion.");
                }

                // Call delete manufacturer method
                $message = $carController->deleteManufacturer($manufacturerId);
                break;

            default:
                throw new Exception("Unknown action.");
        }
    } catch (Exception $e) {
        $errorMessages[] = $e->getMessage();
    }
}

// Display error messages
if (!empty($errorMessages)) {
    foreach ($errorMessages as $error) {
        echo "<p style='color: red;'>$error</p>";
    }
}

// Display success message
if (!empty($message)) {
    echo "<p style='color: green;'>$message</p>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Manufacturers</title>
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
    <button id="showForm">Add Manufacturer</button>
    <button id="showTable">Edit Table</button>
</div>

<!-- Add Manufacturer Form -->
<h1>Manage Manufacturers</h1>
<div id="addForm" class="form-container active">
    <form method="POST" action="" class="form">
        <input type="hidden" name="action" value="add_manufacturer">
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="Enter Manufacturer Name" required><br>
        
        <label for="country">Country:</label>
        <input type="text" id="country" name="country" placeholder="Enter Country of Origin" required><br>
        
        <button type="submit" class="button">Add Manufacturer</button>
    </form>
</div>

<!-- Edit Manufacturer Table -->
<div id="editTable" class="form-container">
    <h2>Existing Manufacturers</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Country</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($manufacturers as $manufacturer): ?>
                <tr>
                    <td><?= htmlspecialchars($manufacturer['name']) ?></td>
                    <td><?= htmlspecialchars($manufacturer['country']) ?></td>
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="action" value="delete_manufacturer">
                            <input type="hidden" name="manufacturer_id" value="<?= htmlspecialchars($manufacturer['manufacturer_id']) ?>">
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this manufacturer?')" class="button">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
