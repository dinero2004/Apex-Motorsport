<!DOCTYPE html>
<html lang="en">

<?php
include("../templates/header.php");
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/contact.css">
    <link rel="stylesheet" href="../assets/css/typography.css">
    <script src="code/code.js" defer></script>
    <script src="code/contact.js" defer></script>
    <meta name="description" content="Apex Motorsport: Showroom for sports cars with incredible performance.">
    <link rel="icon" href="assets/favicon/favicon_package_v0.16/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="assets/favicon/favicon_package_v0.16/favicon.ico" type="image/x-icon">

    <title>Contact</title>
</head>
<body>
    <main>
        
        <!-- hero section -->

        <h1>Contact</h1>
        <div class="form-container carbon">
            <section class="glass">
                <form id="contact-form">
                    <h2>Please fill this form to send us a message</h2>
                    <div class="radio-group">
                        <label>
                            <input type="radio" name="title" value="mrs"> Mr.
                        </label>
                        <label>
                            <input type="radio" name="title" value="ms"> Mrs.
                        </label>
                        <span class="error"></span>
                    </div>

                    <div class="first-name">
                        <label for="first-name">First name</label>
                        <input type="text" id="first-name">
                        <span class="error"></span>
                    </div>
                    <div class="last-name">
                        <label for="last-name">Last name</label>
                        <input type="text" id="last-name">
                        <span class="error"></span>
                    </div>

                    <div class="email">
                        <label for="email">E-Mail</label>
                        <input type="email" id="email">
                        <span class="error"></span>
                    </div>

                    <div class="address">
                        <label for="address">Address</label>
                        <input type="text" id="address">
                        <span class="error"></span>
                    </div>

                    <div class="postcode">
                        <label for="postcode">Postcode</label>
                        <input type="text" id="postcode">
                        <span class="error"></span>
                    </div>

                    <div class="city">
                        <label for="city">City</label>
                        <input type="text" id="city">
                        <span class="error"></span>
                    </div>

                    <div class="message">
                        <label for="message">Message</label>
                        <textarea id="message"></textarea>
                        <span class="error"></span>
                    </div>

                    <button>Submit</button>
                </form>
            </section>
        </div>
    </main>
   
<?php
include("../templates/footer.php");
?>
</body>
</html>