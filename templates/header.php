<?php 
session_start();

?>
<header>
    <nav class="navbar">
        <a href="../views/index.php">
            <img height="40px" src="../assets/favicon/svg/Apex-Logo.svg" class="nav-branding"
                alt="Red White Logo of Apex Motorsport">
        </a>
        <button class="hamburger" aria-label="Navigation Menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
    </nav>

    <!-- Fullscreen dropdown content -->
    <div class="dropdown-mask" id="dropdown">
        <div class="links-container">
            <a href="../views/index.php" data-image="image1">Home</a>
            <a href="../views/about.php" data-image="image2">About</a>
            <a href="../views/cars.php" data-image="image3">Cars</a>
            <a href="../views/technology.php" data-image="image4">Tech</a>

            <!-- Reviews link visible only if the user is logged in -->
            <?php if (isset($_SESSION['auth_status'])): ?>
                <a href="../views/reviews.php" data-image="image5">Reviews</a>
                <a href="../Controller/logout.php" data-image="image5">Logout</a>
            <?php else: ?>
                <a href="../views/login.php" data-image="image6">Sign In</a>
            <?php endif; ?>
        </div>
        <div class="image-container">
            <img src="../assets/images/cars/manufacturers/ferrari/models/488 Pista/2019-ferrari-488-pista-103-1528476282.jpg" id="image1" alt="Image 1" class="active">
            <img src="../assets/images/about-images/png/lm-ferrari.png" alt="About" id="image2">
            <img src="../assets/images/cars/manufacturers/Lamborghini/models/Aventador S/2018-lamborghini-aventador-s-roadster-101-1524083700.jpg" alt="Cars" id="image3">
            <img src="../assets/images/technology/jpg/rimac-nevera-front.jpg" alt="Technology" id="image4">
            <img src="../assets/images/cars/manufacturers/McLaren/models/P1/2014-mclaren-p1-photo-617370-s-986x603.jpg" alt="Reviews" id="image5">
            <img src="../assets/images/cars/manufacturers/Porsche/models/911 Turbo S/2021-porsche-911-turbo-s-pdk-107-edit-1608061336.jpg" alt="Reviews" id="image6">
        </div>
    </div>
</header>
