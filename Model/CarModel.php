<?php 
require('Database.php');

    $db_class = new Database();

    // Call the connect method to establish a connection
    $db = $db_class->connect();
    
    // Fetch manufacturers using PDO
    $query_manufacturers = "SELECT manufacturer_id, name FROM Manufacturers";
    $stmt_manufacturers = $db->query($query_manufacturers); // Execute the query
?> 
 
 <!-- Car Model Selection -->
 <h2>Choose Car Model</h2>

<!-- Manufacturer Selection Form -->
<form action="" method="post">
    <label for="manufacturer">Select Manufacturer:</label>
    <select id="manufacturer" name="manufacturer_id" onchange="this.form.submit()">
        <option value="">--Select Manufacturer--</option>
        <?php
        // Fetch manufacturers from the database
        $stmt_manufacturers = $db->query("SELECT manufacturer_id, name FROM Manufacturers");
        while ($manufacturer = $stmt_manufacturers->fetch(PDO::FETCH_ASSOC)) {
            // Preserve the selected manufacturer after form submission
            $selected = isset($_POST['manufacturer_id']) && $_POST['manufacturer_id'] == $manufacturer['manufacturer_id'] ? 'selected' : '';
            echo "<option value='" . htmlspecialchars($manufacturer['manufacturer_id']) . "' $selected>" . htmlspecialchars($manufacturer['name']) . "</option>";
        }
        ?>
    </select>
</form>

<?php
// Check if a manufacturer is selected
if (isset($_POST['manufacturer_id']) && !empty($_POST['manufacturer_id'])) {
    $manufacturer_id = $_POST['manufacturer_id'];

    // Fetch models for the selected manufacturer
    $query_models = "SELECT car_id, model_name FROM Cars WHERE manufacturer_id = :manufacturer_id";
    $stmt_models = $db->prepare($query_models);
    $stmt_models->bindParam(':manufacturer_id', $manufacturer_id, PDO::PARAM_INT);
    $stmt_models->execute();
    ?>

    <!-- Model Selection Form -->
    <form action="" method="post">
        <input type="hidden" name="manufacturer_id" value="<?php echo htmlspecialchars($manufacturer_id); ?>" />
        <label for="model">Select Model:</label>
        <select id="model" name="model_id" onchange="this.form.submit()">
            <option value="">--Select Model--</option>
            <?php
            // Populate model dropdown
            while ($model = $stmt_models->fetch(PDO::FETCH_ASSOC)) {
                // Preserve the selected model after form submission
                $selected = isset($_POST['model_id']) && $_POST['model_id'] == $model['car_id'] ? 'selected' : '';
                echo "<option value='" . htmlspecialchars($model['car_id']) . "' $selected>" . htmlspecialchars($model['model_name']) . "</option>";
            }
            ?>
        </select>
    </form>

    <!--  Car Model logic -->

    <?php

    // Check if a model is selected to display specs
    if (isset($_POST['model_id']) && !empty($_POST['model_id'])) {
        $model_id = $_POST['model_id'];

        // Fetch specs directly from the Cars table for the selected model
        $query_specs = "SELECT C.model_name, C.horsepower, C.engine_type, C.engine_capacity, 
                    C.top_speed, C.price, C.weight_kg, M.name AS manufacturer_name 
                FROM Cars C 
                JOIN Manufacturers M ON C.manufacturer_id = M.manufacturer_id 
                WHERE C.car_id = :model_id";
        $stmt_specs = $db->prepare($query_specs);
        $stmt_specs->bindParam(':model_id', $model_id, PDO::PARAM_INT);
        $stmt_specs->execute();

        // Fetch the row as an associative array
        $car_specs = $stmt_specs->fetch(PDO::FETCH_ASSOC);

        // Check if data was found
        if ($car_specs) {
            $manufacturerName = htmlspecialchars($car_specs['manufacturer_name']);
            $modelName = htmlspecialchars($car_specs['model_name']);

            // Update the images folder path to use the manufacturer's name


            $imagesFolder = "../assets/images/cars/manufacturers/{$manufacturerName}/models/{$modelName}/";

            // Debugging: Display the constructed file path
            //Uncomment the following code for debugging purposes to reveal the images directory
            // echo "<p>Looking for images in: " . htmlspecialchars($imagesFolder) . "</p>";

            echo "<div class='car-section'>"; // Wrapper for both specs and images

            // Display the specs
            echo "<div class='specs-container'>";
            echo "<h3>Specifications for " . htmlspecialchars($car_specs['model_name']) . "</h3>";
            echo "<ul class='specs'>";
            echo "<li>Model" . htmlspecialchars($car_specs['model_name']) . "</li>";
            echo "<li>Horsepower " . htmlspecialchars($car_specs['horsepower']) . " HP</li>";
            echo "<li>Engine Type " . htmlspecialchars($car_specs['engine_type']) . "</li>";
            echo "<li>Engine Capacity " . htmlspecialchars($car_specs['engine_capacity']) . " L</li>";
            echo "<li>Top Speed " . htmlspecialchars($car_specs['top_speed']) . " km/h</li>";
            echo "<li>Price $ " . number_format($car_specs['price'], 2) . "</li>";
            echo "<li>Weight " . htmlspecialchars($car_specs['weight_kg']) . " kg</li>";
            echo "</ul>";
            echo "</div>";

            // Check if the directory exists and display images
            if (is_dir($imagesFolder)) {
                $images = glob($imagesFolder . "*.jpg");
                if ($images) {
                    echo "<div class='image-gallery-container'>";
                    echo "<h3>Image Gallery for " . htmlspecialchars($modelName) . "</h3>";
                    echo "<div class='images'>";

                    foreach ($images as $image) {
                        $imageUrl = htmlspecialchars($image);
                        $imageAlt = "Image of " . htmlspecialchars($modelName);
                        echo "<div class='car-image-item'>";
                        echo "<img src='$imageUrl' alt='$imageAlt' class='gallery-image'>";
                        echo "</div>";
                    }

                    echo "</div>";
                    echo "</div>";

                    // Modal HTML
                    echo "
            <div class='image-modal'>
                <span class='close'>&times;</span>
                <img class='modal-content modal-image'>
                <div class='modal-caption'></div>
            </div>";
                } else {
                    echo "<p>No images available for this model.</p>";
                }
            } else {
                echo "<p>Image folder not found for this model.</p>";
            }
        }
    }
}
