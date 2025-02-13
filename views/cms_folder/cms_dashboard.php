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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Template</title>
    <link rel="stylesheet" href="../../assets/css/cms_dashboard.css">
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
    <main>
        <div class="content">
            <h1>Welcome to the Apex Motorsport Admin</h1>
            <p>Select an option from the menu to get started.</p>

            <h3>Manage Car Models</h3>
            <ul>
                <li><strong>Add a New Car Model:</strong>
                    <p>Fill out the form and upload images for the new car model.</p>
                </li>
                <li><strong>Edit Existing Car Models:</strong>
                    <p>Navigate to the table, click "Edit" on the model, update the fields, and click "Save" to apply
                        the changes.</p>
                </li>
                <li><strong>Search for a Specific Model:</strong>
                    <p>Use the search bar to quickly find a specific car model.</p>
                </li>
                <li><strong>Delete a Car Model:</strong>
                    <p>Click the "Delete" button next to the model to remove it from the system.</p>
                </li>
            </ul>
            <h3>Manage Manufacturers</h3>
            <ul>
                <li><strong>Add a New Manufacturer:</strong>
                    <p>Provide the name and country of the manufacturer to add them to the system.</p>
                </li>
                <li><strong>View Manufacturers:</strong>
                    <p>In the table, you can see all the manufacturers listed.</p>
                </li>
                <li><strong>Delete a Manufacturer:</strong>
                    <p>Click the "Delete" button next to the manufacturer to remove them from the system.</p>
                </li>
            </ul>
          <h3>Edit Users</h3>
            <ul>
                <li><strong>Change User Rights:</strong>
                    <p>From the third menu, you can modify user roles and grant admin rights. Admin users have full
                        access to the content management system.</p>
                </li>
                <li><strong>Delete a User:</strong>
                    <p>You can remove a user from the system by clicking the "Delete" button next to their profile.</p>
                </li>
            </ul>
        </div><br>
        <div class="content">
            <p>Go back to Apex Motorsport Home page</p>
            <button><a href="../index.php">Back</a></button>
        </div>

    </main>
</body>

</html>