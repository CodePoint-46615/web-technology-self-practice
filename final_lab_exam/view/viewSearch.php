<?php
    // session_start();
    require_once('../model/userModel.php');

    // Redirect to login if the user is not logged in
    if (!isset($_COOKIE['status'])) {
        header('location: login.php');
        exit;
    }

    // Retrieve users (if `Search.php` processed the search query, it will already be filtered)
    require_once('../controller/search.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Search</title>
</head>
<body>

    <h2 align="center">Search People</h2>

    <form method="get" action="searchResult.php" align="center">
        <input id="search-bar" type="text" name="search" placeholder="Search by name or email" style="width: 300px;">
        <input id="search-btn" type="submit" value="Search">
    </form>

    <br><br>
    <table border="1" width="600" align="center" celllspacing="0">
        <tr>
            <th>User Type</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>

        <?php if (!empty($users)) { ?>
            <?php foreach ($users as $user) { ?>
            <tr>
                <td align='center'><?= htmlspecialchars($user['user_type']) ?></td>
                <td align='center'><?= htmlspecialchars($user['name']) ?></td>
                <td align='center'><?= htmlspecialchars($user['username']) ?></td>
                <td>
                    <a href="viewEditProfile.php?id=<?= htmlspecialchars($user['id']) ?>">
                    <p align='center'>View Information</p>
                    </a> 
                </td>
            </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="4" align="center">No users found!</td>
            </tr>
        <?php } ?>
    </table>
    <div align="center">
        <a href="viewProfile.php">Go to Profile</a>
    </div>
    
</body>
</html>
