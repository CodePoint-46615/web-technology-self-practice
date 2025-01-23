<?php
session_start();
require_once('../model/userModel.php');

// Redirect to login if the user is not logged in
if (!isset($_COOKIE['status'])) {
    header('location: login.php');
    exit;
}

// Check if 'id' is passed via the request
if (!isset($_REQUEST['id']) || empty($_REQUEST['id'])) {
    echo "Error: User ID is missing!";
    exit;
}

// Retrieve the user details
$userId = $_REQUEST['id'];
$user = getUser($userId);

// Save the ID in the session for later use
$_SESSION['update_id'] = $userId;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Profile Picture</title>
    <link rel="stylesheet" href="../asset/CSS/viewChangeDP.css">
</head>
<body>
    <table align="center" border="1" cellpadding="10" cellspacing="0">
        <tr>
            <td>
                <fieldset>
                    <legend><strong>Change Profile Photo</strong></legend>
                    <form method="post" action="../controller/changeDP.php" enctype="multipart/form-data">
                        <table align="center">
                            <tr>
                                <td align="center">
                                    <img src="../asset/<?= htmlspecialchars($user['image']); ?>" alt="Profile Picture" width="150">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="profile-picture"><strong>Select New Profile Image:</strong></label><br>
                                    <input type="file" id="profile-picture" name="profile-picture" accept="image/*" required><br><br>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <button type="submit" name="submit">Upload Image</button><br>
                                    <a href="viewProfile.php">Go to Profile</a>
                                </td>
                            </tr>
                        </table>
                    </form>
                </fieldset>
            </td>
        </tr>
    </table>
</body>
</html>
