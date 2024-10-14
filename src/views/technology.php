<!-- icluding the header -->

<?php
include("../templates/header.php");
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

    <section>
        <h1>The Newest Technology</h1>
        <img class="hero-image" src="../assets/images/technology/jpg/rimac-nevera-hero.jpg"
            alt="Rimac Nevera on the road" loading="lazy"
            srcset="../assets/images/technology/webp/rimac-nevera-hero.webp 1x, ../assets/images/technology/jpg/rimac-nevera-hero.jpg 2x"
            type="image/webp" />

        <div class="accordion discover-section">
            <div class="accordion-item">
                <h2 class="accordion-header">Car Technology</h2>
                <div class="accordion-content">
                    <p>Step into the future at CarTech Hub, where innovation meets the open road. We're not just talking
                        about one thing. We're looking into the future of car tech that's changing not just how we
                        drive, but how we live.</p>
                    <p>Discover the latest advancements, futuristic features, and more at CarTech Hub. There are
                        game-changing technologies in the automotive industry. It doesn't matter if you're into tech or
                        not. You've found your digital home if you're a driver or just curious about the future of cars.
                    </p>
                    <p>Explore the technology that is helping us move forward. The milestone of automotive innovation
                        that is setting new records and breaking the limits of speed and performance.</p>
                </div>
                <button class="view-more view-more-dark">View More</button>
            </div>
        </div>

    </section>

    <!-- rimac nevera section -->

    <div class="rimac-content">
        <h2>Rimac Nevera: A Visionary Electric Supercar</h2>
        <p>In the world of supercars, as Ferraris, McLarens, and Lamborghinis reign supreme, The all-electric Rimac
            Nevera is dominating and showing how far the supercars can push the limits of motorsport in the future. This
            Croatian masterpiece gets all the attention, because its incredible design, not less atractive than that of
            conbustion engine supercars. It's very rare to see one on the road with only 150 units slated for
            production.</p>
        <p>Under its lightweight exterior lies a revolutionary monocoque chassis housing an network of battery cells.
            Levels of horsepower reaching up to 1813, are produced by a pair of electric motors at each axle. Despite
            its immense power, the Rimac Nevera has an estimated driving range of 205 miles.</p>
        <p>Formula 1 Champion Nico Rosberg is among the esteemed clientele of this e-sportrscar, which is listed at a
            staggering $2.2 million. The Rimac Nevera is pure automotive innovation, hinting at even greater feats to
            come in the future.</p>
    </div>

    <!-- slider -->
    <div class="slideshow-container">
    <div class="slides fade">
        <img 
            src="../assets/images/technology/jpg/rimac-nevera-front.jpg" 
            loading="lazy" 
            alt="Rimac Nevera front view" 
            srcset="../assets/images/technology/webp/rimac-nevera-front.webp 1x, 
                    ../assets/images/technology/jpg/rimac-nevera-front.jpg 2x" 
            style="width:100%"
        >
    </div>
    <div class="slides fade">
        <img 
            src="../assets/images/technology/jpg/rimac-nevera-rear.jpg" 
            loading="lazy" 
            alt="Rimac Nevera rear view" 
            srcset="../assets/images/technology/webp/rimac-nevera-rear.webp 1x, 
                    ../assets/images/technology/jpg/rimac-nevera-rear.jpg 2x" 
            style="width:100%"
        >
    </div>
    <div class="slides fade">
        <img 
            src="../assets/images/technology/jpg/rimac-nevera-trim.jpg" 
            loading="lazy" 
            alt="Rimac Nevera trim" 
            srcset="../assets/images/technology/webp/rimac-nevera-trim.webp 1x, 
                    ../assets/images/technology/jpg/rimac-nevera-trim.jpg 2x" 
            style="width:100%"
        >
    </div>
    <div class="slides fade">
        <img 
            src="../assets/images/technology/jpg/rimac-nevera-seats.jpg" 
            loading="lazy" 
            alt="Rimac Nevera seats" 
            srcset="../assets/images/technology/webp/rimac-nevera-seats.webp 1x, 
                    ../assets/images/technology/jpg/rimac-nevera-seats.jpg 2x" 
            style="width:100%"
        >
    </div>
    <div class="slides fade">
        <img 
            src="../assets/images/technology/jpg/rimac-nevera-steeringw.jpg" 
            loading="lazy" 
            alt="Rimac Nevera steering wheel" 
            srcset="../assets/images/technology/webp/rimac-nevera-steeringw.webp 1x, 
                    ../assets/images/technology/jpg/rimac-nevera-steeringw.jpg 2x" 
            style="width:100%"
        >
    </div>
    <a class="prev" onclick="plusSlides(-1)">❮</a>
    <a class="next" onclick="plusSlides(1)">❯</a>
    <br>
    <br>
    <button class="pausePlay" onclick="togglePlay()">Pause</button>
</div>

    <!-- JSON Data Container -->
    <div id="json-data-container" class="json-data-container">
        <h2>Car Technology News</h2>
        <div id="blog-container" class="blog-container"></div>
    </div>


</body>

</html>

<!-- include footer -->
<?php
include("../templates/footer.php");
?>