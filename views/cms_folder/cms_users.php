<?php
require_once('../../Controller/UserController.php');

// Initialize Database and Controller
$db = new Database();
$dbConnection = $db->connect();
$userController = new UserController($dbConnection);

$users = $userController->getAllUsers();

$message = '';
$errorMessages = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $userId = intval($_POST['id']); // Ensure ID is an integer for safety

    switch ($_POST['action']) {
        case 'grant_admin':
            // Grant admin rights to the user
            $message = $userController->grantAdminRights($userId);  // Corrected syntax for message assignment
            break;

        case 'revoke_admin':
            // Revoke admin rights from the user
            $message = $userController->revokeAdminRights($userId);  // Corrected syntax for message assignment
            break;

        case 'delete_user':
            // Ensure the user ID is provided
            $userId = $_POST['id'] ?? '';  // Get the user ID from the POST data
            if (empty($userId)) {
                // If the ID is missing, set a message and stop further execution
                $errorMessages[] = "User ID is required for deletion.";
                break;
            }

            // Call the deleteUser method from the UserController
            $result = $userController->deleteUser($userId);  // Attempt to delete the user

            if ($result) {
                $message = "User deleted successfully.";
            } else {
                $errorMessages[] = "Failed to delete user.";
            }
            break;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="../../assets/css/cms_template.css">
    <link rel="stylesheet" href="../../assets/css/cms_dashboard.css">
</head>

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

<div id="userForm" class="form-container active">
    <h2>Manage User Admin Rights</h2>

    <?php if ($message): ?>
        <p class="message"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <?php if ($errorMessages): ?>
        <ul class="error-messages">
            <?php foreach ($errorMessages as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Lastname</th>
                <th>Firstname</th>
                <th>Email</th>
                <th>Admin</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['lastname']) ?></td>
                    <td><?= htmlspecialchars($user['firstname']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= $user['is_admin'] ? 'Yes' : 'No' ?></td>
                    <td>
                        <!-- Grant Rights Button -->
                        <?php if ($user['is_admin']): ?>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                <button type="submit" name="action" value="revoke_admin" class="button">Revoke Admin</button>
                            </form>
                        <?php else: ?>
                            <!-- Revoke Rights Button -->
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                <button type="submit" name="action" value="grant_admin" class="button">Grant Admin</button>
                            </form>
                        <?php endif; ?>
                        <form method="POST" action="" style="display:inline;">
                            <input type="hidden" name="action" value="delete_user">
                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                            <button type="submit" onclick="return confirm('Are you sure you want to delete user?')" class="button">Delete
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>

</html>