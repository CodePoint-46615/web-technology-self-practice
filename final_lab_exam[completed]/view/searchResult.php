<?php
    session_start();
    require_once('../model/userModel.php');

    // Redirect to login if the user is not logged in
    if (!isset($_COOKIE['status'])) {
        header('location: login.php');
        exit;
    }

    $users = [];

    // Check if a search query exists
    if (isset($_REQUEST['search']) && !empty(trim($_REQUEST['search']))) {
        $query = trim($_REQUEST['search']);
        $users = searchUsers($query);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
</head>
<body>

    <h2 align="center">Search Results</h2>

    <table border="1" width="600" align="center" cellspacing="0">
        <tr>
            <th>User Type</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>

        <?php if (!empty($users)) { ?>
            <?php foreach ($users as $user) { ?>
            <tr>
                <td align='center'><?= htmlspecialchars($user['utype']) ?></td>
                <td align='center'><?= htmlspecialchars($user['username']) ?></td>
                <td align='center'><?= htmlspecialchars($user['email']) ?></td>
                <td>
                    <a href="searchProfile.php?id=<?= htmlspecialchars($user['id']) ?>">
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

    <br>
    <div align="center">
        <a href="viewSearch.php">Back to Search</a>
    </div>

</body>
</html>
