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
    $_SESSION['user_id'] = $userId; // Set user_id in session
} elseif (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
    $_SESSION['user_id'] = $userId; // Set user_id in session
} else {
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

// Display message if available
if (isset($_SESSION['message'])) {
    echo "<p>" . $_SESSION['message'] . "</p>";
    unset($_SESSION['message']); // Clear the message
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Blog</title>
    <link rel="stylesheet" href="../asset/CSS/viewCreateBlog.css">
</head>
<body>
    <table id="create-blog" width="300" height="200" border="1" align="center" cellpadding="20" cellspacing="0">
        <tr>
            <th>
                <h1>Create Blog</h1>
            </th>
        </tr>

        <form method="POST" action="../controller/checkCreateBlog.php" enctype="application/x-www-form-urlencoded">
            <tr>
                <td>
                    Title <input type="text" name="title" value="" id="title" required/><br>
                </td>
            </tr>

            <tr>
                <td>
                    <p>Write Description for Blog</p>
                    <textarea name="blog" id="write-blog" rows="10" cols="40" placeholder="Start Writing Here" required></textarea>
                </td>
            </tr>

            <tr>
                <td align="right">
                    <input type="submit" name="submit" value="Submit Blog"/>
                </td>
            </tr>

            <tr>
                <td align="center">
                    <a href="viewBlog.php">Go to Back</a>
                </td>
            </tr>
        </form>
        

    </table>
</body>
</html>
