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
            $users = fetchAllAuthors(); // Fetch all authors if query is empty
        }
    } else {
        $users = fetchAllAuthors(); // Default: Fetch all authors
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Search</title>
</head>
<body>

    <h2 id="" align="center">Search People</h2>

    <form method="get" action="searchResult.php" align="center">
        <input id="search-bar" type="text" name="search" placeholder="Search by name or email" style="width: 300px;" oninput="searchAuthors()">
        <input id="search-btn" type="submit" value="Search">
    </form>

    <br><br>
    <table id="authorTable" border="1" width="600" align="center" cellspacing="0">
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
                    <td align='center'>
                        <a href="viewEditProfile.php?id=<?= htmlspecialchars($user['id']) ?>">View Information</a>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="4" align="center">No results to display. Use the search bar above.</td>
            </tr>
        <?php } ?>
    </table>


    <div align="center">
        <a id="search-user" href="viewProfile.php">Go to Profile</a><br>
    </div>
    
    <script src="../asset/search.js"></script>
</body>
</html>
