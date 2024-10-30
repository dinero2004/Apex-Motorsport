<?php 
include("../public/login_valid.php");
include("../templates/header.php");

$username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/login.css">
    <script src="../assets/code/code.js"></script>
    <script src="../assets/code/login.js"></script>
    <link rel="icon" href="/src/assets/favicon/favicon_package_v0.16/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/src/assets/favicon/favicon_package_v0.16/favicon.ico" type="image/x-icon">
    <title>Login</title>
    <style>
        .error { color: red; font-size: 0.9em; }
        .valid { color: green; font-size: 0.9em; }
    </style>
</head>
<body>
<main> 
    <h1>Login</h1>
    <?php if (!empty($errors)): ?>
        <div>
            <?php foreach ($errors as $error): ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" value="<?= $username; ?>" required>
            <span class="error"><?= in_array("Username not found.", $errors) ? "Username not found." : ''; ?></span>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <input type="checkbox" onclick="myFunction()" class="show_pass"><label>Show Password</label>
            <span class="error"><?= in_array("Incorrect password.", $errors) ? "Incorrect password." : ''; ?></span>
        </div>
        
        <div class="button-container">
            <button type="submit">Login</button>
            <a href="signup.php">Sign Up</a>
            <a href="index.php">Go back</a>
        </div>
    </form>
</main>
</body>
</html>
<?php
include("../templates/footer.php");
?>
