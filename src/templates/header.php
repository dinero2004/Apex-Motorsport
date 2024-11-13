<script src="/src/assets/code/code.js" defer></script>
<header>
    <nav class="navbar">
        <a href="../views/index.php">
            <img height="40px" src="../assets/favicon/svg/Apex-Logo.svg" class="nav-branding"
                alt="Red White Logo of Apex Motorsport">
        </a>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="../views/index.php" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="../views/about.php" class="nav-link">About</a>
            </li>
            <li class="nav-item">
                <a href="../views/car_model.php" class="nav-link">Cars</a>
            </li>
            <li class="nav-item">
                <a href="../views/technology.php" class="nav-link">Car Technology</a>
            </li>
            <li class="nav-item">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="../validation/logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                <?php endif; ?>
            </li>
        </ul>
        <div class="hamburger" aria-label="Mobile Navigation Menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
    </nav>
</header>