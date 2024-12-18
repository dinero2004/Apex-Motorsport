<?php
include("../templates/header.php");

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

   <?php
require("../Model/CarModel.php");
     ?>
   
   <?php
    include("../templates/footer.php");
    ?>