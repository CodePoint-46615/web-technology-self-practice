<?php
    // session_start();
    require_once('../model/userModel.php');

    // Redirect to login if the user is not logged in
    if (!isset($_COOKIE['status'])) {
        header('location: login.php');
        exit;
    }

    // Initialize $users as an empty array
    $users = [];

    // Handle search if a query is provided
    if (isset($_GET['search'])) {
        $query = trim($_GET['search']);
        if ($query !== '') {
            $users = searchUser($query); // Search within authors
        } else {
            $users = fetchAllUser(); // Fetch all user if query is empty
        }
    } else {
        $users = fetchAllUser(); // Default: Fetch all user
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Search</title>
    <link rel="stylesheet" href="../asset/CSS/viewSearch.css">
</head>
<body>

    <h2 align="center">Search People</h2>

    <form method="get" action="searchResult.php" align="center">
        <input id="search-bar" type="text" name="search" placeholder="Search by name or email" style="width: 300px;" oninput="searchuser()">
        <input id="search-btn" type="submit" value="Search">
    </form>

    <br><br>
    <table id="authorTable" border="1" width="600" align="center" celllspacing="0">
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
    <div align="center">
        <a href="viewProfile.php">Go to Profile</a>
    </div>
    <script src="../asset/JS/search.js"></script>
</body>
</html>
