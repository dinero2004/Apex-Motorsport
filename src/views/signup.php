<?php 
include("../validation/signup_valid.php");
include("../templates/header.php");

?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/sign.css">
    <script src="../assets/code/code.js"></script>
    <script src="../assets/code/login.js"></script>
    <link rel="icon" href="/src/assets/favicon/favicon_package_v0.16/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/src/assets/favicon/favicon_package_v0.16/favicon.ico" type="image/x-icon">
    <title>Register</title>
    <style>
        .error { color: red; font-size: 0.9em; 
            font-size: 12px;
            padding: 10px;}
        .valid { color: green; font-size: 0.9em; }
    </style>
</head>
<body>

    <main>
        <h1>Register Form</h1>
        <?php if (!empty($errors)): ?>
        <div>
            <?php foreach ($errors as $error): ?>
                <p style="color: red;"><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="full-span title">
        <div class="radio-input"><label for="title">Title*:</label></div>
        <div class="radio-input">
            <label for="male">Male</label>
            <input type="radio" name="title" value="male" id="male" <?= $formData['title'] == 'male' ? 'checked' : '' ?>>
        </div>
        <div class="radio-input">
            <label for="female">Female</label>
            <input type="radio" name="title" value="female" id="female" <?= $formData['title'] == 'female' ? 'checked' : '' ?>>
        </div>
        <span class="error"><?= $formValidator->getError('title') ?></span>
    </div>

    <div>
        <label for="username">Username*:</label>
        <span class="tooltip">?
        <span class="tooltiptext">4-16 characters, no spaces</span>
        </span>
        <input type="text" name="username" value="<?= htmlspecialchars($formData['username']) ?>">
        <span class="error"><?= $formValidator->getError('username') ?></span>
    </div>

    <div>
        <label for="first-name">Firstname*:</label>
        <input type="text" name="first-name" value="<?= htmlspecialchars($formData['firstName']) ?>">
        <span class="error"><?= $formValidator->getError('firstname') ?></span>
    </div>

    <div>
        <label for="last-name">Lastname*:</label>
        <input type="text" name="last-name" value="<?= htmlspecialchars($formData['lastName']) ?>">
        <span class="error"><?= $formValidator->getError('lastname') ?></span>
    </div>

    <div>
        <label for="email">E-Mail*:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($formData['email']) ?>">
        <span class="error"><?= $formValidator->getError('email') ?></span>
    </div>

    <div>
    <label for="password">Password*:</label>
    <span class="tooltip">?
        <span class="tooltiptext">At least 8 characters, 1 uppercase, 1 lowercase, 1 number, 1 special character, no free spaces</span>
    </span>
    <input type="password" name="password" id="password" required>
    <input type="checkbox" onclick="togglePassword()" class="show_pass"><small>Show Password</small>
    <span class="error"><?= $formValidator->getError('password') ?></span>
    </div>

    <div>
    <label for="confirm_password">Confirm Password:</label>
    <input type="password" name="confirm_password" id="confirm_password" required>
    <input type="checkbox" onclick="toggleConfirmPassword()" class="show_pass"><small>Show Password</small>
    <span class="error"><?= $formValidator->getError('confirm_password') ?></span>
    </div>


    <div class="country select">
        <select name="country">
            <option value="">Select a country</option>
            <option value="Switzerland" <?= $formData['country'] == 'Switzerland' ? 'selected' : '' ?>>Switzerland</option>
            <option value="Germany" <?= $formData['country'] == 'Germany' ? 'selected' : '' ?>>Germany</option>
            <option value="France" <?= $formData['country'] == 'France' ? 'selected' : '' ?>>France</option>
            <option value="US" <?= $formData['country'] == 'US' ? 'selected' : '' ?>>United States</option>
        </select>
        <span class="error"><?= $formValidator->getError('country') ?></span>
    </div>

    <div class="full-span comment">
        <label for="comment">Comment:</label>
        <textarea name="comment"><?= htmlspecialchars($formData['comment']) ?></textarea>
        <span class="error"><?= $formValidator->getError('comment') ?></span>
    </div>

    <div class="full-span terms">
        <label for="terms"><a href="imprint.php">Accept Terms*:</a></label>
        <input type="checkbox" name="checkbox" <?= $formData['terms'] ?>>
        <span class="error"><?= $formValidator->getError('terms') ?></span>
    </div>

    <small>* required</small>

    <div class="full-span button-container">
        <button type="submit">Register</button>
        <a href="signin.php">Sign In</a>
        <a href="index.php">Go back</a>
    </div>
</form>

    </main>
</body>
</html>
<?php 
include("../templates/footer.php");
?>
