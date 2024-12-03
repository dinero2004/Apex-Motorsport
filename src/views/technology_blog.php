<!-- icluding the header -->

<?php
require("../templates/header.php");
require("../controller/uploadHandler.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Apex Motorsport: Explore the technology of performance supercars setting new boundaries">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/technology.css">
    <script src="../assets/code/slider.js" defer></script>
    <script src="../assets/code/code.js" defer></script>
    <script src="../assets/code/data_request.js" defer></script>
    <link rel="icon" href="/src/assets/favicon/favicon_package_v0.16/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/src/assets/favicon/favicon_package_v0.16/favicon.ico" type="image/x-icon">
    <title>Car Tech</title>
</head>

<body>


    <!-- hero section -->

    <section class="hero-section">
        <div class="hero">

            <video autoplay muted loop>
                <source src="../assets/images/technology/mp4/Rimac_Nevera.mp4" type="video/mp4"
                    aria-label="Ferrari LaFerrari edit video">
                Your browser does not support the video tag.
            </video>
            <div class="overlay"></div>
            <div class="hero-text">
                <h1>The Newest Technology</h1>
                <div class="sidebar-container"> <button onclick="toggleSidebar()" class="view-more">explore</button>
                </div>
                <div id="sidebar" class="sidebar-content">
                    <p>Discover the future of CarTechnology, with groundbreaking advancements and futuristic features that are revolutionizing the automotive industry. Whether you are a tech enthusiast or just curious about the future of cars, this is the place for you. Explore the innovative technology that is propelling us into a new era, setting new records in speed and performance.
                    </p>
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- rimac nevera section -->
    <div class="tech-container">
        <div class="rimac-content">
            <h2>Rimac Nevera: A Visionary Electric Supercar</h2>
            <p>In the world of supercars, as Ferraris, McLarens, and Lamborghinis reign supreme, The all-electric Rimac
                Nevera is dominating and showing how far the supercars can push the limits of motorsport in the future.
                This
                Croatian masterpiece gets all the attention, because its incredible design, not less atractive than that
                of
                conbustion engine supercars. It's very rare to see one on the road with only 150 units slated for
                production.</p>
            <p>Under its lightweight exterior lies a revolutionary monocoque chassis housing an network of battery
                cells.
                Levels of horsepower reaching up to 1813, are produced by a pair of electric motors at each axle.
                Despite
                its immense power, the Rimac Nevera has an estimated driving range of 205 miles.</p>
            <p>Formula 1 Champion Nico Rosberg is among the esteemed clientele of this e-sportrscar, which is listed at
                a
                staggering $2.2 million. The Rimac Nevera is pure automotive innovation, hinting at even greater feats
                to
                come in the future.</p>
        </div>
        <!-- slider -->
        <div class="slideshow-container">
            <div class="slides fade">
                <img src="../assets/images/technology/jpg/rimac-nevera-front.jpg" loading="lazy"
                    alt="Rimac Nevera front view" srcset="../assets/images/technology/webp/rimac-nevera-front.webp 1x, 
                    ../assets/images/technology/jpg/rimac-nevera-front.jpg 2x" style="width:100%">
            </div>
            <div class="slides fade">
                <img src="../assets/images/technology/jpg/rimac-nevera-rear.jpg" loading="lazy"
                    alt="Rimac Nevera rear view" srcset="../assets/images/technology/webp/rimac-nevera-rear.webp 1x, 
                    ../assets/images/technology/jpg/rimac-nevera-rear.jpg 2x" style="width:100%">
            </div>
            <div class="slides fade">
                <img src="../assets/images/technology/jpg/rimac-nevera-trim.jpg" loading="lazy" alt="Rimac Nevera trim"
                    srcset="../assets/images/technology/webp/rimac-nevera-trim.webp 1x, 
                    ../assets/images/technology/jpg/rimac-nevera-trim.jpg 2x" style="width:100%">
            </div>
            <div class="slides fade">
                <img src="../assets/images/technology/jpg/rimac-nevera-seats.jpg" loading="lazy"
                    alt="Rimac Nevera seats" srcset="../assets/images/technology/webp/rimac-nevera-seats.webp 1x, 
                    ../assets/images/technology/jpg/rimac-nevera-seats.jpg 2x" style="width:100%">
            </div>
            <div class="slides fade">
                <img src="../assets/images/technology/jpg/rimac-nevera-steeringw.jpg" loading="lazy"
                    alt="Rimac Nevera steering wheel" srcset="../assets/images/technology/webp/rimac-nevera-steeringw.webp 1x, 
                    ../assets/images/technology/jpg/rimac-nevera-steeringw.jpg 2x" style="width:100%">
            </div>
            <a class="prev" onclick="plusSlides(-1)">❮</a>
            <a class="next" onclick="plusSlides(1)">❯</a>
            <br>
            <br>
            <button class="pausePlay" onclick="togglePlay()">Pause</button>
        </div>
        <!-- container end -->
    </div>
    <!-- end of rimac nevera section -->

    <!-- upload form -->

    <?= $feedback ?>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="<?= $config_upload['maxFileSize'] ?>">
        <div>
            <label for="myFile">Select File:</label>
            <input type="file" name="myFile" id="myFile">
        </div>
        <div>
            <label for="normalo">Alternative Text:</label>
            <input name="normalo" type="text" id="normalo">
        </div>
        <div>
            <label for="chooser">Target Folder:</label>
            <select id="chooser" name="chooser">
                <option value="../assets/uploads/folder_1">Folder 1</option>
                <option value="../assets/uploads/folder_2">Folder 2</option>
                <option value="../assets/uploads/folder_3">Folder 3</option>
            </select>
        </div>
        <div>
            <button type="submit" name="go">Upload</button>
        </div>
    </form>

</body>
</html>

<!-- include footer -->
<?php
include("../templates/footer.php");
?>