<?php


include("../templates/header.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" href="/src/assets/favicon/favicon_package_v0.16/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/src/assets/favicon/favicon_package_v0.16/favicon.ico" type="image/x-icon">
    <title>Login</title>
    <style>
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            background-color: black;
            color: #white;
        }


        h1 {
            margin-bottom: 50px;
        }

        p {
            margin-top: 50px;
        }

        a {
            color: red;
        }

        a:hover {
            color: #ae4e4e;
            ransition: color 0.6s ease, text-decoration 0.6s ease;
        }
    </style>
</head>

<body>
    <main>
        <h1>Account Created Successfully!</h1>
        <p>Your account has been created. You can now <a href="login.php">log in</a>.</p>
    </main>

</body>

</html>
<?php
include("../templates/footer.php");
?>