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
    <link rel="stylesheet" href="../asset/CSS/searchProfile.css">
</head>

<body>
    <form method="post" action="../controller/profileCheck.php" enctype="multipart/form-data">
        <table id="profile-table" align="center" border="1" width="300" height="550" cellpadding="10">
            <tr id="profile-header">
                <td colspan="2" align="center">
                    <strong>User Profile</strong>
                </td>
            </tr>

            <tr id="profile-picture-row">
                <td colspan="2" align="center">
                    <img src="<?= '../asset/' . htmlspecialchars($user['image']); ?>" alt="Profile Picture" width="150" height="150" border="1" />
                    <p id="profile-name"><?= htmlspecialchars($user['username']); ?></p>
                </td>
            </tr>

            <tr id="profile-title-row">
                <td colspan="2" align="center">
                    <h2 id="profile-title">Profile Info</h2>
                </td>
            </tr>

            <tr id="name-row">
                <td><strong>Name:</strong></td>
                <td id="profile-name"><?= htmlspecialchars($user['username']); ?></td>
            </tr>

            <tr id="email-row">
                <td><strong>Email:</strong></td>
                <td id="profile-email"><?= htmlspecialchars($user['email']); ?></td>
            </tr>

            <tr id="phone-row">
                <td><strong>Phone Number:</strong></td>
                <td id="profile-phone"><?= htmlspecialchars($user['phone']); ?></td>
            </tr>

            
            <tr id="user-type-row">
                <td><strong>User Type:</strong></td>
                <td id="profile-user-type"><?= htmlspecialchars($user['utype']); ?></td>
            </tr>

            <tr id="id-row">
                <td><strong>ID:</strong></td>
                <td id="profile-id"><?= htmlspecialchars($user['id']); ?></td>
            </tr>
        </table>
    </form>
</body>

</html>
