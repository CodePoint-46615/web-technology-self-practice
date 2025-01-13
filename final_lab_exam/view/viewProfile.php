<?php
    session_start();
    require_once('../model/userModel.php');

    // Redirect to login if the user is not logged in
    if (!isset($_COOKIE['status'])) {
        header('location: login.php');
        exit;
    }

    // Use 'id' from request or session
    if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
        $userId = $_REQUEST['id'];
    } 
    elseif (isset($_SESSION['id'])){
        $userId = $_SESSION['id'];
    } 
    else {
        echo "Error: User ID is missing!";
        exit;
    }

    // Retrieve the user details
    $user = getUser($userId);
    if (!$user) {
        echo "Error: User not found!";
        exit;
    }

    // Save the ID in the session for later use
    $_SESSION['update_id'] = $userId;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>
</head>

<body>
    <form method="post" action="../controller/profileCheck.php" enctype="multipart/form-data">
        <table id="profile-table" align="center" border="1" width="300" height="550" cellpadding="10" cellspacing="0">
            <tr id="profile-header">
                <td colspan="2" align="center">
                    <strong>User Profile</strong>
                </td>
            </tr>

            

            <tr id="profile-title-row">
                <td colspan="2" align="center">
                    <h2 id="profile-title">Profile</h2>
                </td>
            </tr>

            <tr id="name-row">
                <td><strong>Name:</strong></td>
                <td id="profile-name"><?= htmlspecialchars($user['username']); ?></td>
            </tr>

            <tr id="phone-row">
                <td><strong>Contact:</strong></td>
                <td id="profile-phone"><?= htmlspecialchars($user['contact']); ?></td>
            </tr>

            <tr id="email-row">
                <td><strong>Username:</strong></td>
                <td id="profile-email"><?= htmlspecialchars($user['username']); ?></td>
            </tr>

            <tr id="user-type-row">
                <td><strong>User Type:</strong></td>
                <td id="profile-user-type"><?= htmlspecialchars($user['user_type']); ?></td>
            </tr>

            <tr id="id-row">
                <td><strong>ID:</strong></td>
                <td id="profile-id"><?= htmlspecialchars($user['id']); ?></td>
            </tr>

            <tr>
                <?php if ($user['user_type'] === 'Admin'): ?>
                    <td colspan="4" align='center'>
                        <a id="search-user" href="viewSearch.php?id=<?= $user['id']; ?>">User Management</a><br>
                    </td>
                <?php endif; ?>
            </tr> 

            <tr id="links-row">
                <td colspan="2" align="center">
                    <a id="log-out" href="../controller/logout.php">Log out</a>
                </td>
            </tr>
        </table>
    </form>
</body>

</html>
