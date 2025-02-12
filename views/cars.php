<?php
require("../templates/header.php");
require('../Controller/CarsController.php');

// Initialize the controller
$carsController = new CarsController();

// Process user selections
$manufacturer_id = $_POST['manufacturer_id'] ?? null;
$car_id = $_POST['car_id'] ?? null;

// Fetch data through the controller
$manufacturers = $carsController->getManufacturers();
$models = $manufacturer_id ? $carsController->getModels($manufacturer_id) : [];
$car_specs = $car_id ? $carsController->getCarDetails($car_id) : null;
// Fetch the row as an associative array
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Apex Motorsport: learn more about your favorite sports cars and their characteristics">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/cars.css">
    <script src="../assets/code/code.js" defer></script>
    <script src="../assets/code/cars.js" defer></script>
    <link rel="icon" href="../assets/favicon/favicon_package_v0.16/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/favicon/favicon_package_v0.16/favicon.ico" type="image/x-icon">
    <title>Cars</title>
    <style>

    </style>
</head>

<body>
    <main>
        <!-- Hero Section -->
        <div class="hero-content">
            <div class="hero">
                <video autoplay muted loop>
                    <source src="../assets/images/cars-images/mp4/Lamborghini_Aventador_SVJ.mp4" type="video/mp4"
                        aria-label="Ferrari LaFerrari edit video">
                    Your browser does not support the video tag.
                </video>
                <h1>The Car Models</h1>
                <div class="sidebar-container">
                    <button onclick="toggleSidebar()" class="view-more">Explore</button>
                </div>
                <div id="sidebar" class="sidebar-content">
                    <p>
                        Start your journey with extraordinary automobiles. The careful selection of each vehicle
                        will elevate your experience. Whether you're into cars or just curious about auto craftsmanship,
                        Apex invites you to discover the intricate details, specifications, and tales behind each
                        vehicle. We're committed to providing a presentation where performance meets perfection.
                    </p>
                </div>
            </div>
        </div>

        <div class="nissan-racetrack">
            <small>The Nissan GTR Nismo</small>
            <img class="nissan-rear" src="../assets/images/cars-images/webp/nissan-gtr-rear.webp"
                alt="Nissan GTR rushing on the racetrack" loading="lazy">
        </div>
    </main>
     
<h2>Choose Car Model</h2>

<!-- Manufacturer Selection Form -->
<form action="" method="post">
    <label for="manufacturer">Select Manufacturer:</label>
    <select id="manufacturer" name="manufacturer_id" onchange="this.form.submit()">
        <option value="">--Select Manufacturer--</option>
        <?php foreach ($manufacturers as $manufacturer): ?>
            <?php $selected = ($manufacturer_id == $manufacturer['manufacturer_id']) ? 'selected' : ''; ?>
            <option value="<?= htmlspecialchars($manufacturer['manufacturer_id']) ?>" <?= $selected ?>>
                <?= htmlspecialchars($manufacturer['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

<?php if (!empty($models)): ?>
    <!-- Model Selection Form -->
    <form action="" method="post">
        <input type="hidden" name="manufacturer_id" value="<?= htmlspecialchars($manufacturer_id) ?>" />
        <label for="model">Select Model:</label>
        <select id="model" name="car_id" onchange="this.form.submit()">
            <option value="">--Select Model--</option>
            <?php foreach ($models as $model): ?>
                <?php $selected = ($car_id == $model['car_id']) ? 'selected' : ''; ?>
                <option value="<?= htmlspecialchars($model['car_id']) ?>" <?= $selected ?>>
                    <?= htmlspecialchars($model['model_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>
<?php endif; ?>

<?php if ($car_specs): ?>
    <?php
    $manufacturerName = htmlspecialchars($car_specs['manufacturer_name']);
    $modelName = htmlspecialchars($car_specs['model_name']);
    $imagesFolder = "../assets/images/cars/manufacturers/{$manufacturerName}/models/{$modelName}/";
    ?>

    <div class="car-section">
        <!-- Display Specifications -->
        <div class="specs-container">
            <h3>Specifications for <?= htmlspecialchars($modelName) ?></h3>
            <ul class="specs">
                <li>Model: <?= htmlspecialchars($modelName) ?></li>
                <li>Horsepower: <?= htmlspecialchars($car_specs['horsepower']) ?> HP</li>
                <li>Engine Type: <?= htmlspecialchars($car_specs['engine_type']) ?></li>
                <li>Engine Capacity: <?= htmlspecialchars($car_specs['engine_capacity']) ?> L</li>
                <li>Top Speed: <?= htmlspecialchars($car_specs['top_speed']) ?> km/h</li>
                <li>Price: $<?= number_format($car_specs['price'], 2) ?></li>
                <li>Weight: <?= htmlspecialchars($car_specs['weight_kg']) ?> kg</li>
            </ul>
        </div>

        <!-- Check for Image Folder -->
        <?php if (is_dir($imagesFolder)): ?>
            <?php $images = glob($imagesFolder . "*.jpg"); ?>
            <?php if ($images): ?>
                <div class="image-gallery-container">
                    <h3>Image Gallery for <?= htmlspecialchars($modelName) ?></h3>
                    <div class="images">
                        <?php foreach ($images as $image): ?>
                            <div class="car-image-item">
                                <img src="<?= htmlspecialchars($image) ?>" alt="Image of <?= htmlspecialchars($modelName) ?>" class="gallery-image">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Modal HTML -->
                <div class="image-modal">
                    <span class="close">&times;</span>
                    <img class="modal-content modal-image">
                    <div class="modal-caption"></div>
                </div>
            <?php else: ?>
                <p>No images available for this model.</p>
            <?php endif; ?>
        <?php else: ?>
            <p>Image folder not found for this model.</p>
        <?php endif; ?>
    </div>
<?php else: ?>
    <p>No specifications available for the selected model.</p>
<?php endif; ?>


<?php
    include("../templates/footer.php");
?>